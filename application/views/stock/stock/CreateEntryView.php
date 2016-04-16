<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
<style type="text/css">
	li{
		list-style: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add_people_btn").click(function(){
			$('#add_people').openModal();	
		});

		$("#add_product_btn").click(function(){
			$('#add_product_modal').openModal();	
		});
		$("input[name=people]").keyup(function(){
			if($(this).val() != ''){
				$.ajax({
					url: "<?php echo site_url('/StockController/searchPeople')?>",
					type: "POST",
					cache: false,
					data: {name_people: $(this).val()},
					success: function(data){
						$('#loadPeople').html("");
						var obj = JSON.parse(data);
						if(obj.length>0){
							try{
								var items=[]; 	
								$.each(obj, function(i,val){											
									items.push($("<option  id="+ val.id_people +">"+ val.name +"</option>"));
								});	
								$('#loadPeople').append.apply($('#loadPeople'), items);
							}catch(e) {		
								alert('Ocorreu algum erro ao carregar os Fornecedores!');
							}		
						}else{
							$('#loadPeople').html($('<span/>').text("Nenhum Fornecedor encontrado!"));		
						}		
					},
					error: function(data){
						alert("Ocorreu algum erro ao carregar os Fornecedores");
					}
				});
			}else{
				$('#loadPeople').empty();
			}
		});

		$("#loadPeople").on("click", "li", function(){
			$("input[name=people]").val("");
			$("#people").html($(this));
			$('#loadPeople').empty();
		});

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
									items.push($("<option id="+ val.id_product +">"+ val.name_product +"</option>"));
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
	});
</script>
<div class="row">
	<div class="col s9">
		<h4>Nova entrada</h4>
		<div class="input-field col s4">
			<input name="people" type="text" autocomplete="off" required placeholder="Fornecedor">
		</div>
		<div class="input-field col s2">
			<select name="stock_type" id="stock_type">
				<option selected value="1">Compra</option>
				<option value="2">Doação</option>
			</select>
		</div>
		<div class="input-field col s3">
			<input placeholder="Data" name="date" type="date" required>
		</div>

		<div id="loadPeople" class="col s9">
		</div>
		<div id="people" class="collection col s9">
		</div>
	</div>

	<div class="col s8">
		<div class="left-align">
			<button id="add_product_btn" class="btn green">Adicionar produto</button>
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

<div id="add_product_modal" class="modal">
	<form id="">
		<div class="modal-content row">
			<h4>Adicionar produto</h4>
			<div class="input-field col s4">	
				<input name="product_name" autocomplete="off" type="text" placeholder="Produto">
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

