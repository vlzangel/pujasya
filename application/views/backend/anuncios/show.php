<?php
	if( !isset($info) ){
		echo '<input type="hidden" id="accion" value="Anuncios/save/" />';
	}else{
		echo '<input type="hidden" id="accion" value="Anuncios/update/'.$info->id_anuncio.'" />';
	}
?>

<ul class="nav customtab nav-tabs" role="tablist">
    <li role="presentation" class="nav-item">
    	<a href="#tab_1" class="nav-link active" aria-controls="tab_1" role="tab" data-toggle="tab" aria-expanded="true">
    		<span class="visible-xs"><i class="fa fa-home"></i></span>
    		<span class="hidden-xs"> Datos info </span>
    	</a>
    </li>

    <li role="presentation" class="nav-item">
    	<a href="#tab_2" class="nav-link" aria-controls="tab_2" role="tab" data-toggle="tab" aria-expanded="true">
    		<span class="visible-xs"><i class="fa fa-home"></i></span>
    		<span class="hidden-xs"> Imágenes </span>
    	</a>
    </li>

    <li role="presentation" class="nav-item">
    	<a href="#tab_3" class="nav-link" aria-controls="tab_3" role="tab" data-toggle="tab" aria-expanded="true">
    		<span class="visible-xs"><i class="fa fa-home"></i></span>
    		<span class="hidden-xs"> Historial </span>
    	</a>
    </li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="tab_1">

		<div class="row">
		  <div class="col-sm-12">
				<div class="form-group">
					<label for="titulo">Nombre del producto:</label>
					<input value="<?= $info->titulo ?>" class="form-control" type="text" id="titulo" name="titulo" placeholder="Nombre del producto" required />
				</div>
			</div>
		</div>

		<div class="row">
		  <div class="col-sm-12">
				<div class="form-group">
					<label for="descripcion">Descripción del producto:</label>
					<textarea name="descripcion" rows="8" placeholder="Descripción" class="form-control textarea_editor" id="descripcion" required><?= $info->descripcion ?></textarea>
				</div>
			</div>
		</div>

		<div class="row">
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="precio_reventa">Precio de reventa:</label>
					<input value="<?= $info->precio_reventa ?>" class="form-control" type="number" step="0.01" id="precio_reventa" name="precio_reventa" placeholder="Precio de reventa" required />
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="precio_maximo">Precio máximo:</label>
					<input value="<?= $info->precio_maximo ?>" class="form-control" type="number" step="0.01" id="precio_maximo" name="precio_maximo" placeholder="Precio máximo" required />
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="precio_puja">Precio de puja:</label>
					<input value="<?= $info->precio_puja ?>" class="form-control" type="text" id="precio_puja" name="precio_puja" placeholder="Precio de puja" disabled />
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="cantidad_fichas">Cantidad de fichas:</label>
					<input value="<?= $info->cantidad_fichas ?>" class="form-control" type="number" step="0.01" id="cantidad_fichas" name="cantidad_fichas" placeholder="Precio de compra" required />
				</div>
		  	</div>
		</div>

		<div class="row">
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="tiempo_puja">Tiempo de puja:</label>
					<select id="tiempo_puja" name="tiempo_puja" class="form-control" >
						<?php
							for ($i=10; $i <= 45; $i++) { 
								$selected = ( $i == $info->tiempo_puja ) ? "selected": "";
								echo "<option value='{$i}' {$selected}>{$i} Seg</option>";
							}
						?>
					</select>
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="finalizacion">Fecha de finalización:</label>
					<input value="<?= $info->finalizacion ?>" class="form-control" type="date" id="finalizacion" name="finalizacion" required />
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="inicio">Hora inicio:</label>
					<input value="<?= $info->inicio ?>" class="form-control" type="time" id="inicio" name="inicio" required  />
				</div>
		  	</div>
		</div>

		<div class="row">
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="precio_puja">Estatus Actual:</label>
					<?php
						$status = [
							"activa" => "Activa",
							"ganada" => "Inactiva/Ganada",
							"comprada" => "Inactiva/Comprada",
							"cerrada" => "Inactiva/Cerrada"
						];
					?>
					<input value="<?= $status[ $info->status ]; ?>" class="form-control" disabled />
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="precio_reventa">Activar/Desactivar:</label>
					<div id="activa_desactiva">
						<?php
							if( $info->status == "" || $info->status == "activa" ){
								echo '<button id="btn_activar" type="button" class="btn btn-secondary" data-status="cerrada" >Desactivar</button>';
							}else{
								echo '<button id="btn_activar" type="button" class="btn btn-primary" data-status="activa" >Activar</button>';
							}
						?>
					</div>
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="existencia">Existencia:</label>
					<input value="<?= $info->existencia ?>" class="form-control" type="number" id="existencia" name="existencia" required />
				</div>
		  	</div>
		</div>

		<div class="row">
		  	<div class="col-sm-3">
				<div class="form-group">
					<label for="se_compra">Se puede compra:</label>
					<select id="se_compra" name="se_compra" class="form-control" >
						<?php
							$mostrar_comprar = ( $info->se_compra == 1 ) ? "mostrar_comprar": "no_mostrar_comprar";

							$opciones = [
								"No",
								"Si"
							];
							foreach ($opciones as $key => $value) {
								$selected = ( $key == $info->se_compra ) ? "selected": "";
								echo "<option value='{$key}' {$selected}>{$value}</option>";
							}
						?>
					</select>
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group campos_comprar <?= $mostrar_comprar ?>">
					<label for="precio_compra">Precio de compra:</label>
					<input value="<?= $info->precio_compra ?>" class="form-control" type="number" step="0.01" id="precio_compra" name="precio_compra" placeholder="Precio de compra" />
				</div>
		  	</div>
		  	<div class="col-sm-3">
				<div class="form-group campos_comprar <?= $mostrar_comprar ?>">
					<label for="precio_envio">Costo de envío y manejo:</label>
					<input value="<?= $info->precio_envio ?>" class="form-control" type="number" step="0.01" id="precio_envio" name="precio_envio" placeholder="Precio de envío" />
				</div>
		  	</div>
		</div>

	</div>

    <div class="tab-pane" id="tab_2">
        <label>Imágenes del info</label>
        <div id="input_imgs" data-multiple="true" data-accept=".png, .jpg, .jpeg, .gif"></div>

        <div class="img_container">
        	<div class="img_box">
        		<?php
        			if( $info->imgs != "" ){
        				$index_actual = 0;
	        			$imgs = json_decode($info->imgs);
	        			foreach ($imgs as $key => $value) {
	        				$index_actual = ( $key > $index_actual) ? $key: $index_actual;
	        				$checked = ( $value == $info->img_principal ) ? 'checked': '';
	        				echo '
	        					<label id="img_item_'.$key.'" for="img_principal_'.$key.'" class="img_item">
	        						<input name="imgs['.$key.']" value="'.$value.'" type="hidden">
	        						<input id="img_principal_'.$key.'" name="img_principal" value="'.$key.'" type="radio" '.$checked.' />
	        						<div style="background-image: url('.base_url().'files/productos/'.$info->id_anuncio.'/'.$value.')"></div>
	        						<i class="fa fa-times" onclick="removeImg( jQuery(this) )" data-index="'.$key.'"></i>
	        					</label>
	        				';
	        			}
        			}
        		?>
        	</div>
        </div>
    </div>

    <div class="tab-pane" id="tab_3">
        Tab II
    </div>
</div>

<style type="text/css">
	#activa_desactiva button { width: 100%; padding: 10px; }
	.mostrar_comprar{ display: block; }
	.no_mostrar_comprar{ display: none; }
	.img_container{ height: auto; padding: 20px; margin-top: 10px; border: solid 1px #CCC; border-radius: 4px; }
	.img_container .img_box{ overflow: hidden; height: 100%; background-repeat: no-repeat; background-size: contain; background-position: center; }
	.img_box > label { position: relative; display: inline-block; width: calc( 20% - 4px ); height: 150px; margin: 2px; cursor: pointer; float: left; }
	.img_box > label > div { position: absolute; display: block; width: calc( 100% - 0px ); height: 100%; background-size: cover; background-repeat: no-repeat; background-position: center; border: solid 4px #FFF; }
	.img_box > label i { position: absolute; top: 10px; right: 10px; font-size: 15px; color: #000; border: solid 1px #6c6c6c; padding: 5px 7px; background: #FFF; border-radius: 3px; cursor: pointer; }
	.img_box > label input[type="radio"] { display: none; }
	.img_box > label input:checked ~ div { border: solid 4px #01c0c8; }
</style>

<script>
	var imgs_index = <?= ($index_actual+1) ?>;
    jQuery(document).ready(function() {
        jQuery('.textarea_editor').wysihtml5({
            "html": true
        });

        jQuery("#btn_activar").on("click", function(e){
        	var status = jQuery(this).attr("data-status");
        	jQuery.post(
        		"<?= base_url( 'Anuncios/activo_inactivo/'.$info->id_anuncio."/" ) ?>"+status, 
        		{},
        		function(data){
        			var TITULO = ( status == "activa" ) ? "Desactivar" : "Activar";
        			jQuery("#btn_activar").html( TITULO );
        			if( status == "activa" ){
	        			jQuery("#btn_activar").removeClass("btn-primary");
	        			jQuery("#btn_activar").addClass("btn-secondary");
	        			jQuery("#btn_activar").attr("data-status", "cerrada");
        			}else{
	        			jQuery("#btn_activar").removeClass("btn-secondary");
	        			jQuery("#btn_activar").addClass("btn-primary");
	        			jQuery("#btn_activar").attr("data-status", "activa");
        			}
        		}
        	);
        });

        jQuery("#se_compra").on("change", function(e){
        	switch( parseInt( jQuery(this).val() ) ){
        		case 0:
        			jQuery(".campos_comprar").removeClass("mostrar_comprar");
        			jQuery(".campos_comprar").addClass("no_mostrar_comprar");
        		break;
        		case 1:
        			jQuery(".campos_comprar").removeClass("no_mostrar_comprar");
        			jQuery(".campos_comprar").addClass("mostrar_comprar");
        		break;
        	}
        });

        vlzImgs.load("input_imgs", [500, 300], function(img){
        	var HTML = "<label id='img_item_"+imgs_index+"' for='img_principal_"+imgs_index+"' class='img_item'>";

        		HTML += jQuery("<input>", { 
                    name: "imgs["+imgs_index+"]", 
                    value: img,
                    type: "hidden"
                })[0].outerHTML;

        		HTML += jQuery("<input>", { 
                    id: "img_principal_"+imgs_index, 
                    name: "img_principal", 
                    value: imgs_index,
                    type: "radio"
                })[0].outerHTML;

            	HTML += "<div style='background-image: url("+img+")'></div>";
        		
        		HTML += jQuery("<i>", { 
                    "class": "fa fa-times",
                    onclick: "removeImg( jQuery(this) )",
                    "data-index": imgs_index
                })[0].outerHTML;

            HTML += "</label>";

           	jQuery(".img_box").append( HTML );
        	imgs_index++;

        	var hay_check = false;
        	var primer_check = "";
        	jQuery('.img_box > label input[type="radio"]').each(function(i, v){
        		if( primer_check == "" ){
        			primer_check = jQuery(this).attr("id");
        		}
        		if( jQuery(this).prop("checked") ){
        			hay_check = true;
        		}
        	});

        	if( !hay_check ){
        		jQuery("#"+primer_check).prop("checked", true);
        	}
        });
    });

    function removeImg(_this){
    	var index = _this.attr("data-index");
    	jQuery("#img_item_"+index).remove();
    }
</script>