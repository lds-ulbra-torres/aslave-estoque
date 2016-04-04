<script type="text/javascript">
	$(document).ready(function(){
		$("#addStock").submit(function(e){
      	e.preventDefault();
      	$.ajax({
      		url: "<?php echo site_url('/StockController/inputStock'); ?>",
      		type: "POST",
      		data: {
      			id_product: $("#id_product").val(),
      			price_product: $("input[name=price_product]").val(),
      			amount_product: $("input[name=amount_product]").val(),
      			date_product: $("input[name=date_product]").val()
      		},
      		success: function(data){
      			var field = "O campo é obrigatorio";
				if(data.indexOf(field) > -1){
					Materialize.toast('Todos os campos são obrigatorios', 4000);
				}else{
					Materialize.toast('Estoque adicionado com sucesso', 4000);
				}
      		},
      		error: function(data){
      			alert(data);
      			Materialize.toast('Erro ao adicionar uma nova entrada de estoque', 4000);
      		}
      	});
      });
	});
</script>
<div class="container">
	<h4>Entrada de Estoque</h4>
	<div class="row">
		<form method="post" id="addStock">
			<div class="">
				<select name="id_product" id="id_product">
					<option name="id_product"  disabled selected>Selecione um Produto</option>
						<?php foreach($products as $dados) : 
							echo "<option value=".$dados['id_product'].">";
							echo $dados['name_product'];
							echo"</option>";
						endforeach; ?>
				</select>
			</div>
			<input placeholder="Preço" name="price_product" type="number"></input>
			<input placeholder="Quantidade" name="amount_product" type="number"></input>
			<input placeholder="Data de Entrada" name="date_product" type="date">
			<button class="btn waves-effect waves-light" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>