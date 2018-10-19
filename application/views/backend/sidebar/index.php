<section id="content">
          <section class="vbox">
            <header class="header bg-white b-b b-light">
              <a href="<?= base_url('admin/sidebar/add')?>" class="btn btn-s-md btn-success btn-rounded">Crear menú sidebar</a>
            </header>
            <section class="scrollable wrapper w-f">
              <section class="panel panel-default">
                <header class="panel-heading">
                  Administrar Menus del sidebar
                  <?= $this->session->flashdata('msg') ?>
                </header>
                <div class="table-responsive">

                  <table class="table table-striped b-t b-light" id="table_data">
                    <thead>
                      <tr>
                        <!-- <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th> -->
                        
                        <th>Categoria</th>
                        <th>Posición</th>
                        <th>Estado</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php if(sizeof($menu_sidebar) > 0): ?>
                      <?php foreach ($menu_sidebar as $d): ?>
                      <tr>
                        <!-- <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="post[]"><i></i></label></td> -->
                        <td><?= $d['name']?></td>
                        <td>
                          <form action="<?= base_url('admin/sidebar/cambiar_posicion')?>" method="POST">
                          <select name="orden">
                          <?php 
                            $hasta = ($count_sidebar > 0)?$count_sidebar:1;
                            for ($i=1; $i <= $hasta; $i++):?>
                            <option value="<?= $i?>" <?= $i == $d['orden']?'selected':''?>><?= $i?></option>
                          <?php endfor ?>

                          </select>
                          <input type="hidden" name="id" value="<?= $d['id_sidebar']?>">
                          <button type="submit" class="btn btn-primary" style="padding: 3px;margin-bottom: 5px;">Cambiar</button>
                          </form>
                      </td>
                        <td><?= $d['status'] == 1?'<span style="color:green">Activa</span>':'<span style="color:red">Inactiva</span>'?></td>
                        <td>
                          <div class="btn-group">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil text-danger"></i></a>
                            <ul class="dropdown-menu pull-right">
                              <li><a href="<?= base_url('admin/sidebar/edit/'.$d['id_sidebar'])?>">Editar</a></li>
                              <li class="divider"></li>
                              <li><a href="javascript:;" onclick="eliminar(<?= $d['id_sidebar']?>);">Borrar</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach;  endif ?>
                     
                    </tbody>
                  </table>
                </div>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>


<div class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url()?>admin/sidebar/delete" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Eliminar menú sidebar</h4>
        </div>
        <div class="modal-body">
          <p>En realidad deseas eliminar este menú? </p>
          <input type="hidden" name="id" id="id_borrar">
        </div>
        <div class="modal-footer">
          <button type="submit" id="confirmar" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function eliminar(id)
  {
    $('#id_borrar').val(id);
    $('#borrar').modal('show');
  }
</script>
