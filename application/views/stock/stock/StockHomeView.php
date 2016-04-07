<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	      $('select').material_select();
	      //Materialize.toast('Bem vindo!', 4000);
	});
</script>
<div>
	<div class="center-align">
		<ul class="">
			<lu><a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/groups/create'); ?>">+Categoria</a></lu>
			<lu><a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/products/create'); ?>">+Produto</a></lu>
			<lu><a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/input'); ?>">+Entrada de estoque</a></lu>
			<lu><a class="waves-effect waves-light btn modal-trigger" id="" href="<?= base_url('stock/output'); ?>">-Saída de estoque</a></lu>
			<lu><a class="waves-effect waves-dark btn modal-trigger" id="" href="<?= base_url('stock'); ?>">Ver Estoque</a></lu>
			<lu><a class="waves-effect waves-dark btn modal-trigger" id="" href="<?= base_url('stock/products'); ?>">Ver produtos</a></lu>
			<lu><a class="waves-effect waves-dark btn modal-trigger" id="" href="<?= base_url('stock/groups'); ?>">Ver categorias</a></lu>
		</ul>
	</div>

<?php 
	switch ($view){
		case 'groups':
			$this->load->view('stock/group/GroupView', $groups);
			break;

		case 'groups/create':
			$this->load->view('stock/group/CreateGroupView');
			break;

		case 'products':
			$this->load->view('stock/product/ProductView', $products, $groups);
			break;

		case 'products/create':
			$this->load->view('stock/product/CreateProductView', $groups);
			break;

		case 'stock/input':
			$this->load->view('stock/stock/StockInputView', $products);
			break;

		case 'stock/output':
			$this->load->view('stock/stock/StockOutputView', $products);
			break;

		default :
			$this->load->view('stock/stock/StockMovementView', $stock_in, $stock_out);
			break;
	}
?>

</div>