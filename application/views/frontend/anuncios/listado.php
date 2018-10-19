<style>
  /* HOVER STYLES */
  /* #pop-up {
  display: none;
  position: absolute;
  width: 280px;
  padding: 10px;
  background: #eeeeee;
  color: #000000;
  border: 1px solid #1a1a1a;
  font-size: 90%;
  }*/
</style>
<!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
<main id="mainContent" class="main-content">
  <div class="page-container ptb-60">
    <div class="container">
      <div class="row row-rl-10 row-tb-20">
  
        <div class="page-content col-xs-12 col-md-12">
          <div class="alert alert-success" id="success_favoritos" style="display:none;">¡Buenísimo! Ya agendaste en Mis Favoritos la Puja | <a href="<?= base_url('cuenta/favoritos')?>">Ver Favoritos</a></div>
          <div class="alert alert-danger" id="error_favoritos" style="display:none;">Ha ocurrido un error!</div>
          <?= $this->session->flashdata('msg') ?>
          <section class="section deals-area">
            <?php if(isset($premium) AND count($premium) > 0): ?>
            <?php if(!isset($anuncios_usuario)):?>
            <header class="page-control panel ptb-15 prl-20 pos-r mb-30">
              <span class="list-control-view list-inline">
              <?php if(isset($anuncios_usuario)):?>
              Anuncios de <?= $premium[0]['usuario'] ?> 
              <?= $premium[0]['premium'] == 1?' | <i class="fa fa-bullseye" style="margin-right: 6px;"></i>PREMIUM':''?>
              <?php else:?>
              <i class="fa fa-bullseye" style="margin-right: 6px;"></i> PRÓXIMAS A FINALIZAR
              <?php endif ?>
              <a class="btn btn-primary ocultar2" href="/#" style="padding: 6px 9px !important;height: 33px;font-size: 12px;float: right;margin-right: 174px; margin-top: -2px;">Algun link Aqui</a>
              </span>
              <!-- End List Control View -->
              <div class="right-10 pos-tb-center">
                <select class="form-control input-sm" id="ordenar_por_filter" style="max-width:180px">
                  <option value="" selected>Ordenar por</option>
                  <option value="fecha_orden_filter" <?= $this->session->userdata('fecha_orden_filter') == 1?'selected':''?>>Ultimos</option>
                  <option value="costo_menor_filter" <?= $this->session->userdata('costo_menor_filter') == 1?'selected':''?>>Precio: Menor a Mayor</option>
                  <option value="costo_mayor_filter" <?= $this->session->userdata('costo_mayor_filter') == 1?'selected':''?>>Precio: Mayor a Menor</option>
                </select>
              </div>
            </header>
            <?php endif ?>
            <!-- End Page Control -->
            <div class="row row-masnory row-tb-20">
              <?php $i = 0; foreach ($premium as $p): ?>
              <div class="col-sm-4">
                <div class="deal-single panel">
                  <?php $imagen = $p['imagen'] == NULL?'no-image.jpg':$p['imagen']?>
                  <ul class="deal-actions top-15 right-20">
                      <li class="like-deal">
                        <span id="favoritos_span_<?= $p['id_anuncio']?>">
                        <a href="javascript:;" onclick="favoritos_listado(<?= $p['id_anuncio']?>)"><i class="fa fa-heart"></i></a>
                        </span>
                      </li>
                     <!--  <li class="share-btn">
                        <div class="share-tooltip fade">
                          <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                          <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                          <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                          <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                        <span><i class="fa fa-share-alt"></i></span>
                      </li> -->
                      <!-- <li>
                        <span>
                        <i class="fa fa-camera"></i>
                        </span>
                        </li> -->
                    </ul>
                  <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" id="<?= $p['seo']?>"  data-bg-img="<?= base_url()?>public/uploads/anuncios/thumb/<?= $imagen?>" style="height:208px">
                   
                   <?php if($p['mostrar_perfil'] == 1 AND $p['premium'] == 1): ?>

                      <div class="deal-store-logo">
                            <h2><?php echo $p['moneda'] == 1?ARS:USD; echo ' '.applib::format_costo($p['costo']); ?></h2>

                    <?php endif ?>

                  </figure>
                  <div class="bg-white pt-20 pl-20 pr-15 text-center">
                    <div class="pr-md-10">
                      <h3 class="deal-title mb-10" style="    width: 102%;">
                        <a style="    font-size: 15px;" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 15px;"><?= applib::titulo(substr($p['titulo'], 0,23))?><?= (strlen($p['titulo']) > 23)?'...':''?></a>
                      </h3>
                      <ul class="deal-meta list-inline mb-10 color-mid">
                        <li>
                          <h2><strong>00:00:00</strong></h2>
                          <!-- <p style="font-size: 12px; margin-bottom: 0;margin-top: 10px;"><?php echo $p['nickname'] ?></p> -->
                          <p class="postor">Richard2911</p>
                        </li>
                      </ul>
                  
                    </div>
                    <div class="showcode" data-toggle-class="coupon-showen" data-toggle-event="click" style="margin-bottom: 20px;">
                       <a class="btn btn-sm btn-block" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>">PUJAR</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php $i++; endforeach ?>
            </div>
            <?php else: if(isset($get_premium) AND $get_premium):?>
            <header class="page-control panel ptb-15 prl-20 pos-r mb-30">
              <span class="list-control-view list-inline">
              <i class="fa fa-bullseye" style="margin-right: 6px;"></i> PUJAS PREMIUM
             
             
              </span>
             
            </header>
             <div style="text-align:center;"><a class="btn btn-primary" href="<?= base_url('planes-premium')?>" style="padding: 6px 9px !important;height: 33px;font-size: 12px;margin-left: 16px;margin-top: -11px;">¿Querés ser PREMIUM?</a></div>
            
          <?php endif; endif ?>




            <?php if(isset($anuncios) AND count($anuncios) > 0): ?>
            <!-- Page Control -->
            <header class="page-control panel ptb-15 prl-20 pos-r mb-30" style="margin-top: 23px;">
              <!-- List Control View -->
              <span class="list-control-view list-inline">
              <i class="fa fa-paper-plane-o" style="margin-right: 6px;"></i>Más Pujas... ( <?= $cuantos?> Encontrados )
              </span>

              <?php if(!isset($premium) OR count($premium) == 0):?>
               <div class="right-10 pos-tb-center">
                <select class="form-control input-sm" id="ordenar_por_filter">
                  <option value="" selected>Ordenar por</option>
                  <option value="fecha_orden_filter" <?= $this->session->userdata('fecha_orden_filter') == 1?'selected':''?>>Ultimos</option>
                  <option value="costo_menor_filter" <?= $this->session->userdata('costo_menor_filter') == 1?'selected':''?>>Precio: Menor a Mayor</option>
                  <option value="costo_mayor_filter" <?= $this->session->userdata('costo_mayor_filter') == 1?'selected':''?>>Precio: Mayor a Menor</option>
                </select>
              </div>
              <?php endif ?>
            </header>
            <!-- Page Pagination -->
            <?= $this->pagination->create_links() ?>
            <!-- End Page Pagination -->
            <div class="row row-masnory row-tb-20">
              <?php foreach ($anuncios as $p): ?>
              <div class="col-sm-3">
                <div class="deal-single panel">
                   <ul class="deal-actions top-15 right-20">
                      <li class="like-deal">
                        <span id="favoritos_span_<?= $p['id_anuncio']?>">
                        <a href="javascript:;" onclick="favoritos_listado(<?= $p['id_anuncio']?>)"><i class="fa fa-heart"></i></a>
                        </span>
                      </li>
                     <!--  <li class="share-btn">
                        <div class="share-tooltip fade">
                          <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                          <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                          <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                          <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                        <span><i class="fa fa-share-alt"></i></span>
                      </li> -->
                      <!-- <li>
                        <span>
                        <i class="fa fa-camera"></i>
                        </span>
                        </li> -->
                    </ul>
                  <?php $imagen = $p['imagen'] == NULL?'no-image.jpg':$p['imagen']?>
                  <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" id="<?= $p['seo']?>"  data-bg-img="<?= base_url()?>public/uploads/anuncios/thumb/<?= $imagen?>" style="height: 173px;">
                    
                    <?php if($p['mostrar_perfil'] == 1 AND $p['premium'] == 1): ?>
                      <div class="deal-store-logo">
                            <h2><?php echo $p['moneda'] == 1?ARS:USD; echo ' '.applib::format_costo($p['costo']); ?></h2>
                      </div>

                    <?php endif ?>
                    
                  </figure>
                  <div class="bg-white pt-20 pl-20 pr-15 text-center">
                    <div class="pr-md-10">
                      <h3 class="deal-title mb-10" style="    width: 102%;">
                        <a  style="    font-size: 15px;"  href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 15px;"><?= applib::titulo(substr($p['titulo'], 0,15))?><?= (strlen($p['titulo']) > 15)?'...':''?></a>
                      </h3>
                      <ul class="deal-meta list-inline mb-10 color-mid">

                       
                        <li><a href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>" style="font-size: 12px;text-overflow: ellipsis; width: 370px;white-space: nowrap;overflow: hidden;">
                         <h2><strong>00:00:00</strong></h2>
                                <!-- <p style="font-size: 12px; margin-bottom: 0;margin-top: 10px;"><?php echo $p['nickname'] ?></p> -->
                                <p class="postor">Richard2911</p>
                        </li>
                      </ul>

                    </div>
                    <div class="showcode" data-toggle-class="coupon-showen" data-toggle-event="click" style="margin-bottom: 20px;">

                      <a class="btn btn-sm btn-block" href="<?= base_url('anuncio/'.$p['seo'])?>" title="<?= $p['titulo']?>">PUJAR</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <!-- Page Pagination -->
            <?= $this->pagination->create_links() ?>
            <!-- End Page Pagination -->
             <?php else: if($this->session->flashdata('msg') == "" AND !isset($anuncios_usuario)):?>
             <p style="text-align: center;font-weight: bold;background-color: white; padding: 77px;font-size: 17px;">No se encontraron Pujas en tu búsqueda...</p>
            <?php endif; endif ?>
          </section>
           <?php if($this->session->userdata('premium') == 1 AND isset($anuncios_usuario) AND $this->session->userdata('seo') == $this->uri->segment(3)):?>
              <h4 class="checkout-subtitle" style="margin-top: 23px;font-size: 14px; background-color: #f18926; padding: 15px; color: white;"><span style="font-weight:bold;">Disponibles: hasta <?= $this->session->userdata('paquete')?> Anuncios PREMIUM </span><br>Por favor, recordá que los pagos de membresía Premium se deben generar los días 30 de cada Mes. Su cuenta será inhabilitada si no se ingresa el pago dentro de los 7 días posteriores. ¡Gracias!</h4>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</main>
<input type="hidden" id="url_filter" value="<?= isset($url)?$url:''?>">
<!-- <div id="pop-up">
  <h3>Pop-up div Successfully Displayed</h3>
  <p>
      This div only appears when the trigger link is hovered over. Otherwise
      it is hidden from view.
  </p>
  </div> -->
<!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->
