<?php

class Search_model extends CI_Model {

    private $table = 'anuncios';

    function __construct() {
        parent::__construct();
    }

    function get_productos($conditions, $order_by){
        $this->db->select('*');
        $this->db->from( $this->table );
        foreach ($conditions as $key => $value) {
            if( $value == "cerrada" ){
                $this->db->where( "status = 'cerrada' OR status = 'ganada' OR status = 'comprada'" );
            }else{
                $this->db->where( $key, $value );
            }
        }
        if( $order_by != null ){
            $this->db->order_by($order_by[0], $order_by[1]);
        }
        $query = $this->db->get();
        return ($query) ? $query->result_array() : false;
    }

}