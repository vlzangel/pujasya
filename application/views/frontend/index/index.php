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
            "way_of_showing" => "grid"
        ] ); ?>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 splr "> <?php 
        $i = 0; 
        foreach ($premium as $p): ?>
            <div class="col-md-4 col-sm-6 col-xs-12 mb-20 plr-5">
                <div class="deal-single panel born2"> <?php 
                    $imagen = ( $p['imagen'] == NULL ) ? 'no-image.jpg' : $p['imagen'] ?>
                    <ul class="deal-actions top-15 right-20">
                        <li class="like-deal">
                            <span id="favoritos_span_<?= $p['id_anuncio']?>">
                                <a href="javascript:;" onclick="favoritos_listado(<?= $p['id_anuncio']?>)"><i class="fa fa-heart"></i></a>
                            </span>
                        </li>
                    </ul>
                    <h3 class="deal-title mb-10" style="width: 102%;text-align: center; padding: 20px;">
                        <a style="font-size: 18px; font-weight: bold;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 15px;">
                            <?= applib::titulo(substr($p['titulo'], 0,23))?><?= (strlen($p['titulo']) > 23)?'...':''?>
                        </a>
                    </h3>
                    <h4 class="deal-title mb-10" style="width: 102%;text-align: center; margin-top: -27px;">
                        <a style="font-size: 13px;font-weight: 300;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 12px;">
                            PRR  (Precio Recomendado Reventa) 1200€
                        </a>
                    </h4>
                    <a href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>">
                        <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" id="<?= $p['seo']?>"  data-bg-img="<?= base_url()?>public/uploads/anuncios/thumb/<?= $imagen?>" style="height:262px">
                            <div class="deal-store-logo">
                                <h4 style="font-weight: bold;">
                                    MAX 200.00
                                    <span style="font-size:14px">€</span>
                                </h4>
                            </div>
                            <div class="deal-store-logo pr-20" style="background-color: transparent; right: 0; width: auto;">
                                <span id="favoritos_span_" style="font-size: 20px; font-weight: 800; -webkit-text-fill-color: black; -webkit-text-stroke: 1px white;">
                                    10 x <i class="fa fa-certificate"></i>
                                </span>
                            </div>
                        </figure>
                    </a>
                    <div class="bg-white pt-10 pl-5 pr-5 text-center content-card">
                        <div class="well">
                            <div class="row" style="">
                                <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
                                    <h6 class="lbl1">Precio de Puja</h6>
                                    <h2 class="lbl2">0.50€</h2>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
                                    <h5 class="timer timerfin">00:00:00</h5>
                                    <h5 class="usuariop">Richard2911</h5>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-4 co4" >
                                    <button class="btn btnatt2" onclick="window.location='<?= base_url('cuenta/misautopujas')?>'">
                                        <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/a-circle.png?v0" alt="">
                                    </button>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-8 co3">
                                    <?php if($this->session->userdata('user_id') != ""):?>
                                        <button class="btn btnatt" data-toggle="modal" data-target="#alert-cfichas">
                                            <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/mazo.png?v0" alt="">
                                            PUJAR
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btnatt" onclick="window.location='<?= base_url('ingresar')?>'">
                                            <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/mazo.png?v0" alt="">
                                            PUJAR
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="well">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-6 co1-co2" >
                                    <h6 class="lbl1">Comprar Ahora</h6>
                                    <h2 class="lbl2"><?= $p['costo'] ?>€</h2>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-6 co1-co2">
                                    <h5 class="lbl3">El precio disminuye a medida que pujas</h5>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 co3"> <?php 
                                    if($this->session->userdata('user_id') != ""):?>
                                        <button class="btn btnatt" data-toggle="modal" data-target="#info-compra">
                                            <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                            COMPRAR
                                        </button> <?php 
                                    else: ?>
                                        <button class="btn btnatt" onclick="window.location='<?= base_url('ingresar')?>'">
                                            <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                            COMPRAR
                                        </button> <?php 
                                    endif ?>
                                </div>
                                <!-- 
                                    <div class="col-md-1 col-sm-3 col-xs-4 co4">
                                        <button class="btn btnatt2">
                                            <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/balance.png?v0" alt="">
                                        </button>
                                    </div> 
                                -->
                            </div>
                        </div>
                    </div> <!-- fin footer card -->
                </div> <!-- deal single -->
            </div> <?php $i++; 
        endforeach ?>

        <!-- modelo compra no disponible, esperando para pujar "Codigo Comentado Abajo" -->

    </div>

    <?php 
        $this->load->view('frontend/index/home_users', [
            "users" => $users
        ] ); 
    ?>
</div>


<?php /*
    <div class="col-md-4 col-sm-6 col-xs-12 mb-20 plr-5">
    <div class="deal-single panel born2">
    <?php $imagen = $p['imagen'] == NULL?'no-image.jpg':$p['imagen']?>
    <ul class="deal-actions top-15 right-20">
    <li class="like-deal">
    <span id="favoritos_span_<?= $p['id_anuncio']?>">
    <a href="javascript:;" onclick="favoritos_listado(<?= $p['id_anuncio']?>)"><i class="fa fa-heart"></i></a>
    </span>
    </li>
    </ul>

    <h3 class="deal-title mb-10" style="width: 102%;text-align: center; padding: 20px;">
    <a style="    font-size: 18px; font-weight: bold;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 15px;"><?= applib::titulo(substr($p['titulo'], 0,23))?><?= (strlen($p['titulo']) > 23)?'...':''?></a>
    </h3>

    <h4 class="deal-title mb-10" style="    width: 102%;text-align: center; margin-top: -27px;">
    <a style="    font-size: 13px; font-weight: 300;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 12px;">PRR  (Precio Recomendado Reventa) 1200€</a>
    </h4>

    <a href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>">
    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" id="<?= $p['seo']?>"  data-bg-img="<?= base_url()?>public/uploads/anuncios/thumb/<?= $imagen?>" style="height:262px">

    <div class="deal-store-logo">
    <h4 style="font-weight: bold;">MAX   200.00<span style="font-size:14px">€</span></h4>
    </div>

    <div class="deal-store-logo pr-20" style="background-color: transparent; right: 0; width: auto;">
    <span id="favoritos_span_" style="font-size: 20px; font-weight: 800; -webkit-text-fill-color: black; -webkit-text-stroke: 1px white;">
    10 x <i class="fa fa-certificate"></i>
    </span>
    </div>
    </figure>
    </a>

    <div class="bg-white pt-10 pl-5 pr-5 text-center content-card">
    <div class="well">
    <div class="row" style="">
    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
    <h6 class="lbl1">Precio de Puja</h6>
    <h2 class="lbl2">0.50€</h2>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
    <h5 class="timer">00:00:00</h5>
    <h5 class="usuariop">Richard2911</h5>
    </div>

    <div class="col-md-1 col-sm-1 col-xs-4 co4" >
    <button class="btn btnatt2" >
    <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/a-circle.png?v0" alt=""></button>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-8 co3">
    <button class="btn btnatt btnatt-inact" disabled="">
    <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/mazo.png?v0" alt="">
    PUJAR
    </button>
    </div>

    </div>
    </div>

    <div class="well">
    <div class="row">
    <div class="col-md-9 col-sm-9 col-xs-12 co1-co2">
    <h5 class="lbl4">Compra No disponible</h5>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-12 co3">
    <button class="btn btnatt btnatt-inact disabled">
    <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
    COMPRAR
    </button>
    </div>

    <!--  <div class="col-md-1 col-sm-3 col-xs-4 co4">
    <button class="btn btnatt2 btnatt-inact disabled">
    <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/balance.png?v0" alt=""></button>
    </div> -->
    </div>
    </div>

    </div> <!-- fin footer card -->
    </div> <!-- deal single -->
    </div> <!-- div col contenedor -->

    <!-- modelo subasta cerrada -->

    <div class="col-md-4 col-sm-6 col-xs-12 mb-20 plr-5">
    <div class="deal-single panel born2">
    <?php $imagen = $p['imagen'] == NULL?'no-image.jpg':$p['imagen']?>
    <ul class="deal-actions top-15 right-20">
    <li class="like-deal">
    <span id="favoritos_span_<?= $p['id_anuncio']?>">
    <a href="javascript:;" onclick="favoritos_listado(<?= $p['id_anuncio']?>)"><i class="fa fa-heart"></i></a>
    </span>
    </li>
    </ul>

    <h3 class="deal-title mb-10" style="width: 102%;text-align: center; padding: 20px;">
    <a style="    font-size: 18px;
    font-weight: bold;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 15px;"><?= applib::titulo(substr($p['titulo'], 0,23))?><?= (strlen($p['titulo']) > 23)?'...':''?></a>
    </h3>

    <h4 class="deal-title mb-10" style="    width: 102%;text-align: center; margin-top: -27px;">
    <a style="    font-size: 13px;
    font-weight: 300;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 12px;">PRR  (Precio Recomendado Reventa) 1200€</a>
    </h4>

    <a href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>">
    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" id="<?= $p['seo']?>"  data-bg-img="<?= base_url()?>public/uploads/anuncios/thumb/<?= $imagen?>" style="height:262px">

    <div class="deal-store-logo">
    <h4 style="font-weight: bold;">MAX   200.00<span style="font-size:14px">€</span></h4>

    </div>

    <div class="deal-store-logo pr-20" style="background-color: transparent; right: 0; width: auto;">
    <span id="favoritos_span_" style="font-size: 20px; font-weight: 800; -webkit-text-fill-color: black; -webkit-text-stroke: 1px white;">
    10 x <i class="fa fa-certificate"></i>
    </span>
    </div>
    </figure></a>

    <div class="bg-white pt-10 pl-5 pr-5 text-center content-card">
    <div class="well">
    <div class="row" style="">
    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
    <h6 class="lbl1">Precio de Puja</h6>
    <h2 class="lbl2">0.50€</h2>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2">
    <h5 class="timer">CERRADO</h5>
    <h5 class="usuariop">Richard2911</h5>
    </div>

    <div class="col-md-1 col-sm-1 col-xs-4 co4" >
    <button class="btn btnatt2 btnatt-inact" disabled="" >
    <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/a-circle.png?v0" alt=""></button>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-8 co3">
    <button class="btn btnatt btnatt-inact" disabled="">
    <img class="icoatt" src="<?= base_url()?>public/assets/images/icons/mazo.png?v0" alt="">
    CERRADO
    </button>
    </div>

    </div>
    </div>

    <div class="well">
    <div class="row">
    <div class="col-md-9 col-sm-9 col-xs-12 co1-co2">
    <h5 class="lbl4">Compra No disponible</h5>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-12 co3">
    <button class="btn btnatt btnatt-inact disabled">
    <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
    COMPRAR
    </button>
    </div>

    <!-- <div class="col-md-1 col-sm-3 col-xs-4 co4">
    <button class="btn btnatt2 btnatt-inact disabled">
    <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/balance.png?v0" alt=""></button>
    </div> -->
    </div>
    </div>

    </div> <!-- fin footer card -->
    </div> <!-- deal single -->
    </div> <!-- div col contenedor -->
    */ 
?>