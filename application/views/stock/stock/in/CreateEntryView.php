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
			var people_json = "<?php echo site_url('/StockController/searchPeople')?>";
			$('#people').simpleSelect2Json(people_json,'id_people','name');

			var product_json = "<?php echo site_url('/StockController/searchProductStock')?>";
			$('#product_name').simpleSelect2Json(product_json,'id_product','name_product');

			$("#stock_type").material_select();

			var total = 0;
			$("#generate_table_product").submit(function(e){
				e.preventDefault();
				var check = false;
				if($('#product').is(':empty')){
					Materialize.toast("Selecione algum produto", 4000);
					check = true;
				}else{
					var id = $("#product_name option:selected").val();
					$("tbody td").each(function(i){
							if( id == $(this).attr("id")){
								check = true;
								Materialize.toast("Este produto já foi importado para a tabela", 4000);
							}
					});
				}
				if(!check){
					$("#add_product_modal").closeModal();

					var newRow = $("<tr class='productRow'>");
					var cols = "";

					cols += '<td class="tdProductId" id='+ $("#product_name option:selected").val() +'>'+ $("#product_name option:selected").text() +'</td>';
					cols += '<td class="tdProductAmount">'+ $("input[name=amount]").val() +'</td>';
					cols += '<td class="tdProductPrice">'+'R$ '+ $("input[name=price]").val() +'</td>';
					cols += '<td class="tdProductTotal">'+'R$ '+ ($("input[name=price]").val() * $("input[name=amount]").val()).toFixed(2) +'</td>';
					cols += '<td>';
					cols += '<a href="#" class="removeProduct">Remover</a>';
					cols += '</td>';

					newRow.append(cols);
					$("#input_stock_product").append(newRow);

					total = total + ($("input[name=price]").val() * $("input[name=amount]").val());

					$("#total").html("Total: R$" +total.toFixed(2));
					$("input[name=amount]").val("");
					$("input[name=price]").val("");
					$("input[name=product_name]").val("");
					$('#loadProduct').empty();

				}

			});
			$("#input_stock_product").on("click", ".removeProduct", function(e){

				e.preventDefault();
				var $this = $(this);
				var valueRemove = $this.parents("tr").find(".tdProductTotal").text().replace(/[^0-9.,]/g,'');
				total = total - valueRemove;
				$("#total").html("Total: R$ "+ total.toFixed(2));
				$(this).parents('tr').remove();
			});
			$("#add_input_stock_btn").click(function(e){
				e.preventDefault();
				$("#add_input_stock_btn").attr("disabled", true);

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
					url: "<?php echo site_url('/StockController/createInputStock')?>",
					type: "POST",
					data: {
						id_people: $("#people").val(),
						type: $("#stock_type").val(),
						date: $("input[name=date]").val(),
						products: JSON.stringify(productsData)
					},
					success: function(data){
						if($.isNumeric(data)){
							$("#add_input_stock_btn").attr("disabled", false);
							document.location.href = "<?= base_url('stock/entries/'); ?>/" + data;
						}
						else{
							Materialize.toast(data, 4000);
							$("#add_input_stock_btn").attr("disabled", false);
						}
					},
					error: function(data){
						console.log(data);
						Materialize.toast('Erro ao adicionar uma nova entrada de estoque!', 4000);
						$("#add_input_stock_btn").attr("disabled", false);
					}
				});
			});
		});
	</script>
	<div class="container">
		<div class="row">
			<div class="">
				<div class="card-panel blue-text">
					<h4>Nova entrada</h4>
					<div class="right-align">
						<a class="btn teal" href="<?=base_url('stock/entries') ?>"><i class="material-icons">input</i> Voltar</a>
						<button id="add_input_stock_btn" type="submit" class="green btn">Finalizar <i class="material-icons right">send</i></button>
					</div>
				</div>
				<div class="card-panel col s12 m12 l8">
					<div class="input-field col s12 m12">
						<select id="people" name="people"></select>
					</div>
					<div class="input-field col s12 m5 margin-alter">
						<select name="stock_type" id="stock_type">
							<option selected value="1">Compra</option>
							<option value="2">Doação</option>
						</select>
					</div>
					<div class="col s12 m5">
						<label for="date" class="black-text">Data de entrada:</label>
						<input placeholder="Data" name="date" type="date" required>
					</div>
				</div>

			</div>

			<div class="card-panel col s12 m12 l10">
				<div class="col s12 m6">
					<p><a id="add_product_btn" class="btn green">Adicionar produto</a></p>
				</div>
				<div class="right-align col s12 m6">
					<p id="total" class="btn grey" disabled>Total: R$ </p>
				</div>
			</div>

			<div class="col s12 m12 l10 collection responsive-table">
				<table  class="bordered highlight" id="input_products">
					<thead>
						<td><strong>Produto</strong></td>
						<td><strong>Quantidade</strong></td>
						<td><strong>Valor unitário</strong></td>
						<td><strong>Valor total</strong></td>
						<td><strong>Ações</strong></td>
					</thead>
					<tbody id="input_stock_product">

					</tbody>
				</table>
			</div>
		</div>

		<div id="add_product_modal" class="modal">
			<form id="generate_table_product">
				<div class="modal-content row bodyModal">
					<h4>Adicionar produto</h4>
					<div class="input-field col s12 m6">
						<select style="width: 100% !important" id="product_name" name="product_name"></select>
					</div>
					<div class="input-field col s12 m2">
						<input name="amount" required="required" type="number" placeholder="Quantia">
					</div>
					<div class="input-field col s12 m2">
						<input name="price" required="required" type="number" placeholder="Preço" step="0.00" min="0.00">
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
					<button id="add_product_input_stock_btn" class="btn green">Adicionar<i class="material-icons right">send</i> </button>
				</div>
			</form>
		</div>
	</div>
