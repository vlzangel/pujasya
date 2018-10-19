<?php

class Sidebar_model extends CI_Model {

    private $table = 'vv_sidebar';

    function __construct() {
        parent::__construct();
    }

    function get_all($condition)
    {
        $this->db->select('s.*,c.name,c.seo,c.id_categoria');
        $this->db->from($this->table.' as s');
        $this->db->join('vv_categorias as c','c.id_categoria = s.categoria_id','left');
        $this->db->where($condition);
        $this->db->order_by('orden','ASC');
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }
}