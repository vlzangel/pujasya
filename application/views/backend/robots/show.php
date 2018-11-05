<?php
	if( !isset($info) ){
		echo '<input type="hidden" id="accion" value="Robots/save/'.$info->id_user.'" />';
	}else{
		echo '<input type="hidden" id="accion" value="Robots/update/'.$info->id_user.'" />';
	}
?>

<div class="row">
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="name">Nombre:</label>
			<input value="<?= $info->name ?>" class="form-control" type="text" id="name" name="name" placeholder="Nombre del robot" required />
		</div>
	</div>
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="email">Email:</label>
			<input value="<?= $info->email ?>" class="form-control" type="email" id="email" name="email" placeholder="Email" required />
		</div>
	</div>
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="nickname">Nickname:</label>
			<input value="<?= $info->nickname ?>" class="form-control" type="text" id="nickname" name="nickname" placeholder="Nickname del robot" required />
		</div>
	</div>
</div>