$(function(){

    //cargar contador

    if(contenido == 'cuenta/publicar')
    {
        $('#count_desc').html($("#descripcion").val().length);
    }

    //Cargar chat
    if(contenido == 'cuenta/chat')
    {
        $('.chat[data-chat=person2]').addClass('active-chat');
        $('.person[data-chat=person2]').addClass('active');

        $('.left .person').mousedown(function(){
            if ($(this).hasClass('.active')) {
                return false;
            } else {
                var findChat = $(this).attr('data-chat');
                var personName = $(this).find('.name').text();
                $('.right .top .name').html(personName);
                $('.chat').removeClass('active-chat');
                $('.left .person').removeClass('active');
                $(this).addClass('active');
                $('.chat[data-chat = '+findChat+']').addClass('active-chat');
            }
        });
    }

    //OBTENER POBLACIONES FILTRO

    $('#provincia_id_filtro').on('change',function(){
          
        $('#poblacion_id option').remove();

        if(this.value == "")
        {
            $('#poblacion_id').append('<option value="">Todas las Ciudades</option>');
            return false;
        }

        $('#poblacion_id').append('<option value="">Cargando...</option>');

        var url = base_url+'ajax_controller/get_poblaciones_filtro';

        $.ajax({
            type: 'POST',
            url:url,
            data:{
                'id':this.value,
                'primer_uri':$('#primer_uri').val(),
                'segundo_uri':$('#segundo_uri').val(),
                'tercer_uri':$('#tercer_uri').val()
            },
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

    //Enviar buscador

    $('#button_search').on("click",function(){

        var cat = $('#categoria_buscador').val();
        var campo = $('#campo_buscador').val();

        $('#categoria_buscador').attr('style','border: 2px solid #ddd');
        $('#campo_buscador').attr('style','border: 2px solid #ddd');
        
        if(campo == "")
        {
            $('#campo_buscador').attr('style','border: rgba(255, 0, 0, 0.97) 1px solid');
            return false;
        }

        if(cat == "")
        {
            $('#categoria_buscador').attr('style','border: rgba(255, 0, 0, 0.97) 1px solid');
            return false;
        }

        

        window.location.href = base_url+"busqueda/"+cat+'/'+encodeURIComponent(campo).replace(/%20/g,'-');
    });

    //Mostrar imagen en los listados

    // $('#trigger_1').on("click",function() {;
    //     $('#pop-up').show();

    // });

    // var moveLeft = 10;
    // var moveDown = 10;
    
    // $('div#pop-up').hide();

    // $('li#trigger_1').hover(function(e) {
        
    //     $('div#pop-up').show();

    // });
        
    // $('li#trigger_1').mousemove(function(e) {
    //     $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    // });

    //Solicitar pack

    $('#submit_pack').on('click',function(){

        $('#no_email_pack').hide();
        $('#no_email_format_pack').hide();
        $('#no_horario_pack').hide();
        $('#no_id_pack').hide();

        var email = $('#email_pack').val();

        if(email == "")
        {
            $('#no_email_pack').show(100);
            return false;
        }

        if(validarEmail(email) == false)
        {
            $('#no_email_format_pack').show(100);
            return false;
        }

        if($('#horario_pack').val() == "")
        {
            $('#no_horario_pack').show(100);
            return false;
        }

        if($('#id_pack').val() == "")
        {
            $('#no_id_pack').show(100);
            return false;
        }

        $('#enviar_pack').submit();

    });

    //REGISTRO

    $('#registro').on('click',function(){

        limpiar_register();

        var email = $('#email').val();

        if(email == "")
        {
            $('#no_email').show(100);
            return false;
        }

        if(validarEmail(email) == false)
        {
            $('#no_email_format').show(100);
            return false;
        }

        if(validarEmailExist(email) == false)
        {
            return false;
        }

        if($('#nickname').val() == "")
        {
            $('#no_nickname').show(100);
            return false;
        }

        if(validarNicknameExist($('#nickname').val()) == false)
        {
            return false;
        }

        if($('#password').val() == "")
        {
            $('#no_password').show(100);
            return false;
        }

        if($('#re-password').val() != $('#password').val())
        {
            $('#no_match').show(100);
            return false;
        }

        $('#form_register').submit();

    });

    // CONTACTAR

    $('#vlz_contactar').on('click',function(){
        $('#vlz_contactar_form').submit();
    });

    $('#vlz_contactar_form').on('submit',function(e){

        var email = $('#email').val();

        if(email == ""){
            $('#no_email').show(100);
            e.preventDefault();
        }else{
            $('#no_email').hide(100);
        }

        if(validarEmail(email) == false){
            $('#no_email_format').show(100);
            e.preventDefault();
        }else{
            $('#no_email_format').hide(100);
        }

        if($('#nombre').val() == ""){
            $('#no_nombre').show(100);
            e.preventDefault();
        }else{
            $('#no_nombre').hide(100);
        }

        if($('#asunto').val() == ""){
            $('#no_asunto').show(100);
            e.preventDefault();
        }else{
            $('#no_asunto').hide(100);
        }

        if($('#mensaje').val() == ""){
            $('#no_mensaje').show(100);
            e.preventDefault();
        }else{
            $('#no_mensaje').hide(100);
        }

    });

    //LOGIN

    $('#login_button').on('click',function(){

        $('#no_email_login').hide(100);
        //$('#no_email_format_login').hide(100);
        $('#no_password_login').hide(100);

        if($('#email_login').val() == "")
        {
            $('#no_email_login').show(100);
            return false;
        }

        if($('#password_login').val() == "")
        {
            $('#no_password_login').show(100);
            return false;
        }
        

        $('#form_login').submit();

    });

    //CAMBIAR IMAGEN

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

    //MOSTAR CAMPOS EN PUBLICAR ANUNCIOS

    //OBTENER POBLACIONES

    $('#categoria_id_anuncios').on('change',function(){

        var id = this.value;
          
        $('#subcategoria_id option').remove();

        $('#subcategoria_id').append('<option value="">Cargando...</option>');

        var url = base_url+'ajax_controller/get_subcategorias';

        $.ajax({
            type: 'POST',
            url:url,
            data:{'id':id},
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

     //OBTENER MARCAS

    $('#subcategoria_id').on('change',function(){

        var id = this.value;
          
        $('#marca_id option').remove();

        $('#marca_id').append('<option value="">Cargando...</option>');

        var url = base_url+'ajax_controller/get_marcas';

        $.ajax({
            type: 'POST',
            url:url,
            data:{'id':id},
            success: function (data) {
                if(data != 'error')
                {
                    $('#marca_id option').remove();
                    $('#marca_id').append(data);
                }
            },
            error: function () {
                alert('Ocurrio un error por favor intente nuevamente');
            }
        })
    });

        //Filtro ordenar por

    $('#ordenar_por_filter').on('change',function(){
        var redir = $(this).val();
        window.location.href = redir;
    });

    ///VALIDAR PUBLICAR ANUNCIOS

    $('#siguiente_publicar').on("click",function(){
        
        if(validar_primer_paso() == false)
        {
            return false;
        }
        else
        {
            $('#primer_box_form').hide(100);

            $('#block_imagenes').show(100);

            
            if($('#categoria_id_anuncios').val() == 1 || $('#categoria_id_hidden').val() == 1)
            {
                $('#tipo_anuncio').html('');
                $('#tipo_anuncio').append('Vehiculo');
                $('#segundo_box_form_1').show(100);
                
            }

            if($('#categoria_id_anuncios').val() == 3 || $('#categoria_id_hidden').val() == 3)
            {
                $('#tipo_anuncio').html('');
                $('#tipo_anuncio').append('Inmueble');
                $('#segundo_box_form_3').show(100);
                
            }

            $(this).hide(0);

            $('#atras_publicar').show(0);

            $('#publicar_anuncio').attr('style','float:right;margin-right: -9% !important;margin-top: 20%;');

            $('#publicar_anuncio').show(0);

            $(this).hide('disabled',true);
        }
    });

    $('#atras_publicar').on("click",function(){
        
        $('#segundo_box_form_3').hide(100);
        $('#segundo_box_form_1').hide(100);
        $('#block_imagenes').hide(100);
        $('#primer_box_form').show(100);
        $('#tipo_anuncio').html('');
        $('#tipo_anuncio').append('Anuncio');

        $(this).hide(0);

        $('#publicar_anuncio').hide(0);

        $('#siguiente_publicar').show(0);

        $('#siguiente_publicar').attr('disabled',false);
        
    });


    $('#publicar_anuncio').on('click',function(){

        if(validar_primer_paso() == false)
        {
            $('#segundo_box_form_3').hide(100);
            $('#segundo_box_form_1').hide(100);
            $('#block_imagenes').hide(100);
            $('#tipo_anuncio').html('');
            $('#tipo_anuncio').append('Anuncio');
            $('#primer_box_form').show(100);
            return false;
        }

        if($('#categoria_id_anuncios').val() == 1 || $('#categoria_id_hidden').val() == 1)
        {
            if($('#marca_id').val() == "")
            {
                $('#no_marca').show(100);
                return false;
            }

            if($('#version').val() == "")
            {
                $('#no_version').show(100);
                return false;
            }

            if($('#year').val() == "")
            {
                $('#no_year').show(100);
                return false;
            }

            if($('#combustible').val() == "")
            {
                $('#no_combustible').show(100);
                return false;
            }

            if($('#kilometraje').val() == "")
            {
                $('#no_kilometraje').show(100);
                return false;
            }
        }

        if($('#categoria_id_anuncios').val() == 3 || $('#categoria_id_hidden').val() == 3)
        {
            if($('#tipo_operacion').val() == "")
            {
                $('#no_operacion').show(100);
                return false;
            }

            if($('#provincia_id').val() == "")
            {
                $('#no_provincia').show(100);
                return false;
            }

            if($('#poblacion_id').val() == "")
            {
                $('#no_ciudad').show(100);
                return false;
            }

            // if($('#direccion').val() == "")
            // {
            //     $('#no_direccion').show(100);
            //     return false;
            // }
        }

        if($('#img_0').val() == "" && $('#img_1').val() == "" && $('#img_2').val() == ""
        && $('#img_3').val() == "" && $('#images_img_0').val() == "" && $('#images_img_1').val() == "" 
        && $('#images_img_2').val() == "" && $('#images_img_3').val() == "")
        {
            $('#no_imagen').show(100);
            return false;
        }

        for (var i = 0; i < 4; i++) {

            var imagen = $('#img_'+i).val();

            if(imagen != "")
            {
                var extension = imagen.substring(imagen.lastIndexOf('.') + 1).toLowerCase();

                if(extension != 'jpg' && extension != 'jpeg')
                {
                    $('#no_format_imagen').show(100);
                    return false;
                }
            }
        };

        $('#publicar_anuncio').attr('disabled',true);

        //$('#file-image').show(0);

        $('#file-upload-form').submit();
    });


    //Redireccionar al detalle

    $('figure.deal-thumbnail').on("click", function(){
        window.location.href = base_url+'anuncio/'+this.id;
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

function sololetras(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales)
    {
        if(key == especiales[i])
        {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function sololetras_numeros(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789";
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales)
    {
        if(key == especiales[i])
        {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function sololetras_numeros_email(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "áéíóúabcdefghijklmnñopqrstuvwxyz0123456789@_-.";
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales)
    {
        if(key == especiales[i])
        {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function normal_field(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = ' ().-,/#$%&?¡-+!áéíóúabcdefghijklmnñopqrstuvwxyz0123456789';
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales)
    {
        if(key == especiales[i])
        {
            tecla_especial = true;
            break;
        }
    }

    if(key == 13)
    {
        tecla_especial = true;
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function telefono_mask(e)
{
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "1234567890+-() ";
    especiales = "8-37-39-46";

    tecla_especial = false;

    for(var i in especiales)
    {
        if(key == especiales[i])
        {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function validarEmail(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   return true;
  } else {
   return false;
  }
}

function validarEmailExist(email)
{
    //Validar existencia del email

    if(email != "")
    {
         limpiar_register();

        if(validarEmail(email) == false)
        {
            $('#no_email_format').show(100);
            return false;
        }

       

        var url = base_url+'ajax_controller/get_email';

        var returned = true;

        $.ajax({
            type: 'POST',
            url:url,
            data:{'email':email},
            async: false,
            success: function (data) {
                
                if(data == 'error')
                {
                    $('#invalid_email').show(200);
                    returned = false;
                }
                else
                {
                    $('#valid_email').show(200);
                }

                  
            },
            error: function () {
                alert('Ocurrio un error por favor intente nuevamente');
            }
        });

        if(returned == false)
        {
            return false;
        }
    }
}

function validarNicknameExist(nickname)
{
    //Validar existencia del nickname

    if(nickname != "")
    {
        limpiar_register();

        var url = base_url+'ajax_controller/get_nickname';

        var returned = true;

        $.ajax({
            type: 'POST',
            url:url,
            data:{'nickname':nickname},
            async: false,
            success: function (data) {
                
                if(data == 'error')
                {
                    $('#invalid_nickname').show(200);
                    returned = false;
                }
                else
                {
                    $('#valid_nickname').show(200);
                }

                  
            },
            error: function () {
                alert('Ocurrio un error por favor intente nuevamente');
            }
        });

        if(returned == false)
        {
            return false;
        }

    }

    
}

function limpiar_register()
{
    $('#no_email').hide(100);
    $('#no_email_format').hide(100);
    $('#valid_email').hide(100);
    $('#invalid_email').hide(100);
    $('#valid_nickname').hide(100);
    $('#invalid_nickname').hide(100);
    $('#no_nickname').hide(100);
    $('#no_password').hide(100);
    $('#no_match').hide(100);
}

function limpiar_publicar()
{
    $('#no_categoria').hide(100);
    $('#no_subcategoria').hide(100);
    $('#no_titulo').hide(100);
    $('#no_descripcion').hide(100);
    $('#no_imagen').hide(100);
    $('#no_marca').hide(100);
    $('#no_version').hide(100);
    $('#no_year').hide(100);
    $('#no_combustible').hide(100);
    $('#no_kilometraje').hide(100);
    $('#no_operacion').hide(100);
    $('#no_provincia').hide(100);
    $('#no_ciudad').hide(100);
    $('#no_direccion').hide(100);
    $('#no_titulo_minimo').hide(100);
    $('#no_descripcion_minimo').hide(100);
    $('#no_format_imagen').hide(100);
    $('#no_size_imagen').hide(100);
    
}

function favoritos(id)
{
    var url = base_url+'ajax_controller/save_favoritos';

    $('#texto_favoritos').html('');
    $('#texto_favoritos').append('Espere...');

    $.ajax({
        type: 'POST',
        url:url,
        data:{'id':id},
        success: function (data) {
                
            if(data != 'success')
            {
                $('#error_favoritos').html('');
                $('#error_favoritos').append(data);
                $('#error_favoritos').show(200);
            }
            else
            {
                $('#success_favoritos').show(1000);
                $("#favoritos_div a").attr("href", base_url+"cuenta/favoritos");
                $("#favoritos_div a").attr("onclick", "");
                $("#favoritos_div a").attr("target", "_blank");
                $('#texto_favoritos').html('');
                $('#texto_favoritos').append('¡Guardado!');
            }
        },
        error: function () {
            alert('Ocurrio un error por favor intente nuevamente');
        }
    });
}

function favoritos_listado(id)
{
    var url = base_url+'ajax_controller/save_favoritos';

    $('#error_favoritos').hide(0);
    $('#success_favoritos').hide(0);

    $.ajax({
        type: 'POST',
        url:url,
        data:{'id':id},
        success: function (data) {
                
            if(data != 'success')
            {
                $('#error_favoritos').html('');
                $('#error_favoritos').append(data);
                $('#error_favoritos').show(200);
            }
            else
            {
                $('#success_favoritos').show(1000);
                $("#favoritos_span_"+id+" a").attr("href", base_url+"cuenta/favoritos");
                $("#favoritos_span_"+id+" a").attr("onclick", "");
                $("#favoritos_span_"+id+" a").attr("style", "color: #fb9029");
                $("#favoritos_span_"+id+" a").attr("target", "_blank");
            }
        },
        error: function () {
            alert('Ocurrio un error por favor intente nuevamente');
        }
    });
}

//Desechar imagen

function desechar_img(id)
{
    var input = $('#'+id);

    input.replaceWith(input.val('').clone(true));

    $('#img_destino_'+id).attr('src', base_url+'public/uploads/anuncios/mas_image.png');
    $('#desechar_'+id).hide(0);

    var image = $('#images_'+id).val();

    if(image != "")
    {
        $('#deletes').append('<input type="hidden" name="delete[]" value="'+image+'">');
        $('#images_'+id).val('');
    }
}

function validar_primer_paso()
{
    limpiar_publicar();

    if($('#categoria_id_anuncios').val() == "")
    {
        $('#no_categoria').show(100);
         return false;
    }

    if($('#subcategoria_id').val() == "")
    {
        $('#no_subcategoria').show(100);
        return false;
    }

    var titulo = $('#titulo').val();

    if(titulo == "")
    {
         $('#no_titulo').show(100);
        return false;
    }

    if(titulo.length < 5)
    {
        $('#no_titulo_minimo').show(100);
        return false;
    }

    var descripcion = $('#descripcion').val();

    if(descripcion == "")
    {
        $('#no_descripcion').show(100);
        return false;
    }

    if(descripcion.length < 20)
    {
        $('#no_descripcion_minimo').show(100);
        return false;
    }

    return true;
}


function solicitar_pack(id)
{
    $('#tipo_solicitud').html('');

    $('#tipo_solicitud').append('Solicitar Pack PREMIUM');

    if(id == 1)
    {
        $('#paquete_pack').val('Plan Emprendedores');
    }

    if(id == 2)
    {
        $('#paquete_pack').val('Plan Pequeños Negocios');
    }

    if(id == 3)
    {
        $('#paquete_pack').val('Plan Empresas');
    }


    if(id == 4)
    {
        $('#tipo_solicitud').html('');

        $('#tipo_solicitud').append('Solicitar BANNER Publicitario');

        $('#paquete_pack').val('BANNER PUBLICITARIO EN SECCIONES');
    }

    $('#id_pack').val(id);

    $('#modal_pack').modal('show');
}





