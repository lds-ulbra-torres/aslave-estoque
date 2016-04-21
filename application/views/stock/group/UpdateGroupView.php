
<script type="text/javascript">
	$(document).ready(function(){
		$("input[name=group_name]").val("<?php foreach ($group_data as $name){echo $name['name_group'];} ?>");

		$("#update_form").submit(function(e){
			$("#update_group_btn").attr("disabled", true);
			e.preventDefault();
			$.ajax({
				url: "<?php echo site_url('/StockController/updateGroup'); ?>",
				type: "POST",
				data: {
					group_id: "<?= $this->uri->segment(4) ?>",
					group_name: $("input[name=group_name]").val(),
				},
				success: function(data){
					if(data == 'Categoria salva.'){
						window.setTimeout(redirecionar, 1500);
						Materialize.toast(data, 1500);
					}else{
						Materialize.toast(data, 1500);
						$("#update_group_btn").attr("disabled", false);
					}
					function redirecionar() {
						document.location.href = "<?= base_url('stock/groups'); ?>";
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('FATAL error', 4000);
					$("#update_group_btn").attr("disabled", false);
				}
			});
		});
	});
</script>
<div class="row">
	<div class="col s6">
	<h4>Alterar categoria</h4>
		<form method="post" id="update_form">
			<div class="card-panel">
				<input type="text" value="" name="group_name" placeholder="Nome">
				<button class="btn green" id="update_group_btn" type="submit">Salvar
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</div>