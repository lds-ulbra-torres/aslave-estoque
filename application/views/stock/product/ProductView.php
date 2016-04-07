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
		$("table").on("click",".deleteProduct", function(){
			$('#productModal').openModal();	
			idProduct = $(this).attr("id");
		});

		$("table").on("click",".updateProduct", function(){
			$('#updateModal').openModal();	
			idProduct = $(this).attr("id");
		});

		$("#deleteProduct").on("click", function(){
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

		$("#updateProductForm").submit(function(e){
      	e.preventDefault();
	      	$.ajax({
	      		url: "<?php echo site_url('/StockController/updateProduct'); ?>",
	      		type: "POST",
	      		data: {
	      			id_product: idProduct,
	      			product_name: $("#product_name").val(),
	      			id_group: $("#group_id").val()
	      		},
	      		success: function(data){
					var field = "O campo é obrigatorio";
					if(!data){
						Materialize.toast('Todos os campos são obrigatórios!', 4000);
					}else{
						Materialize.toast('Categoria de produtos salva.', 4000);
						$('#updateModal').closeModal();
						reloadTableProduct();
					}
				},
				error: function(data){
					alert(data);
					Materialize.toast('Ocorreu algum erro. Tente novamente', 4000);
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
			<td>Estoque</td>
			<td>Ações</td>
		</thead>
		<tbody>
			<?php foreach($products as $row) :?>
				<tr>
				  <td><?= $row['name_product'] ?></td>
				  <td><?= $row['name_group'] ?></td>
				  <td><?= $row['amount'] ?></td>
				  <td>
					  <a class="updateProduct" id="<?php echo $row['id_product']; ?>" href="#">Alterar</a> |
					  <a class="deleteProduct" id="<?php echo $row['id_product']; ?>" href="#">Apagar</a>
				  </td>
           		</tr>
                  <?php endforeach; ?>
        </tbody>
	</table>	
</div>

<div id="productModal" class="modal">
	<div class="modal-content">
		<h4>Aviso</h4>
		<div class="row">
			<p>Realmente quer apagar este produto?</p>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
		<a href="#!" id="deleteProduct" class=" modal-action modal-close waves-effect waves-green btn-flat">Apagar</a>
	</div>
</div>	

<div id="updateModal" class="modal">
	<div class="modal-content">
		<form method="post" id="updateProductForm">
			<h4>Alterar produto</h4>
			<input placeholder="Nome" id="product_name" name="product_name" type="text"></input>
			<select name="group_id" id="group_id">
				<option name="group_id" disabled selected>Selecione uma Categoria</option>
				<?php foreach($groups as $gp) :
					echo "<option value=".$gp['id_group'].">";
					echo $gp['name_group'];
					echo "</option>";
				endforeach; ?>
			</select>
			<button class="btn waves-effect waves-light" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>