<script type="text/javascript">
	$(document).ready(function(){
		$("#create_product").submit(function(e){
			$("#create_product_btn").attr("disabled", true);
			e.preventDefault();
			$.ajax({
				url: "<?php echo site_url('/StockController/createProduct'); ?>",
				type: "POST",
				data: {
					product_name: $("input[name=product_name]").val(),
					group_id: $("#group_id").val()
				},
				success: function(data){
					$("input[name=product_name]").val("");
					Materialize.toast(data, 3000);
					$("#create_product_btn").attr("disabled", false);
				},
				error: function(data){
					console.log(data);
					$("#create_product_btn").attr("disabled", false);
					Materialize.toast('FATAL error', 4000);
				}
			});
		});
	});
</script>
<div class="container row">
	<div class="col s6">
		<form method="post" id="create_product">
			<h4>Cadastrar produto</h4>
			<input required="required" placeholder="Nome" name="product_name" type="text"></input>
			<div class="">
				<select id="group_id">
					<option disabled selected value="1">Selecione uma Categoria</option>
					<?php foreach($groups as $row) :
					echo "<option value=".$row['id_group'].">";
					echo $row['name_group'];
					echo "</option>";
					endforeach; ?>
				</select>
			</div>
			<button class="btn green" id="create_product_btn" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>