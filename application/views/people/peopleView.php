<script type="text/javascript"  src="<?= base_url('assets/js/jquery-2.2.2.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
<meta charset="UTF-8">
</script>
<body>
		<a class="modal-trigger waves-effect waves-light btn" href="create-people">+CADASTRO DE PESSOA</a>

			<div>
		<h3 align="center">Pessoas</h3>
		<table class="striped">
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
							<a href="delete-people/<?= $people['id_people'] ?>">Deletar</a>


						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>