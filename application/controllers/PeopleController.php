<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeopleController extends CI_Controller {
	

	public function __construct(){
		parent:: __construct();
		$this->load->library('form_validation');
		$this->load->model('people/peopleModel');
	}


	public function index()
	{
		$data['peoples'] = $this->peopleModel->get();
		$this->template->load('template/templateMenu', 'people/peopleView', $data);
	}


	public function create(){

		$this->form_validation->set_rules('peopleName','nome','required');
		$this->form_validation->set_rules('peopleAdress','adress','required');
		$this->form_validation->set_rules('peopleNeighborhood','neighborhood','required');
		$this->form_validation->set_rules('peopleCitie','citie','required');
		$this->form_validation->set_rules('peopleCep','cep','required');
		$this->form_validation->set_rules('peopleDateBirth','daterBirth','required');
		$this->form_validation->set_rules('peoplePhone1','phone1','required');

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
				'type_people' =>$this->input->post('peopleClassification'),
				'name' => $this->input->post('peopleName'),
				'cpf_cnpj' => $cpfCnpj,
				'documment' => $documment,
				'adress' => $this->input->post('peopleAdress'),
				'number' => $this->input->post('peopleNumber'),
				'neighborhood' => $this->input->post('peopleNeighborhood'),
				'citie' => $this->input->post('peopleCitie'),
				'cep' => $this->input->post('peopleCep'),
				'date_birth' => $this->input->post('peopleDateBirth'),
				'phone1' => $this->input->post('peoplePhone1'),
				'phone2' => $this->input->post('peoplePhone2'),

				);

			$this->peopleModel->create($people);
			redirect('people','refresh');

		}else{
			$data['states'] = $this->peopleModel->states();
			$this->template->load('template/templateMenu', 'people/peopleCreateView',$data);
		}
		
	}

	public function update($id){
		$peoples = $this->peopleModel->get();

		$this->form_validation->set_rules('updatePeopleName','updateName','required');
		$this->form_validation->set_rules('updatePeopleAdress','updateAdress','required');
		$this->form_validation->set_rules('updatePeopleNumber','updateNumber','required');
		$this->form_validation->set_rules('updatePeopleNeighborhood','updateNeighborhood','required');
		$this->form_validation->set_rules('updatePeopleCitie','updateCitye','required');
		$this->form_validation->set_rules('updatePeopleCep','updateCep','required');
		$this->form_validation->set_rules('updatePeopleDateBirth','updateDateBirth','required');
		$this->form_validation->set_rules('updatePeoplePhone1','updatePhone1','required');

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
							'citie' => $this->input->post('updatePeopleCitie'),
							'cep' => $this->input->post('updatePeopleCep'),
							'date_birth' => $this->input->post('updatePeopleDateBirth'),
							'phone1' => $this->input->post('updatePeoplePhone1'),
							'phone2' => $this->input->post('update-peoplePhone2'),

							);

						$this->peopleModel->update($data);
						redirect('people','refresh');
					}else{
						$data = array(
							'id_people' => $this->input->post('updatePeopleId'),
							'name' => $this->input->post('updatePeopleName'),
							'cpf_cnpj' => $this->input->post('updatePeopleCpf'),
							'documment' => $this->input->post('updatePeopleRg'),
							'adress' => $this->input->post('updatePeopleAdress'),
							'number' => $this->input->post('updatePeopleNumber'),
							'neighborhood' => $this->input->post('updatePeopleNeighborhood'),
							'citie' => $this->input->post('updatePeopleCitie'),
							'cep' => $this->input->post('updatePeopleCep'),
							'date_birth' => $this->input->post('updatePeopleDateBirth'),
							'phone1' => $this->input->post('updatePeoplePhone1'),
							'phone2' => $this->input->post('update-peoplePhone2'),

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
			$this->template->load('template/templateMenu', 'people/peopleUpdateView', $data);
		}
	}

	public function delete($people){
		$data = array('id_people' => $people);
		$this->peopleModel->delete($data);
		redirect('people','refresh');
	}

	public function searchLocalidade($type)
	{
		$options = "";
		
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
