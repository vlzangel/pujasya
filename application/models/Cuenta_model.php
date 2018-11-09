<?php

class Cuenta_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_mis_compras($user_id){
        $this->db->select('cp.id, cp.user_id, cp.data AS data, cp.operacion, cp.status AS status_compra, cp.fecha, anuncios.*');
        $this->db->from('compras_productos AS cp');
        $this->db->join('anuncios', 'anuncios.id_anuncio = cp.producto_id', 'inner');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function get_compra($pedido_id){
        $this->db->select('cp.id, cp.user_id, cp.data AS data, cp.operacion, cp.status AS status_compra, cp.fecha, anuncios.*');
        $this->db->from('compras_productos AS cp');
        $this->db->join('anuncios', 'anuncios.id_anuncio = cp.producto_id', 'inner');
        $this->db->where('id', $pedido_id);
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function update_compra($pedido_id, $data){
        $this->db->where('id', $pedido_id);
        $this->db->update('compras_productos', $data);
    }

}