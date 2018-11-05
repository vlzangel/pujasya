var bucle_contador = "";
var revisar_ganadores = "";
jQuery(document).ready(function() {
    jQuery(".anuncio_item").on("click", function(e){

        if( !jQuery(this).hasClass("btn-inact") ){
            var mis_fichas = parseInt( jQuery("#mis_fichas").html() );
            if( mis_fichas > 0 && jQuery(this).attr("data-status") == "activa" ){
                // jQuery(this).attr("data-tiempo_actual", jQuery(this).attr("data-tiempo") );
                var id = jQuery(this).attr("data-id");
                var puja = jQuery(this).attr("data-precio_puja");
                puja = ( puja == "0.00" ) ? 0: parseFloat(puja);
                puja += 0.01;
                puja = (Math.round(puja * 100) / 100);
                /*jQuery(this).attr("data-precio_puja", puja);
                jQuery("#precio_puja_"+id).html(puja+"€");
                jQuery("#comprar_"+id).attr("data-puja", puja);
                if( jQuery(this).attr("data-compra") != "No" ){
                    var compra = jQuery(this).attr("data-compra");
                    compra = ( compra == "0.00" ) ? 0: parseFloat(compra);
                    compra = (Math.round(compra * 100) / 100);
                    jQuery("#precio_compra_"+id).html((compra-puja)+"€");
                }*/
                var cantidad_fichas = jQuery(this).attr("data-fichas");
                jQuery("#mis_fichas").html( mis_fichas-cantidad_fichas );

                jQuery("#pujar_"+id).addClass("btn-inact");

                jQuery.post(
                    HOME+"Pujar/pujar",
                    {
                        "id_anuncio": jQuery(this).attr("data-id"),
                        "precio_puja": puja
                    },
                    function(data){
                        console.log(data);
                        jQuery("#ult_user_"+id).html(data.user);
                    }, 'json'
                );
            }else{
                if( mis_fichas <= 0 ){
                    jQuery("#alert-cfichas").modal('show');
                }
            }
        }
    });

    // bucle_contador = setInterval("contadores()", 1000);

    revisar_ganadores = setInterval("ganadores()", 1000);
});

function contadores() {
    var activas = 0;
    jQuery(".anuncio_item").each(function(i, v){
        var id = jQuery(this).attr("data-id");
        activas++;
        if( String(jQuery("#ult_user_"+id).html()).trim() != "" && jQuery(this).attr("data-status") == "activa" ){
            var tiempo_actual = parseInt( jQuery(this).attr("data-tiempo_actual") );
            var new_tiempo = (tiempo_actual-1);
            if( new_tiempo >= 0 ){
                var temp = 0;
                if( new_tiempo > 9 ) {
                    temp = new_tiempo;
                    if( new_tiempo == 10 ){
                        jQuery("#timer_"+id).addClass("timerfin");
                    }else{
                        jQuery("#timer_"+id).removeClass("timerfin");
                    }
                }else{
                    jQuery("#timer_"+id).addClass("timerfin");
                    temp = "0"+new_tiempo;
                }
                jQuery("#timer_"+id).html( "00:00:"+temp );
                jQuery(this).attr("data-tiempo_actual", new_tiempo);
                if( new_tiempo == 0 ){
                    cerrar_anuncio(id);
                }
            }else{
                activas--;
            }
        }
    });
    if( activas == 0 ){
        clearInterval( bucle_contador );
        clearInterval( revisar_ganadores );
    }
} 

var REVISAR = true;

function ganadores() {
    if( REVISAR ){
        jQuery.post(
            HOME+"Pujar/revisarPujas",
            {},
            function(data){
                // console.log( data );
                if( data[0].length > 0 ){
                    console.log( data[0] );
                    jQuery.each(data[0], function(i, anuncio){
                        var id = anuncio.id_anuncio;
                        cerrar_anuncio(id);
                    });
                }
                if( data[1].length > 0 ){
                    jQuery.each(data[1], function(i, anuncio){
                        console.log( anuncio.donde );
                        actualizar_anuncio(anuncio);
                    });
                }
            }, 'json'
        );
    }
} 

function actualizar_anuncio(anuncio){
    var id = anuncio.id_anuncio;

    jQuery("#pujar_"+id).attr("data-tiempo_actual", anuncio.tiempo_actual);
    jQuery("#ult_user_"+id).html(anuncio.ult_puja_user);
    jQuery("#comprar_"+id).attr("data-puja", anuncio.precio_puja);
    jQuery("#pujar_"+id).attr("data-precio_puja", anuncio.precio_puja);
    jQuery("#precio_puja_"+id).html(anuncio.precio_puja+"€");

    if( anuncio.ult_puja_user != USER_NICKNAME ){
        jQuery("#pujar_"+id).removeClass("btn-inact");
    }

    if( parseInt(anuncio.se_compra) == 1 ){
        var compra = parseFloat(anuncio.precio_compra);
        jQuery("#precio_compra_"+id).html( (compra-anuncio.precio_puja)+"€" );
    }

    var temp = 0;
    if( anuncio.tiempo_actual > 9 ) {
        temp = anuncio.tiempo_actual;
        if( anuncio.tiempo_actual == 10 ){
            jQuery("#timer_"+id).addClass("timerfin");
        }else{
            jQuery("#timer_"+id).removeClass("timerfin");
        }
    }else{
        jQuery("#timer_"+id).addClass("timerfin");
        temp = "0"+anuncio.tiempo_actual;
    }
    jQuery("#timer_"+id).html( "00:00:"+temp );
    jQuery(this).attr("data-tiempo_actual", anuncio.tiempo_actual);
    if( anuncio.tiempo_actual == 0 ){
        cerrar_anuncio(id);
    }
}

function cerrar_anuncio(id){
    jQuery("#pujar_"+id).attr("data-status", "cerrada");
    jQuery("#pujar_"+id).addClass("btn-inact");
    jQuery("#autopuja_"+id).addClass("btn-inact");
    jQuery("#timer_"+id).html("00:00:00");
    jQuery("#timer_"+id).removeClass("timerfin");
    if( jQuery("#seccion_comprar_"+id+" h5").html() != "Compra no disponible" ){
        jQuery("#seccion_comprar_"+id+" h5").html("Compra no disponible");
        jQuery("#seccion_comprar_"+id+" .comprar_ahora").css("display", "none");
        jQuery("#seccion_comprar_"+id+" .mensaje_comprar").removeClass("col-md-5 col-sm-5 col-xs-6");
        jQuery("#seccion_comprar_"+id+" .mensaje_comprar").addClass("col-md-9");
        jQuery("#seccion_comprar_"+id+" .boton_comprar button").addClass("btn-inact");
    }
}