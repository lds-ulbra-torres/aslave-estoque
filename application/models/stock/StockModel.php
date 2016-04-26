<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockModel extends CI_Model {

	var $input = 'stock_input';
	var $input_has_products = 'stock_input_products';
	var $output_has_products = 'stock_output_products';
	var $output = 'stock_output';
	var $stock = 'stock';

	public function __construct() {
		parent::__construct();
	}

	public function getInputStocks() {
		$this->db->join('people', 'stock_input.id_people = people.id_people', 'inner');
		return $this->db->get($this->input)->result_array();
	}

	public function getOutputStocks() {
		$this->db->join('people', 'stock_output.id_people = people.id_people', 'inner');
		return $this->db->get($this->output)->result_array();
	}
	public function getDetailedEntry($id_stock) {
		$this->db->where('stock_input.id_stock', $id_stock);
		$this->db->join('stock_input_products', 'stock_input.id_stock = stock_input_products.id_stock', 'inner');
		$this->db->join('stock_products', 'stock_input_products.id_product = stock_products.id_product', 'inner');
		$entry = $this->db->get($this->input)->result_array();
		$people = $this->db->get_where('people', array('id_people' => $entry[0]['id_people']))->result_array();
		return array('entry' => $entry, 'people' => $people);
		
	}
	public function getDetailedOutput($id_stock) {
		$this->db->where('stock_output.id_stock', $id_stock);
		$this->db->join('stock_output_products', 'stock_output.id_stock = stock_output_products.id_stock', 'inner');
		$this->db->join('stock_products', 'stock_output_products.id_product = stock_products.id_product', 'inner');
		$output = $this->db->get($this->output)->result_array();
		$people = $this->db->get_where('people', array('id_people' => $output[0]['id_people']))->result_array();
		return array('output' => $output, 'people' => $people);
	}

	public function getPeople($searchString) {
		$this->db->select("id_people, name");
		$whereCondition = array('name' =>$searchString);
		$this->db->like($whereCondition);
		$query = $this->db->get('people');
		return $query->result();
	}
	public function getProductSearch($searchString) {
		$this->db->select("id_product, name_product, unit_price");
		$whereCondition = array('name_product' =>$searchString);
		$this->db->like($whereCondition);
		$this->db->from('stock_products');
		$query = $this->db->get();
		return $query->result();
	}

	public function findStockByForeign($product_id) {
		$query = $this->db->get_where($this->input_has_products, $product_id, 1);
		if ($query->num_rows() > 0){
			return true;
		} 
		return false;
	}

/* ESTOQUE DE ENTRADA */
	public function createInputStockPeople($peopleData){
		$this->db->insert($this->input, $peopleData);
		return $this->db->insert_id();
	}
	public function createInputStockProduct($product_array){
		return $this->db->insert_batch($this->input_has_products, $product_array);
	}
	public function deleteInputStockProduct($id_stock){
		return $this->db->delete($this->input_has_products, $id_stock);
	}
	public function deleteInputStock($id_stock){
		return $this->db->delete($this->input, $id_stock);
	}
	
/* ESTOQUE DE SAÍDA */
	public function createOutputStockPeople($people){
		$this->db->insert($this->output, $people);
		return $this->db->insert_id();
	}
	public function createOutputStockProduct($product_array){
		return $this->db->insert_batch($this->output_has_products, $product_array);
	}
	public function deleteOutputStockProduct($id_stock){
		return $this->db->delete($this->output_has_products, $id_stock);
	}
	public function deleteOutputStock($id_stock){
		return $this->db->delete($this->output, $id_stock);
	}

}
