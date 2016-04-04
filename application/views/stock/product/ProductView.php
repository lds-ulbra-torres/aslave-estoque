<script type="text/javascript">
	$(document).ready(function(){
		function reloadTableProduct(){
			$.ajax({
				url: "<?= base_url('stock/products/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#product").html($(data).find("table"));
					console.log($(data).find("table"));
				},
				error: function(){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);	
				}
			});
		}
		var idProdutct;
		$("table").on("click",".deleteProduct", function(){
			$('#productModal').openModal();	
			idProdutct = $(this).attr("id");
		});
		$("#deleteProduct").on("click", function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteProduct'); ?>",
				type: "POST",
				data: {id_product: idProdutct},
				success: function(data){
					if(!data){
						Materialize.toast('Erro ao deletar o produto!', 4000);
					}else{
						Materialize.toast('Produto deletado!', 4000);
						reloadTableProduct();	
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao deletar a categoria!', 4000);	
				}
			});
		});
	});
</script>
<div id="content_table" class="container">
	<table id="product" class="striped">
		<legend><h4>Produtos</h4></legend>
		<thead>
			<td>Nome</td>
			<td>Categoria</td>
			<td>Ações</td>
		</thead>
		<tbody>
			<?php foreach($products as $row) :?>
				<tr>
				  <td><?= $row['name_product'] ?></td>
				  <td><?= $row['name_group'] ?></td>
				  <td><a href="<?= base_url('stock/products/update/'.$row['id_group']); ?>">Alterar</a> |
				  <a class="deleteProduct" id="<?php echo $row['id_product']; ?>" href="#">Apagar</a></td>
           		</tr>
                  <?php endforeach; ?>
        </tbody>
	</table>
	<div id="productModal" class="modal">
		<div class="modal-content">
			<h4>Aviso</h4>
			<div class="row">
				<p>Realmente quer deletar este Produto?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="deleteProduct" class=" modal-action modal-close waves-effect waves-green btn-flat">Apagar</a>
		</div>
	</div>		
</div>