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
                        <h3 class="sign-title">Contacta</h3>
                        <div class="row row-rl-0">

                            <div class="col-md-offset-2 col-md-8">
                                <form class="p-40" method="POST" id="" action="">

                                    <div class="form-group">
                                        <label class="sr-only">Nombre</label>
                                        <input type="text" class="form-control input-lg" id="nickname" name="nickname" maxlength="15" placeholder="Nombre" value=""  onkeypress="return sololetras_numeros(event)">
                                    </div>
                                     <div class="alert alert-danger alertas" style="display:none;" id="no_nombre">¡Debes colocar tu nombre!</div>
                                    
                                    <div class="form-group">
                                        <label class="sr-only">Tu E-mail</label>
                                        <input type="email" class="form-control input-lg" id="email" name="email" maxlength="150" placeholder="Tu E-mail" value="">
                                    </div>

                                    <div class="alert alert-danger alertas" style="display:none;" id="no_email">¡Debes colocar tu correo electrónico!</div>
                                    <div class="alert alert-danger alertas" style="display:none;" id="no_email_format">Debes colocar un correo electrónico válido</div>
                                    <div style="margin-bottom: 7px;margin-top: -14px;color: #05bd05;display:none;" id="valid_email"><i class="fa fa-check-circle" aria-hidden="true"></i> E-mail válido!</div>

                                    <div class="form-group">
                                        <label class="sr-only">Asunto</label>
                                        <input type="text" class="form-control input-lg" id="asunto" name="asunto" maxlength="30" placeholder="Asunto" value=""  >
                                    </div>

                                     <div class="alert alert-danger alertas" style="display:none;" id="no_asunto">¡Debes colocar el asunto!</div>

                                    <div class="form-group">
                                        <label class="sr-only">Mensaje</label>
                                        <textarea class="form-control input-lg" name="mensaje" id="mensaje" cols="30" rows="5" placeholder="Mensaje"></textarea>
                                    </div>
                                     <div class="alert alert-danger alertas" style="display:none;" id="no_mensaje">¡Debes colocar tu mensaje!</div>
                                    <div>
                                       <div class="g-recaptcha" data-sitekey="6Le5hHUUAAAAAGvMisaCzbS_-e2N0jzZVgV_V9r3"></div>
                                    </div>
                                     <div class="alert alert-danger alertas" style="display:none;" id="no_recaptcha">¡Recaptcha Incorrecto!</div>


                                    <button type="button" id="registro" class="btn btn-block btn-lg" style="float: right;  margin-top: 20px;"><i class="fa fa-paper-plane-o" aria-hidden="true" style="margin-right: 10px;"></i>Enviar</button>
                                    
                                </form>
                               
                            </div>
                           
                        </div>
                    </section>
                </div>
            </div>


        </main>
        <!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->

        <script src='https://www.google.com/recaptcha/api.js'></script>