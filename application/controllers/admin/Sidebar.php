<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar extends CI_Controller {

	public function __construct(){
        parent::__construct();
        applib::logued_in_admin(false);
    }

    public function index()
    {
    	$this->load->model('sidebar_model');

    	$data['menu_sidebar'] = $this->sidebar_model->get_all(array('s.status !=' => 2));

    	$data['count_sidebar'] = applib::count_table_rows(applib::$sidebar_table,array('status' => 1));

    	$data['title'] = 'Administrar sidebar';
    	$data['contenido'] = 'sidebar/index';
    	$this->load->view('backend/templates/plantilla',$data);
    }

    public function add()
    {
    	$this->load->library('form_validation');

    	if($this->input->post())
        {
            $this->form_validation->set_rules('categoria_id', 'Categoría', 'required|trim');

            if ($this->form_validation->run())
            {
                $data_in = array(
                    'categoria_id'	=> $this->input->post('categoria_id',true),
                    'html_inicio'   => $this->input->post('html_inicio',true),
                    'html_final'   	=> $this->input->post('html_final',true),
                    'status'    	=> $this->input->post('status',true),
                    'orden'			=> $this->input->post('orden',true),
                );

                applib::create(applib::$sidebar_table,$data_in);

                applib::flash('success','El menú ha sido creada exitosamente','admin/sidebar');
                exit;
            }

        }

        $data['count_sidebar'] = applib::count_table_rows(applib::$sidebar_table,array('status' => 1));

    	$data['categorias'] = applib::get_all('*',applib::$cat_table,array('status !=' => 2));

    	$data['title'] = 'Añadir menu sidebar';
    	$data['contenido'] = 'sidebar/add';
    	$this->load->view('backend/templates/plantilla',$data);
    }

    public function edit($id)
    {
    	if(!$id)
    	{
    		redirect(base_url('admin/sidebar'));
    		exit;
    	}

    	$data['menu'] = applib::get_table_field(applib::$sidebar_table,array('id_sidebar' => $id,'status !=' => 2),'*');

    	if($data['menu'] == "")
    	{
    		redirect(base_url('admin/sidebar'));
    		exit;
    	}

    	$this->load->library('form_validation');

    	if($this->input->post())
        {
            $this->form_validation->set_rules('categoria_id', 'Categoría', 'required|trim');

            if ($this->form_validation->run())
            {
                $data_in = array(
                    'categoria_id'	=> $this->input->post('categoria_id',true),
                    'html_inicio'   => $this->input->post('html_inicio',true),
                    'html_final'   	=> $this->input->post('html_final',true),
                    'status'    	=> $this->input->post('status',true),
                    'orden'			=> $this->input->post('orden',true),
                );

                applib::update(array('id_sidebar' => $id),applib::$sidebar_table,$data_in);

                applib::flash('success','El menú ha sido editado exitosamente','admin/sidebar');
                exit;
            }

        }

    	$data['count_sidebar'] = applib::count_table_rows(applib::$sidebar_table,array('status' => 1));

    	$data['categorias'] = applib::get_all('*',applib::$cat_table,array('status !=' => 2));

    	$data['title'] = 'Añadir menu sidebar';
    	$data['contenido'] = 'sidebar/edit';
    	$this->load->view('backend/templates/plantilla',$data);

    }

    public function cambiar_posicion()
    {
    	if($this->input->post('orden'))
    	{
    		applib::update(array('id_sidebar' => $this->input->post('id',true)),applib::$sidebar_table,array('orden' => $this->input->post('orden',true)));

    		applib::flash('success','La posición del menu ha sido cambiada!','admin/sidebar');
    		exit;
    	}
    	else
    	{
    		redirect(base_url('admin/sidebar'));
    		exit;
    	}
    }

    function delete()
    {
        if($this->input->post('id'))
        {
            applib::update(array('id_sidebar' => $this->input->post('id',true)),applib::$sidebar_table,array('status' => 2));

            applib::flash('success','El menú ha sido eliminado exitosamente','admin/sidebar');
            exit;
        }

        redirect(base_url('admin/sidebar'));
    }
}