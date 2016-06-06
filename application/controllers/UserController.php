<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	var $sess = 'login';

	public function __construct() {
		parent::__construct();
		$this->load->model('user/UserModel');
	}


	public function index(){
		if($this->session->userdata($this->sess)){
			redirect('');
		}else{	
			$this->load->view('login');
		}
	}
	public function usersView(){
		if($this->session->userdata($this->sess)){
			$data['users'] = $this->UserModel->getUsers();
			$this->template->load('template/templateMenu','users/UsersView', $data);
		}else{
			redirect('login');
		}	
	}
	public function createUserView(){
		if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu','users/CreateUserView');
		}else{
			redirect('login');
		}
	}
	public function updateUserView() {
		$data['user_data'] = $this->UserModel->getUserById($this->uri->segment(3));
		if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu','users/UpdateUserView', $data);
		}else{
			redirect('login');
		}
	}
	public function login(){
		
		$this->form_validation->set_rules('login', 'nome', 'required');
		$this->form_validation->set_rules('password', 'senha', 'required');

		if($this->form_validation->run()){
			$login = $this->input->post('login');
			$password = md5($this->input->post('password'));
			if($this->UserModel->login($login, $password)){
				if($this->input->post('remember_me')){
					$timeCookie = time() + 36000;
					setcookie('login_aslave', $login, $timeCookie, "/");
					setcookie('password_aslave', $password, $timeCookie, "/");
				}

				$this->session->set_userdata('login', $login);
				echo "1";
			}else{
				echo "Nome de usuário ou senha incorretos.";
			}
		}else{
			echo "Todos os campos são obrigatórios.";
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
	public function createUser(){
		$this->form_validation->set_rules('user_name', 'nome', 'required');
		$this->form_validation->set_rules('user_login', 'login', 'required');
		$this->form_validation->set_rules('user_password', 'senha', 'required');

		if($this->form_validation->run()){
			$user = array(
				'full_name' => $this->input->post('user_name'),
				'login' => $this->input->post('user_login'),
				'password' => md5($this->input->post('user_password')),
				'id_department' => '1'
				);
			if($this->UserModel->checkUser($user)){
				echo "Usuário já cadastrado";
			}else{
				if($this->UserModel->create($user)){
					echo "1";
				}else{
					echo "Ocoreu algum erro ao cadastrar este usuário";
				}
			}
		}else{
			echo "Todos os campos são obrigatórios.";	
		}
	}
	public function deleteUser(){
		$user = array('id_user' => $this->input->post("user"));
		if($this->UserModel->delete($user)){
			echo 'Usuário apagado.';
		} 
		else { echo 'Ocorreu algum problema interno. Tente novamente'; }
	}
	public function updateUser(){
		$this->form_validation->set_rules('full_name', 'nome', 'required');
		$this->form_validation->set_rules('login', 'login', 'required');
		$this->form_validation->set_rules('confirm_password', 'senha', 'required');

		if($this->form_validation->run()){
			$change_password = $this->input->post("confirm_password");
			if($change_password == "1"){
				$user = array(
					'id_user' => $this->input->post("id_user"),
					'full_name' => $this->input->post("full_name"),
					'login' => $this->input->post("login"),
					'password' => md5($this->input->post("password"))
					);
			}else{
				$user = array(
					'id_user' => $this->input->post("id_user"),
					'full_name' => $this->input->post("full_name"),
					'login' => $this->input->post("login")
					);
			}

			if($this->UserModel->update($user)){
				echo "1";
			}else{
				echo "Ocoreu algum erro interno.";
			}
		}else{
			echo "Todos os campos são obrigatórios.";
		}	
	}
	public function searchUser(){
		$search = $this->input->post('search');
		$result = $this->UserModel->getUserSearch($search);
		echo json_encode($result);
	}
}
