<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

	var $table = 'products';
	var $name = 'name_product';
	var $id = 'id_product';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function create($product) {
		return $this->db->insert($this->table, $product);
	}

	public function update($product) {
		$this->db->where($this->id, $product['id_product']);
		return $this->db->update($this->table, $product);
	}

	public function delete($product) {
		return $this->db->delete($this->table, $product);
	}

	public function count() {
		if ($search_string) { $this->db->like($this->name, $search_string); }
		
		return $this->db->get()->num_rows();
	}

	public function getProducts($id_group=null, $search_string=null) {
		if ($search_string) { $this->db->like($this->name, $search_string); }

		$this->db->join('product_groups', 'products.id_group = product_groups.id_group', 'inner');
		$this->db->group_by('products.id_product');
		//$this->db->order_by('id', 'asc');

		return $this->db->get($this->table)->result_array();
	}

	public function getProductById($id) {
		$this->db->where($this->id, $id);
		$group_data = $this->db->get();
		return $group_data->result_array(); 
	}

	public function productExists($name) {
		$product = array($this->name => $name);
		$query = $this->db->get_where($this->table, $product, 1);
		if ($query->num_rows() > 0) 
			return true;
		return false;
	}

}

/* End of file productModel.php */
/* Location: ./application/models/productModel.php */