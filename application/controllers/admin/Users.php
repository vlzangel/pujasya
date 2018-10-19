<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
        parent::__construct();
        applib::logued_in_admin(false);
    }

    public function index()
    {
    	$data['users'] = applib::get_all('*',applib::$users_table,array('status !=' => 2));
    	$data['title'] = 'Usuarios';
    	$data['contenido'] = 'users/index';
    	$this->load->view('backend/templates/plantilla',$data);
    }

    public function edit($id)
    {
    	if($id == NULL)
        {
            redirect(base_url('admin/users'));
            exit;
        }

        $condition = array('id_user' => $id,'status !=' => 2);

        $data['user'] = applib::get_table_field(applib::$users_table,$condition,'*');

        if(sizeof($data['user']) == 0)
        {
            redirect(base_url('admin/users'));
            exit;
        }

        $this->load->library('form_validation');

        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('nickname', 'Nombre de usuario', 'required|trim');
            $this->form_validation->set_rules('direccion', 'Dirección', 'trim');

            if ($this->form_validation->run())
            {
                $image_name = $data['user']['imagen'];

                if(!empty($_FILES['imagen']['name']))
                {
                    $config['upload_path'] = './public/uploads/avatars/temp';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = true;
                    $config['max_size'] = '5128';
                    $config['max_width'] = '6000';
                    $config['max_height'] = '6000';

                    $this->load->library('upload', $config);

                    if(!$this->upload->do_upload('imagen')) 
                    {
                        applib::flash('danger',$this->upload->display_errors(),'admin/users/edit/'.$id);
                        exit;
                    }
                    else
                    {
                        $ima = $this->upload->data();
                        $image_name = $ima["file_name"];

                        //REDIMENSIONAR
                    
                        $this->load->library('image_lib');

                        //RESIZE 250 x 200

                        $config2['image_library']   = 'gd2';
                        $config2['source_image']    = './public/uploads/avatars/temp/'.$image_name;
                        $config2['new_image']       = './public/uploads/avatars/'; // las nuevas imágenes se guardan
                        $config2['create_thumb']    = false;
                        $config2['maintain_ratio']  = TRUE;
                        $config2['width']           = 250;
                        $config2['height']          = 250;

                        $this->image_lib->initialize($config2);

                        if (!$this->image_lib->resize())
                        {
                            unlink('./public/uploads/avatars/temp/'.$image_name);

                            applib::flash('danger',$this->image_lib->display_errors(),'admin/users/edit/'.$id);

                            exit;
                        }

                        unlink('./public/uploads/avatars/temp/'.$image_name);
                    }
                }

                $email = $this->input->post("email", true);

                //CHECK EMAIL

                $check = applib::get_table_field(applib::$users_table,array('email' => $email),'id_user'); 
                    
                if($check['id_user'] != "" AND $check['id_user'] != $data['user']['id_user'])
                {
                    applib::flash('danger','El email ya existe en la base de datos.','admin/users/edit/'.$id);
                    exit;
                }
                
                $data_in = array(
                    "name"          => $this->input->post("name", true),
                    "email"         => $email,
                    "nickname"      => $this->input->post("nickname", true),
                    'imagen'        => $image_name,
                    "provincia_id"  => $this->input->post("provincia_id", true),
                    "poblacion_id"  => $this->input->post("poblacion_id", true),
                    "direccion"     => $this->input->post("direccion", true),
                    "telefono_fijo" => $this->input->post("telefono_fijo", true),
                    "telefono_movil"=> $this->input->post("telefono_movil", true),
                    "status"        => $this->input->post("status", true)
                );

                if($this->input->post("password", true) != "")
                {
                    $data_in['password'] = applib::set_password($this->input->post("password", true));
                }
                    
                //UPDATE

                //IMACTIVAR TAMBIEN PRODUCTOS DEL USUARIO SI EL ESTADO ES INACTIVO

                $edit = applib::update(array('id_user' => $id),applib::$users_table, $data_in);

                //SAVE VALIDATION

                if($edit)
                {
                    applib::flash('success','El usuario fue editado correctamente.','admin/users');
                    exit;
                }
                else
                {
                    applib::flash('danger','Ha ocurrido un error durante el proceso.','admin/users/edit/'.$id);
                    exit;
                }
            }
        }

        $data['provincias'] = applib::get_all('*',applib::$provincias_table,array());

        $data['localidades'] = applib::get_all('*',applib::$localidades_table,array('provincia_id' => $data['user']['provincia_id']));

    	$data['title'] = 'Editar usuario';
    	$data['contenido'] = 'users/edit';
    	$this->load->view('backend/templates/plantilla',$data);
    }

    function delete()
    {
        if($this->input->post('id'))
        {
            applib::update(array('id_user' => $this->input->post('id',true)),applib::$users_table,array('status' => 2));

           //ELIMINAR TAMBIEN PRODUCTOS DEL USUARIO

             applib::flash('success','El usuario ha sido eliminado exitosamente','admin/users');
             exit;
        }

        redirect(base_url('admin/users'));
    }
}
