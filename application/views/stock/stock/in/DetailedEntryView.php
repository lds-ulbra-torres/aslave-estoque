<a href="<?=base_url('stock/entries') ?>">< Voltar para entradas</a>
<script type="text/javascript">
	$(document).ready(function(){
		var total = 0
		$(".total").each(function(){
			total += Number($(this).text().replace(/[^0-9.,]/g,''));
			
		});
		$("#totalHeader").text("R$ "+ total);
	});
</script>
<div class="row">
<?php //var_dump($entry_data) ?>
	<h4>Detalhes de entrada</h4>
	<div class="card-panel col s10">
		<div class="col s12">
			<ul class="col s6">
				<h6><strong>Fornecido por</strong></h6>
				<h5 class="lead blue-text"><?= $entry_data['people'][0]['name'] ?></h5>

				<h6><strong>CPF/CNPJ: </strong> <?= $entry_data['people'][0]['cpf_cnpj'] ?></h6>

			</ul>
			<ul class="col s3">
				<li class="collection-item">
					<?php switch ($entry_data['entry'][0]['input_type']) {
						case '1':
						echo '<div class="chip">Compra</div>';
						break;
						
						case '2':
						echo '<div class="chip">Doação</div>';
						break;
					}?>
				</li>
			</ul>
			<ul class="col s3 collection">
				<li class="collection-item">
					<strong>Data de entrada</strong>
					<strong class="chip"><?= date('d/m/Y', strtotime($entry_data['entry'][0]['input_date'])); ?></strong>
				</li>

				<li class="collection-item">
					<strong>Total da nota: </strong>
					<strong class="chip"><?='R$ ' . number_format($entry_data['entry'][0]['sum_value'], 2, ',', '.');?></strong>
				</li>
				
			</ul>
		</div>
	</div>
	<div class="col s8">
		<div class="collection">
			<table class="bordered highlight">
				<thead>
					<td><strong>Produto</strong></td>
					<td><strong>Valor unitário</strong></td>
					<td><strong>Quantidade</strong></td>
					<td><strong>Total</strong></td>
				</thead>
				<tbody>
					<?php foreach ($entry_data['entry'] as $prod) { ?>
					<tr>
						<td><?= $prod['name_product'] ?></td>
						<td><?='R$ ' . number_format($prod['unit_price_input'], 2, ',', '.');?></td>
						<td><?= $prod['amount_input'] ?></td>
						<td class="total" hidden><?= $prod['unit_price_input']*$prod['amount_input'] ?></td>
						<td><?='R$ ' . number_format($prod['unit_price_input']*$prod['amount_input'], 2, ',', '.');?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>