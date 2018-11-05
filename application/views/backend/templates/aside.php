<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                    <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </span> 
                </div>
            </li>
            <li class="user-pro">
                <a href="#" class="waves-effect"><img src="<?= base_url() ?>public/admin/images/user.png" alt="user-img" class="img-circle"> <span class="hide-menu"><?= $this->session->userdata('nombre') ?><span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= base_url('Administrador/salir') ?>"><i class="fa fa-power-off"></i> Cerrar Sesion</a></li>
                </ul>
            </li>
            <li> <a href="<?= base_url('Administrador/home') ?>" class="waves-effect"><i class="fa fa-dashboard p-r-10"></i> <span class="hide-menu">  Panel Escritorio</span></a></li>
            <li> <a href="<?= base_url('Administrador/anuncios') ?>" class="waves-effect"><i class="fa fa-bullhorn p-r-10"></i> <span class="hide-menu"> Anuncios </span></a> </li>
            <li> <a href="<?= base_url('Administrador/fichas') ?>" class="waves-effect"><i class="fa fa-star p-r-10"></i> <span class="hide-menu"> Fichas </span></a> </li>
            <li> <a href="<?= base_url('Administrador/cupones') ?>" class="waves-effect"><i class="fa fa-ticket p-r-10"></i> <span class="hide-menu"> Cupones </span></a> </li>
            <li> <a href="<?= base_url('Administrador/robots') ?>" class="waves-effect"><i class="fa fa-android p-r-10"></i> <span class="hide-menu"> Robots </span></a> </li>
            <!-- <li> <a href="<?= base_url('Administrador/users') ?>" class="waves-effect"><i class="fa fa-users p-r-10"></i> <span class="hide-menu"> Usuarios </span></a> </li> -->
        </ul>
    </div>
</div>
<div id="page-wrapper">