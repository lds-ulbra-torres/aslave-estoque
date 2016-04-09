<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('stock/GroupModel');
		$this->load->model('stock/ProductModel');
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
		$search_string = $this->input->post('search_string');
		if ($search_string) {
			$data['groups'] = $this->GroupModel->getGroups($search_string);
			$data['view'] = 'groups';
			$data['search_string'] = $search_string;
	        $this->template->load('template/template','stock/stock/StockHomeView', $data);
		}
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

	public function searchProduct() {
		
	}
}