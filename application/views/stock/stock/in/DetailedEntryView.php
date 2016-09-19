<div class="container">
	<div class="card-panel blue-text">
		<h4>Detalhes de entrada [<?= $entry_data['entry'][0]['id_stock']; ?>]</h4>
		<div class="right-align">
			<a class="btn teal" href="<?=base_url('stock/entries') ?>"><i class="material-icons">input</i> Voltar</a>
			<a class="btn" href="<?= base_url('stock/entries/update/'.$entry_data['entry'][0]['id_stock']); ?>"><i class="material-icons">edit</i> Editar</a>
		</div>
	</div>
	<div class="row">
		<div class="card-panel">
			<dl class="dl-horizontal">
				<dt>Fornecedor</dt>
				<dd><?= $entry_data['people'][0]['name'] ?></dd>

				<dt>CPF/CNPJ</dt>
				<dd><?= $entry_data['people'][0]['cpf_cnpj'] ?></dd>

				<dt>Tipo</dt>
				<dd>
					<?php echo $entry_data['entry'][0]['input_type'] == 1 ? "Compra": "Doação"; ?>
				</dd>

				<dt>Data de Entrada</dt>
				<dd><?= date('d/m/Y', strtotime($entry_data['entry'][0]['input_date'])); ?></dd>

				<dt>Total da Nota</dt>
				<dd><?='R$ '. number_format($entry_data['entry'][0]['sum_value'], 2, ',', '.');?></dd>
			</dl>
		</div>
	</div>

	<div class="card-panel">
		<div class="collection responsive-table">
			<table id="productInput" class="bordered highlight">
				<thead>
					<td><strong>Produto</strong></td>
					<td><strong>Valor unitário</strong></td>
					<td><strong>Quantidade</strong></td>
					<td><strong>Total</strong></td>
				</thead>
				<tbody id="newProduct">

				</tbody>
				<tbody id="enteredProducts">
					<?php foreach ($entry_data['entry'] as $prod) { ?>
					<tr>
						<td><?= $prod['name_product'] ?></td>
						<td><?='R$ '. number_format($prod['unit_price_input'], 2, ',', '.');?></td>
						<td><?= $prod['amount_input'] ?></td>
						<td class="total" hidden><?= $prod['unit_price_input']*$prod['amount_input'] ?></td>
						<td><?='R$ '. number_format($prod['unit_price_input']*$prod['amount_input'], 2, ',', '.');?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

</div>
<div id="add_product_modal" class="modal">
	<form id="generate_table_product">
		<div class="modal-content row bodyModal">
			<h4>Adicionar produto</h4>
			<div class="input-field col s12 m4">
				<input name="product_name" autocomplete="off" type="text" maxlength="45" placeholder="Produto">
				<div id="products" class="col s12 m12">
					<a href="#" id="loadProduct" class="col s12 m6"></a>
					<h5 id="product" class="col s12 m6"></h5>
				</div>
			</div>
			<div class="input-field col s12 m4">
				<input name="amount" required="required" type="number" placeholder="Quantia">
			</div>
			<div class="input-field col s12 m2">
				<input name="price" required="required" type="number" placeholder="Preço" step="0.01" min="0.01">
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
			<button id="add_product_input_stock_btn" class="btn green">Adicionar<i class="material-icons right">send</i> </button>
		</div>
	</form>
</div>
