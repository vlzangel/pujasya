<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Search_model');
    }

    private function getOrderBy($ordenBy){
        $orden = [
            null,
            ["id", "DESC"],
            ["precio_puja", "ASC"],
            ["precio_puja", "DESC"]
        ];
        return $orden[ $ordenBy ];
    }

    private function getProduts($status = null, $orderBy = null){
        $status = ( $status != null ) ? $status : 'activa';
        $orderByStr = ( $orderBy != null ) ? $this->getOrderBy($orderBy) : null;

        $conditions = [
            'status' => $status
        ];

        $data['status'] = $status;
        $data['orderBy'] = $orderBy;

        $data['premium'] = $this->Search_model->get_productos($conditions, $orderByStr);

        //Extraer nuevos usuarios
        $data['users'] = applib::get_all('*',applib::$users_table,array('status' => 1,'name !=' => null,'nickname !=' => null,'seo !=' => null,'mostrar_perfil' => 1),'id_user DESC','18,0');
        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Pujas';

        return $data;
    }

    function grid($status = null, $orderBy = null) {
        $data = $this->getProduts($status, $orderBy);
        $data['contenido'] = 'index/index';

        /*echo "<pre>";
            print_r( $data );
        echo "</pre>";*/

        $this->load->view('frontend/templates/plantilla',$data);
    }

    function list($status = null, $orderBy = null) {
        $data = $this->getProduts($status, $orderBy);
        $data['contenido'] = 'index/bidlist';
        $this->load->view('frontend/templates/plantilla',$data);
    }

}