<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleController extends CI_Controller {


	public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->model('people/peopleModel');
	}


	public function index()
	{

	}

	public function create(){
		/*Nao Funciono
		$this->form_validation->set_rules('peopleName','nome','required|alpha');
		$this->form_validation->set_rules('peopleAdress','endereco','required');
		$this->form_validation->set_rules('peopleNumber','numero','required');
		$this->form_validation->set_rules('peopleNeighborhood','bairro','required');
		$this->form_validation->set_rules('peopleCity','cidade','required');
		$this->form_validation->set_rules('peopleState','estado','required');
		$this->form_validation->set_rules('peopleCep','cep','required');
		$this->form_validation->set_rules('peopleDateBirth','dataNascimento','required');
		$this->form_validation->set_rules('peoplePhone1','telefone1','required');
		$this->form_validation->set_rules('peoplePhone2','telefone2','required');*/

	
		$people = array(
			'name' => $this->input->post('peopleName'),
			'cpf' => $this->input->post('peopleCpf'),
			'cnpj' => $this->input->post('peopleCnpj'),
			'rg' => $this->input->post('peopleRg'),
			'inscricao_estadual' => $this->input->post('peopleInscricaoEstadual'),
			'adress' => $this->input->post('peopleAdress'),
			'number' => $this->input->post('peopleNumber'),
			'neighborhood' => $this->input->post('peopleNeighborhood'),
			'city' => $this->input->post('peopleCity'),
			'state' => $this->input->post('peopleState'),
			'cep' => $this->input->post('peopleCep'),
			'date_birth' => $this->input->post('peopleDateBirth'),
			'phone1' => $this->input->post('peoplePhone1'),
			'phone2' => $this->input->post('peoplePhone2'),

			);

		$this->peopleModel->create($people);
		redirect ('financial','refresh');
	}

	public function delete($people){
		$data = array('id' => $people);
		$this->peopleModel->delete($data);
		redirect('financial','refresh');
	}

}
