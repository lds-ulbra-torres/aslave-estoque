<div class="container">
	<div class="card-panel blue-text">
		<h4>Detalhes de Saída [<?= $output_data['output'][0]['id_stock']; ?>]</h4>
		<div class="right-align">
			<a class="btn teal" href="<?=base_url('stock/outputs') ?>"><i class="material-icons">input</i> Voltar</a>
			<a class="btn" href="<?= base_url('stock/outputs/update/'.$output_data['output'][0]['id_stock']); ?>"><i class="material-icons">edit</i> Editar</a>
		</div>
	</div>
	<div class="row">
		<div class="card-panel">
			<dl class="dl-horizontal">
				<dt>Retirado por</dt>
				<dd><?= $output_data['people'][0]['name'] ?></dd>

				<dt>CPF/CNPJ</dt>
				<dd><?= $output_data['people'][0]['cpf_cnpj'] ?></dd>

				<dt>Descrição</dt>
				<dd>
					<?php $output_data['output'][0]['descript'] ?>
				</dd>

				<dt>Data de Saída</dt>
				<dd><?= date('d/m/Y', strtotime($output_data['output'][0]['output_date'])); ?></dd>

				<dt>Total da Nota</dt>
				<dd><?='R$ '. number_format($output_data['output'][0]['sum_value'], 2, ',', '.');?></dd>
			</dl>
		</div>

		<div class="collection responsive-table">
			<table id="productOutput" class="bordered highlight">
				<thead>
					<td><strong>Produto</strong></td>
					<td><strong>Valor unitário</strong></td>
					<td><strong>Quantidade</strong></td>
					<td><strong>Total</strong></td>
				</thead>
				<tbody id="enteredProducts">
					<?php foreach ($output_data['output'] as $prod) { ?>
					<tr>
						<td><?= $prod['name_product'] ?></td>
						<td><?='R$ ' . number_format($prod['unit_price_output'], 2, ',', '.');?></td>
						<td><?= $prod['amount_output'] ?></td>
						<td class="total" hidden><?= $prod['unit_price_output']*$prod['amount_output'] ?></td>
						<td><?='R$ ' . number_format($prod['unit_price_output']*$prod['amount_output'], 2, ',', '.');?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
