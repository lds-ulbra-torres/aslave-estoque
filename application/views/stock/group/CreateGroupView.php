<script type="text/javascript">
	 $(document).ready(function(){
		$("#create_group").submit(function(e){
			e.preventDefault();	
			$.ajax({
				url: "<?php echo site_url('/StockController/createGroup'); ?>",
				type: "POST",
				data: $("#create_group").serialize(),
				success: function(data){
					Materialize.toast(data, 3000);
					$("input[name=group_name]").val("");
				},
				error: function(data){
					console.log(data);
					Materialize.toast('FATAL error', 3000);
				}
			});
      });
	 });
</script>
<div class="container row">
	<div class="col s6">
		<form method="post" id="create_group">
		<h4>Cadastrar categoria</h4>
		<input required="required" type="text" name="group_name" placeholder="Nome">
		<button class="btn green" type="submit">Salvar
			<i class="material-icons right">send</i>
		</button>
	</form>
	</div>
</div>