<section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Editar usuario <?= $user['name']?>
                </header>
                <div class="panel-body">
                  
                  <?= $this->session->flashdata('msg') ?>

                  <?php echo validation_errors('<div class="alert alert-danger" style="width:60%;"><strong>','</strong></div>');?>

                  <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                    
                    <?php $imagen = ($user['imagen'] == NULL)?'no-image.jpg':$user['imagen']?>

                    <img src="<?= base_url()?>public/uploads/avatars/<?= $imagen?>" alt="" id="destino_imagen" style="width: 85px;height: 85px;margin-left: 193px;margin-bottom: 18px;">
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Foto</label>
                      <div class="col-sm-10">
                        <input type="file" name="imagen" id="imagen" class="filestyle" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s">
                      </div>
                    </div>
                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" maxlength="40" value="<?= $user['name']?>" required>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Correo</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" maxlength="70" value="<?= $user['email']?>" required>
                      </div>
                    </div>
                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nombre de usuario</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="nickname" maxlength="40" value="<?= $user['nickname']?>" required>
                      </div>
                    </div>
                    
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Contraseña</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" maxlength="40">
                      </div>
                    </div>

                    <div class="alert alert-info alert-dismissable" style="width:70%; margin-left:192px;">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-info"></i> NOTA:</h4>
                      Si desea consevar la misma contraseña, deje este campo en blanco.
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Provincia</label>
                      <div class="col-sm-10">
                        <select name="provincia_id" class="form-control" id="provincia_id" required>

                        <?php foreach ($provincias as $p) : ?>

                          <option value="<?= $p['id']?>" <?= ($user['provincia_id'] == $p['id'])?'selected':''?>><?= $p['provincia']?></option>

                        <?php endforeach ?>
                        
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Localidad</label>
                      <div class="col-sm-10">
                        <select name="poblacion_id" class="form-control" id="poblacion_id" required>

                        <?php foreach ($localidades as $p) : ?>

                          <option value="<?= $p['id']?>" <?= ($user['poblacion_id'] == $p['id'])?'selected':''?>><?= $p['localidad']?></option>

                        <?php endforeach ?>
                        
                        </select>
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Dirección</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="direccion" maxlength="200" value="<?= $user['direccion']?>">
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Teléfono fijo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="telefono_fijo" maxlength="30" value="<?= $user['telefono_fijo']?>">
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Teléfono Movil</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="telefono_movil" maxlength="30" value="<?= $user['telefono_movil']?>">
                      </div>
                    </div>

                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Estado</label>
                      <div class="col-sm-10">
                        <select name="status" class="form-control">
                          <option value="1" <?= ($user['status'] == 1)?'selected':''?>>Activo</option>
                          <option value="0" <?= ($user['status'] == 0)?'selected':''?>>Inactivo</option>
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