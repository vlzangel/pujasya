<?php if(isset($todos_filtro)):

  //Obtener ciudades con anuncios publicados

    $ciudades_anuncios = array();

    $tipo = $segunda == 'propiedades'?'poblacion_id':'ciudad_user';

    foreach ($todos_filtro as $t) {
                          
	    if($t[$tipo] != "")
	    {
	        if(isset($ciudades_anuncios[$t[$tipo]]))
	        {
	            $ciudades_anuncios[$t[$tipo]] += 1;
	        }
	        else
	        {
	            $ciudades_anuncios[$t[$tipo]] = 1;
	        }
	    }
	}
?>



<option value="">Todas las Ciudades</option>
<?php foreach ($localidades as $l): if(isset($ciudades_anuncios[$l['id']])):?>
	<option value="<?= $l['id']?>"><?= $l['localidad']?> ( <?= $ciudades_anuncios[$l['id']]?> )</option>
<?php endif; endforeach ?>

<?php else: ?>

<option value="">Todas las Ciudades</option>
<?php foreach ($localidades as $l):?>
	<option value="<?= $l['id']?>"><?= $l['localidad']?></option>
<?php endforeach ?>

<?php endif ?>