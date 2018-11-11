<style type="text/css">

    .filtros{
        display: none;
    }

    #list_container tr {
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
                                <?= $this->session->userdata('msg') ?> <?php 
                                if(count($anuncios) > 0): ?>
                                    <table id="list_container" class="wishlist" style="    background-color: white;">
                                        <tbody><?php 
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
                                                    <td class="col-sm-2 col-md-2 is-hidden-xs-down">
                                                        <a href="<?= base_url('anuncio/'.$anuncio->anuncio_id) ?>" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029;">VER PUJA</a>
                                                    </td>
                                                </tr> <?php 
                                            endforeach ?>
                                        </tbody>
                                    </table> <?php 
                                else: ?>
                                    <p style="text-align: left; font-weight: 100; margin-top: 40px; background-color: white; padding: 120px;">No has hecho ninguna Puja</p><?php 
                                endif ?>

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
        </div> <!-- fin container -->
    </div>
</main>
