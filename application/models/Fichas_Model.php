<?php
    class Fichas_Model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        function get_list($status = NULL){
            $this->db->select('*');
            $this->db->from('fichas');
            if( $status != NULL ){
                $this->db->where('status', $status);
            }
            $this->db->order_by('id','ASC');
            $query = $this->db->get();
            return ($query) ? $query->result() : false;
        }

        function getAnuncio($id){
            $this->db->select('*');
            $this->db->from('fichas');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return ($query) ? $query->result() : false;
        }

        function save($data){
            $this->db->insert('fichas', $data);
        }

        function update($id, $data){
            $this->db->where('id', $id);
            $this->db->update('fichas', $data);
        }

        function saveCompra($data, $fichas){
            $this->db->insert('compras_fichas', $data);

            $this->db->select('*');
            $this->db->from('vv_users');
            $this->db->where('id_user', $data["user"]);
            $query = $this->db->get();
            $user = $query->result()[0];

            $this->db->where('id_user', $data["user"]);
            $this->db->update('vv_users', ["fichas" => ($user->fichas+$fichas) ]);
        }
        
        function delete($id){
            $this->db->where('id', $id);
            $this->db->delete('fichas');
        }

    }
?>