<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MovimentationModel extends CI_Model {
	private $table = 'financial_releases';

	public function createMovimentation($movimentation){
		return $this->db->insert($this->table, $movimentation);
	}

	public function getMovimentations(){
		return $this->db->get($this->table)->result_array();
	}
	

}

/* End of file movimentationModel.php */
/* Location: ./application/models/movimentation/movimentationModel.php */