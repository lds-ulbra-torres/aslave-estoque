<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stock/GroupModel');
		$this->load->model('stock/ProductModel');
		$this->load->model('stock/StockModel');
		$this->load->library('form_validation');
	}

	public function index(){   
		$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts();
        $data['stocks'] = $this->StockModel->getStocks();
        $this->template->load('template/templateMenu','stock/StockView', $data);
	}
    
	public function inputStock() {
		$this->form_validation->set_rules('stock_price', 'preço', 'required');
		$this->form_validation->set_rules('stock_amount', 'quantidade', 'required');
		$this->form_validation->set_rules('stock_date', 'data', 'required');

		if ($this->form_validation->run()) {
			$amount = $this->input->post('stock_amount');
			$price = $this->input->post('stock_price');
			$total = $amount*$price;

			$stock = array(
				'id_stock_product' => $this->input->post('stock_product'),
				'input' => $this->input->post('stock_date'),
				'price' => $price, 
				'amount' => $amount,
				'total' => $total);

			if ($this->StockModel->create($stock)){
				echo 'deu bom.';
			} 
			else {
				echo 'deu ruim';
			}
		}
	}

	public function outputStock() {

	}

	public function createGroup() {
		$this->form_validation->set_rules('group_name', 'nome', 'required');
        if ($this->form_validation->run()) {

            $group = array('name_group' => $this->input->post('group_name'));

            if ($this->GroupModel->create($group)) { echo true; }
            else { echo false; }
        } 
	}

	public function updateGroup() {
		$id = null;  //receber id do grupo para alterar

		$this->form_validation->set_rules('name', 'nome', 'required');
		if ($this->form_validation->run()) {

			$group = array(
				'id' => $id,
				'name' => $this->input->post('name'));

			if($this->GroupModel->update($group)) { 
				echo 'deu bom.'; 
			}
			else { 
				echo 'deu ruim.'; 
			}
		}
	}

	public function searchGroup() {
		
	}

	public function createProduct() {
		$this->form_validation->set_rules('product_name', 'nome', 'required');
		$this->form_validation->set_rules('id_group', 'grupo', 'required');

		if ($this->form_validation->run()) {
			$product = array(
				'name_product' => $this->input->post('product_name'),
				'id_group' => $this->input->post('id_group'));

			if ($this->ProductModel->create($product)) { 
				echo 'deu bom.'; 
			}
			else { 
				echo 'deu ruim.'; 
			}
		}
	}

	public function updateProduct() {
		$id = null;  //receber id do produto para alterar

		$this->form_validation->set_rules('product_name', 'nome', 'required');
		$this->form_validation->set_rules('id_group', 'grupo', 'required');
		if ($this->form_validation->run()) {
			$product = array(
				'name_product' => $this->input->post('product_name'),
				'id_group' => $this->input->post('id_group'));

			if ($this->ProductModel->update($product)){
				echo 'deu bom.';
			}
			else {
				echo 'deu ruim.';
			}
		}
	}

	public function searchProduct() {
		
	}
}