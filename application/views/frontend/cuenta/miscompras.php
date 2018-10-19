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

                 <div class="col-md-12 col-sm-12 col-xs-12 splr">
                  <div class="panel content-card born2">
                    <div class="col-md-12 col-sm-12 col-xs-12 plr-2 ctr">
                      <div class="row">

                        <div class="col-md-1 col-sm-1 col-xs-12 splr text-center">
                          <img class="imgmin3" src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                        </div>
                       
                        <div class="col-md-4 col-sm-4 col-xs-12 ptb-20">
                          <a class="atitle" href="<?= base_url()?>" title="">SAMSUNG GALAXY NOTE EDGE</a>

                          <p class="" style="margin-bottom: 0;"><strong>Cierre de Puja:</strong> 10/10/2018 11:11:11 </p> 

                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12 ptb-20 text-center">
                          <p class="" style="margin-bottom: 0;"><strong>Puja Ganada</strong></p> 

                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-6 text-right ptb-20">
                          <p class="" style="margin-bottom: 0;"><strong>Precio:</strong> 50€ </p> 
                          <p class="" style="margin-bottom: 0;"><strong>Envío y Manejo:</strong> 0,50€ </p> 

                          <h5 class="bold1" style="margin-bottom: 0;">Total: 50,50€</h5> 
                        </div>

                          <div class="col-md-2 col-sm-2 col-xs-6 text-right ptb-20">
                            <button class="btn btn-default btn-sm btn-block">PAGAR</button>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                   
                <div class="col-md-12 col-sm-12 col-xs-12 splr">
                  <div class="panel content-card born2">
                    <div class="col-md-12 col-sm-12 col-xs-12 plr-2 ctr">
                      <div class="row">

                        <div class="col-md-1 col-sm-1 col-xs-12 splr text-center">
                          <img class="imgmin3" src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                        </div>
                       
                        <div class="col-md-4 col-sm-4 col-xs-12 ptb-20">
                          <a class="atitle" href="<?= base_url()?>" title="">SAMSUNG GALAXY NOTE EDGE</a>

                          <p class="" style="margin-bottom: 0;"><strong>Cierre de Puja:</strong> 10/10/2018 11:11:11 </p> 

                          <p class="" style="margin-bottom: 0;"><strong>Fecha de Pago:</strong> 10/10/2018 11:11:11 </p> 
                        </div>


                        <div class="col-md-2 col-sm-2 col-xs-12 ptb-20 text-center">
                          <p class="" style="margin-bottom: 0;"><strong>Compra</strong></p> 

                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-6 text-right ptb-20">
                          <p class="" style="margin-bottom: 0;"><strong>Precio:</strong> 50€ </p> 
                          <p class="" style="margin-bottom: 0;"><strong>Envío y Manejo:</strong> 0,50€ </p> 

                          <h5 class="bold1" style="margin-bottom: 0;">Total: 50,50€</h5> 
                        </div>

                          <div class="col-md-2 col-sm-2 col-xs-6 text-right ptb-20">
                            <div class="etiq etiq-success">PAGADA</div>
                            <div class="etiq etiq-success">ENVIADO</div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12 splr">
                    <div class="panel content-card born2">
                    <div class="col-md-12 col-sm-12 col-xs-12 plr-2 ctr">
                      <div class="row">

                        <div class="col-md-1 col-sm-1 col-xs-12 splr text-center">
                          <img class="imgmin3" src="<?= base_url()?>public/uploads/anuncios/thumb/1.jpg" alt="">
                        </div>
                       
                        <div class="col-md-4 col-sm-4 col-xs-12 ptb-20">
                          <a class="atitle" href="<?= base_url()?>" title="">SAMSUNG GALAXY NOTE EDGE</a>

                          <p class="" style="margin-bottom: 0;"><strong>Cierre de Puja:</strong> 10/10/2018 11:11:11 </p> 

                        </div>


                        <div class="col-md-2 col-sm-2 col-xs-12 ptb-20 text-center">
                          <p class="" style="margin-bottom: 0;"><strong>Puja Ganada</strong></p> 

                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-6 text-right ptb-20">
                          <p class="" style="margin-bottom: 0;"><strong>Precio:</strong> 50€ </p> 
                          <p class="" style="margin-bottom: 0;"><strong>Envío y Manejo:</strong> 0,50€ </p> 

                          <h5 class="bold1" style="margin-bottom: 0;">Total: 50,50€</h5> 
                        </div>

                          <div class="col-md-2 col-sm-2 col-xs-6 text-right ptb-20">
                            <div class="etiq etiq-exp">EXPIRADA</div>
                          </div>
                      </div>
                    </div>
                  </div>

                
               

              </div>
            </div>
          </div>
        </div>
      </section>
    </div> <!-- fin container -->
  </div>
</main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->
