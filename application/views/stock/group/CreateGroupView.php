<div class="container">
	<?php 
		echo (isset($create_success)) ? "<div class=\"alert alert-success\"><strong>$create_success</strong><a class=\"close\" data-dismiss=\"alert\">×</a></div>" : '';
		echo (isset($create_error)) ? "<div class=\"alert alert-error\"><strong>$create_error</strong><a class=\"close\" data-dismiss=\"alert\">×</a></div>" : '';
	 ?>
	<form method="post" action="<?php base_url('stock/groups/create'); ?>" class="">
		<h4>Cadastrar categoria</h4>
		<?= form_error('group_name', '<p>', '</p>') ?>
		<input type="text" name="group_name" placeholder="Nome">

		<button type="submit" class="waves-effect waves-dark btn modal-trigger">Salvar</button>
	</form>
	
</div>