<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchModel extends CI_Model {

	public function getNamePeople($search){	
		$this->db->select("id_people, name");
		$whereCondition = array('name' =>$search);
		$this->db->like($whereCondition);
		$this->db->from('people');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file SearchModel.php */
/* Location: ./application/models/search/SearchModel.php */