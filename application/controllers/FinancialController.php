<?php
defined('BASEPATH') OR exit('No direct script access allowed');

var $sess ='login';

class FinancialController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata($this->sess)){
		    $this->template->load('template/templateMenu', 'financial/financialView');
		}else{
			redirect('login');
		}
	}

}

/* End of file financerController.php */
/* Location: ./application/controllers/financerController.php */