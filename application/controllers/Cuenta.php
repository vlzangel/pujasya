<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        applib::logued_in_user(FALSE);
        $this->load->model('Fichas_Model');
        $this->load->model('Cupones_Model');
        $this->load->model('Anuncios_model');
        $this->load->model('Cuenta_model');
        $this->load->model('Search_model');
        $this->load->model('Pujar_model');
    }

    function init_pedido(){
        $paquete = $this->Fichas_Model->getAnuncio( $this->input->post('paquete_id') )[0];
        $info["paquete_id"] = $this->input->post('paquete_id');
        $info["paquete_name"] = $paquete->nombre;
        $info["paquete_precio"] = $paquete->precio;
        $info["paquete_fichas"] = $paquete->cantidad;
        $info["cupon"] = $this->input->post('cupon');
        $info["metodo_pago"] = $this->input->post('paquete_metodo_pago');
        $data = [
            "user" => $this->input->post('user_id'),
            "data" => json_encode($info)
        ];
        if( $this->input->post('pedido_id') == "" ){
            $pedido_id = $this->Fichas_Model->saveCompra($data, $paquete->cantidad);
        }else{
            $this->Fichas_Model->update_pedido($this->input->post('pedido_id'), $data);
            $pedido_id = $this->input->post('pedido_id');
        }
        echo json_encode(["error" => "", "pedido_id" => $pedido_id]);
    }

    function update_pedido_fichas($pedido_id){
        $pedido = $this->Fichas_Model->get_pedido( $pedido_id )[0];
        $info["metodo_pago"] = $this->input->post('paquete_metodo_pago');
        $data = [
            "data" => json_encode($info)
        ];
        $this->Fichas_Model->update_pedido($pedido_id, $data);
        echo json_encode(["error" => ""]);
    }

    function procesarCompraFicha(){
        $paquete = $this->Fichas_Model->getAnuncio( $this->input->post('paquete_id') )[0];
        $info["paquete_id"] = $this->input->post('paquete_id');
        $info["paquete_name"] = $paquete->nombre;
        $info["paquete_precio"] = $paquete->precio;
        $info["paquete_fichas"] = $paquete->cantidad;
        $info["metodo_pago"] = $this->input->post('paquete_metodo_pago');
        $info["cupon"] = $this->input->post('cupon');
        $data = [
            "user" => $this->input->post('user_id'),
            "data" => json_encode($info)
        ];
        $this->Fichas_Model->saveCompra($data, $paquete->cantidad);
        echo json_encode(["error" => ""]);
    }

    function procesarCompraProducto(){
        $producto_id = $this->input->post('producto_id');
        $info["producto_precio"] = $this->input->post('producto_precio');
        $info["producto_puja"] = $this->input->post('producto_puja');
        $info["producto_envio"] = $this->input->post('producto_envio');
        $info["pago"] = $this->input->post('pago');
        $info["metodo_pago"] = $this->input->post('paquete_metodo_pago');
        $data = [
            "user_id" => $this->input->post('user_id'),
            "producto_id" => $producto_id,
            "operacion" => $this->input->post('operacion'),
            "data" => json_encode($info),
            "status" => "Pendiente"
        ];
        $this->Anuncios_model->saveCompraProducto($data);
        // $this->Anuncios_model->updateStatus($producto_id, "comprada");
        $compra = $this->Cuenta_model->get_mis_compras( $this->session->userdata('user_id') )[0];
        echo json_encode(["pedido_id" => $compra->id]);
    }

    public function apply_coupon($cupon_name, $total){
        $cupon = $this->Cupones_Model->get_cupon_name($cupon_name);
        if( $cupon !== false && $cupon !== null ){
            if( strtotime($cupon->finaliza) < time() ){
                $r = [
                    "error" => "El cupón ha expirado",
                    "cupo" => $cupon
                ];
            }else{
                $descuento = ($cupon->porcentaje*$total)/100;
                $r = [
                    "error" => "",
                    "descuento" => [
                        $cupon->id, 
                        $cupon->nombre, 
                        $cupon->porcentaje, 
                        $descuento 
                    ]
                ];
            }
        }else{
            $r = ["error" => "Cupón invalido"];
        }
        echo json_encode($r);
    }

    public function comprarfichas(){
        $data["prepago"]['pedido_id'] = $this->session->userdata('pedido_id');
        $data["prepago"]['paquete_id'] = $this->session->userdata('paquete_id');
        $data["prepago"]['metodo'] = $this->session->userdata('metodo');
        $data["prepago"]['status_pago'] = $this->session->userdata('status_pago');
        $data["prepago"]['cupon'] = $this->session->userdata('cupon');
        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $data['paquetes'] = $this->Fichas_Model->get_list("Activo");
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Planes Empresas PREMIUM, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Comprar Fichas';
        $data['contenido'] = 'cuenta/comprar_fichas';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function comprarproducto($id){   

        $data["prepago"]['pedido_id'] = $this->session->userdata('pedido_id');
        $data["prepago"]['producto_id'] = $this->session->userdata('producto_id');
        $data["prepago"]['metodo'] = $this->session->userdata('metodo');
        $data["prepago"]['status_pago'] = $this->session->userdata('status_pago');

        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $data['compras'] = $this->Cuenta_model->get_mis_compras( $this->session->userdata('user_id') );
        $data['p'] = $this->Anuncios_model->getAnuncio($id)[0];
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Planes Empresas PREMIUM, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Comprar Producto';
        $data['contenido'] = 'cuenta/comprar_producto';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function miscompras(){
        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $data['anuncios'] = $this->Cuenta_model->get_mis_compras( $this->session->userdata('user_id') );
        $data['title'] = 'Mis Compras';
        $data['contenido'] = 'cuenta/miscompras';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function favoritos(){
        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $this->load->model('Favoritos_model');
        $data['anuncios'] = $this->Favoritos_model->get_all( $this->session->userdata('user_id') );
        $data['title'] = 'Mis Favoritos';
        $data['contenido'] = 'cuenta/favoritos';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function borrar_anuncio_favoritos($anuncio_id){
        if( $anuncio_id != "" ){
            $check = applib::check_favorito($anuncio_id);
            if($check == true){
                applib::delete(applib::$favoritos_table,array('anuncio_id' => $anuncio_id,'user_id' => $this->session->userdata('user_id')));
                applib::flash('success','Se ha borrado el anuncio exitosamente!', 'cuenta/favoritos/');
                exit;
            } else {
                applib::flash('danger','Ha ocurrido un error en el proceso - '.$anuncio_id, 'cuenta/favoritos/');
                exit;
            }
        }else{
            redirect(base_url('cuenta'));
            exit;
        }
    }

    public function misautopujas(){
        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $condition = array('a.status !=' => 2, 'f.user_id' => $this->session->userdata('user_id'));

        $this->load->model('favoritos_model');

        $data['autopujas'] = $this->Pujar_model->get_all_autopujas_by_user( $this->session->userdata('user_id') );

        $data['anuncios'] = $this->Search_model->get_productos([ 'status' => "activa" ], null);

        $data['title'] = 'Mis AutoPujas';
        $data['contenido'] = 'cuenta/misautopujas';
        $this->load->view('frontend/templates/plantilla',$data);
    }




























    function index(){
    	redirect(base_url('cuenta/publicar'));
    }

    function publicar()
    {
        $string = htmlentities("<a href='test'>Test</a>", ENT_QUOTES, 'ISO-8859-15'); 
        echo $string; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;
        die;
        if(applib::check_fulldata() == false)
        {
            applib::flash('danger','Debes completar tu perfil para poder Pujar!','perfil');
            exit;
        }

        $this->load->library('form_validation');

        if(applib::poder_publicar() == false)
        {
            $mensaje = '¡Agotaste el máximo de Avisos! Contactanos';
            $mensaje .= ($this->session->userdata('premium') == 0)?' para hacerte PREMIUM.':'';

            //Enviar email de limite agotado

            $this->load->library('mailer');

            $data_email = array(
                'email'     => $this->session->userdata('email'),
                'username'  => $this->session->userdata('name'),
                'limite'    => $this->session->userdata('premium') == 0?$this->session->userdata('paquete_normal'):$this->session->userdata('paquete')
            );

            mailer::limite_agotado($data_email);

            applib::flash('danger',$mensaje,'cuenta/mis_anuncios');
            exit;
        }

        if($this->input->post())
        {
            $this->form_validation->set_rules('categoria_id', 'Categoría', 'required|trim|numeric');
            $this->form_validation->set_rules('subcategoria_id', 'Subcategoría', 'required|trim|numeric');
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim');
            $this->form_validation->set_rules('descripcion', 'Descripción', 'required|trim');
            $this->form_validation->set_rules('moneda', 'Moneda', 'required|numeric');
            $this->form_validation->set_rules('costo', 'Precio', 'trim');
            
            if($this->form_validation->run())
            {
                $nameImg = array();

                $c = 0;

                //Validate and upload image

                

                for ($i=0; $i < 4; $i++) 
                {
                    $photos = 'img_'.$i; 

                    if(!empty($_FILES[$photos]['name']))
                    {
                        $config['upload_path'] = './public/uploads/anuncios/temp';
                        $config['allowed_types'] = 'jpg|jpeg';
                        $config['overwrite'] = FALSE;
                        $config['encrypt_name'] = true;
                        $config['max_size'] = '4500';
                        $config['max_width'] = '6000';
                        $config['max_height'] = '6000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload($photos)) 
                        {
                            applib::flash('danger',$this->upload->display_errors(),'cuenta/publicar');
                            exit;
                        }
                        else
                        {
                            $ima = $this->upload->data();
                            $image_name = $ima["file_name"];
                            $nameImg[$c] = $image_name;
                        }

                        $c++;
                    }
                }

                $imagenes = count($nameImg);

                if($imagenes == 0)
                {
                    applib::flash('danger','Debes añadir al menos una imágen','cuenta/publicar');
                    exit;
                }

                //REDIMENSIONAR

                $this->load->library('image_lib');

                for ($i=0; $i < $imagenes; $i++) 
                { 
                    //RESIZE 250 x 200

                    $imagen = $nameImg[$i];

                    $config2['image_library']   = 'gd2';
                    $config2['source_image']    = './public/uploads/anuncios/temp/'.$imagen;
                    $config2['new_image']       = './public/uploads/anuncios/thumb/'; // las nuevas imágenes se guardan en la carpeta "thumbs"
                    $config2['maintain_ratio']  = TRUE;
                    $config2['width']           = 255;
                    $config2['height']          = 255;

                    $this->image_lib->initialize($config2);

                    if(!$this->image_lib->resize())
                    {
                        applib::flash('danger',$this->image_lib->display_errors(),'cuenta/publicar');
                        exit;
                    }

                    $this->image_lib->clear();

                    //RESIZE 700 x 700

                    $config3['image_library']   = 'gd2';
                    $config3['source_image']    = './public/uploads/anuncios/temp/'.$imagen;
                    $config3['new_image']       = './public/uploads/anuncios/'; // las nuevas imágenes se guardan en la carpeta "thumbs"
                    $config3['maintain_ratio']  = TRUE;
                    $config3['width']           = 750;
                    $config3['height']          = 750;

                    $this->image_lib->initialize($config3);

                    if (!$this->image_lib->resize())
                    {
                        applib::flash('danger',$this->image_lib->display_errors(),'cuenta/publicar');
                        exit;
                    }

                    $this->image_lib->clear();

                    unlink('./public/uploads/anuncios/temp/'.$imagen);
                }


                $cat = $this->input->post('categoria_id',true);

                //GENERAR SEO DEL ANUNCIO

                $this->load->helper('text');

                $seo = url_title(convert_accented_characters($this->input->post('titulo',true)),'-',TRUE);

                $check = applib::get_table_field(applib::$anuncios_table,array('seo' => $seo,'status !=' => 2),'seo');

                if($check != "")
                {
                    $seo = $seo.'-'.rand(10,10000);
                }

                //OBTENER FECHA DE FINAL

                $nuevafecha = strtotime ( '+'.DURACION.' day' , strtotime ( applib::fecha() ) ) ;

                $last_date = date ( 'Y-m-d H:i:s' , $nuevafecha );

                $data_in = array(
                    'categoria_id'      => $cat,
                    'subcategoria_id'   => $this->input->post('subcategoria_id',true),
                    'titulo'            => $this->input->post('titulo',true),
                    'descripcion'       => $this->input->post('descripcion'),
                    'moneda'            => $this->input->post('moneda',true),
                    'costo'             => $this->input->post('costo',true),
                    'date'              => applib::fecha(),
                    'fecha_fin'         => $last_date,
                    'user_id'           => $this->session->userdata('user_id'),
                    'seo'               => $seo,
                    'status'            => 1     
                ); 

                //GUARDADO PARA CATEGORIA VEHICULOS

                if($cat == 1) 
                {
                    $data_in['marca_id']    = $this->input->post('marca_id',true);
                    $data_in['version']     = $this->input->post('version',true);
                    $data_in['year']        = $this->input->post('year',true);
                    $data_in['combustible'] = $this->input->post('combustible',true);
                    $data_in['kilometraje'] = $this->input->post('kilometraje',true);
                }

                //GUARDADO PARA CATEGORIA PROPIEDADES

                if($cat == 3) 
                {
                    $data_in['tipo_operacion']      = $this->input->post('tipo_operacion',true);
                    $data_in['provincia_id']        = $this->input->post('provincia_id',true);
                    $data_in['poblacion_id']        = $this->input->post('poblacion_id',true);
                    $data_in['direccion']           = $this->input->post('direccion',true);
                }

                $this->load->model('anuncios_model');

                $save = $this->anuncios_model->save($data_in,$nameImg);

                if($save)
                {
                    applib::restar_anuncio();

                    applib::flash('success','Su anuncio se ha creado con exito, en breve sera aprobado','cuenta/mis_anuncios');
                    exit;
                }
                else
                {
                    applib::flash('danger','Ha ocurrido un error durante el proceso','cuenta/publicar');
                    exit;
                }
            }
        }

        $data['provincias'] = applib::get_all('*',applib::$provincias_table,array());

        $data['categorias'] = applib::get_all('*',applib::$cat_table,array('status !=' => 2));

        $data['title'] = 'Públicar anuncio';
        $data['contenido'] = 'cuenta/publicar';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function mis_anuncios()
    {

        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $condition = array('a.status !=' => 2,'a.user_id' => $this->session->userdata('user_id'));

        $data['anuncios'] = $this->anuncios_model->get_all($condition);

        $data['title'] = 'Mis anuncios púbicados';
        $data['contenido'] = 'cuenta/mis_anuncios';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function editar_anuncio($id)
    {
        if(!$id)
        {
            redirect(base_url('cuenta'));
            exit;
        }

        if(applib::check_fulldata() == false)
        {
            applib::flash('danger','Debes completar tu perfil para poder editar tus anuncios!','perfil');
            exit;
        }

        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );

        $condition = array('id_anuncio' => $id,'user_id' => $this->session->userdata('user_id'),'status !=' => 2);

        $data['anuncio'] = applib::get_table_field(applib::$anuncios_table,$condition,'*');

        if($data['anuncio'] == "")
        {
            redirect(base_url('cuenta'));
            exit;
        }

         $this->load->library('form_validation');

        if($this->input->post())
        {
            $this->form_validation->set_rules('subcategoria_id', 'Subcategoría', 'required|trim|numeric');
            $this->form_validation->set_rules('titulo', 'Título', 'required|trim');
            $this->form_validation->set_rules('descripcion', 'Descripción', 'required|trim');
            $this->form_validation->set_rules('moneda', 'Moneda', 'required|numeric');
            $this->form_validation->set_rules('costo', 'Precio', 'trim');
            
            if($this->form_validation->run())
            {
                $nameImg = array();

                $c = 0;

                //Validate and upload image

                for ($i=0; $i < 4; $i++) 
                {
                    $photos = 'img_'.$i; 

                    if(!empty($_FILES[$photos]['name']))
                    {
                        $config['upload_path'] = './public/uploads/anuncios/temp';
                        $config['allowed_types'] = 'jpg|jpeg';
                        $config['overwrite'] = FALSE;
                        $config['encrypt_name'] = true;
                        $config['max_size'] = '4500';
                        $config['max_width'] = '6000';
                        $config['max_height'] = '6000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload($photos)) 
                        {
                            applib::flash('danger',$this->upload->display_errors(),'cuenta/editar_anuncio/'.$id);
                            exit;
                        }
                        else
                        {
                            $ima = $this->upload->data();
                            $image_name = $ima["file_name"];
                            $nameImg[$c] = $image_name;
                        }

                        $c++;
                    }
                }

                $imagenes = count($nameImg);

                if($imagenes > 0)
                {
                    //REDIMENSIONAR

                    $this->load->library('image_lib');

                    for ($i=0; $i < $imagenes; $i++) 
                    { 
                        //RESIZE 250 x 200

                        $imagen = $nameImg[$i];

                        $config2['image_library']   = 'gd2';
                        $config2['source_image']    = './public/uploads/anuncios/temp/'.$imagen;
                        $config2['new_image']       = './public/uploads/anuncios/thumb/'; // las nuevas imágenes se guardan en la carpeta "thumbs"
                        $config2['maintain_ratio']  = TRUE;
                        $config2['width']           = 250;
                        $config2['height']          = 250;

                        $this->image_lib->initialize($config2);

                        if(!$this->image_lib->resize())
                        {
                            applib::flash('danger',$this->image_lib->display_errors(),'cuenta/editar_anuncio/'.$id);
                            exit;
                        }

                        $this->image_lib->clear();

                        //RESIZE 700 x 700

                        $config3['image_library']   = 'gd2';
                        $config3['source_image']    = './public/uploads/anuncios/temp/'.$imagen;
                        $config3['new_image']       = './public/uploads/anuncios/'; // las nuevas imágenes se guardan en la carpeta "thumbs"
                        $config3['maintain_ratio']  = TRUE;
                        $config3['width']           = 700;
                        $config3['height']          = 700;

                        $this->image_lib->initialize($config3);

                        if (!$this->image_lib->resize())
                        {
                            applib::flash('danger',$this->image_lib->display_errors(),'cuenta/editar_anuncio/'.$id);
                            exit;
                        }

                        $this->image_lib->clear();

                        unlink('./public/uploads/anuncios/temp/'.$imagen);
                    }
                }

                $cat = $data['anuncio']['categoria_id'];

                //GENERAR SEO DEL ANUNCIO

                $this->load->helper('text');

                // $seo = url_title(convert_accented_characters($this->input->post('titulo',true)),'-',TRUE);

                // $check = applib::get_table_field(applib::$anuncios_table,array('seo' => $seo,'status !=' => 2),'id_anuncio');

                // if($check != "" AND $check['id_anuncio'] != $id)
                // {
                //     $seo = $seo.'-'.rand(10,10000);
                // }

                $data_in = array(
                    'subcategoria_id'   => $this->input->post('subcategoria_id',true),
                    'titulo'            => $this->input->post('titulo',true),
                    'descripcion'       => $this->input->post('descripcion'),
                    'moneda'            => $this->input->post('moneda',true),
                    'costo'             => $this->input->post('costo',true),
                    //'seo'               => $seo
                ); 

                //GUARDADO PARA CATEGORIA VEHICULOS

                if($cat == 1) 
                {
                    $data_in['marca_id']    = $this->input->post('marca_id',true);
                    $data_in['version']     = $this->input->post('version',true);
                    $data_in['year']        = $this->input->post('year',true);
                    $data_in['combustible'] = $this->input->post('combustible',true);
                    $data_in['kilometraje'] = $this->input->post('kilometraje',true);
                }

                //GUARDADO PARA CATEGORIA PROPIEDADES

                if($cat == 3) 
                {
                    $data_in['tipo_operacion']      = $this->input->post('tipo_operacion',true);
                    $data_in['provincia_id']        = $this->input->post('provincia_id',true);
                    $data_in['poblacion_id']        = $this->input->post('poblacion_id',true);
                    $data_in['direccion']           = $this->input->post('direccion',true);
                }

                if(isset($_POST['delete']))
                {
                    $delete = $_POST['delete'];

                    $contar = count($delete);

                    for ($i=0; $i < $contar; $i++) 
                    { 
                        applib::delete(applib::$img_table,array('id_imagen' => $delete[$i]));
                    }   
                }

                $this->load->model('anuncios_model');

                $save = $this->anuncios_model->edit($data_in,$nameImg,$id);

                if($save)
                {
                    applib::flash('success','El anuncio se ha editado con exito!','cuenta/mis_anuncios/');
                    exit;
                }
                else
                {
                    applib::flash('danger','Ha ocurrido un error durante el proceso','cuenta/editar_anuncio/'.$id);
                    exit;
                }
            }
        }

        if($data['anuncio']['categoria_id'] == 1)
        {
            $data['marcas'] = applib::get_marcas($data['anuncio']['subcategoria_id']);
        }

        $data['provincias'] = applib::get_all('*',applib::$provincias_table,array());

        if($data['anuncio']['provincia_id'] != NULL)
        {
            $data['localidades'] = applib::get_all('*',applib::$localidades_table,array('provincia_id' => $data['anuncio']['provincia_id']));
        }

        $data['categoria'] = applib::get_field(applib::$cat_table,array('id_categoria' => $data['anuncio']['categoria_id']), 'name');

        $data['subcategorias'] = applib::get_all('*',applib::$subcat_table,array('status !=' => 2,'categoria_id' => $data['anuncio']['categoria_id']));

        $data['imagenes'] = applib::get_all('*',applib::$img_table,array('anuncio_id' => $id),'order DESC');

        $data['title'] = 'Editar anuncio';
        $data['contenido'] = 'cuenta/publicar';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function borrar_anuncio()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id',true);

            applib::check_mi_anuncio($id);

            applib::update(array('id_anuncio' => $id,'user_id' => $this->session->userdata('user_id')),applib::$anuncios_table,array('status' => 2));

            applib::flash('success','Se ha borrado el anuncio exitosamente!','cuenta/mis_anuncios/');
            exit;
        }
        else
        {
            redirect(base_url('cuenta'));
            exit;
        }
    }

    public function pausar_anuncio()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id',true);

            applib::check_mi_anuncio($id);

            applib::update(array('id_anuncio' => $id,'user_id' => $this->session->userdata('user_id')),applib::$anuncios_table,array('status' => 3));

            applib::flash('success','Su ha pausado su anuncio exitosamente!','cuenta/mis_anuncios/');
            exit;
        }
        else
        {
            redirect(base_url('cuenta'));
            exit;
        }
    }

    public function reanudar_anuncio()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id',true);

            applib::check_mi_anuncio($id);

            if(applib::poder_publicar() == false)
            {
                $mensaje = '¡Agotaste el máximo de Avisos! Contactanos';
                $mensaje .= ($this->session->userdata('premium') == 0)?' para hacerte PREMIUM.':'';
                applib::flash('danger',$mensaje,'cuenta/mis_anuncios');
                exit;
            }

            applib::update(array('id_anuncio' => $id,'user_id' => $this->session->userdata('user_id')),applib::$anuncios_table,array('status' => 1));

            applib::flash('success','Se ha reanudado el anuncio exitosamente!','cuenta/mis_anuncios/');
            exit;
        }
        else
        {
            redirect(base_url('cuenta'));
            exit;
        }
    }

    public function republicar()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id',true);
            //Chequear que sea mi anuncio

            applib::check_mi_anuncio($id);

            if(applib::poder_publicar() == false)
            {
                $mensaje = '¡Agotaste el máximo de Avisos! Contactanos';
                $mensaje .= ($this->session->userdata('premium') == 0)?' para hacerte PREMIUM.':'';
                applib::flash('danger',$mensaje,'cuenta/mis_anuncios');
                exit;
            }

            $nuevafecha = strtotime ( '+'.DURACION.' day' , strtotime ( applib::fecha() ) ) ;

            $last_date = date ( 'Y-m-d H:i:s' , $nuevafecha );
            
            applib::update(array('id_anuncio' => $id,'user_id' => $this->session->userdata('user_id')),applib::$anuncios_table,array('status' => 1,'fecha_fin' => $last_date));

            if($this->session->userdata('premium') == 0)
            {
                applib::restar_anuncio();
            }
            
            applib::flash('success','Se ha republicado el anuncio exitosamente!','cuenta/mis_anuncios/');
            exit;
        }
        else
        {
            redirect(base_url('cuenta'));
            exit;
        }
    }

   public function mispujas()
    {
        $data['user'] = applib::get_table_field( applib::$users_table, array('id_user' => $this->session->userdata('user_id')), '*' );
        $condition = array('a.status !=' => 2,'f.user_id' => $this->session->userdata('user_id'));

        $this->load->model('favoritos_model');

        $data['anuncios'] = $this->favoritos_model->get_all($condition);

        $data['title'] = 'Mis Pujas';
        $data['contenido'] = 'cuenta/mispujas';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function chat()
    {
        $data['title'] = 'Chat Clasificados';
        $data['contenido'] = 'cuenta/chat';
        $this->load->view('frontend/templates/plantilla',$data);
    }
}