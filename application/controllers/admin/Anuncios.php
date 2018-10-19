<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anuncios extends CI_Controller {

	public function __construct(){
        parent::__construct();
        applib::logued_in_admin(false);
    }

    public function index()
    {
    	$this->load->model('anuncios_model');

    	$condition = array('a.status !=' => 2);

    	$data['anuncios'] = $this->anuncios_model->get_all($condition);

    	$data['title'] = 'Anuncios';
    	$data['contenido'] = 'anuncios/index';
    	$this->load->view('backend/templates/plantilla',$data);
    }

   public function edit($id)
    {
        if(!$id)
        {
            redirect(base_url('admin/anuncios'));
            exit;
        }

        $this->load->model('anuncios_model');

        $condition = array('id_anuncio' => $id,'a.status !=' => 2);

        $data['anuncio'] = $this->anuncios_model->get_by($condition);

        if($data['anuncio'] == "")
        {
            redirect(base_url('admin/anuncios'));
            exit;
        }

        $data['imagenes'] = applib::get_all('*',applib::$img_table,array('anuncio_id' => $id));

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

        $data['subcategorias'] = applib::get_all('*',applib::$subcat_table,array('status !=' => 2,'categoria_id' => $data['anuncio']['categoria_id']));

        $data['title'] = 'Editar Anuncio';
        $data['contenido'] = 'anuncios/edit';
        $this->load->view('backend/templates/plantilla',$data);
    }
}
