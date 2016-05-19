<div>
        <div>
		    <a class="waves-effect waves-light btn" href="<?= base_url('create-people')?>">CADASTRO DE PESSOA
		    <i class="material-icons right">input</i></a></a>
		<div>
		<h3 align="center">Pessoas</h3>
		<div class="row">
		    <div class="container">
		    <table id="Tpeople" class="bordered highlight">
			    <thead>
				    <td><strong>Nome </strong></td>
				    <td><strong>CPF/CNPJ </strong></td>
				    <td><strong>Documento</strong></td>
			    </thead>
			    <tbody>
				    <?php foreach ($peoples as $people) :?>
					    <tr>
						    <td><a href="<?= base_url('update-people/'.$people->id_people)?>"><?= $people->name ?></a></td>
						    <td><?= $people->cpf_cnpj ?></td>
						    <td><?= $people->documment ?></td>
						    <td>
							    <a class="delete_people" id="<?php echo $people->id_people; ?>" href="#">
                                    <i class="material-icons" style="color:red;">delete_forever</i>
							    </a>

						    </td>
					    </tr>
				    <?php endforeach ?>
			    </tbody>
             </table>
                 <div>
    	            <?php echo $pagination_show;  ?>
                 </div>
          </div>
        </div>
		
    <div id="deletePeople" class="modal">
    <div class="modal-content">
      <h4>Apagar</h4>
      <p>Deseja realmente apagar o cadastro?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
		<a href="#!" id="delete_people" class=" modal-action modal-close red btn">Apagar</a>
    </div>
  </div>
		</table>
	</div>
</div>

<script type="text/javascript">
 $(document).ready(function(){
		function reloadTablePeople(){
			$.ajax({
				url: "<?= base_url('people/');?>",
				type: "POST",
				data: $("table"),
				success: function(data){
					$("#Tpeople").html($(data).find("table"));
					console.log($(data).find("table"));
				},
				error: function(){
					console.log(data);
					window.location.reload();
				}
			});
		}
var idPeople;
		$("table").on("click",".delete_people", function(){
			$('#deletePeople').openModal();	
			idPeople = $(this).attr("id");
		});

		$("#delete_people").on("click", function(){
			$.ajax({
				url: "<?php echo site_url('/PeopleController/delete'); ?>",
				type: "POST",
				data: {id_people: idPeople},
				success: function(data){
					if(!data){
						Materialize.toast(data, 4000);
					}else{
						Materialize.toast(data, 4000,'rounded');
						reloadTablePeople();
					}
				},
				error: function(data){
					console.log(data);
					Materialize.toast('Erro ao Excluir, Cadastro sendo utilizado!', 4000,'rounded');	
				}
			});
		});   
	});    
 </script>