<script type="text/javascript">
	 $(document).ready(function(){
		$("#create_group").submit(function(e){
			$("#create_group_btn").attr("disabled", true);
			e.preventDefault();	
			$.ajax({
				url: "<?php echo site_url('/StockController/createGroup'); ?>",
				type: "POST",
				data: $("#create_group").serialize(),
				success: function(data){
					Materialize.toast(data, 3000);
					$("input[name=group_name]").val("");
					$("#create_group_btn").attr("disabled", false);
				},
				error: function(data){
					console.log(data);
					Materialize.toast('FATAL error', 3000);
					$("#create_group_btn").attr("disabled", false);
				}
			});
      });
	 });
</script>
<div class="row">
	<div class="col s6">
	<a href="<?=base_url('StockController/groups') ?>">< Voltar para categorias</a>
		<form method="post" id="create_group">
		<h4>Cadastrar categoria</h4>
		<div class="card-panel">
			<input required="required" type="text" name="group_name" maxlength="45" placeholder="Nome">
		</div>
		<button class="btn green" id="create_group_btn" type="submit">Salvar
			<i class="material-icons right">send</i>
		</button>
	</form>
	</div>
</div>