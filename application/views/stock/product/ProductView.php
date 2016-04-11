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
		var idProduct;
		$("table").on("click",".delete_product", function(){
			$('#delete_product_modal').openModal();	
			idProduct = $(this).attr("id");
		});

		$("#delete_product").on("click", function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteProduct'); ?>",
				type: "POST",
				data: {id_product: idProduct},
				success: function(data){
					if(!data){
						Materialize.toast('Ocorreu algum erro. Tente novamente', 4000);
					}else{
						Materialize.toast('Produto apagado.', 4000);
						reloadTableProduct();	
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Ocorreu algum erro. Tente novamente', 4000);	
				}
			});
		});
	});
</script>

<div class="container row">
	<h4>Produtos</h4>
	<div class="card-panel col s12">
		<div class="input-field col s3">
			<input id="search" type="text" required>
			<label for="search"><i class="material-icons">search</i></label>
        </div>
        <div class="input-field col s2">
        	<a href="#" class="btn grey">Buscar</a>
        </div>
		<div class="input-field col s4">
			<select id="group_id">
				<option disabled selected>Filtrar por categorias</option>
				<?php foreach($groups as $row) :
					echo "<option value=".$row['id_group'].">";
					echo $row['name_group'];
					echo "</option>";
				endforeach; ?>
			</select>
		</div>
		<div class="input-field col s3">
			<a class="green btn" id="" href="<?= base_url('stock/products/create'); ?>">Adicionar novo</a>
		</div>
	</div>
</div>	
<div class="container row">
	<div class="col s10">
		<table id="product" class="bordered highlight">
			<thead>
				<td><strong>Nome</strong></td>
				<td><strong>Categoria</strong></td>
				<td><strong>Estoque</strong></td>
				<td><strong>Ações</strong></td>
			</thead>
			<tbody>
				<?php foreach($products as $row) :?>
					<tr>
					  <td><?= $row['name_product'] ?></td>
					  <td><?= $row['name_group'] ?></td>
					  <td></td>
					  <td>
						  <a href="<?= base_url('stock/products/update/'.$row['id_product']); ?>">Alterar</a> |
						  <a class="delete_product" id="<?php echo $row['id_product']; ?>" href="#">Apagar</a>
					  </td>
	           		</tr>
	            <?php endforeach; ?>
	        </tbody>
		</table>
	</div>	
</div>

<div id="delete_product_modal" class="modal">
	<div class="modal-content">
		<h4>Aviso</h4>
		<div class="row">
			<p>Realmente quer apagar este produto?</p>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
		<a href="#!" id="delete_product" class=" modal-action modal-close waves-effect waves-green btn-flat">Apagar</a>
	</div>
</div>
