<?php

class Cuenta_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_mis_compras($user_id){
        $this->db->select('compras_productos.*, anuncios.*');
        $this->db->from('compras_productos');
        $this->db->join('anuncios', 'anuncios.id_anuncio = compras_productos.producto_id', 'inner');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

}