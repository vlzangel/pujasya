<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



class AppLib {

	private static $db;

	private static $code;

	// Define system tables

    public static $users_table = 'vv_users';

    public static $provincias_table = 'provincias';

    public static $localidades_table = 'localidades';

    public static $cat_table = 'vv_categorias';

    public static $subcat_table = 'vv_subcategorias';

    public static $img_table = 'vv_img_anuncios';

    public static $anuncios_table = 'vv_anuncios';

    public static $favoritos_table = 'vv_favoritos';

    public static $sidebar_table = 'vv_sidebar';

    public static $visitas_table = 'vv_visitas';

    public static $recover_table = 'vv_recuperar_password';

    public static $registro_log_table = 'vv_registro_login';

    public static $marcas_table = 'vv_marcas';

    public static $marcas_subcat_table = 'vv_marca_subcategoria';

    public static $confirmar_registro_table = 'vv_confirmar_registro';

    public static $solicitudes_table = 'vv_solicitudes';

    public static $conversaciones_table = 'vv_conversaciones';

    public static $chat_table = 'vv_chat';

    public static $conver_anuncios_table = 'vv_conver_anuncios';
    
	function __construct(){
		self::$code =& get_instance();
		self::$code->load->database();
		self::$db = &get_instance()->db;
	}

    // NUEVAS FUNCIONES

    public static function horas($inicio, $cierre){
        $inicio = date("H:i", strtotime( date("Y-m-d ".$inicio) )  );
        $cierre = date("H:i", strtotime( date("Y-m-d ".$cierre) )  );
        return $inicio." - ".$cierre;
    }






    // FUNCIONES VIEJAS


	//VERIFY LOGIN ADMIN

	public static function logued_in_admin($var)
	{
		if(self::$code->session->userdata('is_logued_in') == $var OR self::$code->session->userdata('id_admin') != 1)
        {
            redirect(base_url(), 301);
        }
	}

    //VERIFY LOGIN USER

    public static function logued_in_user($var)
    {
        if(self::$code->session->userdata('is_logued_in') == $var)
        {
            redirect(base_url('ingresar'), 301);
        }
    }

    //CONTAR REGISTROS

    public static function count_table_rows($table,$where)
    {
        $query = self::$db->where($where)->get($table);

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return 0;
        }
    }

	//CREATE REGISTER

	static function create($table,$data = array()) {  

	 	self::$db->insert($table,$data);  

	 	return self::$db->insert_id();                          
	}

	//UPDATE REGISTER

    static function update($where = array(),$table,$data = array()) {  

        self::$db->where($where);

        self::$db->update($table,$data);  

        return true;                          

    }

    //DELETE REGISTER

    static function delete($table,$where = array()) 
    {  
        self::$db->delete($table, $where);  

        return true;                          

    }

	//GET ALL ROW

    static function get_all($select,$table,$where, $orderby = NULL,$limit = NULL)
    {

        self::$db->select($select);

       	self::$db->from($table);

        self::$db->where($where);

        if($orderby != NULL)
        {
            self::$db->order_by($orderby);
        }

        if($limit != NULL)
        {
            self::$db->limit($limit);
        }

        $query = self::$db->get();
        
        return $query->result_array();
    }

	//GET ONE ROW

	static function get_table_field($table, $where_criteria, $table_field) 
	{

        self::$db->select($table_field);

        self::$db->from($table);

        self::$db->where($where_criteria);

        $query = self::$db->get();
        
        return $query->row_array();
	}

    //GET ONLY THE FIELD

    static function get_field($table, $where_criteria = array(), $table_field) 
    {

        self::$db->select($table_field);

        self::$db->from($table);

        self::$db->where($where_criteria);

        $query = self::$db->get();
        
        $valor = $query->row_array();

        if(isset($valor[$table_field]))
        {
            return $valor[$table_field];
        }
        else
        {
            return false;
        }
    }

    //Chequear mi anuncio

    static function check_mi_anuncio($id) 
    {
        $condition = array('id_anuncio' => $id,'user_id' => self::$code->session->userdata('user_id'));

        $check = self::get_table_field(self::$anuncios_table,$condition,'id_anuncio');
            
        if($check == "")
        {
            redirect(base_url('cuenta'));
            exit;
        }
    }

    //Chequear cantidad de anuncios

    static function check_cantidad() 
    {
        $condition = array('id_user' => self::$code->session->userdata('user_id'));

        $check = self::get_field(self::$users_table,$condition,'anuncios_cantidad');
            
        return $check;
    }

    //Restar anuncio a usuario

    static function restar_anuncio() 
    {
        $condition = array('id_user' => self::$code->session->userdata('user_id'));

        $cantidad = self::get_table_field(self::$users_table,$condition,'anuncios_cantidad,premium');

        $check = true;

        if($cantidad['premium'] == 0)
        {
            $cant_new = $cantidad['anuncios_cantidad'] - 1;

            $check = self::update($condition,applib::$users_table,array('anuncios_cantidad' => $cant_new));
        }
            
        return $check;
    }

	//FLASH DATA

	static function flash($type,$message,$url)
    {
        self::$code->session->set_flashdata('msg', '<div class="alert alert-'.$type.'" style="margin-bottom: 10px;">
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        '.$message.'</div>');
        redirect(base_url() . $url, 301);
    }

    //FLASH DATA

    static function flash_no_products($message = null,$url)
    {
        $message = $message == null?'No se encontraron Productos y/o Servicios en tu búsqueda...':$message;

        self::$code->session->set_flashdata('msg', '<p style="text-align: center;font-weight: bold;background-color: white; padding: 77px;font-size: 17px;">
        '.$message.'</p>');
        redirect(base_url() . $url, 301);
    }

    //SET ENCRIPTED PASSWROD

    static function set_password($pass)
    {
        $password = md5(sha1($pass));

        return $password;
    }

    //OBTENER EDAD POR MEDIO DE FECHA

    static function get_edad($fecha)
    {
        $fecha = time() - strtotime($fecha);

        $edad = floor((($fecha / 3600) / 24) / 360);

        return $edad;
    }

    //COMPARAR NUMEROS

    static function format_compare($num)
    {
        $first = str_replace(".", "", $num);

        $final = str_replace(",", ".", $first);

        return $final;
    }

    //Mostrar costos

    static function format_costo($num)
    {
        $final = number_format($num, 0, '', '.');

        return $final;
    }

    //OBTENER FECHA ACTUAL

    static function fecha()
    {
        return date('Y-m-d H:i:s');
    }

    //TIME AGO

    static function time_ago($datetime, $full = false) 
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'Año',
            'm' => 'mes',
            'w' => 'semana',
            'd' => 'día',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? 'Hace '.implode(', ', $string) : 'Hace instantes';
    }

    static function dias_restantes($fecha_final) {  
        $fecha_actual = date("Y-m-d H:i:s");  
        $s = strtotime($fecha_final)-strtotime($fecha_actual);  
        $d = intval($s/86400);  
        $diferencia = $d;  
        return $diferencia;  
    }

    static function get_fecha_completa($fecha)
    {
        ///FECHA EN FORMATO yyyy-mm-dd

        $meses = array(
            '01'    => 'Enero',
            '02'    => 'Febrero',
            '03'    => 'Marzo',
            '04'    => 'Abril',
            '05'    => 'Mayo',
            '06'    => 'Junio',
            '07'    => 'Julio',
            '08'    => 'Agosto',
            '09'    => 'Septiembre',
            '10'    => 'Octubre',
            '11'    => 'Noviembre',
            '12'    => 'Diciembre'
        );

        $tiempo = explode('-', $fecha);

        return $tiempo[2].' de '.$meses[$tiempo[1]].' del '.$tiempo[0];

    }

    //DEVUELVE FECHA DE INCIO Y FIN DE LA SEMANA

    static function semana()
    {
        $diaInicio="Monday";
        $diaFin="Sunday";

        $strFecha = strtotime(date('Y-m-d'));

        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));

        if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
        return array("inicio"=>$fechaInicio,"fin"=>$fechaFin);
    }

     /** * Verifica que una fecha esté dentro del rango de fechas establecidas 
     * @param $start_date fecha de inicio * @param $end_date fecha final 
     * @param $evaluame fecha a comparar * @return true si esta en el rango, false si no lo está */

    static function check_in_range($start_date, $end_date, $evaluame) 
    { 
        $start_ts = strtotime($start_date); 
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    //Funcion para obtener N anuncios premium al azar

    static function get_premium($condition,$cantidad,$order_by = NULL)
    {
        //Obtener todos los anuncios premium segun la condicion
        
        $premium_total = self::$code->anuncios_model->get_all_premium($condition,$order_by);

        $user = array();

        $premium = array();

        $anuncios_cantidad = count($premium_total);

        if($anuncios_cantidad > 0){
            if( $order_by == NULL ){
                //Obtener la cantidad de usuarios para saber cuantos anuncios mostrar
                foreach ($premium_total as $key => $value) {
                   if(!in_array($premium_total[$key]['user_id'], $user)){
                        array_push($user, $premium_total[$key]['user_id']);
                   }
                }
                if(count($user) < $cantidad){
                    $cantidad = ($cantidad > $anuncios_cantidad)?$anuncios_cantidad:$cantidad;
                    do {
                        $valor = array_rand($premium_total);
                        $arreglo = $premium_total[$valor];
                        array_push($premium, $arreglo);
                        unset($premium_total[$valor]);
                    } while (count($premium) < $cantidad);
                } else {
                    $user = array();
                    do {
                        $valor = array_rand($premium_total);
                        $arreglo = $premium_total[$valor];
                        if(!in_array($arreglo['user_id'], $user)){
                            array_push($premium, $arreglo);
                            array_push($user, $arreglo['user_id']);
                            unset($premium_total[$valor]);
                        }
                    } while (count($premium) < $cantidad);
                }
            }else{
                $premium = $premium_total;
            }
        }
        return $premium;
    }

    //Chequear favorito

    static function check_favorito($id_anuncio)
    {
        if(self::$code->session->userdata('user_id') != "")
        {
            $condition = array('user_id' => self::$code->session->userdata('user_id'),'anuncio_id' => $id_anuncio);

            $check = self::get_table_field(self::$favoritos_table,$condition,'id_favorito');

            if($check != "")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    static function check_fulldata()
    {
        $id = self::$code->session->userdata('user_id');

        if($id == "")
        {
            return false;
        }

        $datos = self::get_table_field(self::$users_table,array('id_user' => $id),'*');

        if($datos == "")
        {
            return false;
        }

        if($datos['name'] == "" OR $datos['email'] == "" OR $datos['nickname'] == "" 
        OR $datos['provincia_id'] == "" OR $datos['poblacion_id'] == "" OR $datos['telefono_fijo'] == "")
        {
            return false;
        }

        return true;
    }

    static function titulo($var)
    {
        return ucfirst(strtolower($var));
    }

    static function fecha_mas($fecha,$tiempo)
    {
        //Obtener fecha mas o menos dias u horas o segundos

        $nuevafecha = strtotime ($tiempo , strtotime ( $fecha ) ) ;

        return date ( 'Y-m-d H:i:s' , $nuevafecha );
    }

    //Registrar logueo por ip

    static function registro_login($user)
    {
        $data_in = array(
            'ip'        => self::$code->input->ip_address(),
            'date'      => self::fecha()
        );

        $check = self::get_table_field(self::$registro_log_table,array('user_id' => $user), '*');

        if($check != "")
        {
            self::update(array('user_id' => $user),self::$registro_log_table,$data_in);

            return true;
        }
        else
        {
            $data_in['user_id'] = $user;

            self::create(self::$registro_log_table,$data_in);

            return true;
        }

        return false;
    }

    //Chequear si puedo publicar otro anuncio premium

    static function poder_publicar()
    {
        $id = self::$code->session->userdata('user_id');


        if($id == "")
        {
            return false;
        }

        $check = self::get_table_field(self::$users_table,array('id_user' => $id,'status' => 1),'*');

        if($check == "")
        {
            return false;
        }

        //Usuario NO premium

        // if($check['premium'] == 0)
        // {
        //     return $check['anuncios_cantidad'] > 0?true:false;
        // }

        //Usuario premium

        // if($check['premium'] == 1)
        // {
        //     $cuantos = self::count_table_rows(self::$anuncios_table,array('status' => 1,'user_id' => $id));

        //     return $cuantos >= $check['anuncios_cantidad_premium']?false:true;
        // }

        $cuantos = self::count_table_rows(self::$anuncios_table,array('status' => 1,'user_id' => $id));

        if($check['premium'] == 1 AND $cuantos >= $check['anuncios_cantidad_premium'])
        {
            return false;
        }

        if($check['premium'] == 0 AND $cuantos >= $check['anuncios_cantidad'])
        {
            return false;
        }


        return true;
    }

    //Destruir filtros

    static function destroy_filters()
    {
        $filtros = array('costo_desde_filtro','costo_hasta_filtro','marca_filtro','version_filtro',
        'combustible_filtro','moneda_filtro','year_desde_filtro','year_hasta_filtro','tipo_operacion_filtro',
        'provincia_id_filtro','poblacion_id_filtro','text_filtro','costo_menor_filter','costo_mayor_filter',
        'fecha_orden_filter');

        foreach ($filtros as $key => $value) {
            self::$code->session->set_userdata($value,'');
        }
    }

    static function get_marcas($subcategoria)
    {
        $condition = 'm.status = 1';

        if(is_numeric($subcategoria))
        {
            $condition .= ' AND ms.subcategoria_id = '.$subcategoria.'';
        }
        else
        {
            $condition .= ' AND sc.seo = "'.$subcategoria.'"';
        }

        self::$db->select('ms.*,m.*');

        self::$db->from(self::$marcas_subcat_table.' as ms');

        self::$db->join(self::$marcas_table.' as m','m.id_marca = ms.marca_id');

        self::$db->join(self::$subcat_table.' as sc','sc.id_subcategoria = ms.subcategoria_id');

        self::$db->where($condition);

        self::$db->order_by('m.name ASC');

        $query = self::$db->get();

        return $query->result_array();
    }

    static function config_pagination($data)
    {
        $config['base_url'] = $data['url'];
        $config['total_rows'] = $data['cuantos'];
        $config['per_page'] = $data['porpagina'];
        $config['uri_segment'] = $data['segment'];
        $config['num_links'] = 4;
        $config['full_tag_open'] = '<div class="page-pagination text-center mt-30 p-10 panel"><nav><ul class="page-pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><span class="page-numbers current">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = "<<";
        $config['next_link'] = "Siguiente";
        $config['prev_link'] = "Anterior";
        $config['last_link'] = ">>";

        return $config;
    }

    static function get_token()
    {
        return md5(sha1(time())).rand(100,10000);
    }

    static function check_chat($id_vendedor = null,$id_anuncio = null)
    {
        $id_user = self::$code->session->userdata('user_id');

        $condition = '(comprador_id = '.$id_user.' AND vendedor_id = '.$id_vendedor.') OR (comprador_id = '.$id_vendedor.' AND vendedor_id = '.$id_user.')';

        $check_chat = applib::get_table_field(applib::$conversaciones_table,$condition,'*');

       if($check_chat == "")
       {
         return 1;
       }

       $condition = 'conversacion_id = '.$check_chat['id_conversacion'].' AND anuncio_id = '.$id_anuncio;

       $check_anuncio = applib::get_table_field(applib::$conver_anuncios_table,$condition,'*');

       if($check_anuncio == "")
       {
            return 2;
       }

       return false;

    }
}