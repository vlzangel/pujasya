<section id="content">
          <section class="vbox">
            <header class="header bg-white b-b b-light">
              <a href="<?= base_url('admin/categories/add')?>" class="btn btn-s-md btn-success btn-rounded">Crear Categoria</a>
            </header>
            <section class="scrollable wrapper w-f">
              <section class="panel panel-default">
                <header class="panel-heading">
                  Administrar Categorias
                  <?= $this->session->flashdata('msg') ?>
                </header>
                <div class="table-responsive">

                  <table class="table table-striped b-t b-light" id="table_data">
                    <thead>
                      <tr>
                        <!-- <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th> -->
                        
                        <th>Nombre</th>
                        <th>URL SEO</th>
                        <th>Estado</th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php if(sizeof($categorias) > 0): ?>
                      <?php foreach ($categorias as $d): ?>
                      <tr>
                        <!-- <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="post[]"><i></i></label></td> -->
                        <td><?= $d['name']?></td>
                        <td><?= $d['seo']?></td>
                        <td><?= $d['status'] == 1?'<span style="color:green">Activa</span>':'<span style="color:red">Inactiva</span>'?></td>
                        <td>
                          <div class="btn-group">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil text-danger"></i></a>
                            <ul class="dropdown-menu pull-right">
                              <li><a href="<?= base_url('admin/categories/edit/'.$d['id_categoria'])?>">Editar</a></li>
                              <li class="divider"></li>
                              <li><a href="javascript:;" onclick="eliminar(<?= $d['id_categoria']?>);">Borrar</a></li>
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
      <form action="<?php echo base_url()?>admin/categories/delete" method="POST">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Eliminar Categoría</h4>
        </div>
        <div class="modal-body">
          <p>En realidad deseas eliminar esta categoría? </p>
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
