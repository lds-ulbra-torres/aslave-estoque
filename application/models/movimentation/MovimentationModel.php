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
			$this->db->order_by('id_financial_release' , 'desc');
		return $this->db->get()->result_array();
	}	

	public function delete($movimentation){
		return $this->db->delete($this->table, $movimentation);
	}

	public function getUpdateData($idMovimentation){
			$this->db->like('id_financial_release' , $idMovimentation);
			$this->db->join('people', 'people.id_people = financial_releases.id_people');
			$this->db->join('fin_classifications', ' financial_releases.id_classification = fin_classifications.id_classification');
		return $this->db->get($this->table)->result_array(); 
	}

	public function update($movimentation){
			$this->db->like('id_financial_release', $movimentation['id_financial_release']);
		return $this->db->update($this->table, $movimentation);
	}

	public function searchMovimentation($data){
		  	$this->db->join('people', 'people.id_people = financial_releases.id_people');
			$this->db->join('fin_classifications', ' financial_releases.id_classification = fin_classifications.id_classification');
			$this->db->like('financial_releases.id_people', $data['id_people']);
			$this->db->like('type_mov', $data['type_mov']);
			$this->db->like('date_financial_release', $data['date_financial_release']);
		return $this->db->get($this->table)->result_array();
	}

}

/* End of file movimentationModel.php */
/* Location: ./application/models/movimentation/movimentationModel.php */