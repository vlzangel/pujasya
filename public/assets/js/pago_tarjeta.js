var stripe = "";

jQuery(document).ready(function() {
    Stripe.setPublishableKey('pk_test_NKNegahMKyQOpa8Z3UfjDfpi');

    jQuery("#confirma_metodo_pago").on("click", function(e){

        if( CARRITO["paquete_metodo_pago"] != "" ){
            jQuery("#error").addClass("hidden");
            if( CARRITO["paquete_metodo_pago"] == "Paypal" ){
                nextPrev(1);
            }else{
                if( validar() ){
                    var form = jQuery('#payment-form');
                    Stripe.createToken(form, function(status, response) {
                        var form = jQuery('#payment-form');
                        if (response.error) {
                            jQuery("#alerta_visa").html( MSG_STRYPE[response.error.code] );
                            jQuery("#alerta_visa").css( "display", "block" );
                        } else {
                            jQuery('<input>', {
                                'type': 'hidden',
                                'id': 'stripeToken',
                                'name': 'stripeToken',
                                'value': response.id
                            }).appendTo(form);
                            nextPrev(1);
                        }
                    });
                }
            }
        }else{
            jQuery("#error").removeClass("hidden");
        }
    });

    jQuery('#payment-form input').on("keyup", function(e){
        _validar(jQuery(this).attr("id"));
    });

    jQuery('#payment-form select').on("change", function(e){
        _validar(jQuery(this).attr("id"));
    });

    jQuery('#payment-form').on('submit', function(e) {
        e.preventDefault();
        if( jQuery("#stripeToken").val() != undefined && jQuery("#stripeToken").val() != "" ){
            jQuery.post(
                HOME+"Stripe/pagar",
                {
                    "monto": jQuery("#monto").val(),
                    "stripeToken": jQuery("#stripeToken").val(),
                    "titular": jQuery("#titulo").val(),
                },
                function(data){
                    if( data.status == "succeeded" ){
                        location.href = HOME+"Stripe/success/"+CARRITO["pedido_id"];
                    }else{
                        jQuery("#alerta_visa").html( MSG_STRYPE[data.error.error.code] );
                        jQuery("#alerta_visa").css( "display", "block" );
                        nextPrev(-1);
                    }
                }, 'json'
            );
        }else{
            nextPrev(-1);
        }
    });
});

function confirmar_pago(){
    if( CARRITO["paquete_metodo_pago"] != "" ){
        jQuery("#error").addClass("hidden");
        nextPrev(1);
    }else{
        jQuery("#error").removeClass("hidden");
    }
}

function sh_error(id, status){
    if( status ){
        jQuery("."+id).css("display", "inline-block");
    }else{
        jQuery("."+id).css("display", "none");
    }
}

function _validar(campo){
    var valor = String(jQuery("#"+campo).val()).trim().length;
    switch( campo ) {
        case "numero":
            if( valor == 0 ){
                sh_error("numero_vacio", true);
                sh_error("numero_valido", false);
                return 1;
            }else{
                if( valor != 16 ){
                    sh_error("numero_vacio", false);
                    sh_error("numero_valido", true);
                    return 1;
                }else{
                    sh_error("numero_vacio", false);
                    sh_error("numero_valido", false);
                }
            }
        break;
        case "mes":
            if( valor == 0 ){
                sh_error("mes_vacio", true);
                return 1;
            }else{
                var mes = parseInt( jQuery("#"+campo).val() );
                var anio = parseInt( jQuery("#anio").val() );
                if( mes < mesActual && ( anio == anioActual ) ){
                    sh_error("mes_vacio", false);
                    sh_error("vencida", true);
                    return 1;
                }else{
                    sh_error("mes_vacio", false);
                    sh_error("vencida", false);
                }
            }
        break;
        case "anio":
            if( valor == 0 ){
                sh_error("anio_vacio", true);
                return 1;
            }else{
                var mes = parseInt( jQuery("#mes").val() );
                var anio = parseInt( jQuery("#anio").val() );
                if( mes < mesActual && ( anio == anioActual ) ){
                    sh_error("anio_vacio", false);
                    sh_error("vencida", true);
                    return 1;
                }else{
                    sh_error("anio_vacio", false);
                    sh_error("vencida", false);
                }
            }
        break;
        case "cvv":
            if( valor == 0 ){
                sh_error("cvv_vacio", true);
                sh_error("cvv_valido", false);
                return 1;
            }else{
                if( valor != 3 ){
                    sh_error("cvv_vacio", false);
                    sh_error("cvv_valido", true);
                    return 1;
                }else{
                    sh_error("cvv_vacio", false);
                    sh_error("cvv_valido", false);
                }
            }
        break;
        default:
            if( valor == 0 ){
                sh_error(campo+"_vacio", true);
                return 1;
            }else{
                sh_error(campo+"_vacio", false);
            }
        break;
    }

    return 0;
}

function validar(){
    var errores = 0;
    var r = 0;
    jQuery('#payment-form input').each(function(i, v){
        r = _validar(jQuery(v).attr("id"));
        errores += r;
    });
    
    jQuery('#payment-form select').each(function(i, v){
        errores += _validar(jQuery(v).attr("id"));
    });
    return ( errores == 0 );
}

var MSG_STRYPE = {
    "incorrect_number": "Número de tarjeta invalido",
    "card_declined": "La tarjeta fue declinada",
};























function showTab(n) {
    var x = document.getElementsByClassName("tab-form-fich");
    x[n].style.display = "block";
    if (n == 0) { }else{ }
    if (n == (x.length - 1)) { }else{ }
    fixStepIndicator(n);
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab-form-fich");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab-form-fich");
    y = x[currentTab].getElementsByTagName("input");
    document.getElementsByClassName("m1")[currentTab].className += " finish";
    document.getElementsByClassName("m2")[currentTab].className += " finish";
    return valid;
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("m1");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" m1.active", "");
    }
    x[n].className += " active";
    var i, x = document.getElementsByClassName("m2");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" m2.active", "");
    }
    x[n].className += " active";
}

function selectpaquete(idpaquete){
    var idpaquete=idpaquete;
    var i, x = document.getElementsByClassName("card-credit");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active-credit", "");
    }
    document.getElementById("paq"+ idpaquete).className += " active-credit";
}

function selectmetodo(idmetodo){
    var idmetodo=idmetodo;
    var i, x = document.getElementsByClassName("metod_paid");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active-credit", "");
    }
    document.getElementById("met"+idmetodo).className += " active-credit";
    if (idmetodo=='2') {
        CARRITO["paquete_metodo_pago"] = "Tarjeta";
        jQuery(".metodo_pago").html("Tarjeta");
        document.getElementById("formcard").className += " mostrar";
    }else{
        CARRITO["paquete_metodo_pago"] = "Paypal";
        jQuery(".metodo_pago").html("Paypal");
        document.getElementById("formcard").className =document.getElementById("formcard").className.replace( /(?:^|\s)mostrar(?!\S)/g , '' )
    }
    update_metodo(function(){ });
}

function selectmetodo_2(idmetodo){
    var idmetodo=idmetodo;
    var i, x = document.getElementsByClassName("metod_paid");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active-credit", "");
    }
    document.getElementById("met"+idmetodo).className += " active-credit";
    if (idmetodo=='2') {
        CARRITO["paquete_metodo_pago"] = "Tarjeta";
        jQuery(".metodo_pago").html("Tarjeta");
        document.getElementById("formcard").className += " mostrar";
    }else{
        CARRITO["paquete_metodo_pago"] = "Paypal";
        jQuery(".metodo_pago").html("Paypal");
        document.getElementById("formcard").className =document.getElementById("formcard").className.replace( /(?:^|\s)mostrar(?!\S)/g , '' )
    }
}