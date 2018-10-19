<?php

	//$data['categorias_sidebar'] = $this->sidebar_model->get_all(array('s.status' => 1));

	$this->load->view('frontend/templates/header');

	//Paginas que no necesitan sidebar 
	
	if($contenido != "login/index" AND $contenido != "login/recuperar" AND $contenido != "login/recuperar_password")
	{
		//$this->load->view('frontend/templates/sidebar',$data);
	}
	
    $this->load->view('frontend/'.$contenido);
	$this->load->view('frontend/templates/footer');
