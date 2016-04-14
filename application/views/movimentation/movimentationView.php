
<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteMovModal").click(function(){
			$('#deleteMovModal').openModal();
			document.getElementById('idDelete').value=$(this).attr('id');
		});
	});
</script>
<div> 
	<a class="modal-trigger waves-effect waves-light btn" href="create-movimentation-form" >+Movimentação</a>

	<div class="container">
		<h4 >Movimentações financeiras</h4>
		
		<table class="striped">
			<thead>
				<tr>
					<td><strong>Data:</strong></td>
					<td><strong>Pessoa:</strong></td>
					<td><strong>Valor: </strong></td>
					<td><strong>Tipo:</strong></td>
				</tr>
			</thead>
			<tbody>
			<?php foreach($movimentations as $movimentation) : ?>
				<tr>
					<td><?= $movimentation['date_financial_release'] ?></td>
					<td><?= $movimentation['name'] ?></td>
					<td>R$ <?= $movimentation['value'] ?></td>
					<?php 
					if($movimentation['type_mov'] == 'e'){
						$movimentation['type_mov'] = "Entrada";
					}else{
						$movimentation['type_mov'] = "Saida";
					}
					?>
					<td><?= $movimentation['type_mov'] ?></td>
					<td>
						<a href="#" class="modal-trigger waves-effect waves-light btn">Alterar</a>
						<a href="#deleteMovModal" id="<?= $movimentation['id_financial_release'] ?>" class="modal-trigger waves-effect waves-light btn deleteMovModal">Deletar</a>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div id="deleteMovModal" class="modal modal-fixed-footer">
		<div class="modal-content valign-wrapper">
		<h3 class="center-align valign">Deseja mesmo deletar?</h3>
			<form action="delete-classification" method="POST">
				<input id="idDelete" name="idDeleteMov" type="hidden" value="">
		</div>
			<div class="modal-footer">
				<button  class="modal-trigger marginl waves-effect waves-light btn red" type="submit">Sim</button>
			    <a href="#!" class="modal-trigger marginl waves-effect waves-light btn">Não</a>
		    </div>
		</form>
	</div>


</div>