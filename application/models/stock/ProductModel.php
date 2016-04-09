<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

	var $table = 'stock_products';
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
		return $this->db->get($this->table)->num_rows();
	}

	public function getProducts($id_group=null, $search_string=null) {
		if ($search_string) { $this->db->like($this->name, $search_string); }
		$this->db->join('stock_product_groups', 'stock_products.id_group = stock_product_groups.id_group', 'left');
		$this->db->group_by('stock_products.id_product');

		return $this->db->get($this->table)->result_array();
	}

	public function getProductById($id) {
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->result_array();
	}

	public function getProductByName($product_name) {
		$this->db->where($this->name, $product_name);
		return $this->db->get($this->table)->result_array();
	}

	public function productExists($product_name) {
		$this->db->where($this->name, $product_name);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) 
			return true;
		return false;
	}

}

/* End of file productModel.php */
/* Location: ./application/models/productModel.php */