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


        $data_2 = [
            "anuncio_id" => $this->input->post('id_anuncio'),
            "user_id" => $usuario->id_user
        ];
        $this->Anuncios_Model->newPuja($data_2);

        echo json_encode([
            "user" => $usuario->nickname
        ]);
    }

    public function pujaGanada(){
        $user_id = $this->session->userdata('user_id');
        $anuncio_id = $this->input->post('id_anuncio');

        $anuncio = $this->Anuncios_model->getAnuncio( $anuncio_id )[0];

        $info["producto_precio"] = $anuncio->precio_compra;
        $info["producto_puja"] = $anuncio->precio_puja;
        $info["producto_envio"] = $anuncio->precio_envio;
        $info["metodo_pago"] = "";
        $data = [
            "user_id" => $user_id,
            "producto_id" => $anuncio_id,
            "operacion" => "Puja Ganada",
            "data" => json_encode($info)
        ];
        $this->Anuncios_model->saveCompraProducto($data);

        echo json_encode([
            "user" => $usuario->nickname
        ]);
    }
}