<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	      $('select').material_select();
	      //Materialize.toast('Bem vindo!', 4000);
	});
</script>
<div class="row">
	<div class="collection col s2">
		<p class=""><h4>Estoque 1.0</h4></p>
		<a href="<?=base_url('stock/products'); ?>" class="collection-item">Produtos</a>
		<a href="<?=base_url('stock/groups'); ?>" class="collection-item">Categorias</a>
		<a href="<?=base_url('stock/entries'); ?>" class="collection-item">Entradas de estoque</a>
		<a href="<?=base_url('stock'); ?>" class="collection-item">Saídas de estoque</a>
		<a href="<?=base_url('stock'); ?>" class="collection-item">Visão geral</a>
		<a href="<?=base_url('stock'); ?>" class="collection-item">Estoque detalhado</a>
	</div>
	<div class="col s10">
		<?php switch ($view){
			case 'groups':
				$this->load->view('stock/group/GroupView', $groups);
				break;

			case 'groups/create':
				$this->load->view('stock/group/CreateGroupView');
				break;

			case 'groups/update':
				$this->load->view('stock/group/UpdateGroupView');
				break;

			case 'products':
				$this->load->view('stock/product/ProductView', $products);
				break;

			case 'products/create':
				$this->load->view('stock/product/CreateProductView', $groups);
				break;

			case 'products/update':
				$this->load->view('stock/product/UpdateProductView', $groups);
				break;

			case 'stock/entries':
				$this->load->view('stock/stock/EntriesView', $input_stocks);
				break;

			case 'stock/entries/create':
				$this->load->view('stock/stock/CreateEntryView');
				break;

			case 'stock/entries/detailed':
				$this->load->view('stock/stock/DetailedEntryView');
				break;
		}?>
	</div>
</div>
