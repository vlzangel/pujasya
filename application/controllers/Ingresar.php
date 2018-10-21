<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingresar extends CI_Controller {
	
	public function __construct(){
        parent::__construct();


    }

    function index()
    {
        $this->load->library('form_validation');

        if($this->session->userdata('user_id') != "")
        {
            redirect(base_url('perfil'));
            exit;
        }

        if($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[4]');

            if ($this->form_validation->run())
            {
                $email = $this->input->post('email',true);

                $pass = applib::set_password($this->input->post('password',true));

                $this->load->model('login_model');

                $validate = $this->login_model->validate($email,$pass);

                if($validate != FALSE)
                {
                    if($validate['status'] == 0)
                    {
                        if($validate['email_valido'] == 0)
                        {
                            applib::flash('danger','Te enviamos un e-mail de confirmación a tu Correo, por favor verifica la carpeta SPAM si no lo ves en el INBOX. Si no confirmás el e-mail no podrás entrar.','ingresar');
                            exit;
                        }
                        else
                        {
                            applib::flash('danger','Tu usuario ha sido desactivado, por favor comunicate con el administrador.','ingresar');
                            exit;
                        }
                        
                    }

                    $data_sess = array(
                        'is_logued_in'  => TRUE,
                        'user_id'       => $validate['id_user'],
                        'name'          => $validate['name'],
                        'email'         => $validate['email'],
                        'seo'           => $validate['seo'],
                        'imagen'        => $validate['imagen'],
                        'premium'       => $validate['premium'],
                        'paquete'       => $validate['anuncios_cantidad_premium'],
                        'paquete_normal'=> $validate['anuncios_cantidad']
                    );

                    $this->session->set_userdata($data_sess);

                    applib::registro_login($validate['id_user']);

                    redirect(base_url('perfil'));
                    exit;
                }
                else
                {
                   
                    applib::flash('danger','Datos Incorrectos','ingresar');
                    exit;
                }
            }

        }
        
        ///EXTRAER SOLO LOCALIDADES DE CORDOBA

        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Ingresar, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );

    	$data['title'] = 'Entrar';
    	$data['contenido'] = 'login/index';
    	$this->load->view('frontend/templates/plantilla',$data);
    }

    function registro()
    {
        $this->load->library('form_validation');

        if($this->session->userdata('user_id') != "")
        {
            redirect(base_url('perfil'));
            exit;
        }

        if($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email');
            $this->form_validation->set_rules('nickname', 'Nombre de usuario', 'required|trim|min_length[5]');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[4]');
            $this->form_validation->set_rules('re-password', 'Confirmar contraseña', 'required|matches[password]');
            
            if ($this->form_validation->run())
            {
                //Chequear email

                $email = $this->input->post('email',true);

                $check = applib::get_table_field(applib::$users_table,array('email' => $email,'status !=' => 2),'email');

                if($check != "")
                {
                    applib::flash('danger','El correo electrónico ya se encuentra registrado','registro');
                    exit;
                }

                $this->load->helper('text');

                //Chequear nickname

                $nickname = url_title(convert_accented_characters($this->input->post('nickname',true)),'-',TRUE);

                $check = applib::get_table_field(applib::$users_table,array('nickname' => $nickname,'status !=' => 2),'nickname');

                if($check != "")
                {
                    applib::flash('danger','El nombre de usuario ya se encuentra registrado','registro');
                    exit;
                }

                //GUARDAR

                $data_in = array(
                    'email'             => $email,
                    'nickname'          => $nickname,
                    'password'          => applib::set_password($this->input->post('password',true)),
                    'provincia_id'      => 7,
                    'status'            => 0,
                    'date'              => applib::fecha(),
                    'seo'               => $nickname,
                    'anuncios_cantidad' => NUM_ANUNCIOS_NORMAL
                );

                $save = applib::create(applib::$users_table,$data_in);

                if($save)
                {

                    //Enviar correo para confirmar email

                    $data_registro = array(
                        'user_id'   => $save,
                        'token'     => applib::get_token(),
                        'date'      => applib::fecha()
                    );

                    applib::create(applib::$confirmar_registro_table,$data_registro);

                    $this->load->library('mailer');

                    $data_email = array(
                        'email' => $email,
                        'token' => $data_registro['token']
                    );

                    mailer::confirmar_registro($data_email);

                    applib::flash('success','Te hemos enviado un correo electrónico para verificar tu cuenta!','ingresar');
                    exit;
                }
                else
                {
                    applib::flash('danger','Ha ocurrido un error durante el proceso','registro');
                    exit;
                }

            }
            else
            {
                applib::flash('danger',validation_errors(),'registro');
                exit;
            }

        }
        ///EXTRAER SOLO LOCALIDADES DE CORDOBA

        $data['localidades'] = applib::get_all('*',applib::$localidades_table,array('provincia_id' => 7));

        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Registro, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );

        $data['title'] = 'Registro';
        $data['contenido'] = 'login/registro';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function confirmar_email($token)
    {   
        if(!$token)
        {
            redirect(base_url('ingresar'));
            exit;
        }

        $condition = array('token' => $token,'status' => 1);

        $check = applib::get_table_field(applib::$confirmar_registro_table,$condition, '*');

        if($check == "")
        {
            redirect(base_url());
            exit;
        }

        applib::update(array('id_user' => $check['user_id']),applib::$users_table,array('status' => 1,'email_valido' => 1));
        
        applib::update(array('id_confirmar' => $check['id_confirmar']),applib::$confirmar_registro_table,array('status' => 0));
            
        $this->load->library('mailer');

        mailer::register_email(array('email' => applib::get_field(applib::$users_table,array('id_user' => $check['user_id']),'email')));

        applib::flash('success','¡Tu E-mail se validó exitosamente! ahora ya puedes entrar a tu cuenta.','ingresar');
    }

    function facebook()
    {
        if($this->session->userdata('user_id') != "")
        {
            redirect(base_url('perfil'));
            exit;
        }

        $this->load->config('facebook');

        $this->load->library("facebook/facebook",array("appId"=> "157606567995368","secret" => "8b6a61ff88200174092588a598a231cd"));

        $user = $this->facebook->getUser();

        $access_token = $this->facebook->getAccessToken();

        if($user) {
            try 
            {
                $me = $this->facebook->api("/me?fields=id,name,email");

                $fb_id = $me['id'];

                $name = $me['name'];
                $email = $me['email'];

                $check = $this->_dofacebook($fb_id);

                if($check == false)
                {
                    $fullname = explode(" ", $name);

                    $fname =  $fullname[0];

                    $lname = "";

                    if(!empty($fullname[1]))
                    {
                        $lname = $fullname[1];
                    }

                    //Guardar nuevo usuario

                    $data_in = array(
                        'name'              => $fname.' '.$lname,
                        'fb_id'             => $fb_id,
                        'email'             => $email,
                        'provincia_id'      => 7,
                        'status'            => 1,
                        'date'              => applib::fecha(),
                        'seo'               => NULL,
                        'anuncios_cantidad' => NUM_ANUNCIOS_NORMAL
                    );

                    $save = applib::create(applib::$users_table,$data_in);

                    if($save)
                    {

                        $data_sess = array(
                            'is_logued_in'  => TRUE,
                            'user_id'       => $save,
                            'name'          => '',
                            'email'         => '',
                            'seo'           => '',
                            'imagen'        => '',
                            'premium'       => 0,
                            'paquete'       => 0,
                            'paquete_normal'=> NUM_ANUNCIOS_NORMAL
                        );

                        $this->session->set_userdata($data_sess);

                        applib::registro_login($save);

                        redirect(base_url('perfil'));
                        exit;
                    }
                    else
                    {
                        applib::flash('danger','Ha ocurrido un error durante el proceso','ingresar');
                        exit;
                    }
                }
            }
            catch(FacebookApiExeption $e) {
                $user = NULL;
            }
        }
        else
        {
            die("<script>top.location='".$this->facebook->getLoginUrl(array(
                'scope'=>'email',
                "redirect_url"=> 'https://www.pujasya.com/'
            ))."'</script>");
        }
    }

    function _dofacebook($fb_id)
    {
        if($this->session->userdata('user_id') != "")
        {
            redirect(base_url('perfil'));
            exit;
        }

        $validate = applib::get_table_field(applib::$users_table,array('fb_id' => $fb_id,'status !=' => 2), '*');

        if($validate != "")
        {
            //Loguear

            if($validate['status'] == 0)
            {
                applib::flash('danger','Tu usuario ha sido desactivado, por favor comunicate con el administrador.','ingresar');
                exit;
            }

            $data_sess = array(
                'is_logued_in'  => TRUE,
                'user_id'       => $validate['id_user'],
                'name'          => $validate['name'],
                'email'         => $validate['email'],
                'seo'           => $validate['seo'],
                'imagen'        => $validate['imagen'],
                'premium'       => $validate['premium'],
                'paquete'       => $validate['anuncios_cantidad_premium'],
                'paquete_normal'=> $validate['anuncios_cantidad']
            );

            $this->session->set_userdata($data_sess);

            applib::registro_login($validate['id_user']);

            redirect(base_url('perfil'));
            exit;
        }
        else
        {
            return false;
        }
    }

    public function recuperar()
    {
        if($this->session->userdata('user_id') != "")
        {
            redirect(base_url('perfil'));
            exit;
        }

        if($this->input->post())
        {
            $email = $this->input->post('email',true);

            if($email == "")
            {
                applib::flash('danger','¡Debes ingresar tu E-mail o Usuario!','ingresar/recuperar');
                exit;
            }

            $this->load->library('captcha/recaptchalib');

            $this->recaptchalib->Recaptchalib("6Le5hHUUAAAAADyBA1kVcoaO8EkIt5C2uoJjkIEe");
            $response = $this->recaptchalib->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);

            if($response == null || $response->success == false)
            {
                applib::flash('danger','¡Debes completar el captcha!','ingresar/recuperar');
                exit;;
            }

            $condition = 'email = "'.$email.'" OR nickname = "'.$email.'"';

            $check = applib::get_table_field(applib::$users_table,$condition, '*');

            if($check == "")
            {
                applib::flash('danger','¡No estás registrado en nuestra plataforma!','ingresar/recuperar');
                exit;
            }

            $data_token = array(
                'user_id'   => $check['id_user'],
                'token'     => applib::get_token(),
                'date'      => applib::fecha(),
                'status'    => 1
            );

            applib::create(applib::$recover_table,$data_token);

            ///ENVIAR TOKEN POR EMAIL

            $this->load->library('mailer');

            $data_email = array(
                'email'     => $check['email'],
                'token'     => $data_token['token'],
                'username'  => $check['name']
            );

            mailer::recover_email($data_email);

            applib::flash('success','Se envió un correo electrónico con instrucciones para recuperar tu contraseña, revisa la carpeta SPAM si no lográs verlo en el INBOX','ingresar/recuperar');
            exit;
        }

        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Recuperar contraseña, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );

        $data['title'] = 'Recuperar contraseña';
        $data['contenido'] = 'login/recuperar';
        $this->load->view('frontend/templates/plantilla',$data);


    }

    public function recuperar_password($token)
    {
        if(!$token)
        {
            redirect(base_url('ingresar'));
            exit;
        }

        $manana = applib::fecha_mas(applib::fecha(),'+1 day');

        $condition = array('token' => $token,'status' => 1);

        $check = applib::get_table_field(applib::$recover_table,$condition, '*');

        if($check == "")
        {
            redirect(base_url());
            exit;
        }

        if($check['date'] > $manana)
        {
            applib::flash('danger','Este link ha caducado!','ingresar/recuperar');
            exit;
        }

        $this->load->library('form_validation');

        if($this->input->post())
        {
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[4]');
            $this->form_validation->set_rules('re-password', 'Confirmar contraseña', 'required|matches[password]');
            
            if($this->form_validation->run())
            {
                applib::update(array('id_user' => $check['user_id']),applib::$users_table,array('password' => applib::set_password($this->input->post('password',true))));

                applib::update(array('user_id' => $check['user_id']),applib::$recover_table,array('status' => 0));

                //Enviar email de cambio de contraseña

                $data_user = applib::get_table_field(applib::$users_table,array('id_user' => $check['user_id']), 'email,name');

                $this->load->library('mailer');

                $data_email = array(
                    'email'     => $data_user['email'],
                    'username'  => $data_user['name']
                );

                mailer::cambiar_contrasena($data_email);

                applib::flash('success','Su contraseña se ha actualizado exitosamente','ingresar');
                exit;
            }
        }
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Recuperar contraseña, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );

        $data['title'] = 'Recuperar contraseña';
        $data['contenido'] = 'login/recuperar_password';
        $this->load->view('frontend/templates/plantilla',$data);


    }

    public function salir()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
