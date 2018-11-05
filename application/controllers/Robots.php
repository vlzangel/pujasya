<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Robots extends SuperController {
  
    public function __construct(){
        parent::__construct();

        if ( !$this->session->userdata('username') ){
            $this->session->sess_destroy();
            redirect( base_url().'admin' );
        }

        $this->load->model('Robots_Model');
    }

    public function list(){
        $info = $this->Robots_Model->get_list();
        $data["data"] = [];
        foreach ($info as $key => $dato) {
            $data["data"][] = [
                $dato->id_user,
                $dato->name,
                $dato->email,
                $dato->nickname,
                '
                <a href="javascript: editar('.$dato->id_user.');" title="Editar" style="margin-right: 10px;">
                    <i class="fa fa-pencil text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                </a>
                <a href="javascript:;" onclick="eliminar(jQuery(this));" title="Eliminar" data-id="'.$dato->id_user.'" data-url="Robots" style="margin-right: 10px;">
                    <i class="fa fa-trash text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                </a>
                '
            ];
        }
        echo json_encode($data);
    }

    public function new(){
        $this->load->view('backend/templates/modal', [
            "titulo" => "Nuevo Robot",
            "accion" => "Crear",
            "data" => [],
            "plantilla" => "robots/show"
        ]);
    }

    public function edit($id){
        $data["info"] = $this->Robots_Model->get($id);
        $this->load->view('backend/templates/modal', [
            "titulo" => "Editar Robot",
            "accion" => "Actualizar",
            "data" => $data,
            "plantilla" => "robots/show"
        ]);
    }

    public function save(){
        $datos = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'nickname' => $this->input->post('nickname'),
            'robot' => 1,
            'status' => 1,
            'email_valido' => 1
        ];
        $this->Robots_Model->save($datos);
        print_r( json_encode( $this->input->post() ) );
    }

    public function update($id){
        $datos = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'nickname' => $this->input->post('nickname')
        ];
        $this->Robots_Model->update($id, $datos);
        print_r( json_encode( $this->input->post() ) );
    }

    public function delete($id){
        $this->Robots_Model->delete($id);
        print_r( json_encode( $this->input->post() ) );
    }
    

}