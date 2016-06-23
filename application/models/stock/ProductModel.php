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

	public function getRowsCount() {
		return $this->db->get($this->table)->num_rows();
	}

	public function getProducts($max=null,$init=null) {
		$this->db->join('stock_product_groups', 'stock_products.id_group = stock_product_groups.id_group', 'inner');
		$this->db->order_by('name_product', 'asc');
		$this->db->group_by('stock_products.id_product');
		$query = $this->db->get($this->table, $max, $init);
		return $query->result_array();
	}

	public function getProductById($id) {
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->result_array();
	}

	public function getProductByName($product_name) {
		$this->db->where($this->name, $product_name);
		return $this->db->get($this->table)->result_array();
	}

	public function findProductByForeign($group_id) {
		$query = $this->db->get_where($this->table, $group_id, 1);
		if ($query->num_rows() > 0){
			return true;
		}
		return false;
	}
	public function search($product){
		$this->db->join('stock_product_groups', 'stock_products.id_group = stock_product_groups.id_group', 'inner');
		$this->db->group_by('stock_products.id_product');
		$whereCondition = array('name_product' => $product);
		$this->db->like($whereCondition);
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();

	}
	public function searchByGroup($id_group){
		$this->db->select("id_group, name_product, id_product, amount");
		$whereCondition = array('id_group' => $id_group);
		$this->db->where($whereCondition);
		return $this->db->get($this->table)->result_array();
	}

}

/* End of file productModel.php */
/* Location: ./application/models/productModel.php */
