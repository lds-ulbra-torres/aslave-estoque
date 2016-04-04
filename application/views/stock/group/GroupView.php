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
		$("table").on("click",".deleteCat", function(){
			$('#cateModal').openModal();	
			idGroup = $(this).attr("id");
		});
		$("#deleteCat").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteGroup'); ?>",
				type: "POST",
				data: {id_group: idGroup},
				success: function(data){
					if(!data){
						Materialize.toast('Erro ao deletar a categoria!', 4000);
					}else{
						Materialize.toast('Categoria deletada!', 4000);
						reloadTableGroup();
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao deletar a categoria!', 4000);	
				}
			});
		});
	});
</script>
<div id="content_table" class="container">
	<table id="group" class="striped">
		<legend><h4>Categorias</h4></legend>
		<thead>
			<td>Nome</td>
			<td>Ações</td>
		</thead>
		<tbody>
			<?php foreach($groups as $row) :?>
				<tr>
				  <td><?= $row['name_group'] ?></td>
				  <td><a href="<?= base_url('stock/groups/update/'.$row['id_group']); ?>">Alterar</a> |
				  <a class="deleteCat" id="<?php echo $row['id_group']; ?>" href="#" >Apagar</a></td>
           		</tr>
                  <?php endforeach; ?>
        </tbody>
	</table>
	<div id="cateModal" class="modal">
		<div class="modal-content">
			<h4>Aviso</h4>
			<div class="row">
				<p> Realmente quer apagar esta Categoria?</p>
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
			<a href="#!" id="deleteCat" class=" modal-action modal-close waves-effect waves-green btn-flat">Apagar</a>
		</div>
	</div>	
</div>
