<style type="text/css">

    .filtros{
        display: none;
    }

    #list_container .item_list {
        display: none;
    }

    input#todas:checked ~ #filtros_container .todas,
    input#activas:checked ~ #filtros_container .activas,
    input#ganadas:checked ~ #filtros_container .ganadas,
    input#culminadas:checked ~ #filtros_container .culminadas {
        background-color: #fb9029 !important;
        color: #FFF !important;
    }

    input#todas:checked ~ #list_container .puja_toda,
    input#activas:checked ~ #list_container .puja_activa,
    input#ganadas:checked ~ #list_container .puja_ganada,
    input#culminadas:checked ~ #list_container .puja_culminada {
        display: block;
    }

    .inactivo {
        background-color: #E5E5E5;
        border: 1px solid #DBDBDB;
        color: black;
    }

    .content-card .lbl2 {
        font-size: 20px;
    }

</style>
<main id="mainContent" class="main-content">
    <div class="page-container ptb-20">
        <div class="container">
            <section class="wishlist-area ptb-30" style="   margin-bottom: 70px;">
                <div class="container">
                    <div class="row">
                            
                        <div class="col-md-2 hidden-sm hidden-xs splr">
                            <div class="list-group">
                                <a href="<?= base_url('perfil')?>" class="list-group-item ">Mi Perfil</a>
                                <a href="<?= base_url('cuenta/favoritos')?>" class="list-group-item">Mis Favoritos</a>
                                <a href="<?= base_url('cuenta/mispujas')?>" class="list-group-item active activelist">Mis Pujas</a>
                                <a href="<?= base_url('cuenta/misautopujas')?>" class="list-group-item">Mis Autopujas</a>
                                <a href="<?= base_url('cuenta/miscompras')?>" class="list-group-item">Mis Compras</a>
                                <a href="javascript:;" onclick="cancelarcuenta(<?= $user['id']?>)" class="list-group-item">Cancelar Cuenta</a>
                            </div>
                        </div>

                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <div class="wishlist-wrapper">
                                <h3 class="h-title mb-40 t-uppercase">MIS PUJAS</h3>

                                <input type="radio" class="filtros" name="filtros" id="todas" checked />
                                <input type="radio" class="filtros" name="filtros" id="activas" />
                                <input type="radio" class="filtros" name="filtros" id="ganadas" />
                                <input type="radio" class="filtros" name="filtros" id="culminadas" />
                             
                                <div id="filtros_container" class="mb-40 text-center">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <label for="todas" class="todas btn btn-default btn-sm inactivo">Todas</label>
                                        <label for="activas" class="activas btn btn btn-default btn-sm inactivo"> Activas</label>
                                        <label for="ganadas" class="ganadas btn btn-default btn-sm inactivo">Ganadas</label>
                                        <label for="culminadas" class="culminadas btn btn-default btn-sm inactivo">Terminadas</label>
                                    </div>
                                </div>

                                <div id="list_container">
                                    <?= $this->session->userdata('msg') ?> <?php 
                                    if(count($anuncios) > 0):

                                        $status_filtros = [
                                            "puja_activa" => 0,
                                            "puja_ganada" => 0,
                                            "puja_culminada" => 0,
                                        ];

                                        $status_str = [
                                            "puja_activa" => "Activas",
                                            "puja_ganada" => "Ganadas",
                                            "puja_culminada" => "Culminadas",
                                        ];

                                        echo "<pre>";
                                            print_r($anuncios);
                                        echo "</pre>";

                                        foreach ($anuncios as $key => $autopuja) {
                                            $imagen = ( $autopuja->img_principal == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$autopuja->id_anuncio.'/'.$autopuja->img_principal;
                                            
                                            if( $autopuja->status == "activa" && $autopuja->mi_status == "activa"  ){
                                                $pujar = '
                                                    id="pujar_'.$autopuja->id_anuncio.'"
                                                    class="btn btnatt anuncio_item"
                                                    data-fichas="'.$autopuja->cantidad_fichas.'"
                                                    data-tiempo="'.$autopuja->tiempo_puja.'"
                                                    data-id="'.$autopuja->id_anuncio.'"
                                                    data-precio_puja="'.$autopuja->precio_puja.'"
                                                    data-tiempo_actual="'.$autopuja->tiempo_puja.'"
                                                    data-status="'.$autopuja->status.'"';

                                                $precio_puja = '<h2 class="lbl2" id="precio_puja_'.$autopuja->id_anuncio.'">'.$autopuja->precio_actual.'€</h2>';

                                                $info_timer = '
                                                    <h5 id="timer_'.$autopuja->id_anuncio.'" class="timer">00:00:00</h5>
                                                    <h5 class="usuariop" id="ult_user_'.$autopuja->id_anuncio.'">'.$autopuja->ult_puja_user.'</h5>
                                                ';
                                            }else{
                                                $pujar = 'class="btn btnatt btn-inact"';

                                                $precio_puja = '<h2 class="lbl2">'.$autopuja->precio_actual.'€</h2>';

                                                $info_timer = '
                                                    <h5 class="timer">00:00:00</h5>
                                                    <h5 class="usuariop">'.$autopuja->ult_usuario_pujar.'</h5>
                                                ';
                                            }
                                            if( $autopuja->se_compra == 1 && $autopuja->status == "activa" ){
                                                $pujar .= 'data-compra="'.$autopuja->precio_compra.'"';
                                            }else{
                                                $pujar .= 'data-compra="No"';
                                            }

                                            $comprar = '';
                                            if( $autopuja->se_compra == 1 && $autopuja->status == "activa" && $autopuja->mi_status == "activa"  ){
                                                $btn_comprar = '
                                                    id="comprar_'.$autopuja->id_anuncio.'"
                                                    class="btn btnatt producto" 
                                                    data-id="'.$autopuja->id_anuncio.'"
                                                    data-precio="'.$autopuja->precio_compra.'"
                                                    data-puja="'.$autopuja->precio_puja.'"
                                                    data-envio="'.$autopuja->precio_envio.'"
                                                    data-titulo="'.$autopuja->titulo.'"
                                                    data-img="'.$autopuja->id_anuncio.'/'.$autopuja->img_principal.'"
                                                ';
                                                $comprar .= '
                                                    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2" >
                                                        <h6 class="lbl1">Comprar Ahora</h6>
                                                        <h2 class="lbl2">'.number_format($autopuja->precio_compra-$autopuja->precio_puja, 2, '.', ',').'€</h2>
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-6 co1-co2">
                                                        <h5 class="lbl3">El precio disminuye a medida que pujas</h5>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12 co3">
                                                        <button '.$btn_comprar.' >
                                                          <img class="icoatt icoatt4" src="'.base_url().'public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                          COMPRAR
                                                        </button>
                                                    </div>
                                                ';
                                            }else{
                                                $comprar .= '
                                                    <div class="col-md-9 col-sm-5 col-xs-6 co1-co2">
                                                        <h5 class="lbl3">Compra no disponible</h5>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12 co3">
                                                        <button class="btn btnatt btn-inact">
                                                            <img class="icoatt icoatt4" src="'.base_url().'public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                            COMPRAR
                                                        </button>
                                                    </div>
                                                ';
                                            }

                                            $status_filtros['puja_'.$autopuja->mi_status]++;

                                            echo '
                                                <div class="col-md-12 col-sm-12 col-xs-12 splr item_list puja_toda puja_'.$autopuja->mi_status.'">
                                                    <div class="panel content-card born2">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4 col-xs-12 plr-2 ctr">
                                                                <div class="row">
                                                                    <div class="col-md-2 splr text-center">
                                                                        <img class="imgmin2" src="'.$imagen.'" alt="">
                                                                    </div>
                                                                    <div class="col-md-1 text-center">
                                                                        <span id="favoritos_span_">
                                                                            <a href="javascript:;" onclick=""><i class="fa fa-heart"></i></a>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-9 pt-20">
                                                                        <a class="atitle" href="'.base_url().'anuncio/'.$autopuja->id_anuncio.'" title="'.$autopuja->titulo.'">'.strtoupper(applib::titulo(substr($autopuja->titulo, 0, 16)).( (strlen($autopuja->titulo) > 16) ? '...' : '' )).'</a>
                                                                        <p class="mb-0">Tiempo de Subasta '.$autopuja->tiempo_puja.'s</p> 
                                                                        <div class=" text-right cfichas">
                                                                            <span>
                                                                                '.$autopuja->cantidad_fichas.' x <i class="fa fa-certificate"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 plr-2">
                                                                <div class="well well2 text-center">
                                                                    <div class="row" style="">
                                                                        <div class="col-md-5 col-sm-4 col-xs-6 co1-co2">
                                                                            <h6 class="lbl1">Precio de Puja</h6>
                                                                            '.$precio_puja.'
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-4 col-xs-6 co1-co2 timerlistm">
                                                                            '.$info_timer.'
                                                                        </div>
                                                                        <div class="col-md-3 col-sm-3 col-xs-8 co3">
                                                                            <button '.$pujar.'>
                                                                              <img class="icoatt" src="'.base_url().'public/assets/images/icons/mazo.png?v0" alt="">
                                                                              PUJAR
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 plr-2">
                                                                <div class="well well2 text-center">
                                                                    <div class="row">
                                                                        '.$comprar.'
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        foreach ($status_filtros as $key => $value) {
                                            if( $value == 0 ){
                                                echo '
                                                    <div class="item_list '.$key.'">
                                                        <p class="panel content-card born2" style="padding: 37px 30px 36px; font-weight: 600;">No tienes Pujas '.$status_str[$key].'</p>
                                                    </div>
                                                ';
                                            }
                                        }

                                    else: ?>
                                        <div class="">
                                            <p class="panel content-card born2" style="padding: 37px 30px 36px; font-weight: 600;">No has hecho ninguna Puja</p>
                                        </div> <?php
                                    endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

           






<?php /*

<!-- <?php 
                                            foreach ($anuncios as $anuncio): ?>
                                                <tr class="col-sm-12 col-md-12 puja_toda puja_<?= $anuncio->mi_status ?>">
                                                    <td class="col-sm-8 col-md-8">
                                                        <div class="media-left is-hidden-sm-down">
                                                            <figure class="product-thumb">
                                                                <a href="">
                                                                    <?php 
                                                                        $imagen = ( $anuncio->img_principal == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$anuncio->id_anuncio.'/'.$anuncio->img_principal;
                                                                    ?>
                                                                    <img src="<?= $imagen ?>" alt="" />
                                                                </a>
                                                            </figure>
                                                        </div>
                                                        <div class="media-body valign-middle">
                                                            <h5 class="title mb-5 t-uppercase"><strong><a href="<?= base_url('')?>"> <?= $anuncio->titulo ?> </a></strong></h5>
                                                            <h4 style="margin-bottom: 5px;">Precio Actual: <span class="price"><?= $anuncio->precio_actual ?>€</span></h4>
                                                            <h4 style="margin-bottom: 5px;">Mi última Oferta: <span class="price"><?= $anuncio->ult_puja ?>€</span></h4>
                                                        </div>
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 is-hidden-xs-down"><?php
                                                        switch ( $anuncio->mi_status ) {
                                                            case 'activa':
                                                                echo '<div class="btn btn-info btn-block btn-sm upload-button" style="cursor: default;">Activa</div>';
                                                            break;
                                                            case 'ganada':
                                                                echo '<div class="btn btn-warning btn-block btn-sm upload-button" style="cursor: default;">Ganada</div>';
                                                            break;
                                                            case 'culminada':
                                                                echo '<div class="btn btn-info btn-block btn-sm upload-button" style="background-color: #4f4f4f;cursor: default;">Culminada</div>';
                                                            break;
                                                        } ?>                                       
                                                    </td>
                                                    <td class="col-sm-2 col-md-2 is-hidden-xs-down"><?php
                                                        switch ( $anuncio->mi_status ) {
                                                            case 'activa':
                                                                echo '<a href="'.base_url('anuncio/'.$anuncio->anuncio_id).'" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029;">VER PUJA</a>';
                                                            break;
                                                            case 'ganada':
                                                                echo '<a href="'.base_url('comprarproducto/'.$anuncio->anuncio_id).'" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #00b408;">PAGAR</a>';
                                                            break;
                                                            case 'culminada':
                                                                // echo '<div class="btn btn-info btn-block btn-sm upload-button" style="background-color: #4f4f4f;cursor: default;">Culminada</div>';
                                                            break;
                                                        } ?> 
                                                        
                                                    </td>
                                                </tr> <?php 
                                            endforeach ?> -->




                                <!--
                                   
                                    <table id="cart_list" class="wishlist" style="    background-color: white;">
                                        <tbody>
                                            <tr class="col-sm-12 col-md-12">
                                                <td class="col-sm-8 col-md-8">
                                                    <div class="media-left is-hidden-sm-down">
                                                        <figure class="product-thumb">
                                                            <a href="">
                                                                <img src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="media-body valign-middle">
                                                        <h5 class="title mb-5 t-uppercase"><strong><a href="<?= base_url('')?>"> SAMSUNG GALAXY NOTE EDGE</a></strong></h5>

                                                         <h4 style="margin-bottom: 5px;">Precio Actual: <span class="price">$2500</span></h4>

                                                         <h4 style="margin-bottom: 5px;">Mi última Oferta: <span class="price">$2000</span></h4>

                                                        <h6>Finaliza en: <strong>0d 00:00:00</strong></h6>
                                                    </div>
                                                </td>

                                                 <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                    <div class="btn btn-info btn-block btn-sm upload-button" style="cursor: default;">Activa</div>                                            
                                                </td>

                                                <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                    <a href="" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029;">VER PUJA</a>
                                                    
                                                </td>
                                            </tr>

                                            <tr class="col-sm-12 col-md-12">
                                                <td class="col-sm-8 col-md-8">
                                                    <div class="media-left is-hidden-sm-down">
                                                        <figure class="product-thumb">
                                                            <a href="">
                                                                <img src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="media-body valign-middle">
                                                        <h5 class="title mb-5 t-uppercase"><strong><a href="<?= base_url('')?>"> SAMSUNG GALAXY NOTE EDGE</a></strong></h5>

                                                         <h4 style="margin-bottom: 5px;">Precio Final: <span class="price">$2500</span></h4>

                                                         <h4 style="margin-bottom: 5px;">Mi última Oferta: <span class="price">$2500</span></h4>

                                                        <h6>Finalizó el: <strong>Lun, 08/10/18 a las 00:00:00</strong></h6>
                                                    </div>
                                                </td>

                                                 <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                    <div class="btn btn-warning btn-block btn-sm upload-button" style="cursor: default;">Ganada</div>                                            
                                                </td>

                                                <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                    <a href="" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029;">VER PUJA</a>
                                                    
                                                </td>
                                            </tr>

                                            <tr class="col-sm-12 col-md-12">
                                                <td class="col-sm-8 col-md-8">
                                                    <div class="media-left is-hidden-sm-down">
                                                        <figure class="product-thumb">
                                                            <a href="">
                                                                <img src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="media-body valign-middle">
                                                        <h5 class="title mb-5 t-uppercase"><strong><a href="<?= base_url('')?>"> SAMSUNG GALAXY NOTE EDGE</a></strong></h5>

                                                         <h4 style="margin-bottom: 5px;">Precio Final: <span class="price">$2500</span></h4>

                                                         <h4 style="margin-bottom: 5px;">Mi última Oferta: <span class="price">$2000</span></h4>

                                                        <h6>Finalizó el: <strong>Lun, 08/10/18 a las 00:00:00</strong></h6>
                                                    </div>
                                                </td>

                                                 <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                    <div class="btn btn-info btn-block btn-sm upload-button" style="background-color: #4f4f4f;cursor: default;">Culminada</div>                                            
                                                </td>

                                                <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                    <a href="" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029;">VER PUJA</a>
                                                    
                                                </td>
                                            </tr>
                    
                                        </tbody>
                                    </table> 
                                   
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div> -->
*/ ?>