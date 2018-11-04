<!-- <pre>
    <?php
        print_r($prepago);
    ?>
</pre> -->
<div class="container">
    <div class="col-md-12 mt-30 creditos">
        <div class="panel p-20">
            <form id="regForm" action="">
                <div class="pasos">
                    <div class="step text-center">
                        <div class="m1">1</div>
                        <p class="m2">Cantidad de Pujas</p>
                    </div>
                    <div class="step text-center">
                        <div class="m1">2</div>
                        <p class="m2">Pago</p>
                    </div>
                    <div class="step text-center">
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

                    <div class="row slmr0 hidden resumen_pedido">
                        <h5 class="bold1">Resumen del Pedido</h5>
                        <hr class="mb-0">

                        <div class="col-md-8">
                            <div class="row fila">
                                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                    <p class="p1 pedido_name">X-SMALL: 100 Fichas</p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1 pedido_precio">10€</p>
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
                        <button class="btn btn-sm" type="button" id="nextBtn" onclick="initPedido()">
                            Selecciona Método de Pago
                        </button>
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
                                    <div class="col-md-12">
                                        <div class="mb-10 text-left">
                                            <input type="text" class="form-control" placeholder="Número de Tarjeta" required="">
                                            <img class="imgmintdc" src="<?= base_url()?>public/assets/images/creditos/tdc.png?v1" alt="">
                                        </div>
                                        <div class="mb-20 text-left">
                                        <p class="bold1 mb-5" for="">Fecha de Vencimiento</p>
                                            <div class="col-md-3 col-sm-6 col-xs-6 pl-0 mb-10">
                                                <select class="form-control">
                                                    <option value="">MM</option>
                                                    <option value="">06</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-6 pl-0 mb-20">
                                                <select class="form-control">
                                                    <option value="">AA</option>
                                                    <option value="">1985</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-20">
                                            <input type="text" class="form-control" placeholder="Nombre del titular de la Tarjeta" required="">
                                        </div>
                                        <div class="mb-20">
                                            <div class="col-md-3 col-sm-3 col-xs-4 pl-0">
                                                <input type="text" class="form-control" placeholder="CVV" required="">
                                            </div>
                                            <div class="col-md-7 col-sm-7 col-xs-8 active-credit p-5 text-left">
                                                <img class="imgmincvv" src="<?= base_url()?>public/assets/images/creditos/cvv.png?v1" alt="">
                                                <span class="font-10">3 digitos al reverso de la tarjeta</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-20">
                        <!-- <input type="hidden" required="" id="idmethod" name="idmethod"> -->     
                        <button class="btn btn-sm btn-usar" type="button" id="nextBtn" onclick="nextPrev(-1)">Volver</button>
                        <button class="btn btn-sm hidden" type="button" id="nextBtn" onclick="nextPrev(1)">
                            Confirmar Pago
                        </button>
                    </div>
                </div>

                <div class="tab-form-fich dest">
                    <h3 class="bold1">¡Gracias por tu compra!</h3>
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
                        <button class="btn btn-sm" type="button" id="procesarCompra">Mis fichas</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
/*    echo "<pre>";
        print_r($_SESSION);
    echo "</pre>";*/
?>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script>

    var currentTab = 0;
    showTab(currentTab);

    var CARRITO = [];
    var HOME = "<?= base_url() ?>";

    CARRITO["user"] = "<?= $_SESSION["user_id"] ?>";
    CARRITO["cupon"] = "";
    CARRITO["paquete_id"] = "";
    CARRITO["paquete_metodo_pago"] = "";
    CARRITO["pedido_id"] = "";

    jQuery(document).ready(function() {
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
                jQuery(".pasos").css("visibility", "hidden")
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
                    location.href = HOME+"paypal/buy_fichas/"+CARRITO["pedido_id"];
                }
            }, 'json'
        );
    }

    function aplicarCupon(cupon){
        if( String(cupon).trim() == "" ){
            alert("Debes ingresar un código de promoción");
        }else{
            if( CARRITO["paquete_precio"] == "" ){
                alert("Debes seleccionar un paquete primero");
            }else{
                if( existe_cupon(cupon) ){
                    alert("Este cupon ya esta en uso");
                }else{
                    jQuery.post(
                        "<?= base_url() ?>Cuenta/apply_coupon/"+cupon+"/"+CARRITO["paquete_precio"],
                        {},
                        function(data){
                            if( data.error != "" ){
                                alert(data.error);
                            }else{
                                CARRITO["cupon"] = data.descuento;
                                jQuery(".descuento").html(data.descuento[2]+"% de descuento por Cupón: <strong>"+cupon+"</strong>");
                                jQuery(".descuento_cantidad").html("-"+data.descuento[3]+"€");
                                jQuery(".descuento_container").removeClass("hidden");
                                jQuery(".total_pagar").html( (CARRITO["paquete_precio"]-data.descuento[3])+"€" );
                            }
                        }, 'json'
                    );
                }
            }
        }
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
        if( CARRITO["user"] != "" && CARRITO["paquete_id"] != "" && CARRITO["paquete_metodo_pago"] != "" ){
            location.href = "<?= base_url() ?>perfil/";
        }else{
            alert("Debe completar todos los pasos primero")
        }
    }

</script>

<?php
    $this->session->unset_userdata('paquete_id');
    $this->session->unset_userdata('metodo');
    $this->session->unset_userdata('status_pago');
?>