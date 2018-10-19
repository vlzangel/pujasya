<?php

class Favoritos_model extends CI_Model {

    private $table = 'vv_favoritos';

    function __construct() {
        parent::__construct();
    }

    function get_all($condition)
    {
        $this->db->select('f.*,u.name as usuario,a.*,
        (SELECT name FROM vv_img_anuncios as img WHERE img.anuncio_id = a.id_anuncio AND img.order = 1) as imagen');
        $this->db->from($this->table.' as f');
        $this->db->join('vv_anuncios as a','a.id_anuncio = f.anuncio_id','left');
        $this->db->join('vv_users as u','u.id_user = f.user_id','left');
        $this->db->where($condition);
        $this->db->order_by('a.id_anuncio','desc');
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }
}