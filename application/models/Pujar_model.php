<?php

class Pujar_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* PUJAS */

        function get_pujas_by_user_anuncio($user_id, $anuncio_id){
            $this->db->select('*');
            $this->db->from('pujas_by_user');
            $this->db->where('user_id', $user_id);
            $this->db->where('anuncio_id', $anuncio_id);
            $this->db->where('status', "activa");
            $query = $this->db->get();
            return ($query) ? $query->result() : false;
        }

        function get_pujas_by_user($user_id){
            $this->db->select('pbu.id, pbu.user_id, pbu.anuncio_id, pbu.status AS mi_status, pbu.ult_puja, pbu.precio_actual, an.*');
            $this->db->from('pujas_by_user AS pbu');
            $this->db->join('anuncios AS an', 'an.id_anuncio = pbu.anuncio_id', 'inner');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get();
            return ($query) ? $query->result() : false;
        }

        function savePuja($data){
            $this->db->insert('pujas_by_user', $data);
        }

        function updatePuja($puja_id, $data){
            $this->db->where('id', $puja_id);
            $this->db->update('pujas_by_user', $data);
        }

        function updatePuja_by_anuncio($anuncio_id, $data){
            $this->db->where('anuncio_id', $anuncio_id);
            $this->db->where('status', "activa");
            $this->db->update('pujas_by_user', $data);
        }

        function updatePuja_by_user_anuncio($user_id, $anuncio_id, $data){
            $this->db->where('user_id', $user_id);
            $this->db->where('anuncio_id', $anuncio_id);
            $this->db->where('status', "activa");
            $this->db->update('pujas_by_user', $data);
        }

    /* AUTOPUJAS */

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

        function updateAutopujas($autopuja_id, $data){
            $this->db->where('anuncio_id', $autopuja_id);
            $this->db->update('autopujas', $data);
        }

        function update_by_anuncio($anuncio_id, $data){
            $this->db->where('anuncio_id', $anuncio_id);
            $this->db->update('autopujas', $data);
        }

}