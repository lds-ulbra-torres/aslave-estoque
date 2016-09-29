
<script type="text/javascript">
	$(document).ready(function(){
		$(".closeModal").click(function(){
			$('#deleteClassModal').closeModal();
		});
	});

	$(document).on("click", ".openDeleteClassModal", function(){
		$('#deleteClassModal').openModal();
		document.getElementById('idDelete').value=$(this).attr('id');
	});

	$(document).on("submit","#delete-c",function(e){
		function reloadTableClassification(){
			$.ajax({
				url: "<?= site_url('classification'); ?>",
				type: "POST",
				data: $('table'),
				success: function(data){
					$("table").html($(data).find("table"));
					console.log($(data).find("table"));
				},
				error: function(){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);
				}
			});
		}

		e.preventDefault();
		console.log($("#idDelete").val());

		$.ajax({
			url: "<?= site_url('delete-classification'); ?>",
			type: "POST",
			data: {idDeleteClass:$("#idDelete").val()},
			success:function(data){
				if(data == true){
					Materialize.toast('Classificação apagada.', 2000);
					reloadTableClassification();
				}else{
					Materialize.toast('A classificação está sendo utilizada.', 2000);
				}
			}
		});
	});

	$(document).on("submit","#typeSearch",function(e){
		e.preventDefault();
		$.ajax({
			url: "<?= site_url('search-classification'); ?>",
			type: "POST",
			data: {type:$("#selectType").val()},
			success:function(data){
				$('#foundType').html("");
				var obj = JSON.parse(data);
				if (obj.length>0){
						var items=[];
						$.each(obj,function(i,val){
							if(val.classification_type == "e"){
								val.classification_type = "Entrada";
							}else{
								val.classification_type = "Saida";
							}
							items.push($('<tr><td>'+val.name_classification+'</td><td>'+val.classification_type+'</td><td><a href="update-classification-form/'+val.id_classification+'">Alterar</a> | <a id="'+val.id_classification+'" class="openDeleteClassModal" href="#deleteClassModal">Apagar</a></td></tr>'
								));
						});
						$('#foundType').append.apply($('#foundType'), items);
				}else{
					$("#foundType").empty();
				}
			}
		});
	});

</script>

<div>
	<!-- MODAL 1 -->
	<div class="input-field col s3">

	</div>

	<div id="deleteClassModal" class="modal">
		<form method="POST" id="delete-c">
			<div class="modal-content">
				<h4>Aviso</h4>
				<div class="row">
					<p>Realmente quer apagar esta classificação?</p>
				</div>
			</div>
			<input id="idDelete" name="idDeleteClass" type="hidden" value="">
			<div class="modal-footer">
				<a href="#!" class=" closeModal waves-effect waves-green btn-flat">Cancelar</a>
				<input type="submit" value="Apagar" class="closeModal btn red"></input>
			</div>
		</form>
	</div>

	<div class="container">
		<h4>Classificações</h4>
		<div class="card-panel col s12 m4 row">
			<div class="col s4">
				<a class="margin-alter btn green" href="<?= base_url('create-classification-form');?>">ADICIONAR NOVA</a>
			</div>

			<div class="input-field col s12 m6">
				<form method="POST" id="typeSearch">
					<select id="selectType">
						<option value="" disabled selected>Selecione um tipo</option>
						<option value="E">Entrada</option>
						<option value="S">Saída</option>
						<option value="">Ambos</option>
					</select>
				<label>Tipo:</label>
			</div>
			<div class="col s12 m2">
					<button type="submit" class="margin-alter btn green" >Buscar</button>
				</form>
			</div>


		</div>

		<div class="row">
			<div class="col s12 collection">
				<table class="bordered highlight responsive-table">
					<thead>
						<td><strong class="">Nome: </strong></td>
						<td><strong class="">Tipo de classificação: </strong></td>
                    <td><strong>Ações</strong></td>
					</thead>
					<tbody id="foundType">
						<?php foreach ($classifications as $classification) :?>
							<tr>
								<td class=""><?= $classification['name_classification'] ?></td>
								<td class="">
									<?php
									if($classification['classification_type'] == 'e'){
										echo 'Entrada';
									}else if($classification['classification_type'] == 's'){
										echo 'Saída';
									}
									?>
								</td>
								<td>
									<a href="update-classification-form/<?= $classification['id_classification'] ?>" class="">
										<i class="material-icons">edit</i></a>
									<a id="<?= $classification['id_classification'] ?>" class="openDeleteClassModal" href="#deleteClassModal" class="">
										<i class="material-icons">delete</i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>