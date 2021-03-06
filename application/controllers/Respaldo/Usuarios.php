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
                '
                    <a href="javascript: editar('.$users->id_user.');" title="Editar" style="margin-right: 10px;">
                        <i class="fa fa-pencil text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                    </a>
                '
            ];
        }

        echo json_encode($data);
    }

}