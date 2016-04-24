<a href="<?=base_url('stock/outputs') ?>">< Voltar para saídas</a>
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
<?php //var_dump($output_data) ?>
	<h4>Detalhes de saída</h4>
	<div class="card-panel col s10">
		<div class="col s12">
			<ul class="col s6">
				<h6><strong>Retirado por </strong></h6>
				<h5 class="lead blue-text"><?= $output_data['people'][0]['name'] ?></h5>

				<h6><strong>CPF/CNPJ: </strong> <?= $output_data['people'][0]['cpf_cnpj'] ?></h6>

			</ul>
			<ul class="col s3 collection">
				<li class="collection-item">
					<h6>Data de saída</h6>
					<strong><?= date('d/m/Y', strtotime($output_data['entry'][0]['output_date'])); ?></strong>
				</li>

				<li class="collection-item">
					<strong>Total da nota</strong>
					<td id="totalHeader">R$ 0,00</td>
				</li>
				
			</ul>
		</div>
	</div>
	<div class="col s8">
		<div class="collection">
			<table class="bordered highlight">
				<thead>
					<td><strong>Produto</strong></td>
					<td><strong>Descrição</strong></td>
					<td><strong>Valor unitário</strong></td>
					<td><strong>Quantidade</strong></td>
					<td><strong>Total</strong></td>
				</thead>
				<tbody>
					<?php foreach ($output_data['entry'] as $prod) { ?>
					<tr>
						<td><?= $prod['name_product'] ?></td>
						<td><?='desc';//$prod['descript'] ?></td>
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