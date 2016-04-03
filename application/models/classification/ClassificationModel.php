<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassificationModel extends CI_Model {

	public $table = "fin_classification";

	public function create($classification){
		return $this->db->insert($this->table, $classification);
	}

	public function delete($classification){
		return $this->db->delete($this->table, $classification);
	}

	public function update($classification){
		return $this->db->replace($this->table, $classification);
	}

	public function get(){
		return $this->db->get($this->table)->result_array();
	}


}

/* End of file classificationModel.php */
/* Location: ./application/models/classificationModel.php */