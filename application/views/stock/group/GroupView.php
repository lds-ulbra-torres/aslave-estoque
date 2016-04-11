<script type="text/javascript">
	$(document).ready(function(){
		function reloadTableGroup(){
			$.ajax({
				url: "<?= base_url('stock/groups/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#group").html($(data).find("table"));
					console.log($(data).find("table"));
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
					Materialize.toast('FATAL error', 3000);	
				}
			});
		});

		$("#search_button").click(function(){
			$.ajax({
				url: "<?= base_url('stock/groups/');?>",
				type: "POST",
				data: {search_string: $("input[name=search]").val()},
				success: function(data){
					Materialize.toast("não é google", 2000);
				},
				error: function(){
					Materialize.toast("deu pau viado", 2000);
				}
			});
		});
	});
</script>

<div class="container row">
	<h4>Categorias</h4>
	<div class="card-panel col s12">
		<div class="input-field col s3">
			<input id="search" value="<?= $search_string ?>" type="text" required>
			<label for="search"><i class="material-icons">search</i></label>
        </div>
        <div class="input-field col s2">
        	<button href="#" id="search_button" class="btn grey">Buscar</button>
        </div>
		<div class="input-field col s4">
			<select id="group_id">
				<option disabled selected>Ordenar por...</option>
				<option value="">Nome</option>
				<option value="">Entrada</option>
			</select>
		</div>
		<div class="input-field col s3">
			<a class="btn green" id="" href="<?= base_url('stock/groups/create'); ?>">Adicionar novo</a>
		</div>
	</div>
</div>	
<div class="container row">
	<div class="col s7">
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

