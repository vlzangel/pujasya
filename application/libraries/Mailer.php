<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class Mailer {

	private static $db;

	private static $code;

	public static $email_table = 'vv_email_templates';

	function __construct()
	{
		self::$code =& get_instance();

		self::$code->load->database();

		self::$db = &get_instance()->db;
	}

	static function send_email($params = array()){

    	// $params = array(
    	// 	'from_email' => 'hola@vallevende.com',
    	// 	'from_name'	 =>  'ValleVende.com',
    	// 	'recipient'	 => 'orlando6644@hotmail.com',
    	// 	'subject'	 => 'Correo de prueba',
    	// 	'message'	 => 'Este es un correo de prueba desde vallevende y prueba'
    	// );

        $config['protocol'] = 'smtp';
        $config["smtp_host"] = 'smtp.gmail.com';
        $config["smtp_user"] = 'soporte.kmimos@gmail.com';
        $config["smtp_pass"] = '@km!m05@';   
        $config["smtp_port"] = '587';
        $config['smtp_crypto'] = 'tls';

        self::$code->load->library('email');

        self::$code->email->initialize($config);

        self::$code->email->from($params['from_email'], $params['from_name']);

        self::$code->email->to($params['recipient']);

        self::$code->email->subject($params['subject']);

        self::$code->email->message($params['message']);

        if(self::$code->email->send()){
            return true;
        }else{
            return false;
        }
       	
    }

	public static function register_email($data = array())
	{
		$template = applib::get_table_field(self::$email_table,array('ID' => 1),'*');

		$message = str_replace(
			array(
				"{BASE_URL}"
			),
        	array(
        		base_url()
        	), 

        	$template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
		
	}

    public static function limite_agotado($data = array())
    {
        $template = applib::get_table_field(self::$email_table,array('ID' => 2),'*');

        $message = str_replace(
            array(
                "{BASE_URL}","{USERNAME}","{LIMITE}"
            ),
            array(
                base_url(),$data['username'],$data['limite']
            ), 

            $template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
        
    }

    public static function confirmar_registro($data = array())
    {
        $template = applib::get_table_field(self::$email_table,array('ID' => 3),'*');

        $message = str_replace(
            array(
                "{BASE_URL}","{TOKEN}"
            ),
            array(
                base_url(),$data['token']
            ), 

            $template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
        
    }

    public static function cambiar_contrasena($data = array())
    {
        $template = applib::get_table_field(self::$email_table,array('ID' => 4),'*');

        $message = str_replace(
            array(
                "{BASE_URL}","{USERNAME}"
            ),
            array(
                base_url(),$data['username']
            ), 

            $template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
    }

	public static function recover_email($data = array())
	{
		$template = applib::get_table_field(self::$email_table,array('ID' => 5),'*');

		$message = str_replace(
			array(
				'{USERNAME}',"{BASE_URL}","{TOKEN}"
			),
        	array(
        		$data['username'],base_url(),$data['token']
        	), 

        	$template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
		
	}

    public static function newsletter_email($data = array())
    {
        $template = applib::get_table_field(self::$email_table,array('ID' => 4),'*');

        $message = str_replace(
            array(
                '{NOMBRE_USUARIO}',"{BASE_URL}"
            ),
            array(
                $data['username'],base_url()
            ), 

            $template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
        
    }

    public static function solicitud_email($data = array())
    {
        $template = applib::get_table_field(self::$email_table,array('ID' => 6),'*');

        $message = str_replace(
            array(
                '{NOMBRE_PAQUETE}',"{EMAIL_USUARIO}","{TELEFONO}","{HORARIO}","{INFO}","{FECHA}","{BASE_URL}"
            ),
            array(
                $data['paquete'],$data['email'],$data['telefono'],$data['horario'],$data['info'],$data['date'],base_url()
            ), 

            $template['content']
        );

        $params['from_email'] = $template['from_email'];

        $params['from_name'] = $template['from_name'];

        $params['recipient'] = $data['email_enviar'];

        $params['subject'] = SITE_TITLE.$template['subject'];

        $params['message'] = $message; 

        $return = self::send_email($params);

        return $return;
        
    }

    public static function contactar_email($data = array()){
        $template = applib::get_table_field(self::$email_table, array('ID' => 7), '*');
        $message = str_replace(
            array(
                '{NOMBRE}',
                "{EMAIL}",
                "{ASUNTO}",
                "{MENSAJE}",
                "{BASE_URL}",
            ),
            array(
                $data['nombre'],
                $data['email'],
                $data['asunto'],
                $data['mensaje'],
                base_url()
            ), 
            $template['content']
        );
        $params['from_email'] = "vlzangel91@gmail.com";
        $params['from_name'] = $template['from_name'];
        $params['recipient'] = $data['email_enviar'];
        $params['subject'] = SITE_TITLE.$template['subject'];
        $params['message'] = $message; 
        $return = self::send_email( $params );
        return $return;
    }

}
