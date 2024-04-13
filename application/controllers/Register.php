<?php

defined('BASEPATH') OR exit('No direct script access allowe');

class Register extends CI_Controller{

    public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('Admin');
		$this->load->library(array('session'));
    }

    public function index(){
        $this->load->view('admin/register');
    }

    public function add(){
        $iden = $this->input->post('iden');
        $name = $this->input->post('name');
        $lastname = $this->input->post('lastname');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);

        if(!$this->Admin->searchAdmin($iden)){
            $datos = array(
                'identification'=>$iden,
                'name'=>$name,
                'lastname'=>$lastname,
                'phone'=>$phone,
                'email' => $email,
                'password' => $password,
            );

            if(!$this->Admin->createAdmin($datos)){
                $data['msg'] = 'Ocurrió un error al insertar los datos, vuelve a intentarlo';
                $this->load->view('admin/register', $data);
            }
            $this->session->set_flashdata('mnsg', 'Registrado con éxito');
			redirect('login');
        }
        $data['msg'] = 'El usuario ya se encuentra registrado';
		$this->load->view('admin/register', $data);

    }
}
?>