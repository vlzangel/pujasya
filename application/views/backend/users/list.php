<script type="text/javascript" src="<?= base_url() ?>public/lib/vlzImgs.js"></script>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Principal </h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
            <ol class="breadcrumb">
                <li><a href="<?= base_url('Administrador/home') ?>">Panel Escritorio</a></li>
                <li class="active">Usuarios</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	    <div class="col-sm-12">
	        <div class="white-box">

				<h3 class="box-title m-b-0">Listado de Usuarios</h3>
				<div class="table-responsive">
					<table id="_table" class="table table-striped">
					    <thead>
					        <tr>
					            <th> ID </th>
					            <th> Nombre </th>
					            <th> Correo </th>
					            <th> Acciones</th>
					        </tr>
					    </thead>
					    <tbody></tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>
                
<div id="modal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="data"></div>
	</div>
</div>

<style type="text/css">
    .modal.in .modal-dialog {
        -webkit-transform: translate(0,0);
        -o-transform: translate(0,0);
        transform: translate(0,0);
    }
    .modal-dialog {
        width: 1000px;
        max-width: 1000px;
    }
</style>

<script type="text/javascript">
    var table = "";
    jQuery(document).ready(function() {
        table = jQuery('#_table').DataTable({
            "language": {
                "emptyTable":           "No hay datos disponibles en la tabla.",
                "info":                 "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty":            "Mostrando 0 registros de un total de 0.",
                "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
                "infoPostFix":          " (actualizados)",
                "lengthMenu":           "Mostrar _MENU_ registros",
                "loadingRecords":       'Cargando, por favor espere... &nbsp;&nbsp; <i class="fa fa-spinner fa-spin"></i>',
                "processing":           'Procesando, por favor espere... &nbsp;&nbsp; <i class="fa fa-spinner fa-spin"></i>',
                "search":               "Buscar:",
                "searchPlaceholder":    "Dato para buscar",
                "zeroRecords":          "No se han encontrado coincidencias.",
                "paginate": {
                    "first":            "Primera",
                    "last":             "Última",
                    "next":             "Siguiente",
                    "previous":         "Anterior"
                },
                "aria": {
                    "sortAscending":    "Ordenación ascendente",
                    "sortDescending":   "Ordenación descendente"
                }
            },
            "ajax": {
                "url": "<?= base_url( 'Users/list' ) ?>",
                "type": "POST"
            }
        });

    } );

    function editar(user){
        params = {'user' : user}; 
        show_modal('Users/edit/'+user, params, function(html, cerrar){
            console.log(html);
    		cerrar();
    	}, true);  
    }

</script>