<div class="container">

	<div class="card-panel blue-text">
		<h4>Pessoas</h4>
		<div class="right-align">
			<a class="margin-alter green btn" id="" href="<?= base_url('create-person-form'); ?>">Adicionar nova</a>
		</div>
	</div>

	<div class="card-panel col s12 row">
		<div class="input-field col s12 m6 l7">
			<input type="text" name="search" class="margin-alter" placeholder=" Buscar pessoa..." required>
		</div>
		<div class="col s12 m2">
			<button href="#" id="search_button" class="margin-alter btn green">Buscar</button>
		</div>
	</div>

	<div class="row">
	  <div class="col s12 collection responsive-table">
			<table id="Tpeople" class="bordered highlight">
				<thead>
					<td><strong>Nome </strong></td>
					<td><strong>CPF/CNPJ </strong></td>
					<td><strong>Documento</strong></td>
					<td></td>
				</thead>
				<tbody>
					<?php foreach ($peoples as $person) :?>
						<tr>
							<td><a href="<?= base_url('detailed-person/'.$person->id_people ) ?>" title="Vizualizar Pessoa"><?= $person->name ?></a></td>
							<td><?= $person->cpf_cnpj ?></td>
							<td><?= $person->documment ?></td>
							<td>
								<a href="<?= base_url('detailed-person/'.$person->id_people ) ?>" title="Vizualizar Pessoa"><i class="material-icons">visibility</i></a>
								<a href="<?= base_url('update-person/'.$person->id_people ) ?>" title="Editar Pessoa"><i class="material-icons">edit</i></a>
								<a class="delete_person" id="<?= $person->id_people ?>" href="#" title="Apagar Pessoa"><i class="material-icons">delete</i></a>
							</td>
						</tr>
					<?php endforeach ?>
			  </tbody>
		  </table>
		</div>
		<div class="right-align">
			<?php echo $pagination_show;  ?>
		</div>
  </div>
</div>

<div id="deletePeople" class="modal">
	<div class="modal-content">
		<h4>Apagar</h4>
		<p><strong>Deseja realmente apagar esta pessoa?</strong></p>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close btn-flat">Cancelar</a>
		<a href="#!" id="delete_person" class=" modal-action modal-close btn red">Apagar</a>
	</div>
</div>
<script type="text/javascript">
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
		$("table").on("click",".delete_person", function(){
			$('#deletePeople').openModal();
			idPeople = $(this).attr("id");
		});

		$("#delete_person").on("click", function(){
			$.ajax({
				url: "<?php echo site_url('/PeopleController/delete'); ?>",
				type: "POST",
				data: {id_people: idPeople},
				success: function(data){
					if(!data){
						Materialize.toast(data, 4000);
					}else{
						Materialize.toast(data, 4000);
						reloadTablePeople();
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao Excluir! - Cadastro sendo utilizado', 4000);
				}
			});
		});
		//SEARCH PESSOA
		$("#search_button").click(function(){
			$.ajax({
				url: "<?php echo site_url('/PeopleController/searchPeople'); ?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					if(data == 'O campo de busca esta vazio'){
						reloadTablePeople();
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhuma pessoa encontrada!", 4000);

					}
					else{
						try{
							$('#Tpeople > tbody').html("");
							var items=[];
							$.each(obj, function(i,val){
								items.push(
									$("<tr><td><a href='<?= base_url('detailed-person/'.$person->id_people) ?>' title='Vizualizar Pessoa'>"+ val.name +"</a></td>" +
										"<td>"+ val.cpf_cnpj +"</td>"+
										"<td>"+ val.documment +"</td>" +
										"<td>" +
										"<a href='<?= base_url('detailed-person/') ?>/"+ val.id_people +"' title='Vizualizar Pessoa'><i class='material-icons'>visibility</i></a>" +
										"<a href='<?= base_url('update-people/');?>/"+ val.id_people +"'title='Editar Pessoa'><i class='material-icons'>edit</i></a>"+
										"<a class='delete_person' id="+ val.id_people +" href='#' title='Apagar Pessoa'><i class='material-icons'>delete</i></a></td></tr>"));
							});
							$('#Tpeople > tbody').append.apply($('#Tpeople > tbody'), items);
						}catch(e) {
							Materialize.toast("Exceção ao buscar todas as pessoas.", 4000);
						}
					}
				},
				error: function(){
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});
	});
</script>
