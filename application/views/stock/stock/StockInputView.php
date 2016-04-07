<script type="text/javascript">
	$(document).ready(function(){
		$("#addStock").submit(function(e){
      	e.preventDefault();
      	$.ajax({
      		url: "<?php echo site_url('/StockController/inputStock'); ?>",
      		type: "POST",
      		data: {
      			stock_type: $("#stock_type").val(),
      			id_product: $("#id_product").val(),
      			price_product: $("input[name=price_product]").val(),
      			amount_product: $("input[name=amount_product]").val(),
      			date_product: $("input[name=date_product]").val()
      		},
      		success: function(data){
      			var field = "O campo é obrigatorio";
				if(data.indexOf(field) > -1){
					Materialize.toast('Todos os campos são obrigatórios', 4000);
				}else{
					Materialize.toast('Entrada de estoque salva.', 4000);
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
<div class="container row">
	<div class="col s6">
	<h4>Entrada de Estoque</h4>
		<form method="post" id="addStock">
	        <select name="stock_type" id="stock_type">
				<option selected value="1">Compra</option>
				<option value="2">Doação</option>
			</select>
			<select name="id_product" id="id_product">
				<option name="id_product"  disabled selected>Selecione um Produto</option>
					<?php foreach($products as $dados) : 
						echo "<option value=".$dados['id_product'].">";
						echo $dados['name_product'];
						echo"</option>";
					endforeach; ?>
			</select>
			<input placeholder="Preço" name="price_product" type="number"></input>
			<input placeholder="Quantidade" name="amount_product" type="number"></input>
			<input placeholder="Data de Entrada" name="date_product" type="date">
			<button class="btn waves-effect waves-light" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>