<!-- <pre>
    <?php // print_r($p); ?>
</pre> -->
<div class="container">
    <div class="col-md-12 mt-30 creditos">
        <div class="panel p-20">
            <form id="regForm" action="">
                <div class="pasos">
                    <div class="step text-center">
                        <div class="m1">1</div>
                        <p class="m2">Datos Compra</p>
                    </div>

                    <div class="step text-center">
                        <div class="m1">2</div>
                        <p class="m2">Pago</p>
                    </div>

                    <div class="step text-center">
                        <div class="m1">3</div>
                        <p class="m2">Finalizar Pago</p>
                    </div>
                </div>

                <div class="tab-form-fich dest">
                    <h3 class="bold1">Datos de la Compra</h3>
                    <hr>
                    <div class="col-md-12 text-center mb-20"></div>
                    <div class="row slmr0">
                        <div class="col-md-3 mt-20">
                            <img class="img-responsive" src="<?= base_url() ?>files/productos/<?= $p->id_anuncio ?>/<?= $p->img_principal?>" alt="" />
                        </div>
                        <div class="col-md-9">
                            <h5 class="bold1">Resumen de Pedido</h5>
                            <hr class="mb-0">
                            <div class="row fila">
                                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                    <p class="p1 bold1">Tipo</p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1">Compra</p>
                                </div>
                            </div>

                            <div class="row fila">
                                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                    <p class="p1 bold1"><?= $p->titulo ?></p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1"><?= number_format($p->precio_compra, 2, '.', ',') ?>€</p>
                                </div>
                            </div>

                            <div class="row fila">
                                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                    <p class="p1 bold1">Precio Descuento de Puja:</p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1">- <?= number_format($p->precio_puja, 2, '.', ',') ?>€</p>
                                </div>
                            </div>

                            <div class="row fila">
                                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                    <p class="p1 bold1">Envío y Manejo:</p>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <p class="p1">+ <?= number_format($p->precio_envio, 2, '.', ',') ?>€</p>
                                </div>
                            </div>

                            <div class="row fila f2">
                            <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                    <h5 class="bold1">Total a Pagar</h5>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                    <h5 class="bold1"><?= number_format(($p->precio_compra-$p->precio_puja)+$p->precio_envio, 2, '.', ',') ?>€</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-20">   
                        <button class="btn btn-sm" type="button" id="nextBtn" onclick="nextPrev(1)">Selecciona Método de Pago</button>
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
                        <button class="btn btn-sm btn-usar" type="button" id="nextBtn" onclick="nextPrev(-1)">Volver</button>
                        <button class="btn btn-sm" type="button" id="nextBtn" onclick="nextPrev(1)">Confirmar Pago</button>
                    </div>
                </div>

                <div class="tab-form-fich dest">
                    <h3 class="bold1">Confirmar Compra</h3>
                    <hr>
                    <h5 class="bold1">Datos del Pedido</h5>
                    <hr class="mb-0">
                    <div class="col-md-12 text-center mb-20">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-8">
                                    <div class="row fila">
                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                            <p class="p1 bold1">Tipo</p>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                            <p class="p1">Compra</p>
                                        </div>
                                    </div>

                                    <div class="row fila">
                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                            <p class="p1 bold1"><?= $p->titulo ?></p>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                            <p class="p1"><?= number_format($p->precio_compra, 2, '.', ',') ?>€</p>
                                        </div>
                                    </div>

                                    <div class="row fila">
                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                            <p class="p1 bold1">Precio Descuento de Puja:</p>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                            <p class="p1">- <?= number_format($p->precio_puja, 2, '.', ',') ?>€</p>
                                        </div>
                                    </div>

                                    <div class="row fila">
                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                            <p class="p1 bold1">Envío y Manejo:</p>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                            <p class="p1">+ <?= number_format($p->precio_envio, 2, '.', ',') ?>€</p>
                                        </div>
                                    </div>

                                    <div class="row fila f2">
                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                            <h5 class="bold1">Total a Pagar</h5>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                            <h5 class="bold1"><?= number_format(($p->precio_compra-$p->precio_puja)+$p->precio_envio, 2, '.', ',') ?>€</h5>
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
                        <button class="btn btn-sm btn-usar" type="button" id="nextBtn" onclick="nextPrev(-1)">Volver</button>
                        <button class="btn btn-sm" type="button" id="procesarCompra">Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var CARRITO = [];

    CARRITO["user"] = "<?= $_SESSION["user_id"] ?>";
    CARRITO["producto_id"] = "<?= $p->id_anuncio ?>";
    CARRITO["producto_precio"] = "<?= $p->precio_compra ?>";
    CARRITO["producto_puja"] = "<?= $p->precio_puja ?>";
    CARRITO["producto_envio"] = "<?= $p->precio_envio ?>";
    CARRITO["pago"] = "<?= ( ($p->precio_compra-$p->precio_puja)+$p->precio_envio ) ?>";

    jQuery(document).ready(function() {
        jQuery("#regForm").on("submit", function(e){
            e.preventDefault();
        });

        jQuery("#procesarCompra").on("click", function(e){
            comprar_producto();
        });
    });

    function comprar_producto(){
        if( CARRITO["user"] != "" ){
            jQuery.post(
                "<?= base_url() ?>cuenta/procesarCompraProducto",
                {
                    "user_id" : CARRITO["user"],
                    "producto_id" : CARRITO["producto_id"],
                    "producto_precio" : CARRITO["producto_precio"],
                    "producto_puja" : CARRITO["producto_puja"],
                    "producto_envio" : CARRITO["producto_envio"],
                    "pago" : CARRITO["pago"],
                    "paquete_metodo_pago" : CARRITO["paquete_metodo_pago"]
                },
                function(data){
                    alert("Producto Comprado Exitosamente!");
                    location.href = "<?= base_url() ?>cuenta/miscompras";
                }, 'json'
            );
        }else{
          alert("Debe completar todos los pasos primero")
        }
    }


    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        var x = document.getElementsByClassName("tab-form-fich");
        x[n].style.display = "block";
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
    }
</script>