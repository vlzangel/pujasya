<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        applib::logued_in_user(FALSE);
    }

    function index()
    {
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

    public function favoritos()
    {
        $condition = array('a.status !=' => 2,'f.user_id' => $this->session->userdata('user_id'));

        $this->load->model('favoritos_model');

        $data['anuncios'] = $this->favoritos_model->get_all($condition);

        $data['title'] = 'Mis Favoritos';
        $data['contenido'] = 'cuenta/favoritos';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function borrar_anuncio_favoritos()
    {
        if($this->input->post())
        {
            $id = $this->input->post('id',true);

            $check = applib::check_favorito($id);

            if($check == true)
            {
                applib::delete(applib::$favoritos_table,array('anuncio_id' => $id,'user_id' => $this->session->userdata('user_id')));

                applib::flash('success','Se ha borrado el anuncio exitosamente!','cuenta/favoritos/');
                exit;
            }
            else
            {
                applib::flash('danger','Ha ocurrido un error en el proceso','cuenta/favoritos/');
                exit;
            }
        }
        else
        {
            redirect(base_url('cuenta'));
            exit;
        }
    }

     function comprarfichas()
    {   $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
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


    function comprarproducto()
    {   $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
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

   public function mispujas()
    {
        $condition = array('a.status !=' => 2,'f.user_id' => $this->session->userdata('user_id'));

        $this->load->model('favoritos_model');

        $data['anuncios'] = $this->favoritos_model->get_all($condition);

        $data['title'] = 'Mis Pujas';
        $data['contenido'] = 'cuenta/mispujas';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function misautopujas()
    {
        $condition = array('a.status !=' => 2,'f.user_id' => $this->session->userdata('user_id'));

        $this->load->model('favoritos_model');

        $data['anuncios'] = $this->favoritos_model->get_all($condition);

        $data['title'] = 'Mis AutoPujas';
        $data['contenido'] = 'cuenta/misautopujas';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    public function miscompras()
    {
        $condition = array('a.status !=' => 2,'f.user_id' => $this->session->userdata('user_id'));

        $this->load->model('favoritos_model');

        $data['anuncios'] = $this->favoritos_model->get_all($condition);

        $data['title'] = 'Mis Compras';
        $data['contenido'] = 'cuenta/miscompras';
        $this->load->view('frontend/templates/plantilla',$data);
    }


    public function chat()
    {
        $data['title'] = 'Chat Clasificados';
        $data['contenido'] = 'cuenta/chat';
        $this->load->view('frontend/templates/plantilla',$data);
    }
}