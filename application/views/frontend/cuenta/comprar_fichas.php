<!-- <pre>
    <?php
        print_r($prepago);
    ?>
</pre> -->
<div class="container">
    <div class="col-md-12 mt-30 creditos">
        <div class="panel p-20">
            <div class="pasos">
                <div class="step text-center">
                    <div class="m1">1</div>
                    <p class="m2">Cantidad de Pujas</p>
                </div>
                <div class="step text-center">
                    <div class="m1">2</div>
                    <p class="m2">Pago</p>
                </div>
                <div class="step text-center step_3">
                    <div class="m1">3</div>
                    <p class="m2">Comenzar a Pujar</p>
                </div>
            </div>
            <div class="tab-form-fich dest">
                <h3 class="bold1">Selecciona un Paquete de Fichas</h3>
                <hr>
                <div class="col-md-12 text-center mb-20">
                    <div class="row ">
                        <?php
                            foreach ($paquetes as $key => $paquete) {
                                echo '
                                    <div 
                                        id="paq'.$paquete->id.'"
                                        class="col-md-2 col-sm-4 col-xs-12 card-credit borcar paquete_item"  
                                        data-id="'.$paquete->id.'"    
                                        data-name="'.strtoupper($paquete->nombre).'"   
                                        data-precio="'.$paquete->precio.'"    
                                        data-cantidad="'.$paquete->cantidad.'"    
                                    >
                                        <a href="#" onclick="selectpaquete('.$paquete->id.');">
                                            <div class="col-md-6 text-left splr pb-5">
                                                <h6 class="bold1">'.strtoupper($paquete->nombre).'</h6>
                                            </div>
                                            <div class="col-md-6 text-right splr pb-5">
                                                <h6 class="bold1 cg1">'.$paquete->precio.'€</h6>
                                            </div>
                                            <img class="img-responsive" src="'.base_url().'files/fichas/'.$paquete->img.'" alt="">
                                            <p class="p1">'.$paquete->cantidad.' Fichas</p>
                                        </a>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>

                <div class="resumen_pedido hidden">
                    <div class="row slmr0 ">
                        <h5 class="bold1">Resumen del Pedido</h5>
                        <hr class="mb-0">

                        <div class="col-md-8">
                            <div class="row fila">
                                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                    <p class="p1 pedido_name"></p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1 pedido_precio"></p>
                                </div>
                            </div>
                            <!-- fila en caso de cupon de descuento -->
                            <div class="row fila hidden descuento_container">
                                <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                    <p class="p1 descuento"></p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1 descuento_cantidad"></p>
                                </div>
                            </div>
                            <div class="row fila f2">
                                <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                    <h5 class="bold1">Total</h5>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <h5 class="bold1 total_pagar"></h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-20">
                            <div 
                                id="alerta_cupon"
                                style="padding: 1px 10px; position: absolute; bottom: -22px; right: 14px;display: none;" 
                                class="alert alert-danger" 
                                role="alert"
                            > </div>

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Código de Promoción" id="txt_cupon" >
                                <span class="input-group-btn">
                                    <button id="btn_cupon" class="btn btn-usar" type="button">Usar</button>
                                </span>
                            </div>
                            <p class="text-muted newp">Opcional</p>
                        </div>

                    </div>

                    <div class="text-right mt-20">
                        <!-- <input type="hidden" required="" id="idpaquete" name="idpaquete"> -->     
                        <button class="btn btn-sm" type="button" id="nextBtn_1" onclick="initPedido()">
                            Selecciona Método de Pago
                        </button>
                    </div>
                </div>
            </div>

            <div class="tab-form-fich dest">
                <h3 class="bold1">Selecciona un Método de Pago</h3>
                <hr>

                <div class="col-md-12 text-center mb-20">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12  ">
                            <div class="col-md-offset-3 col-md-3 col-sm-6 col-xs-6 metod_paid plr-10 text-center" id="met1" name="met1">
                                <a href="javascript:" onclick="selectmetodo(1);">            
                                    <img class="img-responsive ml-auto" src="<?= base_url()?>public/assets/images/creditos/paypal.png?v1" alt="">
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6 metod_paid plr-10" id="met2" name="met2">
                                <a href="javascript:" onclick="selectmetodo(2);">
                                    <img class="img-responsive ml-auto" src="<?= base_url()?>public/assets/images/creditos/tdc.png?v1" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 formcard ocul" id="formcard">
                            <div class="col-md-offset-3 col-md-6 ">
                                <hr>
                                <form method="post" id="payment-form">
                                    <input type="hidden" id="monto" name="monto" />
                                    <div class="col-md-12" style="padding-bottom: 10px;">
                                        <div class="mb-10 text-left">
                                            <div>
                                                <input id="numero" type="text" class="form-control" placeholder="Número de Tarjeta" data-stripe="number" maxlength="16" required />
                                                <div class="error_form numero_class numero_vacio">Debe ingresar un número de tarjeta</div>
                                                <div class="error_form numero_class numero_valido">Debe ingresar un número de tarjeta válido</div>
                                            </div>
                                            <img class="imgmintdc" src="<?= base_url()?>public/assets/images/creditos/tdc.png?v1" />
                                        </div>
                                        <div class="mb-20 text-left">
                                        <p class="bold1 mb-5" for="">Fecha de Vencimiento</p>
                                            <div class="col-md-3 col-sm-6 col-xs-6 pl-0">
                                                <select id="mes" class="form-control" data-stripe="exp-month">
                                                    <option value="">MM</option><?php
                                                    for ($i=1; $i <= 12; $i++) {
                                                        $_i = ( $i < 10 ) ? "0$i" : $i;
                                                        echo "<option value='$_i'>$_i</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-6 pl-0">
                                                <select id="anio" class="form-control" data-stripe="exp-year">
                                                    <option value="">AA</option><?php
                                                    $min = date("Y")-2000;
                                                    $max = $min+30;
                                                    for ($i=$min; $i < $max; $i++) {
                                                        echo "<option value='$i'>20$i</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                            <div style="clear: both;">
                                                <div class="error_form mes_vacio">Debe seleccionar un mes de vencimiento</div>
                                                <div class="error_form anio_vacio">Debe seleccionar un año de vencimiento</div>
                                                <div class="error_form vencida">La Tarjeta esta vencida no podrá procesarse la compra</div>
                                            </div>
                                        </div>
                                        <div class="mb-20">
                                            <input id="titulo" name="titular" type="text" class="form-control" placeholder="Nombre del titular de la Tarjeta" required="">
                                            <div class="error_form titulo_vacio">Debes ingresar el nombre del titular de la tarjeta</div>
                                        </div>
                                        <div class="mb-20">
                                            <div class="col-md-3 col-sm-3 col-xs-4 pl-0">
                                                <input id="cvv" type="text" class="form-control" placeholder="CVV" data-stripe="cvc" required="">
                                                <div class="error_form cvv_vacio">Debes ingresar el CVV de la tarjeta</div>
                                                <div class="error_form cvv_valido">El CVV debe ser de 3 dígitos</div>
                                            </div>
                                            <div class="col-md-7 col-sm-7 col-xs-8 active-credit p-5 text-left">
                                                <img class="imgmincvv" src="<?= base_url()?>public/assets/images/creditos/cvv.png?v1" alt="">
                                                <span class="font-10">3 dígitos al reverso de la tarjeta</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div 
                                        id="alerta_visa"
                                        style="padding: 10px; display: none; clear: both;" 
                                        class="alert alert-danger" 
                                        role="alert"
                                    > </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="error" class="alert alert-danger hidden" style="margin-bottom: 10px;"> 
                        Debes seleccionar un metodo de pago primero
                    </div>
                </div>
                <div class="text-right mt-20">
                    <!-- <input type="hidden" required="" id="idmethod" name="idmethod"> -->     
                    <button class="btn btn-sm btn-usar" type="button" id="nextBtn_2" onclick="nextPrev(-1)">Volver</button>
                    <button class="btn btn-sm" type="button" id="confirma_metodo_pago">
                        Confirmar Pago
                    </button>
                </div>
            </div>

            <div class="tab-form-fich dest">
                <h3 id="gracias" class="bold1">Confirmar compra</h3>
                <hr>
                <h5 class="bold1">Datos del Pedido</h5>
                <hr class="mb-0">
                <div class="col-md-12 text-center mb-20">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-8">
                                <div class="row fila">
                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                        <p class="p1 pedido_name"></p>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                        <p class="p1 pedido_precio"></p>
                                    </div>
                                </div>
                                <!-- fila en caso de cupon de descuento -->
                                <div class="row fila hidden descuento_container">
                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                        <p class="p1 descuento"></p>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                        <p class="p1 descuento_cantidad"></p>
                                    </div>
                                </div>
                                <div class="row fila f2">
                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                        <h5 class="bold1">Total a Pagar</h5>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                        <h5 class="bold1 total_pagar"></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-20 text-left">
                                <h5 class="bold1">Método de Pago</h5>
                                <p class="metodo_pago"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-20">
                    <button class="btn btn-sm btn-usar" type="button" id="nextBtn_3" onclick="nextPrev(-1)">Volver</button>
                    <button class="btn btn-sm" type="button" id="procesarCompra">Aceptar</button>
                    <button id="perfil_go" class="btn btn-sm hidden" type="button" onclick="location.href = HOME+'perfil/';">Mi perfil</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    form div {
        position: relative;
    }
    .error_form{
        position: absolute;
        bottom: -24px;
        width: 300px;
        left: 0px;
        padding: 2px 10px;
        background: #ff5353;
        color: #FFF;
        font-size: 11px;
        z-index: 9999;
        border-radius: 3px;
        display: none;
        text-align: left;
    }
</style>
<?php
/*    echo "<pre>";
        print_r($_SESSION);
    echo "</pre>";*/
?>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url("public/assets/js/stripe.js") ?>"></script>
<script>

    var currentTab = 0;
    showTab(currentTab);

    var CARRITO = [];
    var HOME = "<?= base_url() ?>";
    var mesActual = "<?= date("m")+0 ?>";
    var anioActual = "<?= date("Y")-2000 ?>";

    CARRITO["user"] = "<?= $_SESSION["user_id"] ?>";
    CARRITO["cupon"] = "";
    CARRITO["paquete_id"] = "";
    CARRITO["paquete_metodo_pago"] = "";
    CARRITO["pedido_id"] = "";

    var stripe = "";

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
        jQuery('#payment-form input').each(function(i, v){
            errores += _validar(jQuery(v).attr("id"));
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

    jQuery(document).ready(function() {

        jQuery("#confirma_metodo_pago").on("click", function(e){

            console.log( CARRITO["paquete_metodo_pago"] );

            if( CARRITO["paquete_metodo_pago"] != "" ){
                jQuery("#error").addClass("hidden");
                if( CARRITO["paquete_metodo_pago"] == "Paypal" ){
                    nextPrev(1);
                }else{
                    if( validar() ){
                        var form = jQuery('#payment-form');
                        Stripe.createToken(form, function(status, response) {

                            console.log(status);
                            console.log(response);

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

        Stripe.setPublishableKey('pk_test_NKNegahMKyQOpa8Z3UfjDfpi');

        jQuery('#payment-form').on('submit', function(e) {
            e.preventDefault();
            if( jQuery("#stripeToken").val() != undefined && jQuery("#stripeToken").val() != "" ){
                jQuery.post(
                    "<?= base_url('Stripe/pagar') ?>",
                    {
                        "monto": jQuery("#monto").val(),
                        "stripeToken": jQuery("#stripeToken").val(),
                        "titular": jQuery("#titulo").val(),
                    },
                    function(data){
                        if( data.status == "succeeded" ){
                            location.href = HOME+"Stripe/fichas_pagadas/"+CARRITO["pedido_id"];
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


        jQuery(".paquete_item").on("click", function(e){
            var precio = jQuery(this).attr("data-precio");
            jQuery(".pedido_name").html( jQuery(this).attr("data-name")+": "+jQuery(this).attr("data-cantidad")+" Fichas" );
            jQuery(".pedido_precio").html( precio+"€");
            jQuery(".resumen_pedido").removeClass("hidden");

            CARRITO["paquete_id"] = jQuery(this).attr("data-id");
            CARRITO["paquete_nombre"] = jQuery(this).attr("data-name");
            CARRITO["paquete_precio"] = jQuery(this).attr("data-precio");
            CARRITO["paquete_cantidad"] = jQuery(this).attr("data-cantidad");

            jQuery(".total_pagar").html( (CARRITO["paquete_precio"])+"€" );
            jQuery("#monto").val( (CARRITO["paquete_precio"]) );

            if( CARRITO["cupon"] != "" ){
                aplicarCupon( CARRITO["cupon"][1] );
            }
        });

        <?php if( $prepago["cupon"] != "" ){ ?>
            CARRITO["cupon"] = eval('<?= json_encode($prepago["cupon"]) ?>');
        <?php } ?>

        <?php if( $prepago["paquete_id"] != "" && $prepago["metodo"] != "" ){ ?>
            CARRITO["pedido_id"] = "<?= $prepago["pedido_id"] ?>";
            CARRITO["paquete_id"] = "<?= $prepago["paquete_id"] ?>";
            CARRITO["paquete_metodo_pago"] = "<?= $prepago["metodo"] ?>";
            selectpaquete(<?= $prepago["paquete_id"] ?>);
            jQuery("#paq<?= $prepago["paquete_id"] ?>").click();
            <?php if( $prepago["status_pago"] == "ok" ){ ?>
                nextPrev(1);
                selectmetodo_2(1);
                nextPrev(1);
                // jQuery(".pasos").css("visibility", "hidden");
                jQuery("#perfil_go").removeClass("hidden");
                jQuery("#nextBtn_3").addClass("hidden");
                jQuery("#procesarCompra").addClass("hidden");
                jQuery(".step_3 .m1, .step_3 .m2").addClass("finish");
                jQuery("#gracias").html("¡Gracias por tu compra!");
            <?php } ?>
        <?php } ?>

        jQuery("#btn_cupon").on("click", function(e){
            var cupon = jQuery("#txt_cupon").val();
            aplicarCupon(cupon);
        });

        jQuery("#regForm").on("submit", function(e){
            e.preventDefault();
        });

        jQuery("#procesarCompra").on("click", function(e){
            comprar_fichas();
        });
    });

    function initPedido(){
        jQuery.post(
            "<?= base_url() ?>cuenta/init_pedido",
            {
                "pedido_id" : CARRITO["pedido_id"],
                "user_id" : CARRITO["user"],
                "cupon" : CARRITO["cupon"],
                "paquete_id" : CARRITO["paquete_id"]
            },
            function(data){
                CARRITO["pedido_id"] = data.pedido_id;
                nextPrev(1);
            }, 'json'
        );
    }

    function update_metodo(){
        jQuery.post(
            "<?= base_url() ?>cuenta/init_pedido",
            {
                "pedido_id" : CARRITO["pedido_id"],
                "user_id" : CARRITO["user"],
                "cupon" : CARRITO["cupon"],
                "paquete_id" : CARRITO["paquete_id"],
                "paquete_metodo_pago" : CARRITO["paquete_metodo_pago"],
            },
            function(data){
                if( CARRITO["paquete_metodo_pago"] == "Paypal" ){
                    // nextPrev(1);
                }
            }, 'json'
        );
    }

    function aplicarCupon(cupon){
        if( String(cupon).trim() == "" ){
            mostrarErrorCupon("Debes ingresar un código de promoción");
        }else{
            if( CARRITO["paquete_precio"] == "" ){
                mostrarErrorCupon("Debes seleccionar un paquete primero");
            }else{
                if( existe_cupon(cupon) ){
                    mostrarErrorCupon("Este cupon ya esta en uso");
                }else{
                    jQuery.post(
                        "<?= base_url() ?>Cuenta/apply_coupon/"+cupon+"/"+CARRITO["paquete_precio"],
                        {},
                        function(data){
                            if( data.error != "" ){
                                mostrarErrorCupon(data.error);
                            }else{
                                quitarErrorCupon();
                                CARRITO["cupon"] = data.descuento;
                                jQuery(".descuento").html(data.descuento[2]+"% de descuento por Cupón: <strong>"+cupon+"</strong>");
                                jQuery(".descuento_cantidad").html("-"+data.descuento[3]+"€");
                                jQuery(".descuento_container").removeClass("hidden");
                                jQuery(".total_pagar").html( (CARRITO["paquete_precio"]-data.descuento[3])+"€" );
                                jQuery("#monto").val( (CARRITO["paquete_precio"]-data.descuento[3]) );
                            }
                        }, 'json'
                    );
                }
            }
        }
    }

    function mostrarErrorCupon(error){
        jQuery("#alerta_cupon").html(error);
        jQuery("#alerta_cupon").show();
    }

    function quitarErrorCupon(){
        jQuery("#alerta_cupon").hide();
    }

    function existe_cupon(cupon){
        if( CARRITO["cupon"] != "" ){
            jQuery.each(CARRITO["cupon"], function(i, v){
                if( v[1] == cupon ){
                    return true;
                }
            });
        }
        return false;
    }

    function showTab(n) {
        var x = document.getElementsByClassName("tab-form-fich");
        x[n].style.display = "block";
        if (n == 0) {
            // document.getElementById("prevBtn").style.display = "none";
        }else{
            // document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            // document.getElementById("nextBtn").innerHTML = "Submit";
        }else{
            // document.getElementById("nextBtn").innerHTML = "Next";
        }
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
            CARRITO["paquete_metodo_pago"] = "Visa";
            jQuery(".metodo_pago").html("Visa");
            document.getElementById("formcard").className += " mostrar";
        }else{
            CARRITO["paquete_metodo_pago"] = "Paypal";
            jQuery(".metodo_pago").html("Paypal");
            document.getElementById("formcard").className =document.getElementById("formcard").className.replace( /(?:^|\s)mostrar(?!\S)/g , '' )
        }
        update_metodo();
    }

    function selectmetodo_2(idmetodo){
        var idmetodo=idmetodo;
        var i, x = document.getElementsByClassName("metod_paid");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active-credit", "");
        }
        document.getElementById("met"+idmetodo).className += " active-credit";
        if (idmetodo=='2') {
            CARRITO["paquete_metodo_pago"] = "Visa";
            jQuery(".metodo_pago").html("Visa");
            document.getElementById("formcard").className += " mostrar";
        }else{
            CARRITO["paquete_metodo_pago"] = "Paypal";
            jQuery(".metodo_pago").html("Paypal");
            document.getElementById("formcard").className =document.getElementById("formcard").className.replace( /(?:^|\s)mostrar(?!\S)/g , '' )
        }
    }

    function comprar_fichas(){
        if( CARRITO["paquete_metodo_pago"] == "Paypal" ){
            location.href = HOME+"paypal/buy_fichas/"+CARRITO["pedido_id"];
        }else{
           jQuery('#payment-form').submit();
        }
    }

</script>

<?php
    $this->session->unset_userdata('paquete_id');
    $this->session->unset_userdata('metodo');
    $this->session->unset_userdata('status_pago');
?>