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
		$data['classifications'] = $this->classificationModel->get();
		$this->template->load('template/templateMenu', 'classification/classificationView', $data);
	}

	public function create(){
		$this->form_validation->set_rules('classificationName', 'nome', 'required');	

		if($this->form_validation->run() == TRUE){
			$classification = array(
			'name' => $this->input->post('classificationName'),
			'classification_type' => $this->input->post('classificationType')
			);

			$this->classificationModel->create($classification);
			redirect('classification','refresh');
		}else{
			echo "falho";
		}
	}

	public function update(){
		$data = array(
			'id' => $this->input->post('updateClasId'),
			'name' => $this->input->post('updateClasName'),
			'classification_type' => $this->input->post('updateClasType')
			);
		$this->classificationModel->update($data);
		redirect('classification','refresh');
	}

	public function delete($classification){
		$data = array('id' => $classification);

		$this->classificationModel->delete($data);
		redirect('classification','refresh');
	}
}

/* End of file classificationController.php */
/* Location: ./application/controllers/classificationController.php */