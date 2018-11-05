var bucle_contador = "";
jQuery(document).ready(function() {

    jQuery(".anuncio_item").on("click", function(e){

        /*console.log( jQuery(this).attr("data-fichas") );
        console.log( jQuery(this).attr("data-tiempo") );
        console.log( jQuery(this).attr("data-id") );
        console.log( jQuery(this).attr("data-precio_puja") );
        console.log( jQuery(this).attr("data-tiempo_actual") );*/

        var mis_fichas = parseInt( jQuery("#mis_fichas").html() );
        
        if( mis_fichas > 0 ){

            jQuery(this).attr("data-tiempo_actual", jQuery(this).attr("data-tiempo") );
            
            var id = jQuery(this).attr("data-id");

            var puja = jQuery(this).attr("data-precio_puja");
            puja = ( puja == "0.00" ) ? 0: parseFloat(puja);
            puja += 0.01;
            puja = (Math.round(puja * 100) / 100);
            jQuery(this).attr("data-precio_puja", puja);
            jQuery("#precio_puja_"+id).html(puja+"€");
            jQuery("#comprar_"+id).attr("data-puja", puja);

            if( jQuery(this).attr("data-compra") != "No" ){
                var compra = jQuery(this).attr("data-compra");
                compra = ( compra == "0.00" ) ? 0: parseFloat(compra);
                compra = (Math.round(compra * 100) / 100);
                jQuery("#precio_compra_"+id).html((compra-puja)+"€");
            }

            var cantidad_fichas = jQuery(this).attr("data-fichas");
            jQuery("#mis_fichas").html( mis_fichas-cantidad_fichas );

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
        }
    });
    bucle_contador = setInterval("contadores()", 1000);

});

function contadores() {
    var activas = 0;
    jQuery(".anuncio_item").each(function(i, v){
        var id = jQuery(this).attr("data-id");
        var tiempo_actual = parseInt( jQuery(this).attr("data-tiempo_actual") );
        var new_tiempo = (tiempo_actual-1);
        if( new_tiempo >= 0 ){
            var temp = 0;
            activas++;
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
                console.log("Puja #"+id+" finalizada");
            }
        }
    });
    if( activas == 0 ){
        clearInterval( bucle_contador );
    }
} 