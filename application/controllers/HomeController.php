<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function index()
	{
		$this->template->load('template/templateMenu','home');
	}
}

/* End of file HomeController.php */
/* Location: ./application/controllers/HomeController.php */