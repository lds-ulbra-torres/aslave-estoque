<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockModel extends CI_Model {

	var $input_table = 'stock_input';
	var $output_table = 'stock_output';
	var $stock_table = 'stock';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function createStock($stock) {
		return $this->db->insert($this->stock_table, $stock);
	}

	public function input($stock) {
		if ($this->stockExists($stock['id_stock_product'])) {
			$current_stock = $this->getStockById($stock['id_stock_product']);
			$new_amount = $current_stock['amount'] + $stock['input_amount'];
			$new_input_stock = array(
				'id_stock_product' => $stock['id_stock_product'], 
				'amount' => $new_amount);
			$this->db->where('id_stock_product', $new_input_stock['id_stock_product']);
			$this->db->update($this->stock_table, $new_input_stock);
			return $this->db->insert($this->input_table, $stock);
		}
		else {
			$new_stock = array(
				'id_stock_product' => $stock['id_stock_product'], 
				'amount' => $stock['input_amount']);
			$this->db->insert($this->stock_table, $new_stock);
			return $this->db->insert($this->input_table, $stock);
		}
	}

	public function output($stock) {
		$current_stock = $this->getStockById($stock['id_stock_product']);
		$new_amount = $current_stock['amount'] - $stock['output_amount'];
		$new_output_stock = array(
			'id_stock_product' => $stock['id_stock_product'], 
			'amount' => $new_amount);
		$this->db->where('id_stock_product', $new_output_stock['id_stock_product']);
		$this->db->update($this->stock_table, $new_output_stock);
		return $this->db->insert($this->output_table, $stock);
	}

	public function update($stock) {
		$this->db->where('id', $stock['id']);
		return $this->db->update($this->input_table, $stock);
	}

	public function delete($stock) {
		return $this->db->delete($this->table, $stock);
	}

	public function getStocks() {
		$this->db->join('stock_products', 'stock.id_stock_product = stock_products.id_product', 'inner');
		$this->db->join('stock_product_groups', 'stock_products.id_group = stock_product_groups.id_group', 'inner');
		//$this->db->order_by('name', 'asc');
		return $this->db->get($this->stock_table)->result_array();
	}

	public function getInputStocks() {
		$this->db->join('stock_products', 'stock_input.id_stock_product = stock_products.id_product', 'inner');
		$this->db->join('stock_product_groups', 'stock_products.id_group = stock_product_groups.id_group', 'inner');
		//$this->db->group_by('stock_input.input_date');
		return $this->db->get($this->input_table)->result_array();
	}

	public function getOutputStocks() {
		$this->db->join('stock_products', 'stock_output.id_stock_product = stock_products.id_product', 'inner');
		$this->db->join('stock_product_groups', 'stock_products.id_group = stock_product_groups.id_group', 'inner');
		//$this->db->group_by('stock_input.input_date');
		return $this->db->get($this->output_table)->result_array();
	}

	public function getStockById($id) {
		$stock = array('id_stock_product' => $id);
		$stock_data = $this->db->get_where($this->stock_table, $stock, 1);
		return $stock_data->result_array(); 
	}

	public function stockExists($id_stock_product)
	{
		$stock = array('id_stock_product' => $id_stock_product);
		$query = $this->db->get_where($this->stock_table, $stock, 1);
		if ($query->num_rows() > 0) 
			return true;
		return false;
	}

}

/* End of file stockModel.php */
/* Location: ./application/models/stockModel.php */