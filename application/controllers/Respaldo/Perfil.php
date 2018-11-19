<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        applib::logued_in_user(FALSE);
        $this->load->model('Perfil_model');
    }

    public function index(){
    	$data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');

    	$this->load->library('form_validation');

    	if($this->input->post()){
            $this->form_validation->set_rules('name', 'Nombre', 'required|trim|min_length[4]|max_length[25]');
            $this->form_validation->set_rules('telefono_fijo', 'Número de teléfono', 'required|trim');
            
            if($this->form_validation->run()){
                //Arreglo para guardar

                $data_in = array(
                    'name'          => $this->input->post('name',true),
                    'telefono_fijo' => $this->input->post('telefono_fijo',true),
                    'telefono_movil'=> $this->input->post('telefono_movil',true),
                    'provincia_id'  => $this->input->post('provincia_id',true),
                    'poblacion_id'  => $this->input->post('poblacion_id',true),
                    'direccion'     => $this->input->post('direccion',true),
                    'mostrar_email' => $this->input->post('mostrar_email',true),
                    'mostrar_perfil'=> $this->input->post('mostrar_perfil',true)
                );

                //Chequear nickname
                $seo = $data['user']['seo'];
                if($data['user']['nickname'] == NULL AND $this->input->post('nickname',true) != ''){
                    $nickname = $this->input->post('nickname',true);
                    $check = applib::get_table_field(applib::$users_table,array('nickname' => $nickname,'status !=' => 2),'id_user');
                    if($check != "" AND $check['id_user'] != $data['user']['id_user']){
                        applib::flash('danger','El nombre de usuario ya se encuentra registrado!','perfil');
                        exit;
                    } else {
                        $this->load->helper('text');
                        $data_in['nickname'] = $nickname;
                        $data_in['seo'] = url_title(convert_accented_characters($nickname),'-',TRUE);
                        $seo =  $data_in['seo'];
                    }
                }

                //Chequear email

                $email = $data['user']['email'];
                if($data['user']['email'] == NULL AND $this->input->post('email',true) != ''){
                    $email = $this->input->post('email',true);
                    $check = applib::get_table_field(applib::$users_table,array('email' => $email,'status !=' => 2),'id_user');
                    if($check != "" AND $check['id_user'] != $data['user']['id_user']){
                        applib::flash('danger','El correo electrónico ya se encuentra registrado!','perfil');
                        exit;
                    } else {
                        $data_in['email'] = $email;
                    }
                }
            	
                //Subir imagen
            	$image_name = $data['user']['imagen'];
                if(!empty($_FILES['imagen']['name'])){
                    $config['upload_path'] = './public/uploads/avatars/temp';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = true;
                    $config['max_size'] = '5128';
                    $config['max_width'] = '6000';
                    $config['max_height'] = '6000';
                    $this->load->library('upload', $config);
                    if(!$this->upload->do_upload('imagen')){
                        applib::flash('danger',$this->upload->display_errors(),'perfil');
                        exit;
                    } else {
                        $ima = $this->upload->data();
                        $image_name = $ima["file_name"];
                        //REDIMENSIONAR
                        $this->load->library('image_lib');
                        //RESIZE 250 x 200
                        $config2['image_library']   = 'gd2';
                        $config2['source_image']    = './public/uploads/avatars/temp/'.$image_name;
                        $config2['new_image']       = './public/uploads/avatars/'; // las nuevas imágenes se guardan
                        //$config2['create_thumb']    = TRUE;
                        $config2['maintain_ratio']  = TRUE;
                        $config2['width']           = 250;
                        $config2['height']          = 250;
                        $this->image_lib->initialize($config2);
                        if (!$this->image_lib->resize()){
                            unlink('./public/uploads/avatars/temp/'.$image_name);
                            applib::flash('danger',$this->image_lib->display_errors(),'perfil');
                            exit;
                        }
                        unlink('./public/uploads/avatars/temp/'.$image_name);
                    }
                }

                $data_in['imagen'] = $image_name;
                $update = applib::update(array('id_user' => $this->session->userdata('user_id')),applib::$users_table,$data_in);
                if($update){
                	$data_sess = array(
                        'name'          => $this->input->post('name',true),
                        'email'         => $email,
                        'seo'           => $seo,
                        'imagen'        => $image_name
                    );
                    $this->session->set_userdata($data_sess);
                    applib::flash('success','Su perfil se ha actualizado exitosamente!','perfil');
                    exit;
                } else {
                	applib::flash('danger','Ha ocurrido un error durante el proceso','perfil');
                    exit;
                }
            }
    	}

    	///EXTRAER SOLO LOCALIDADES DE CORDOBA

        $data['paises'] = $this->Perfil_model->get_paises();
        $data['cantidad_productos'] = applib::count_table_rows(applib::$anuncios_table,array('user_id' => $this->session->userdata('user_id'),'status !=' => 2));
        
    	$data['title'] = 'Mi perfil';
    	$data['contenido'] = 'perfil/index';
    	$this->load->view('frontend/templates/plantilla',$data);
    }

    public function cambiar_contrasena()
    {
        if($this->input->post())
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('password', 'Contraseña Actual', 'trim');
            $this->form_validation->set_rules('new_password', 'Nueva contraseña', 'required|trim');
            
            if($this->form_validation->run())
            {
                $pass = isset($_POST['password'])?$this->input->post('password',true):'';

                $check = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'id_user,password');

                if($check['password'] != "" AND $check['password'] != applib::set_password($pass))
                {
                    $this->session->set_flashdata('msg2', '<div class="alert alert-danger" style="margin-bottom: 10px;">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    Su contraseña actual es inválida.</div>');
                    redirect(base_url('perfil'), 301);
                    exit;
                }

                //GUARDAR

                $data_in = array(
                    'password' => applib::set_password($this->input->post('new_password',true))
                );

                $update = applib::update(array('id_user' => $this->session->userdata('user_id')),applib::$users_table,$data_in);

                if($update)
                {
                    //Enviar email de cambio de contraseña

                    $this->load->library('mailer');

                    $data_email = array(
                        'email'     => $this->session->userdata('email'),
                        'username'  => $this->session->userdata('name')
                    );

                    mailer::cambiar_contrasena($data_email);

                    $this->session->set_flashdata('msg2', '<div class="alert alert-success" style="margin-bottom: 10px;">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    Su contraseña se ha actualizado exitosamente!</div>');
                    redirect(base_url('perfil'), 301);
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('msg2', '<div class="alert alert-danger" style="margin-bottom: 10px;">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                    Ha ocurrido un error durante el proceso.</div>');
                    redirect(base_url('perfil'), 301);
                    exit;
                }
            }
            else
            {
                $this->session->set_flashdata('msg2', '<div class="alert alert-danger" style="margin-bottom: 10px;">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                '.validation_errors().'</div>');
                redirect(base_url('perfil'), 301);
                exit;
            }
        }
        else
        {
            redirect(base_url());
        }
    }
}
