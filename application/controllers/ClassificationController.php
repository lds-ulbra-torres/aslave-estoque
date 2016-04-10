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

	public function createForm(){
		$this->template->load('template/templateMenu', 'classification/createClassificationView');
	}

	public function create(){

			$classification = array(
				'name' => $this->input->post('classificationName'),
				'classification_type' => $this->input->post('classificationType')
				);

			    $this->classificationModel->create($classification);
		    	redirect('classification');
	}

	public function updateForm($classification){
		$data['classification'] = $classification;

		$this->template->load('template/templateMenu', 'classification/updateClassificationView', $data);
	}

	public function update($id){
			$data = array(
				'id_classification' => $id,
				'name' => $this->input->post('updateClasName'),
				'classification_type' => $this->input->post('updateClasType')
				);
			$this->classificationModel->update($data);
			redirect('classification','refresh');
	}

	public function delete(){
		$data = array('id' => $this->input->post('idDeleteClass'));

		$this->classificationModel->delete($data);
		redirect('classification','refresh');
	}
}

/* End of file classificationController.php */
/* Location: ./application/controllers/classificationController.php */