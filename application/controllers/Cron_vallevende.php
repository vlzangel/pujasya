<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron_vallevende extends CI_Controller {
	
	public function __construct(){
        parent::__construct();

    }

    function index()
    {
    	redirect(base_url());
    }

    function terminar_anuncios()
    {
    	$this->load->model('anuncios_model');

    	$condition = array('a.fecha_fin <=' => applib::fecha(),'u.premium' => 0,'a.status' => 1);

    	$anuncios_terminados = $this->anuncios_model->get_all($condition);

    	print_r($anuncios_terminados);

    	echo count($anuncios_terminados);
    }
}
