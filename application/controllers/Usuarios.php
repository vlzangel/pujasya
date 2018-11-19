<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

    public function list() {
        $users = $this->Usuarios_model->get_list();

        $data["data"] = [];
        foreach ($users as $key => $users) {
            $data["data"][] = [
                $users->id_user,
                $users->name,
                $users->email,
                $users->nickname,
                '
                    <a href="javascript: editar('.$users->id_user.');" title="Editar" style="margin-right: 10px;">
                        <i class="fa fa-pencil text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                    </a>
                '
            ];
        }

        echo json_encode($data);
    }

    public function new(){
        $data["robots"] = $this->Usuarios_model->get_list();
        $this->load->view('backend/templates/modal', [
            "titulo" => "Nuevo Usuario",
            "accion" => "Crear",
            "data" => $data,
            "plantilla" => "usuarios/show"
        ]);
    }

    public function edit($id){
        $data["info"] = $this->Usuarios_model->get_user($id);

        $this->load->view('backend/templates/modal', [
            "titulo" => "Editar Usuario",
            "accion" => "Actualizar",
            "data" => $data,
            "plantilla" => "usuarios/show"
        ]);
    }

}