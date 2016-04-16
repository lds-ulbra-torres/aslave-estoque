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
			$(this).attr("disabled", true);
			$.ajax({
				url: "<?php echo site_url('/StockController/createInputStock')?>",
				type: "POST",
				data: {
					id_people: $("#people li").attr("id"),
					date_people: $("input[name=date]").val(),
					stock_type: $("#stock_type").val()



				},
				success: function(data){
					if(data == 'Todos campos são obrigatórios.'){
						Materialize.toast('Todos campos são obrigatórios.', 4000);
						$("#sendPeople").attr("disabled", false);
					}else if(data == 'Ocorreu um erro interno. Tente novamente'){
						Materialize.toast('Ocorreu um erro interno. Tente novamente', 4000);
						$("#sendPeople").attr("disabled", false);
					}else{
						window.location.href = "<?php echo site_url('/stock/input/create')?>" + "/" + data;
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Ocorreu algum erro. Tente novamente', 4000);	
				}
			});
		});
		var idStock;
		$("table").on("click", ".delete_stock_btn", function(){
			$('#delete_stock_modal').openModal();	
			idStock = $(this).attr("id");
		});
		$("#delete_stock").click(function(){
			alert(idStock);
			/*
			funcao para deletar o stock....
			$.ajax({
				url: "<?php echo site_url('/StockController/'); ?>",
				type: "POST",
				data: {id_group: idGroup},
				success: function(data){
					Materialize.toast(data, 3000);
					reloadTableGroup();
				},
				error: function(data){
					console.log(data);
					Materialize.toast('FATAL error', 3000);	
				}
			});*/
		});
	});
</script>
<div class="row">
	<h4>Entradas de Estoque</h4>
	<div class="card-panel col s11">
		<div class="input-field col s3">
			<a class="green btn" id="add_people_btn" href="#add_people">Adicionar novo</a>
		</div>
		<div class="input-field col s3">
        	<input type="text" placeholder=" Buscar entradas..." required>
        </div>
        <div class="input-field col s2">
        	<button href="#" id="search_button" class="btn grey">
        		<i class="material-icons">search</i>
        	</button>
        </div>
	</div>
</div>

<div id="add_people" class="modal">
	<div class="modal-content row">
		<h4>Nova entrada</h4>
		<div class="input-field col s3">
			<input name="people" type="text" autocomplete="off" required placeholder="Fornecedor">
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

<div class="row">
	<div class="col s11">
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
							<a class="delete_stock_btn" id="<?= $row['id_stock']; ?>" href="#">Apagar</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div id="delete_stock_modal" class="modal">
		<div class="modal-content">
			<h4>Aviso</h4>
			<div class="row">
				<p>Realmente quer apagar esta entrada de estoque?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="delete_stock" class="modal-action modal-close waves-effect waves-red btn-flat">Apagar</a>
		</div>
	</div>
</div>