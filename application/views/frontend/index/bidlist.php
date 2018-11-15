<?php $ver = false; ?>
<div class="container splr" style="padding-left: 0;">
    <div class="col-md-12 mt-30 splr">
        <img class="img-responsive" src="<?= base_url()?>public/assets/images/banner2.jpg" alt="">
    </div>
    <div class="col-md-12 mtb-10 splr">
        <div class="alert alert-success" id="success_favoritos" style="display:none;">¡Buenísimo! Ya agendaste en Mis Favoritos la Puja | <a href="<?= base_url('cuenta/favoritos')?>">Ver Favoritos</a></div>
        <div class="alert alert-danger" id="error_favoritos" style="display:none;">Ha ocurrido un error!</div>
        <?php $this->load->view('frontend/templates/filtros_home', [
            "anuncios_usuario" => $anuncios_usuario,
            "status" => $status,
            "orderBy" => $orderBy,
            "way_of_showing" => "list"
        ] ); ?>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 splr"><?php 
        $i = 0; 
        foreach ($premium as $p):
            if( $status != "activa" || time() < strtotime($p['fecha_inicio']) ){
                $p['status'] = "cerrada";
            } ?>
            <div class="panel content-card born2 anuncio_item" 
                data-fichas="<?= $p['cantidad_fichas'] ?>"
                data-tiempo="<?= $p['tiempo_puja'] ?>"
            >
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 plr-2 ctr">
                        <div class="row">
                            <div class="col-md-3 splr text-center">
                                <?php $imagen = ( $p['img_principal'] == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$p['id_anuncio'].'/'.$p['img_principal'] ?>
                                <a class="atitle" href="<?= base_url('anuncio/'.$p['id_anuncio'])?>" title="<?= $p['titulo'] ?>"><img class="imgmin" src="<?= $imagen ?>" alt=""></a>
                            </div>
                            <div class="col-md-1 text-center">
                                <span id="favoritos_span_<?= $p['id_anuncio']?>"><?php
                                    if($this->session->userdata('user_id') != ""){
                                    if( in_array($p['id_anuncio'], $favoritos) ){ ?>
                                        <a href="<?= base_url("cuenta/favoritos"); ?>" onclick="" style="color: #fb9029" target="_blank"><i class="fa fa-heart"></i></a> <?php
                                    }else{ ?>
                                        <a href="javascript:;" onclick="favoritos_listado(<?= $p['id_anuncio']?>)"><i class="fa fa-heart"></i></a> <?php
                                    }
                                }else{
                                    echo '<a href="'.base_url("ingresar").'" onclick="" style="color: #fb9029" target="_blank"><i class="fa fa-heart"></i></a>';
                                } ?>
                                </span>
                            </div>
                            <div class="col-md-8 pt-20">
                                <a class="atitle" href="<?= base_url('anuncio/'.$p['id_anuncio'])?>" title="<?= $p['titulo'] ?>">
                                    <?= applib::titulo(substr($p['titulo'], 0,23))?><?= (strlen($p['titulo']) > 23) ? '...' : '' ?>
                                </a>
                                <p class="mb-0">Tiempo de Subasta <?= $p['tiempo_puja'] ?>s</p> 
                                <div class=" text-right cfichas">
                                    <span>
                                        <?= $p['cantidad_fichas'] ?> x <i class="fa fa-certificate"></i>
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
                                    <h2 class="lbl2"><?= number_format($p['precio_puja'], 2, '.', ',') ?>€</h2>
                                </div>
                                <div class="col-md-4 col-sm-4 tempmin col-xs-6 co1-co2">
                                    <h5 class="timer timerfin">00:00:00</h5>
                                    <?php
                                        if( $p["ult_puja_user"] != "" ){
                                            echo '<h5 class="usuariop">'.$p["ult_puja_user"].'</h5>';
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
                                if( $p["se_compra"] == 1 ){ ?>
                                    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2" >
                                        <h6 class="lbl1">Comprar Ahora</h6>
                                        <h2 class="lbl2"><?= number_format($p['precio_compra']-$p["precio_puja"], 2, '.', ',') ?>€</h2>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-6 co1-co2">
                                        <h5 class="lbl3">El precio disminuye a medida que pujas</h5>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12 co3"> <?php 
                                        if( $this->session->userdata('user_id') != "" ): ?>
                                            <button 
                                                class="btn btnatt producto" 
                                                <?php /*
                                                data-toggle="modal" 
                                                data-target="#info-compra"
                                                */ ?>
                                                data-id="<?= $p['id_anuncio']?>"
                                                data-precio="<?= ($p['precio_compra']) ?>"
                                                data-puja="<?= $p['precio_puja'] ?>"
                                                data-envio="<?= $p['precio_envio'] ?>"
                                                data-titulo="<?= $p['titulo'] ?>"
                                                data-img="<?= $p['id_anuncio'].'/'.$p['img_principal'] ?>"
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
            </div> <?php $i++; 
        endforeach ?>
    </div>

    <?php 
        $this->load->view('frontend/index/home_users', [
            "users" => $users
        ] ); 
    ?>
    
</div>
<script type="text/javascript" src="<?= base_url('public/assets/js/comprar.js?v='.time()) ?>"></script>