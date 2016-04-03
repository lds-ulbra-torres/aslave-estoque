<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockModel extends CI_Model {

	var $table = 'stock';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function create($stock) {
		return $this->db->insert($this->table, $stock);
	}

	public function update($stock) {
		$this->db->where('id', $stock['id']);
		return $this->db->update($this->table, $stock);
	}

	public function delete($stock) {
		return $this->db->delete($this->table, $stock);
	}

	public function getStocks() {
		$this->db->join('products', 'stock.id_stock_product = products.id_product', 'inner');
		$this->db->join('product_groups', 'products.id_group = product_groups.id_group', 'inner');
		//$this->db->order_by('name', 'asc');
		return $this->db->get($this->table)->result_array();
	}

	public function getStockById($id) {
		$this->db->where('id', $id);
		$stock_data = $this->db->get();
		return $stock_data->result_array(); 
	}


}

/* End of file stockModel.php */
/* Location: ./application/models/stockModel.php */