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
                        <h3 class="sign-title">Registrarse <small>O <a href="<?= base_url('ingresar')?>" class="color-green">Entrar</a></small></h3>
                        <div class="row row-rl-0">

 <div class="col-sm-6 col-md-5 col-left">
                                <div class="social-login p-40">
                                    <div class="mb-20">
<span>PujasYA, puja en ¡2 minutos!</span>
                                        <a class="btn btn-lg btn-block btn-social btn-facebook" href="<?= base_url('ingresar/facebook')?>" style="margin-top:20px;"><i class="fa fa-facebook-square"></i>Registrate con Facebook</a>
                                    </div>
                                    <!-- <div class="mb-20">
                                        <button class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-twitter"></i>Registrate con Twitter</button>
                                    </div> -->
                                    <div class="text-center color-mid">
                                       <span> También puedes registrarte con tu Email:</span>
                                    </div>
                                </div>
 <span class="or">O</span>

                            </div>


                            <div class="col-sm-6 col-md-7 col-right">

                                

                                <form class="p-40" method="POST" id="form_register" action="">

                                    <?= $this->session->userdata('msg')?>
                                    <?= validation_errors('<div class="alert alert-danger" style="margin-top: 11px;">','</div>')?>

                                    <div class="form-group">
                                        <label class="sr-only">Tu E-mail</label>
                                        <input type="email" class="form-control input-lg" id="email" name="email" maxlength="150" placeholder="Tu E-mail" value="<?= set_value('email')?>" onblur="validarEmailExist(this.value)">
                                        
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_email">¡Debes colocar tu correo electrónico!</div>
                                    <div class="alert alert-danger alertas" style="display:none;" id="no_email_format">Debes colocar un correo electrónico válido</div>
                                    <div class="alert alert-danger alertas" style="display:none;" id="invalid_email">Este E-mail ya está en uso</div>
                                    <div style="margin-bottom: 7px;margin-top: -14px;color: #05bd05;display:none;" id="valid_email"><i class="fa fa-check-circle" aria-hidden="true"></i> E-mail válido!</div>

                                    <div class="form-group">
                                        <label class="sr-only">Nombre de usuario</label>
                                        <input type="text" class="form-control input-lg" id="nickname" name="nickname" maxlength="15" placeholder="Usuario Ejemplo: usuario6644" value="<?= set_value('nickname')?>"  onkeypress="return sololetras_numeros(event)" onblur="validarNicknameExist(this.value)">
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_nickname">Debes colocar un nombre de usuario</div>
                                    <div class="alert alert-danger alertas" style="display:none;" id="invalid_nickname">Este nombre de usuario ya está en uso</div>
                                    <div style="margin-bottom: 7px;margin-top: -14px;color: #05bd05;display:none;" id="valid_nickname"><i class="fa fa-check-circle" aria-hidden="true"></i> Nombre de usuario válido!</div>

                                    <div class="form-group">
                                        <label class="sr-only">Contraseña</label>
                                        <input type="password" class="form-control input-lg" id="password" name="password" maxlength="60" placeholder="Contraseña">
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_password">Debes colocar tu contraseña</div>

                                    <div class="form-group">
                                        <label class="sr-only">Confirmar contraseña</label>
                                        <input type="password" class="form-control input-lg" id="re-password" name="re-password" maxlength="60" placeholder="Nuevamente tu Contraseña" >
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_match">Las contraseñas no coinciden</div>

                                    <div class="custom-checkbox mb-20">
                                        <input type="checkbox" id="agree_terms" checked>
                                        <label class="color-mid" for="agree_terms">Acepto los <a href="<?= base_url('terminos_y_condiciones')?>" class="color-green" target="_blank">Términos de uso y de privacidad</a>.</label>
                                    </div>

                                    <button type="button" id="registro" class="btn btn-block btn-lg" style="float: right"><i class="fa fa-paper-plane-o" aria-hidden="true" style="margin-right: 10px;"></i>Empezar a Pujar</button>
                                    
                                </form>
                               
                            </div>
                           
                        </div>
                    </section>
                </div>
            </div>


        </main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->