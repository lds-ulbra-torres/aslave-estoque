<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	      $('select').material_select();
	      //Materialize.toast('Bem vindo!', 4000);
	});
</script>
<?php 
	switch ($view){
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

		case 'stock/input':
			$this->load->view('stock/stock/InputStockView', $input_stocks);
			break;

		case 'stock/input/create':
			$this->load->view('stock/stock/CreateInputStockView');
			break;
	}
?>
