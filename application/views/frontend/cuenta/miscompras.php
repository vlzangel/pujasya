<style type="text/css">

    .filtros{
        display: none;
    }

    #list_container > .panel {
        display: none;
    }

    input#todas:checked ~ #filtros_container .todas,
    input#por_pagar:checked ~ #filtros_container .por_pagar,
    input#pagadas:checked ~ #filtros_container .pagadas,
    input#expiradas:checked ~ #filtros_container .expiradas {
        background-color: #fb9029 !important;
        color: #FFF !important;
    }

    input#todas:checked ~ #list_container .puja_toda,
    input#por_pagar:checked ~ #list_container .puja_Pendiente,
    input#pagadas:checked ~ #list_container .puja_Pagada,
    input#expiradas:checked ~ #list_container .puja_Expirada {
        display: block;
    }

    .inactivo {
        background-color: #E5E5E5;
        border: 1px solid #DBDBDB;
        color: black;
    }

</style>
<!-- <pre>
    <?php print_r($anuncios); ?>
</pre> -->
<main id="mainContent" class="main-content">
    <div class="page-container ptb-20">
        <div class="container">
            <section class="wishlist-area ptb-30" style="   margin-bottom: 70px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 hidden-sm hidden-xs splr">
                            <div class="list-group">
                                <a href="<?= base_url('perfil')?>" class="list-group-item "> Mi Perfil </a>
                                <a href="<?= base_url('cuenta/favoritos')?>" class="list-group-item">Mis Favoritos</a>
                                <a href="<?= base_url('cuenta/mispujas')?>" class="list-group-item">Mis Pujas</a>
                                <a href="<?= base_url('cuenta/misautopujas')?>" class="list-group-item">Mis Autopujas</a>
                                <a href="<?= base_url('cuenta/miscompras')?>" class="list-group-item activelist">Mis Compras</a>
                                <a href="javascript:;" onclick="cancelarcuenta(<?= $user['id'] ?>)" class="list-group-item">Cancelar Cuenta</a>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <div class="wishlist-wrapper">
                                <h3 class="h-title mb-40 t-uppercase">Mis Compras</h3>

                                <input type="radio" class="filtros" name="filtros" id="todas" checked />
                                <input type="radio" class="filtros" name="filtros" id="por_pagar" />
                                <input type="radio" class="filtros" name="filtros" id="pagadas" />
                                <input type="radio" class="filtros" name="filtros" id="expiradas" />

                                <div id="filtros_container" class="mb-40 text-center">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <label for="todas" data-status="todas" class="todas btn btn-default btn-sm inactivo">Todas</label>
                                        <label for="por_pagar" data-status="por_pagar" class="por_pagar btn btn-default btn-sm inactivo">Por Pagar</label>
                                        <label for="pagadas" data-status="pagadas" class="pagadas btn btn-default btn-sm inactivo">Pagadas</label>
                                        <label for="expiradas" data-status="expiradas" class="expiradas btn btn-default btn-sm inactivo">Expiradas</label>
                                    </div>
                                </div>
                                <div id="list_container" class="col-md-12 col-sm-12 col-xs-12 splr"> <?php
                                    if( count($anuncios) > 0 ){

                                        $status_filtros = [
                                            "puja_Pendiente" => 0,
                                            "puja_Pagada" => 0,
                                            "puja_Expirada" => 0,
                                        ];

                                        $status_str = [
                                            "puja_Pendiente" => "Pendientes",
                                            "puja_Pagada" => "Pagadas",
                                            "puja_Expirada" => "Expiradas",
                                        ];

                                        foreach ($anuncios as $anuncio) { 
                                            if( $anuncio->status_compra == "Por pagar puja"){
                                                $info = json_decode($anuncio->data);
                                                $tipo = $anuncio->operacion; 
                                                $imagen = ( $anuncio->img_principal == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$anuncio->id_anuncio.'/'.$anuncio->img_principal;

                                                $status_filtros['puja_'.$anuncio->status_compra]++; ?>
                                                
                                                <div class="panel content-card born2 puja_toda puja_<?= $anuncio->status_compra ?>" >
                                                    <div class="col-md-12 col-sm-12 col-xs-12 plr-2 ctr">
                                                        <div class="row">
                                                            <div class="col-md-1 col-sm-1 col-xs-12 splr text-center">
                                                                <img class="imgmin3" src="<?= $imagen ?>" alt="">
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 ptb-20">
                                                                <a class="atitle" href="<?= base_url()?>" title=""><?= $anuncio->titulo ?></a> <?php
                                                                if( $tipo == "Compra" ){ ?>
                                                                    <p class="" style="margin-bottom: 0;"><strong>Fecha Compra:</strong> <?=  date("d/m/Y H:i:s", strtotime($anuncio->fecha) ) ?> </p>  <?php
                                                                }else{ ?>
                                                                    <p class="" style="margin-bottom: 0;"><strong>Cierre de Puja:</strong> <?=  date("d/m/Y H:i:s", strtotime($anuncio->fecha) ) ?> </p>  <?php
                                                                } ?>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-12 ptb-20 text-center">
                                                                <p class="" style="margin-bottom: 0;"><strong><?= $tipo ?></strong></p> 
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 col-xs-6 text-right ptb-20"> <?php
                                                                if( $tipo == "Compra" ){ ?>
                                                                    <p class="" style="margin-bottom: 0;"><strong>Precio:</strong> <?= $info->producto_precio ?>€ </p> 
                                                                    <p class="" style="margin-bottom: 0;"><strong>Envío y Manejo:</strong> <?= $info->producto_envio ?>€ </p>
                                                                    <p class="" style="margin-bottom: 0;"><strong>Precio Puja:</strong> - <?= $info->producto_puja ?>€ </p>
                                                                    <h5 class="bold1" style="margin-bottom: 0;">Total: <?= $info->pago ?>€</h5>  <?php
                                                                }else{ ?>
                                                                    <h5 class="bold1" style="margin-bottom: 0;">Precio Puja: <?= $info->producto_puja ?>€</h5>
                                                                    <p class="" style="margin-bottom: 0;"><strong>Envío y Manejo:</strong> <?= $info->producto_envio ?>€ </p> 
                                                                    <h5 class="bold1" style="margin-bottom: 0;">Total: <?= $info->producto_puja+$info->producto_envio ?>€</h5> <?php
                                                                } ?>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-xs-6 text-right ptb-20"><?php
                                                                switch ( $anuncio->status_compra ) {
                                                                    case 'Expirada':
                                                                        echo '<div class="etiq etiq-exp">EXPIRADA</div>';
                                                                    break;
                                                                    case 'Pagada':
                                                                        echo '<div class="etiq etiq-success">PAGADA</div>';
                                                                    break;
                                                                    case 'Pendiente':
                                                                        echo '<a class="etiq etiq-espera" href="'.base_url("comprarproducto/").$anuncio->id_anuncio.'">PAGAR</a>';
                                                                    break;
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <?php
                                            }
                                        } 

                                        foreach ($status_filtros as $key => $value) {
                                            if( $value == 0 ){
                                                echo '
                                                    <div class="panel '.$key.'">
                                                        <p class="panel content-card born2" style="padding: 37px 30px 36px; font-weight: 600;">No tienes Pujas '.$status_str[$key].'</p>
                                                    </div>
                                                ';
                                            }
                                        }

                                    }else{ ?>
                                        <p style="text-align: left; font-weight: 100; margin-top: 40px; background-color: white; padding: 120px;">
                                            AÚN NO HAS REALIZADO NINGUNA COMPRA
                                        </p> <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
    </div>
</main>
