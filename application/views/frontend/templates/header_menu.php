<style>
  @media only screen and (max-width: 1200px ){
    .ocultar1000 {
      display:none !important;
    }
  }
</style>
<div class="modal fade" id="cancelarcuenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <form action="<?= base_url('cuenta/borrar_anuncio_favoritos')?>" method="POST">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cancelar Cuenta</h4>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro que quieres Cancelar tu cuenta? <br>
        No podrás acceder más a tu perfil, ni a tus Pujas</p>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_eliminar" name="id">
        <button type="submit" class="btn btn-primary" >Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No,Gracias</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function cancelarcuenta(id) {
    $('#id_cancelar').val(id);
    $('#cancelarcuenta').modal('show');
  }
</script>