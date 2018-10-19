<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        applib::destroy_filters();

    }

 
    function index()
    {        
        $condition = array('u.premium' => 1,'a.status' => 1);
 
        $data['premium'] = applib::get_premium($condition,1000);

        $cantidad = applib::get_all('*',applib::$anuncios_table,array('status !=' => 5));


        //Extraer nuevos usuarios

        $data['users'] = applib::get_all('*',applib::$users_table,array('status' => 1,'name !=' => null,'nickname !=' => null,'seo !=' => null,'mostrar_perfil' => 1),'id_user DESC','18,0');

        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');

        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Pujas';
        $data['contenido'] = 'index/index';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function bidlist() {        
        $condition = array('u.premium' => 1,'a.status' => 1);
 
        $data['premium'] = applib::get_premium($condition,1000);

        $cantidad = applib::get_all('*',applib::$anuncios_table,array('status !=' => 5));


        //Extraer nuevos usuarios

        $data['users'] = applib::get_all('*',applib::$users_table,array('status' => 1,'name !=' => null,'nickname !=' => null,'seo !=' => null,'mostrar_perfil' => 1),'id_user DESC','18,0');

        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');

        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Pujas';
        $data['contenido'] = 'index/bidlist';
        $this->load->view('frontend/templates/plantilla',$data);
    }

    function terminos_y_condiciones()
    {      $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
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



     function contacta()
    {
        $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        $data['meta'] = array(
            array(
                'name' => 'description', 
                'content' => 'Contacta, Cordoba Vende, Autos y Otros, Hogar y Muebles, Deportes y Fitness, Consolas y Videojuegos, Motos y Otros, Inmuebles, Camionetas, Clasificados Gratis, Villa General Belgrano, Interior Cordoba'
            )
        );
        $data['title'] = 'Contacta';
        $data['contenido'] = 'index/contacta';
        $this->load->view('frontend/templates/plantilla',$data);
    }

   

    function preguntas_frecuentes()
    {
           $data['user'] = applib::get_table_field(applib::$users_table,array('id_user' => $this->session->userdata('user_id')),'*');
        $data['title'] = 'Preguntas frecuentes';
        $data['contenido'] = 'index/preguntas_frecuentes';
        $this->load->view('frontend/templates/plantilla',$data);
    }


    function solicitar_pack()
    {
        if($this->input->post())
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
            $this->form_validation->set_rules('horario', 'Hoario/Día', 'required');

            if ($this->form_validation->run())
            {
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
            }
            else
            {
                applib::flash('danger',validation_errors(),'planes-premium');
                exit;
            }
        }
        else
        {
            redirect(base_url());
        }
    }

}