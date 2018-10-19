<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Editar anuncio <?= $anuncio['titulo']?>
                </header>
                <div class="panel-body">
                  
                  <?= $this->session->flashdata('msg') ?>

                  <?php echo validation_errors('<div class="alert alert-danger" style="width:60%;"><strong>','</strong></div>');?>

                  <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Título</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="titulo" maxlength="200" placeholder="Título del anuncio" value="<?= $anuncio['titulo']?>" required>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Url Seo</label>
                      <div class="col-sm-10">
                        <input type="seo" class="form-control" name="seo" maxlength="200" placeholder="Dirección para el SEO ejm. auto-nuevo" value="<?= $anuncio['seo']?>" required>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Descripción</label>
                      <div class="col-sm-10">
                        <textarea name="descripcion" id="editor1" class="form-control" cols="30" rows="10"><?= $anuncio['descripcion']?></textarea>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Categoría</label>
                      <div class="col-sm-10">
                        <select name="categoria_id" id="categoria_id" class="form-control">

                          <?php foreach ($categorias as $c): ?>
                            <option value="<?= $c['id_categoria']?>" <?= $anuncio['categoria_id'] == $c['id_categoria']?'selected':''?>><?= $c['name']?></option>
                          <?php endforeach ?>

                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Subcategoría</label>
                      <div class="col-sm-10">
                        <select name="subcategoria_id" id="subcategoria_id" class="form-control">

                          <?php foreach ($subcategorias as $c): ?>
                            <option value="<?= $c['id_subcategoria']?>" <?= $anuncio['subcategoria_id'] == $c['id_subcategoria']?'selected':''?>><?= $c['name']?></option>
                          <?php endforeach ?>
                          
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Estado</label>
                      <div class="col-sm-10">
                        <select name="status" class="form-control">
                          <option value="1" <?= $anuncio['status'] == 1?'selected':''?>>Activo</option>
                          <option value="0" <?= $anuncio['status'] == 0?'selected':''?>>Inactivo</option>
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Costo</label>
                      <div class="col-sm-2">
                        <select name="status" class="form-control">
                          <option value="1" <?= $anuncio['moneda'] == 1?'selected':''?>>ARS</option>
                          <option value="0" <?= $anuncio['moneda'] == 2?'selected':''?>>USD</option>
                        </select>
                      </div>
                       <div class="col-sm-6">
                        <input type="text" class="form-control" name="costo" maxlength="12" placeholder="Costo" value="<?= $anuncio['costo']?>" onkeypress="return valida(event)" required>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Imágenes</label>
                      <div class="col-sm-10">
                        <?php if(count($imagenes) > 0): $i = 0; ?>
                        <?php foreach ($imagenes as $img):?>
                          <img src="<?= base_url('public/uploads/anuncios/'.$img['name'])?>" alt="" style="width:90px;height:90px;">
                        <?php  $i++; endforeach; endif ?>

                        <?php 
                        $faltantes = 5 - count($imagenes);
                        if($faltantes > 0):
                        for ($i=$i; $i < $faltantes; $i++):?>
                        <label for="img_<?= $i?>">
                        <img src="<?= base_url('public/uploads/anuncios/mas_image.png')?>" id="img_destino_img_<?= $i?>" alt="" style="width:90px;height:90px;">
                        </label>
                        <input type="file" style="display:none;" name="img_<?= $i?>" id="img_<?= $i?>" onchange="mostrarImagen(this)">
                        <?php endfor; endif ?>
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
           $('#img_destino_'+input.id).attr('src', e.target.result);
        }
      reader.readAsDataURL(input.files[0]);
     }
    }
</script>