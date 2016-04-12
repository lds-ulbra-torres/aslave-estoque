<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleModel extends CI_Model {

	public $table = "people";

	public function create($people){
	return $this->db->insert($this->table, $people);
	}

	public function delete($people){
		return $this->db->delete($this->table, $people);
	}

	public function update($people){
		$query = $this->db->get('people');
		$this->db->where('id_people', $people['id_people']);
		return $this->db->replace($this->table, $people);
	}

	public function get(){
		$this->db->order_by('name','asc');
		return $this->db->get($this->table)->result_array();
	}

	public function states()
	{
		$this->db->order_by('name','asc');
		$state = $this->db->get('states');
		if($state->num_rows()>0)
		{
			return $state->result();
		}
	}
	
	public function localidades($state)
	{
		$this->db->where('id_states',$state);
		$this->db->order_by('name','asc');
		$localidades = $this->db->get('cities');
		if($localidades->num_rows()>0)
		{
			return $localidades->result();
		}
	}



}

/* End of file classificationModel.php */
/* Location: ./application/models/classificationModel.php */