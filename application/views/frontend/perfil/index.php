 <main id="mainContent" class="main-content">
    <div class="page-container ptb-30">
        <div class="container">
            <div class="row">
                <div class="col-md-2 hidden-sm hidden-xs splr pr-5">
                    <div class="list-group">
                        <a href="<?= base_url('perfil')?>" class="list-group-item active activelist"> Mi Perfil </a>
                        <a href="<?= base_url('cuenta/favoritos')?>" class="list-group-item">Mis Favoritos</a>
                        <a href="<?= base_url('cuenta/mispujas')?>" class="list-group-item">Mis Pujas</a>
                        <a href="<?= base_url('cuenta/misautopujas')?>" class="list-group-item">Mis Autopujas</a>
                        <a href="<?= base_url('cuenta/miscompras')?>" class="list-group-item">Mis Compras</a>
                        <a href="javascript:;" onclick="cancelarcuenta(<?= $user['id']?>)" class="list-group-item">Cancelar Cuenta</a>
                    </div>
                </div>

                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="row row-rl-10 row-tb-20">
                        <div class="page-content col-xs-12 col-sm-8 col-md-9 pr-10">
                            <section class="section checkout-area panel prl-30 pt-20 pb-40">
                                <h2 class="h2 mb-20 h-title">MI PERFIL <?php if($user['premium'] == 1){ ?> | <i class="fa fa-bullseye" style="margin-right: 6px;"></i> (PREMIUM ACTIVADO) <?php } ?></h2>
                                <h5   style="font-weight: bold;margin-bottom: 11px;">Información Personal</h5>
                                <?= $this->session->flashdata('msg')?>
                                    <?= validation_errors('<div class="alert alert-danger">','</div>')?>
                                <form class="mb-30" id="form_perfil" method="POST" action="" enctype="multipart/form-data" >
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" maxlength="100" placeholder="Tu E-mail" value="<?= $user['email']?>" required <?= $user['email'] != NULL?'readonly':''?>>
                                           </div>
                                             <div class="alert alert-danger alertas"  style="display:none;" id="no_email">Debes colocar tu correo electrónico</div>
                                            <div class="alert alert-danger alertas" style="display:none;" id="no_email_format">Debes colocar un correo electrónico válido</div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre de Usuario</label>
                                                <input type="text" class="form-control" id="nickname" name="nickname" maxlength="25" placeholder="Usuario Ejemplo: usuario6644" value="<?= $user['nickname']?>"  onkeypress="return sololetras_numeros(event)" required <?= $user['nickname'] != NULL?'readonly':''?>>
                                            </div>
                                            <div class="alert alert-danger alertas" style="display:none;" id="no_name">Debes colocar tu nombre de usuario</div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombre Persona o Negocio</label>
                                                <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" maxlength="25" placeholder="Ingresa un Nombre o Institución" value="<?= $user['name']?>"  onkeypress="return sololetras(event)" required>
                                           </div>
                                            <div class="alert alert-danger alertas" style="display:none;" id="no_name">Debes colocar tu nombre</div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Móvil o Teléfono</label>
                                                <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" maxlength="16" placeholder="Número" value="<?= $user['telefono_fijo']?>" onkeypress="return telefono_mask(event)" required>
                                            </div>
                                            <div class="alert alert-danger alertas" style="display:none;" id="no_telefono">Debes colocar tu número de teléfono</div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group">
                                                <label>País</label>
                                                <select class="form-control" name="pais" id="pais" required>
                                                    <option value="" disabled>País</option>
                                                    <?php foreach ($paises as $l): ?>
                                                      <option value="<?= $l['id']?>" <?= $user['pais'] == $l['id']?'selected':''?>><?= $l['paisnombre']?></option>
                                                    <?php endforeach?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Provincia</label>
                                                <input class="form-control" name="provincia_id" id="provincia_id" value="<?= $user['provincia_id'] ?>" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ciudad</label>
                                                <input class="form-control" name="poblacion_id" id="poblacion_id" value="<?= $user['poblacion_id'] ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" maxlength="25" placeholder="Calle o Zona (no es obligatorio)" value="<?= $user['direccion']?>" onkeypress="return normal_field(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <?php if($user['premium'] == 1): ?>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PRIVACIDAD</label>
                                                <select class="form-control" name="mostrar_perfil" id="mostrar_perfil">
                                                    <option value="1" <?= $user['mostrar_perfil'] == 1?'selected':''?>>Mostrar mi Perfil</option>
                                                    <option value="0" <?= $user['mostrar_perfil'] == 0?'selected':''?>>NO Mostrar mi Perfil</option>
                                                </select>
                                            </div>
                                        </div>

                                        <?php endif ?>

                                       

                                    </div>

                                    

                                    <button type="submit" class="btn btn-lg btn-rounded mr-10" style="float: right;"><i class="fa fa-user" aria-hidden="true" style="margin-right: 10px;margin-top: 5px !important;"></i>GUARDAR INFORMACIÓN</button>
                                
                            </section>
                            <!-- End Checkout Area -->

                        </div>
                        <div class="page-sidebar col-xs-12 col-sm-4 col-md-3">

                            <!-- Blog Sidebar -->
                            <aside class="sidebar blog-sidebar">
                                <div class="row row-tb-10">
                                    <div class="col-xs-12">
                                        <!-- Recent Posts -->
                                        <div class="widget checkout-widget panel p-20">
                                            <div class="brand col-md-12 t-xs-center t-md-left valign-middle" style="padding-left: 0; padding-right: 0;">
                                                <p style="font-size: 11px;">Solo se permiten archivos jpg y jpeg</p>
                                                <?php $imagen = ($user['imagen'] == NULL)?'no-image.jpg':$user['imagen']?>
                                                <img src="<?= base_url()?>public/uploads/avatars/<?= $imagen?>" alt="" id="destino_imagen" style="width: auto; margin-bottom: 18px; box-shadow: 0px 1px 16px 1px grey;border-radius: 10px;">
                                                <input type="file" name="imagen" id="imagen" style="display:none;">
                                                <label for="imagen" class="btn btn-info btn-block btn-sm upload-button" style="width: 100%;" >SELECCIONAR</label>
                                                
                                            </div>
                                        </div>
                                        <!-- End Recent Posts -->
                                    </div>
                                </div>
                            </aside>
                            </form>
                            <!-- End Blog Sidebar -->

                            <?php if($user['email'] != "" OR $user['nickname'] != ""):?>

                            <!-- Blog Sidebar -->
                            <aside class="sidebar blog-sidebar">
                                <div class="row row-tb-10">
                                    <div class="col-xs-12">
                                        <!-- Recent Posts -->
                                        <!-- Checkout Area -->
                                        <div class="widget checkout-widget panel p-20">
                                            
                                            <h2 class="h2 mb-20 h-title" style="font-size: 17px;">Cambiar contraseña</h2>
                                            <?= $this->session->flashdata('msg2')?>
                                               
                                            <form class="mb-30" action="<?= base_url('perfil/cambiar_contrasena')?>" method="POST">
                                                
                                                <?php if($user['password'] != ""):?>
                                                <div class="form-group">  
                                                    <input type="password" class="form-control" name="password" maxlength="70" placeholder="Contraseña Actual" required>
                                                </div>
                                                <?php endif ?>

                                                <div class="form-group">
                                                 
                                                    <input type="password" class="form-control" name="new_password" maxlength="70" placeholder="Nueva Contraseña"  required="" style="margin-bottom:50px">
                                                </div>
                                                <button type="submit" class="btn btn-info btn-block btn-sm upload-button" style="background-color: #fb9029;margin-top: -10px;margin-bottom: 2p">GUARDAR </button>
                                            </form>
                                        </div>
                                        <!-- End Recent Posts -->
                                    </div>
                                </div>
                            </aside>

                            <?php endif ?>
                            
                            <!-- End Blog Sidebar -->
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End Page Container -->
</div>
</div>
        </main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->
