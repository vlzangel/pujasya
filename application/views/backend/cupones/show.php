<?php
	if( !isset($info) ){
		echo '<input type="hidden" id="accion" value="Cupones/save/'.$info->id.'" />';
	}else{
		echo '<input type="hidden" id="accion" value="Cupones/update/'.$info->id.'" />';
	}
?>

<div class="row">
  	<div class="col-sm-4">
		<div class="form-group">
			<label for="nombre">Nombre del Cupón:</label>
			<input value="<?= $info->nombre ?>" class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del paquete" required />
		</div>
	</div>
  	<div class="col-sm-4">
		<div class="form-group">
			<label for="porcentaje">Porcentaje:</label>
			<input value="<?= $info->porcentaje ?>" class="form-control" type="number" id="porcentaje" name="porcentaje" placeholder="Porcentaje" required />
		</div>
	</div>
  	<div class="col-sm-4">
		<div class="form-group">
			<label for="finaliza">Vence:</label>
			<input value="<?= $info->finaliza ?>" class="form-control" type="date" id="finaliza" name="finaliza" required />
		</div>
	</div>
</div>