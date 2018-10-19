<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Añadir menu sidebar
                </header>
                <div class="panel-body">
                  
                  <?= $this->session->flashdata('msg') ?>

                  <?php echo validation_errors('<div class="alert alert-danger" style="width:60%;"><strong>','</strong></div>');?>

                  <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Categoría</label>
                      <div class="col-sm-10">
                        <select name="categoria_id" class="form-control" required>
                        	<option value="">--Seleccione una categoría--</option>
                        	<?php foreach ($categorias as $c): ?>
                        	<option value="<?= $c['id_categoria']?>"><?= $c['name']?></option>
                        	<?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Html al inicio</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="html_inicio" maxlength="255" placeholder="Html al inicio del menú" value="<?= set_value('html_inicio')?>">
                      </div>
                    </div>

                     <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Html al final</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="html_final" maxlength="255" placeholder="Html al final del menú" value="<?= set_value('html_final')?>">
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Estado</label>
                      <div class="col-sm-10">
                        <select name="status" class="form-control">
                          <option value="1" selected>Activo</option>
                          <option value="0">Inactivo</option>
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Posición en el listado</label>
                      <div class="col-sm-10">
                        <select name="orden" class="form-control">
                          <?php 
                          $hasta = ($count_sidebar > 0)?$count_sidebar + 1:1;
                          for ($i=1; $i <= $hasta; $i++):?>
                          <option value="<?= $i?>"><?= $i?></option>
                      	<?php endfor ?>
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <button type="submit" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                      </div>
                    </div>

                  </form>
                </div>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>

<script>
  function mostrarImagen(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#ver_'+input.id).show(0);
           $('#img_destino_'+input.id).attr('src', e.target.result);
        }
      reader.readAsDataURL(input.files[0]);
     }
    }
</script>