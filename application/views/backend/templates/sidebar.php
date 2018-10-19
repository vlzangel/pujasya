 <!-- .aside -->
        <aside class="bg-light lt b-r b-light aside-md hidden-print hidden-xs" id="nav">
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">
                        <?php $imagen = ($this->session->userdata('imagen') == NULL)?'a0.png':$this->session->userdata('imagen')?>
                        <img src="<?= base_url()?>public/uploads/avatars/<?= $imagen?>" class="dker" alt="...">
                        <i class="on md b-light"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt"><?= $this->session->userdata('name_admin')?></strong>
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block"><?= $this->session->userdata('name_admin')?></span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      
                      <li>
                        <span class="arrow top hidden-nav-xs"></span>
                        <a href="<?= base_url('admin/profile')?>">Perfil</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="<?= base_url('admin/login/logout')?>">Salir</a>
                      </li>
                    </ul>
                  </div>
                </div>


                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Comienza</div>
                  <ul class="nav nav-main" data-ride="collapse">

                    <li>
                      <a href="<?= base_url('admin/users')?>" class="auto">
                        <i class="i i-users2 icon">
                        </i>
                        <span class="font-bold">Usuarios</span>
                      </a>
                    </li>

                    <li>
                      <a href="<?= base_url('admin/categories')?>" class="auto">
                        <i class="i i-plus icon"></i>
                        <span class="font-bold">Categorias</span>
                      </a>
                    </li>

                    <li>
                      <a href="<?= base_url('admin/subcategories')?>" class="auto">
                        <i class="i i-plus icon">
                        </i>
                        <span class="font-bold">Subcategorias</span>
                      </a>
                    </li>

                    <li>
                      <a href="<?= base_url('admin/anuncios')?>" class="auto">
                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                        <span class="font-bold">Anuncios</span>
                      </a>
                    </li>

                     <li>
                      <a href="<?= base_url('admin/sidebar')?>" class="auto">
                        <i class="i i-plus icon"></i>
                        <span class="font-bold">Administrar sidebar</span>
                      </a>
                    </li>

                    <!-- <li >
                      <a href="<?php // base_url('admin/categories')?>" class="auto">
                        <i class="i i-tag icon">
                        </i>
                        <span class="font-bold">Categorías</span>
                      </a>
                    </li> -->
                    
                   <!--  <li >
                      <a href="#" class="auto">
                        <b class="badge bg-danger pull-right">4</b>
                        <i class="i i-paperplane icon">
                        </i>
                        <span class="font-bold">Leads</span>
                      </a>
                    </li> -->
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>

            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>