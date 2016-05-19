<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class UserModel extends CI_Model {
	
	public function login($login, $password){
		
		$this->db->where('login', $login);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	
	}

}