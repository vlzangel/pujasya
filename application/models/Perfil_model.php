<?php

class Perfil_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_paises(){
        $this->db->select('*');
        $this->db->from( "pais" );
        $this->db->order_by('paisnombre','ASC');
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }

}