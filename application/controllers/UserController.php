<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UserModel');
	}


	public function index(){
		if($this->session->userdata('login')){
			redirect('');
		}else{	
			$this->load->view('login');
		}
	}

	public function login(){
		
		$this->form_validation->set_rules('login', 'nome', 'required');
		$this->form_validation->set_rules('password', 'senha', 'required');

		if($this->form_validation->run()){
			$login = $this->input->post('login');
			$password = $this->input->post('password');
			if($this->UserModel->login($login, $password)){
				if($this->input->post('remember_me')){
					$timeCookie = time() + 36000;
					setcookie('login_aslave', $login, $timeCookie, "/");
					setcookie('password_aslave', $password, $timeCookie, "/");
				}

				$this->session->set_userdata('login', $login);
				echo "1";
			}else{
				echo "Usuário não encontrado";
			}
		}else{
			echo "Todos os campos são obrigatórios.";
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}