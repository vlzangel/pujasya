<?php

class Usuarios_model extends CI_Model {


    function __construct() {
        parent::__construct();
    }

    function get_list(){
        $this->db->select('*');
        $this->db->from('vv_users');
        $this->db->where('robot', 0);
        $this->db->order_by('id_user','DESC');
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

    function get_user($id){
        $this->db->select('*');
        $this->db->from('vv_users');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return ($query) ? $query->result()[0] : false;
    }

    function get_user_nick($nickname){
        $this->db->select('*');
        $this->db->from('vv_users');
        $this->db->where('nickname', $nickname);
        $query = $this->db->get();
        return ($query) ? $query->result()[0] : false;
    }

    function update($id_user, $data){
        $this->db->where('id_user', $id_user);
        $this->db->update('vv_users', $data);
    }

}