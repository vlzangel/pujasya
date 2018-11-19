<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->library('Paypal_lib');
        $this->load->model('Pedidos_model');
        $this->load->model('Fichas_Model');
        $this->load->model('Anuncios_model');
    }

    function buy($pedido_id) {
        /*if($this->session->userdata('user_id') != ""){
            redirect( base_url() );
            exit;
        }*/

        $pedido = $this->Pedidos_model->get($pedido_id)[0];
        $info = json_decode($pedido->data);

        if( $info->cupon != ""){
            $descuento = $info->cupon[3];
        }

        $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $paypalID = 'vlzangel91-facilitator@gmail.com';

        $returnURL = base_url() . 'paypal/success/'.$pedido_id;
        $cancelURL = base_url() . 'paypal/cancel/'.$pedido_id;
        $notifyURL = base_url() . 'paypal/ipn/';

        $userID = $this->session->userdata('user_id');
        $logo = base_url().$info->img;

        $this->paypal_lib->add_field('business', $paypalID);
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);

        $this->paypal_lib->add_field('item_name', $info->nombre);
        $this->paypal_lib->add_field('custom', $pedido->user_id);
        $this->paypal_lib->add_field('item_number', $pedido_id);
        $this->paypal_lib->add_field('amount', $info->pago);
        $this->paypal_lib->image($logo);
    
        $this->paypal_lib->paypal_auto_form();
    }

    function success($pedido_id){
        $this->procesar($pedido_id);
    }

    function cancel($pedido_id){
        $this->Pedidos_model->delete($pedido_id);
        applib::flash('danger','Su compra no ha sido procesada, Verifica los datos de tu método de pago e inténtalo de nuevo', 'search/grid/activa/0');
    }

    function ipn($pedido_id){
        $this->procesar($pedido_id, $this->input->post() );
    }


    private function procesar($pedido_id, $paypalInfo = NULL ){
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

            if( $paypalInfo == NULL ){
                $data['user_id'] = $pedido->user_id;
                $data['pedido_id'] = $pedido_id;
                $data['payment_status'] = "Completed"; 
            }else{
                $data['user_id'] = $paypalInfo['custom'];
                $data['pedido_id'] = $pedido_id;
                $data['txn_id'] = $paypalInfo["txn_id"];
                $data['payment_gross'] = $paypalInfo["payment_gross"];
                $data['currency_code'] = $paypalInfo["mc_currency"];
                $data['payer_email'] = $paypalInfo["payer_email"];
                $data['payment_status'] = $paypalInfo["payment_status"];
            }
            $transaccion = $this->Pedidos_model->getTransaction( $pedido_id );
            if( $transaccion == false ){
                $this->Pedidos_model->insertTransaction($data);    
            }else{
                $this->Pedidos_model->updateTransaction($data); 
            }

        }

        if( $paypalInfo == NULL ){
            applib::flash('success','Su compra ha sido procesada | <a href="'.base_url("cuenta/miscompras").'">Mis Compras</a>', 'search/grid/activa/0');
            exit();
        }
    }



/*
    function us($pedido_id){
        $this->load->model('Fichas_Model');
        $data['user_id'] = "636";
        $data['pedido_id'] = $pedido_id;
        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $_data = json_decode($pedido->data);
        $this->Fichas_Model->procesar_compra($data['pedido_id']+0, $data['user_id']+0, $_data->paquete_fichas+1);
    }
*/










    function buy_producto($pedido_id) {
       
        $this->load->model('Cuenta_model');

        $pedido = $this->Cuenta_model->get_compra($pedido_id)[0];
        $info = json_decode($pedido->data);

        $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $paypalID = 'vlzangel91-facilitator@gmail.com';

        $returnURL = base_url() . 'paypal/successp/'.$pedido_id;
        $cancelURL = base_url() . 'paypal/cancelp/'.$pedido_id;
        $notifyURL = base_url() . 'paypal/ipnp/';

        $userID = $this->session->userdata('user_id');

        $this->paypal_lib->add_field('business', $paypalID);
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);

        $this->paypal_lib->add_field('item_name', $pedido->titulo);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number', $pedido_id);
        $this->paypal_lib->add_field('amount', $info->producto_puja+$info->producto_envio);

        $this->paypal_lib->paypal_auto_form();
    }

    function successp($pedido_id){
        $this->load->model('Cuenta_model');
        $this->load->model('Fichas_Model');
        $pedido = $this->Cuenta_model->get_compra($pedido_id)[0];
        if( $pedido->status_compra == "Pendiente" ){
            $_data['user_id'] = $pedido->user_id;
            $_data['product_id'] = $pedido->id_anuncio;
            $_data['payment_status'] = "Completed";
            $transaccion = $this->Fichas_Model->getTransaction( $pedido->id_anuncio );
            if( $transaccion == false ){
                $info = json_decode($pedido->data);
                $info->metodo_pago = "Paypal";
                $data["status"] = "Pagada";
                $data["data"] = json_encode($info);
                $this->Cuenta_model->update_compra($pedido_id, $data);
                $this->Fichas_Model->insertTransaction($_data);
            }
        }
        $this->session->set_userdata('pedido_id', $pedido_id);
        $this->session->set_userdata('producto_id', $pedido->id_anuncio);
        $this->session->set_userdata('metodo', 'paypal');
        $this->session->set_userdata('status_pago', 'ok');

        redirect( base_url("comprarproducto/".$pedido->id_anuncio) );
    }

    function cancelp($pedido_id){
        /*
        $this->load->model('Cuenta_model');
        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $info = json_decode($pedido->data);

        if( $info->cupon != "" ){
            $this->session->set_userdata('cupon', $info->cupon);
        }

        $this->session->set_userdata('pedido_id', $pedido_id);
        $this->session->set_userdata('paquete_id', $info->paquete_id);
        $this->session->set_userdata('metodo', 'paypal');
        $this->session->set_userdata('status_pago', 'fallo');

        redirect( base_url("comprarproducto") );*/
    }

    function ipnp($pedido_id){
        /*$this->load->model('Cuenta_model');

        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['pedido_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $pedido = $this->Fichas_Model->get_pedido($paypalInfo["item_number"]+0);
        $_data = json_decode($pedido->data);

        $transaccion = $this->Fichas_Model->getTransaction( $paypalInfo["item_number"]+0 );
        if( $transaccion == false ){
            $this->Fichas_Model->insertTransaction($data);

            if( strtolower(trim($data['payment_status'])) == strtolower("Completed") ){
                $this->Fichas_Model->procesar_compra($paypalInfo["item_number"]+0, $paypalInfo['custom']+0, $_data->paquete_fichas+0);
            }
        }else{
            $this->Fichas_Model->updateTransaction($transaccion->payment_id, $data);
        }*/
    }
}