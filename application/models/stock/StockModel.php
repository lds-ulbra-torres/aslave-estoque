<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockModel extends CI_Model {

	var $input = 'stock_input';
	var $input_has_products = 'stock_input_products';
	var $output = 'stock_output';
	var $stock = 'stock';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function create($stock, $table) {
		$this->db->insert($table, $stock);
		return $this->db->insert_id();
	}

	public function getInputStocks() {
		$this->db->join('people', 'stock_input.id_fornecedor = people.id_people', 'inner');
		return $this->db->get($this->input)->result_array();
	}

	public function getInputHasProducts($id_stock) {
		$this->db->where('stock_input_products.id_stock', $id_stock);
		$this->db->join('stock_input', 'stock_input_products.id_stock = stock_input.id_stock', 'inner');
		$this->db->join('stock_products', 'stock_input_products.id_product = stock_products.id_product', 'inner');
		return $this->db->get($this->input_has_products)->result_array();
	}

	public function getPeople($searchString) {
		$this->db->select("id_people, name");
		$whereCondition = array('name' =>$searchString);
		$this->db->like($whereCondition);
		$query = $this->db->get('people');
		return $query->result();
	}
	public function getProductSearch($searchString) {
		$this->db->select("id_product, name_product");
		$whereCondition = array('name_product' =>$searchString);
		$this->db->like($whereCondition);
		$this->db->from('stock_products');
		$query = $this->db->get();
		return $query->result();
	}

}
