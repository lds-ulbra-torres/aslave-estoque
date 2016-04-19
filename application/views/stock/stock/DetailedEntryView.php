<a href="<?=base_url('stock/entries') ?>">< Voltar para entradas</a>
<script type="text/javascript">
	$(document).ready(function(){
		var total = 0
		$(".total").each(function(){
			total += Number($(this).text().replace(/[^0-9.,]/g,''));
			
		});
		$("#totalHeader").text("R$ "+total);
	});
</script>
<div class="row">
	<h4>Detalhes de entrada</h4>
	<div class="card-panel col s10">
		<table>
			<thead>
				<td><strong>Fornecedor</strong></td>
				<td><strong>CPF/CNPJ</strong></td>
				<td><strong>Data de entrada</strong></td>
				<td><strong>Total da nota</strong></td>
				<td><strong>Tipo de fornecimento</strong></td>
			</thead>
			<tbody>
				<td><?= $entry_data[0]['name'] ?></td>
				<td><?= $entry_data[0]['cpf_cnpj'] ?></td>
				<td><?= date('d/m/Y', strtotime($entry_data[0]['input_date'])); ?></td>
				<td id="totalHeader">test</td>
				<td><?php switch ($entry_data[0]['input_type']) {
					case '1':
					echo 'Compra';
					break;
					
					case '2':
					echo 'Doação';
					break;
				} ?></td>
			</tbody>
		</table>
	</div>
	<div class="col s8">
		<div>
			<table class="bordered highlight">
				<thead>
					<td><strong>Produto</strong></td>
					<td><strong>Valor unitário</strong></td>
					<td><strong>Quantidade</strong></td>
					<td><strong>Total</strong></td>
				</thead>
				<tbody>
					<?php foreach ($entry_data as $prod) { ?>
					<tr>
						<td><?= $prod['name_product'] ?></td>
						<td>R$ <?= $prod['unit_price'] ?></td>
						<td><?= $prod['amount'] ?></td>
						<td class="total">R$ <?= $prod['unit_price']*$prod['amount'] ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>