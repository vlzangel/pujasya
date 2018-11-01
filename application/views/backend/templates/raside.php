<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> Opciones <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            <form method="post" onsubmit="savePass();return false;" id="act_pass_user">
                <ul>
                    <li><b>Cambiar mis datos</b></li>
                    <li>
                        <div class="form-group">
                            <label for="user"> Usuario </label>
                            <input id="text" type="user" class="form-control"  name="user" value="<?= $this->session->userdata('username') ?>">
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <label for="email"> Correo </label>
                            <input id="email" type="email" class="form-control" name="email" value="<?= $this->session->userdata('email') ?>">
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <label for="password"> Clave </label>
                            <input id="password" type="password" class="form-control" required name="password">
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <button class="btn btn-success">Guardar</button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    function savePass(user) {
        $.ajax({
            url: '<?= base_url("savePass") ?>',
            type: 'POST',
            data: $("#act_pass_user").serialize(),
            success: function () {
                swal({   
                    title: "Exito",   
                    text: "El cambio de Clave se llevo a cabo de manera exitosa, debe iniciar sesion nuevamente tras este cambio.\n por lo cual la sesion se cerrara ahora.",   
                    timer: 3000,   
                    showConfirmButton: true 
                }, function(isConfirm){
                    window.location = "<?= base_url() ?>";
                });
            }  
        });
    }
</script>