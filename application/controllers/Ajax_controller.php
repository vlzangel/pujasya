<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_controller extends CI_Controller {
	
	public function __construct(){
        parent::__construct();

    }

    function index()
    {
    	redirect(base_url());
    }

    function get_poblaciones_filtro()
    {
        if($this->input->post('id',true))
        {
            $id = $this->input->post('id',true);

            $primer = $this->input->post('primer_uri',true);

            $segundo = $this->input->post('segundo_uri',true);

            $tercer = $this->input->post('tercer_uri',true);

            //Obtener localidades

            $data['localidades'] = applib::get_all('*',applib::$localidades_table,array('provincia_id' => $id));

            //Obtener cantidades para filtros

            $condition_no_filter = 'a.status = 1 AND u.status = 1 AND c.seo = "'.$segundo.'"';

            if($primer == 'busqueda' AND $tercer != "")
            {
                 $condition_no_filter .= ' AND a.titulo LIKE "%'.$tercer.'%"';
            }

            if($primer == 'anuncios' AND $tercer != "" AND !is_numeric($tercer))
            {
                $condition_no_filter .= ' AND s.seo =  "'.$tercer.'"';
            }

            $data['todos_filtro'] = $this->anuncios_model->get_all_cuantos($condition_no_filter);

            $data['segunda'] = $segundo;

            $cuerpo = $this->load->view('common/cargar_poblaciones',$data,true);

            if ($this->input->is_ajax_request())
            {
                echo $cuerpo;
                exit;
            }
        }

        redirect(base_url());
    }

    function get_poblaciones()
    {
    	if($this->input->post('id',true))
    	{
    		$id = $this->input->post('id',true);
		
			$data['localidades'] = applib::get_all('*',applib::$localidades_table,array('provincia_id' => $id));

			if(count($data['localidades']) == 0)
			{
				echo "<option value=''>Localidades --</option>";
				exit;
			}

			$cuerpo = $this->load->view('common/cargar_poblaciones',$data,true);

	        if ($this->input->is_ajax_request())
	        {
	            echo $cuerpo;
	            exit;
	        }
    	}

    	redirect(base_url());
    }

    function get_subcategorias()
    {
    	if($this->input->post('id',true))
    	{
    		$id = $this->input->post('id',true);
		
			$data['subcategorias'] = applib::get_all('*',applib::$subcat_table,array('categoria_id' => $id,'status !=' => 2),'name ASC');

			if(count($data['subcategorias']) == 0)
			{
				echo "<option value=''>Subcategorias --</option>";
				exit;
			}

			$cuerpo = $this->load->view('common/cargar_subcategorias',$data,true);

	        if ($this->input->is_ajax_request())
	        {
	            echo $cuerpo;
	            exit;
	        }
    	}

    	redirect(base_url());
    }

    function get_marcas()
    {
    	if($this->input->post('id',true))
    	{
    		$id = $this->input->post('id',true);
		
			$data['marcas'] = applib::get_marcas($id);

			if(count($data['marcas']) == 0)
			{
				echo "<option value=''>Marcas-</option>";
				exit;
			}

			$cuerpo = $this->load->view('common/cargar_marcas',$data,true);

	        if ($this->input->is_ajax_request())
	        {
	            echo $cuerpo;
	            exit;
	        }
    	}
    }

    function get_email()
    {
    	if($this->input->post('email',true))
    	{
    		$email = $this->input->post('email',true);
		
			$check = applib::get_table_field(applib::$users_table,array('email' => $email,'status !=' => 2),'email');

			if($check == "")
			{
				echo "success";
				exit;
			}
			else
			{
				echo "error";
				exit;
			}
    	}

    	redirect(base_url());
    }

    function get_nickname()
    {
    	if($this->input->post('nickname',true))
    	{
    		$nickname = $this->input->post('nickname',true);
		
			$check = applib::get_table_field(applib::$users_table,array('nickname' => $nickname,'status !=' => 2),'nickname');

			if($check == "")
			{
				echo "success";
				exit;
			}
			else
			{
				echo "error";
				exit;
			}
    	}

    	redirect(base_url());
    }

    function save_favoritos()
    {
    	if($this->input->post('id',true))
    	{
    		$id = $this->input->post('id',true);

    		if($this->session->userdata('user_id') != "")
    		{
    			$check = applib::check_favorito($id);

				if($check == false)
				{
					applib::create(applib::$favoritos_table,array('user_id' => $this->session->userdata('user_id'),'anuncio_id' => $id));
					echo "success";
					exit;
				}
				else
				{
					echo "Ya lo guardaste antes en tus Favoritos.";
					exit;
				}
    		}
    		else
    		{
    			echo "Ha ocurrido un error!";
    			exit;
    		}
    	}

    	redirect(base_url());
    }

    function set_filter_orden()
    {
    	if($this->input->post('filter',true))
    	{
    		$this->session->set_userdata('costo_menor_filter','');

    		$this->session->set_userdata('costo_mayor_filter','');

    		$this->session->set_userdata('fecha_orden_filter','');
    		
    		$filter = $this->input->post('filter',true);

    		if($filter != "fecha")
    		{
    			$this->session->set_userdata($filter,1);
    		}

    		echo "success";
    		exit;
    	}

    	redirect(base_url());
    }
}