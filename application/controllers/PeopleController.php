<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleController extends CI_Controller {

	var $sess = 'login';

	public function __construct(){
		parent:: __construct();
		$this->load->model('people/peopleModel');
	}


	public function index($init = 0) {
		//Paginação
		$this->load->library('pagination');
		$max = 10;
		$init = (!$this->uri->segment('2')) ? 0 : $this->uri->segment('2');
		$config['base_url'] = base_url('people');
		$config['total_rows'] = $this->peopleModel->count_register();
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
		$data['peoples'] = $this->peopleModel->get_pagination($max, $init);
		if($this->session->userdata($this->sess)){
			$this->template->load('template/templateMenu', 'people/peopleView', $data);
		}else{
			redirect('login');
		}
	}

	public function detailedPerson() {
		$id_person = $this->uri->segment(2);
		$data['person_data'] = $this->peopleModel->getPerson($id_person);
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

			$this->peopleModel->create($people);
			redirect('people','refresh');

		}else{
			$data['states'] = $this->peopleModel->states();
			if($this->session->userdata($this->sess)){
				$this->template->load('template/templateMenu', 'people/peopleCreateView',$data);
			}else{
				redirect('login');
			}
		}

	}

	public function update($id){
		$peoples = $this->peopleModel->get();


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

						$this->peopleModel->update($data);
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

						$this->peopleModel->update($data);
						redirect('people','refresh');
					}
				}
			}
		}else{
			$data['id'] = $id;
			$data['peoples'] = $this->peopleModel->get();
			$data['states'] = $this->peopleModel->states();
			$data['dados_pessoa'] = $this->peopleModel->listPeople($id);
			$data['alter_states'] = $this->peopleModel->alterStates($id);
			if($this->session->userdata($this->sess)){
				$this->template->load('template/templateMenu', 'people/peopleUpdateView', $data);
			}else{
				redirect('login');
			}
		}
	}

	public function delete(){
		$data = array('id_people' => $this->input->post('id_people'));
		if($this->peopleModel->delete($data)){
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
			$localidades = $this->peopleModel->localidades($state);
			foreach($localidades as $fila)
			{
				?>
				<option value="<?=$fila -> id_cities ?>"><?=$fila -> name ?></option>
				<?php
			}
		}
	}

	public function alterCitie($id)
	{
		$options = "";
		if($this->input->post('state'))
		{
			$state = $this->input->post('state');
			$localidades = $this->peopleModel->localidades($state);
			$data['alter_states'] = $this->peopleModel->alterStates($id);
			foreach($localidades as $fila)
			{
				?>

				<option
				value="<?php echo $fila->id_cities ?>"
				<?php echo $fila->id_cities==$data['alter_states'][0]->id_cities ?'selected':'';?>
				>
				<?= $fila -> name ?>
			</option>
			<?php
		}
	}
}

public function searchPeople(){
	$this->form_validation->set_rules('search_string', 'people', 'required');
	if($this->form_validation->run()){
		$people = $this->input->post('search_string');
		$result = $this->peopleModel->search($people);
		echo json_encode($result);
	}else{
		echo "O campo de busca esta vazio";
	}
}
public function checkCPF(){
	if($this->peopleModel->checkCPF($this->input->post("peopleCpf")) || $this->peopleModel->checkCPF($this->input->post("peopleCnpj")) || $this->peopleModel->checkCPF($this->input->post("updatePeopleCpf")) || $this->peopleModel->checkCPF($this->input->post("updatePeopleCnpj"))){
		echo "-1";
	}else{
		echo "1";
	}
}

}
