<a href="<?=base_url('stock/outputs') ?>">< Voltar para saídas</a>
<script type="text/javascript">
	$(document).ready(function(){
		var total = 0
		$(".total").each(function(){
			total += Number($(this).text().replace(/[^0-9.,]/g,''));
			
		});
		$("#totalHeader").text("R$ "+ total);

		function reloadTableProductOutput(){
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#enteredProducts").html(" ");
					$("#enteredProducts").html($(data).find("#enteredProducts > tr"));
					$("#sum_value").html($(data).find("#sum_value"));
				},
				error: function(){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);	
				}
			});
		}
		function reloadTableProductOutputAfterInsert(){
			$.ajax({
				url: window.location.href,
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#productOutput").html($(data).find("#productOutput"));
					$("#sum_value").html($(data).find("#sum_value"));
				},
				error: function(){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);	
				}
			});
		}
		$("#productOutput").on("click", ".deleteProductBtn", function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/removeProductOutputStock')?>",
				type: "POST",
				data: {id_product: $(this).attr("id")},
				success: function(data){
					if(data){
						Materialize.toast("Produto retirado com sucesso", 4000);
						reloadTableProductOutput();
					}else{
						Materialize.toast(data, 4000);
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast("Ocorreu algum erro ao retirar este produto", 4000);
				}
			});
		});

		$("#add_product_btn").click(function(){
			$('#add_product_modal').openModal();	
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
									items.push($("<option name="+val.unit_price+" id="+ val.id_product +">"+ val.name_product +"</option>"));
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
						alert("Ocorreu algum erro ao carregar os Produtos");
					}
				});
			}else{
				$('#loadProduct').html(" ");
			}
		});
		$("#loadProduct").on("click", "option", function(){
			$("input[name=product_name]").val("");
			$("#product").html($(this));
			$("#price_product").html("Valor: "+$(this).attr("name"));
			$('#loadProduct').html(" ");	
		});

		var total = 0;
		$("#generate_table_product").submit(function(e){
			e.preventDefault();
			var id = $("#product option").attr("id");
			var check = false;
			$("#productOutput td").each(function(i){
				if( id == $(this).attr("id")){
					check = true;
					Materialize.toast("Este produto já foi importado para a tabela", 4000);
				}
			});
			if(!check){
				$("#add_product_modal").closeModal();

				var newRow = $("<tr class='productRow'>");
				var cols = "";

				cols += '<td class="tdProductId" id='+ $("#product option").attr("id") +'>'+ $("#product option").text() +'</td>';
				cols += '<td class="tdProductPrice">'+'R$ '+ $("#price_product").text().replace(/[^0-9.,]/g,'') +'</td>';
				cols += '<td class="tdProductAmount">'+ $("input[name=amount]").val() +'</td>';
				cols += '<td class="tdProductTotal">'+'R$ '+ ($("#price_product").text().replace(/[^0-9.,]/g,'') * $("input[name=amount]").val()).toFixed(2) +'</td>';
				cols += '<td>';
				cols += '<a href="#" class="removeProduct">Apagar</a>';
				cols += '</td>';
				
				newRow.append(cols);
				$("#newProduct").prepend(newRow);

				total = total + ($("#price_product").text().replace(/[^0-9.,]/g,'') * $("input[name=amount]").val());	

				$("#total").html("Total: R$" +total.toFixed(2));
				$("input[name=amount]").val("");
				$("input[name=price]").val("");
				$("input[name=product_name]").val("");
				$('#loadProduct').html(" ");
				$("#product").html(" ");
				$("#price_product").html(" ");

			}

		});

		$("#newProduct").on("click", ".removeProduct", function(e){
			e.preventDefault();
			var $this = $(this);
			var valueRemove = $this.parents("tr").find(".tdProductTotal").text().replace(/[^0-9.,]/g,'');
			total = total - valueRemove;
			$("#total").html("Total: R$ "+ total.toFixed(2));
			$(this).parents('tr').remove();
		});
		$("#add_product_input_stock_final_btn").click(function(e){
			e.preventDefault();
			$("#add_product_input_stock_final_btn").attr("disabled", true);

			var productsData = [];
			$(".productRow").each(function(i){
				var pData = { 
					id_product: $(this).find(".tdProductId").attr("id"),
					amount:  $(this).find(".tdProductAmount").text(),
					price: Number($(this).find(".tdProductPrice").text().replace(/[^0-9.,]/g,''))
				};
				productsData.push(pData);
			});

			$.ajax({
				url: "<?php echo site_url('/StockController/insertProductsOutputStock')?>",
				type: "POST",
				data: {
					id_stock: "<?= $this->uri->segment(3) ?>",
					products: JSON.stringify(productsData)
				},
				success: function(data){
					if(data == '2'){
						setTimeout(reloadTableProductOutputAfterInsert(), 3000);
						$(".productRow").addClass("transition");
						Materialize.toast("Produto(s) adicionado(s)!", 4000);
						$("#add_product_input_stock_final_btn").attr("disabled", false); 
					}
					else{
						Materialize.toast(data, 4000);
						$("#add_product_input_stock_final_btn").attr("disabled", false); 
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao adicionar um novo produto!', 4000);
					$("#add_product_input_stock_final_btn").attr("disabled", false); 
				}
			});
		});
	});
</script>
<style type="text/css">
	.productRow{
		background: green;
	}
	.transition{
		background-color: white;
		-webkit-transition: background-color 3000ms linear;
		-moz-transition: background-color 3000ms linear;
		-o-transition: background-color 3000ms linear;
		-ms-transition: background-color 3000ms linear;
		transition: background-color 3000ms linear;
	}
</style>
<div class="row">
	<?php //var_dump($output_data) ?>
	<h4>Detalhes de saída</h4>
	<div class="card-panel col s10">
		<div class="col s12">
			<ul class="col s6">
				<h6><strong>Retirado por </strong></h6>
				<h5 class="lead blue-text"><?= $output_data['people'][0]['name'] ?></h5>

				<h6><strong>CPF/CNPJ: </strong> <?= $output_data['people'][0]['cpf_cnpj'] ?></h6>
				<p class="flow-text"><h6>Descrição</h6><?= $output_data['output'][0]['descript']; ?></p>
			</ul>
			<ul class="col s3">
				<li>
					<p></p>
				</li>
			</ul>
			<ul class="col s3 collection">
				<li class="collection-item">
					<strong>Data de saída</strong>
					<strong class="chip"><?= date('d/m/Y', strtotime($output_data['output'][0]['output_date'])); ?></strong>
				</li>

				<li class="collection-item">
					<strong>Total da nota: </strong>
					<strong id="sum_value" class="chip"><?='R$ ' . number_format($output_data['output'][0]['sum_value'], 2, ',', '.');?></strong>
				</li>
				
			</ul>
		</div>
	</div>
	<div class="card-panel col s10">
		<div class="col s4">
			<p><a id="add_product_btn" class="btn green">Adicionar produto</a></p>
		</div>
		<div class="right-align col s8">
			<p id="total" class="btn grey" disabled>Total: R$ </p>
		</div>
	</div>
	<div class="container right-align col s10">
		<button id="add_product_input_stock_final_btn" type="submit" class="green btn-large">Finalizar entrada<i class="material-icons right">send</i></button>
	</div>
	<div class="col s8">
		<div class="collection">
			<table id="productOutput" class="bordered highlight">
				<thead>
					<td><strong>Produto</strong></td>
					<td><strong>Valor unitário</strong></td>
					<td><strong>Quantidade</strong></td>
					<td><strong>Total</strong></td>
					<td><strong>Ações</strong></td>
				</thead>
				<tbody id="newProduct">
					
				</tbody>
				<tbody id="enteredProducts">
					<?php foreach ($output_data['output'] as $prod) { ?>
					<tr>
						<td><?= $prod['name_product'] ?></td>
						<td><?='R$ ' . number_format($prod['unit_price_output'], 2, ',', '.');?></td>
						<td><?= $prod['amount_output'] ?></td>
						<td class="total" hidden><?= $prod['unit_price_output']*$prod['amount_output'] ?></td>
						<td><?='R$ ' . number_format($prod['unit_price_output']*$prod['amount_output'], 2, ',', '.');?></td>
						<td id="<?= $prod['id_product'] ?>"><a class="deleteProductBtn" id="<?= $prod['id_product'] ?>" href="#">Apagar</a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="add_product_modal" class="modal">
	<form id="generate_table_product">
		<div class="modal-content row">
			<h4>Adicionar produto</h4>
			<div class="input-field col s4">	
				<input name="product_name" autocomplete="off" type="text" maxlength="45" placeholder="Produto">
			</div>
			<div class="input-field col s2">
				<input name="amount" required="required" type="number" placeholder="Quantia">
			</div>
			<div class="input-field col s2">
				<p class="chip" id="price_product"></p>
			</div>

			<div id="products" class="col s12">
				<a href="#" id="loadProduct" class="col s6"></a>
				<h5 id="product" class="col s6"></h5>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
			<button id="add_product_output_btn" type="submit" class="btn green">Adicionar<i class="material-icons right">send</i> </button>
		</div>
	</form>
</div>