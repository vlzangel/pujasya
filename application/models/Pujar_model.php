<?php

class Pujar_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_autopujas(){
        $this->db->select('ap.*, an.*, an.status AS status_anuncio');
        $this->db->from('autopujas AS ap');
        $this->db->join('anuncios AS an', 'an.id_anuncio = ap.anuncio_id', 'inner');
        $this->db->where('ap.status', 'activa');
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function get_all_autopujas_by_user($user_id){
        $this->db->select('ap.*, an.*, an.status AS status_anuncio');
        $this->db->from('autopujas AS ap');
        $this->db->join('anuncios AS an', 'an.id_anuncio = ap.anuncio_id', 'inner');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function saveAutopujas($data){
        $this->db->insert('autopujas', $data);
    }

    function update($autopuja_id, $data){
        $this->db->where('id', $autopuja_id);
        $this->db->update('autopujas', $data);
    }

    function update_by_anuncio($anuncio_id, $data){
        $this->db->where('anuncio_id', $anuncio_id);
        $this->db->update('autopujas', $data);
    }

}