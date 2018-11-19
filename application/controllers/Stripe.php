<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripe extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->library('Stripe_lib');
        $this->load->model('Pedidos_model');
        $this->load->model('Fichas_Model');
        $this->load->model('Anuncios_model');
    }

    public function pagar(){
        $this->stripe_lib->pagar( $this->input->post() );
    }

    function success( $pedido_id ){
        $pedido = $this->Pedidos_model->get($pedido_id)[0];
        $info = json_decode($pedido->data);

        if( $pedido->status == "precompra" || $pedido->status == "Pendiente"){

            if( $pedido->status == "precompra" ){
                switch ( $pedido->tipo_producto ) {
                    case 'fichas':
                        $this->Fichas_Model->asignarFichas($pedido->user_id, $info->fichas+0);
                    break;
                    case 'anuncio':
                        $this->Anuncios_model->updateStatus($pedido->producto_id, "comprada");
                    break;
                }   
            }else{
                $this->Anuncios_model->updateStatus($pedido->producto_id, "ganada");
            }

            $this->Pedidos_model->update($pedido_id, ["status" => "Pagada"]);

            $data['user_id'] = $pedido->user_id;
            $data['pedido_id'] = $pedido_id;
            $data['payment_status'] = "Completed"; 
            $this->Pedidos_model->insertTransaction($data);
        }

        applib::flash('success','Su compra ha sido procesada | <a href="'.base_url("cuenta/miscompras").'">Mis Compras</a>', 'search/grid/activa/0');
        exit();
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

    public function producto_pagado($pedido_id){
        $this->load->model('Fichas_Model');
        $this->load->model('Cuenta_model');
        $this->load->model('Anuncios_Model');

        $pedido = $this->Cuenta_model->get_compra($pedido_id)[0];
        $info = json_decode($pedido->data);

        $data['user_id'] = $pedido->user_id;
        $data['pedido_id'] = $pedido_id;
        $data['payment_status'] = "Completed";
        $this->Fichas_Model->insertTransaction($data);

        $info->metodo_pago = "Stripe";
        $_data["status"] = "Pagada";
        $_data["data"] = json_encode($info);
        $this->Cuenta_model->update_compra($pedido_id, $_data);

        $this->Anuncios_Model->updateStatus($info->producto_id, "cerrada");

        applib::flash('success','Su compra ha sido procesada | <a href="'.base_url("cuenta/miscompras").'">Mis Compras</a>', 'search/grid/activa/0');
        exit;
    }

}