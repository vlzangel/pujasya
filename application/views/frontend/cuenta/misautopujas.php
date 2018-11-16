<!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
<main id="mainContent" class="main-content">
    <div class="page-container ptb-20">
        <div class="container">
            <section class="wishlist-area ptb-30" style="   margin-bottom: 70px;">
                <div class="container">
                    <div class="row">
                            
                        <div class="col-md-2 hidden-sm hidden-xs splr">
                            <div class="list-group">
                                <a href="<?= base_url('perfil')?>" class="list-group-item ">
                                    Mi Perfil
                                </a>
                                <a href="<?= base_url('cuenta/favoritos')?>" class="list-group-item">Mis Favoritos</a>
                                <a href="<?= base_url('cuenta/mispujas')?>" class="list-group-item ">Mis Pujas</a>
                                <a href="<?= base_url('cuenta/misautopujas')?>" class="list-group-item active activelist">Mis Autopujas</a>
                                <a href="<?= base_url('cuenta/miscompras')?>" class="list-group-item">Mis Compras</a>
                                <a href="javascript:;" onclick="cancelarcuenta(<?= $user['id']?>)" class="list-group-item">Cancelar Cuenta</a>
                            </div>
                        </div>

                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <div class="wishlist-wrapper">
                                <h3 class="h-title mb-40 t-uppercase">MIS AUTOPUJAS</h3>
                                <div class="panel p-20 mtb-30">
                                    <?= $this->session->userdata('msg')?>
                                    <form action="<?= base_url('Pujar/saveAutopujas') ?>" method="POST">
                                        <div class="col-md-12 col-sm-12 col-xs-12 formcard" id="formcard">
                                            <div class="col-md-offset-3 col-md-6 ">
                                                <div class="col-md-12">
                                                    <div class="mb-10 text-left">
                                                        <p class="bold1 mb-5" for="">Elije una Puja</p>
                                                        <select class="form-control" required="" id="anuncio_id" name="anuncio_id"> <?php
                                                            foreach ($anuncios as $key => $anuncio) {
                                                                echo '<option value="'.$anuncio["id_anuncio"].'">'.$anuncio["titulo"].'</option>';
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-20 text-left">
                                                        <p class="bold1 mb-5" for="">Número de Veces que Pujas</p>
                                                        <div class="col-md-6 col-sm-6 col-xs-6 pl-0 mb-10">
                                                            <input type="number" class="form-control" placeholder="Máximo de Fichas" required="" id="max_fichas" name="max_fichas" min="1" max="100">
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-6 pl-0 mb-20">
                                                            <input type="text" class="form-control" placeholder="Pujar Hasta (€)" required="" id="max_monto" name="max_monto">
                                                        </div>
                                                    </div>
                                                    <div class="mb-20">
                                                        <p class="bold1 mb-5" for="">Estrategia para Pujar</p>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="estrategia" id="estra1" value="azar" checked="checked">
                                                                Pujar en Cualquier Momento
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="estrategia" id="estra2" value="ult_10" >
                                                                Pujar en los últimos 10 segundos
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="text-center mt-20">
                                                        <button class="btn btn-sm" type="submit" id="n">Activar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="mb-40 text-center">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default btn-sm" onclick="jQuery('.pujas').css('display', 'block');">Todas</button>
                                        <button type="button" class="btn btn-default btn-sm" onclick="jQuery('.pujas').css('display', 'none'); jQuery('.puja_activa').css('display', 'block'); ">Activas</button>
                                        <button type="button" class="btn btn-default btn-sm" onclick="jQuery('.pujas').css('display', 'block'); jQuery('.puja_activa').css('display', 'none'); ">Terminadas</button>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 splr">
                                    <div class="panel content-card born2">

                                        <table id="cart_list" class="wishlist" style="    background-color: white;">
                                            <tbody>

                                                <?php
                                                    /*echo "<pre>";
                                                        print_r($autopujas);
                                                    echo "</pre>";*/

                                                    foreach ($autopujas as $key => $autopuja) {
                                                        $imagen = ( $autopuja->img_principal == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$autopuja->id_anuncio.'/'.$autopuja->img_principal;
                                                        
                                                        if( $autopuja->status == "activa" ){
                                                            $pujar = '
                                                                id="pujar_'.$autopuja->id_anuncio.'"
                                                                class="btn btnatt anuncio_item"
                                                                data-fichas="'.$autopuja->cantidad_fichas.'"
                                                                data-tiempo="'.$autopuja->tiempo_puja.'"
                                                                data-id="'.$autopuja->id_anuncio.'"
                                                                data-precio_puja="'.$autopuja->precio_puja.'"
                                                                data-tiempo_actual="'.$autopuja->tiempo_puja.'"
                                                                data-status="'.$autopuja->status.'"';
                                                        }else{
                                                            $pujar = 'class="btn btnatt btn-inact"';
                                                        }
                                                        if( $autopuja->se_compra == 1 && $autopuja->status == "activa" ){
                                                            $pujar .= 'data-compra="'.$autopuja->precio_compra.'"';
                                                        }else{
                                                            $pujar .= 'data-compra="No"';
                                                        }

                                                        $comprar = '';
                                                        if( $autopuja->se_compra == 1 && $autopuja->status == "activa" ){
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

                                                        echo '
                                                            <tr class="col-sm-12 col-md-12 puja_'.$autopuja->status.'">
                                                                <td class="col-sm-8 col-md-8" style="padding: 10px 0px 0px;">
                                                                    <div class="row pujas">
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
                                                                                        <h2 class="lbl2" id="precio_puja_'.$autopuja->id_anuncio.'">'.$autopuja->precio_puja.'€</h2>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-4 col-xs-6 co1-co2 timerlistm">
                                                                                        <h5 id="timer_'.$autopuja->id_anuncio.'" class="timer">00:00:00</h5>
                                                                                        <h5 class="usuariop" id="ult_user_'.$autopuja->id_anuncio.'">'.$autopuja->ult_puja_user.'</h5>
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
                                                                </td>
                                                            </tr>
                                                        ';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- panel -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
<style type="text/css">
    .content-card .lbl2 {
        font-size: 20px;
    }
</style>
<script type="text/javascript" src="<?= base_url('public/assets/js/comprar.js?v='.time()) ?>"></script>
<script type="text/javascript" src="<?= base_url('public/assets/js/pujar.js?v='.time()) ?>"></script>