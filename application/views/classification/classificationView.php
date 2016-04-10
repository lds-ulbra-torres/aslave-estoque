<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".openDeleteClassModal").click(function(){
			$('#deleteClassModal').openModal();
			document.getElementById('idDelete').value=$(this).attr('id');
		});
	});

</script>

<div>
	<!-- MODAL 1 -->
	<a class="modal-trigger waves-effect waves-light btn" href="create-classification-form">+CLASSIFICAÇÃO</a>

	<div id="deleteClassModal" class="modal modal-fixed-footer">
		<div class="modal-content valign-wrapper">
		<h3 class="center-align valign">Deseja mesmo deletar?</h3>
			<form action="delete-classification" method="POST">
				<input id="idDelete" name="idDeleteClass" type="hidden" value="">
		</div>
			<div class="modal-footer">
				<button  class="modal-trigger marginl waves-effect waves-light btn" type="submit">Sim</button>
			    <a href="#!" class="modal-action modal-close waves-effect white-text waves-green btn-flat red ">Não</a>
		    </div>
		</form>
	</div>


	<!-- MOSTRAR DADOS DO DB CLASSIFICAÇÃO -->
	<div>
		<h3 align="center">Classificações</h3>
		<table class="striped">
			<thead>
				<td><strong>Nome: </strong></td>
				<td><strong>Tipo de classificação: </strong></td>
			</thead>
			<tbody>
				<?php foreach ($classifications as $classification) :?>
					<tr>
						<td><?= $classification['name'] ?></td>
						<td>
							<?php
							if($classification['classification_type'] == 'e'){
								echo 'Entrada';
							}else if($classification['classification_type'] == 's'){
								echo 'Saída';
							}
							?>
						</td>
						<td>
							<a href="update-classification-form/<?= $classification['id_classification'] ?>">
								<button class="modal-trigger waves-effect waves-light btn" >Alterar</button></a>

								<a id="<?= $classification['id_classification'] ?>" class="openDeleteClassModal" href="#deleteClassModal">
									<button  class="btn waves-effect waves-light">Deletar</button></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>