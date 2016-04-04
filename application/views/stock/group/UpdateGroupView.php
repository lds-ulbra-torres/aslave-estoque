<div class="container">
	<form method="post" action="<?php base_url('stock/groups/update'); ?>" class="">
		<h4>Alterar categoria</h4>
		<input type="text" value="<?= $group['group_name']; ?>" name="group_name" placeholder="Nome">

		<button type="submit" class="waves-effect waves-dark btn modal-trigger">Salvar</button>
	</form>
</div>