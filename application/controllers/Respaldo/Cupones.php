<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cupones extends SuperController {
  
    public function __construct(){
        parent::__construct();

        if ( !$this->session->userdata('username') ){
            $this->session->sess_destroy();
            redirect( base_url().'admin' );
        }

        $this->load->model('Cupones_Model');
    }

    public function list(){
        $info = $this->Cupones_Model->get_list();
        $data["data"] = [];
        foreach ($info as $key => $dato) {
            $data["data"][] = [
                $dato->id,
                $dato->nombre,
                $dato->porcentaje."%",
                $dato->finaliza,
                '
                <a href="javascript: editar('.$dato->id.');" title="Editar" style="margin-right: 10px;">
                    <i class="fa fa-pencil text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                </a>
                <a href="javascript:;" onclick="eliminar(jQuery(this));" title="Eliminar" data-id="'.$dato->id.'" data-url="Cupones" style="margin-right: 10px;">
                    <i class="fa fa-trash text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                </a>
                '
            ];
        }
        echo json_encode($data);
    }

    public function new(){
        $this->load->view('backend/templates/modal', [
            "titulo" => "Nuevo Cupón",
            "accion" => "Crear",
            "data" => [],
            "plantilla" => "cupones/show"
        ]);
    }

    public function edit($id){
        $data["info"] = $this->Cupones_Model->get($id);
        $this->load->view('backend/templates/modal', [
            "titulo" => "Editar Cupón",
            "accion" => "Actualizar",
            "data" => $data,
            "plantilla" => "cupones/show"
        ]);
    }

    public function save(){
        $datos = [
            'nombre' => $this->input->post('nombre'),
            'porcentaje' => $this->input->post('porcentaje'),
            'finaliza' => $this->input->post('finaliza')
        ];
        $this->Cupones_Model->save($datos);
        print_r( json_encode( $this->input->post() ) );
    }

    public function update($id){
        $datos = [
            'nombre' => $this->input->post('nombre'),
            'porcentaje' => $this->input->post('porcentaje'),
            'finaliza' => $this->input->post('finaliza')
        ];
        $this->Cupones_Model->update($id, $datos);
        print_r( json_encode( $this->input->post() ) );
    }

    public function delete($id){
        $this->Cupones_Model->delete($id);
        print_r( json_encode( $this->input->post() ) );
    }
    

}