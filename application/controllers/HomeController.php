<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('login')){
			$data['login_user'] = $this->session->userdata('login');
			$this->template->load('template/templateMenu','home', $data);
		}else{
			redirect('login');
		}
		
	}
}

/* End of file HomeController.php */
/* Location: ./application/controllers/HomeController.php */