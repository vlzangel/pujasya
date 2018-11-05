<?php 
    $categorias_buscador = applib::get_all('*',applib::$cat_table,array('status' => 1));
?>
<!DOCTYPE html>
<html lang="es" dir="ltr" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE.$title?></title>
    <?php 
    if(isset($meta)):
        foreach ($meta as $m):
    ?>

    <meta name="<?= $m['name']?>" content="<?= $m['content']?>">

    <?php endforeach; endif ?>
    <link rel="apple-touch-icon" href="<?= base_url()?>public/assets/images/favicon.png">
    <link rel="icon" href="<?= base_url()?>public/assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/vendors/linearicons/css/linearicons.css" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/vendors/owl-carousel/owl.theme.min.css" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/vendors/flexslider/flexslider.css" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/css/base.css?v1" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/css/style.css?v6" rel="stylesheet">
    <link href="<?= base_url()?>public/assets/css/generales.css?v=<?= time()?>" rel="stylesheet">

    <?php if($contenido == 'anuncios/detalle'):?>
    <?php $imagen = (isset($imagenes[0]['name']) AND $imagenes[0]['name'] != NULL)?$imagenes[0]['name']:'no-image.jpg'?>
        <meta property="og:url"           content="<?= base_url('anuncio/'.$anuncio['seo'])?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="PujasYA: <?= $anuncio['titulo']?> (<?php if($anuncio['costo'] == 0){ echo "PUJAR"; }else { echo $anuncio['moneda'] == 1?ARS:USD; echo ' '.applib::format_costo($anuncio['costo']); }?>)" />
        <meta property="og:description"   content="<?= $anuncio['descripcion']?>" />
        <meta property="og:image"         content="<?= base_url()?>public/uploads/anuncios/<?= $imagen?>" />
    <?php endif ?>

    <?php if($contenido == 'index/index'):?>
    <?php $imagen = (isset($imagenes[0]['name']) AND $imagenes[0]['name'] != NULL)?$imagenes[0]['name']:'no-image.jpg'?>
        <meta property="og:url"           content="<?= base_url()?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="PujasYa.com | " />
        <meta property="og:description"   content="La Plataforma Online Gratis, donde puedes Pujar de forma Rápida, Fácil y Segura." />
        <meta property="og:image"         content="<?= base_url()?>public/assets/images/pujasya_subastas_online.jpg" />
    <?php endif ?>

    <script src="<?= base_url()?>public/assets/js/jquery-1.12.3.min.js"></script>
    <script>
      var HOME = "<?= base_url()?>";
      <?php if($this->session->userdata('user_id') != ""):?>
        var USER_NICKNAME = "<?= $user['nickname'] ?>";
      <?php endif ?>
    </script>
</head>

<body id="body" class="wide-layout preloader-active">

    <!--[if lt IE 9]>
        <p class="browserupgrade alert-error">
          You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
        </p>
    <![endif]-->

    <noscript>
        <div class="noscript alert-error">
            For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank">
     instructions how to enable JavaScript in your web browser</a>.
        </div>
    </noscript>
    <div id="preloader" class="preloader">
        <div class="loader-cube">
            <div class="loader-cube__item1 loader-cube__item"></div>
            <div class="loader-cube__item2 loader-cube__item"></div>
            <div class="loader-cube__item4 loader-cube__item"></div>
            <div class="loader-cube__item3 loader-cube__item"></div>
        </div>
    </div>
    <div id="pageWrapper" class="page-wrapper">

        <header id="mainHeader" class="main-header">
            <div class="top-bar bg-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 is-hidden-sm-down">
                            <ul class="nav-top nav-top-left list-inline t-left">
                               <a href="<?= base_url()?>" class="logo">
                                <img class="logo" src="<?= base_url()?>public/assets/images/logo.png?v0" style="max-width: 121px; margin-top: 0px;">
                            </a>
                              
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <ul class="nav-top nav-top-right list-inline t-xs-center t-md-right">
                              <li><a href="<?= base_url()?>"  style="padding: 4px; padding-left: 15px; padding-right: 15px; border-right: 1px solid grey;">Inicio</a></li>
                               <li><a href="javascript:;" onclick="modal_premium()" ><i class="fa fa-question-circle"></i>¿Cómo Funciona?</a>
                                </li>
                                <?php if($this->session->userdata('user_id') == ""):?>
                                <li><a href="<?= base_url('ingresar');?>" style="border-left: 1px solid grey; padding: 4px; padding-left: 15px; padding-right: 15px; border-right: 1px solid grey;"><i class="fa fa-lock"></i>Entrar</a>
                                </li>
                                
                                
                                <li>
                              <button onclick="window.location.href='<?= base_url('registro')?>'" type="" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029; margin-top: -10px; max-height: 27px; line-height: 10px;">Registrarse </button> </li>
  
                                <?php else: ?>
                                
                                 <li class="menu menu-hover">
                                  <a href="<?= base_url('perfil')?>" style="font-weight:bold;border-left: 1px solid grey; padding: 4px; padding-left: 15px; padding-right: 15px; border-right: 1px solid grey;"><i class="fa fa-user"></i><?= $user['nickname'] ?></a>
                                  <ul class="submenu">
                                  	 
                                    <li><a href="<?= base_url('perfil')?>">Mi Perfil</a></li>
                                    <li><a href="<?= base_url('cuenta/favoritos')?>">Mis Favoritos</a></li>
                                    <li><a href="<?= base_url('cuenta/mispujas')?>">Mis Pujas</a></li>
                                    <li><a href="<?= base_url('cuenta/misautopujas')?>">Mis Autopujas</a></li>
                                    <li><a href="<?= base_url('cuenta/miscompras')?>">Mis Compras</a></li>
                                    <li><a href="javascript:;" onclick="cancelarcuenta(<?= $user['id']?>)">Cancelar Cuenta</a></li>
                                    
                                    <li><a href="<?= base_url('ingresar/salir')?>">Salir</a></li>
                                  </ul>
                                </li>
                                 <li style="color: white;">Tienes <span style="color:orange" id="mis_fichas"><?= $user['fichas']?></span> Fichas</li>
                                
                                 <!-- <li><a href="<?= base_url('registro')?>">Tienes <span style="color:orange">0</span> Fichas</a></li> -->
                                 <li>
                                <button onclick="window.location='<?= base_url('comprarfichas')?>'" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029; margin-top: -10px; max-height: 27px; line-height: 10px;">COMPRAR FICHAS</button> 
                              </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('frontend/templates/header_menu') ?>
        </header>

<div class="modal fade" id="modal_premium" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">¿CÓMO FUNCIONA?</h4>
      </div>
      <div class="modal-body">
        <p>
          - Registrate <br>
          - Puja antes de que el temporizador llegue a 0  <br>
          - Si alguien puja el temporizador se reinicia <br>
          - Si nadie más puja, cuando el temporizador llegue a 0, eres el ganador  <br>
        </p>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_eliminar" name="id">
        <a href="<?= base_url('ingresar')?>" class="btn btn-default">COMENZAR A PUJAR</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="alert-cfichas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title bold1">Lo Sentimos!!!</h4>
      </div>
      <div class="modal-body text-justify">
        <h4 style="margin-bottom: 10px;">No tienes suficientes Fichas para participar en esta Puja,</h4>
        <h4><a href="<?= base_url('comprarfichas')?>'">Compra Fichas ahora</a> y no te pierdas la oportunidad de llevarte el producto</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-inact" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location='<?= base_url('comprarfichas')?>'">Comprar Fichas</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="info-compra">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title bold1">Comprar Ahora</h4>
      </div>
      <div class="modal-body text-justify">
        <div class="row mlr-0">
          <h3 class="modal-title bold1 mb-10" id="producto_titulo"></h3>
          <div class="col-md-3 col-sm-3 col-xs-12">
              <img id="producto_img" class="img-responsive" />
          </div>

          <div class="col-md-9 col-sm-9 col-xs-12 ">
            <div class="row mlr-0">
              <div class="row fila">
                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                <p class="p1 bold1">Precio de Compra:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                  <p class="p1"><span id="producto_precio"></span>€</p>
                </div>
              </div>

              <div class="row fila">
                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                <p class="p1 bold1">Precio Descuento de Puja:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                  <p class="p1">- <span id="producto_puja"></span>€</p>
                </div>
              </div>

              <div class="row fila">
                <div class="col-md-9 col-sm-9 col-xs-9  text-left">
                <p class="p1 bold1">Envío y Manejo:</p>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                  <p class="p1">+ <span id="producto_envio"></span>€</p>
                </div>
              </div>

              <div class="row fila f2">
                <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                  <h5 class="bold1">Total a Pagar</h5>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                  <h5 class="bold1"><span id="producto_final"></span>€</h5>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-inact" data-dismiss="modal">Cerrar</button>
        <button id="btn_comprar_modal" type="button" class="btn btn-primary" data-id="" onclick="comprarProducto( jQuery(this) )">Comprar Ahora</button>
      </div>
    </div>
  </div>
</div>



<script>
  function modal_premium()
  {
    $('#modal_premium').modal('show');
  }
</script>