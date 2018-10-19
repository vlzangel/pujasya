<!DOCTYPE html>
<html lang="es" class=" ">
<head>
  <meta charset="utf-8" />
  <title>VillaVende.com</title>
  <meta name="description" content="CoffeeBreak" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/icon.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/app.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="" >
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
    <div class="container aside-xl">
      <a class="navbar-brand block" href="<?= base_url()?>">Villa Vende</a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Ingresa tus datos para comenzar</strong>
        </header>
        <?= $this->session->flashdata('msg') ?>

        <?php echo validation_errors('<div class="alert alert-danger" style="width:60%;"><strong>','</strong></div>');?>
        <form action="" method="POST">
          <div class="list-group">
            <div class="list-group-item">
              <input type="email" placeholder="Email" name="email" class="form-control no-border" required>
            </div>
            <div class="list-group-item">
               <input type="password" placeholder="Contraseña"  name="password" class="form-control no-border" required>
            </div>
          </div>
          <button type="submit" class="btn btn-lg btn-primary btn-block">Iniciar sesión</button>
          <div class="text-center m-t m-b"><a href="#"><small>¿Contraseña olvidada?</small></a></div>
          <div class="line line-dashed"></div>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>Villa Vende<br>&copy; 2017</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="<?= base_url()?>public/admin/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?= base_url()?>public/admin/js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?= base_url()?>public/admin/js/app.js"></script>
  <script src="<?= base_url()?>public/admin/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?= base_url()?>public/admin/js/app.plugin.js"></script>
</body>
</html>
