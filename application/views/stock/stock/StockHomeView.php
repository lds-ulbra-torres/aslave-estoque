<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	      $('select').material_select();
	      //Materialize.toast('Bem vindo!', 4000);
	});
</script>

<div class="">
	<a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/groups/create'); ?>">+Categoria</a>
	<a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/products/create'); ?>">+Produto</a>
	<a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/create'); ?>">+Entrada de estoque</a>
	<a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock'); ?>">-Saída de estoque</a>
	<a class="waves-effect waves-dark btn modal-trigger" id="" href="<?= base_url('stock'); ?>">Ver Estoque</a>
	<a class="waves-effect waves-dark btn modal-trigger" id="" href="<?= base_url('stock/products'); ?>">Ver produtos</a>
	<a class="waves-effect waves-dark btn modal-trigger" id="" href="<?= base_url('stock/groups'); ?>">Ver categorias</a>

<?php 
	echo (isset($create_success)) ? "<div class=\"alert alert-success\"><strong>$create_success</strong><a class=\"close\" data-dismiss=\"alert\">×</a></div>" : '';
	echo (isset($create_error)) ? "<div class=\"alert alert-error\"><strong>$create_error</strong><a class=\"close\" data-dismiss=\"alert\">×</a></div>" : '';
 ?>

<?php 
	switch ($view){
		case 'groups':
			$this->load->view('stock/group/GroupView', $groups);
			break;

		case 'products':
			$this->load->view('stock/product/ProductView', $products);
			break;

		case 'groups/create':
			$this->load->view('stock/group/CreateGroupView');
			break;

		case 'groups/update':
			$this->load->view('stock/group/UpdateGroupView', $id);
			break;

		case 'products/create':
			$this->load->view('stock/product/CreateProductView', $groups);
			break;

		case 'stock/create':
			$this->load->view('stock/stock/StockCreateView', $products);
			break;

		default :
			$this->load->view('stock/stock/StockMovementView', $stocks);
			break;
	}
?>

</div>