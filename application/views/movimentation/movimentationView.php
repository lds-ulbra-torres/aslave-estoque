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
				</tr>
			</thead>
			<tbody>
			<?php foreach($movimentations as $movimentation) : ?>
				<tr>
					<td><?= $movimentation['date_financial_release'] ?></td>
					<td><?= $movimentation['id_people'] ?></td>
					<td><?= $movimentation['value'] ?></td>
					<td><?= $movimentation['type_mov'] ?></td>
					<td>
						<a href="#" class="modal-trigger waves-effect waves-light btn">Alterar</a>
						<a href="#" class="modal-trigger waves-effect waves-light btn">Deletar</a>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>