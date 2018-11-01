<?php
    class Administrador_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        /* Login */

            function realpass($user){
                $this->db->select('pass_user');
                $this->db->from('users');
                $this->db->where('name_user', $user);
                $query = $this->db->get();
                return $query->row('pass_user');
            }

            public function verificaruser($user){
                $this->db->select('name_user, status_user');
                $this->db->where('name_user', $user);
                $this->db->from('users');
                $query = $this->db->get();
                if( $query ){
                    if ($query->num_rows() == 1) {
                        if ($query->row('status_user') == 1) {
                            return "valid";
                        } else {
                            return "disabled";
                        }
                    } else{
                        return "invalid";
                    }
                }else{
                    return "invalid";
                }
            }

            function adminData($user){
                $this->db->select('*');
                $this->db->from('users');
                $this->db->join('check_users', 'users.id_user = check_users.user_id', 'inner');
                $this->db->join('administrators', 'administrators.check_user_admin = check_users.code_user', 'inner');
                $this->db->where('name_user', $user);
                $query = $this->db->get();
                return $query->row_array();
            }

        /*  */


    }
?>