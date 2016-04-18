<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
<style type="text/css">
	li{
		list-style: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){

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

		$("#loadPeople").on("click", "option", function(){
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
		$("#loadProduct").on("click", "option", function(){
			$("input[name=product_name]").val("");
			$("#product").html($(this));
			$('#loadProduct').empty();
		});
		$("#add_product_input_stock_btn").click(function(e){
			e.preventDefault();
			$("#add_product_modal").closeModal();
			
			var newRow = $("<tr class='productRow'>");
			var cols = "";

			cols += '<td class="tdProductId" id='+ $("#product option").attr("id") +'>'+ $("#product option").text() +'</td>';
			cols += '<td class="tdProductAmount">'+ $("input[name=amount]").val() +'</td>';
			cols += '<td class="tdProductPrice">'+ $("input[name=price]").val() +'</td>';
			cols += '<td class="tdProductTotal">'+ $("input[name=price]").val() * $("input[name=amount]").val() +'</td>';
			cols += '<td>';
			cols += '<a href="#" class="removeProduct">Remover</a>';
			cols += '</td>';

			newRow.append(cols);
			$("#input_stock_product").append(newRow);
			$("input[name=amount]").val("");
			$("input[name=price]").val("");
			$("input[name=product_name]").val("");
			$('#loadProduct').empty();
		});
		$("#input_stock_product").on("click", ".removeProduct", function(e){
			e.preventDefault();
			$(this).closest('tr').remove();
		});
		$("#add_input_stock_btn").click(function(e){
			e.preventDefault();
			
			var productsData = [];
			$(".productRow").each(function(i){
				var pData = { 
					id_product: $(this).find(".tdProductId").attr("id"),
					amount:  $(this).find(".tdProductAmount").text(),
					price: $(this).find(".tdProductPrice").text()
				};
				productsData.push(pData);
			});

			$.ajax({
				url: "<?php echo site_url('/StockController/createInputStock')?>",
				type: "POST",
				data: {
					id_people: $("#people option").attr("id"),
					type: $("#stock_type").val(),
					date: $("input[name=date]").val(),
					products: JSON.stringify(productsData)
				},
				success: function(data){
					Materialize.toast(data, 4000);
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao adicionar uma nova entrada de estoque!', 4000);
				}
			});
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
		<div id="people" class="col s9">
		</div>
	</div>

	<div class="col s8">
		<div class="left-align">
			<button id="add_product_btn" class="btn green">Adicionar produto</button>
		</div>
		<table  class="bordered highlight">
			<thead>
				<td><strong>Nome</strong></td>
				<td><strong>Quantidade</strong></td>
				<td><strong>Valor unitário</strong></td>
				<td><strong>Valor total</strong></td>
				<td><strong>Açoes</strong></td>
			</thead>
			<tbody id="input_stock_product">
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
	<button id="add_input_stock_btn" class="btn green">Salvar<i class="material-icons right">send</i> </button>
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
				<div id="loadProduct" class="col s9">

				</div>
				<div id="product" class="col s9">

				</div>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
			<button id="add_product_input_stock_btn" class="btn green">Adicionar<i class="material-icons right">send</i> </button>
		</div>
	</form>
</div>

