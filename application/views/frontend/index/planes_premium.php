<!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
<main id="mainContent" class="main-content">
  <!-- Page Container -->
  <div class="page-container ptb-60">
    <div class="container">
      <div class="pricingTable">
        <h2 class="pricingTable-title">Promocionate con PujasYA</h2>
        <h3 class="pricingTable-subtitle">es sencillo, rápido y eficiente. Es PREMIUM.</h3>
        <?= $this->session->flashdata('msg')?>
        <ul class="pricingTable-firstTable">
          <li class="pricingTable-firstTable_table">
            <h1 class="pricingTable-firstTable_table__header" style="    font-size: 24px;">Emprendedores</h1>
            <p class="pricingTable-firstTable_table__pricing"><span>$</span><span>780</span><span>/ Mes</span></p>
            <ul class="pricingTable-firstTable_table__options">
              <li>hasta 10 anuncios PREMIUM (no expiran)</li>
              <li>+ 15 anuncios BÁSICOS</li>
              <li>tu perfil listado de anuncios</li>
              <li>publicá en todas las Categorías</li>
              <li>mensajes privados clientes</li>
            </ul>
            <div class="pricingTable-firstTable_table__getstart" onclick="solicitar_pack(1)">SOLICITAR PACK</div>
          </li>
          <li class="pricingTable-firstTable_table">
            <h1 class="pricingTable-firstTable_table__header" style="    font-size: 24px;">Pequeños Negocios</h1>
            <p class="pricingTable-firstTable_table__pricing"><span>$</span><span>1250</span><span>/ Mes</span></p>
            <ul class="pricingTable-firstTable_table__options">
              <li>hasta 22 anuncios PREMIUM  (no expiran)</li>
              <li>+ 25 anuncios BÁSICOS</li>
              <li>tu perfil listado de anuncios</li>
              <li>publicá en todas las Categorías</li>
              <li>mensajes privados clientes</li>
              <li>promocionamos tus avisos en redes sociales</li>
              <li>agente Soporte 24/7 (whatsapp)</li>
            </ul>
            <div class="pricingTable-firstTable_table__getstart" onclick="solicitar_pack(2)">SOLICITAR PACK</div>
          </li>
          <li class="pricingTable-firstTable_table">
            <h1 class="pricingTable-firstTable_table__header" style="    font-size: 24px;">Empresas</h1>
            <p class="pricingTable-firstTable_table__pricing"><span>$</span><span>2400</span><span>/ Mes</span></p>
            <ul class="pricingTable-firstTable_table__options">
              <li>hasta 50 anuncios PREMIUM  (no expiran)</li>
              <li>+ 50 anuncios BÁSICOS</li>
              <li>tu perfil listado de anuncios</li>
              <li>publicá en todas las Categorías</li>
              <li>mensajes privados clientes</li>
              <li>promocionamos tus anuncios en redes sociales</li>
              <li>agente Soporte 24/7 (whatsapp)</li>
              <li>banner 230x122 menu lateral en 1 categoría elegida</li>
            </ul>
            <div class="pricingTable-firstTable_table__getstart" onclick="solicitar_pack(3)">SOLICITAR PACK</div>
          </li>
        </ul>
        

        <h3 class="pricingTable-subtitle" style="font-size: 19px;margin-top: 50px">Todos los anuncios PREMIUM serán mostrados destacados<br> en cada categoría, a su vez en la página de inicio de PujasYA.com</h3>


       
<div class="widget-body ptb-20" style="padding-bottom: 123px;    text-align: center;">
                    <img src="<?= base_url()?>public/assets/images/propiedades_clasificados_argentina.jpg" alt="" style="border-radius: 9px; width: 100%; max-width: 794px;">
                  </div>



        <div class="pricingTable-firstTable_table__getstart" onclick="solicitar_pack(4)" style="max-width: 367px;text-transform: uppercase;text-align: center;margin: 0 auto;margin-top: 57px;">¿Solo querés espacio Publicitario?</div>
      </div>


<div class="widget-body ptb-20" style="padding-bottom: 123px;    text-align: center;">
                    <img src="<?= base_url()?>public/assets/images/CLASIFICADOS_premium_cordoba_mini.jpg" alt="" style="    border-radius: 9px;">
                  </div>


    </div>
  </div>
</main>
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
  /**
  Coded by /u/j0be in scss.
  See scss source here -> http://codepen.io/j0be/pen/MKRVyN
  */
@charset "UTF-8"; .pricingTable { margin: 40px auto; } .pricingTable > .pricingTable-title { text-align: center; color: #6e768d; font-size: 3em; font-size: 300%; margin-bottom: 20px; letter-spacing: 0.04em; } .pricingTable > .pricingTable-subtitle { text-align: center; color: #b4bdc6; font-size: 1.8em; letter-spacing: 0.04em; margin-bottom: 60px; } @media screen and (max-width: 480px) { .pricingTable > .pricingTable-subtitle { margin-bottom: 30px; } } .pricingTable-firstTable { list-style: none; padding-left: 2em; padding-right: 2em; text-align: center; } .pricingTable-firstTable_table { vertical-align: middle; width: 31%; background-color: #ffffff; display: inline-block; padding: 0px 30px 40px; text-align: center; max-width: 320px; transition: all 0.3s ease; border-radius: 5px; } @media screen and (max-width: 767px) { .pricingTable-firstTable_table { display: block; width: 90%; margin: 0 auto; max-width: 90%; margin-bottom: 20px; padding: 10px; padding-left: 20px; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table > * { display: inline-block; vertical-align: middle; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table > * { display: block; float: none; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table:after { display: table; content: ''; clear: both; } } .pricingTable-firstTable_table:hover { transform: scale(1.08); } @media screen and (max-width: 767px) { .pricingTable-firstTable_table:hover { transform: none; } } .pricingTable-firstTable_table:not(:last-of-type) { margin-right: 3.5%; } @media screen and (max-width: 767px) { .pricingTable-firstTable_table:not(:last-of-type) { margin-right: auto; } } .pricingTable-firstTable_table:nth-of-type(2) { position: relative; } @media screen and (max-width: 767px) { .pricingTable-firstTable_table:nth-of-type(2) h1 { padding-top: 8%; } } .pricingTable-firstTable_table:nth-of-type(2):before { content: 'MÁS ELEGIDO'; position: absolute; color: white; display: block; background-color: #3bbdee; text-align: center; right: 15px; top: -25px; height: 65px; width: 65px; border-radius: 50%; box-sizing: border-box; font-size: 0.5em; padding-top: 22px; text-transform: uppercase; letter-spacing: 0.13em; transition: all 0.5s ease; } @media screen and (max-width: 988px) { .pricingTable-firstTable_table:nth-of-type(2):before { font-size: 0.6em; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table:nth-of-type(2):before { left: 10px; width: 45px; height: 45px; top: -10px; padding-top: 13px; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table:nth-of-type(2):before { font-size: 0.8em; } } .pricingTable-firstTable_table:nth-of-type(2):hover:before { transform: rotate(360deg); } .pricingTable-firstTable_table__header { font-size: 1.6em; padding: 40px 0px; border-bottom: 2px solid #ebedec; letter-spacing: 0.03em; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__header { font-size: 1.45em; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__header { padding: 0px; border-bottom: none; float: left; width: 33%; padding-top: 3%; padding-bottom: 2%; } } @media screen and (max-width: 610px) { .pricingTable-firstTable_table__header { font-size: 1.3em; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table__header { float: none; width: 100%; font-size: 1.8em; margin-bottom: 5px; } } .pricingTable-firstTable_table__pricing { font-size: 3em; padding: 30px 0px; border-bottom: 2px solid #ebedec; line-height: 0.7; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__pricing { font-size: 2.8em; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__pricing { border-bottom: none; padding: 0; float: left; clear: left; width: 33%; } } @media screen and (max-width: 610px) { .pricingTable-firstTable_table__pricing { font-size: 2.4em; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table__pricing { float: none; width: 100%; font-size: 3em; margin-bottom: 10px; } } .pricingTable-firstTable_table__pricing span:first-of-type { font-size: 0.35em; vertical-align: top; letter-spacing: 0.15em; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__pricing span:first-of-type { font-size: 0.3em; } } .pricingTable-firstTable_table__pricing span:last-of-type { vertical-align: bottom; font-size: 0.30em; letter-spacing: 0.04em; padding-left: 0.2em; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__pricing span:last-of-type { font-size: 0.25em; } } .pricingTable-firstTable_table__options { list-style: none; padding: 15px; font-size: 0.9em; border-bottom: 2px solid #ebedec; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__options { font-size: 0.85em; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__options { border-bottom: none; padding: 0; margin-right: 10%; } } @media screen and (max-width: 610px) { .pricingTable-firstTable_table__options { font-size: 0.7em; margin-right: 8%; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table__options { font-size: 1.3em; margin-right: none; margin-bottom: 10px; } } .pricingTable-firstTable_table__options > li { padding: 8px 0px; } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__options > li { text-align: left; } } @media screen and (max-width: 610px) { .pricingTable-firstTable_table__options > li { padding: 5px 0; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table__options > li { text-align: center; } } .pricingTable-firstTable_table__options > li:before { content: '✓'; display: inline-block; margin-right: 15px; color: white; background-color: #74ce6a; border-radius: 50%; width: 15px; height: 15px; font-size: 0.8em; padding: 2px; text-align: center; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__options > li:before { width: 14px; height: 14px; padding: 1.5px; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__options > li:before { width: 12px; height: 12px; } } .pricingTable-firstTable_table__getstart { color: white; background-color: #71ce73; margin-top: 30px; border-radius: 5px; cursor: pointer; padding: 15px; box-shadow: 0px 3px 0px 0px #66ac64; letter-spacing: 0.07em; transition: all 0.4s ease; } @media screen and (max-width: 1068px) { .pricingTable-firstTable_table__getstart { font-size: 0.95em; } } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__getstart { margin-top: 0; } } @media screen and (max-width: 610px) { .pricingTable-firstTable_table__getstart { font-size: 0.9em; padding: 10px; } } @media screen and (max-width: 480px) { .pricingTable-firstTable_table__getstart { font-size: 1em; width: 50%; margin: 10px auto; } } .pricingTable-firstTable_table__getstart:hover { transform: translateY(-10px); box-shadow: 0px 40px 29px -19px rgba(102, 172, 100, 0.9); } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__getstart:hover { transform: none; box-shadow: none; } } .pricingTable-firstTable_table__getstart:active { box-shadow: inset 0 0 10px 1px #66a564, 0px 40px 29px -19px rgba(102, 172, 100, 0.95); transform: scale(0.95) translateY(-9px); } @media screen and (max-width: 767px) { .pricingTable-firstTable_table__getstart:active { transform: scale(0.95) translateY(0); box-shadow: none; } }
</style>

<div class="modal fade" id="modal_pack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('index/solicitar_pack')?>" id="enviar_pack" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="tipo_solicitud"></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" name="paquete" id="paquete_pack" readonly>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" maxlength="80" name="email" id="email_pack" placeholder="Tu E-mail">
        </div>

        <div class="alert alert-danger alertas" style="display:none;" id="no_email_pack">¡Tenés que colocar tu correo electrónico!</div>
        <div class="alert alert-danger alertas" style="display:none;" id="no_email_format_pack">Tenés que colocar un correo electrónico válido</div>
        
        <div class="form-group">
          <input type="text" class="form-control" maxlength="15" name="telefono" id="telefono_pack" placeholder="Fijo o Celular" onkeypress="return telefono_mask(event)">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" maxlength="100" name="horario" id="horario_pack" placeholder="Horario/Día que quiere ser Contactado">
        </div>

        <div class="alert alert-danger alertas" style="display:none;" id="no_horario_pack">¡Tenés que colocar un horario o Día para ser contactado!</div>

        <div class="form-group">
          <textarea name="info" id="info_pack" maxlength="300" cols="30" rows="10" class="form-control" placeholder="Información adicional a solicitar..."></textarea>
        </div>

         <div class="alert alert-danger alertas" style="display:none;" id="no_id_pack">¡Ha ocurrido un error durante el proceso!</div>

      </div>
      <input type="hidden" value="" id="id_pack" name="id_pack">
      <div class="modal-footer">
        <button type="button" id="submit_pack" class="btn btn-primary">ENVIAR</button>
        <button type="button" class="btn btn-default" style="background-color: #607b92;" data-dismiss="modal">CERRAR</button>
      </div>
      </form>
    </div>
  </div>
</div>
