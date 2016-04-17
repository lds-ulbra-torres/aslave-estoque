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
									items.push($("<li id="+ val.id_people +" ><strong>"+ val.name +"</strong></li>"));
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
									items.push($("<li id="+ val.id_product +" value="+ val.name_product +">"+ val.name_product +"</li>"));
								});	
								$('#loadProduct').append.apply($('#loadProduct'), items);
							}catch(e) {		
								alert('Ocorreu algum erro ao carregar os produtos.');
							}		
						}else{
							$('#loadProduct').html($('<span/>').text("Nenhum produto encontrado."));		
						}		
					},
					error: function(data){
						alert("Ocorreu algum erro ao carregar os produtos.");
					}
				});
			}else{
				$('#loadProduct').empty();
			}
		});
		$("#loadProduct").on("click", "li", function(){
			$("input[name=product]").val("");
			$("#product").html($(this));
			$('#loadProduct').empty();
		});

		$("#add_product_form").submit(function(e){
			$("#add_product__has_entry_btn").attr("disabled", true);
			e.preventDefault();	
			$.ajax({
				url: "<?php echo site_url('/StockController/addProductHasEntry')?>",
				type: "POST",
				data: {
					id_product: $("#product li").attr("id"),
					product_name: $("#product li").attr("value"),
					unit_price: $("input[name=unit_price").val(),
					amount: $("input[name=amount").val()
				},
				success: function(data){
					if(data == 'Produto adicionado.'){
						Materialize.toast(data, 4000);
						$("#add_product__has_entry_btn").attr("disabled", false);
						$("#product").empty();
						$("input[name=price").val("");
						$("input[name=amount").val("");
						$("input[name=product_name]").val("");
						$("#input_stock_product").load(location.href + " #input_stock_product");
					}else{
						Materialize.toast(data, 4000);
						$("#add_product__has_entry_btn").attr("disabled", false);
					}
				},
				error: function(data){
					console.log(data);
					$("#add_product__has_entry_btn").attr("disabled", false);
					Materialize.toast("Erro interno.", 4000);
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
			<div id="loadPeople" class="col s9"></div>
			<div id="people" class="collection col s9"></div>
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
				<?php $i = 1; ?>
				<?php foreach ($this->cart->contents() as $row): ?>
				<?php echo form_hidden($i.'[rowid]', $row['rowid']); ?>
					<tr>
						<td><?= $row['name'] ?></td>
						<td>
							<?php echo form_input(
								array(
									'name' => $i.'[qty]', 
									'value' => $row['qty'], 
									'maxlength' => '3', 
									'size' => '5', 
									'class' => 'col s6')); ?>
						</td>
						<td>R$ <?= $row['price'] ?></td>
						<td>R$ <?= $row['subtotal'] ?></td>
						<td>
							<a class="delete_product_stock_btn" id="<?= $row['id']; ?>" href="#">Remover</a>
						</td>
					</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
				<tr>
					<td><a href="<?= base_url('StockController/cleanAll')?>">Remover todos</a></td>
					<td><?= form_submit('', 'Atualizar'); ?></td>
					<td></td>
					<td><strong>Total: </strong> R$ <?= $this->cart->total(); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div id="add_product_modal" class="modal">
	<form id="add_product_form">
		<div class="modal-content row">
			<h4>Adicionar produto</h4>
			<div class="input-field col s4">	
				<input name="product_name" autocomplete="off" type="text" placeholder="Produto">
				<div id="products" class="">
					<div id="loadProduct" class="collection"></div>
					<div id="product" class="collection"></div>
				</div>
			</div>
			<div class="input-field col s2">
				<input name="amount" required="required" type="number" placeholder="Quantia">
			</div>
			<div class="input-field col s2">
				<input name="unit_price" required="required" type="number" placeholder="Preço" step="0.01" min="0.01">
			</div>

			
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
			<button type="submit" id="add_product__has_entry_btn" class="btn green">Adicionar<i class="material-icons right">send</i></button>
		</div>
	</form>
</div>

