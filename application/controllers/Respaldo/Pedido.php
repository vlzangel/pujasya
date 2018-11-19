<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido extends SuperController {
  
    public function __construct(){
        parent::__construct();
        $this->load->model('Pedidos_model');
        $this->load->model('Anuncios_model');
        $this->load->model('Fichas_Model');
        $this->load->model('Anuncios_model');
    }

    public function comprar($id){
        $data['pedido'] = $this->Pedidos_model->get($id);
        if( $data["pedido"] === false || count($data["pedido"]) == 0 ){
            applib::flash('danger','El pedido que intenta pagar no existe', 'search/grid/activa/0');
        }
        $data['pedido'] = $data['pedido'][0];
        if( $data['pedido']->status == 'Pagada' ){
            applib::flash('danger','Este pedido ya esta pagado', 'search/grid/activa/0');
        }
        $tiempo = ( time()-strtotime($data['pedido']->fecha) )/86400;
        if( $tiempo > 30 ){
            applib::flash('danger','Este pedido ya esta expirado', 'search/grid/activa/0');
        }
        $data['pedido_data'] = json_decode( $data['pedido']->data );
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Planes Empresas PREMIUM, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        switch ( $data['pedido']->tipo_producto ) {
            case 'anuncio':
                $data['title'] = 'Comprar Producto';
                $data['contenido'] = 'cuenta/comprar_producto';
                $this->load->view('frontend/templates/plantilla',$data);
            break;
        }

    }  

    function create(){
        extract($this->input->post());

        $info["cupon"]   = [];

        switch ( $this->input->post('tipo_producto') ) {
            case 'anuncio':
                $info["precio"] = $producto_precio;
                $info["puja"]   = $producto_puja;
                $info["envio"]  = $producto_envio;
                $info["pago"]   = $pago;

                $anuncio = $this->Anuncios_model->getAnuncio( $this->input->post('producto_id') )[0];
                $info["nombre"] = $anuncio->titulo;
                $info["img"] = "files/productos/".$this->input->post('producto_id')."/".$anuncio->img_principal;
            break;
            case 'fichas':
                
            break;
        }

       $data = [
            "user_id" => $user_id,
            "producto_id" => $producto_id,
            "tipo_producto" => $tipo_producto,
            "operacion" => $operacion,
            "data" => json_encode($info),
            "status" => $status
        ];

        $this->Pedidos_model->create($data);
        $compra = $this->Pedidos_model->all( [ "user_id" => $this->session->userdata('user_id') ] )[0];
        echo json_encode(["pedido_id" => $compra->id]);
    }

    function update(){
        extract($this->input->post());

        $pedido = $this->Pedidos_model->get( $pedido_id )[0];
        $info = json_decode( $pedido->data );

        $info->metodo_pago = $metodo_pago;

        switch ( $pedido->tipo_producto ) {
            case 'anuncio':

            break;
            case 'fichas':
                $anuncio = $this->Fichas_Model->getAnuncio( $producto_id )[0];
                $info->nombre = $anuncio->nombre;
                $info->img = "files/fichas/".$anuncio->img;
                $info->precio = $anuncio->precio;
                $info->fichas = $anuncio->cantidad;
                $info->cupon = $cupon;
                if( is_array($cupon) ){
                    $info->pago = $anuncio->precio-$cupon[3];
                }else{
                    $info->pago = $anuncio->precio;
                }
            break;
        }

        $data["data"] = json_encode($info);

        $this->Pedidos_model->update($pedido_id, $data);
        echo json_encode(["pedido_id" => $pedido_id]);
    }
}