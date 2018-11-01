<!DOCTYPE html>  
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Administrador</title>
  <!-- Bootstrap Core CSS -->
  <link href="<?= base_url() ?>public/admin/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>public/admin/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
  <!-- animation CSS -->
  <link href="<?= base_url() ?>public/admin/css/animate.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="<?= base_url() ?>public/admin/css/style_old.css" rel="stylesheet">
  <!-- color CSS -->
  <link href="<?= base_url() ?>public/admin/css/colors/purple.css" id="theme"  rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/font-awesome.css">

  <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/sty.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box login-sidebar" style="right: auto;">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="<?= base_url('admin/logear') ?>" method="post" style="padding: 29px; margin-top: 10%;">
        <a href="javascript:void(0)" class="text-center db">
          <img src="<?= base_url() ?>public/admin/images/logo_dark.png" alt="Home" style="height: 80px;" ><br/>  
          <p style="color:red;"><?= $mensaje ?></p>
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="text" placeholder="Username" name="user" required value="<?= $user ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" placeholder="Password" name="pass" required>
          </div>
        </div>
        
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Iniciar Sesion</button>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social">
            </div>
          </div>
        </div>
        <div class="row" hidden>
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
          </div>
        </div>
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recuperar Contraseña</h3>
            <p class="text-muted">Ingresa tu correo y sigue las instrucciones! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>

 <div id="particle-canvas" style="z-index: -9 !important; "></div>



<div class="logo">
                     <img src="images/logo-white.png" alt="Home" width="90" height="85">
                  </div>


<style>
#particle-canvas {
  width: 100%;
  height: 100%;
}

</style>

</section>
<!-- jQuery -->
  <script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="<?= base_url() ?>public/admin/js/tether.min.js"></script>
  <script src="<?= base_url() ?>public/admin/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>public/admin/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
  <!-- Menu Plugin JavaScript -->
  <script src="<?= base_url() ?>public/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

  <!--slimscroll JavaScript -->
  <script src="<?= base_url() ?>public/admin/js/jquery.slimscroll.js"></script>
  <!--Wave Effects -->
  <script src="<?= base_url() ?>public/admin/js/waves.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="<?= base_url() ?>public/admin/js/custom.min.js"></script>
  <!--Style Switcher -->
  <script src="<?= base_url() ?>public/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
