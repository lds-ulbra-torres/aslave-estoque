<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleController extends CI_Controller {

	var $sess = 'login';

	public function __construct(){
		parent:: __construct();
		$this->load->model('people/PeopleModel');
		$this->load->model('people/CitieModel');
	}

	public function index() {
		if($this->session->userdata($this->sess)){

		}
		else {
			redirect('login');
		}
	}

	public function people($init = 0) {
		$this->load->library('pagination');
		$max = 10;
		$init = (!$this->uri->segment('2')) ? 0 : $this->uri->segment('2');
		$config['base_url'] = base_url('people');
		$config['total_rows'] = $this->PeopleModel->count_register();
		$config['per_page'] = $max;

		$config['full_tag_open'] = '<div class="pagination">
		<ul class="pagination center-align">';
			$config['full_tag_close'] = '   </ul>
		</div>';

		$config['first_link'] = 'Primeiro';
		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Último';
		$config['last_tag_open'] = '<li class="waves-effect">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '<i class="active material-icons">arrow_forward</i>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '<i class="active material-icons">arrow_back</i>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li style="color:#blue;  font-size: 200%;" class="waves-effect">';
		$config['cur_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$data['pagination_show'] =  $this->pagination->create_links();
		$data['peoples'] = $this->PeopleModel->get_pagination($max, $init);
		if($this->session->userdata($this->sess)) {
			$this->template->load('template/templateMenu', 'people/peopleView', $data);
		}
		else {
			redirect('login');
		}
	}

	public function detailedPerson() {
		$id_person = $this->uri->segment(2);
		$array = $this->PeopleModel->getPerson($id_person);
		$data['person_data'] = $array['person'];
		$data['city'] = $array['city'];
		if($this->session->userdata($this->sess)){
		$this->template->load('template/templateMenu','people/peopleDetailedView', $data);
		}else{
			redirect('login');
		}
	}

	public function create(){

		$this->form_validation->set_rules('peopleName','nome','required|min_length[5]');
		$this->form_validation->set_rules('peopleNumber','number','numeric');
		$this->form_validation->set_rules('peopleCitie','citie','required');

		if($this->form_validation->run()){
			$cpfCnpj = $this->input->post('peopleClassification');
			$documment =  $this->input->post('peopleClassification');
			if(($cpfCnpj == 1) && ($documment == 1)){
				$cpfCnpj = $this->input->post('peopleCpf');
				$documment = $this->input->post('peopleRg');
			}else if(($cpfCnpj == 2) && ($documment == 2)){
				$cpfCnpj = $this->input->post('peopleCnpj');
				$documment = $this->input->post('peopleInscricao');
			}
			$people = array(
				'name' => $this->input->post('peopleName'),
				'cpf_cnpj' => $cpfCnpj,
				'documment' => $documment,
				'adress' => $this->input->post('peopleAdress'),
				'number' => $this->input->post('peopleNumber'),
				'neighborhood' => $this->input->post('peopleNeighborhood'),
				'id_cities' => $this->input->post('peopleCitie'),
				'cep' => $this->input->post('peopleCep'),
				'date_birth' => $this->input->post('peopleDateBirth'),
				'phone1' => $this->input->post('peoplePhone1'),
				'phone2' => $this->input->post('peoplePhone2'),

				);

			$this->PeopleModel->create($people);
			redirect('people','refresh');

		}else{
			$data['states'] = $this->PeopleModel->states();
			if($this->session->userdata($this->sess)){
				$this->template->load('template/templateMenu', 'people/peopleCreateView',$data);
			}else{
				redirect('login');
			}
		}

	}

	public function update($id){
		$peoples = $this->PeopleModel->get();


		$this->form_validation->set_rules('updatePeopleName','updateNome','required|min_length[5]');
		$this->form_validation->set_rules('updatePeopleNumber','updateNumber','numeric');
		$this->form_validation->set_rules('updatePeopleCitie','updateCitie','required');

		if($this->form_validation->run()){

			foreach ($peoples as $people) {
				if($people['id_people'] == $id){
					if(strlen($people['cpf_cnpj']) == 18){
						$data = array(
							'id_people' => $this->input->post('updatePeopleId'),
							'name' => $this->input->post('updatePeopleName'),
							'cpf_cnpj' => $this->input->post('updatePeopleCnpj'),
							'documment' => $this->input->post('updatePeopleInsc'),
							'adress' => $this->input->post('updatePeopleAdress'),
							'number' => $this->input->post('updatePeopleNumber'),
							'neighborhood' => $this->input->post('updatePeopleNeighborhood'),
							'id_cities' => $this->input->post('updatePeopleCitie'),
							'cep' => $this->input->post('updatePeopleCep'),
							'date_birth' => $this->input->post('updatePeopleDateBirth'),
							'phone1' => $this->input->post('updatePeoplePhone1'),
							'phone2' => $this->input->post('updatePeoplePhone2'),

							);

						$this->PeopleModel->update($data);
						redirect('people','refresh');
					}else if (strlen($people['cpf_cnpj']) == 14){
						$data = array(
							'id_people' => $this->input->post('updatePeopleId'),
							'name' => $this->input->post('updatePeopleName'),
							'cpf_cnpj' => $this->input->post('updatePeopleCpf'),
							'documment' => $this->input->post('updatePeopleRg'),
							'adress' => $this->input->post('updatePeopleAdress'),
							'number' => $this->input->post('updatePeopleNumber'),
							'neighborhood' => $this->input->post('updatePeopleNeighborhood'),
							'id_cities' => $this->input->post('updatePeopleCitie'),
							'cep' => $this->input->post('updatePeopleCep'),
							'date_birth' => $this->input->post('updatePeopleDateBirth'),
							'phone1' => $this->input->post('updatePeoplePhone1'),
							'phone2' => $this->input->post('updatePeoplePhone2'),

							);

						$this->PeopleModel->update($data);
						redirect('people','refresh');
					}
				}
			}
		}else{
			$data['id'] = $id;
			// $data['peoples'] = $this->PeopleModel->get();
			$data['states'] = $this->PeopleModel->states();
			$data['dados_pessoa'] = $this->PeopleModel->listPeople($id);
			$data['dados_pessoa'][0]->id_state = $this->CitieModel->getStateId($data['dados_pessoa'][0]->id_cities);
			// $data['alter_states'] = $this->PeopleModel->alterStates($id);
			if($this->session->userdata($this->sess)){
				$this->template->load('template/templateMenu', 'people/peopleUpdateView', $data);
			}else{
				redirect('login');
			}
		}
	}

	public function delete(){
		$data = array('id_people' => $this->input->post('id_people'));
		if($this->PeopleModel->delete($data)){
			echo  'Cadastro Excluido!';
		}else {
			echo 'Ocorreu algum erro. Tente novamente';
		}

	}

	public function searchLocalidade()
	{
		$options = "";
		if($this->input->post('state'))
		{
			$state = $this->input->post('state');
			$localidades = $this->PeopleModel->localidades($state);
			foreach($localidades as $fila)
			{
				?>
				<option value="<?=$fila -> id_cities ?>"><?=$fila -> name ?></option>
				<?php
			}
		}
	}

	public function searchLocalidadeSelect(){
		$options = "";
		if($this->input->post('state'))
		{
			$id_person = $this->input->post('person');
			$state = $this->input->post('state');
			$localidades = $this->PeopleModel->localidades($state);
			$user = $this->PeopleModel->listPeople($id_person);
			foreach($localidades as $fila)
			{
				if($fila->id_cities == $user[0]->id_cities){?>
				<option value="<?=$fila -> id_cities ?>" selected><?=$fila -> name ?></option>
				<?php }else{
					?>
				<option value="<?=$fila -> id_cities ?>"><?=$fila -> name ?></option>		
					<?php
				}
			}
		}
	}

public function searchPeople(){
	$this->form_validation->set_rules('search_string', 'people', 'required');
	if($this->form_validation->run()){
		$people = $this->input->post('search_string');
		$result = $this->PeopleModel->search($people);
		echo json_encode($result);
	}else{
		echo "O campo de busca esta vazio";
	}
}
public function checkCPF(){
	if($this->PeopleModel->checkCPF($this->input->post("peopleCpf")) || $this->PeopleModel->checkCPF($this->input->post("peopleCnpj")) || $this->PeopleModel->checkCPF($this->input->post("updatePeopleCpf")) || $this->PeopleModel->checkCPF($this->input->post("updatePeopleCnpj"))){
		echo "-1";
	}else{
		echo "1";
	}
}

}
