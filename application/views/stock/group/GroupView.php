<script type="text/javascript">
	$(document).ready(function(){
		function reloadTableGroup(){
			$.ajax({
				url: "<?= base_url('stock/groups/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#group").html($(data).find("table"));
				},
				error: function(){
					console.log(data);
					Materialize.toast('Erro ao recarregar a tabela, atualize a pagina!', 4000);	
				}
			});
		}
		var idGroup;
		$("table").on("click",".delete_group", function(){
			$('#delete_group_modal').openModal();	
			idGroup = $(this).attr("id");
		});

		$("#delete_group").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteGroup'); ?>",
				type: "POST",
				data: {id_group: idGroup},
				success: function(data){
					Materialize.toast(data, 3000);
					reloadTableGroup();
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro interno.', 3000);	
				}
			});
		});

		$("#search_button").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/searchGroup'); ?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					if(data == 'O campo de busca esta vazio'){
						reloadTableGroup();
					}
					var obj = JSON.parse(data);
					if(!obj.length>0){
						Materialize.toast("Nenhuma categoria encontrada", 4000);
					}else{
						try{
							$('#group > tbody').html("");
							$("#pagination").html("");
							var items=[]; 	
							$.each(obj, function(i,val){											
								items.push($("<tr><td>" + val.name_group + "</td><td><a href='<?= base_url('stock/groups/update/');?>/"+ val.id_group +"'>Alterar</a> | <a id="+ val.id_group +" href='#' class='delete_group'>Apagar</a>"));
							});	
							$('#group > tbody').append.apply($('#group > tbody'), items);
						}catch(e) {		
							alert('Ocorreu algum erro ao carregar as Categorias!');
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
	<h4>Categorias</h4>
	<div class="card-panel col s11">
		<div class="input-field col s3">
			<a class="btn green" id="" href="<?= base_url('stock/groups/create'); ?>">Adicionar nova</a>
		</div>
		<div class="input-field col s3">
			<input value="" name="search" placeholder=" Buscar categoria..." type="text" required>
		</div>
		<div class="input-field col s2">
			<button href="#" id="search_button" class="btn grey">
				<i class="material-icons">search</i>
			</button>
		</div>
	</div>
</div>	
<div class="row">
	<div class="col s9 collection">
		<table id="group" class="bordered highlight">
			<legend></legend>
			<thead>
				<td><strong>Nome</strong></td>
				<td><strong>Ações</strong></td>
			</thead>
			<tbody>
				<?php foreach($groups as $row) :?>
					<tr>
						<td><?= $row['name_group'] ?></td>
						<td>
							<a href="<?= base_url('stock/groups/update/'.$row['id_group']); ?>">Alterar</a> |
							<a class="delete_group" id="<?php echo $row['id_group']; ?>" href="#">Apagar</a>
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

	<div id="delete_group_modal" class="modal">
		<div class="modal-content">
			<h4>Aviso</h4>
			<div class="row">
				<p>Realmente quer apagar esta categoria?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="delete_group" class="modal-action modal-close waves-effect waves-red btn-flat">Apagar</a>
		</div>
	</div>	
</div>

