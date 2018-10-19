  <style>
  .navegar_filtro
  {
    color: grey;
    text-align: center;
    margin-top: 14px;
    margin-bottom: -14px;
  }
  </style>
  <?php 

    $tercera = $this->uri->segment(3);

    //OBtene nombre de categoria

    $categoria = applib::get_field(applib::$cat_table,array('seo' => $this->uri->segment(2)),'name');

    $link_categoria = base_url('anuncios/'.$this->uri->segment(2));

    //OBtener nombre de subcategoria

    $subcategoria = "";

    $link_subcategoria = "#";

    if($tercera !=  "" AND !is_numeric($tercera))
    {
      $subcategoria = applib::get_field(applib::$subcat_table,array('seo' => $tercera),'name');

      if($subcategoria == "")
      {
        $subcategoria = $tercera;
      }
    }
  ?>
   <?php if(isset($filtro) AND $filtro == 'comun_filtro'):?>

   <aside class="sidebar blog-sidebar">
        <div class="row row-tb-10">
          <div class="col-xs-12">
            <div class="widget latest-deals-widget panel prl-20">
                <div class="widget-body ptb-20" style="padding-bottom: 123px;">
                  <form action="<?= $url?>" method="POST">
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Precio desde" style="font-size:11px" name="costo_desde_filtro" onkeypress="return valida(event)" value="<?= $this->session->userdata('costo_desde_filtro')?>">
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Precio hasta" style="font-size:11px" name="costo_hasta_filtro" onkeypress="return valida(event)" value="<?= $this->session->userdata('costo_hasta_filtro')?>">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <select class="form-control unicase-form-control text-input" name="moneda_filtro">
                         <option value="">Pesos y U$S</option>
                        <option value="1" <?= $this->session->userdata('moneda_filtro') == "1"?'selected':''?>>PESOS (ARS)</option>
                        <option value="2" <?= $this->session->userdata('moneda_filtro') == "2"?'selected':''?>>DÓLARES (U$S)</option>
                       
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" name="text_filtro" placeholder="Ingresar texto" onkeypress="return normal_field(event)" value="<?= $this->session->userdata('text_filtro')?>">
                    </div>
                    
                    <button type="submit" name="filtrar" value="1" class="btn btn-sm btn-block">FILTRAR</button>

                    <button type="submit" name="reset" class="btn btn-sm btn-block" value="1" style="background:#03A9F4;">LIMPIAR FILTRO</button>

                  </form>

                  <p class="navegar_filtro">Estás en: <a href="<?= $link_categoria?>" title="<?= $categoria ?>"><?= $categoria ?></a> <?= $subcategoria != ""?'| <a href="'.$link_subcategoria.'" title="'.$subcategoria.'">'.$subcategoria.'</a>':''?></p>

                </div>
              </div>
            </div>
          </div>
        </aside>

    <?php endif ?>

    <?php if(isset($filtro) AND $filtro == 'vehiculos_filtro'):?>

    <?php 
        $provincias = applib::get_all('*',applib::$provincias_table,array());

        if($this->session->userdata('provincia_id_filtro') != "")
        {
          $localidades = applib::get_all('*',applib::$localidades_table,array('provincia_id' => $this->session->userdata('provincia_id_filtro')));
        }
    ?>

    <aside class="sidebar blog-sidebar">
        <div class="row row-tb-10">
          <div class="col-xs-12">
            <div class="widget latest-deals-widget panel prl-20">
                <div class="widget-body ptb-20" style="padding-bottom: 123px;">
                  <form action="<?= $url?>" method="POST">
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Precio desde" style="font-size:11px" name="costo_desde_filtro" onkeypress="return valida(event)" value="<?= $this->session->userdata('costo_desde_filtro')?>">
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Precio hasta" style="font-size:11px" name="costo_hasta_filtro" onkeypress="return valida(event)" value="<?= $this->session->userdata('costo_hasta_filtro')?>">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <select class="form-control unicase-form-control text-input" name="moneda_filtro">
                         <option value="">Pesos y U$S</option>
                        <option value="1" <?= $this->session->userdata('moneda_filtro') == "1"?'selected':''?>>PESOS (ARS)</option>
                        <option value="2" <?= $this->session->userdata('moneda_filtro') == "2"?'selected':''?>>DÓLARES (U$S)</option>
                       
                      </select>
                    </div>

                    <?php

                      //Obtener provincias con anuncios publicados

                        $provincias_anuncios = array();

                        foreach ($todos_filtro as $t) {
                          
                          if($t['provincia_user'] != "")
                          {
                            if(isset($provincias_anuncios[$t['provincia_user']]))
                            {
                              $provincias_anuncios[$t['provincia_user']] += 1;
                            }
                            else
                            {
                              $provincias_anuncios[$t['provincia_user']] = 1;
                            }
                            
                          }

                        }

                     ?>

                    <div class="form-group">
                        <select name="provincia_id_filtro" id="provincia_id_filtro" class="form-control unicase-form-control text-input">
                            <option value="">Todas las Provincias</option>
                            <?php foreach ($provincias as $l): if(isset($provincias_anuncios[$l['id']])): ?>
                                <option value="<?= $l['id']?>" <?= ($this->session->userdata('provincia_id_filtro') == $l['id'])?'selected':''?>><?= $l['provincia']?> ( <?= $provincias_anuncios[$l['id']]?> )</option>
                            <?php endif; endforeach?>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="poblacion_id_filtro" id="poblacion_id" class="form-control unicase-form-control text-input">
                            <option value="">Todas las Ciudades</option>
                            <?php if(isset($localidades)): 

                             $ciudad_anuncios = array();

                            foreach ($todos_filtro as $t) {
                              
                              if($t['ciudad_user'] != "")
                              {
                                if(isset($ciudad_anuncios[$t['ciudad_user']]))
                                {
                                  $ciudad_anuncios[$t['ciudad_user']] += 1;
                                }
                                else
                                {
                                  $ciudad_anuncios[$t['ciudad_user']] = 1;
                                }
                                
                              }

                            }

                            foreach ($localidades as $c): if(isset($ciudad_anuncios[$c['id']])):?>
                                <option value="<?= $c['id']?>" <?=  $this->session->userdata('poblacion_id_filtro') == $c['id']?'selected':''?>><?= $c['localidad']?> ( <?= $ciudad_anuncios[$c['id']]?> )</option>
                            <?php endif; endforeach; endif ?>
                        </select>
                    </div>

                    <?php 
                        if(isset($marca_filtro) AND $marca_filtro):

                        //Obtener marcas

                        $marcas = applib::get_marcas($this->uri->segment(3));

                        //Obtener marcas con anuncios publicados

                        $marcas_anuncios = array();

                        foreach ($todos_filtro as $t) {
                          
                          if($t['marca_id'] != "")
                          {
                            if(isset($marcas_anuncios[$t['marca_id']]))
                            {
                              $marcas_anuncios[$t['marca_id']] += 1;
                            }
                            else
                            {
                              $marcas_anuncios[$t['marca_id']] = 1;
                            }
                            
                          }

                        }
                    ?>
                    <div class="form-group">
                    <select name="marca_filtro" class="form-control" alt="Seleccione una marca de la lista" title="Seleccione una marca de la lista">
                        <option value="">Todas las Marcas</option>
                            <?php foreach ($marcas as $l): if(isset($marcas_anuncios[$l['id_marca']])): ?>
                                <option value="<?= $l['id_marca']?>" <?= ($this->session->userdata('marca_filtro') == $l['id_marca'])?'selected':''?>><?= $l['name']?>  ( <?= $marcas_anuncios[$l['id_marca']]?> )</option>
                            <?php endif; endforeach?>
                    </select>
                    </div>

                  <?php endif ?>

                    <div class="form-group">
                      <input type="text" class="form-control" name="version_filtro" placeholder="Version o Palabra" onkeypress="return normal_field(event)" value="<?= $this->session->userdata('version_filtro')?>">
                    </div>

                    <?php  if(isset($combustible_filtro) AND $combustible_filtro):?>

                    <div class="form-group">
                      <select class="form-control" name="combustible_filtro">
                        <option value="">Todos los Combustibles</option>
                        <option value="nafta" <?= $this->session->userdata('combustible_filtro') == "nafta"?'selected':''?>>Nafta</option>
                        <option value="GNC" <?= $this->session->userdata('combustible_filtro') == "GNC"?'selected':''?>>GNC</option>
                        <option value="diesel" <?= $this->session->userdata('combustible_filtro') == ""?'diesel':''?>>Diesel</option>
                      </select>                     
                    </div>
                    
                    <?php endif ?>

                    <div class="row">

                      <div class="col-xs-6">
                        <div class="form-group">
                          <select class="form-control" name="year_desde_filtro">
                            <option value="">Año desde</option>
                            <?php for ($i=1970; $i < 2018; $i++):?>
                            <option value="<?= $i?>" <?= $this->session->userdata('year_desde_filtro') == $i?'selected':''?>><?= $i?></option>
                            <?php endfor ?>
                          </select>  
                        </div>
                      </div>

                      <div class="col-xs-6">
                        <div class="form-group">
                          <select class="form-control" name="year_hasta_filtro">
                            <option value="">Año hasta</option>
                            <?php for ($i=2017; $i > 1970; $i--):?>
                            <option value="<?= $i?>" <?= $this->session->userdata('year_hasta_filtro') == $i?'selected':''?>><?= $i?></option>
                            <?php endfor ?>
                          </select>  
                        </div>
                      </div>

                    </div>

                    <button type="submit" name="filtrar" value="1" class="btn btn-sm btn-block">FILTRAR</button>

                    <button type="submit" name="reset" class="btn btn-sm btn-block" value="1" style="background:#03A9F4;">LIMPIAR FILTRO</button>

                  </form>


                  <p class="navegar_filtro">Estás en: <a href="<?= $link_categoria?>" title="<?= $categoria ?>"><?= $categoria ?></a> <?= $subcategoria != ""?'| <a href="'.$link_subcategoria.'" title="'.$subcategoria.'">'.$subcategoria.'</a>':''?></p>

                </div>
              </div>
            </div>
          </div>
        </aside>
    <?php endif ?>

    <?php if(isset($filtro) AND  $filtro == 'propiedades_filtro'):?>
    <?php 
        $provincias = applib::get_all('*',applib::$provincias_table,array());

        if($this->session->userdata('provincia_id_filtro') != "")
        {
          $localidades = applib::get_all('*',applib::$localidades_table,array('provincia_id' => $this->session->userdata('provincia_id_filtro')));
        }
    ?>
    <aside class="sidebar blog-sidebar">
        <div class="row row-tb-10">
          <div class="col-xs-12">
            <div class="widget latest-deals-widget panel prl-20">
                <div class="widget-body ptb-20" style="padding-bottom: 123px;">
                  <form action="<?= $url?>" method="POST">
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Precio desde" style="font-size:11px" name="costo_desde_filtro" onkeypress="return valida(event)" value="<?= $this->session->userdata('costo_desde_filtro')?>">
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Precio hasta" style="font-size:11px" name="costo_hasta_filtro" onkeypress="return valida(event)" value="<?= $this->session->userdata('costo_hasta_filtro')?>">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <select class="form-control unicase-form-control text-input" name="moneda_filtro">
                        <option value="">Pesos y U$S</option>
                        <option value="1" <?= $this->session->userdata('moneda_filtro') == "1"?'selected':''?>>PESOS (ARS)</option>
                        <option value="2" <?= $this->session->userdata('moneda_filtro') == "2"?'selected':''?>>DÓLARES (U$S)</option>
                        
                      </select>
                    </div>

                    <!-- <div class="form-group">
                         <select name="tipo_operacion_filtro" class="form-control">
                            <option value="">Todas las Operaciones</option>
                            <option value="1" <?php // $this->session->userdata('tipo_operacion_filtro') == "1"?'selected':''?>>Venta</option>
                            <option value="2" <?php // $this->session->userdata('tipo_operacion_filtro') == "2"?'selected':''?>>Alquiler Permanente</option>
                            <option value="3" <?php // $this->session->userdata('tipo_operacion_filtro') == "3"?'selected':''?>>Alquiler Temporal</option>
                        </select>
                    </div> -->

                    <?php

                      //Obtener provincias con anuncios publicados

                        $provincias_anuncios = array();

                        foreach ($todos_filtro as $t) {
                          
                          if($t['provincia_id'] != "")
                          {
                            if(isset($provincias_anuncios[$t['provincia_id']]))
                            {
                              $provincias_anuncios[$t['provincia_id']] += 1;
                            }
                            else
                            {
                              $provincias_anuncios[$t['provincia_id']] = 1;
                            }
                            
                          }

                        }

                     ?>

                    <div class="form-group">
                        <select name="provincia_id_filtro" id="provincia_id_filtro" class="form-control unicase-form-control text-input">
                            <option value="">Todas las Provincias</option>
                            <?php foreach ($provincias as $l): if(isset($provincias_anuncios[$l['id']])): ?>
                                <option value="<?= $l['id']?>" <?= ($this->session->userdata('provincia_id_filtro') == $l['id'])?'selected':''?>><?= $l['provincia']?> ( <?= $provincias_anuncios[$l['id']]?> )</option>
                            <?php endif; endforeach?>
                        </select>
                    </div>

                    <div class="form-group">
                       <select name="poblacion_id_filtro" id="poblacion_id" class="form-control unicase-form-control text-input">
                            <option value="">Todas las Ciudades</option>
                            <?php if(isset($localidades)): 

                             $ciudad_anuncios = array();

                            foreach ($todos_filtro as $t) {
                              
                              if($t['poblacion_id'] != "")
                              {
                                if(isset($ciudad_anuncios[$t['poblacion_id']]))
                                {
                                  $ciudad_anuncios[$t['poblacion_id']] += 1;
                                }
                                else
                                {
                                  $ciudad_anuncios[$t['poblacion_id']] = 1;
                                }
                                
                              }

                            }

                            foreach ($localidades as $c): if(isset($ciudad_anuncios[$c['id']])):?>
                                <option value="<?= $c['id']?>" <?=  $this->session->userdata('poblacion_id_filtro') == $c['id']?'selected':''?>><?= $c['localidad']?> ( <?= $ciudad_anuncios[$c['id']]?> )</option>
                            <?php endif; endforeach; endif ?>
                        </select>
                       
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" name="text_filtro" placeholder="Ingresar texto" onkeypress="return normal_field(event)" value="<?= $this->session->userdata('text_filtro')?>">
                    </div>

                    <button type="submit" name="filtrar" value="1" class="btn btn-sm btn-block">FILTRAR</button>

                    <button type="submit" name="reset" class="btn btn-sm btn-block" value="1" style="background:#03A9F4;">LIMPIAR FILTRO</button>

                  </form>

                  <p class="navegar_filtro">Estás en: <a href="<?= $link_categoria?>" title="<?= $categoria ?>"><?= $categoria ?></a> <?= $subcategoria != ""?'| <a href="'.$link_subcategoria.'" title="'.$subcategoria.'">'.$subcategoria.'</a>':''?></p>

                </div>
              </div>
            </div>
          </div>
        </aside>
    <?php endif ?>

    <input type="hidden" id="primer_uri" value="<?= $this->uri->segment(1)?>">
    <input type="hidden" id="segundo_uri" value="<?= $this->uri->segment(2)?>">
    <input type="hidden" id="tercer_uri" value="<?= $tercera?>">
