<?php
	$this->load->view('backend/templates/modal/header', [ "titulo" => $titulo ]);
	$this->load->view('backend/'.$plantilla, $data);
	$this->load->view('backend/templates/modal/footer', [ "accion" => $accion ]);
?>