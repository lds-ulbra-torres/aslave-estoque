<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleModel extends CI_Model {

	public $table = "peoples";

	public function create($people){
		return $this->db->insert($this->table, $people);
	}

	public function delete($people){
		return $this->db->delete($this->table, $people);
	}

	public function update($people){
		return $this->db->replace($this->table, $people);
	}

	public function get(){
		return $this->db->get($this->table)->result_array();
	}

	public function getStates(){
		return $this->db->get('tb_estados')->result_array();
	}

	public function getCities(){
		return $this->db->get('tb_cidades')->result_array();
	}
}

/* End of file classificationModel.php */
/* Location: ./application/models/classificationModel.php */