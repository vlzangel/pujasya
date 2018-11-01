<?php

class Users_model extends CI_Model {


    function __construct() {
        parent::__construct();
    }

    function get_list(){
        $this->db->select('*');
        $this->db->from('vv_users');
        $this->db->order_by('id_user','DESC');
        $query = $this->db->get();
        return ($query) ? $query->result() : false;
    }

}