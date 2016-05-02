
<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteMovModal").click(function(){
			$('#deleteMovModal').openModal();
			document.getElementById('idDeleteMov').value=$(this).attr('id');
		});

		$("#finalResult").click(function(){
			document.getElementById('searchPeople').value=$('.foundPeople').attr('id');
		});

		// Pesquisa
		$("input[id=searchPeople]").keyup(function(){
			if($(this).val() != ''){
				$.ajax({
					url: "<?= site_url('/SearchController/buscar'); ?>",
					type: "POST",
					cache: false,
					data: {name_people: $(this).val()},
					success: function(data){
						$('#finalResult').html("");
						var obj = JSON.parse(data);
						if(obj.length>0){
							try{
								var items=[];   
								$.each(obj, function(i,val){                      
									items.push($('<option class="foundPeople" id="'+ val.id_people +'"> ' + val.name + '  </option>'));
								}); 
								$('#finalResult').append.apply($('#finalResult'), items);
							}catch(e) {   
								alert('Exception while request..');
							}   
						}else{
							$('#finalResult').html($('<span/>').text("Nenhum nome encontrado"));    
						}   
					},
					error: function(){
						alert("ERRO!");
					}
				});
			}else{
				$('#finalResult').empty();
			}
		}); 

	});
</script>
<div> 
	<a class="modal-trigger waves-effect waves-light btn" href="create-movimentation-form" >+Movimentação</a>

	<div class="container">
	
		<div class="card-panel row">
			<h4 class="center">Movimentações financeiras</h4>

			<form action="<?= base_url('search-movimentation'); ?>" method="POST">	
				<div class="col s12 m3 ">
					<label for="searchPeople" class="black-text ">Pessoa:</label>
					<input type="text" name="searchPeople" id="searchPeople"></input>

					<a href="#" id="finalResult">
			  
			      	</a>
				</div>
				<div class="col s12 m3">
					<label for="searchDate" class="black-text">Competência:</label>
					<input type="month" name="searchDate" class=""></input>
				</div>
				<div class="col s12 m3">
					<label for="typeSearch" class="black-text">Tipo:</label>
					<select name="typeSearch" id="typeSearchs" class="browser-default"> 
						<option value="" disabled selected>Selecione</option>
						<option value="e">Entrada</option>
						<option value="s">Saida</option>
					</select>
				</div>
				<input type="submit"></input>
			</form>
			
			<div class="col s12 m3"><h5 class="">Total</h5>
				<?php 
				if($total > 0){
					echo "<h4 style='color:green'>R$ ".$total."</h4>";
				}else{
					echo "<h4 style='color:red'>R$ ".$total."</h4>";
				}
				?>
			</div>

		</div> 
		<table class="striped">
			<thead>
				<tr>
					<td><strong>Data da competencia:</strong></td>
					<td><strong>Data de lançamento:</strong></td>
					<td><strong>Pessoa:</strong></td>
					<td class="right"><strong>Valor R$:</strong></td>
					<td><strong>Tipo:</strong></td>
				</tr>
			</thead>
			<tbody>
			<?php foreach($movimentations as $movimentation) : ?>
				<tr>
					<td><?= $movimentation['date_financial_release'] ?></td>
					<td><?= $movimentation['due_date_pay'] ?></td>
					<td><?= $movimentation['name'] ?></td>
					<?php if($movimentation['type_mov'] == 's'){ ?>
						<td class=""><span style="color:red;" class="right" > <?= "-".$movimentation['value'] ?></span></td>
					<?php }else{ ?>
						<td class=" right"> <?= $movimentation['value'] ?></td>
					<?php } ?>
					<td><?= $movimentation['type_mov'] ?></td>
					<td> 
						<a href="update-movimentation/<?= $movimentation['id_financial_release'] ?>">Alterar</a>
						|
						<a href="#deleteMovModal" id="<?= $movimentation['id_financial_release'] ?>" class="deleteMovModal">Deletar</a>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div id="deleteMovModal" class="modal modal-fixed-footer">
		<div class="modal-content valign-wrapper">
		<h3 class="center-align valign">Deseja mesmo deletar?</h3>
			<form action="delete-movimentation" method="POST">
				<input id="idDeleteMov" name="DeleteMov" type="hidden" value="">
		</div>
			<div class="modal-footer">
				<button  class="modal-trigger marginl waves-effect waves-light btn green" type="submit">Sim</button>
			    <a href="#!" class="modal-trigger marginl waves-light btn">Não</a>
		    </div>
		</form>
	</div>


</div>