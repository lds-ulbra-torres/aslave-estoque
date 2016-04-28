<script type="text/javascript">
	$(document).ready(function(){
		$("#search_button").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/searchStockInputByPeople'); ?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					if(data == 'O campo de busca esta vazio'){
						Materialize.toast(data, 4000);
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
								items.push($("<tr><td><a href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")	+"</td><td>"+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
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
								items.push($("<tr><td><a href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")+"</td><td>"+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
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
									items.push($("<tr><td><a href='<?= base_url('stock/entries/'); ?>/"+val.id_stock+"'>"+val.name+"</a></td><td>"+explode.reverse().join("/")+"</td><td>"+val.sum_value+"</td><td class='input_type_search'>"+val.input_type+"</td><td><a id="+ val.id_stock +" href='#' class='delete_stock_btn'>Apagar</a></td></tr>"));
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
		function reloadTableProduct(){
			$.ajax({
				url: "<?= base_url('stock/entries/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#product").html($(data).find("table"));
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
<div class="row">
	<h4>Entradas de Estoque</h4>
	<div class="card-panel col s11">
		<div class="input-field col s3">
			<a class="green btn" href="<?=base_url('stock/entries/create') ?>">Adicionar nova</a>
		</div>
		<div class="input-field col s3">
			<input type="text" name="search" placeholder=" Fornecedor..." required>
		</div>
		<div class="input-field col s2">
			<button href="#" id="search_button" class="btn grey">
				<i class="material-icons">search</i>
			</button>
		</div>
		<div class="input-field col s2">
			<select id="input_type">
				<option disabled selected> Tipos...</option>
				<option value="1"> Compras</option>
				<option value="2"> Doações</option>
			</select>
		</div>
		<div class="col s11">
			<form id="dateInputStock">
				<div class="input-field col s2">
					<input required="required" type="date" name="from">
				</div>
				<div class="input-field col s2">
					<input required="required" type="date" name="to">
				</div>
				<div class="input-field col s1">
					<button type="submit" href="#" id="search_button" class="btn grey">
						<i class="material-icons">search</i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s11 collection">
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
						<td><a href="<?= base_url('stock/entries/'.$row['id_stock']); ?>"><?= $row['name'] ?></a></td>
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