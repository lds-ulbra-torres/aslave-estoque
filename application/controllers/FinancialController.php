<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinancialController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('classification/classificationModel');
		$this->load->model('people/peopleModel');
	}

	public function index()
	{
		$data['classifications'] = $this->classificationModel->get();
		$data['peoples'] = $this->peopleModel->get();
		$this->template->load('template/templateMenu', 'financial/financialView', $data);
	}

}

/* End of file financerController.php */
/* Location: ./application/controllers/financerController.php */