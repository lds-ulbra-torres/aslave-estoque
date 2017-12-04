<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class UserModel extends CI_Model {
	
	var $table = 'users';

	public function login($login, $password){
		
		$this->db->where('login', $login);
		$this->db->where('password', $password);
		$query = $this->db->get($this->table)->result();
		return $query;
		
	}
	public function checkUser($user){
		$where = 'full_name="'.$user['full_name'].'" OR login="'.$user['login'].'"';
		$this->db->where($where);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function create($user){
		return $this->db->insert($this->table, $user);
	}
	public function getUsers(){
		$this->db->from($this->table);
		$this->db->order_by('full_name', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getUserById($id) {
		$this->db->where('id_user', $id);
		return $this->db->get($this->table)->result_array();
	}
	public function delete($user) {
		return $this->db->delete($this->table, $user);
	}
	public function update($user) {
		$this->db->where('id_user', $user['id_user']);
		return $this->db->update($this->table, $user);
	}
	public function getUserSearch($searchString) {
		$this->db->select("*");
		$this->db->where("(`full_name` LIKE '%$searchString%' OR  `login` LIKE '%$searchString%')");
		$this->db->from('users', 5);
		$query = $this->db->get();
		return $query->result();
	}
}