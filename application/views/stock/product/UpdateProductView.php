<script type="text/javascript">
	$(document).ready(function(){
		$("#update_form").submit(function(e){
			$("#update_product_btn").attr("disabled", true);
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
					if(data == 'Produto salvo.'){
						document.location.href = "<?= base_url('stock/products'); ?>";
					}else{
						Materialize.toast(data, 1500);
						$("#update_product_btn").attr("disabled", false);
					}
				},
				error: function(data){
					console.log(data);
					$("#update_product_btn").attr("disabled", false);
					Materialize.toast('FATAL error', 4000);
				}
			});
		});
	});
</script>
<div class="row">
	<div class="col s6">
		<form method="post" id="update_form">
			<h4>Alterar produto</h4>
			<div class="card-panel">
				<?php foreach ($product_data as $name){ ?>
				<input required="required" placeholder="Nome" value="<?php echo $name['name_product']; ?>" name="product_name" type="text"></input>
				<select id="group_id">
					<?php foreach($groups as $row){
						$id_product = $name['id_group']; 
					?>
						<option <?php if($id_product == $row['id_group']){ ?> selected  <?php } ?>  value="<?php echo $row['id_group']; ?>"> <?php echo $row['name_group']; ?></option>
					<?php } ?>

				</select>
				<?php } ?>
				<button class="btn green" id="update_product_btn" type="submit">Salvar
					<i class="material-icons right">send</i>
				</button>
			</div>
		</form>
	</div>
</div>