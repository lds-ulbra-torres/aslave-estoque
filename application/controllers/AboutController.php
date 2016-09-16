<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutController extends CI_Controller {

	public function index()
	{	
		if($this->session->userdata($this->sess)){
		    $this->template->load('template/templateMenu', 'about/aboutView');
		}else{
			redirect('login');
		}
	}

}

