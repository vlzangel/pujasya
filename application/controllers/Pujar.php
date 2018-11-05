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
        // $actualizadas = [];
        $actualizadas_ids = [];
        foreach ($anuncios as $anuncio) {
            if( $anuncio["ult_puja_user"] != "" ){
                $tiempo_actual = strtotime($anuncio["ult_puja_time"]);
                if( ( $ahora - $tiempo_actual ) > $anuncio["tiempo_puja"] ){
                    $ganadas[] = $anuncio;
                    $this->pujaGanada($anuncio["id_anuncio"]);
                    $this->Anuncios_Model->updateStatus($anuncio["id_anuncio"], "ganada");
                }else{
                    $actualizadas_ids[ $anuncio["id_anuncio"] ] = $anuncio["precio_puja"];
                    // $actualizadas[] = $anuncio;
                }
            }
        }

        $actualizadas = $this->robots( $actualizadas_ids );

        echo json_encode([$ganadas, $actualizadas]);
    }

    private function robots($actualizadas_ids){
        if( count($actualizadas_ids) > 0){
            $ahora = time();
            $conditions = [ 'status' => "activa" ];
            $anuncios = $this->Search_model->get_productos($conditions, null);
            $actualizadas = [];
            foreach ($anuncios as $anuncio) {
                if( array_key_exists($anuncio["id_anuncio"], $actualizadas_ids ) ){
                    $tiempo_actual = strtotime($anuncio["ult_puja_time"]);

                    $faltan = $anuncio["tiempo_puja"]-( $ahora - $tiempo_actual );

                    if( $anuncio["robot_status"] == 1 ){
                        if( $faltan <= $anuncio["robot_seg"] ){
                            if( $anuncio["robot_monto_maximo"] > $actualizadas_ids[ $anuncio["id_anuncio"] ] ){
                                $this->pujar_robot($anuncio["id_anuncio"], $anuncio["robot_id"], $actualizadas_ids[ $anuncio["id_anuncio"] ]);
                                $_temp_anuncio = (array) $this->Anuncios_Model->getAnuncio( $anuncio["id_anuncio"] )[0];
                                $_temp_anuncio["tiempo_actual"] = $anuncio["tiempo_puja"]-( $ahora - $tiempo_actual );
                                $_temp_anuncio["donde"] = "Tiempo minimo alcanzado: ".$faltan." <= ".$anuncio["robot_seg"];
                                $actualizadas[] = $_temp_anuncio;
                            }else{
                                $anuncio["tiempo_actual"] = $faltan;
                                $anuncio["donde"] = "Supero el monto maximo";
                                $actualizadas[] = $anuncio;
                            }
                        }else{
                            $anuncio["tiempo_actual"] = $faltan;
                            $anuncio["donde"] = "Tiempo minimo NO alcanzado: ".$faltan." <= ".$anuncio["robot_seg"];
                            $actualizadas[] = $anuncio;
                        }
                    }else{
                        $anuncio["tiempo_actual"] = $faltan;
                        $anuncio["donde"] = "Sin robot";
                        $actualizadas[] = $anuncio;
                    }
                }
            }
            return $actualizadas;
        }else{
            return [];
        }
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

    private function pujar_robot($id_anuncio, $id_robot, $precio_puja){
        $user_id = $id_robot;
        $usuario = $this->Usuarios_model->get_user($user_id);
        $data = [
            "precio_puja" => $precio_puja+0.01,
            "ult_puja_user" => $usuario->nickname,
            "ult_puja_time" => date("Y-m-d H:i:s")
        ];
        $this->Anuncios_Model->updateAnuncio($id_anuncio, $data);
        $data_2 = [
            "anuncio_id" => $id_anuncio,
            "user_id" => $usuario->id_user
        ];
        $this->Anuncios_Model->newPuja($data_2);
    }
}