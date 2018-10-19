$(function(){

	$("#table_data").DataTable({
		language:
		{
            "decimal":"",
            "emptyTable":     "No se encontraron registros",
            "info":           "Mostando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrado 0 a 0 de 0 Registros",
            "infoFiltered":   "",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrando _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron coincidencias",
            "paginate": 
            {
            	"first":      "Primero",
            	"last":       "Ultimo",
            	"next":       "Siguiente",
            	"previous":   "Anterior"
            },
            "aria": 
            {
            	"sortAscending":  ": Activar orden ascendente",
            	"sortDescending": ": Activar orden descendente"
            }
        },
    });

    CKEDITOR.replace('editor1');

    ///CAMBIAR IMAGEN DE PERFIL

	$('#imagen').on('change',function(){
          
       	if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (event) {
                $('#destino_imagen').attr('src', event.target.result);
            }
            reader.onerror = function(event) {
                alert("I AM ERROR: " + event.target.error.code);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    //OBTENER POBLACIONES

    $('#provincia_id').on('change',function(){
          
       	$('#poblacion_id option').remove();

       	$('#poblacion_id').append('<option value="">Cargando...</option>');

       	var url = base_url+'ajax_controller/get_poblaciones';

       	$.ajax({
         	type: 'POST',
            url:url,
            data:{'id':this.value},
            success: function (data) {
                if(data != 'error')
                {
                	$('#poblacion_id option').remove();
                	$('#poblacion_id').append(data);
                }
            },
            error: function () {
                alert('Ocurrio un error por favor intente nuevamente');
            }
        })
    });

    //OBTENER SUBCATEGORIAS

    $('#categoria_id').on('change',function(){
          
       	$('#subcategoria_id option').remove();

       	$('#subcategoria_id').append('<option value="">Cargando...</option>');

       	var url = base_url+'ajax_controller/get_subcategorias';

       	$.ajax({
         	type: 'POST',
            url:url,
            data:{'id':this.value},
            success: function (data) {
                if(data != 'error')
                {
                	$('#subcategoria_id option').remove();
                	$('#subcategoria_id').append(data);
                }
            },
            error: function () {
                alert('Ocurrio un error por favor intente nuevamente');
            }
        })
    });
});

//VALIDAR SOLO NUMEROS

function valida(e)
{
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite

    if (tecla==8)
    {
       return true;
    }

    // Patron de entrada, en este caso solo acepta numeros

    patron =/[0-9]/;

    tecla_final = String.fromCharCode(tecla);
    
    return patron.test(tecla_final);
}