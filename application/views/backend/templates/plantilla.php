<?php
	$this->load->view('backend/templates/styles', $data);
	$this->load->view('backend/templates/header');
	$this->load->view('backend/templates/aside');
	$this->load->view('backend/templates/raside', $raside);
    $this->load->view('backend/'.$contenido);
	$this->load->view('backend/templates/footer');
	$this->load->view('backend/templates/scripts');
	$this->load->view('backend/templates/endHtml');