<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_404 extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
    }
    public function index()
    {
    	$data['title'] = 'Error 404';
    	$data['contenido'] = 'errors/error_404';
    	$this->load->view('frontend/templates/plantilla',$data);    
    }
}
