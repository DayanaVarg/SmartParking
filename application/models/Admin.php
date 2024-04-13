<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model{

    function __construct(){
		$this->load->database();
	}

    //Consultar admin
	public function searchAdmin($iden){
		$admin = $this->db->get_where('admin', array('admin.identification' => $iden), 1);
		return $admin->row_array();
	}

	//Registrar Admin
	public function createAdmin($datos){
		if($this->input->server('REQUEST_METHOD')==='POST'){
			if (!$this->db->insert('admin', $datos)){
				return false;
			}
			return true;
		}else{
			show_404();
		}
	}
}

?>