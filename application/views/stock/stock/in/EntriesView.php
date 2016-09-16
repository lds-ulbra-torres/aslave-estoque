<script type="text/javascript">
	$(document).ready(function(){
		$("#search_button").click(function(e){
			e.preventDefault();
			$.ajax({
				url: "<?php echo site_url('/StockController/searchInputStockByAll'); ?>",
				type: "POST",
				data: {	
					people: $("input[name=search]").val(),
					input_type: $("#input_type").val(),
					dateFrom: $("input[name=from]").val(),
					dateTo: $("input[name=to]").val()
				},
				success: function(data){
					if(data == "-1"){
						Materialize.toast("As datas devem estar em ordem crescente", 2000);
					}else if(data == "-2"){
						Materialize.toast("Data invalida", 2000);
					}else{
						var obj = JSON.parse(data);
						if(!obj.length>0){
							Materialize.toast("Nenhuma entrada encontrada", 4000);
						}else{
							try{
								$('#input > tbody').html("");
								$("#pagination").html("");
								var items=[]; 	
								$.each(obj, function(i,val){
									if(val.input_type == "1"){val.input_type = "Compra";}else{val.input_type = "Doação";}
									explode = val.input_date.split("-");		
									items.push($("<tr><td><a title='Visualizar Entrada' href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")+"</td><td>R$  "+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a href='<?= base_url('stock/entries/update/'); ?>/"+val.id_stock+"''>Alterar</a> | <a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
								});	
								$('#input > tbody').append.apply($('#input > tbody'), items);
							}catch(e) {		
								alert('Ocorreu algum erro ao carregar as entrada de estoque!');
							}			
						}
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});
		$("input[name=search]").keyup(function(){
			if($(this).val().length > 1){
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
									items.push($("<a class='people' id="+ val.id_people +" href='#'>"+ val.name +"</a><br>"));
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
				$('#loadPeople').html(" ");
			}
		});
		$("#loadPeople").on("click", ".people", function(){
			$("input[name=search]").val($(this).text());
			$("input[name=search]").attr("id", $(this).attr("id"));
			$('#loadPeople').html("");
		});
		/*
		$("#input_type").change(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/searchInputStockByType'); ?>",
				type: "POST",
				data: {input_type: $(this).val()},
				success: function(data){
					if(data == 'Você esta tentando sabotar site?'){
						Materialize.toast(data, 4000);
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhuma entrada encontrada como " + $("#input_type option:selected").text(), 4000);
					}else{
						try{
							$('#input > tbody').html("");
							$("#pagination").html("");
							var items=[]; 	

							$.each(obj, function(i,val){
								if(val.input_type == "1"){val.input_type = "Compra";}else{val.input_type = "Doação";}
								explode = val.input_date.split("-");		
								items.push($("<tr><td><a href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")+"</td><td>R$  "+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
							});	
							$('#input > tbody').append.apply($('#input > tbody'), items);
						}catch(e) {		
							alert('Ocorreu algum erro ao carregar as entrada de estoque!');
						}			
					}	
				},
				error: function(){
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});
		$("#search_button").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/searchStockInputByPeople'); ?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					if(data == 'O campo de busca esta vazio'){
						reloadTableProduct();
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhuma entrada encontrada", 4000);
					}else{
						try{
							$('#input > tbody').html("");
							$("#pagination").html("");
							var items=[]; 	
							$.each(obj, function(i,val){
								if(val.input_type == "1"){val.input_type = "Compra";}else{val.input_type = "Doação";}
								explode = val.input_date.split("-");		
								items.push($("<tr><td><a href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")	+"</td><td>R$  "+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
							});	
							$('#input > tbody').append.apply($('#input > tbody'), items);
						}catch(e) {		
							alert('Ocorreu algum erro ao carregar as entradas de estoque!');
						}			
					}
				},
				error: function(){
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});
		$("#dateInputStock").submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "<?php echo site_url('/StockController/searchInputStockByDate'); ?>",
				type: "POST",
				data: $("#dateInputStock").serialize(),
				success: function(data){
					if(data == 'Todos os campos são obrigatórios'){
						Materialize.toast(data, 4000);
					}else if(data == 'As datas devem estar em ordem crescente'){
						Materialize.toast(data, 4000);
					}else if(data == 'Data invalida'){
						Materialize.toast(data, 4000);
					}else{
						var obj = JSON.parse(data);
						if(!obj.length>0){
							Materialize.toast("Nenhuma entrada encontrada neste periodo", 4000);
						}else{
							try{
								$('#input > tbody').html("");
								$("#pagination").html("");
								var items=[]; 	

								$.each(obj, function(i,val){
									if(val.input_type == "1"){val.input_type = "Compra";}else{val.input_type = "Doação";}			
									explode = val.input_date.split("-");			
									items.push($("<tr><td><a href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")+"</td><td>R$  "+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
								});	
								$('#input > tbody').append.apply($('#input > tbody'), items);
							}catch(e) {		
								alert('Ocorreu algum erro ao carregar as entrada de estoque!');
							}
						}
					}			
				},
				error: function(data){
					console.log(data);
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});*/
		function reloadTableProduct(){
			$.ajax({
				url: "<?= base_url('stock/entries/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#input").html($(data).find("table"));
					console.log($(data).find("table"));
				},
				error: function(){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);	
				}
			});
		}
		var id_stock;
		$("table").on("click",".delete_stock_btn", function(){
			$('#delete_stock_modal').openModal();	
			id_stock = $(this).attr("id");
		});
		$("#delete_stock").on("click", function(){
			$("#delete_stock").attr("disabled", true);
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteInputStock'); ?>",
				type: "POST",
				data: {id_stock: id_stock},
				success: function(data){
					$("#delete_stock").attr("disabled", false);
					reloadTableProduct();
					Materialize.toast(data, 3000);
				},
				error: function(data){
					$("#delete_stock").attr("disabled", false);
					console.log(data);
					Materialize.toast('Ação não permitida.', 3000);	
				}
			});
		});

	});
</script>
<div class="container">
	<div class="row">
		<h4>Entradas de Estoque</h4>
		<div class="card-panel col s12 row">
			<div class="input-field col s12 m3">
				<a class="green btn" href="<?=base_url('stock/entries/create') ?>">Adicionar nova</a>
			</div>
			<div class="input-field col s12 m4">
				<input type="text" name="search" placeholder=" Fornecedor..." autocomplete="off" required>
				<div style="min-height: 30px;" id="loadPeople" class="col s12" style="position: relative; bottom: 0;">
				</div>
			</div>

			<div class="input-field col s12 m3">
				<select id="input_type">
					<option disabled selected> Tipos...</option>
					<option value="1"> Compras</option>
					<option value="2"> Doações</option>
				</select>
			</div>
			<div class="col s12 m12">
				<form id="dateInputStock">
					<div class="col s12 m3">
						<label for="from" class="black-text">Data inicio:</label>
						<input  type="date" title="dd/mm/AAAA" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" maxlength="10" name="from">
					</div>
					<div class=" col s12 m3">
						<label for="to" class="black-text">Data final:</label>
						<input type="date" title="dd/mm/AAAA" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" maxlength="10" name="to">
					</div>
					<div class="col s12 m2">
						<button href="#" id="search_button" class="btn green">Buscar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col s12 collection responsive-table">
			<table id="input" class="bordered highlight">
				<thead>
					<td><strong>Fornecedor</strong></td>
					<td><strong>Data</strong></td>
					<td><strong>Valor total</strong></td>
					<td><strong>Tipo de fornecimento</strong></td>
					<td><strong>Ações</strong></td>
				</thead>
				<tbody>
					<?php foreach($input_stocks as $row) :?>
						<tr>
							<td><a href="<?= base_url('stock/entries/'.$row['id_stock']); ?>" title="Visualizar entrada"><?= $row['name'];?></a></td>
							<td><?= date('d/m/Y', strtotime($row['input_date'])); ?></td>
							<td><?='R$ ' . number_format($row['sum_value'], 2, ',', '.');?></td>
							<td><?php switch ($row['input_type']) {
								case '1':
								echo 'Compra';
								break;

								case '2':
								echo 'Doação';
								break;
							} ?></td>
							<td>
								<a href="<?= base_url('stock/entries/update/'.$row['id_stock']); ?>" id="<?= $row['id_stock']; ?>" href="#">Alterar</a> |
								<a class="delete_stock_btn" id="<?= $row['id_stock']; ?>" href="#">Apagar</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div id="delete_stock_modal" class="modal">
			<div class="modal-content">
				<h4>Atenção</h4>
				<div class="">
					<p>O estoque retornará ao estado anterior e isto não poderá ser desfeito.</p>
					<strong><p>Realmente quer apagar esta entrada de estoque? </p></strong>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-action modal-close btn-flat">Cancelar</a>
				<a href="#!" id="delete_stock" class="modal-action modal-close btn red">Apagar</a>
			</div>
		</div>
	</div>
</div>