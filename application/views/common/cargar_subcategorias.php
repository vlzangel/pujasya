<option value="">--SELECCIONÁ UNA SUBCATEGORÍA--</option>
<?php foreach ($subcategorias as $l):?>
	<option value="<?= $l['id_subcategoria']?>"><?= $l['name']?></option>
<?php endforeach ?>