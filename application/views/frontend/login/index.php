<style>
    .alertas
  {
    padding: 4px;
    margin-bottom: 11px;
    margin-top: -11px;
    background-color: #314555;
    border-color: #fdb957;
    color:white;
  }
</style>


<!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
        <main id="mainContent" class="main-content">
            <div class="page-container ptb-60">
                <div class="container">
                    <section class="sign-area panel p-40">
                        <h3 class="sign-title">Entrar <small>O <a href="<?= base_url('registro')?>" class="color-green">Registrarse</a></small></h3>
                        <div class="row row-rl-0">

                            <div class="col-sm-6 col-md-7 col-left">
                                <form class="p-40" id="form_login" action="" method="POST">

                                    <?= $this->session->userdata('msg')?>
                                    

                                    <div class="form-group">
                                        <label class="sr-only">E-mail o Usuario</label>
                                        <input type="email" class="form-control input-lg" id="email_login" name="email" placeholder="Tu E-mail o Usuario">
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_email_login">Debes colocar tu correo electrónico o usuario</div>
                                    <div class="alert alert-danger alertas" style="display:none;" id="no_email_format_login">Debes colocar un correo electrónico válido</div>

                                    <div class="form-group">
                                        <label class="sr-only">Password</label>
                                        <input type="password" class="form-control input-lg" id="password_login" name="password" placeholder="Contraseña" onkeypress="if (event.keyCode == 13) $('#form_login').submit()">
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_password_login">Debes colocar tu contraseña</div>

                                    <div class="form-group">
                                        <a href="<?= base_url('ingresar/recuperar')?>" class="forgot-pass-link color-green">¿Olvidaste tu contraseña?</a>
                                    </div>

                                    <button type="button" id="login_button" class="btn btn-block btn-lg" ><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10px;"></i>Entrar</button>
                                </form>
                                <span class="or">O</span>
                            </div>
                            <div class="col-sm-6 col-md-5 col-right">
                                <div class="social-login p-40">
                                    <div class="mb-20">
                                        <a href="<?= base_url('ingresar/facebook')?>" class="btn btn-lg btn-block btn-social btn-facebook"><i class="fa fa-facebook-square"></i>Entrar con Facebook</a>
                                    </div>
                                    <!-- <div class="mb-20">
                                        <button class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-twitter"></i>Ingresar con Twitter</button>
                                    </div> -->
                                    <div class="text-center color-mid">
                                        ¿Aún no tenés cuenta? <a href="<?= base_url('registro')?>" class="color-green">Crear cuenta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


        </main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->