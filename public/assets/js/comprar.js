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
	window.location = HOME+'comprarproducto/'+id;
}