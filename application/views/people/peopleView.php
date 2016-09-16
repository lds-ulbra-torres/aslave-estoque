<div class="container">
	<h4>Pessoas</h4>
	<div class="card-panel col s12 row">
		<div class="col s12 m3">
			<a class="margin-alter green btn" id="" href="<?= base_url('create-people'); ?>">Adicionar nova</a>
		</div>
		<div class="input-field col s12 m6 l7">
			<input type="text" name="search" class="margin-alter" placeholder=" Buscar pessoa..." required>
		</div>
		<div class="col s12 m2">
			<button href="#" id="search_button" class="margin-alter btn green">Buscar</button>
		</div>
	</div>
			<div class="row">
		            <div class="col s12 collection">
						<table id="Tpeople" class="bordered highlight">  
							<thead>
								<td><strong>Nome </strong></td>
								<td><strong>CPF/CNPJ </strong></td>
								<td><strong>Documento</strong></td>
								<td></td>
							</thead>
							<tbody>
								<?php foreach ($peoples as $people) :?>
									<tr>
										<td><?= $people->name ?></td>
										<td><?= $people->cpf_cnpj ?></td>
										<td><?= $people->documment ?></td>
										<td>
											<a href="<?= base_url('update-people/'.$people->id_people)?>">Alterar</a>
											|
											<a class="delete_people" id="<?php echo $people->id_people; ?>" href="#">Apagar</a>
										</a>

									</td>
								</tr>
							<?php endforeach ?>
						    </tbody>
					    </table>
				    </div>
			    </div>
			</div>
			</table>
			<div id="deletePeople" class="modal">
				<div class="modal-content">
					<h4>Apagar</h4>
					<p><strong>Realmente deseja apagar o cadastro?</strong></p>
				</div>
				<div class="modal-footer">
					<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
					<a href="#!" id="delete_people" class=" modal-action waves-effect waves-red modal-close btn red">Apagar</a>
				</div>
			</div>
			<div class="container row">
				<?php echo $pagination_show;  ?>
			</div>
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
				url: "<?php echo site_url('/peopleController/searchPeople'); ?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					if(data == 'O campo de busca esta vazio'){
						reloadTablePeople();
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhuma pessoa encontrado", 4000);
					}else{
						try{
							$('#Tpeople > tbody').html("");
							var items=[]; 	
							$.each(obj, function(i,val){											
								items.push($("<tr><td>" + val.name + "</a></td><td>"+val.cpf_cnpj+"</td><td>"+val.documment+"</td><td><a href='<?= base_url('update-people/');?>/"+ val.id_people +"'>Alterar</a> | <a id="+ val.id_people +" href='#' class='delete_people'>Apagar</a></td></tr>"));
							});	
							$('#Tpeople > tbody').append.apply($('#Tpeople > tbody'), items);
						}catch(e) {		
							alert('Ocorreu algum erro ao carregar as Pessoas!');
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