<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MovimentationController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('people/peopleModel');
		$this->load->model('classification/classificationModel');
		$this->load->model('movimentation/movimentationModel');
	}

	public function index()
	{
		$data['movimentations'] = $this->movimentationModel->get();
		$data['total'] = 0;

		foreach($data['movimentations'] as $movimentation) :

			if($movimentation['type_mov'] == 'e'){
				$data['total'] += $movimentation['value'];
			}else{
				$data['total'] -= $movimentation['value'];
			}

		endforeach;

		$this->template->load('template/templateMenu', 'movimentation/movimentationView', $data);
	}

	public function createMovimentationForm(){
		$data['peoples'] = $this->peopleModel->get();
		$data['classifications'] = $this->classificationModel->get();
		$this->template->load('template/templateMenu', 'movimentation/createMovimentationFormView', $data);
	
	}

	public function createMovimentation(){

		$this->form_validation->set_rules('type', 'type','required');
		$this->form_validation->set_rules('idPeople','idPeople' ,'required');
		$this->form_validation->set_rules('classification', 'classification','required');
		$this->form_validation->set_rules('date', 'date','required');
		$this->form_validation->set_rules('value', 'value','required');
		$this->form_validation->set_rules('historic', 'historic','required');
		$this->form_validation->set_rules('movimentationDate', 'movimentationDate','required');
		$this->form_validation->set_rules('numDoc', 'numDoc','required');


		if ($this->form_validation->run()) {
			$datePick = $this->input->post('date');
			$dateComp = "$datePick-01";
			$data = array(
				'id_people' => $this->input->post('idPeople'),
				'id_classification' => $this->input->post('classification'),
				'type_mov' => $this->input->post('type'),
				'num_doc' => $this->input->post('numDoc'),
				'date_financial_release' => $dateComp,
				'value' => $this->input->post('value'),
				'due_date_pay' => $this->input->post('movimentationDate'),
				'historic' => $this->input->post('historic')
				);

			$this->movimentationModel->create($data);
			redirect('financial-movimentation','refresh');
		}else{

		}
	}

	public function deleteMovimentation(){
		$data = array(
			'id_financial_release' => $this->input->post('DeleteMov')
			);
		
		if($this->movimentationModel->delete($data) > 0){
			redirect('financial-movimentation','refresh');
		}
	}

	public function updateMovimentationForm($idMovimentation){
		$data['movimentation'] = $this->movimentationModel->getUpdateData($idMovimentation);
		$this->template->load('template/templateMenu', 'movimentation/updateMovimentationView', $data);			
	}

	public function updateMovimentation(){
		$this->form_validation->set_rules('type', 'type','required');
		$this->form_validation->set_rules('idPeople','idPeople' ,'required');
		$this->form_validation->set_rules('classification', 'classification','required');
		$this->form_validation->set_rules('date', 'date','required');
		$this->form_validation->set_rules('value', 'value','required');
		$this->form_validation->set_rules('historic', 'historic','required');
		$this->form_validation->set_rules('movimentationDate', 'movimentationDate','required');
		$this->form_validation->set_rules('numDoc', 'numDoc','required');

		
		if($this->form_validation->run()){
			$data = array(
				'id_people' => $this->input->post('idPeople'),
				'id_classification' => $this->input->post('classification'),
				'type_mov' => $this->input->post('type'),
				'num_doc' => $this->input->post('numDoc'),
				'date_financial_release' => $dateComp,
				'value' => $this->input->post('value'),
				'due_date_pay' => $this->input->post('movimentationDate'),
				'historic' => $this->input->post('historic')
				);

		}else{
			
		}
	}

	public function searchMovimentation(){	
		$data = array(
			'id_people' => $this->input->post('searchPeopleId'),
			'date_financial_release' => $this->input->post('searchDate'),
			'type_mov' => $this->input->post('typeSearch')
			);
		
		$query = $this->movimentationModel->searchMovimentation($data);
		echo json_encode($query);
	}
}

/* End of file MovimentationController.php */
/* Location: ./application/controllers/MovimentationController.php */