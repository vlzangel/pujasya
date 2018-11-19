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

    function get_productos($conditions, $order_by, $user_id = null){

        switch ( $conditions["status"] ) {
            case 'ganada':
                $this->db->select('an.*');
                $this->db->from( "pujas_by_user" );
                $this->db->join('anuncios AS an', 'an.id_anuncio = pujas_by_user.anuncio_id', 'inner');
                $this->db->where( "pujas_by_user.status = 'ganada' AND pujas_by_user.user_id = ".$user_id );

                if( $order_by != null ){
                    $this->db->order_by("an.".$order_by[0], $order_by[1]);
                }
            break;
            case 'favoritos':
                $this->db->select('an.*');
                $this->db->from( "vv_favoritos" );
                $this->db->join('anuncios AS an', 'an.id_anuncio = vv_favoritos.anuncio_id', 'inner');
                $this->db->where( "vv_favoritos.user_id = ".$user_id );

                if( $order_by != null ){
                    $this->db->order_by("an.".$order_by[0], $order_by[1]);
                }
            break;
            
            default:
                $this->db->select('*');
                $this->db->from( $this->table );
                switch ( $conditions["status"] ) {
                    case 'activa':
                        $this->db->where( "status = 'activa' AND fecha_inicio <= NOW()" );
                    break;

                    case 'cerrada':
                        $this->db->where( "status = 'cerrada' OR status = 'comprada' OR status = 'ganada' " );
                    break;

                    case 'proximas':
                        $this->db->where( "status = 'activa' AND fecha_inicio > NOW()" );
                    break;

                    case 'ganada':
                        $this->db->where( "status = 'activa' AND fecha_inicio > NOW() AND " );
                    break;
                    
                    default:
                        $this->db->where( $key, $value );
                    break;
                }

                if( $order_by != null ){
                    $this->db->order_by($order_by[0], $order_by[1]);
                }
            break;
        }

        $query = $this->db->get();
        return ($query) ? $query->result_array() : [];
    }

}