<script src="<?= base_url() ?>public/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>public/admin/js/fullcalendar/moment.js"></script>
<script src="<?= base_url() ?>public/admin/js/tether.min.js"></script>
<script src="<?= base_url() ?>public/admin/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.js"></script>
<script src="<?= base_url() ?>public/admin/js/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>public/admin/js/custom.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/tinymce/tinymce.min.js"></script>
<script src="<?= base_url()?>public/admin/js/select2.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?= base_url() ?>public/admin/plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<script>
    $(document).ready(function() {
        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
            });
        }
        $('.select').select2({
            placeholder: '-- Selecciona los Vendedores --',
            allowClear: true,
            closeOnSelect: false,
            width: 'resolve'
        });
        $('#homeTable').DataTable({
            "lengthMenu": [[50, 100, -1], [50, 100, "Todos"]]
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#tipo").change(function() {
            var tipo = $("#tipo").val();
            if (tipo == 1) {
                window.location.href = '<?= base_url("Ayuda/newFile") ?>';
            }
            if (tipo == 2) {
                cargar($("#contentHelp"),'<?= base_url("sms") ?>');
            }
            if (tipo == 3) {
                cargar($("#contentHelp"),'<?= base_url("normas") ?>');
            }
            if (tipo == 4) {
                cargar($("#contentHelp"),'<?= base_url("resp") ?>');
            }
            if (tipo == 5) {
                cargar($("#contentHelp"),'<?= base_url("faq") ?>');
            }
            if (tipo == 6) {
               window.location.href = '<?= base_url("Ayuda/newFile") ?>';
            }
        });

        jQuery("#modal").on('hidden.bs.modal', function () {
            table.ajax.reload( null, false );
        });

    });

    function cargar (div,page) {
        $(div).load(page);
    }

    function show_modal(url, parametros, callback, json){

        if( json == undefined ){ json = false; }

        jQuery.post(
            '<?= base_url() ?>'+url,
            parametros,
            function(html){
                jQuery('#modal .data').html(html);
                jQuery('#modal').modal('show'); 
                jQuery("#form_modal").unbind("submit").bind("submit", function(e){
                    e.preventDefault();
                    var url = jQuery(this).find("#accion").val();

                    jQuery("#btn_submit_modal").html("Procesando...");
                    jQuery("#btn_submit_modal").prop("disabled", true);

                    if( !json ){
                        jQuery.post(
                            '<?= base_url() ?>'+url,
                            jQuery(this).serialize(),
                            function(html){
                                callback(html, function(html){
                                    jQuery("#btn_submit_modal").html( jQuery("#btn_submit_modal").attr("data-title") );
                                    jQuery("#btn_submit_modal").prop("disabled", false);
                                    jQuery('#modal').modal('hide'); 
                                    if( html != undefined ){
                                        console.log( html );
                                    }
                                });
                            }
                        ).fail(function(e){
                            console.log(e);
                        });
                    }else{
                        jQuery.post(
                            '<?= base_url() ?>'+url,
                            jQuery(this).serialize(),
                            function(html){
                                callback(html, function(){
                                    jQuery("#btn_submit_modal").html( jQuery("#btn_submit_modal").attr("data-title") );
                                    jQuery("#btn_submit_modal").prop("disabled", false);
                                    jQuery('#modal').modal('hide'); 
                                });
                            }, 'json'
                        ).fail(function(e){
                            console.log(e);
                        });
                    }
                });
            }
        );
    }

    function eliminar(_this){
        var confirmed = confirm("Esta seguro de eliminar este registro.?");
        if (confirmed == true) {
            var id = _this.attr("data-id");
            var url = _this.attr("data-url");
            jQuery.post(
                '<?= base_url() ?>'+url+'/delete/'+id,
                {},
                function (data) {       
                    swal({   
                        title: "Eliminado Exitosamente!",     
                        showConfirmButton: true 
                    });
                    table.ajax.reload( null, false );
                }
            );
        }
    }

</script>