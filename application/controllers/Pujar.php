<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pujar extends SuperController {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Anuncios_Model');
        $this->load->model('Usuarios_model');
        $this->load->model('Search_model');
        $this->load->model('Pujar_model');
    }

    public function pujar(){
        $user_id = $this->session->userdata('user_id');
        $usuario = $this->Usuarios_model->get_user($user_id);
        
        $mipuja = $this->Pujar_model->get_pujas_by_user_anuncio($user_id, $this->input->post('id_anuncio'));
        $data_puja = [];
        if( $mipuja == false ){
            $data_puja["anuncio_id"] = $this->input->post('id_anuncio');
            $data_puja["user_id"] = $usuario->id_user;
            $data_puja["status"] = "activa";
            $data_puja["ult_puja"] = $this->input->post('precio_puja');
            $this->Pujar_model->savePuja($data_puja);
        }else{
            $data_puja["ult_puja"] = $this->input->post('precio_puja');
            $this->Pujar_model->updatePuja($mipuja[0]->id, $data_puja);
        }

        $fichas = $usuario->fichas;
        $this->Usuarios_model->update($user_id, [
            "fichas" => ($usuario->fichas-10)
        ]);
        $data = [
            "precio_puja" => $this->input->post('precio_puja'),
            "ult_puja_user" => $usuario->nickname,
            "ult_puja_time" => date("Y-m-d H:i:s")
        ];
        $anuncio = $this->Anuncios_Model->getAnuncio($this->input->post('id_anuncio'))[0];
        $this->Anuncios_Model->updateAnuncio($this->input->post('id_anuncio'), $data);
        $data_2 = [
            "anuncio_id" => $this->input->post('id_anuncio'),
            "user_id" => $usuario->id_user,
            "monto" => $this->input->post('precio_puja'),
            "reventa" => $anuncio->reventa
        ];
        $this->Anuncios_Model->newPuja($data_2);
        echo json_encode([
            "user" => $usuario->nickname,
            "data_puja" => $data_puja,
            "updateAnuncio" => $data
        ]);

        $this->Pujar_model->updatePuja_by_anuncio(
             $this->input->post('id_anuncio'), [
            "precio_actual" => $this->input->post('precio_puja')
        ]);
    }

    public function revisarPujas(){
        $ahora = time();
        $anuncios = $this->Search_model->get_revision();
        $ganadas = [];
        $actualizadas = [];
        foreach ($anuncios as $anuncio) {
            if( $this->input->post('historial') != 0 ){

                if( $anuncio["id_anuncio"] == $this->input->post('historial') ){
                    $anuncio["historial"] = $this->get_historial($anuncio["id_anuncio"], $anuncio["reventa"]);
                    if( $anuncio["status"] == "activa" ){
                        if( $anuncio["ult_puja_user"] != "" ){
                            $tiempo_actual = strtotime($anuncio["ult_puja_time"]);
                            $anuncio["tiempo_actual"] = $anuncio["tiempo_puja"]-( $ahora - $tiempo_actual );
                            $actualizadas[] = $anuncio;
                        }
                    }else{
                        $ganadas[] = $anuncio;
                    }
                }
                
            }else{
                if( $anuncio["status"] == "activa" ){
                    if( $anuncio["ult_puja_user"] != "" ){
                        $tiempo_actual = strtotime($anuncio["ult_puja_time"]);
                        $anuncio["tiempo_actual"] = $anuncio["tiempo_puja"]-( $ahora - $tiempo_actual );
                        $actualizadas[] = $anuncio;
                    }
                }else{
                    $ganadas[] = $anuncio;
                }
            }
        }
        echo json_encode([$ganadas, $actualizadas]);
    }

    private function get_historial($id_anuncio, $reventa){
        $historial_str = '';
        $historial = $this->Anuncios_Model->getHistorial($id_anuncio, $reventa);
        if( count($historial) > 0 ){
            foreach ($historial as $key => $value) {
                $historial_str .= '
                <div class="row fila rsinmlf">
                    <div class="col-md-7 col-xs-7">
                        <h5 class="text-left">'.$value->nombre.'</h5>
                    </div>
                    <div class="col-md-5 col-xs-5">
                        <h5 class=" text-right">'.$value->monto.'</h5>
                    </div>
                </div>
                ';
            }
        }
        return $historial_str;
    }

    public function cronPujas(){
        $anuncios_pujados = $this->run_autopujas();
        $ahora = time();
        $conditions = [ 'status' => "activa" ];
        $anuncios = $this->Search_model->get_productos($conditions, null);
        $ganadas = [];
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
                }
            }
        }
        $actualizadas = $this->robots( $actualizadas_ids, $anuncios_pujados );
        //echo json_encode([$ganadas, $actualizadas, $anuncios_pujados]);
        echo json_encode(["cron" => true]);
    }

    private function robots($actualizadas_ids, $anuncios_pujados){
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
                                if( !in_array($anuncio["id_anuncio"], $anuncios_pujados)){
                                    if( $anuncio["ultimo_robot"] == $anuncio["robot_id_2"] || $anuncio["ultimo_robot"] == 0 ){
                                        $this->pujar_robot($anuncio["id_anuncio"], $anuncio["robot_id"], $actualizadas_ids[ $anuncio["id_anuncio"] ], $anuncio["cantidad_fichas"]);
                                    }else{
                                        $this->pujar_robot($anuncio["id_anuncio"], $anuncio["robot_id_2"], $actualizadas_ids[ $anuncio["id_anuncio"] ], $anuncio["cantidad_fichas"]);
                                    }
                                }
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
        $this->Pujar_model->updateAutopujas($id_anuncio, ["status" => "terminada" ]);
        $info["producto_precio"] = $anuncio->precio_compra;
        $info["producto_puja"] = $anuncio->precio_puja;
        $info["producto_envio"] = $anuncio->precio_envio;
        $data = [
            "user_id" => $user->id_user,
            "producto_id" => $id_anuncio,
            "operacion" => "Puja Ganada",
            "data" => json_encode($info),
            "status" => "Pendiente"
        ];
        $this->Anuncios_Model->saveCompraProducto($data);

        $this->Pujar_model->updatePuja_by_user_anuncio(
            $user->id_user,
            $id_anuncio, [
            "status" => "ganada"
        ]);

        $this->Pujar_model->updatePuja_by_anuncio(
            $id_anuncio, [
            "status" => "culminada"
        ]);
    }

    private function pujar_robot($id_anuncio, $id_robot, $precio_puja, $cantidad_fichas, $is_robot = true){
        $user_id = $id_robot;
        $usuario = $this->Usuarios_model->get_user($user_id);
        $data = [
            "precio_puja" => $precio_puja+0.01,
            "ult_puja_user" => $usuario->nickname,
            "ult_puja_time" => date("Y-m-d H:i:s")
        ];
        if( $is_robot ){
            $data["ultimo_robot"] = $id_robot;
        }else{
            $this->Usuarios_model->update($user_id, [
                "fichas" => ($usuario->fichas-$cantidad_fichas)
            ]);
        }
        $anuncio = $this->Anuncios_Model->getAnuncio( $id_anuncio )[0];
        $this->Anuncios_Model->updateAnuncio($id_anuncio, $data);
        $data_2 = [
            "anuncio_id" => $id_anuncio,
            "user_id" => $usuario->id_user,
            "monto" => $precio_puja+0.01,
            "reventa" => $anuncio->reventa
        ];
        $this->Anuncios_Model->newPuja($data_2);
        $this->Pujar_model->updatePuja_by_anuncio(
            $id_anuncio, [
            "precio_actual" => $precio_puja+0.01
        ]);
    }


    private function run_autopujas(){
        $anuncios_pujados = [];
        $autopujas = $this->Pujar_model->get_all_autopujas();
        $ahora = time();
        foreach ($autopujas as $key => $autopuja) {
            if( !in_array($autopuja->id_anuncio, $anuncios_pujados)){
                $tiempo_actual = strtotime($autopuja->ult_puja_time);
                $faltan = $autopuja->tiempo_puja-( $ahora - $tiempo_actual );
                $usuario = $this->Usuarios_model->get_user($autopuja->user_id);
                if( $faltan <= $autopuja->pujar_cada ){
                    if( $autopuja->ult_puja_user != $usuario->nickname && $autopuja->ult_puja_user != "" ){
                        if( $autopuja->max_monto > $autopuja->precio_puja ){
                            if( $autopuja->max_fichas > $autopuja->fichas_usadas ){
                                if( $usuario->fichas > $autopuja->cantidad_fichas ){
                                    $this->pujar_robot($autopuja->id_anuncio, $autopuja->user_id, $autopuja->precio_puja, $autopuja->cantidad_fichas, false);
                                    $this->Pujar_model->updateAutopujas($autopuja->id, ["fichas_usadas" => $autopuja->fichas_usadas+$autopuja->cantidad_fichas ]);
                                    $anuncios_pujados[] = $autopuja->id_anuncio;


                                    $mipuja = $this->Pujar_model->get_pujas_by_user_anuncio($autopuja->user_id, $autopuja->id_anuncio);
                                    $data_puja = [];
                                    if( $mipuja == false ){
                                        $data_puja["anuncio_id"] = $autopuja->id_anuncio;
                                        $data_puja["user_id"] = $autopuja->user_id;
                                        $data_puja["status"] = "activa";
                                        $data_puja["ult_puja"] = $this->input->post('precio_puja');
                                        $this->Pujar_model->savePuja($data_puja);
                                    }else{
                                        $data_puja["ult_puja"] = $this->input->post('precio_puja');
                                        $this->Pujar_model->updatePuja($mipuja[0]->id, $data_puja);
                                    }
                                    
                                }else{
                                    $this->Pujar_model->updateAutopujas($autopuja->id, ["status" => "terminada" ]);
                                }
                            }else{
                                $this->Pujar_model->updateAutopujas($autopuja->id, ["status" => "terminada" ]);
                            }
                        }else{
                            $this->Pujar_model->updateAutopujas($autopuja->id, ["status" => "terminada" ]);
                        }
                    }
                }
            }
        }
        return $anuncios_pujados;
    }

    public function saveAutopujas(){
        $pujar_cada = ( $this->input->post('estrategia') == "ult_10" ) ? 10: mt_rand(3, 9);
        $data = [
            "user_id" => $this->session->userdata('user_id'),
            "anuncio_id" => $this->input->post('anuncio_id'),
            "max_fichas" => $this->input->post('max_fichas'),
            "max_monto" => $this->input->post('max_monto'),
            "pujar_cada" => $pujar_cada,
        ];
        $this->Pujar_model->saveAutopujas($data);
        applib::flash('success','Autopuja guardada exitosamente!', 'cuenta/misautopujas');
    }
}