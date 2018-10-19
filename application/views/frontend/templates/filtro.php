<aside class="sidebar blog-sidebar">
    <div class="row row-tb-10">
    	<div class="col-xs-12">
            <div class="widget latest-deals-widget panel prl-20">
               	<div class="widget-body ptb-20" style="padding-bottom: 123px;">
               		<form action="">
               			<div class="row">
               				<div class="col-xs-6">
               					<div class="form-group">
               						<input type="text" class="form-control" placeholder="Precio desde" style="font-size:11px">
               					</div>
               				</div>
               				<div class="col-xs-6">
               					<div class="form-group">
               						<input type="text" class="form-control" placeholder="Precio hasta" style="font-size:11px">
               					</div>
               				</div>
               			</div>
			    		<div class="form-group">
				    		<select name="mrkId" id="mrkId" rel="" class="form-control" alt="Seleccione una marca de la lista" title="Seleccione una marca de la lista">
							<option value="" selected="selected">Marca</option>
							<optgroup label="Marcas más Buscadas">
							<option value="1020">Chevrolet</option>
							<option value="1023">Citroen</option>
							<option value="1036">Fiat</option>
							<option value="1037">Ford</option>
							<option value="1045">Honda</option>
							<option value="1086">Peugeot</option>
							<option value="1095">Renault</option>
							<option value="1111">Suzuki</option>
							<option value="1114">Toyota</option>
							<option value="1118">Volkswagen</option>
							</optgroup>
							<optgroup label="Todas las marcas">
							<option value="1001">Acura</option>
							<option value="1003">Alfa Romeo</option>
							<option value="1008">Audi</option>
							<option value="1013">Bentley</option>
							<option value="1015">Bmw</option>
							<option value="1019">Chery</option>
							<option value="1020">Chevrolet</option>
							<option value="1021">Chrysler</option>
							<option value="1023">Citroen</option>
							<option value="1024">Dacia</option>
							<option value="1025">Daewoo</option>
							<option value="1026">Daihatsu</option>
							<option value="1031">Dodge</option>
							<option value="1035">Ferrari</option>
							<option value="1036">Fiat</option>
							<option value="1037">Ford</option>
							<option value="2092">Geely</option>
							<option value="1040">GMC</option>
							<option value="1045">Honda</option>
							<option value="1048">Hyundai</option>
							<option value="1050">Infiniti</option>
							<option value="2073">Isard</option>
							<option value="1052">Isuzu</option>
							<option value="1056">Jaguar</option>
							<option value="1058">Kia</option>
							<option value="1063">Lexus</option>
							<option value="1068">Maserati</option>
							<option value="1070">Mazda</option>
							<option value="1071">Mercedes Benz</option>
							<option value="1075">Mini</option>
							<option value="1076">Mitsubishi</option>
							<option value="2070">Mustang</option>
							<option value="1080">Nissan</option>
							<option value="1083">Opel</option>
							<option value="2060">Otra marca</option>
							<option value="1086">Peugeot</option>
							<option value="1089">Pontiac</option>
							<option value="1090">Porsche</option>
							<option value="1095">Renault</option>
							<option value="1097">Rover</option>
							<option value="1099">Saab</option>
							<option value="1103">Seat</option>
							<option value="1107">Smart</option>
							<option value="1110">Subaru</option>
							<option value="1111">Suzuki</option>
							<option value="1114">Toyota</option>
							<option value="1118">Volkswagen</option>
							<option value="1119">Volvo</option>
							</optgroup>
							</select>
			    		</div>

			    		<div class="form-group">
               				<input type="text" class="form-control" name="version" placeholder="Version">
               			</div>
               			<div class="form-group">
                            <select class="form-control" name="combustible" id="combustible">
                                <option value="">--Combustible--</option>
                                <option value="nafta">Nafta</option>
                                <option value="GNC">GNC</option>
                                <option value="diesel">Diesel</option>
                            </select>                     
               			</div>

               			<div class="form-group">
                            <select class="form-control unicase-form-control text-input" name="moneda" id="moneda">
                                <option value="1">PESOS (ARS)</option>
                                <option value="2">DÓLARES (U$S)</option>
                            </select>
                        </div>

                        <div class="row">
               				<div class="col-xs-6">
               					<div class="form-group">
               						<select class="form-control" name="year_desde">
		                                <option value="">--Año desde--</option>
		                                <?php for ($i=1970; $i < 2018; $i++):?>
		                                <option value="<?= $i?>"><?= $i?></option>
		                            	<?php endfor ?>
		                            </select>  
               					</div>
               				</div>
               				<div class="col-xs-6">
               					<div class="form-group">
               						<select class="form-control" name="year_hasta">
		                                <option value="">--Año hasta--</option>
		                                <?php for ($i=2017; $i > 1970; $i--):?>
		                                <option value="<?= $i?>"><?= $i?></option>
		                            	<?php endfor ?>
		                            </select>  
               					</div>
               				</div>
               			</div>

               			<button type="submit" class="btn btn-sm btn-block">Buscar</button>

			    	</form>
               	</div>
            </div>
        </div>
    </div>
</aside>