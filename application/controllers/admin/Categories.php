<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct(){
        parent::__construct();
        applib::logued_in_admin(false);
    }

    public function index()
    {
    	$data['categorias'] = applib::get_all('*',applib::$cat_table,array('status !=' => 2));
    	$data['title'] = 'Categorias';
    	$data['contenido'] = 'categories/index';
    	$this->load->view('backend/templates/plantilla',$data);
    }

    public function add()
    {
        $this->load->library('form_validation');

        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
            $this->form_validation->set_rules('seo', 'Url Seo', 'required|trim');

            if ($this->form_validation->run())
            {
                $this->load->helper('text');

                $seo = url_title(convert_accented_characters($this->input->post("seo", true)),'-',TRUE);

                $data_in = array(
                    'name'      => $this->input->post('name',true),
                    'seo'       => $seo,
                    'status'    => $this->input->post('status',true)
                );

                applib::create(applib::$cat_table,$data_in);

                applib::flash('success','La categoría ha sido creada exitosamente','admin/categories');
                exit;
            }

        }

        $data['title'] = 'Añadir Categoria';
        $data['contenido'] = 'categories/add';
        $this->load->view('backend/templates/plantilla',$data);
    }

    public function edit($id)
    {
        if(!$id)
        {
            redirect(base_url('admin/categories'));
            exit;
        }

        $condition = array('id_categoria' => $id,'status !=' => 2);

        $data['categoria'] = applib::get_table_field(applib::$cat_table,$condition,'*');

        if($data['categoria'] == "")
        {
            redirect(base_url('admin/categories'));
            exit;
        }

        $this->load->library('form_validation');

        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
            $this->form_validation->set_rules('seo', 'Url Seo', 'required|trim');

            if ($this->form_validation->run())
            {
                $this->load->helper('text');

                $seo = url_title(convert_accented_characters($this->input->post("seo", true)),'-',TRUE);

                $data_in = array(
                    'name'      => $this->input->post('name',true),
                    'seo'       => $seo,
                    'status'    => $this->input->post('status',true)
                );

                applib::update(array('id_categoria' => $id),applib::$cat_table,$data_in);

                applib::flash('success','La categoría ha sido editada exitosamente','admin/categories');
                exit;
            }
        }

        

        $data['title'] = 'Editar Categoria';
        $data['contenido'] = 'categories/edit';
        $this->load->view('backend/templates/plantilla',$data);
    }

    function delete()
    {
        if($this->input->post('id'))
        {
            applib::update(array('id_categoria' => $this->input->post('id',true)),applib::$cat_table,array('status' => 2));

           //ELIMINAR TAMBIEN PRODUCTOS DEL USUARIO

             applib::flash('success','La categoría ha sido eliminada exitosamente','admin/categories');
             exit;
        }

        redirect(base_url('admin/users'));
    }
}
