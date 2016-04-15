<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MovimentationModel extends CI_Model {
	private $table = 'financial_releases';

	public function create($movimentation){
		return $this->db->insert($this->table, $movimentation);
	}

	public function get(){
		$this->db->from('financial_releases');
		$this->db->join('people', 'people.id_people = financial_releases.id_people');
		return $this->db->get()->result_array();
	}	

	public function delete($movimentation){
		return $this->db->delete($this->table, $movimentation);
	}

}

/* End of file movimentationModel.php */
/* Location: ./application/models/movimentation/movimentationModel.php */