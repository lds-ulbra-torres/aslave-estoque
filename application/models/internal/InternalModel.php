<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InternalModel extends CI_Model {
    
	public $table = "internal";

    public function create($internal){
	return $this->db->insert($this->table, $internal);
	}

	public function delete($internal){
		return $this->db->delete($this->table, $internal);
	}
	public function update($internal){
		$query = $this->db->get('internal');
		$this->db->where('id_people', $internal['id_people']);
		return $this->db->update($this->table, $internal);
	}

	public function get(){
		$this->db->order_by('name','asc');
		return $this->db->get($this->table)->result_array();
	}
}

/* End of file InternalModel.php */
/* Location: ./application/models/internal/InternalModel.php */