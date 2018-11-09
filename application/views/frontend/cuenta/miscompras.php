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
                                <a href="javascript:;" onclick="cancelarcuenta(<?= $user['id']?>)" class="list-group-item">Cancelar Cuenta</a>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-12 col-xs-12">
                            <div class="wishlist-wrapper">
                                <h3 class="h-title mb-40 t-uppercase">Mis Compras</h3>
                                <div class="mb-40 text-center">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default btn-sm">Todas</button>
                                        <button type="button" class="btn btn-default btn-sm">Por Pagar</button>
                                        <button type="button" class="btn btn-default btn-sm">Pagadas</button>
                                        <button type="button" class="btn btn-default btn-sm">Expiradas</button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 splr"> <?php
                                    if( count($anuncios) > 0 ){
                                        foreach ($anuncios as $anuncio) { 
                                            $info = json_decode($anuncio->data);
                                            $tipo = $anuncio->operacion; 
                                            $imagen = ( $anuncio->img_principal == "" ) ? base_url().'public/uploads/anuncios/thumb/no-image.jpg' : base_url().'files/productos/'.$anuncio->id_anuncio.'/'.$anuncio->img_principal; ?>
                                            <div class="panel content-card born2">
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
                                                                <h5 class="bold1" style="margin-bottom: 0;">Precio Puja: <?= $info->producto_puja ?>€</h5>  <?php
                                                            } ?>
                                                        </div>
                                                        <div class="col-md-2 col-sm-2 col-xs-6 text-right ptb-20"><?php
                                                            switch ( $info->status ) {
                                                                case 'Pagada':
                                                                    echo '<div class="etiq etiq-success">PAGADA</div>';
                                                                break;
                                                                case 'Pendiente':
                                                                    echo '<div class="etiq etiq-success">PAGADA</div>';
                                                                break;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <?php
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
