<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->library('Paypal_lib');
    }

    function buy_fichas($pedido_id) {
        /*if($this->session->userdata('user_id') != ""){
            redirect( base_url() );
            exit;
        }*/

        $this->load->model('Fichas_Model');

        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $info = json_decode($pedido->data);

        if( $info->cupon != ""){
            $descuento = $info->cupon[3];
        }

        //Set variables for paypal form
        $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //test PayPal api url
        $paypalID = 'vlzangel91-facilitator@gmail.com'; //business email

        $returnURL = base_url() . 'paypal/successf/'.$pedido_id; //payment success url
        $cancelURL = base_url() . 'paypal/cancelf/'.$pedido_id; //payment cancel url
        $notifyURL = base_url() . 'paypal/ipnf/'; //ipn url

        //get particular product data
        $paquete = $this->Fichas_Model->getAnuncio($info->paquete_id)[0];
        $userID = $this->session->userdata('user_id'); //current user id
        $logo = base_url().'files/fichas/'.$paquete->img;

        $this->paypal_lib->add_field('business', $paypalID);
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);

        $this->paypal_lib->add_field('item_name', $info->nombre);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number', $pedido_id);
        $this->paypal_lib->add_field('amount', $info->paquete_precio-$descuento);
        $this->paypal_lib->image($logo);

        $this->paypal_lib->paypal_auto_form();
    }

    function successf($pedido_id){

        $this->load->model('Fichas_Model');
        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $info = json_decode($pedido->data);

        if( $info->cupon != "" ){
            $this->session->set_userdata('cupon', $info->cupon);
        }

        $this->session->set_userdata('pedido_id', $pedido_id);
        $this->session->set_userdata('paquete_id', $info->paquete_id);
        $this->session->set_userdata('metodo', 'paypal');
        $this->session->set_userdata('status_pago', 'ok');

        redirect( base_url("comprarfichas") );
    }

    function cancelf($pedido_id){

        $this->load->model('Fichas_Model');
        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $info = json_decode($pedido->data);

        if( $info->cupon != "" ){
            $this->session->set_userdata('cupon', $info->cupon);
        }

        $this->session->set_userdata('pedido_id', $pedido_id);
        $this->session->set_userdata('paquete_id', $info->paquete_id);
        $this->session->set_userdata('metodo', 'paypal');
        $this->session->set_userdata('status_pago', 'fallo');

        redirect( base_url("comprarfichas") );
    }

    function us($pedido_id){
        $this->load->model('Fichas_Model');
        $data['user_id'] = "636";
        $data['pedido_id'] = $pedido_id;
        $pedido = $this->Fichas_Model->get_pedido($pedido_id);
        $_data = json_decode($pedido->data);
        $this->Fichas_Model->procesar_compra($data['pedido_id']+0, $data['user_id']+0, $_data->paquete_fichas+1);
    }

    function ipnf($pedido_id){
        $this->load->model('Fichas_Model');
        $paypalInfo = $this->input->post();
        $data['user_id'] = $paypalInfo['custom'];
        $data['pedido_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];
        file_put_contents('export.txt', var_export($data, true) );
        $_temp = $data;
        $pedido = $this->Fichas_Model->get_pedido($paypalInfo["item_number"]+0);
        $_data = json_decode($pedido->data);
        $this->Fichas_Model->procesar_compra($paypalInfo["item_number"]+0, $paypalInfo['custom']+0, $_data->paquete_fichas+0);
        $this->Fichas_Model->insertTransaction($_temp);
        $transaccion = $this->Fichas_Model->getTransaction( $paypalInfo["item_number"]+0 );
        if( $transaccion == false ){
            $this->Fichas_Model->insertTransaction($_temp);

            if( strtolower(trim($data['payment_status'])) == strtolower("Completed") ){
                $this->Fichas_Model->procesar_compra($paypalInfo["item_number"]+0, $paypalInfo['custom']+0, $_data->paquete_fichas+0);
            }
        }else{
            // $this->Fichas_Model->updateTransaction($transaccion->payment_id, $data);
        }
    }
}