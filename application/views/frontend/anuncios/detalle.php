<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.9"; 
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<style>
    .navegar_filtro {
        color: grey;
        text-align: left;
        margin-top: -15px;
    }
</style>

<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <!--  <p class="navegar_filtro">Estás en: <a href="<?= base_url('anuncios/'.$anuncio['cat_seo'])?>" title="<?= $anuncio['categoria'] ?>"><?= $anuncio['categoria'] ?></a> | <a href="<?= base_url('anuncios/'.$anuncio['cat_seo'].'/'.$anuncio['subcat_seo'])?>" title="<?= $anuncio['subcategoria'] ?>"><?= $anuncio['subcategoria'] ?></a></p> -->
            <div class="row row-rl-10 row-tb-20">
                <h1 class="mb-10 mt-30 h3">
                    <strong>
                        <?= ucfirst(strtolower($anuncio['titulo'])) ?>
                    </strong>
               </h1>
                <div class="page-content col-md-6 col-xs-12 col-sm-6 " style="padding-right: 5px; padding-left: 0;">
                    <div class="row row-tb-20">
                        <div class="col-xs-12">
                            <?= $this->session->flashdata('msg')?>
                            <div class="alert alert-success" id="success_favoritos" style="display:none;">¡Buenísimo! Ya agendaste en Mis Favoritos la Puja | <a href="<?= base_url('cuenta/favoritos')?>">Ver Favoritos</a></div>
                            <div class="alert alert-danger" id="error_favoritos" style="display:none;">Ha ocurrido un error!</div>
                            <div class="deal-deatails panel">
                                <div class="text-right p-20" >
                                    <span id="favoritos_span_<?= $anuncio['id_anuncio']?>"><?php
                                        if( $favoritos == "YES" ){ ?>
                                            <a href="http://localhost/pujasya/cuenta/favoritos" onclick="" style="color: #fb9029" target="_blank"><i class="fa fa-heart" style="font-size:30px;"></i></a> <?php
                                        }else{ ?>
                                            <a href="javascript:;" onclick="favoritos_listado(<?= $anuncio['id_anuncio']?>)"><i class="fa fa-heart" style="font-size:30px;"></i></a> <?php
                                        } ?>
                                    </span>
                                </div>
                                <div class="deal-slider">
                                    <div id="product_slider" class="flexslider">
                                        <ul class="slides">
                                            <?php 
                                                $imagenes = json_decode( $anuncio['imgs'] );
                                                if(count($imagenes) > 0):
                                                    foreach ($imagenes as $img): 
                                                        $imagen = ( $img == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$anuncio['id_anuncio'].'/'.$img ?>
                                                        <li style="background-image: url(<?= $imagen ?>);height: 522px; background-position: center;background-repeat: no-repeat;background-size: contain;"></li><?php 
                                                    endforeach; 
                                                else:
                                                    $imagen = base_url().'public/uploads/anuncios/thumb/no-image.jpg' ?>
                                                    <li style="background-image: url(<?= $imagen ?>);height: 522px; background-position: center;background-repeat: no-repeat;background-size: contain;"></li><?php 
                                                endif 
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="text-right p-20" >
                                        <span id="favoritos_span_" style="font-size: 30px; font-weight: 700;">
                                            <?= $anuncio['cantidad_fichas'] ?> x <i class="fa fa-certificate"></i>
                                        </span>
                                    </div>
                                    <div id="product_slider_nav" class="flexslider flexslider-nav">
                                        <ul class="slides">
                                            <?php 
                                                if(count($imagenes) > 0):
                                                    foreach ($imagenes as $img): 
                                                        $imagen = base_url().'files/productos/'.$anuncio['id_anuncio'].'/'.$img ?>
                                                        <li style="background-image: url(<?= $imagen ?>);background-size:contain; background-position: center;background-repeat: no-repeat;height:188.25px;width: 188.25px !important;background-size:cover;"></li><?php 
                                                    endforeach; 
                                                endif 
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-sidebar col-md-6 col-sm-6 col-xs-12" style="padding-right: 0px; padding-left: 5px; padding-bottom:5px;">
                    <aside class="sidebar blog-sidebar">
                        <div class="row row-tb-10">
                            <div class="col-xs-12">
                                <div class="widget single-deal-widget panel ptb-20 prl-20">
                                    <div class="widget-body text-center">
                                        <div class="bg-white pt-10 pl-5 pr-5 text-center content-card">
                                            <div class="well">
                                                <div class="row" style="">
                                                    <div class="col-md-3 col-sm-3 col-xs-6 co1-co2">
                                                        <h6 class="lbl1">Precio de Puja</h6>
                                                        <h2 class="lbl2"><?= number_format($anuncio['precio_puja'], 2, '.', ',') ?>€</h2>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6 co1-co2">
                                                        <h5 class="timer timerfin">00:00:00</h5>
                                                        <?php
                                                            if( $anuncio["ult_puja_user"] != "" ){
                                                                echo '<h5 class="usuariop">'.$anuncio["ult_puja_user"].'</h5>';
                                                            }
                                                        ?> 
                                                    </div>
                                                    <div class="col-md-1 col-sm-1 col-xs-4 co4" >
                                                        <button class="btn btnatt2" >
                                                        <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/a-circle.png?v0" alt=""></button>
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-8 co3">
                                                        <button class="btn btnatt">
                                                            <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/mazo.png?v0" alt="">
                                                            PUJAR
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="well">
                                                <div class="row"> <?php 
                                                    if( $anuncio["se_compra"] == 1 ){ ?>
                                                        <div class="col-md-4 col-sm-4 col-xs-6 co1-co2" >
                                                            <h6 class="lbl1">Comprar Ahora</h6>
                                                            <h2 class="lbl2"><?= number_format($anuncio['precio_compra']-$anuncio["precio_puja"], 2, '.', ',') ?>€</h2>
                                                        </div>
                                                        <div class="col-md-5 col-sm-5 col-xs-6 co1-co2">
                                                            <h5 class="lbl3">El precio disminuye a medida que pujas</h5>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-12 co3"> <?php 
                                                            if( $this->session->userdata('user_id') != "" ): ?>
                                                                <button 
                                                                    class="btn btnatt producto" 
                                                                    data-id="<?= $anuncio['id_anuncio']?>"
                                                                    data-precio="<?= ($anuncio['precio_compra']) ?>"
                                                                    data-puja="<?= $anuncio['precio_puja'] ?>"
                                                                    data-envio="<?= $anuncio['precio_envio'] ?>"
                                                                    data-titulo="<?= $anuncio['titulo'] ?>"
                                                                    data-img="<?= $anuncio['id_anuncio'].'/'.$anuncio['img_principal'] ?>"
                                                                >
                                                                    <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                                    COMPRAR
                                                                </button> <?php 
                                                            else: ?>
                                                                <button class="btn btnatt" onclick="window.location='<?= base_url('ingresar')?>'">
                                                                    <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                                    COMPRAR
                                                                </button> <?php 
                                                            endif ?>
                                                        </div> <?php 
                                                    }else{ ?>
                                                        <div class="col-md-9 col-sm-5 col-xs-6 co1-co2">
                                                            <h5 class="lbl3">Compra no disponible</h5>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-12 co3"> <?php 
                                                            $activa_compra = "btn-inact";
                                                            if( $this->session->userdata('user_id') != "" ): ?>
                                                                <button class="btn btnatt <?= $activa_compra ?>">
                                                                    <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                                    COMPRAR
                                                                </button> <?php 
                                                            else: ?>
                                                                <button class="btn btnatt <?= $activa_compra ?>" onclick="window.location='<?= base_url('ingresar')?>'">
                                                                    <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                                    COMPRAR
                                                                </button> <?php 
                                                            endif ?>
                                                        </div> <?php 
                                                    } ?>
                                                </div>
                                            </div>
                                        </div> <!-- fin widget-body -->
                                    </div> <!-- col12 -->
                                </div> <!-- row-tb -->
                            </div> <!-- page sidebar -->
                        </div>
                    </aside>
                </div>

                <div class="page-sidebar col-md-6 col-sm-12 col-xs-12" style="padding-right: 0px; padding-left: 5px; padding-top:0;">
                    <aside class="sidebar blog-sidebar">
                        <div class="row row-tb-10">
                            <div class="col-xs-12">
                                <div class="widget single-deal-widget panel ptb-20 prl-20">
                                    <div class="widget-body text-center">
                                        <div class="bg-white pt-10 pl-5 pr-5 text-center">
                                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                                <li role="presentation"  ><a style="border: 1px solid #2f2f2f2f;border-radius: 0;padding-left: 5px;padding-right: 5px;" href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab">Información de la Puja</a></li>
                                                <li role="presentation" class="active"><a style="border: 1px solid #2f2f2f2f;border-radius: 0;padding-left: 5px;padding-right: 5px;" href="#historial" aria-controls="historial" role="tab" data-toggle="tab">Historial de Pujas</a></li>
                                                <li role="presentation" ><a style="border: 1px solid #2f2f2f2f;border-radius: 0;padding-left: 5px;padding-right: 5px;" href="#envio" aria-controls="envio" role="tab" data-toggle="tab">Información de Envío</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade " id="informacion">

                                                    <!--  <div class="text-left mt-20 pl-15">
                                                    ​<a href=""><img style="width: 40px; margin-right: 10px;" src="https://bids.jbosolutions.com/public/assets/images/icons/child.png?v0" alt=""></a>
                                                    <a href=""><img style="width: 40px; margin-right: 10px;" src="https://bids.jbosolutions.com/public/assets/images/icons/clock.png?v0" alt=""></a>
                                                    <a href="">​<img style="width: 40px;" src="https://bids.jbosolutions.com/public/assets/images/icons/reload.png?v0" alt=""></a>
                                                    </div> -->

                                                    <div class="mt-30">
                                                        <div class="row rsinmlf fila">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left">PRR (Precio Recomendado Reventa)</h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right" style="font-weight: 700;"><?= number_format($anuncio['precio_reventa'], 2, '.', ',') ?>€</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row rsinmlf fila hidden">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left">Horas de Puja<a style="font-size: 10px; margin-left: 11px; color: orange;" data-toggle="modal" href="" data-target="#info-subasta">Más Información</a></h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right"><?= applib::horas($anuncio['inicio'], $anuncio['cierre']) ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row rsinmlf fila" style="border-bottom: 0;">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left">Tiempo de Puja</h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right"><?= $anuncio['tiempo_puja'] ?>s</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row rsinmlf fila" style="border-bottom: 0;">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left">Precio Máximo</h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right"><?= number_format($anuncio['precio_maximo'], 2, '.', ',') ?>€</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-40">
                                                        <div class="row rsinmlf fila">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left">Precio de Puja</h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right" style="font-weight: 700;"><?= number_format($anuncio['precio_puja'], 2, '.', ',') ?>€</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row rsinmlf fila">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left">Costos de Manejo y Envío</h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right"><?= number_format($anuncio['precio_envio'], 2, '.', ',') ?>€</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row rsinmlf fila" style="border-bottom: 0;">
                                                            <div class="col-md-8 col-xs-6">
                                                                <h5 class="text-left" style="font-weight: 700; ">Total a Pagar</h5>
                                                            </div>
                                                            <div class="col-md-4 col-xs-6">
                                                                <h5 class="text-right" style="font-weight: 700;"><?= number_format( ( ( $anuncio['precio_compra']-$anuncio['precio_puja'])+$anuncio['precio_envio'] ), 2, '.', ',') ?>€</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-40 text-left" style="margin-left: 20px;">
                                                        <ul style="list-style-type: disc; font-style: italic;font-weight: 700;">
                                                            <li>Esta es una Puja Internacional</li>
                                                            <li>Las imagenes son unicamente a modo de ilustración</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade in active" id="historial">
                                                    <div class="mt-30">
                                                        <div class="row encabezado rsinmlf">
                                                            <div class="col-md-7 col-xs-7">
                                                                <h5 class=" text-left">Usuario</h5>
                                                            </div>
                                                            <div class="col-md-5 col-xs-5">
                                                                <h5 class="text-right">Cantidad</h5>
                                                            </div>
                                                        </div><?php
                                                        if( count($historial) > 0 ){
                                                            foreach ($historial as $key => $value) {
                                                                echo '
                                                                    <div class="row encabezado rsinmlf">
                                                                        <div class="col-md-7 col-xs-7">
                                                                            <h5 class=" text-left">'.$value->nombre.'</h5>
                                                                        </div>
                                                                        <div class="col-md-5 col-xs-5">
                                                                            <h5 class="text-right">'.$value->monto.'</h5>
                                                                        </div>
                                                                    </div>
                                                                ';
                                                            }
                                                        } ?>

                                                        <!-- <div class="row fila rsinmlf">
                                                            <div class="col-md-7 col-xs-7">
                                                                <h5 class="text-left">Julian</h5>
                                                            </div>
                                                            <div class="col-md-5 col-xs-5">
                                                                <h5 class=" text-right">$20</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row fila rsinmlf">
                                                            <div class="col-md-7 col-xs-7">
                                                                <h5 class="text-left">Julian</h5>
                                                            </div>
                                                            <div class="col-md-5 col-xs-5">
                                                                <h5 class=" text-right">$20</h5>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade mt-30 text-justify" id="envio">
                                                    <p class="mb-10">Este artículo generalmente se envía dentro de las 4 a 3 semanas de pago recibido y el pedido se realiza directamente a proveedores de la España.</p>
                                                    <p class="mb-10">Si el producto entregado está defectuoso, puede devolverlo al proveedor.</p>
                                                    <p>Por favor, consulte nuestra página de <a style="color: orange;" href="<?= base_url('preguntas_frecuentes')?>">Preguntas Frecuentes</a> para más detalles.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- fin widget-body -->
                            </div> <!-- col12 -->
                        </div> <!-- row-tb -->
                    </aside>
                </div> <!-- page sidebar -->

                <div class="page-sidebar col-md-12 col-sm-12 col-xs-12" style="padding-right: 0px; padding-left: 5px; padding-bottom:5px;">
                    <aside class="sidebar blog-sidebar">
                        <div class="row row-tb-10">
                            <div class="col-xs-12">
                                <div class="widget single-deal-widget panel ptb-20 prl-20">
                                    <div class="widget-body">
                                        <div class="bg-white pt-10 pl-5 pr-5  text-justify">
                                            <h5 class="bold1 mb-10">Descripcion del Producto</h5>
                                            <h4 class="bold1 mb-10"><?= $anuncio['titulo']?></h4>
                                            <p class="p16"><?= $anuncio['descripcion']?></p>
                                        </div>
                                    </div> <!-- fin widget-body -->
                                </div> <!-- col12 -->
                            </div> <!-- row-tb -->
                        </div> <!-- page sidebar -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->


<div class="modal fade" id="info-subasta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title bold1">Horario de Puja</h4>
      </div>
      <div class="modal-body text-justify mt-20">
        <h4 style="margin-bottom: 10px;">Esta Puja tiene una Hora de Inicio a partir de las <strong>12:30m</strong> y hora de Cierre a las <strong>6:30pm</strong> horario de España</h4>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-inact" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?= base_url('public/assets/js/comprar.js?v='.time()) ?>"></script>