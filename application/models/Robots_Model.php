<?php
    class Robots_Model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function get_list(){
            $this->db->select('*');
            $this->db->from('vv_users');
            $this->db->where('robot', 1);
            $query = $this->db->get();
            return ($query) ? $query->result() : false;
        }

        function get($id){
            $this->db->select('*');
            $this->db->from('vv_users');
            $this->db->where('id_user', $id);
            $query = $this->db->get();
            return ($query) ? $query->result()[0] : false;
        }

        function save($data){
            $this->db->insert('vv_users', $data);
        }

        function update($id, $data){
            $this->db->where('id_user', $id);
            $this->db->update('vv_users', $data);
        }

        function delete($id){
            $this->db->where('id_user', $id);
            $this->db->delete('vv_users');
        }

    }
?>