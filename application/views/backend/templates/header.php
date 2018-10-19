<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title><?= SITE_TITLE.$title?></title>
  <meta name="description" content="Administra los artículos para el blog" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/icon.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/css/app.css" type="text/css" />
  <link rel="stylesheet" href="<?= base_url()?>public/admin/js/datatables/datatables.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="" >
  <section class="vbox">
    <header class="bg-primary header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="index.html" class="navbar-brand">

          <img src="<?= base_url()?>public/admin/images/logo.png" class="m-r-sm" alt="Valle vende">
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <?php $imagen = ($this->session->userdata('imagen') == NULL)?'a0.png':$this->session->userdata('imagen')?>
              <img src="<?= base_url()?>public/uploads/avatars/<?= $imagen?>" alt="...">
            </span>
            <?= $this->session->userdata('name_admin')?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <li>
              <span class="arrow top"></span>
              <a href="<?= base_url('admin/profile')?>">Perfil</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="<?= base_url('admin/login/logout')?>">Salir</a>
            </li>
          </ul>
        </li>
      </ul>
    </header>

    <!--SECTION TO OPEN-->

    <section>
      <section class="hbox stretch">