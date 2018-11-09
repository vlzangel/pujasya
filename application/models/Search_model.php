<?php

class Search_model extends CI_Model {

    private $table = 'anuncios';

    function __construct() {
        parent::__construct();
    }

    function get_revision(){
        $this->db->select('*');
        $this->db->from( $this->table );
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }

    function get_productos($conditions, $order_by){
        $this->db->select('*');
        $this->db->from( $this->table );
        foreach ($conditions as $key => $value) {
            switch ( $value ) {
                case 'activa':
                    $this->db->where( "status = 'activa' AND fecha_inicio <= NOW()" );
                break;

                case 'cerrada':
                    $this->db->where( "status = 'cerrada' OR status = 'ganada' OR status = 'comprada'" );
                break;

                case 'proximas':
                    $this->db->where( "status = 'activa' AND fecha_inicio > NOW()" );
                break;
                
                default:
                    $this->db->where( $key, $value );
                break;
            }
        }
        if( $order_by != null ){
            $this->db->order_by($order_by[0], $order_by[1]);
        }
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }

}