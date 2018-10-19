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
                                        <form action="">
                                            <div class="col-md-12 col-sm-12 col-xs-12 formcard" id="formcard">
                                                <div class="col-md-offset-3 col-md-6 ">
                                                   <div class="col-md-12">
                                                      <div class="mb-10 text-left">
                                                          <p class="bold1 mb-5" for="">Elije una Puja</p>
                                                         <select class="form-control" required="" id="idpuja" name="idpuja">
                                                           <option value=""></option>
                                                           <option value=""></option>
                                                         </select>
                                                      </div>
                                                      <div class="mb-20 text-left">
                                                        <p class="bold1 mb-5" for="">Número de Veces que Pujas</p>
                                                        <div class="col-md-6 col-sm-6 col-xs-6 pl-0 mb-10">
                                                            <input type="number" class="form-control" placeholder="Máximo de Fichas" required="" id="maxfichas" name="maxfichas" min="1" max="100">
                                                            <!-- el maximo es la cantidad de fichas que tiene el usuario -->
                                                        </div>

                                                         <div class="col-md-6 col-sm-6 col-xs-6 pl-0 mb-20">
                                                              <input type="text" class="form-control" placeholder="Pujar Hasta (€)" required="" id="maxfichas" name="maxfichas">
                                                         </div>
                                                      </div>

                                                      <div class="mb-20">
                                                        <p class="bold1 mb-5" for="">Estrategia para Pujar</p>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="estrategia" id="estra1" value="" checked="checked">
                                                                Pujar en Cualquier Momento
                                                            </label>
                                                        </div>

                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="estrategia" id="estra2" value="" >
                                                                Pujar en los últimos 10 segundos
                                                            </label>
                                                        </div>
                                                      </div>

                                                    <div class="text-center mt-20">
                                                        <button class="btn btn-sm" type="submit" id="n" onclick="">Activar
                                                        </button>
                                                    </div>

                                                   </div>
                                                </div>
                                              </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="mb-40 text-center">
                                        <div class="btn-group" role="group" aria-label="...">
                                          <button type="button" class="btn btn-default btn-sm">Todas</button>
                                          <button type="button" class="btn btn-default btn-sm">Activas</button>
                                          <button type="button" class="btn btn-default btn-sm">Terminadas</button>
                                        </div>
                                    </div>
                                    <!-- <?= $this->session->userdata('msg')?> -->
                                   <!-- <?php if(count($anuncios) > 0): ?>
                                    <table id="cart_list" class="wishlist" style="    background-color: white;">
                                        <tbody>

                                            <?php foreach ($anuncios as $a): ?>

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
                                        <?php endforeach ?>
                    
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                    <p style="text-align: left; font-weight: 100; margin-top: 40px; background-color: white; padding: 120px;">No has hecho ninguna AutoPuja</p>
                                       
                                    <?php endif ?> -->


                                    <div class="col-md-12 col-sm-12 col-xs-12 splr">
                                          <div class="panel content-card born2">
                                            <div class="row">
                                              <div class="col-md-4 col-sm-4 col-xs-12 plr-2 ctr">
                                                <div class="row">
                                                  <div class="col-md-2 splr text-center">
                                                    <img class="imgmin2" src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                                                  </div>
                                                  <div class="col-md-1 text-center">
                                                    <span id="favoritos_span_">
                                                      <a href="javascript:;" onclick=""><i class="fa fa-heart"></i></a>
                                                  </span>
                                                  </div>
                                                  <div class="col-md-9 pt-20">
                                                     <a class="atitle" href="<?= base_url()?>" title="">SAMSUNG GALAXY NOTE EDGE</a>
                                                      <p class="mb-0">Tiempo de Subasta 15s</p> 
                                                      <div class=" text-right cfichas">
                                                        <span>
                                                            10 x <i class="fa fa-certificate"></i>
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
                                                      <h2 class="lbl2">0.50€</h2>
                                                    </div>
                                                   <div class="col-md-4 col-sm-4 col-xs-6 co1-co2 timerlistm">
                                                      <h5 class="timer timerfin ">00:00:00</h5>
                                                      <h5 class="usuariop">Richard2911</h5>
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
                                                <div class="row">
                                                  <div class="col-md-4 col-sm-4 col-xs-6 co1-co2" >
                                                    <h6 class="lbl1">Comprar Ahora</h6>
                                                    <h2 class="lbl2">150€</h2>
                                                  </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-6 co1-co2">
                                                      <h5 class="lbl3">El precio disminuye a medida que pujas</h5>
                                                    </div>

                                                    <div class="col-md-3 col-sm-3 col-xs-12 co3">
                                                        <button class="btn btnatt">
                                                          <img class="icoatt icoatt4" src="<?= base_url()?>public/assets/images/icons/shopping-cart.png?v0" alt="">
                                                          COMPRAR
                                                        </button>
                                                    </div>
<!-- 
                                                    <div class="col-md-1 col-sm-3 col-xs-4 co4">
                                                      <button class="btn btnatt2">
                                                        <img class="icoatt2" src="<?= base_url()?>public/assets/images/icons/balance.png?v0" alt=""></button>
                                                    </div> -->
                                                  </div>
                                                </div>
                                              </div> <!-- col4 -->

                                            </div> <!-- row -->
                                          </div> <!-- panel -->
                                        </div>

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
                                    </table> -->
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div> <!-- fin container -->
    </div>


</main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->
