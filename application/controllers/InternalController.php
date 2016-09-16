<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InternalController extends CI_Controller {

    var $sess = 'login';

    public function __construct(){
		parent:: __construct();
		$this->load->model('people/peopleModel');
		$this->load->model('internal/InternalModel');
	}

	public function index()
	{
		if($this->session->userdata($this->sess)){
		    $this->template->load('template/templateMenu','internal/internalView');
		}else{
			redirect('login');
		}
	}

	public function internalCreateView(){
		$data['states'] = $this->peopleModel->states();
	    if($this->session->userdata($this->sess)){
		    $this->template->load('template/templateMenu', 'internal/internalCreateView',$data);
	    }else{
		    redirect('login');
	    }
	}

}

/* End of file InternalController.php */
/* Location: ./application/controllers/InternalController.php */