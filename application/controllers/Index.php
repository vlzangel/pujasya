<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        applib::destroy_filters();
    }
    
    function cron(){      
        $this->load->view('frontend/index/cron', []);
    }
    
    function terminos_y_condiciones(){      
        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Términos y condiciones, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Términos y condiciones';
        $data['contenido'] = 'index/terminos_y_condiciones';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function contacta(){
        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Contacta, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Contacta';
        $data['contenido'] = 'index/contacta';
        $this->load->view('frontend/templates/plantilla', $data);
    }

    function vlz_contactar(){

        $this->load->library('captcha/recaptchalib');

        $this->recaptchalib->Recaptchalib("6Le5hHUUAAAAADyBA1kVcoaO8EkIt5C2uoJjkIEe");
        $response = $this->recaptchalib->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);

        if($response == null || $response->success == false) {

            $data['info'] = array(
                'nombre'   => $this->input->post('nombre'),
                'email'     => $this->input->post('email'),
                'asunto'  => $this->input->post('asunto'),
                'mensaje'   => $this->input->post('mensaje')
            );

            applib::flash('danger','¡Debes completar el captcha!');

            $data['title'] = 'Contacta';
            $data['contenido'] = 'index/contacta';
            $this->load->view('frontend/templates/plantilla', $data);
            
        }else{
            if( $this->input->post() ){
                $data_in = array(
                    'nombre'   => $this->input->post('nombre'),
                    'email'     => $this->input->post('email'),
                    'asunto'  => $this->input->post('asunto'),
                    'mensaje'   => $this->input->post('mensaje'),
                    'email_enviar' => 'vlzangel91@gmail.com'
                );
                $this->load->library('mailer');
                mailer::contactar_email($data_in);
                applib::flash('success','Hemos recibido tu información, pronto nos comunicaremos contigo, ¡GRACIAS!');

                $data['title'] = 'Contacta';
                $data['contenido'] = 'index/contacta';
                $this->load->view('frontend/templates/plantilla', $data);
            }
        }
    }

    function preguntas_frecuentes(){
        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        $data['title'] = 'Preguntas frecuentes';
        $data['contenido'] = 'index/preguntas_frecuentes';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function solicitar_pack(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
            $this->form_validation->set_rules('horario', 'Hoario/Día', 'required');
            if ($this->form_validation->run()){
                $data_in = array(
                    'plan_id'   => $this->input->post('id_pack',true),
                    'email'     => $this->input->post('email',true),
                    'telefono'  => $this->input->post('telefono',true),
                    'horario'   => $this->input->post('horario',true),
                    'info'      => $this->input->post('info',true),
                    'date'      => applib::fecha(),
                    'status'    => 1
                );
                applib::create(applib::$solicitudes_table,$data_in);
                $this->load->library('mailer');
                $data_in['paquete'] = $this->input->post('paquete',true);
                $data_in['email_enviar'] = 'hola@vallevende.com';
                mailer::solicitud_email($data_in);
                $data_in['email_enviar'] = $data_in['email'];
                mailer::solicitud_email($data_in);
                applib::flash('success','Solicitud ENVIADA. En unos minutos revisaremos tu pedido, ¡GRACIAS!','planes-premium');
                exit;
            } else {
                applib::flash('danger',validation_errors(),'planes-premium');
                exit;
            }
        } else {
            redirect(base_url());
        }
    }

}