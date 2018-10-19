<?php

class Login_model extends CI_Model {

    private $table = 'vv_users';

    function __construct() {
        parent::__construct();
    }

    function validate($email,$pass)
    {
        $where = '(email = "'.$email.'" OR nickname = "'.$email.'") AND password = "'.$pass.'" AND status != 2';
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);
        $query = $this->db->get();

        return ($query)?$query->row_array():false;
    }

    function validateAdmin($email,$pass)
    {
        $where = array('email' => $email, 'password' => $pass,'status' => 1);
        $this->db->select('*');
        $this->db->from('vv_admin');
        $this->db->where($where);
        $query = $this->db->get();

        return ($query)?$query->row_array():false;
    }
}