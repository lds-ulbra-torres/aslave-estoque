<div>
		<a class="waves-effect waves-light btn" href="create-people">CADASTRO DE PESSOA
		<i class="material-icons right">input</i></a></a>
			<div>
		<h3 align="center">Pessoas</h3>
		<table id="Tpeople" class="bordered highlight">
			<thead>
				<td><strong>Nome </strong></td>
				<td><strong>CPF/CNPJ </strong></td>
				<td><strong>Documento</strong></td>
				<td><strong>End. </strong></td>
				<td><strong>Num. </strong></td>
				<td><strong>Bairro </strong></td>
				<td><strong>CEP </strong></td>
				<td><strong>Data de Nasc </strong></td>
				<td><strong>Phone  </strong></td>
				<td><strong>Phone2 </strong></td>


			</thead>
			<tbody>
				<?php foreach ($peoples as $people) :?>
					<tr>
						<td><?= $people['name'] ?></td>
						<td><?= $people['cpf_cnpj'] ?></td>
						<td><?= $people['documment'] ?></td>
						<td><?= $people['adress'] ?></td>
						<td><?= $people['number'] ?></td>
						<td><?= $people['neighborhood'] ?></td>
						<td><?= $people['cep'] ?></td>
						<td><?= $people['date_birth'] ?></td>
						<td><?= $people['phone1'] ?></td>
						<td><?= $people['phone2'] ?></td>
						<td>
							<a href="update-people/<?= $people['id_people'] ?>">Alterar</a>
							|
							<a class="delete_people" id="<?php echo $people['id_people']; ?>" href="#">Apagar</a>


						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
    </table>
    <div class="pagination">
			<ul class="pagination right-align">
				<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				<li class="active grey"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div>
		
    <div id="deletePeople" class="modal">
    <div class="modal-content">
      <h4>Apagar</h4>
      <p>Deseja realmente apagar o cadastro?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar
        <i class="material-icons right">clear</i></a></a>
		<a href="#!" id="delete_people" class=" modal-action modal-close waves-effect waves-red btn-flat">Apagar
		<i class="material-icons right">delete_forever</i></a>
    </div>
  </div>
		</table>
	</div>
</div>
<script type="text/javascript"  src="<?= base_url('assets/js/jquery-2.2.2.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
 $(document).ready(function(){
		function reloadTablePeople(){
			$.ajax({
				url: "<?= base_url('people/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#Tpeople").html($(data).find("table"));
					console.log($(data).find("table"));
				},
				error: function(){
					console.log(data);
					window.location.reload();
				}
			});
		}
var idPeople;
		$("table").on("click",".delete_people", function(){
			$('#deletePeople').openModal();	
			idPeople = $(this).attr("id");
		});

		$("#delete_people").on("click", function(){
			$.ajax({
				url: "<?php echo site_url('/PeopleController/delete'); ?>",
				type: "POST",
				data: {id_people: idPeople},
				success: function(data){
					if(!data){
						Materialize.toast(data, 4000);
					}else{
						Materialize.toast(data, 4000,'rounded');
						reloadTablePeople();
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao Excluir, Cadastro sendo utilizado!', 4000,'rounded');	
				}
			});
		});   
	});    
 </script>