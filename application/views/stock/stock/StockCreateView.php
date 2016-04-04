<div class="container">
	<h4>Entrada de Estoque</h4>
	<div class="row">
		<form method="post" action="<?= base_url('stock/create'); ?>">
			<div class="">
			<?= form_error('id_product', '<p>', '</p>'); ?>
				<select name="id_product">
					<option name="id_product"  disabled selected>Selecione um Produto</option>
						<?php foreach($products as $dados) : 
							echo "<option value=".$dados['id_product'].">";
							echo $dados['name_product'];
							echo"</option>";
						endforeach; ?>
				</select>
			</div>
			<?= form_error('price_product', '<p>', '</p>'); ?>
			<input placeholder="Preço" name="price_product" type="number"></input>
			<?= form_error('amount_product', '<p>', '</p>'); ?>
			<input placeholder="Quantidade" name="amount_product" type="number"></input>
			<?= form_error('date_product', '<p>', '</p>'); ?>
			<input placeholder="Data de Entrada" name="date_product" type="date">
			<button class="btn waves-effect waves-light" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>