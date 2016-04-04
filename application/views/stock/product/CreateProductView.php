<script type="text/javascript">
	 $(document).ready(function(){
		$("#addProduct").submit(function(e){
      	e.preventDefault();
      	$.ajax({
      		url: "<?php echo site_url('/StockController/createProduct'); ?>",
      		type: "POST",
      		data: {
      			product_name: $("input[name=product_name]").val(),
      			group_id: $("#group_id").val()
      		},
      		success: function(data){
				var field = "O campo é obrigatorio";
				if(data.indexOf(field) > -1){
					Materialize.toast('Todos os campos são obrigatorios', 4000);
				}else{
					Materialize.toast('Produto adicionado com sucesso', 4000);
				}
      		},
      		error: function(data){
      			alert(data);
      			Materialize.toast('Erro ao adicionar um novo produto!', 4000);
      		}
      	});
      });
		 });
</script>
<div class="container">
	<div class="">
		<form method="post" id="addProduct">
			<h4>Cadastrar produto</h4>
			<input placeholder="Nome" name="product_name" type="text"></input>
			<div class="">
			<select name="group_id" id="group_id">
				<option name="group_id" disabled selected>Selecione uma Categoria</option>
				<?php foreach($groups as $row) :
					echo "<option value=".$row['id_group'].">";
					echo $row['name_group'];
					echo "</option>";
				endforeach; ?>
			</select>
			</div>
			<button class="btn waves-effect waves-light" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>