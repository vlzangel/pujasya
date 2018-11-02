<?php

class Favoritos_model extends CI_Model {

    private $table = 'vv_favoritos';

    function __construct() {
        parent::__construct();
    }

    function get_all($user_id){
        $this->db->select('vv_favoritos.id_favorito, anuncios.*');
        $this->db->from('vv_favoritos');
        $this->db->join('anuncios', 'anuncios.id_anuncio = vv_favoritos.anuncio_id', 'inner');
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }

    function get_mis_favoritos($user_id){
        $this->db->select('*');
        $this->db->from('vv_favoritos');
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }

    function get_es_favorito($user_id, $anuncio_id){
        $this->db->select('*');
        $this->db->from('vv_favoritos');
        $this->db->where("user_id", $user_id);
        $this->db->where("anuncio_id", $anuncio_id);
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }
}