
<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteMovModal").click(function(){
			$('#deleteMovModal').openModal();
			document.getElementById('idDeleteMov').value=$(this).attr('id');
		});
	});
</script>
<div> 
	<a class="modal-trigger waves-effect waves-light btn" href="create-movimentation-form" >+Movimentação</a>

	<div class="container">
	<input type="text" name="searchPeople"></input>
		<h4 >Movimentações financeiras</h4>
		<table class="striped">
			<thead>
				<tr>
					<td><strong>Data:</strong></td>
					<td><strong>Pessoa:</strong></td>
					<td><strong>Valor:</strong></td>
					<td><strong>Tipo:</strong></td>
				</tr>
			</thead>
			<tbody>
			<?php foreach($movimentations as $movimentation) : ?>
				<tr>
					<td><?= $movimentation['date_financial_release'] ?></td>
					<td><?= $movimentation['name'] ?></td>
					<?php if($movimentation['type_mov'] == 's'){ ?>
						<td><span style="color:red;" >R$ <?= "-".$movimentation['value'] ?></span></td>
					<?php }else{ ?>
						<td>R$ <?= $movimentation['value'] ?></td>
					<?php } ?>
					<td><?= $movimentation['type_mov'] ?></td>
					<td>
						<a href="#">Alterar</a>
						|
						<a href="#deleteMovModal" id="<?= $movimentation['id_financial_release'] ?>" class="deleteMovModal">Deletar</a>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div id="deleteMovModal" class="modal modal-fixed-footer">
		<div class="modal-content valign-wrapper">
		<h3 class="center-align valign">Deseja mesmo deletar?</h3>
			<form action="delete-movimentation" method="POST">
				<input id="idDeleteMov" name="DeleteMov" type="hidden" value="">
		</div>
			<div class="modal-footer">
				<button  class="modal-trigger marginl waves-effect waves-light btn green" type="submit">Sim</button>
			    <a href="#!" class="modal-trigger marginl waves-light btn">Não</a>
		    </div>
		</form>
	</div>


</div>