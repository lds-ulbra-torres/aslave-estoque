<script type="text/javascript">
	$(document).ready(function(){
		function reloadTableProduct(){
			$.ajax({
				url: "<?= base_url('stock/products/');?>",
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
		var idProduct;
		$("table").on("click",".delete_product", function(){
			$('#delete_product_modal').openModal();	
			idProduct = $(this).attr("id");
		});

		$("#delete_product").on("click", function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteProduct'); ?>",
				type: "POST",
				data: {id_product: idProduct},
				success: function(data){
					if(!data){
						Materialize.toast(data, 4000);
					}else{
						Materialize.toast(data, 4000);
						reloadTableProduct();	
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro do ajax', 4000);	
				}
			});
		});

		$("#search_button").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/searchProduct'); ?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					if(data == 'O campo de busca esta vazio'){
						Materialize.toast(data, 4000);
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhum produto encontrado", 4000);
					}else{
						try{
							$('#product > tbody').html("");
							$("#pagination").html("");
							var items=[]; 	
							$.each(obj, function(i,val){											
								items.push($("<tr><td>" + val.name_product + "</td><td>"+val.name_group+"</td><td>n sei o nome da coluna</td><td><a href='<?= base_url('stock/products/update/');?>/"+ val.id_product +"'>Alterar</a> | <a id="+ val.id_product +" href='#' class='delete_product'>Apagar</a></td>"));
							});	
							$('#product > tbody').append.apply($('#product > tbody'), items);
						}catch(e) {		
							alert('Ocorreu algum erro ao carregar os Produtos!');
						}			
					}	
				},
				error: function(){
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});
		$("#group_id").change(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/searchProductByGroup'); ?>",
				type: "POST",
				data: {id_group: $(this).val()},
				success: function(data){
					if(data == 'Você esta tentando sabotar site?'){
						Materialize.toast(data, 4000);
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhum produto encontrado com esta categoria", 4000);
					}else{
						try{
							$('#product > tbody').html("");
							$("#pagination").html("");
							var items=[]; 	
							$.each(obj, function(i,val){											
								items.push($("<tr><td>" + val.name_product + "</td><td>"+$('#group_id option:selected').text()+"</td><td>"+ val.amount +"</td><td><a href='<?= base_url('stock/products/update/');?>/"+ val.id_product +"'>Alterar</a> | <a id="+ val.id_product +" href='#' class='delete_product'>Apagar</a></td>"));
							});	
							$('#product > tbody').append.apply($('#product > tbody'), items);
						}catch(e) {		
							alert('Ocorreu algum erro ao carregar os Produtos!');
						}			
					}	
				},
				error: function(){
					Materialize.toast("Ocorreu algum erro", 2000);
				}
			});
		});
	});
</script>

<div class="row">
	<h4>Produtos</h4>
	<div class="card-panel col s11">
		<div class="input-field col s3">
			<a class="green btn" id="" href="<?= base_url('stock/products/create'); ?>">Adicionar novo</a>
		</div>
		<div class="input-field col s3">
			<input type="text" name="search" placeholder=" Buscar produto..." required>
		</div>
		<div class="input-field col s2">
			<button href="#" id="search_button" class="btn grey">
				<i class="material-icons">search</i>
			</button>
		</div>
		<div class="input-field col s3">
			<select id="group_id">
				<option disabled selected> Filtrar por categorias</option>
				<?php foreach($groups as $row) :
				echo "<option value=".$row['id_group'].">";
				echo $row['name_group'];
				echo "</option>";
				endforeach; ?>
			</select>
		</div>
	</div>
</div>	
<div class="row">
	<div class="col s11 collection">
		<table id="product" class="bordered highlight">
			<thead>
				<td><strong>Nome</strong></td>
				<td><strong>Categoria</strong></td>
				<td><strong>Estoque</strong></td>
				<td><strong>Ações</strong></td>
			</thead>
			<tbody>
				<?php foreach($products as $row) :?>
					<tr>
						<td><?= $row['name_product'] ?></td>
						<td><?= $row['name_group'] ?></td>
						<td><?= $row['amount'] ?></td>
						<td>
							<a href="<?= base_url('stock/products/update/'.$row['id_product']); ?>">Alterar</a> |
							<a class="delete_product" id="<?php echo $row['id_product']; ?>" href="#">Apagar</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<!-- <div id="pagination" class="pagination">
			<ul class="pagination right-align">
				<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				<li class="active grey"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div> -->
	</div>	
</div>


<div id="delete_product_modal" class="modal">
	<div class="modal-content">
		<h4>Aviso</h4>
		<div class="row">
			<p>Realmente quer apagar este produto?</p>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
		<a href="#!" id="delete_product" class=" modal-action modal-close waves-effect waves-green btn-flat">Apagar</a>
	</div>
</div>
