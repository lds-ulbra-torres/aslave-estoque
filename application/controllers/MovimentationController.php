<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MovimentationController extends CI_Controller {

	var $sess = 'login';
	
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
		$data['totalPositive'] = 0;
		$data['totalNegative'] = 0;

		foreach($data['movimentations'] as $movimentation) :

			if($movimentation['type_mov'] == 'E'){
				$data['totalPositive'] += $movimentation['value'];
			}else{
				$data['totalNegative'] += $movimentation['value'];
			}
		endforeach;
        if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu', 'movimentation/movimentationView', $data);
		}else{
			redirect('login');
		}
	}

	public function createMovimentationForm(){
		$data['peoples'] = $this->peopleModel->get();
		$data['classifications'] = $this->classificationModel->get();
		if($this->session->userdata($this->sess)){  
		    $this->template->load('template/templateMenu', 'movimentation/createMovimentationFormView', $data);
		}else{
			redirect('login');
		}
	
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
			$value = $this->input->post('value');
			$value = str_replace('.', '', "$value");
			$value = str_replace(",", ".", "$value");
			$data = array(
				'id_people' => $this->input->post('idPeople'),
				'id_classification' => $this->input->post('classification'),
				'type_mov' => $this->input->post('type'),
				'num_doc' => $this->input->post('numDoc'),
				'date_financial_release' => $dateComp,
				'value' => $value ,
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
		if($this->session->userdata($this->sess)){
		    $this->template->load('template/templateMenu', 'movimentation/updateMovimentationView', $data);		
		}else{
			redirect('login');
		}	
	}

	public function updateMovimentation($idMovimentation){
		$this->form_validation->set_rules('type', 'type','required');
		$this->form_validation->set_rules('idPeople','idPeople' ,'required');
		$this->form_validation->set_rules('classification', 'classification','required');
		$this->form_validation->set_rules('date', 'date','required');
		$this->form_validation->set_rules('value', 'value','required');
		$this->form_validation->set_rules('historic', 'historic','required');
		$this->form_validation->set_rules('movimentationDate', 'movimentationDate','required');
		$this->form_validation->set_rules('numDoc', 'numDoc','required');
			
		
		if($this->form_validation->run()){
			$datePick = $this->input->post('date');
			$dateComp = "$datePick-01";
			$value = $this->input->post('value');
			$value = str_replace('.', '', "$value");
			$value = str_replace(',', '.', "$value");
			echo "$value";
			$data = array(
				'id_financial_release' => $idMovimentation,
				'id_people' => $this->input->post('idPeople'),
				'id_classification' => $this->input->post('classification'),
				'type_mov' => $this->input->post('type'),
				'num_doc' => $this->input->post('numDoc'),
				'date_financial_release' => $dateComp,
				'value' => $value,
				'due_date_pay' => $this->input->post('movimentationDate'),
				'historic' => $this->input->post('historic')
				);

			if($this->movimentationModel->update($data)){
				redirect('financial-movimentation','refresh');
			}
		}else{
			
		}
	}


	public function searchMovimentation(){	
		$data = array(
			'id_people' => $this->input->post('id_people'),
			'date_financial_release' => $this->input->post('date_financial_release'),
			'type_mov' => $this->input->post('type_mov')
			);

		$query = $this->movimentationModel->searchMovimentation($data);
	
		$arrayName;
		$count = 0;
		foreach ($query as $key) {
			$key['date_financial_release'] = date('m-Y', strtotime($key['date_financial_release']));
			$key['due_date_pay'] = date('d-m-Y', strtotime($key['due_date_pay']));
			$arrayName[$count]= $key;
			$count++;
		}

		echo json_encode($arrayName);
	}
}

/* End of file MovimentationController.php */
/* Location: ./application/controllers/MovimentationController.php */