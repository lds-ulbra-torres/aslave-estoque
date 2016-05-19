
<script type="text/javascript">
	$(document).ready(function(){
		$(".openDeleteClassModal").click(function(){
			$('#deleteClassModal').openModal();
			document.getElementById('idDelete').value=$(this).attr('id');
		});

		$(".closeModal").click(function(){
			$('#deleteClassModal').closeModal();
		});
	});


</script>

<div>
	<!-- MODAL 1 -->
	<div class="input-field col s3">
	<a class="modal-trigger btn green" href="create-classification-form" style="margin-left: 5px;">ADICIONAR NOVA</a>
	</div>

	<div id="deleteClassModal" class="modal">
		<form action="delete-classification" method="POST" id="delete-c">
			<div class="modal-content">
				<h4>Aviso</h4>
				<div class="row">
					<p>Realmente quer apagar esta categoria?</p>
				</div>
			</div>
		<input id="idDelete" name="idDeleteClass" type="hidden" value="">
		<div class="modal-footer">
			<a href="#!" class=" closeModal waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="delete_group" onClick="document.getElementById('delete-c').submit();" class="waves-effect waves-red btn-flat">Apagar</a>
		</div>
		</form>
	</div>


	<!-- MOSTRAR DADOS DO DB CLASSIFICAÇÃO -->
	<div class="container">
		<h3>Classificações</h3>
		<table class="striped">
			<thead>
				<td><strong class="">Nome: </strong></td>
				<td><strong class="">Tipo de classificação: </strong></td>
			</thead>
			<tbody>
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
								Alterar</a>
							|
							<a id="<?= $classification['id_classification'] ?>" class="openDeleteClassModal" href="#deleteClassModal" class="">
							Deletar</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>