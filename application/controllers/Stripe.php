<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripe extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->library('Stripe_lib');
    }

    public function probar(){
        $this->stripe_lib->probar();
    }

    public function pagar(){
        $this->stripe_lib->pagar( $this->input->post() );
    }

    public function fichas_pagadas($pedido_id){

        $this->load->model('Fichas_Model');
        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $info = json_decode($pedido->data);
        
        $data['user_id'] = $pedido->user;
        $data['pedido_id'] = $pedido_id;
        $data['payment_status'] = "Completed";
        
        $this->Fichas_Model->procesar_compra($pedido_id, $pedido->user, $info->paquete_fichas+0);
        $this->Fichas_Model->insertTransaction($data);

        applib::flash('success','Su compra ha sido procesada | <a href="'.base_url("cuenta/miscompras").'">Mis Compras</a>', 'search/grid/activa/0');
        exit;
    }

    public function view(){
        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Planes Empresas PREMIUM, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Comprar Fichas';
        $data['contenido'] = 'cuenta/view';
        $this->load->view('frontend/templates/plantilla', $data);
    }

}