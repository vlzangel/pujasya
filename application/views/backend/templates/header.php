        
</head>

<body class="fix-sidebar">

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="<?= base_url() ?>"><b>PujasYa</b></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <!--<li>
                        <form role="search" class="app-search hidden-xs">
                            <input type="text" placeholder="Buscar Leds" class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li>-->
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <?php if($_SESSION['type_user'] == 3) : ?>
                        <li class="dropdown"> <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"><i class="icon-envelope"></i>
                        <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                        </a>

                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">Tienes <?= count($notificaciones)?> Notificaciones</div>
                            </li>
                            <li>
                                <div class="message-center">

                                    <?php foreach ($notificaciones as $key => $noti) :?>

                                        <a href="<?= base_url().'verActividad/'.$noti->id;?>">
                                            <div class="user-img"> <img src="<?= $noti->image_activity?>" alt="<?= $noti->name_activity?>" class="img-circle" height="32px"> </div>
                                            <div class="mail-contnet">
                                                <?php $date = date_create($noti->date_activity); 
                                                      $newDate = date_format($date, 'd-m-Y'); ?>
                                                <h5><?= $noti->name_activity?></h5> <span class="time"> <?= $newDate ?> </span> </div>
                                        </a>

                                    <?php endforeach; ?>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="<?= base_url("actividadesAsignadas")?>"> <strong>Ver Todas</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if($_SESSION['type_user'] != 3) : ?>
                        <!-- /.dropdown -->
                        <li>
                            <a class="dropdown-toggle waves-effect waves-light" href="<?= base_url();?>composeMail"><i class="icon-note"></i>
                                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?= base_url() ?>public/admin/images/user.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?= $this->session->userdata('nombre') ?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li><a href="<?= base_url('Administrador/salir') ?>"><i class="fa fa-power-off"></i>  Cerrar Sesion</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>