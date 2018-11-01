<?php
	if( !isset($anuncio) ){
		$anuncio = (object) [
			"id" => "",
			"nombre" => "",
			"fichas" => "",
			"precio" => "",
			"status" => "Activo"
		];
		echo '<input type="hidden" id="accion" value="Fichas/save/'.$anuncio->id.'" />';
	}else{
		echo '<input type="hidden" id="accion" value="Fichas/update/'.$anuncio->id.'" />';
	}
?>

<div class="row">
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="nombre">Nombre del paquete:</label>
			<input value="<?= $anuncio->nombre ?>" class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del paquete" required />
		</div>
	</div>
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="fichas">Num. de fichas:</label>
			<input value="<?= $anuncio->cantidad ?>" class="form-control" type="text" id="fichas" name="fichas" placeholder="Num. de fichas" required />
		</div>
	</div>
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="precio">Precio del paquete:</label>
			<input value="<?= $anuncio->precio ?>" class="form-control" type="number" step="0.01" id="precio" name="precio" placeholder="Precio del paquete" required />
		</div>
	</div>
  	<div class="col-sm-3">
		<div class="form-group">
			<label for="status">Status del paquete:</label>
			<select class="form-control" id="status" name="status" >
				<?php
					$status = [
						"Activo",
						"Inactivo",
					];
					foreach ($status as $key => $value) {
						$selected = ( $value == $anuncio->status ) ? "selected": "";
						echo '<option '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
		</div>
	</div>
</div>

<div class="row">
  	<div class="col-sm-12">
		<div class="form-group">
			<label>Imágenes del anuncio</label>
        	<div id="imagen" data-accept=".png, .jpg, .jpeg, .gif"></div>
        	<div class="imagen_container">
        		<input type="hidden" id="img" name="img" value="<?= $anuncio->img ?>" />
        		<div style="background-image: url(<?= base_url().'files/fichas/'.$anuncio->img ?>)"></div>
        	</div>
		</div>
	</div>
</div>

<style type="text/css">
	.imagen_container{
		margin: 10px 0px;
		border: solid 1px #CCC;
		border-radius: 3px;
		padding: 15px;
	}
	.imagen_container > div {
		background-repeat: no-repeat;
		background-size: contain;
		background-position: center;
	    height: 250px;
	}
</style>

<script>
	var imgs_index = <?= ($index_actual+1) ?>;
    jQuery(document).ready(function() {

        vlzImgs.load("imagen", [500, 300], function(img){
            jQuery(".imagen_container > input").val(img);
            jQuery(".imagen_container > div").css("background-image", "url("+img+")");
        });
    });

    function removeImg(_this){
    	var index = _this.attr("data-index");
    	jQuery("#img_item_"+index).remove();
    }
</script>