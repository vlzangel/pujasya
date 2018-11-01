
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    

    	<div class="modal fade" id="modalReportar">
                    
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
						
                        <div class="page-heder">
                            <h3 class="text-center">Reportar Duda</h3>    
                            <hr>
                        </div>

                        <form method="post" id="niggling">
                            <div class="form-body">
                                <div class="row">
                                    <input type="hidden" name="niggling_user" value="<?= $_SESSION['id_vendor'];?>">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Asunto</label>
                                            <input type="text" name="niggling_subject" class="form-control"  id="niggling_subject" data-validation="required" data-validation-error-msg="El campo es requerido">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Mensaje</label>
                                            <textarea name="niggling_message" class="form-control"  id="niggling_message" rows="5" data-validation="required" data-validation-error-msg="El campo es requerido"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Enviar Mensaje</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </form>
                    </div>
                </div>

<!-- jQuery -->
<script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script>
    $.validate({
      lang : 'es'
    });

    $(document).ready(function() {

        
        $('form#niggling').on('submit', function(ev){
            
            ev.preventDefault();
            ev.stopPropagation();
            
           $.ajax({
                method: "POST",
                url: "<?= base_url();?>Nigglings/create",
                data: new FormData(this),
                processData : false,
                contentType : false,
                type: 'json'
            })
              .done(function(data) {
                info = $.parseJSON(data);
                
                if (info.type == 'success') {
                    $('form#niggling')[0].reset();
                    $('button.close').click();
                    
                    swal({
                        title: info.message,
                        text: "Hemos recibido tu mensaje, pronto te responderemos!",
                        icon: "success",
                        button: "ok",
                    });
                }else{
                    swal({
                        title: info.message,
                        text: "Por favor intenta nuevamente",
                        icon: "error",
                        button: "ok",
                    });
                }
                setTimeout(redirect,1000);
              });

        });

    });

    function redirect ()
    {
        window.location.href = '<?= base_url('dudasVendedor')?>';
    }

</script>