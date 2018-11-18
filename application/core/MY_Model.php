<?php

class MY_Model extends CI_Model {

    private $table = "";

    public function __construct($table){
        parent::__construct();
        $this->table = $table;
    }

    function all($condiciones = null){
        $this->db->select('*');
        $this->db->from($this->table);
        if( $condiciones != null ){ $this->db->where($condiciones); }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function get( $id ){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function create($data){
        $this->db->insert($this->table, $data);
    }

    function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}