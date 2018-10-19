<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategories extends CI_Controller {

	public function __construct(){
        parent::__construct();
        applib::logued_in_admin(false);
    }

    public function index()
    {
        $this->load->model('subcategorias_model');
    	$data['subcategories'] = $this->subcategorias_model->get_all(array('s.status !=' => 2, 'c.status !=' => 2));
    	$data['title'] = 'Subcategorías';
    	$data['contenido'] = 'subcategories/index';
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
                    'name'          => $this->input->post('name',true),
                    'categoria_id'  => $this->input->post('categoria_id',true),
                    'seo'           => $seo,
                    'status'        => $this->input->post('status',true),
                    'date'          => applib::fecha()
                );

                applib::create(applib::$subcat_table,$data_in);

                applib::flash('success','La Subcategoría ha sido creada exitosamente','admin/subcategories');
                exit;
            }

        }

        $data['categorias'] = applib::get_all('*',applib::$cat_table,array('status !=' => 2));

        $data['title'] = 'Añadir Subcategoria';
        $data['contenido'] = 'subcategories/add';
        $this->load->view('backend/templates/plantilla',$data);
    }

    public function edit($id)
    {
        if(!$id)
        {
            redirect(base_url('admin/subcategories'));
            exit;
        }

        $condition = array('id_subcategoria' => $id,'status !=' => 2);

        $data['subcategoria'] = applib::get_table_field(applib::$subcat_table,$condition,'*');

        if($data['subcategoria'] == "")
        {
            redirect(base_url('admin/subcategories'));
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
                    'name'          => $this->input->post('name',true),
                    'seo'           => $seo,
                    'categoria_id'  => $this->input->post('categoria_id',true),
                    'status'        => $this->input->post('status',true)
                );

                applib::update(array('id_subcategoria' => $id),applib::$subcat_table,$data_in);

                applib::flash('success','La subcategoría ha sido editada exitosamente','admin/subcategories');
                exit;
            }
        }

        $data['categorias'] = applib::get_all('*',applib::$cat_table,array('status !=' => 2));

        $data['title'] = 'Editar Subcategoria';
        $data['contenido'] = 'subcategories/edit';
        $this->load->view('backend/templates/plantilla',$data);
    }

    function delete()
    {
        if($this->input->post('id'))
        {
            applib::update(array('id_subcategoria' => $this->input->post('id',true)),applib::$subcat_table,array('status' => 2));

           //ELIMINAR TAMBIEN PRODUCTOS DEL USUARIO

             applib::flash('success','La subcategoría ha sido eliminada exitosamente','admin/subcategories');
             exit;
        }

        redirect(base_url('admin/users'));
    }
}
