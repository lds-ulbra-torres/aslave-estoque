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
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	/* CATEGORIAS */
	public function groups() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'groups';
		$data['search_string'] = null;
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function createGroupView() {
		$data['view'] = 'groups/create';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function updateGroupView() {
		$data['group_data'] = $this->GroupModel->getGroupById($this->uri->segment(4));
		$data['view'] = 'groups/update';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
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

	/* PRODUTOS */
	public function products() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts();
		$data['view'] = 'products';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function createProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'products/create';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function updateProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['product_data'] = $this->ProductModel->getProductById($this->uri->segment(4));
		$data['view'] = 'products/update';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
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
		if ($this->StockModel->findStockByForeign($product)){
			echo 'Este produto está sendo usado.';
		} 
		else {
			if($this->ProductModel->delete($product)){
				echo 'Produto apagado.';
			} 
			else { echo 'Ocorreu algum problema interno. Tente novamente'; }
		}
	}

	/* FILTROS */
	public function searchPeople(){
		$search = $this->input->post('name_people');
		$result = $this->StockModel->getPeople($search);
		echo json_encode($result);
	}
	public function searchGroup(){
		$this->form_validation->set_rules('search_string', 'grupo', 'required');
		if($this->form_validation->run()){
			$group = $this->input->post('search_string');
			$result = $this->GroupModel->search($group);
			echo json_encode($result);	
		}else{
			echo "O campo de busca esta vazio";
		}
	}
	public function searchProduct(){
		$this->form_validation->set_rules('search_string', 'produto', 'required');
		if($this->form_validation->run()){
			$product = $this->input->post('search_string');
			$result = $this->ProductModel->search($product);
			echo json_encode($result);	
		}else{
			echo "O campo de busca esta vazio";
		}
	}
	public function searchProductByGroup(){
		$this->form_validation->set_rules('id_group', 'grupo', 'required');
		if($this->form_validation->run()){
			$group = $this->input->post('id_group');
			$result = $this->ProductModel->searchByGroup($group);
			echo json_encode($result);	
		}else{
			echo "Você esta tentando sabotar site?";
		}
	}

	public function searchProductStock() {
		$search = $this->input->post('name_product');
		$result = $this->StockModel->getProductSearch($search);
		echo json_encode($result);
	}
	public function searchStockInputByPeople(){
		$this->form_validation->set_rules('search_string', 'pessoa', 'required');
		if($this->form_validation->run()){
			$people = $this->input->post('search_string');
			$result = $this->StockModel->searchInputByPeople($people);
			echo json_encode($result);	
		}else{
			echo "O campo de busca esta vazio";
		}
	}
	public function searchInputStockByType(){
		$this->form_validation->set_rules('input_type', 'tipo', 'required');
		if($this->form_validation->run()){
			$type = $this->input->post('input_type');
			$result = $this->StockModel->searchByType($type);
			echo json_encode($result);	
		}else{
			echo "Você esta tentando sabotar site?";
		}
	}
	public function searchStockOutputByPeople(){
		$this->form_validation->set_rules('search_string', 'pessoa', 'required');
		if($this->form_validation->run()){
			$people = $this->input->post('search_string');
			$result = $this->StockModel->searchOutputByPeople($people);
			echo json_encode($result);	
		}else{
			echo "O campo de busca esta vazio";
		}
	}
	public function searchInputStockByDate(){
		$this->form_validation->set_rules('from', 'de', 'required');
		$this->form_validation->set_rules('to', 'a', 'required');
		if($this->form_validation->run()){
			$from = date('Y-m-d', strtotime($this->input->post('from')));
			$to = date('Y-m-d', strtotime($this->input->post('to')));
			if($to < $from){
				echo "As datas devem estar em ordem crescente";
			}else if($to > date("Y-m-d")){
				echo "Data invalida";
			}else{
				$result = $this->StockModel->searchStockByDate($from, $to);
				echo json_encode($result);
			}
		}else{
			echo "Todos os campos são obrigatórios";
		}
	}
	/* ENTRADAS DE ESTOQUE */
	public function entriesView(){
		$data['input_stocks'] = $this->StockModel->getInputStocks();
		$data['view'] = 'stock/entries';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function createEntryView(){
		$data['view'] = 'stock/entries/create';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function detailedEntryView() {
		$id_stock = $this->uri->segment(3);
		$data['view'] = 'stock/entries/detailed';
		$data['entry_data'] = $this->StockModel->getDetailedEntry($id_stock);
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function createInputStock() {
		$this->form_validation->set_rules('date', 'data', 'required');
		$this->form_validation->set_rules('type', 'tipo', 'required');
		$this->form_validation->set_rules('id_people', 'fornecedor', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'input_date' => $this->input->post('date'),
				'input_type' => $this->input->post('type'),
				'id_people' => $this->input->post('id_people'),
				'sum_value' => $this->input->post('sum_value'));

			$product = json_decode($this->input->post('products'));
			if (sizeof($product) > 0) {
				$query = $this->StockModel->createInputStockPeople($people);
				if ($query) {
					$id = $query;
					$check = false;
					$product_array = array();
					foreach ($product as $products) {
						$row = array(
							'id_product' => $products->id_product,
							'id_stock' => $id,
							'unit_price_input' => $products->price,
							'amount_input' => $products->amount);
						array_push($product_array, $row);
					}
					if ($this->StockModel->createInputStockProduct($product_array)) {
						echo $id;
					}
					else { echo "Erro ao salvar os produtos."; }
				}
				else { echo "Erro ao salvar o fornecedor."; }
			}
			else { echo "Nenhum produto adicionado."; }
		}
		else { echo "Todos os campos são obrigatórios."; }
	}

	public function deleteInputStock() {
		$id_stock = array('id_stock' => $this->input->post('id_stock'));
		if ($this->StockModel->deleteInputStockProduct($id_stock)) {
			if ($this->StockModel->deleteInputStock($id_stock)) {
				echo "Entrada de estoque apagada.";
			}
			else { echo "Erro ao apagar esta entrada. "; }
		}
		else { echo "Erro ao apagar esta entrada. "; }
	}

	/* SAÍDAS DE ESTOQUE */
	public function outputsView(){
		$data['output_stocks'] = $this->StockModel->getOutputStocks();
		$data['view'] = 'stock/outputs';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function createOutputView() {
		$data['view'] = 'stock/outputs/create';
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function detailedOutputView() {
		$id_stock = $this->uri->segment(3);
		$data['view'] = 'stock/outputs/detailed';
		$data['output_data'] = $this->StockModel->getDetailedOutput($id_stock);
		$this->template->load('template/templateMenu','stock/stock/HomeView', $data);
	}

	public function createOutputStock() {
		$this->form_validation->set_rules('date', 'data', 'required');
		$this->form_validation->set_rules('id_people', 'fornecedor', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'output_date' => $this->input->post('date'),
//descrição, descomentar quando tiver no banco 'descript' => $this->input->post('descript'),
				'sum_value' => $this->input->post('sum_value'),
				'id_people' => $this->input->post('id_people'));
			$product = json_decode($this->input->post('products'));
			if (sizeof($product) > 0) {
				if ($id = $this->StockModel->createOutputStockPeople($people)) {
					$check = false;
					$product_array = array();
					foreach ($product as $products) {
						$row = array(
							'id_product' => $products->id_product,
							'id_stock' => $id,
							'unit_price_output' => $products->price,
							'amount_output' => $products->amount);
						array_push($product_array, $row);
					}
					if ($this->StockModel->createOutputStockProduct($product_array)) {
						echo $id;
					}
					else { echo "Erro ao salvar os produtos."; }
				}
				else { echo "Erro ao salvar o fornecedor."; }
			} 
			else { echo "Nenhum produto adicionado."; }
		}
		else { echo "Todos os campos são obrigatórios."; }
	}

	public function deleteOutputStock() {
		$id_stock = array('id_stock' => $this->input->post('id_stock'));
		if ($this->StockModel->deleteOutputStockProduct($id_stock)) {
			if ($this->StockModel->deleteOutputStock($id_stock)) {
				echo "Saída de estoque apagada.";
			}
			else { echo "Erro ao apagar esta saída. "; }
		}
		else { echo "Erro ao apagar esta saída. "; }
	}

}
