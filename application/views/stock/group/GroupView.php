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
		$("table").on("click",".updateCat", function(){
			$('#updateModal').openModal();	
			idGroup = $(this).attr("id");
		});

		$("#deleteCat").click(function(){
			$.ajax({
				url: "<?php echo site_url('/StockController/deleteGroup'); ?>",
				type: "POST",
				data: {id_group: idGroup},
				success: function(data){
					if(!data){
						Materialize.toast('Erro ao apagar a categoria!', 4000);
					}else{
						Materialize.toast('Categoria apagada.', 4000);
						reloadTableGroup();
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao apagar a categoria!', 4000);	
				}
			});
		});

		$("#updateCatForm").submit(function(e){
      	e.preventDefault();
      	$.ajax({
      		url: "<?php echo site_url('/StockController/updateGroup'); ?>",
      		type: "POST",
      		data: {
      			id_group: idGroup,
      			name_group: $("#name_group").val()
      		},
      		success: function(data){
				var field = "O campo é obrigatorio";
				if(!data){
					Materialize.toast('Todos os campos são obrigatórios!', 4000);
				}else{
					Materialize.toast('Categoria de produtos salva.', 4000);
					$('#updateModal').closeModal();
					reloadTableGroup();
				}
			},
			error: function(data){
				alert(data);
				Materialize.toast('Ocorreu algum erro. Tente novamente', 4000);
			}
      	});
      });
	});
</script>
<div id="" class="container">
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
				  <td>
					  <a class="updateCat" id="<?php echo $row['id_group']; ?>" href="#">Alterar</a> |
					  <a class="deleteCat" id="<?php echo $row['id_group']; ?>" href="#">Apagar</a>
				  </td>
           		</tr>
                  <?php endforeach; ?>
        </tbody>
	</table>
</div>

<div id="cateModal" class="modal">
	<div class="modal-content">
		<h4>Aviso</h4>
		<div class="row">
			<p>Realmente quer apagar esta categoria?</p>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
		<a href="#!" id="deleteCat" class="modal-action modal-close waves-effect waves-red btn-flat">Apagar</a>
	</div>
</div>	

<div id="updateModal" class="modal">
	<div class="modal-content">
	<h4>Alterar categoria</h4>
		<form method="post" id="updateCatForm">
			<input type="text" value="" id="name_group" name="name_group" placeholder="Nome">
			<button class="btn waves-effect waves-light" type="submit">Salvar
				<i class="material-icons right">send</i>
			</button>
		</form>
	</div>
</div>
