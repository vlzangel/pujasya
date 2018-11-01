<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fichas extends SuperController {
  
    public function __construct(){
        parent::__construct();
        applib::destroy_filters();
        if ( !$this->session->userdata('username') ){
            $this->session->sess_destroy();
            redirect( base_url().'admin' );
        }
        $this->load->helper(array('ayuda_helper'));
        $this->load->model('Fichas_Model');
    }

    public function list(){
        $anuncios = $this->Fichas_Model->get_list();
        $data["data"] = [];
        foreach ($anuncios as $key => $anuncio) {
            $data["data"][] = [
                $anuncio->id,
                "<img style='height: 50px;' src='".base_url().'files/fichas/'.$anuncio->img."' />",
                $anuncio->nombre,
                $anuncio->cantidad,
                number_format($anuncio->precio, 2, '.', ',')."€",
                $anuncio->status,
                '
                <a href="javascript: editar('.$anuncio->id.');" title="Editar" style="margin-right: 10px;">
                    <i class="fa fa-pencil text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                </a>
                <a href="javascript:;" onclick="eliminar(jQuery(this));" title="Eliminar" data-id="'.$anuncio->id.'" data-url="Fichas" style="margin-right: 10px;">
                    <i class="fa fa-trash text-danger" style="background: #01c0c8; padding: 12px; margin-top: -10px;color: white !important; border-radius: 5px;"></i>
                </a>
                '
            ];
        }
        echo json_encode($data);
    }

    public function new(){
        $this->load->view('backend/templates/modal', [
            "titulo" => "Nuevo Paquete de Fichas",
            "accion" => "Crear",
            "data" => [],
            "plantilla" => "fichas/show"
        ]);
    }

    public function edit($id){
        $data["anuncio"] = $this->Fichas_Model->getAnuncio($id)[0];
        $this->load->view('backend/templates/modal', [
            "titulo" => "Editar Paquete de Fichas",
            "accion" => "Actualizar",
            "data" => $data,
            "plantilla" => "fichas/show"
        ]);
    }

    public function save(){
        $imagen = subir_img_base64($this->input->post('img'), "fichas/", time().".png", [500, 300]);
        $datos = [
            'nombre' => $this->input->post('nombre'),
            'cantidad' => $this->input->post('fichas'),
            'precio' => $this->input->post('precio'),
            'img' => $imagen,
            'status' => $this->input->post('status')
        ];
        $this->Fichas_Model->save($datos);
        print_r( json_encode( $this->input->post() ) );
    }

    public function update($id){
        $data["anuncio"] = $this->Fichas_Model->getAnuncio($id)[0];

        $img = $this->input->post('img');
        if( strpos($img, ".jpg") === false && strpos($img, ".png") === false ){
            if( file_exists( dirname(dirname(__DIR__))."/files/fichas/".$data["anuncio"]->img ) ){
                unlink( dirname(dirname(__DIR__))."/files/fichas/".$data["anuncio"]->img );
            }
            $imagen = subir_img_base64($img, "fichas/", time().".png", [500, 300]);
        }else{
            $imagen = $img;
        }

        $datos = [
            'nombre' => $this->input->post('nombre'),
            'cantidad' => $this->input->post('fichas'),
            'precio' => $this->input->post('precio'),
            'img' => $imagen,
            'status' => $this->input->post('status')
        ];
        $this->Fichas_Model->update($id, $datos);

        print_r( json_encode( $this->input->post() ) );
    }

    public function delete($id){
        $this->Fichas_Model->delete($id);
        print_r( json_encode( $this->input->post() ) );
    }

}