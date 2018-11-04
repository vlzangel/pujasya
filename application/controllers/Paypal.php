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
        $cancelURL = base_url() . 'paypal/cancefl/'.$pedido_id; //payment cancel url
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

    function cancelf($id){
        $this->session->set_userdata('paquete', $id);
        $this->session->set_userdata('metodo', 'paypal');
        $this->session->set_userdata('status_pago', 'fallo');

        redirect( base_url("comprarfichas") );
    }

    function ipnf(){
        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo["item_number"];
        $data['txn_id'] = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

        //check whether the payment is verified
        if (eregi("VERIFIED", $result)) {
            $this->product->insertTransaction($data);
        } 
    }
}