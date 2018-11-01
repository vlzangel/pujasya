var vlzImgs = ( function () {
 
    var W = 800,
        H = 600,

    // API
        public = {};

    // Public methods goes here...

         public.getRealMime = function (file) {
            return new Promise((resolve, reject) => {
                if (window.FileReader && window.Blob) {
                    let slice = file.slice(0, 4);
                    let reader = new FileReader();
                    reader.onload = () => {
                        let buffer = reader.result;
                        let view = new DataView(buffer);
                        let signature = view.getUint32(0, false).toString(16);
                        let mime = 'unknown';
                        switch ( String(signature).toLowerCase() ) {
                            case "89504e47":
                                mime = "image/png";
                            break;
                            case "47494638":
                                mime = "image/gif";
                            break;
                            case "ffd8ffe0":
                                mime = "image/jpeg";
                            break;
                            case "ffd8ffe1":
                                mime = "image/jpeg";
                            break;
                            case "ffd8ffe2":
                                mime = "image/jpeg";
                            break;
                            case "ffd8ffe3":
                                mime = "image/jpeg";
                            break;
                            case "ffd8ffe8":
                                mime = "image/jpeg";
                            break;
                        }
                        resolve(mime);
                    }
                    reader.readAsArrayBuffer(slice);
                } else {
                    reject(new Error('Usa un navegador moderno para una mejor experiencia'));
                }
            });
        }

        public.ctx = function(i){
            var e = document.getElementById(i);
            if(e && e.getContext){
                var c = e.getContext('2d');
                if(c){ return c; }
            }
           return false;
        }
        public.d = function(s){ return jQuery(s)[0].outerHTML; }

        public.ct = function(IMG_CACHE, CB){
            if( jQuery("#vlz_redi_imgs").html() == undefined ){
                var img = jQuery("<img>", { id: "vlz_img_temp" })[0].outerHTML;
                var cont_canvas = jQuery("<span>", { id: "vlz_canvas_temp" })[0].outerHTML
                var cont_general = jQuery("<div>", { id: "vlz_redi_imgs", html: cont_canvas+img, style: "display: none;" })[0].outerHTML;
                return jQuery("body").append(cont_general);
            }else{
                
            }
        }

        public.redi = function(IMG_CACHE, CB){
            public.ct();
            var ximg = new Image();
            ximg.src = IMG_CACHE;
            ximg.onload = function(){
                jQuery("#vlz_redi_imgs #vlz_img_temp").attr("src", ximg.src);
                var rxi = jQuery("#vlz_redi_imgs #vlz_img_temp")[0];
                var rw = rxi.width; var rh = rxi.height; var w = W; var h = H;
                if( rw > rh ){ h = Math.round( ( rh * w ) / rw ); }else{ w = Math.round( ( rw * h ) / rh ); }
                CA = public.d("<canvas id='vlz_canvas' width='"+w+"' height='"+h+"'>");
                jQuery("#vlz_redi_imgs #vlz_canvas_temp").html(CA);
                CA = jQuery("#vlz_redi_imgs #vlz_canvas_temp #vlz_canvas");
                CTX = public.ctx("vlz_canvas");
                if(CTX){
                    CTX.drawImage(ximg, 0, 0, w, h);
                    CB( CA[ 0 ].toDataURL("image/png", 1.0) );
                }else{
                    return false;
                }
            }
        }

        public.initImg = function (id, di, CB){
            W = di[0];
            H = di[1];
            document.getElementById(id).removeEventListener("change", function(evt){ });
            document.getElementById(id).addEventListener("change", function (evt) {
                var files = evt.target.files;
                jQuery.each(files, function(i, f){
                    public.getRealMime(f).then(function(MIME){
                        if( MIME.match("image.*") ){
                            var reader = new FileReader();
                            reader.onload = (function(theFile) {
                                return function(e) {
                                    public.redi(e.target.result, function(img_r){
                                        CB( img_r );
                                    });     
                                };
                           })(f);
                           reader.readAsDataURL(f);
                        }else{
                            jQuery("#"+id).parent().find("div").html("Solo se permiten imagenes");
                        }
                    }).catch(function(error){
                        jQuery("#"+id).parent().find("div").html("Solo se permiten imagenes");
                    });  
                });
            }, false);
        } 

        public.load = function (id, di, CB){
            var HTML = jQuery("<input>", { 
                    id: "_"+id, 
                    name: id, 
                    type: "file",  
                    accept: jQuery("#"+id).attr("data-accept") ,  
                    multiple: jQuery("#"+id).attr("data-multiple") 
                })[0].outerHTML;
            HTML += "Haga click o arrastre sobre esta zona para cargar las imágenes";
            HTML += jQuery("<div>", {})[0].outerHTML;
            jQuery("#"+id).html(HTML);
            jQuery("#"+id).addClass("vlz_file");
            jQuery("#"+id).css({
                position: "relative",
                padding: "10px",
                background: "#ab8ce4",
                "border-radius": "3px",
                margin: "5px 0px",
                cursor: "pointer",
                color: "#FFF"
            });
            jQuery("#_"+id).css({
                position: "absolute",
                top: "0px",
                left: "0px",
                width: "100%",
                height: "100%",
                opacity: "0",
                cursor: "pointer"
            });
            public.initImg("_"+id, di, CB);
        } 
 
    return public;
} () );










/*
        function subirImg(evt){
            var files = evt.target.files;
            var padre = jQuery(this).parent().parent();
            getRealMime(this.files[0]).then(function(MIME){
                if( MIME.match("image.*") ){

                    padre.children('.vlz_img_portada_cargando').css("display", "block");
                    var reader = new FileReader();
                    reader.onload = (function(theFile) {
                        return function(e) {
                            redimencionar(e.target.result, function(img_reducida){
                                var img_pre = jQuery(".vlz_rotar_valor").attr("value");
                                jQuery.post( RUTA_IMGS+"/procesar.php", {img: img_reducida, previa: img_pre}, function( url ) {
                                    padre.children('.vlz_img_portada_fondo').css("background-image", "url("+RUTA_IMGS+"/Temp/"+url+")");
                                    padre.children('.vlz_img_portada_normal').css("background-image", "url("+RUTA_IMGS+"/Temp/"+url+")");
                                    padre.children('.vlz_img_portada_cargando').css("display", "none");
                                    padre.siblings('.vlz_img_portada_valor').val(url);
                                    padre.children('.vlz_cambiar_portada').children('input').val("");

                                    jQuery(".btn_rotar").css("display", "block");
                                });
                            });      
                        };
                   })(files[0]);
                   reader.readAsDataURL(files[0]);
                }else{
                    padre.children('.vlz_cambiar_portada').children('input').val("");
                    padre.children('.vlz_img_portada_cargando').css("display", "none");
                    alert("Solo se permiten imagenes");
                }
            }).catch(function(error){
                padre.children('.vlz_cambiar_portada').children('input').val("");
                padre.children('.vlz_img_portada_cargando').css("display", "none");
                alert("Solo se permiten imagenes");
            });     
        }

        function initImg(id){
            document.getElementById(id).addEventListener("change", subirImg, false);
        }  

        function d(s){ return jQuery(s)[0].outerHTML; }
        function c(i){
           var e = document.getElementById(i);
           if(e && e.getContext){
                var c = e.getContext('2d');
                if(c){ return c; }
           }
           return false;
        }

        function contenedor_temp(){
            if( jQuery("#vlz_redimencionar_imagenes").html() == undefined ){
                var img = jQuery("<img>", {
                    id: "vlz_img_temp"
                })[0].outerHTML;

                var cont_canvas = jQuery("<span>", {
                    id: "vlz_canvas_temp"
                })[0].outerHTML

                var cont_general = jQuery("<div>", {
                    id: "vlz_redimencionar_imagenes",
                    html: cont_canvas+img,
                    style: "display: none;"
                })[0].outerHTML;

                return jQuery("body").append(cont_general);
            }else{
                var img = jQuery("<img>", {
                    id: "vlz_img_temp"
                })[0].outerHTML;

                var cont_canvas = jQuery("<span>", {
                    id: "vlz_canvas_temp"
                })[0].outerHTML

                var cont_general = jQuery("<div>", {
                    id: "vlz_redimencionar_imagenes",
                    html: cont_canvas+img,
                    style: "display: none;"
                })[0].outerHTML;

                jQuery("#vlz_redimencionar_imagenes").html(cont_general);
            }
        }

        function rotar(orientacion){

            var img_rotada = _rotar(orientacion);
            if( img_rotada != null ){
                jQuery("#vlz_redimencionar_imagenes img").attr("src", img_rotada);
                jQuery(".vlz_rotar").css("background-image", "url("+img_rotada+")" );
                jQuery('.btn_aplicar_rotar').css("display", "block");
            }else{
                alert("No hay imagen seleccionada");
            }

        }

        function rotar_img(orientacion, id){
            console.log(id+" "+orientacion);
            var img_rotada = _rotar(orientacion, id);
            if( img_rotada != null ){

                jQuery("#"+id).attr("src", img_rotada );


            }else{
                alert("No hay imagen seleccionada");
            }
        }

        function _rotar(orientacion, id = ""){
            if( typeof(CTX) != "undefined" ){
                if( id != "" ){
                    jQuery("#vlz_redimencionar_imagenes img").attr("src", jQuery("#"+id).attr("src") );
                }
                var rxi = jQuery("#vlz_redimencionar_imagenes img")[0];
                var rh = rxi.width; var rw = rxi.height;
                var xw = 500; var xh = 500;
                if( (rw > xw) && (rh > xh) ){
                    if( rw <= rh ){
                        var porc = ((xw*100)/rw)/100; var w = rw*porc; var h = rh*porc;
                    }else{
                        var porc = ((xh*100)/rh)/100; var w = rw*porc; var h = rh*porc;
                    }
                }else{ var w = rw; var h = rh; }
                CA = d("<canvas id='vlz_canvas' width='"+w+"' height='"+h+"'>");
                jQuery("#vlz_redimencionar_imagenes #vlz_canvas_temp").html(CA);
                CA = jQuery("#vlz_redimencionar_imagenes #vlz_canvas_temp #vlz_canvas");
                CTX = c('vlz_canvas');
                if(CTX){

                    var x = 0; var y = 0; 

                    switch(orientacion){
                        case "left":
                            x = h*-1;
                            CTX.rotate(Math.PI*-0.5);
                        break;
                        case "right":
                            y = w*-1;
                            CTX.rotate(Math.PI*0.5);
                        break;
                    }

                    CTX.drawImage(rxi, x, y, h, w);
                    var img_rotada = CA[ 0 ].toDataURL("image/jpg");
                    //jQuery("#vlz_redimencionar_imagenes img").attr("src", img_rotada);

                    return img_rotada;
                }
            }else{
                return null;
            }
            return null;
        }

        function redimencionar(IMG_CACHE, CB){
            contenedor_temp();
            var ximg = new Image();
            ximg.src = IMG_CACHE;
            ximg.onload = function(){
                jQuery("#vlz_redimencionar_imagenes #vlz_img_temp").attr("src", ximg.src);
                var rxi = jQuery("#vlz_redimencionar_imagenes #vlz_img_temp")[0];
                var rw = rxi.width;
                var rh = rxi.height;
                var w = 800;
                var h = 600;
                if( rw > rh ){
                    h = Math.round( ( rh * w ) / rw );
                }else{
                    w = Math.round( ( rw * h ) / rh );
                }
                CA = d("<canvas id='vlz_canvas' width='"+w+"' height='"+h+"'>");
                jQuery("#vlz_redimencionar_imagenes #vlz_canvas_temp").html(CA);
                CA = jQuery("#vlz_redimencionar_imagenes #vlz_canvas_temp #vlz_canvas");
                CTX = c("vlz_canvas");
                if(CTX){
                    CTX.drawImage(ximg, 0, 0, w, h);
                    CB( CA[ 0 ].toDataURL("image/jpeg") );
                }else{
                    return false;
                }
            }
        }
*/