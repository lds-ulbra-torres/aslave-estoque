<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('stock/GroupModel');
		$this->load->model('stock/ProductModel');
		$this->load->model('stock/StockModel');
		$this->load->library('form_validation');
		$this->load->library('cart');
	}

	public function index(){   
		$data['view'] = null;
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function products() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts();
		$data['view'] = 'products';
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function groups() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'groups';
		$data['search_string'] = null;
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function createGroupView() {
		$data['view'] = 'groups/create';
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function updateGroupView() {
		$data['group_data'] = $this->GroupModel->getGroupById($this->uri->segment(4));
		$data['view'] = 'groups/update';
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function createProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'products/create';
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function updateProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['product_data'] = $this->ProductModel->getProductById($this->uri->segment(4));
		$data['view'] = 'products/update';
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function entriesView(){
		$data['input_stocks'] = $this->StockModel->getInputStocks();
		$data['view'] = 'stock/entries';
		$this->template->load('template/template','stock/stock/HomeView', $data);
	}

	public function createEntryView(){
		$data['input_has_products'] = $this->StockModel->getInputHasProducts($this->uri->segment(4));
		$data['view'] = 'stock/entries/create';
		$this->template->load('template/template','stock/stock/HomeView', $data);
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
		if ($this->ProductModel->findProductByForeign($group)){
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
			echo 'Produto apagado. ';
		}
		else { echo 'Ocorreu algum erro. Tente novamente'; }
	}

	/*public function addProductHasEntry() {			
		$id_produto = $this->input->post("id_product");
		$nome_produto = $this->input->post('product_name');
		$quantidade = $this->input->post("amount");
		$preco = $this->input->post("unit_price");		
		
		$data = array(
           'id'      => $id_produto,
           'qty'     => $quantidade,
           'price'   => $preco,
           'name'    => $nome_produto,
           'options' => null
        );

		if ($this->cart->insert($data)) {
			echo 'Inserido.';
		} else {
			echo "Não foi possível inserir. <pre>";
			print_r($data);
			echo "</pre>";				
		}
	}

	public function updateList() {
		$conteudo_postado = $this->input->post();
	
		foreach($conteudo_postado as $conteudo) {
			$dados[] = array(
				"rowid" => $conteudo['rowid'],
				"qty" => $conteudo['qty']
			);
				
		}
		$this->cart->update($dados);
	}

	public function cleanAll() {
		$this->cart->destroy();
	}

	public function createEntry() {
		
	}*/

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
	
	public function createInputStock(){
		$this->form_validation->set_rules('date', 'data', 'required');
		$this->form_validation->set_rules('type', 'tipo', 'required');
		$this->form_validation->set_rules('id_people', 'fornecedor', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'input_date' => $this->input->post('date'),
				'input_type' => $this->input->post('type'),
				'id_people' => $this->input->post('id_people'));
			$query = $this->StockModel->createInputStockPeople($people);
			if($query){
				$id = $query;
				$check = false;
				$product = json_decode($this->input->post('products'));

				foreach ($product as $products) {
					$product_array = array(
						'id_product' => $products->id_product,
						'id_stock' => $id,
						'unit_price' => $products->price,
						'amount' => $products->amount);
					if($this->StockModel->createInputStockProduct($product_array)){
						$check = true;
					}else{
						$check = false;
					}
				}
				if(!$check){
					echo "Erro ao adicionar os produtos";
				}else{
					echo $id;
				}

			}else{
				echo "Erro ao adicionar a pessoa";
			}
		}else{
			echo "Há campos do forncedor que não foram preenchidos!";
		}


	}


}