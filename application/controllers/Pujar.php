<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pujar extends SuperController {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Anuncios_Model');
        $this->load->model('Usuarios_model');
    }

    public function pujar(){
        $user_id = $this->session->userdata('user_id');

        $usuario = $this->Usuarios_model->get_user($user_id);

        $data = [
            "precio_puja" => $this->input->post('precio_puja'),
            "ult_puja_user" => $usuario->nickname,
            "ult_puja_time" => date("Y-m-d H:i:s")
        ];

        $this->Anuncios_Model->updateAnuncio($this->input->post('id_anuncio'), $data);

        echo json_encode([
            "user" => $usuario->nickname
        ]);
    }
}