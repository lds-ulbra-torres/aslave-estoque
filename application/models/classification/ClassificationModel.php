<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassificationModel extends CI_Model {

	public $table = "fin_classifications";

	public function create($classification){
		return $this->db->insert($this->table, $classification);
	}

	public function delete($classification){
		return $this->db->delete($this->table, $classification);
	}

	public function update($classification){
		$this->db->where('id_classification', $classification['id_classification']);
		return $this->db->update($this->table, $classification);
	}

	public function get(){
		return $this->db->get($this->table)->result_array();
	}

	public function getPerType($type){
		$this->db->like('classification_type', $type);
		return $this->db->get($this->table)->result_array();
	}
}

/* End of file classificationModel.php */
/* Location: ./application/models/classificationModel.php */