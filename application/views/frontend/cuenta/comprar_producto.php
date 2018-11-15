<link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/pago_tarjeta.css") ?>">
<?php 
    $puja_ganada = -1;
    $limite = 2*24*60*60; // 2 días
    foreach ($compras as $key => $compra) {
        $tiempo = time()-strtotime($compra->fecha);
        if( $compra->status_compra == "Pendiente" && $compra->operacion == "Puja Ganada" && $p->id_anuncio == $compra->id_anuncio && $tiempo <= $limite ){
            $puja_ganada = $key;
        }
    }
    if( $p->se_compra == 1 || $puja_ganada > -1 ){ ?>
        <div class="container">
            <div class="col-md-12 mt-30 creditos">
                <div class="panel p-20">
                    <div class="pasos">
                        <div class="step text-center">
                            <div class="m1">1</div>
                            <p class="m2">Datos Compra</p>
                        </div>

                        <div class="step text-center">
                            <div class="m1">2</div>
                            <p class="m2">Pago</p>
                        </div>

                        <div id="paso_3" class="step text-center">
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
                                <?php
                                            if( $puja_ganada > -1 ){
                                                $data = json_decode( $compras[$puja_ganada]->data );
                                                echo '
                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Tipo</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">Pago</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">'.$p->titulo.'</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">'.number_format($data->producto_precio, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Precio Puja:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">'.number_format($data->producto_puja, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Envío y Manejo:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">+ '.number_format($data->producto_envio, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila f2">
                                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                                            <h5 class="bold1">Total a Pagar</h5>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <h5 class="bold1">'.number_format( ($data->producto_puja+$data->producto_envio), 2, '.', ',').'€</h5>
                                                        </div>
                                                    </div>
                                                ';
                                            }else{
                                                echo '
                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Tipo</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">Compra
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">'.$p->titulo.'</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">'.number_format($p->precio_compra, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Precio Descuento de Puja:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">- '.number_format($p->precio_puja, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Envío y Manejo:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">+ '.number_format($p->precio_envio, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila f2">
                                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                                            <h5 class="bold1">Total a Pagar</h5>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <h5 class="bold1">'.number_format(($p->precio_compra-$p->precio_puja)+$p->precio_envio, 2, '.', ',').'€</h5>
                                                        </div>
                                                    </div>
                                                ';
                                            }
                                        ?>
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
                                                            $max = $min+10;
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
                        <div class="text-right mt-20" style="clear: both;"> 
                            <button class="btn btn-sm btn-usar" type="button" id="nextBtn" onclick="nextPrev(-1)">Volver</button>
                            <button class="btn btn-sm" type="button" id="confirma_metodo_pago">
                                Confirmar Pago
                            </button>
                        </div>
                    </div>

                    <div class="tab-form-fich dest">
                        <h3 id="titulo" class="bold1">Confirmar Compra</h3>
                        <hr>
                        <h5 class="bold1">Datos del Pedido</h5>
                        <hr class="mb-0">
                        <div class="col-md-12 text-center mb-20">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-8">
                                        <?php
                                            if( $puja_ganada > -1 ){
                                                $data = json_decode( $compras[$puja_ganada]->data );
                                                echo '
                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Tipo</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">Pago</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">'.$p->titulo.'</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">'.number_format($data->producto_precio, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Precio Puja:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">'.number_format($data->producto_puja, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Envío y Manejo:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">+ '.number_format($data->producto_envio, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila f2">
                                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                                            <h5 class="bold1">Total a Pagar</h5>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <h5 class="bold1">'.number_format( ($data->producto_puja+$data->producto_envio), 2, '.', ',').'€</h5>
                                                        </div>
                                                    </div>
                                                ';
                                            }else{
                                                echo '
                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Tipo</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">Compra
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">'.$p->titulo.'</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">'.number_format($p->precio_compra, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Precio Descuento de Puja:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">- '.number_format($p->precio_puja, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila">
                                                        <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                                                            <p class="p1 bold1">Envío y Manejo:</p>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <p class="p1">+ '.number_format($p->precio_envio, 2, '.', ',').'€</p>
                                                        </div>
                                                    </div>

                                                    <div class="row fila f2">
                                                    <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                                                            <h5 class="bold1">Total a Pagar</h5>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                                                            <h5 class="bold1">'.number_format(($p->precio_compra-$p->precio_puja)+$p->precio_envio, 2, '.', ',').'€</h5>
                                                        </div>
                                                    </div>
                                                ';
                                            }
                                        ?>
                                    </div>

                                    <div class="col-md-4 mt-20 text-left">
                                        <h5 class="bold1">Método de Pago</h5>
                                        <p class="metodo_pago"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-20">
                            <button class="btn btn-sm btn-usar" type="button" id="nextBtn_paso_3" onclick="nextPrev(-1)">Volver</button>
                            <button class="btn btn-sm" type="button" id="procesarCompra">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?= base_url("public/assets/js/stripe.js") ?>"></script>
        <script src="<?= base_url("public/assets/js/pago_tarjeta.js") ?>"></script>

        <script>

            var currentTab = 0;
            showTab(currentTab);

            var mesActual = "<?= date("m")+0 ?>";
            var anioActual = "<?= date("Y")-2000 ?>";
            var CARRITO = [];
            var SECCION = "buy_producto";
            var PROCESO_STRIPE = "producto_pagado";

            CARRITO["user"] = "<?= $_SESSION["user_id"] ?>";
            CARRITO["producto_id"] = "<?= $p->id_anuncio ?>";
            CARRITO["producto_precio"] = "<?= $p->precio_compra ?>";
            CARRITO["producto_puja"] = "<?= $p->precio_puja ?>";
            CARRITO["producto_envio"] = "<?= $p->precio_envio ?>";
            CARRITO["pago"] = "<?= ( ($p->precio_compra-$p->precio_puja)+$p->precio_envio ) ?>";
            CARRITO["paquete_metodo_pago"] = "";
            CARRITO["puja_ganada"] = parseInt("<?= $puja_ganada ?>");
            CARRITO["pedido_id"] = parseInt("<?= ( $puja_ganada > -1 ) ? $compras[$puja_ganada]->id : 0 ?>");
            CARRITO["operacion"] = "<?= ( $puja_ganada > -1 ) ? 'Puja Ganada' : 'Compra' ?>";

            jQuery(document).ready(function() {
                jQuery("#regForm").on("submit", function(e){ e.preventDefault(); });
                jQuery("#procesarCompra").on("click", function(e){ comprar_producto(); });

                jQuery("#monto").val( CARRITO["pago"] );

                <?php
                    if( $prepago["pedido_id"] != "" ){
                        if( $prepago["metodo"] == "paypal"){
                            echo 'jQuery(".metodo_pago").html("Paypal");';
                        }else{
                            echo 'jQuery(".metodo_pago").html("Visa");';
                        }
                        echo '
                            nextPrev(1);
                            nextPrev(1);
                            jQuery("#paso_3 .m1, #paso_3 .m2").addClass("finish");
                            jQuery("#nextBtn_paso_3").addClass("hidden");
                            jQuery("#procesarCompra").html("Mis Compras");
                            jQuery("#titulo").html("¡Gracias por tu Compra!");
                        ';
                    }
                ?>
            });

            function procesar_compra(){
                if( CARRITO["paquete_metodo_pago"] == "Paypal" ){
                    location.href = HOME+"paypal/"+SECCION+"/"+CARRITO["pedido_id"];
                }else{
                   jQuery('#payment-form').submit();
                }
            }

            function comprar_producto(){ <?php
                if( $prepago["pedido_id"] == "" ){ ?>
                    if( CARRITO["paquete_metodo_pago"] != "" ){
                        if( CARRITO["pedido_id"] == 0 ){
                            jQuery.post(
                                "<?= base_url() ?>cuenta/procesarCompraProducto", {
                                    "user_id" : CARRITO["user"],
                                    "producto_id" : CARRITO["producto_id"],
                                    "producto_precio" : CARRITO["producto_precio"],
                                    "producto_puja" : CARRITO["producto_puja"],
                                    "producto_envio" : CARRITO["producto_envio"],
                                    "pago" : CARRITO["pago"],
                                    "operacion" : CARRITO["operacion"],
                                    "paquete_metodo_pago" : CARRITO["paquete_metodo_pago"]
                                },
                                function(data){
                                    CARRITO["pedido_id"] = data.pedido_id;
                                    procesar_compra();
                                }, 'json'
                            );
                        }else{
                            procesar_compra();
                        }
                    } <?php
                }else{ ?>
                    location.href = HOME+"cuenta/miscompras"; <?php
                } ?>
            }

            function confirmar_pago(){
                if( CARRITO["paquete_metodo_pago"] != "" ){
                    jQuery("#error").addClass("hidden");
                    nextPrev(1);
                }else{
                    jQuery("#error").removeClass("hidden");
                }
            }

            function update_metodo(){
                
            }
        </script> <?php 
    }else{ ?>
        <div class="container">
            <div class="col-md-12 mt-30 creditos">
                <div class="panel p-20">
                    <h1>Este producto no puede ser comprado.</h1>
                </div>
            </div>
        </div> <?php 
    } 

    $this->session->unset_userdata('pedido_id');
    $this->session->unset_userdata('producto_id');
    $this->session->unset_userdata('metodo');
    $this->session->unset_userdata('status_pago');
?>