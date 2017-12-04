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
<div class="container">
	<div class="row">
		<div class="card-panel blue-text">
			<h4>Categorias</h4>
			<div class="right-align">
				<a class="green btn" id="" href="<?= base_url('stock/groups/create'); ?>">Adicionar nova</a>
			</div>
		</div>
		<div class="card-panel col s12 m12">
			<div class="input-field col s12 m3">
				<a class="btn green" id="" href="<?= base_url('stock/groups/create'); ?>">Adicionar nova</a>
			</div>
			<div class="input-field col s12 m3">
				<input value="" name="search" placeholder=" Buscar categoria..." type="text" required>
			</div>
			<div class="input-field col s12 m2">
				<button href="#" id="search_button" class="btn green">Buscar</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 collection">
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
								<a id="<?= $row['id_group']; ?>"
									href="<?= base_url('stock/groups/update/'.$row['id_group']); ?>"
									title="Editar Categoria">
									<i class="material-icons">edit</i></a>

								<a id="<?= $row['id_group']; ?>" href="#"
									class="delete_group" title="Apagar Categoria">
									<i class="material-icons">delete</i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
	</div>
	<div class="container row right">
		<?php echo $pagination_show;  ?>
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
			<a href="#!" id="delete_group" class="modal-action mo	dal-close btn red">Apagar</a>
		</div>
	</div>
</div>
</div>
