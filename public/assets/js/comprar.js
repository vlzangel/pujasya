jQuery(document).ready(function() {

    jQuery(".producto").on("click", function(e){
    	var precio = parseFloat(jQuery(this).attr("data-precio"));
    	var puja = parseFloat(jQuery(this).attr("data-puja"));
    	var envio = parseFloat(jQuery(this).attr("data-envio"));
    	jQuery("#info-compra #producto_titulo").html( jQuery(this).attr("data-titulo") );
    	jQuery("#info-compra #producto_precio").html( precio );
    	jQuery("#info-compra #producto_puja").html( puja );
    	jQuery("#info-compra #producto_envio").html( envio );
    	jQuery("#info-compra #producto_final").html( (precio-puja)+envio );
    	jQuery("#info-compra #btn_comprar_modal").attr( "data-id", jQuery(this).attr("data-id") );

        jQuery("#info-compra #producto_img").attr( "src", HOME+"files/productos/"+jQuery(this).attr("data-img") );

    	jQuery('#info-compra').modal('show');
    });

});

function comprarProducto(_this){
	var id = _this.attr("data-id");

    var btn_puja = jQuery("#pujar_"+id);
    var btn_comprar = jQuery("#comprar_"+id);

    var precio = parseFloat(btn_comprar.attr("data-precio"));
    var envio = parseFloat(btn_comprar.attr("data-envio"));
    var precio_puja = parseFloat( btn_puja.attr("data-precio_puja") );

    jQuery.post(
        HOME+"Pedido/create", {
            "user_id" : USER_ID,
            "producto_id" : id,
            "producto_precio" : precio,
            "producto_puja" : precio_puja,
            "producto_envio" : envio,
            "pago" : ( (precio-precio_puja)+envio ),
            "operacion" : "compra",
            "status" : "precompra",
            "tipo_producto" : "anuncio"
        },
        function(data){
           /* console.log( data );
            console.log( HOME+'comprarproducto/'+data.pedido_id );*/
            window.location = HOME+'comprarproducto/'+data.pedido_id;
        }, 'json'
    );

}