<style type="text/css">
	li{
		list-style: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add_people_btn").click(function(){
			$('#add_people').openModal();	
		});
		$("input[name=people]").keyup(function(){
			if($(this).val() != ''){
				$.ajax({
					url: "<?php echo site_url('/StockController/searchPeople')?>",
					type: "POST",
					cache: false,
					data: {name_people: $(this).val()},
					success: function(data){
						$('#loadPeople').html("");
						var obj = JSON.parse(data);
						if(obj.length>0){
							try{
								var items=[]; 	
								$.each(obj, function(i,val){											
									items.push($("<br><li  id="+ val.id_people +">"+ val.name +"</li>"));
								});	
								$('#loadPeople').append.apply($('#loadPeople'), items);
							}catch(e) {		
								alert('Ocorreu algum erro ao carregar os Fornecedores!');
							}		
						}else{
							$('#loadPeople').html($('<span/>').text("Nenhum Fornecedor encontrado!"));		
						}		
					},
					error: function(data){
						alert("Ocorreu algum erro ao carregar os Fornecedores");
					}
				});
			}else{
				$('#loadPeople').empty();
			}
		});

		$("#loadPeople").on("click", "li", function(){
			$("input[name=people]").val("");
			$("#people").html($(this));
			$('#loadPeople').empty();
		});

		$("#sendPeople").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/createInputStock')?>",
				type: "POST",
				data: {
					id_people: $("#people li").attr("id"),
					date_people: $("input[name=date]").val(),
					stock_type: $("#stock_type").val()
				},
				success: function(data){
					 window.location.href = "<?php echo site_url('/stock/input/create')?>" + "/" + data;
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Ocorreu algum erro. Tente novamente', 4000);	
				}
			});
		});
	});
</script>
<div class="container row">
	<h4>Entradas de Estoque</h4>
	<div class="card-panel col s12">
		<div class="input-field col s3">
			<input id="search" type="text" required>
			<label for="search"><i class="material-icons">search</i></label>
		</div>
		<div class="input-field col s2">
			<a href="#" class="btn grey">Buscar</a>
		</div>
		<div class="input-field col s3 offset-s3">
			<a class="green btn" id="add_people_btn" href="#add_people">Adicionar novo</a>
		</div>
	</div>
</div>

<div id="add_people" class="modal">
	<div class="modal-content row">
		<h4>Nova entrada</h4>
		<div class="input-field col s3">
			<input name="people" type="text" required placeholder="Fornecedor">
		</div>
		<div class="input-field col s3">
			<select name="stock_type" id="stock_type">
				<option selected value="1">Compra</option>
				<option value="2">Doação</option>
			</select>
		</div>
		<div class="input-field col s3">
			<input placeholder="Data" name="date" type="date" required>
		</div>

		<div id="loadPeople" class="col s10">

		</div>
		<div id="people" class="collection col s10">

		</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn-flat modal-action modal-close">Cancelar</a>
		<button type="submit" id="sendPeople" class="btn green">Prosseguir<i class="material-icons right">send</i></button>
	</div>
</div>

<div class="container row">
	<div class="col s12">
		<table class="bordered highlight">
			<thead>
				<td><strong>Fornecedor</strong></td>
				<td><strong>Data</strong></td>
				<td><strong>Valor total</strong></td>
				<td><strong>Ações</strong></td>
			</thead>
			<tbody>
				<?php foreach($input_stocks as $row) :?>
					<tr>
						<td>
							<a href="<?= base_url('stock/input/create/'.$row['id_stock']); ?>"><?= $row['name']; ?></a>
						</td>
						<td><?= $row['input_date'] ?></td>
						<td>Test</td>
						<td>
							<a href="#">Alterar</a> |
							<a href="#">Apagar</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>