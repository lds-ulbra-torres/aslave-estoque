<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
<style type="text/css">
	li{
		list-style: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		function reloadTableInputSockProduct(){
			$.ajax({
				url: "<?php echo site_url('/StockController/CreateInputStockView/')?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#input_stock_product").html($(data).find("table"));
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);	
				}
			});
		}

		$("input[name=product_name]").keyup(function(){
			if($(this).val() != ''){
				$.ajax({
					url: "<?php echo site_url('/StockController/searchProductStock')?>",
					type: "POST",
					cache: false,
					data: {name_product: $(this).val()},
					success: function(data){
						$('#loadProduct').html("");
						var obj = JSON.parse(data);
						if(obj.length>0){
							try{
								var items=[]; 	
								$.each(obj, function(i,val){											
									items.push($("<br><li  id="+ val.id_product +">"+ val.name_product +"</li>"));
								});	
								$('#loadProduct').append.apply($('#loadProduct'), items);
							}catch(e) {		
								alert('Ocorreu algum erro ao carregar os Produto!');
							}		
						}else{
							$('#loadProduct').html($('<span/>').text("Nenhum Produto encontrado!"));		
						}		
					},
					error: function(data){
						alert("Ocorreu algum erro ao carregar os Produto");
					}
				});
			}else{
				$('#loadProduct').empty();
			}
		});
		$("#loadProduct").on("click", "li", function(){
			$("input[name=people]").val("");
			$("#product").html($(this));
			$('#loadProduct').empty();
		});
		$("#add_product_btn").click(function(){
			$('#add_product').openModal();	
		});
		$("#form_add_product_input_stock").submit(function(e){
			e.preventDefault();
			$("#add_product_input_stock_btn").attr("disabled", true);
			$.ajax({
				url: "<?php echo site_url('/StockController/createInputStockProductController')?>",
				type: "POST",
				data: {
					id_stock: "<?= $this->uri->segment(4) ?>",
					id_product: $("#product li").attr("id"),
					unit_price: $("input[name=price").val(),
					amount: $("input[name=amount").val()
				},
				success: function(data){
					if(data == 'Produto cadastrado com sucesso!'){
						Materialize.toast(data, 4000);
						$("#add_product_input_stock_btn").attr("disabled", false);
						$("#product").empty();
						$("input[name=price").val("");
						$("input[name=amount").val("");
						$("input[name=product_name]").val("");
						$('#add_product').closeModal();
						$("#input_stock_product").load(location.href + " #input_stock_product");
					}else{
						Materialize.toast(data, 4000);
						$("#add_product_input_stock_btn").attr("disabled", false);
					}
				},
				error: function(data){
					console.log(data);
					$("#add_product_input_stock_btn").attr("disabled", false);
					Materialize.toast("Ocorreu algum erro ao cadastrar este produto nesta entrada de estoque", 4000);
				}
			});
		});
		var idProdutoStock;
		$("#input_stock_product").on("click", ".delete_product_stock_btn", function(){
			$("#delete_product_stock").openModal();
			idProdutoStock = $(this).attr("id");
		});

		$("#delete_product_stock").click(function(){
			$.ajax({
				url:"<?php echo site_url('/StockController/deleteProductInputStock')?>",
				type: "POST",
				data: {idProdutoStock: idProdutoStock},
				success: function(data){
					Materialize.toast("Produto removido", 2000);
					reloadTableInputSockProduct();
				},
				error: function(data){
					console.log(data);
					Materialize.toast("Ocorreu algum erro ao deletar este produto desta entrada de estoque", 4000);
				}
			});
		});
	});
</script>
<div class="container row">
	<h4>Adicionar produtos</h4>

	
	<div class="col s12">
		<div class="right-align">
			<button id="add_product_btn" class="btn green">Adicionar</button>
		</div>
		<table id="input_stock_product" class="bordered highlight">
			<thead>
				<td><strong>Nome</strong></td>
				<td><strong>Quantidade</strong></td>
				<td><strong>Valor unitário</strong></td>
				<td><strong>Valor total</strong></td>
				<td><strong>Açoes</strong></td>
			</thead>
			<tbody>
				<?php foreach($input_has_products as $row) :?>
					<tr>
						<td><?= $row['name_product'] ?></td>
						<td><?= $row['amount'] ?></td>
						<td><?= $row['unit_price'] ?></td>
						<td><?= $row['amount']*$row['unit_price'] ?></td>
						<td>
							<a class="delete_product_stock_btn" id="<?= $row['id_product']; ?>" href="#">Remover</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<div id="add_product" class="modal">
	<form id="form_add_product_input_stock">
		<div class="modal-content row">
			<h4>Adicionar produto</h4>
			<div class="input-field col s4">	
				<input name="product_name" type="text" placeholder="Produto">
			</div>
			<div class="input-field col s2">
				<input name="amount" required="required" type="number" placeholder="Quantia">
			</div>
			<div class="input-field col s2">
				<input name="price" required="required" type="number" placeholder="Preço" step="0.01" min="0.01">
			</div>

			<div id="products" class="col s12">
				<div id="loadProduct" class="collection">
					
				</div>
				<div id="product" class="collection">
					
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
			<button type="submit" id="add_product_input_stock_btn" class="btn green">Adicionar<i class="material-icons right">send</i></button>
		</div>
	</form>
</div>

<div id="delete_product_stock" class="modal">
	<form>
		<div class="modal-content row">
			<h4>Aviso</h4>
			<div class="row">
				<p>Realmente quer apagar este produto desta entrada de estoque?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
			<a href="#" id="delete_product_stock" class="btn-flat modal-action modal-close">Apagar</a>
		</div>
	</form>
</div>
