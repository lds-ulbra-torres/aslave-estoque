<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	  $(document).ready(function(){
      $('select').material_select();
      // modal categoria
      $("#cate").click(function(){
      	$('#cateModal').openModal();
      });
      // modal produto
      $("#product").click(function(){
      	$('#productModal').openModal();
      });
      // modal estoque
      $("#stock").click(function(){
      	$("#stockModal").openModal();
      });
      function reloadTable(){
      	$("#divTable").load(location.href + " #divTable>*", "");
      }
      $("#addCat").submit(function(e){
      	e.preventDefault();	
      	$.ajax({
      		url: "<?php echo site_url('/StockController/createGroup'); ?>",
      		type: "POST",
      		data: $("#addCat").serialize(),
      		success: function(data){
      			if(!data){
      				$("#error_name_cat").text("Campo Obrigatorio!");
      			}else{
      				Materialize.toast('Categoria cadastrada com sucesso', 4000);
      				$('#cateModal').closeModal();
      				$("input[name=name]").val("");
      			}
      		},
      		error: function(data){
      			alert(data);
      			Materialize.toast('Erro ao adicionar uma nova categoria!', 4000);
      		}
      	});
      });
      $("#addProduct").submit(function(e){
      	e.preventDefault();
      	$.ajax({
      		url: "<?php echo site_url('/StockController/createProduct'); ?>",
      		type: "POST",
      		data: {
      			product_name: $("#product_name").val(),
      			id_group: $("#group").val()
      		},
      		success: function(data){
	    		if(!data){
	    			$("#error_product").text("Campo Obrigatorio!");
	    		}else{
	    			$('#productModal').closeModal();
      				$("#product_name").val("");
      				$("#group").val("");
      				Materialize.toast('Produto adicionado com sucesso!', 4000);
	    		}
      		},
      		error: function(data){
      			alert(data);
      			Materialize.toast('Erro ao adicionar um novo produto!', 4000);
      		}
      	});
      });
      $("#addStock").submit(function(e){
      	e.preventDefault();
      	$.ajax({
      		url: "<?php echo site_url('/StockController/inputStock'); ?>",
      		type: "POST",
      		data: {
      			stock_product: $("#name_product").val(),
      			stock_price: $("#price_product").val(),
      			stock_amount: $("#amount_product").val(),
      			stock_date: $("#date_product").val()
      		},
      		success: function(data){
      			if(!data){
      				$("#error_stock").text("Campos obrigatorios!");
      			}else{
      				$('#stockModal').closeModal();
      				$("#product_name").val("");
      				$("#group").val("");
      				Materialize.toast('Entrada de estoque adicionada com sucesso', 4000);
      				reloadTable();	
      			}
      		},
      		error: function(data){
      			alert(data);
      			Materialize.toast('Erro ao adicionar umma nova entrada de estoque', 4000);
      		}
      	});
      });
 	 });
</script>

<div>
	<div>
		<a class="waves-effect waves-light btn modal-trigger" id="cate" href="#cateModal">+Categoria</a>
		<a class="waves-effect waves-light btn modal-trigger" id="product" href="#productModal">+Produto</a>
		<a class="waves-effect waves-light btn modal-trigger" id="stock" href="#stockModal">+Entrada de estoque</a>

		<br>
		<div id="cateModal" class="modal">
			<div class="modal-content">
				<h4>Adicionar Categoria</h4>
				<div class="row">
					<form id="addCat" class="col s12">
						<label id="error_name_cat"></label>
						<input placeholder="Nome da categoria" id="cat_name" name="group_name" type="text" class="validate"></input>
						<button class="btn waves-effect waves-light" type="submit" name="action">Adicionar
							<i class="material-icons right">send</i>
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
			</div>
		</div>

		<div id="productModal" class="modal">
			<div class="modal-content">
				<h4>Adicionar Produto</h4>
				<div class="row">
					<form id="addProduct" class="col s12">
						<label id="error_product"></label>
						<input placeholder="Nome do produto" id="product_name" name="name" type="text" class="validate"></input>
						<div class="input-field col s12">
							<select id="group">
								<option value="" disabled selected>Seleciona uma Categoria</option>
								<?php
									foreach($groups as $dados){ 
										echo "<option value=".$dados['id_group'].">";
										echo $dados['name_group'];
										echo"</option>";
									}
								?>
							</select>
							<label>Categorias</label>
						</div>
						<button class="btn waves-effect waves-light" type="submit" name="action">Adicionar
							<i class="material-icons right">send</i>
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
			</div>
		</div>

		<div id="stockModal" class="modal">
			<div class="modal-content">
				<h4>Entrada de Estoque</h4>
				<div class="row">
					<form id="addStock" class="col s12">
						<div class="input-field col s12">
							<lavel id="error_stock"></lavel>
							<select id="name_product">
								<option value="" disabled selected>Seleciona um Produto</option>
								<?php
									foreach($products as $dados){ 
										echo "<option value=".$dados['id_product'].">";
										echo $dados['name_product'];
										echo"</option>";
									}
								?>
							</select>
							<label>Produto</label>
						</div>
						<input placeholder="Preço" id="price_product" name="price_product" type="text" class="validate"></input>
						<input placeholder="Quantidade" id="amount_product" name="amount_product" type="text" class="validate"></input>
						<input placeholder="Data de Entrada" id="date_product" name="date_product" type="date" class="datepicker">
						<button class="btn waves-effect waves-light" type="submit" name="action">Adicionar
							<i class="material-icons right">send</i>
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
			</div>
		</div>

	</div>

	<div id="divTable">
		<table class="striped">
			<thead>
				<td>
					Produto
				</td>
				<td>
					Categoria
				</td>
				<td>
					Preço
				</td>
				<td>
					Quantidade
				</td>
				<td>
					Total
				</td>
				<td>
					Data de entrada
				</td>
				<td>
					Data de saida
				</td>
				<td>
					Saida de estoque
				</td>
			</thead>
			<tbody>
					<?php
						foreach($stocks as $dados){ 
							echo "<tr>";
							echo "<td>";
							echo $dados['name_product'];
							echo "</td>";
							echo "<td>";
							echo $dados['name_group'];
							echo "</td>";
							echo "<td>";
							echo $dados['price'];
							echo "</td>";
							echo "<td>";
							echo $dados['amount'];
							echo "</td>";
							echo "<td>";
							echo $dados['total'];
							echo "</td>";
							echo "<td>";
							echo $dados['input'];
							echo "</td>";
							echo "<td>";
							echo $dados['output'];
							echo "</td>";
							echo"</tr>";
						}
					?>
			</tbody>
		</table>	
	</div>
</div>