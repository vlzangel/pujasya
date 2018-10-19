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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <section class="sign-area panel p-40">
                        <h3 class="sign-title">Recuperar contraseña <small>O <a href="<?= base_url('ingresar')?>" class="color-green">Entrar</a></small></h3>
                        <div class="row row-rl-0">
                            <div class="col-sm-12 col-md-12 col-left">
                                <form class="p-40" id="form_login" action="" method="POST">

                                    <?= $this->session->userdata('msg')?>

                                    <?= validation_errors('<div class="alert alert-danger" style="margin-top: 11px;">','</div>')?>

                                    <div class="form-group">
                                        <label class="sr-only">Nueva Contraseña</label>
                                        <input type="password" class="form-control input-lg" name="password" placeholder="Tu nueva contraseña" maxlength="30" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="sr-only">Nueva Contraseña</label>
                                        <input type="password" class="form-control input-lg" name="re-password" placeholder="Repite tu nueva contraseña" maxlength="30" required>
                                    </div>

                                    <div class="form-group">
                                        <a href="<?= base_url('ingresar')?>" class="forgot-pass-link color-green">Entrar a mi cuenta</a>
                                    </div>

                                    <button type="button" id="login_button" class="btn btn-block btn-lg" ><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10px;"></i>ACTUALIZAR CONTRASEÑA</button>
                                </form>
                            </div>
                        </div>
                    </section>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->