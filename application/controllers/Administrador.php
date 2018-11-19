<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrador extends SuperController {
  
    public function __construct(){
        parent::__construct();
        applib::destroy_filters();
        if ( !$this->session->userdata('username') ){
            $this->session->sess_destroy();
            redirect( base_url().'admin' );
        }
        $this->load->model('Administrador_Model');
    }

    public function home(){
        $data['title'] = 'Entrar';
        $data['contenido'] = 'administrador';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function anuncios(){
        $data['title'] = 'Entrar';
        $data['contenido'] = 'anuncios/list';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function users(){
        $data['title'] = 'Entrar';
        $data['contenido'] = 'users/list';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function fichas(){
        $data['title'] = 'Fichas';
        $data['contenido'] = 'fichas/list';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function cupones(){
        $data['title'] = 'Entrar';
        $data['contenido'] = 'cupones/list';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function robots(){
        $data['title'] = 'Entrar';
        $data['contenido'] = 'robots/list';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function usuarios(){
        $data['title'] = 'Entrar';
        $data['contenido'] = 'usuarios/list';
        $this->load->view('backend/templates/plantilla', $data);
    }

    public function salir(){
        $this->removeCache();
        // $this->Administrador_model->outSession();
        $this->session->sess_destroy();
        redirect( base_url().'admin' );
    }

}