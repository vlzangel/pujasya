<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pujar extends SuperController {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Anuncios_Model');
        $this->load->model('Usuarios_model');
        $this->load->model('Search_model');
    }

    public function pujar(){
        $user_id = $this->session->userdata('user_id');
        $usuario = $this->Usuarios_model->get_user($user_id);
        $fichas = $usuario->fichas;
        $this->Usuarios_model->update($user_id, [
            "fichas" => ($usuario->fichas-10)
        ]);
        $data = [
            "precio_puja" => $this->input->post('precio_puja'),
            "ult_puja_user" => $usuario->nickname,
            "ult_puja_time" => date("Y-m-d H:i:s")
        ];
        $this->Anuncios_Model->updateAnuncio($this->input->post('id_anuncio'), $data);
        $data_2 = [
            "anuncio_id" => $this->input->post('id_anuncio'),
            "user_id" => $usuario->id_user
        ];
        $this->Anuncios_Model->newPuja($data_2);
        echo json_encode([
            "user" => $usuario->nickname
        ]);
    }

    public function revisarPujas(){
        $ahora = time();
        $conditions = [ 'status' => "activa" ];
        $anuncios = $this->Search_model->get_productos($conditions, null);
        $ganadas = [];
        $actualizadas = [];
        foreach ($anuncios as $anuncio) {
            if( $anuncio["ult_puja_user"] != "" ){
                $tiempo_actual = strtotime($anuncio["ult_puja_time"]);
                if( ( $ahora - $tiempo_actual ) > $anuncio["tiempo_puja"] ){
                    $ganadas[] = $anuncio;
                    $this->pujaGanada($anuncio["id_anuncio"]);
                    $this->Anuncios_Model->updateStatus($anuncio["id_anuncio"], "ganada");
                }else{
                    $anuncio["tiempo_actual"] = $anuncio["tiempo_puja"]-( $ahora - $tiempo_actual );
                    $actualizadas[] = $anuncio;
                }
            }
        }
        echo json_encode([$ganadas, $actualizadas]);
    }

    private function pujaGanada($id_anuncio){
        $anuncio = $this->Anuncios_Model->getAnuncio( $id_anuncio )[0];
        $user = $this->Usuarios_model->get_user_nick($anuncio->ult_puja_user);
        $info["producto_precio"] = $anuncio->precio_compra;
        $info["producto_puja"] = $anuncio->precio_puja;
        $info["producto_envio"] = $anuncio->precio_envio;
        $info["metodo_pago"] = "Fichas";
        $data = [
            "user_id" => $user->id_user,
            "producto_id" => $id_anuncio,
            "operacion" => "Puja Ganada",
            "data" => json_encode($info)
        ];
        $this->Anuncios_Model->saveCompraProducto($data);
    }
}