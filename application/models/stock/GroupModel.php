<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupModel extends CI_Model {

	var $table = 'product_groups';
	var $name = 'name_group';
	var $id = 'id_group';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function create($group) {
		return $this->db->insert($this->table, $group);
	}

	public function update($group) {
		$this->db->where($this->id, $group['id_group']);
		return $this->db->update($this->table, $group);
	}

	public function delete($group) {
		return $this->db->delete($this->table, $group);
	}

	public function count() {
		if ($search_string) { $this->db->like($this->name, $search_string); }
		return $this->db->get()->num_rows();
	}

	public function getGroups($search_string=null) {
		if ($search_string) { $this->db->like($this->name, $search_string); }

		$this->db->order_by($this->name, 'asc');
		return $this->db->get($this->table)->result_array();
	}

	public function getGroupById($id) {
		$this->db->where($this->id, $id);
		$group_data = $this->db->get();
		return $group_data->result_array(); 
	}

	public function groupExists($name) {
		$group = array($this->name => $name);
		$query = $this->db->get_where($this->table, $group, 1);
		if ($query->num_rows() > 0) 
			return true;
		return false;
	}

}

/* End of file groupsModel.php */
/* Location: ./application/models/groupsModel.php */