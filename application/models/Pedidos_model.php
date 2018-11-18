<?php

class Pedidos_model extends MY_Model {
    public function __construct(){
        parent::__construct("compras");
    }

    function insertTransaction($data = array()) {
        $insert = $this->db->insert('payments', $data);
        return $insert ? true : false;
    }

    function getTransaction($producto_id) {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get();
        return ($query) ? $query->result()[0] : false;
    }

    function updateTransaction($payment_id, $data){
        $this->db->where('payment_id', $payment_id);
        $this->db->update('payments', $data);
    }
}