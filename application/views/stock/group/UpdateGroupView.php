
<script type="text/javascript">
	 $(document).ready(function(){
	 	$("input[name=group_name]").val("<?php foreach ($group_data as $name){echo $name['name_group'];} ?>");

		$("#update_form").submit(function(e){
      	e.preventDefault();
	      	$.ajax({
	      		url: "<?php echo site_url('/StockController/updateGroup'); ?>",
	      		type: "POST",
	      		data: {
	      			group_id: "<?= $this->uri->segment(4) ?>",
	      			group_name: $("input[name=group_name]").val(),
	      		},
	      		success: function(data){
	      			window.setTimeout(redirecionar, 2000);
					function redirecionar() {
					  document.location.href = "<?= base_url('stock/groups'); ?>";
					}
					Materialize.toast(data, 2000);
					console.log(data);
				},
				error: function(data){
					console.log(data);
					Materialize.toast('FATAL error', 4000);
				}
	      	});
      	});
	});
</script>
<div class="container row">
	<div class="col s6">
		<form method="post" id="update_form">
		<h4>Alterar categoria</h4>
		<input type="text" value="" name="group_name" placeholder="Nome">
		<button class="btn green" type="submit">Salvar
			<i class="material-icons right">send</i>
		</button>
	</form>
	</div>
</div>