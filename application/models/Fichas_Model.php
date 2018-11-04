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

        function get_pedido($pedido_id){
            $this->db->select('*');
            $this->db->from('compras_fichas');
            $this->db->where('id', $pedido_id);
            $query = $this->db->get();
            return ($query) ? $query->result()[0] : false;
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
            $this->db->from('compras_fichas');
            $this->db->where('user', $data["user"]);
            $this->db->order_by('id','DESC');
            $query = $this->db->get();
            $pedido = $query->result()[0];

            return $pedido->id;
        }

        function asignarFichas($user_id, $fichas){
            $this->db->select('*');
            $this->db->from('vv_users');
            $this->db->where('id_user', $user_id);
            $query = $this->db->get();
            $user = $query->result()[0];

            $this->db->where('id_user', $data["user"]);
            $this->db->update('vv_users', ["fichas" => ($user->fichas+$fichas) ]);
        }
        
        function delete($id){
            $this->db->where('id', $id);
            $this->db->delete('fichas');
        }

        function insertTransaction($data = array()) {
            $insert = $this->db->insert('payments', $data);
            return $insert ? true : false;
        }

        function update_pedido($id, $data){
            $this->db->where('id', $id);
            $this->db->update('compras_fichas', $data);
        }

    }
?>