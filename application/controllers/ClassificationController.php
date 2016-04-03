<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassificationController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('classification/classificationModel');
	}

	public function index()
	{
		
	}

	public function create(){
		$this->form_validation->set_rules('classificationName', 'nome', 'required');	

		if($this->form_validation->run() == TRUE){
			$classification = array(
			'name' => $this->input->post('classificationName'),
			'classification_type' => $this->input->post('classificationType')
			);

			$this->classificationModel->create($classification);
			redirect('financial','refresh');
		}else{
			echo "falho";
		}
	}

	public function update($classification){
		$data = array(
			'id' => $classification,
			'name' => $this->input->post('updateClasname'),
			'classification_type' => $this->input->post('updateClasType')
			);
		$this->classificationModel->update($data);
		redirect('financial','refresh');
	}

	public function delete($classification){
		$data = array('id' => $classification);

		$this->classificationModel->delete($data);
		redirect('financial','refresh');
	}
}

/* End of file classificationController.php */
/* Location: ./application/controllers/classificationController.php */