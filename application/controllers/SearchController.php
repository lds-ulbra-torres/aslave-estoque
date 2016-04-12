<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchController extends CI_Controller {

	public function index()
	{
		$this->load->view('template/templateSearch');

	}
	public function buscar(){
		$this->load->model('search/SearchModel');
		$search=  $this->input->post('name_people');
		$query = $this->SearchModel->getNamePeople($search);
		echo json_encode ($query);
	}


}

/* End of file SearchController.php */
/* Location: ./application/controllers/SearchController.php */