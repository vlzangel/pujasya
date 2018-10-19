<?php

class Subcategorias_model extends CI_Model {

    private $table = 'vv_subcategorias';

    function __construct() {
        parent::__construct();
    }

    function get_all($condition)
    {
        $this->db->select('s.*,c.name as categoria');
        $this->db->from($this->table.' as s');
        $this->db->join('vv_categorias as c','c.id_categoria = s.categoria_id','left');
        $this->db->where($condition);
        $query = $this->db->get();

        return ($query)?$query->result_array():false;
    }
}