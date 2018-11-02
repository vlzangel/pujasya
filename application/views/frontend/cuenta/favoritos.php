<main id="mainContent" class="main-content">
    <div class="page-container ptb-20">
        <div class="container">
            <section class="wishlist-area ptb-30" style="   margin-bottom: 70px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 hidden-sm hidden-xs splr">
                            <div class="list-group">
                                <a href="<?= base_url('perfil')?>" class="list-group-item "> Mi Perfil </a>
                                <a href="<?= base_url('cuenta/favoritos')?>" class="list-group-item active activelist">Mis Favoritos</a>
                                <a href="<?= base_url('cuenta/mispujas')?>" class="list-group-item">Mis Pujas</a>
                                <a href="<?= base_url('cuenta/misautopujas')?>" class="list-group-item">Mis Autopujas</a>
                                <a href="<?= base_url('cuenta/miscompras')?>" class="list-group-item">Mis Compras</a>
                                <a href="javascript:;" onclick="cancelarcuenta(<?= $user['id']?>)" class="list-group-item">Cancelar Cuenta</a>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <div class="wishlist-wrapper">
                                <h3 class="h-title mb-40 t-uppercase">MIS PUJAS FAVORITAS</h3>
                                <h4 class="panel t-uppercase" style="margin-bottom: 13px; padding: 12px; font-size: 13px; font-weight: bold;">Mirá o Borra Pujas de tu lista de favoritos.</h4>
                                <?= $this->session->userdata('msg')?>
                                <?php if(count($anuncios) > 0):
                                    foreach ($anuncios as $anuncio) { 
                                        $imagen = ( $anuncio["img_principal"] == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$anuncio["id_anuncio"].'/'.$anuncio["img_principal"]; ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12 splr">
                                            <div class="panel content-card born2">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-xs-12 plr-2 ctr">
                                                        <div class="row">
                                                            <div class="col-md-2 splr text-center">
                                                                <img class="imgmin2" src="<?= $imagen ?>" alt="">
                                                            </div>
                                                            <div class="col-md-1 text-center">
                                                                <span id="favoritos_span_">
                                                                    <a href="javascript:;" onclick="eliminar(<?= $anuncio['id_anuncio'] ?>)"><i class="fa fa-close"></i></a>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-9 pt-20">
                                                                <a class="atitle" href="<?= base_url()?>" title=""><?= $anuncio["titulo"] ?></a>
                                                                <p class="mb-0">Tiempo de Subasta <?= $anuncio['tiempo_puja'] ?>s</p> 
                                                                <div class=" text-right cfichas">
                                                                    <span>
                                                                        <?= $anuncio['cantidad_fichas'] ?> x <i class="fa fa-certificate"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-4 col-xs-12 plr-2">
                                                        <div class="well well2 text-center">
                                                            <div class="row" style="">
                                                                <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
                                                                    <h6 class="lbl1">Precio de Puja</h6>
                                                                    <h2 class="lbl2"><?= number_format($anuncio['precio_puja'], 2, '.', ',') ?>€</h2>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 tempmin col-xs-6 co1-co2">
                                                                    <h5 class="timer timerfin">00:00:00</h5>
                                                                    <?php
                                                                        if( $anuncio["ult_puja_user"] != "" ){
                                                                            echo '<h5 class="usuariop">'.$anuncio["ult_puja_user"].'</h5>';
                                                                        }
                                                                    ?>  
                                                                </div>
                                                                <div class="col-md-1 col-sm-1 col-xs-4 co4" >
                                                                    <button class="btn btnatt2" >
                                                                    <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/a-circle.png?v0" alt=""></button>
                                                                </div>
                                                                <div class="col-md-3 col-sm-3 col-xs-8 co3">
                                                                    <button class="btn btnatt">
                                                                        <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/mazo.png?v0" alt="">
                                                                        PUJAR
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-4 col-xs-12 plr-2">
                                                        <div class="well well2 text-center">
                                                            
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <?php 
                                    }
                                else: ?>
                                    <p style="text-align: left; font-weight: 100; margin-top: 40px; background-color: white; padding: 120px;">NO GUARDASTE NINGÚN FAVORITO - Para guardar en Favoritos, lo puedes hacer con el ícono <i class="fa fa-heart-o" style="font-weight: bold; margin-right: 6px; margin-left: 4px; font-size: 15px;"></i>en el detalle y listado de cada puja.</p><?php 
                                endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <form id="form_del" method="POST">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Borrar Puja</h4>
                    <div class="modal-body">
                        <p>¿Estás seguro que quieres eliminar esta puja de tu lista de favoritos?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_eliminar" name="anuncio_id">
                        <button type="submit" class="btn btn-primary" >Eliminar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No,Gracias</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function eliminar(id){
        jQuery('#form_del').attr("action", "<?= base_url('cuenta/borrar_anuncio_favoritos')?>/"+id);
        jQuery('#eliminar').modal('show');
    }
</script>
<script type="text/javascript" src="<?= base_url('public/assets/js/comprar.js?v='.time()) ?>"></script>