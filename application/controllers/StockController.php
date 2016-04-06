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
        $data['stock_in'] = $this->StockModel->getInputStocks();
        $data['stock_out'] = $this->StockModel->getOutputStocks();
        $data['view'] = null;
        $this->template->load('template/template','stock/stock/StockHomeView', $data);
        
	}

	public function products() {
		//$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts();
        //$data['stocks'] = $this->StockModel->getStocks();
		$data['view'] = 'products';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function groups() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts();
        $data['stocks'] = $this->StockModel->getStocks();
		$data['view'] = 'groups';
        $this->template->load('template/template','stock/stock/StockHomeView', $data);
	}
    
	public function inputStock() {
		$this->form_validation->set_rules('price_product', 'preço', 'required');
		$this->form_validation->set_rules('amount_product', 'quantidade', 'required');
		$this->form_validation->set_rules('date_product', 'data', 'required');
		$this->form_validation->set_rules('id_product', 'produto', 'required');

		if ($this->form_validation->run()) {
			$stock = array(
				'id_stock_product' => $this->input->post('id_product'),
				'input_type' => $this->input->post('stock_type'),
				'input_date' => $this->input->post('date_product'),
				'unit_price' => $this->input->post('price_product'), 
				'input_amount' => $this->input->post('amount_product'));

			if ($this->StockModel->input($stock)){
				$data['create_success'] = 'Estoque salvo.';
				redirect('stock');
			} 
			else {
				$data['create_error'] = 'Ocorreu algum erro. Tente novamente';
			}
		}
		$data['view'] = 'stock/input';
		$data['products'] = $this->ProductModel->getProducts();
        $this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function outputStock() {
		$this->form_validation->set_rules('amount_product', 'quantidade', 'required');
		$this->form_validation->set_rules('date_product', 'data', 'required');
		$this->form_validation->set_rules('id_product', 'produto', 'required');

		if ($this->form_validation->run()) {
			$stock = array(
				'id_stock_product' => $this->input->post('id_product'),
				'output_date' => $this->input->post('date_product'),
				'output_amount' => $this->input->post('amount_product'));

			if ($this->StockModel->output($stock)){
				$data['create_success'] = 'Estoque salvo.';
				redirect('stock');
			} 
			else {
				$data['create_error'] = 'Ocorreu algum erro. Tente novamente';
			}
		}
		$data['view'] = 'stock/output';
		$data['products'] = $this->ProductModel->getProducts();
        $this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function createGroup() {
		$this->form_validation->set_rules('group_name', 'nome', 'required');
        if ($this->form_validation->run()) {

            $group = array('name_group' => $this->input->post('group_name'));

            if ($this->GroupModel->create($group)) { 
            	$data['create_success'] = 'Categoria salva.';
            	redirect('stock');
            }
            else { 
            	$data['create_error'] = 'Ocorreu algum erro. Tente novamente';
            }
        }
        $data['view'] = 'groups/create';
        $this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function updateGroup() {
		$this->form_validation->set_rules('name', 'nome', 'required');
		if ($this->form_validation->run()) {
			$group_id = $this->uri->segment(4);
			$group = array(
				'id' => $group_id,
				'name' => $this->input->post('name'));

			if($this->GroupModel->update($group)) { 
				$data['create_success'] = 'Categoria salva.';
				redirect('stock/groups');
			}
			else { 
				$data['create_error'] = 'Ocorreu algum erro. Tente novamente';
			}
			$data['groups'] = $this->GroupModel->getGroups();
			$data['view'] = 'groups/update';
        	$this->template->load('template/template','stock/stock/StockHomeView', $data);
		}
	}

	public function deleteGroup() {
		$group = array('id_group' => $this->input->post('id_group'));
		if($this->GroupModel->delete($group)){
			echo true;
		}else{
			echo false;
		}
	}

	public function searchGroup() {
		
	}

	public function createProduct() {
		$this->form_validation->set_rules('product_name', 'nome', 'required');
		$this->form_validation->set_rules('group_id', 'categoria', 'required');

		if ($this->form_validation->run()) {
			$product = array(
				'name_product' => $this->input->post('product_name'),
				'id_group' => $this->input->post('group_id'));

			if ($this->ProductModel->create($product)) { 
				$data['create_success'] = 'Produto salvo.';
				redirect('stock');
			}
			else { 
				$data['create_error'] = 'Ocorreu algum erro. Tente novamente';
			}
		}
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'products/create';
        $this->template->load('template/template','stock/stock/StockHomeView', $data);
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
				$data['create_success'] = 'Produto salvo.';
			}
			else {
				$data['create_error'] = 'Ocorreu algum erro. Tente novamente';
			}
		}
	}

	public function deleteProduct() {
		$product = array('id_product' => $this->input->post('id_product'));
		if($this->ProductModel->delete($product)){
			echo true;
		}else{
			echo false;
		}
	}

	public function searchProduct() {
		
	}
}