<?php
    class Cupones_Model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function get_list(){
            $this->db->select('*');
            $this->db->from('cupones');
            $query = $this->db->get();
            return ($query) ? $query->result() : false;
        }

        function get($id){
            $this->db->select('*');
            $this->db->from('cupones');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return ($query) ? $query->result()[0] : false;
        }

        function get_cupon_name($cupon_name){
            $this->db->select('*');
            $this->db->from('cupones');
            $this->db->where('nombre', $cupon_name);
            $query = $this->db->get();
            return ($query) ? $query->result()[0] : false;
        }

        function save($data){
            $this->db->insert('cupones', $data);
        }

        function update($id, $data){
            $this->db->where('id', $id);
            $this->db->update('cupones', $data);
        }

        function delete($id){
            $this->db->where('id', $id);
            $this->db->delete('cupones');
        }

    }
?>