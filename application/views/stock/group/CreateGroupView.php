<script type="text/javascript">
	 $(document).ready(function(){
		$("#addCat").submit(function(e){
			e.preventDefault();	
			$.ajax({
				url: "<?php echo site_url('/StockController/createGroup'); ?>",
				type: "POST",
				data: $("#addCat").serialize(),
				success: function(data){
					var field = "O campo é obrigatorio";
					if(data.indexOf(field) > -1){
						Materialize.toast('Todos os campos são obrigatorios', 4000);
					}else{
						Materialize.toast('Categoria de produtos adicionada com sucesso!', 4000);
					}
				},
				error: function(data){
					alert(data);
					Materialize.toast('Erro ao adicionar uma nova categoria!', 4000);
				}
			});
      });
	 });
</script>
<div class="container">
	<form method="post" id="addCat">
		<h4>Cadastrar categoria</h4>
		<input type="text" name="group_name" placeholder="Nome">

		<button class="btn waves-effect waves-light" type="submit">Salvar
			<i class="material-icons right">send</i>
		</button>
	</form>
</div>