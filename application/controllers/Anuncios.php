<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anuncios extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }

    public function index($cate,$sub = NULL,$pag = NULL)
    {
    	if($cate == "")
    	{
    		redirect(base_url());
    		exit;
    	}

        //Decidir si mostrar filtro

        $filtro = "comun_filtro";

        $data['marca_filtro'] = false;

        $data['combustible_filtro'] = false;

        if($cate == 'vehiculos')
        {
            $filtro = 'vehiculos_filtro';

            if($sub != NULL AND !is_numeric($sub))
            {
                $data['marca_filtro'] = true;

                $data['combustible_filtro'] = true;
            }
        }

        if($cate == 'propiedades')
        {
            $filtro = 'propiedades_filtro';
        }

        //Guardar categoria en session

        if($this->session->userdata('categoria_filter') != $cate)
        {
            applib::destroy_filters();
        }

        $this->session->set_userdata('categoria_filter',$cate);

        //Ordenar por

        $ordenar_por = 'id_anuncio DESC';

        $ordenar_por = $this->session->userdata('costo_menor_filter')?'a.costo ASC':$ordenar_por;

        $ordenar_por = $this->session->userdata('costo_mayor_filter')?'a.costo DESC':$ordenar_por;

        //Paginacion y paginas por vista

        $porpagina = 16;

        $segment = 4;

        $url = base_url().'anuncios/'.$cate.'/';

        $condition_no_filter = 'c.seo = "'.$cate.'" AND a.status = 1 AND u.status = 1';

        //Si hay subcategoria

        $get_premium = false;


        if($sub != NULL)
        {
            if(is_numeric($sub))
            {
                $segment = 3;
            }
            else
            {
                //Guardar subcategoria en session

                if($this->session->userdata('subcategoria_filter') != $sub)
                {
                    applib::destroy_filters();
                }

                $this->session->set_userdata('subcategoria_filter',$sub);

                //Configurar url
                
                $url = base_url().'anuncios/'.$cate.'/'.$sub.'/';

                $condition_no_filter .= ' AND s.seo = "'.$sub.'"';

                $segment = 5;

                if($pag != NULL)
                {
                    $segment = 4;
                }
                else
                {
                    //Obtener premium

                    $get_premium = true;
                }
            }
        }
        else
        {
            //Obtener premium

            $get_premium = true;
        }

        if($this->uri->segment($segment))
        {
            $pagina = ($this->uri->segment($segment) - 1) * $porpagina;
        }
        else
        {
            $pagina = 0;
        }

        //Si se envian filtros

        $post = array();

        if($this->input->post())
        {
            if(isset($_POST['filtrar']))
            {
                $post = $_POST;
            }
            if(isset($_POST['reset']))
            {
                applib::destroy_filters();
            }
        }

        $condition = $this->set_filters($condition_no_filter,$post);

        if($get_premium)
        {
            $condition .= ' AND u.premium = 1';

            $data['premium'] = applib::get_premium($condition,6,$ordenar_por);

            $condition = rtrim($condition,'ND u.premium = 1');

            $condition = rtrim($condition,'A');
        }

        //Extraccion de datos

        $paginas = array('porpagina' => $porpagina, 'pagina' => $pagina);

    	$data['anuncios'] = $this->anuncios_model->get_all_listado($condition,$paginas,$ordenar_por);

        if(count($data['anuncios']) == 0 AND $sub != NULL AND !is_numeric($sub))
        {
            $this->session->set_userdata('marca_filtro','');

            $this->session->set_userdata('combustible_filtro','');

            applib::flash_no_products($message = null,'anuncios/'.$cate);
            exit;
        }

        //Paginacion

        $cuantos = $this->anuncios_model->get_count_listado($condition);

        $data_paginacion = array('url' => $url,'cuantos' => $cuantos,'porpagina' => $porpagina,'segment' => $segment);



        $this->load->library('pagination');

        $config = applib::config_pagination($data_paginacion);

        $this->pagination->initialize($config);

        //Extraer todos los datos para conteo en filtros

        $data['todos_filtro'] = $this->anuncios_model->get_all_cuantos($condition_no_filter);

        $data['url'] = $url;
        $data['filtro'] = $filtro;
        $data['get_premium'] = $get_premium;
        $data['cuantos'] = $cuantos;

        $data['meta'] = array(
            array(
                'name'      => 'description',
                'content'   => ''.$cate.', '.$sub.' | Pujas'
            )
        );

    	$data['title'] = ''.$cate.'';
    	$data['contenido'] = 'anuncios/listado';
    	$this->load->view('frontend/templates/plantilla',$data);
    }

    //Vista del perfil de empresa

    public function empresa($seo = null,$sub = null)
    {
        if($seo == "")
        {
            redirect(base_url());
            exit;
        }

        //Paginacion y paginas por vista

        $porpagina = 18;

        $segment = 5;

        $url = base_url().'anuncios/empresa/'.$seo.'/';

        $condition = array('u.seo' => $seo,'a.status' => 1,'u.status' => 1,'u.mostrar_perfil' => 1);

        if($sub != NULL AND is_numeric($sub))
        {
            $segment = 4;
        }

        if($this->uri->segment($segment))
        {
            $pagina = ($this->uri->segment($segment) - 1) * $porpagina;
        }
        else
        {
            $pagina = 0;
        }

        //Extraccion de datos

        $paginas = array('porpagina' => $porpagina, 'pagina' => $pagina);

        $data['premium'] = $this->anuncios_model->get_all_listado($condition,$paginas,'id_anuncio DESC');

        if(count($data['premium']) == 0)
        {
            if(applib::get_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'seo') == $seo)
            {
                applib::flash('danger','Tienes que <a href="'.base_url().'cuenta/publicar">PUBLICAR</a> al menos 1 anuncio para ver tu Perfil','perfil');
                exit;
            }

            redirect(base_url());
            exit;
        }

        $data['anuncios_usuario'] = true;

        //Paginacion

        $cuantos = $this->anuncios_model->get_count_listado($condition);

        $data_paginacion = array('url' => $url,'cuantos' => $cuantos,'porpagina' => $porpagina,'segment' => $segment);

        $this->load->library('pagination');

        $config = applib::config_pagination($data_paginacion);

        $this->pagination->initialize($config);

        //Suma todos los anuncios

        $data['suma_anuncios'] = $this->anuncios_model->get_suma_visitas(array('u.seo' => $seo));

        //Anuncios publicados

        $data['cantidad_anuncios'] = $cuantos;

        $data['cuantos'] = $cuantos;


        //Anuncios mas visitados

        $data['mas_visitados'] = $this->anuncios_model->get_mas_visitados($condition,array('porpagina' => 4,'pagina' => 0),'visitas DESC');

        $data['meta'] = array(
            array(
                'name'      => 'description',
                'content'   => 'Anuncios de '.$seo.' | Pujas'
            )
        );


        $data['title'] = 'Pujas de '.$seo;
        $data['contenido'] = 'anuncios/listado';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    //Vista de la busqueda del header

    public function busqueda($cat = null,$campo = null,$pag = NULL)
    {
        if($cat == "" OR $campo == "")
        {
            redirect(base_url());
            exit;
        }

        //Decidir si mostrar filtro

        $filtro = "comun_filtro";

        $data['marca_filtro'] = false;

        $data['combustible_filtro'] = false;

        if($cat == 'vehiculos')
        {
            $filtro = 'vehiculos_filtro';
        }

        if($cat == 'propiedades')
        {
            $filtro = 'propiedades_filtro';
        }

        if($this->session->userdata('categoria_filter') != $cat)
        {
            applib::destroy_filters();
        }

        $this->session->set_userdata('categoria_filter',$cat);

        //Paginacion y paginas por vista

        $porpagina = 16;

        $segment = 5;

        $url = base_url().'busqueda/'.$cat.'/'.$campo.'/';

        $cat_id = applib::get_field(applib::$cat_table,array('seo' => $cat),'id_categoria');

        if($cat_id == "")
        {
            redirect(base_url());
            exit;
        }

        $campo_limpio  = str_replace('-', ' ', $campo);
        

        $condition_no_filter = 'a.status = 1 AND u.status = 1 AND a.categoria_id = '.$cat_id.' AND a.titulo LIKE "%'.$campo_limpio.'%"';

        $get_premium = false;

        if($pag != NULL AND is_numeric($pag))
        {
            $segment = 4;
        }
        else
        {
            //Obtener premium

            $get_premium = true;
        }

        if($this->uri->segment($segment))
        {
            $pagina = ($this->uri->segment($segment) - 1) * $porpagina;
        }
        else
        {
            $pagina = 0;
        }

        //Si se envian filtros

        $post = array();

        if($this->input->post())
        {
            $post = $_POST;
        }

        $condition = $this->set_filters($condition_no_filter,$post);

        if($get_premium)
        {
            $condition .= ' AND u.premium = 1';

            $data['premium'] = applib::get_premium($condition,6);

            $condition = rtrim($condition,'ND u.premium = 1');

            $condition = rtrim($condition,'A');
        }
        
        //Extraccion de datos

        $paginas = array('porpagina' => $porpagina, 'pagina' => $pagina);

        $data['anuncios'] = $this->anuncios_model->get_all_listado($condition,$paginas,'id_anuncio DESC');

        if(count($data['anuncios']) == 0)
        {
            applib::flash_no_products($message = null,'anuncios/'.$cat);
            exit;
        }

        $this->session->set_userdata('categoria_busqueda',$cat);

        $this->session->set_userdata('campo_busqueda',$campo_limpio);

        //Paginacion

        $cuantos = $this->anuncios_model->get_count_listado($condition);

        $data_paginacion = array('url' => $url,'cuantos' => $cuantos,'porpagina' => $porpagina,'segment' => $segment);

        $this->load->library('pagination');

        $config = applib::config_pagination($data_paginacion);

        $this->pagination->initialize($config);

        //Extraer todos los datos para conteo en filtros

        $data['todos_filtro'] = $this->anuncios_model->get_all_cuantos($condition_no_filter);

        $data['url'] = $url;
        $data['filtro'] = $filtro;
        $data['cuantos'] = $cuantos;
         $data['get_premium'] = $get_premium;

        $data['meta'] = array(
            array(
                'name'      => 'description',
                'content'   => ''.$cat.', '.$campo.''
            )
        );
        $data['title'] = ''.$cat.' | '.$campo.' ';
        $data['contenido'] = 'anuncios/listado';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    //Vista de anuncio individual

    public function anuncio($seo = NULL)
    {
        $condition = array('u.status' => 1,'a.status' => 1,'a.seo' => $seo);

        $data['anuncio'] = $this->anuncios_model->get_by($condition);

        if($data['anuncio'] == "")
        {
            redirect(base_url());
            exit;
        }

        //Determinar si esta en favoritos

        $data['favorito'] = false;

        $id = $data['anuncio']['id_anuncio'];

        if($this->session->userdata('user_id') != "")
        {
            $data['favorito'] = applib::check_favorito($id);
        }

        //Obtener anuncios relacionados por la categoria

        $condition = array('a.categoria_id' => $data['anuncio']['categoria_id'],'a.status' => 1,'a.subcategoria_id' => $data['anuncio']['subcategoria_id'],'u.status' => 1);

        $relacionados = $this->anuncios_model->get_all_relacionados($condition);

        $data['relacionados'] = array();

        if(count($relacionados) > 0)
        {
            $cantidad = count($relacionados) > 6?6:count($relacionados);

            do {

                $valor = array_rand($relacionados);

                $arreglo = $relacionados[$valor];

                array_push($data['relacionados'], $arreglo);

                unset($relacionados[$valor]);
                        

            } while (count($data['relacionados']) < $cantidad);
        }

        

        //Obtener anuncios del usuario

        $data['otros_usuario'] = array();

        if($data['anuncio']['premium'] == 1)
        {
            $condition = array('a.status' => 1,'a.user_id' => $data['anuncio']['user_id'],'u.status' => 1);

            $data['otros_usuario'] = $this->anuncios_model->get_all_relacionados($condition);

        }

        //$data['cantidad_anuncio'] = applib::count_table_rows(applib::$anuncios_table,array('status' => 1,'user_id' => $data['anuncio']['user_id']));

        $data['imagenes'] = applib::get_all('*',applib::$img_table,array('anuncio_id' => $id));

        //Chequear visitas

        $ip_user = $this->input->ip_address();

        //$check_visita = applib::get_table_field(applib::$visitas_table,array('ip' => $ip_user,'anuncio_id' => $id), 'id_visita');

        //if($check_visita == false)
        //{
        applib::create(applib::$visitas_table,array('anuncio_id' => $id, 'ip' => $ip_user, 'date' => applib::fecha()));

        applib::update(array('id_anuncio' => $id),applib::$anuncios_table,array('visitas' => $data['anuncio']['visitas'] + 1));

      $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        //}

        $this->load->library('user_agent');


        //Verificar chat

        $chat = false;

        if($this->session->userdata('user_id') != "")
        {

        }

        $data['meta'] = array(
            array(
                'name'      => 'description',
                'content'   => ''.$data['anuncio']['titulo'].' | Pujas'
            )
        );

        $data['title'] = $data['anuncio']['titulo'];
        $data['contenido'] = 'anuncios/detalle';
        $this->load->view('frontend/templates/plantilla',$data);
    }


    ///Crear filtros

    function set_filters($condition,$post = array())
    {
        if($post != "")
        {
            foreach ($post as $key => $value) {

                $this->session->set_userdata($key,$value);

            }
        }
        
        //Filtro comunes
        
        if($this->session->userdata('costo_desde_filtro') != "" AND $this->session->userdata('costo_hasta_filtro') != "")
        {
            $condition .= ' AND costo >= '.$this->session->userdata('costo_desde_filtro').' AND costo <= '.$this->session->userdata('costo_hasta_filtro').'';
        }
        else
        {
            $condition .= ($this->session->userdata('costo_desde_filtro') != "")?' AND costo >= '.$this->session->userdata('costo_desde_filtro').'':'';

            $condition .= ($this->session->userdata('costo_hasta_filtro') != "")?' AND costo <= '.$this->session->userdata('costo_hasta_filtro').'':'';
        }

        $condition .= ($this->session->userdata('moneda_filtro') != "")?' AND moneda = "'.$this->session->userdata('moneda_filtro').'"':'';

        //Filtro vehiculos

        $condition .= ($this->session->userdata('marca_filtro') != "")?' AND marca_id = '.$this->session->userdata('marca_filtro').'':'';

        $condition .= ($this->session->userdata('version_filtro') != "")?' AND (version LIKE "%'.$this->session->userdata('version_filtro').'%" OR titulo LIKE "%'.$this->session->userdata('version_filtro').'%")':'';
            
        $condition .= ($this->session->userdata('combustible_filtro') != "")?' AND combustible = "'.$this->session->userdata('combustible_filtro').'"':'';

        if($this->session->userdata('year_desde_filtro') != "" AND $this->session->userdata('year_hasta_filtro') != "")
        {
            $condition .= ' AND year >= '.$this->session->userdata('year_desde_filtro').' AND year <= '.$this->session->userdata('year_hasta_filtro').'';
        }
        else
        {
            $condition .= ($this->session->userdata('year_desde_filtro') != "")?' AND year >= '.$this->session->userdata('year_desde_filtro').'':'';

            $condition .= ($this->session->userdata('year_hasta_filtro') != "")?' AND year <= '.$this->session->userdata('year_hasta_filtro').'':'';
        }

        //Filtro propiedades

        $condition .= ($this->session->userdata('tipo_operacion_filtro') != "")?' AND tipo_operacion = '.$this->session->userdata('tipo_operacion_filtro').'':'';

        if($this->uri->segment(2) == 'propiedades')
        {
            $condition .= ($this->session->userdata('provincia_id_filtro') != "")?' AND a.provincia_id = '.$this->session->userdata('provincia_id_filtro').'':'';

            $condition .= ($this->session->userdata('poblacion_id_filtro') != "")?' AND a.poblacion_id = '.$this->session->userdata('poblacion_id_filtro').'':'';
        }
        else
        {
            $condition .= ($this->session->userdata('provincia_id_filtro') != "")?' AND u.provincia_id = '.$this->session->userdata('provincia_id_filtro').'':'';

            $condition .= ($this->session->userdata('poblacion_id_filtro') != "")?' AND u.poblacion_id = '.$this->session->userdata('poblacion_id_filtro').'':'';
        } 
        
        $condition .= ($this->session->userdata('text_filtro') != "")?' AND (a.direccion LIKE "%'.$this->session->userdata('text_filtro').'%" OR titulo LIKE "%'.$this->session->userdata('text_filtro').'%" OR descripcion LIKE "%'.$this->session->userdata('text_filtro').'%")':'';
        
        return $condition;
    }

    
}