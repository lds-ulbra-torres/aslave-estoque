<script type="text/javascript">
	 $(document).ready(function(){
	 	$("input[name=product_name]").val("<?php foreach ($product_data as $name){echo $name['name_product'];} ?>");
		$("#update_form").submit(function(e){
      	e.preventDefault();
	      	$.ajax({
	      		url: "<?php echo site_url('/StockController/updateProduct/'); ?>",
	      		type: "POST",
	      		data: {
	      			product_id: "<?= $this->uri->segment(4) ?>",
	      			product_name: $("input[name=product_name]").val(),
	      			group_id: $("#group_id").val()
	      		},
	      		success: function(data){
	      			window.setTimeout(redirecionar, 2000);
					function redirecionar() {
					  document.location.href = "<?= base_url('stock/products'); ?>";
					}
					Materialize.toast(data, 3000);
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
			<h4>Alterar produto</h4>
			<input required="required" placeholder="Nome" name="product_name" type="text"></input>
			<select id="group_id">
				<option disabled selected>Selecione uma Categoria</option>
				<?php foreach($groups as $row) :
					echo "<option value=".$row['id_group'].">";
					echo $row['name_group'];
					echo "</option>";
				endforeach; ?>
			</select>
			<button class="btn green" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>