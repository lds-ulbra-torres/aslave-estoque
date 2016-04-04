
<div class="container">
	<div class="">
		<form method="post" action="<?php base_url('stock/products/create') ?>">
			<h4>Cadastrar produto</h4>
			<?php 
				echo (isset($create_success)) ? "<div class=\"alert alert-success\"><strong>$create_success</strong><a class=\"close\" data-dismiss=\"alert\">×</a></div>" : '';
				echo (isset($create_error)) ? "<div class=\"alert alert-error\"><strong>$create_error</strong><a class=\"close\" data-dismiss=\"alert\">×</a></div>" : '';
			 ?>
			<?= form_error('product_name', '<p>', '</p>') ?>
			<input placeholder="Nome" name="product_name" type="text"></input>
			<div class="">
			<?= form_error('group_id', '<p>', '</p>') ?>
			<select name="group_id">
				<option name="group_id" disabled selected>Selecione uma Categoria</option>
				<?php foreach($groups as $row) :
					echo "<option value=".$row['id_group'].">";
					echo $row['name_group'];
					echo "</option>";
				endforeach; ?>
			</select>
			</div>
			<button class="waves-effect waves-dark btn modal-trigger" type="submit">Salvar</button>
		</form>
	</div>
</div>