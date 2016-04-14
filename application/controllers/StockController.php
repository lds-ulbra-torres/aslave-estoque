<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('stock/GroupModel');
		$this->load->model('stock/ProductModel');
		$this->load->model('stock/StockModel');
		$this->load->library('form_validation');
	}

	public function index(){   
		$data['view'] = null;
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function products() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts();
		$data['view'] = 'products';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function groups() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'groups';
		$data['search_string'] = null;
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function createGroupView() {
		$data['view'] = 'groups/create';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function updateGroupView() {
		$data['group_data'] = $this->GroupModel->getGroupById($this->uri->segment(4));
		$data['view'] = 'groups/update';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function createProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'products/create';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function updateProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['product_data'] = $this->ProductModel->getProductById($this->uri->segment(4));
		$data['view'] = 'products/update';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function inputStockView(){
		$data['input_stocks'] = $this->StockModel->getInputStocks();
		$data['view'] = 'stock/input';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function createInputStockView(){
		$data['input_has_products'] = $this->StockModel->getInputHasProducts($this->uri->segment(4));
		$data['view'] = 'stock/input/create';
		$this->template->load('template/template','stock/stock/StockHomeView', $data);
	}

	public function createGroup() {
		$this->form_validation->set_rules('group_name', 'nome', 'required');
		if ($this->form_validation->run()) {

			$group = array('name_group' => $this->input->post('group_name'));

			if ($this->GroupModel->create($group)) { 
				echo 'Categoria salva.';
			} 
			else { echo  'Ocorreu um problema interno. Tente novamente'; }
		} 
		else { echo 'Todos campos são obrigatórios.'; }
	}

	public function updateGroup() {
		$this->form_validation->set_rules('group_name', 'nome', 'required');
		if ($this->form_validation->run()) {
			$group = array(
				'id_group' => $this->input->post('group_id'),
				'name_group' => $this->input->post('group_name'));

			if($this->GroupModel->update($group)) { 
				echo 'Categoria salva.';
			}
			else { echo 'Ocorreu algum problema interno. Tente novamente'; }
		}
		else { echo 'Todos campos são obrigatórios.'; }
	}

	public function deleteGroup() {
		$group = array('id_group' => $this->input->post('id_group'));
		$query = $this->db->get_where('stock_products', $group);
		if ($query->num_rows() > 0){
			echo 'Há produtos cadastrados com esta categoria. Não foi possível apagar';
		} 
		else {
			if($this->GroupModel->delete($group)){
				echo 'Categoria apagada.';
			} 
			else { echo 'Ocorreu algum problema interno. Tente novamente'; }
		}
	}

	public function createProduct() {
		$this->form_validation->set_rules('product_name', 'nome', 'required');
		$this->form_validation->set_rules('group_id', 'categoria', 'required');

		if ($this->form_validation->run()) {
			$product = array(
				'name_product' => $this->input->post('product_name'),
				'id_group' => $this->input->post('group_id'));

			if ($this->ProductModel->create($product)) { 
				echo 'Produto salvo.';
			}
			else { echo 'Ocorreu algum problema interno. Tente novamente'; }
		}
		else { echo 'Todos os campos são obrigatórios.'; }
	}

	public function updateProduct() {
		$this->form_validation->set_rules('product_name', 'nome', 'required');
		$this->form_validation->set_rules('group_id', 'grupo', 'required');
		if ($this->form_validation->run()) {
			$product = array(
				'id_product' => $this->input->post('product_id'),
				'name_product' => $this->input->post('product_name'),
				'id_group' => $this->input->post('group_id'));

			if ($this->ProductModel->update($product)){
				echo 'Produto salvo.';
			}
			else { echo 'Ocorreu algum problema interno. Tente novamente'; }
		}
		else { echo 'Todos campos são obrigatórios.'; }
	}

	public function deleteProduct() {
		$product = array('id_product' => $this->input->post('id_product'));
		if($this->ProductModel->delete($product)){
			echo true;
		}
		else { echo false; }
	}

	public function searchPeople(){
		$search = $this->input->post('name_people');
		$result = $this->StockModel->getPeople($search);
		echo json_encode($result);
	}

	public function searchProductStock(){
		$search = $this->input->post('name_product');
		$result = $this->StockModel->getProductSearch($search);
		echo json_encode($result);
	}

	public function createInputStock() {
		$this->form_validation->set_rules('id_people', 'Fornecedor', 'required');
		$this->form_validation->set_rules('date_people', 'Data', 'required');
		if ($this->form_validation->run()) {
			$input_stock = array(
				'id_people' => $this->input->post('id_people'), 
				'input_date' => $this->input->post('date_people'),
				'input_type' => $this->input->post('stock_type'));
			if ($query = $this->StockModel->create($input_stock, 'stock_input')) {
				echo $query;
			}
			else { echo 'Ocorreu um erro interno. Tente novamente'; }
		} 
		else { echo 'Todos campos são obrigatórios.'; }
	}
	public function createInputStockProductController(){
		$this->form_validation->set_rules('id_product', 'Produto', 'required');
		$this->form_validation->set_rules('unit_price', 'Preco', 'required');
		$this->form_validation->set_rules('amount', 'Quantidade', 'required');
		if ($this->form_validation->run()) {
			$input_stock_product = array(
				'id_product' => $this->input->post('id_product'), 
				'unit_price' => $this->input->post('unit_price'),
				'amount' => $this->input->post('amount'),
				'id_stock' => $this->input->post('id_stock'));
			if ($query = $this->StockModel->createInputStockProduct($input_stock_product, 'stock_input_products')) {
				echo "Produto cadastrado com sucesso!";
			}
			else { echo 'Ocorreu um erro interno. Tente novamente'; }
			} 
			else { echo 'Todos campos são obrigatórios.'; }
			}

			public function deleteProductInputStock(){
				$product = array('id_product' => $this->input->post('idProdutoStock'));
				if($this->StockModel->deleteProductInputStockModel($product)){
					echo true;
				}
				else {
					echo false;
				} 
			}
}