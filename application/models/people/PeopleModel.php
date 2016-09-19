<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleModel extends CI_Model {

	var $table = "people";

	public function getPerson($id_person) {
		//$this->db->join('cities', 'people.id_cities = cities.id_cities', 'inner');
		//$this->db->join('states', 'people.id_states = states.id_states', 'inner');
		$person = $this->db->get_where($this->table, array('id_people' => $id_person))->result_array();
		//$city = $this->db->get_where('cities', array('id_cities' => $person[0]));
		return $person;

	}

	public function create($people){
	return $this->db->insert($this->table, $people);
	}

	public function delete($people){
		return $this->db->delete($this->table, $people);
	}
    public function listPeople($id) {
        $this->db->where('id_people', $id);
        return $this->db->get('people')->result();
    }
	public function update($people){
		$query = $this->db->get('people');
		$this->db->where('id_people', $people['id_people']);
		return $this->db->update($this->table, $people);
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

	public function cities()
	{
		$this->db->order_by('name','asc');
		$citie = $this->db->get('cities');
		if($citie->num_rows()>0)
		{
			return $citie->result();
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

	public function alterStates($id)
	{
	    return $this->db->query("call SP_people_cities($id)")->result();
	}

    public function get_pagination($max, $init){

		$this->db->order_by('name','asc');
		$query = $this->db->get('people', $max, $init);
        return $query->result();
	}

	public function count_register()
    {
        return $this->db->count_all_results('people');
    }

    public function search($people){
		$whereCondition = array('name' => $people);
		$this->db->order_by('name','asc');
		$this->db->like($whereCondition);
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();

	}
	public function checkCPF($cpf){
		$this->db->where("cpf_cnpj", $cpf);
		$query = $this->db->get('people');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

}

/* End of file classificationModel.php */
/* Location: ./application/models/classificationModel.php */
