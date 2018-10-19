<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Editar categoría <?= $categoria['name']?>
                </header>
                <div class="panel-body">
                  
                  <?= $this->session->flashdata('msg') ?>

                  <?php echo validation_errors('<div class="alert alert-danger" style="width:60%;"><strong>','</strong></div>');?>

                  <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    
    
                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" maxlength="200" placeholder="Nombre de la categoria" value="<?= $categoria['name']?>" required>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Url Seo</label>
                      <div class="col-sm-10">
                        <input type="seo" class="form-control" name="seo" maxlength="200" placeholder="Dirección para el SEO ejm. autos-nuevos" value="<?= $categoria['seo']?>" required>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Estado</label>
                      <div class="col-sm-10">
                        <select name="status" class="form-control">
                          <option value="1" <?= $categoria['status'] == 1?'selected':''?>>Activo</option>
                          <option value="0" <?= $categoria['status'] == 0?'selected':''?>>Inactivo</option>
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <a href="<?= base_url('admin/categories')?>" class="btn btn-default">Cancelar</a>
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