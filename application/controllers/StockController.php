<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

	var $sess = 'login';

	public function __construct() {
		parent::__construct();
		$this->load->model('stock/GroupModel');
		$this->load->model('stock/ProductModel');
		$this->load->model('stock/StockModel');
	}

	public function index(){
		if($this->session->userdata($this->sess)){
			$data = null;
			$this->template->load('template/templateMenu','stock/stock/StartView', $data);
		}else{
			redirect('login');
		}
	}

/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
* CATEGORIAS
**/
	public function groups($init = 0) {
		$max = 10;
		$init = (!$this->uri->segment('3')) ? 0 : $this->uri->segment('3');
		$config['base_url'] = base_url('stock/groups');
		$config['total_rows'] = $this->GroupModel->getRowsCount();
		$config['per_page'] = $max;
		$config['full_tag_open'] = '<div class="pagination">
		<ul class="pagination center-align">';
			$config['full_tag_close'] = '   </ul>
		</div>';

		$config['first_link'] = 'Primeiro';
		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Último';
		$config['last_tag_open'] = '<li class="waves-effect">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="active material-icons">arrow_forward</i>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="active material-icons">arrow_back</i>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li style="color:#blue;  font-size: 200%;" class="waves-effect">';
		$config['cur_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['pagination_show'] =  $this->pagination->create_links();

		$data['groups'] = $this->GroupModel->getGroups($max, $init);
		$data['search_string'] = null;
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/group/GroupView', $data);
		}else{
			redirect('login');
		}
	}

	public function createGroupView() {
		$data['view'] = 'groups/create';
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/group/CreateGroupView', $data);
		}else{
			redirect('login');
		}
	}

	public function updateGroupView() {
		$data['group_data'] = $this->GroupModel->getGroupById($this->uri->segment(4));
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/group/UpdateGroupView', $data);
		}else{
			redirect('login');
		}
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

/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
* PRODUTOS
**/
	public function products($init=0) {
		$max = 20;
		$init = (!$this->uri->segment('3')) ? 0 : $this->uri->segment('3');
		$config['base_url'] = base_url('stock/products');
		$config['total_rows'] = $this->ProductModel->getRowsCount();
		$config['per_page'] = $max;
		$config['full_tag_open'] = '<div class="pagination">
		<ul class="pagination center-align">';
			$config['full_tag_close'] = '   </ul>
		</div>';

		$config['first_link'] = 'Primeiro';
		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Último';
		$config['last_tag_open'] = '<li class="waves-effect">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="active material-icons">arrow_forward</i>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="active material-icons">arrow_back</i>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li style="color:#blue;  font-size: 200%;" class="waves-effect">';
		$config['cur_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['pagination_show'] =  $this->pagination->create_links();

		$data['groups'] = $this->GroupModel->getGroups();
		$data['products'] = $this->ProductModel->getProducts($max, $init);
		$data['view'] = 'products';
		$data['search_string'] = null;

		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/product/ProductView', $data);
		}else{
			redirect('login');
		}
	}

	public function createProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['view'] = 'products/create';
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/product/CreateProductView', $data);
		}else{
			redirect('login');
		}
	}

	public function updateProductView() {
		$data['groups'] = $this->GroupModel->getGroups();
		$data['product_data'] = $this->ProductModel->getProductById($this->uri->segment(4));
		$data['view'] = 'products/update';
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/product/UpdateProductView', $data);
		}else{
			redirect('login');
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

/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
* FILTROS
**/
	public function searchPeople(){
		$result = $this->StockModel->getPeople();
		header('Content-type: application/json');
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
			$product = $this->input->post('search_string');
			$group = $this->input->post('group');
			$result = $this->ProductModel->search($product, $group);
			echo json_encode($result);
	}
	/*public function searchProductByGroup(){
		$this->form_validation->set_rules('id_group', 'grupo', 'required');
		if($this->form_validation->run()){
			$group = $this->input->post('id_group');
			$result = $this->ProductModel->searchByGroup($group);
			echo json_encode($result);
		}else{
			echo "Você esta tentando sabotar site?";
		}
	}*/

	public function searchProductStock() {
		$result = $this->StockModel->getProductSearch();
		header('Content-type: application/json');
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

	public function searchInputStockByAll(){
		$this->form_validation->set_rules('dateFrom', 'de', 'required');
		$this->form_validation->set_rules('dateTo', 'a', 'required');
		if($this->form_validation->run()){
			$from = new DateTime($this->input->post('dateFrom'));
			$to = new DateTime($this->input->post('dateTo'));
			if($from > $to){
				echo "-1";
			}else{
				$StringFrom = $from->format("Y-m-d");
				$StringTo = $to->format("Y-m-d");
				$data = array(
					'people' => $this->input->post('people'),
					'input_type' => $this->input->post('input_type'),
					'from' => $StringFrom,
					'to' => $StringTo
					);
				$query =  $this->StockModel->searchStockByAllWithDate($data);
				echo json_encode($query);
			}
		}else{
			$data = array(
				'people' => $this->input->post('people'),
				'input_type' => $this->input->post('input_type')
				);
			$query1 =  $this->StockModel->searchStockByAllWithoutDate($data);
			echo json_encode($query1);
		}
	}

/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
* ENTRADAS DE ESTOQUE
**/
	public function entriesView(){
		$data['input_stocks'] = $this->StockModel->getInputStocks();
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/stock/in/EntriesView', $data);
		}else{
			redirect('login');
		}
	}

	public function createEntryView(){
		$data = null;
		if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu','stock/stock/in/CreateEntryView', $data);
		}else{
			redirect('login');
		}
	}

	public function detailedEntryView() {
		$id_stock = $this->uri->segment(3);
		$data['entry_data'] = $this->StockModel->getDetailedEntry($id_stock);
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/stock/in/DetailedEntryView', $data);
		}else{
			redirect('login');
		}
	}

	public function createInputStock() {
		$this->form_validation->set_rules('date', 'data', 'required');
		$this->form_validation->set_rules('type', 'tipo', 'required');
		$this->form_validation->set_rules('id_people', 'fornecedor', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'input_date' => $this->input->post('date'),
				'input_type' => $this->input->post('type'),
				'id_people' => $this->input->post('id_people'));

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

	public function updateEntryView(){
		$id_stock = $this->uri->segment(4);
		$data['view'] = 'stock/entries/detailed';
		$data['entry_data'] = $this->StockModel->getDetailedEntry($id_stock);
		if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu','stock/stock/in/UpdateEntryView', $data);
		}
		else{
			redirect('login');
		}
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

	public function removeProductInputStock(){
		$id_product = array('id_product' => $this->input->post('id_product'));
		if ($this->StockModel->removeProductStock($id_product)) {
			echo true;
		}else { echo "Erro ao remover este produto"; }
	}

	public function insertProductsInputStock(){
		$this->form_validation->set_rules('id_stock', 'estoque', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'input_date' => $this->input->post('date'),
				'input_type' => $this->input->post('type'),
				'id_people' => $this->input->post('id_people'));

			$product = json_decode($this->input->post('products'));
			if (sizeof($product) > 0) {
				$product_array = array();
				foreach ($product as $products) {
					$row = array(
						'id_product' => $products->id_product,
						'id_stock' => $this->input->post('id_stock'),
						'unit_price_input' => $products->price,
						'amount_input' => $products->amount);
					array_push($product_array, $row);
				}
				if ($this->StockModel->createInputStockProduct($product_array)) {
					echo 1;
				}
				else { echo "Erro ao salvar os produtos."; }
			}
			else { echo "Nenhum produto adicionado."; }
		}
		else { echo "Ocorreu algum problema interno."; }
		$delete_products = ($this->input->post('delete_produto'));
		if($delete_products > 0){
			foreach ($delete_products as $key => $delete_product) {
				$id_produto = preg_replace("/[^0-9]/", "", $delete_product);
				if ($this->StockModel->removeProductStock($id_produto)) {
					echo 1;
				}else { echo "Erro ao remover os produtos"; }
			}

		}
	}

/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
* SAÍDAS DE ESTOQUE
**/
	public function outputsView(){
		$data['output_stocks'] = $this->StockModel->getOutputStocks();
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/stock/out/OutputsView', $data);
		}else{
			redirect('login');
		}
	}

	public function createOutputView() {
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/stock/out/CreateOutputView');
		}else{
			redirect('login');
		}
	}

	public function detailedOutputView() {
		$id_stock = $this->uri->segment(3);
		$data['output_data'] = $this->StockModel->getDetailedOutput($id_stock);
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','stock/stock/out/DetailedOutputView', $data);
		}else{
			redirect('login');
		}
	}

	public function updateOutputView(){
		$id_stock = $this->uri->segment(4);
		$data['output_data'] = $this->StockModel->getDetailedOutput($id_stock);
		if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu','stock/stock/out/UpdateOutputView', $data);
		}
		else{
			redirect('login');
		}
	}

	public function createOutputStock() {
		$this->form_validation->set_rules('date', 'data', 'required');
		$this->form_validation->set_rules('id_people', 'fornecedor', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'output_date' => $this->input->post('date'),
				'descript' => $this->input->post('descript'),
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

	public function removeProductOutputStock(){
		$id_product = array('id_product' => $this->input->post('id_product'));
		if ($this->StockModel->removeProductOutputStock($id_product)) {
			echo true;
		}else { echo "Erro ao remover este produto"; }
	}

	public function insertProductsOutputStock(){
		$this->form_validation->set_rules('id_stock', 'estoque', 'required');
		if ($this->form_validation->run()) {
			$people = array(
				'input_date' => $this->input->post('date'),
				'input_type' => $this->input->post('type'),
				'id_people' => $this->input->post('id_people'));

			$product = json_decode($this->input->post('products'));
			if (sizeof($product) > 0) {
				$product_array = array();
				foreach ($product as $products) {
					$row = array(
						'id_product' => $products->id_product,
						'id_stock' => $this->input->post('id_stock'),
						'unit_price_output' => $products->price,
						'amount_output' => $products->amount);
					array_push($product_array, $row);
				}
				if ($this->StockModel->createOutputStockProduct($product_array)) {
					echo 2;
				}
				else { echo "Erro ao salvar os produtos."; }
			}
			else { echo "Nenhum produto adicionado."; }
		}
		else { echo "Ocorreu algum problema interno."; }
	}

}
