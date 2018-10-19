<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
    }

    public function index()
    {
    	if($this->session->userdata('id_admin') != "")
        {
        	redirect(base_url().'admin/users', 301);
            exit;
        }

    	$this->load->library('form_validation');

    	if ($this->input->post()) {
    		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            if ($this->form_validation->run())
            {
    			$email = $this->input->post('email',true);

    			$pass = applib::set_password($this->input->post('password',true));

    			$this->load->model('login_model');

    			$validate = $this->login_model->validateAdmin($email,$pass);

    			if($validate != FALSE)
    			{
        			$data = array(
        				'is_logued_in'  => TRUE,
        				'id_admin'      => $validate['id_admin'],
        				'name_admin'    => $validate['name'],
        				'email_Admin'   => $validate['email']
        			);

        			$this->session->set_userdata($data);

        			redirect(base_url('admin'));
    			}
    			else
            	{
                    applib::flash('danger','La información es incorrecta.','admin/login');
                    exit;
            	}
          	}
        }

        $this->load->view('backend/login/index');
        
    }

    public function logout()
	{
		$this->session->sess_destroy();
        redirect(base_url().'admin/login');
    }
}

	