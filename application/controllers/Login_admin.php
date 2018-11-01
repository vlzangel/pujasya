<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_admin extends SuperController {
  
    public function __construct(){
        parent::__construct();
        applib::destroy_filters();
        if ( $this->session->userdata('username') ){
            redirect( base_url('Administrador/anuncios') );
        }
        $this->load->library('session');
        $this->load->model('Administrador_Model');
    }

    public function login(){
        $this->load->view('backend/login', $data);
    }

    public function logear(){
        $user = $this->input->post('user');
        $pass = $this->input->post('pass');

        $realuser = $this->Administrador_Model->verificaruser($user);
        if ($realuser == "valid") {
            $realpass = $this->Administrador_Model->realpass($user);
            if (md5($pass) != $realpass) {
                $data['title_page'] = "Iniciar Sesion";
                $data['mensaje'] = "Contraseña Invalida";
                $data['user'] = $user;
                $this->load->view('backend/login', $data);
            } else {

                $dataAdmin = $this->Administrador_Model->adminData($user);
                $array = array(
                    'username' => $user,
                    'id_admin' => $dataAdmin['id_admin'],
                    'code_user' => $dataAdmin['code_user'],
                    'nombre' => $dataAdmin['name_admin'],
                    'phone' => $dataAdmin['phone_admin'],
                    'email' => $dataAdmin['email_admin'],
                    'registro' => $dataAdmin['date_register_admin'],
                    'type_user' => $privilegio
                );
                
                $this->session->set_userdata( $array );
                redirect( base_url().'Administrador/home' );

            }
        } else {
            if ($realuser == "disabled") {
                $data['title_page'] = "Iniciar Sesion";
                $data['mensaje'] = "Usuario Inactivo comunicate con el dpto de soporte";
                $data['user'] = "";
                $this->load->view('login',$data);
            } else {
                $data['title_page'] = "Iniciar Sesion";
                $data['mensaje'] = "Usuario Invalido - ".$user;
                $data['user'] = "";
                $this->load->view('backend/login', $data);
            }
        }
    }

}