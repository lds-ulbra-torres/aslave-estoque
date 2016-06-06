<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class ClassificationModel extends CI_Model {

	public $table = "fin_classifications";

	public function create($classification){
		return $this->db->insert($this->table, $classification);
	}

	public function getItemByForeign($classification){

		$query = $this->db->get_where('financial_releases', $classification, 1);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}

	public function delete($classification){
		return $this->db->delete($this->table, $classification);
	}

	public function update($classification){
		$this->db->where('id_classification', $classification['id_classification']);
		return $this->db->update($this->table, $classification);
	}

	public function get(){
		$this->db->from($this->table);
		$this->db->order_by('name_classification','asc');
		return $this->db->get()->result_array();
	}

	public function getPerType($type){
		$this->db->like('classification_type', $type);
		return $this->db->get($this->table)->result_array();
	}
	public function getDataClassification($id_classification){
		$this->db->like('id_classification',$id_classification);
		return $this->db->get($this->table)->result_array();

	}
}

/* End of file classificationModel.php */
/* Location: ./application/models/classificationModel.php */