<?php 
date_default_timezone_set('America/Sao_Paulo');
$datePick = date('Y-m-d');
$monPick = date('Y-m');
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.deleteMovModal',function(){
			$('#deleteMovModal').openModal();
			document.getElementById('idDeleteMov').value=$(this).attr('id');
		});

		$(document).on('click','option', function(){
	      	document.getElementById('searchPeopleId').value=$(this).attr('id');
	      	document.getElementById('searchPeople').value=$(this).attr('value');
	      	$('#found').empty();
   		});


		// Pesquisa Pessoa
		$("input[id=searchPeople]").keyup(function(){
			if($(this).val() != ''){
				$.ajax({
					url: "<?= site_url('/SearchController/buscar'); ?>",
					type: "POST",
					cache: false,
					data: {name_people: $(this).val()},
					success: function(data){
						$('#found').html("");
						var obj = JSON.parse(data);
						if(obj.length>0){
							try{
								var items=[];   
								$.each(obj, function(i,val){                      
									items.push($('<option id="'+ val.id_people +'" value="'+ val.name +'"> ' + val.name + '  </option>'));
								}); 
								$('#found').append.apply($('#found'), items);
							}catch(e) {   
								alert('Exception while request..');
							}   
						}else{
							$('#found').html($('<span/>').text("Nenhum nome encontrado"));    
						}   
					},
					error: function(){
						alert("ERRO!");
					}
				});
			}else{
				$('#found').empty();
			}
		}); 


		// Achar a bendita
		$("#toFound").submit(function(e){
			e.preventDefault();
			console.log($("#searchPeopleId").val(),$("#searchDate").val(),$("#typeSearch").val());
			$.ajax({
				url: "<?= site_url('search-movimentation'); ?>",
				type: "POST",
				data: {id_people:$("#searchPeopleId").val(),date_financial_release:$("#searchDate").val(),type_mov:$("#typeSearch").val()},
				success:function(data){
					document.getElementById('searchPeopleId').value="";
					document.getElementById('searchPeople').value="";
					document.getElementById('searchDate').value="";
					document.getElementById('typeSearch').value="";

					$('#bodyMove').html("");
						var obj = JSON.parse(data);
						if(obj.length>0){
							try{
								var items=[];   
								$.each(obj, function(i,val){                
									items.push($('<tr><td>' + val.date_financial_release +'</td><td>'+ val.due_date_pay +'</td><td>'+ val.name +'</td><td class="right">'+ val.value + ' </td><td>'+ val.type_mov +' </td><td> <a href="update-movimentation-form/'+ val.id_financial_release + '">Alterar</a> | <a href="#deleteMovModal" id="'+ val.id_financial_release +'"class="deleteMovModal">Deletar</a></td> </tr>'));
								});

								$('#bodyMove').append.apply($('#bodyMove'), items);
								
							}catch(e) {   
								alert('Exception while request..');
							}   
						}else{
							$('#bodyMove').html($('<span/>').text("Nenhuma movimentação encontrada"));    
						}   
				},
				error:function(data){
					alert("erro");
				}
			});
		});

	});

		$(document).ready(function(){

		$(".closeModal").click(function(){
			$('#deleteMovModal').closeModal();
		});
	});
</script>
<div> 
<br>
	<a class="modal-trigger btn green" href="create-movimentation-form" style="margin-left: 5px;">ADICIONAR NOVA</a>

	<div class="container">
	
		<div class="card-panel row">
			<h4 class="center">Movimentações financeiras</h4>

			<form id="toFound" method="POST">	
				<div class="col s12 m3 ">
					<label for="searchPeople" class="black-text ">Pessoa:</label>
					<input type="text" autocomplete="off" name="searchPeople" id="searchPeople"></input>
					<input type="hidden" name="searchPeopleId" id="searchPeopleId"></input>

					<a href="#" id="found">
		
			      	</a>
				
				</div>
				<div class="col s12 m3">
					<label for="searchDate" class="black-text">Competência:</label>
					<input type="month" name="searchDate" id="searchDate" value=""></input>
				</div>
				<div class="col s12 m3">
					<label for="typeSearch" class="black-text">Tipo:</label>
					<select name="typeSearch" id="typeSearch" class="browser-default"> 
						<option value="" disabled selected>Selecione</option>
						<option value="e">Entrada</option>
						<option value="s">Saida</option>
					</select>
				</div>
				<input class="btn green" value="Buscar" type="submit" style="margin-top: 30px;"></input>
			</form>


		</div> 
		<div class="col s12 m3 right"><h5 class="">Total</h5>
				<?php 
					if($total > 0){
						echo "<h6 style='color:green'>R$ ".$total."</h6>";
					}else{
						echo "<h6 style='color:red'>R$ ".$total."</h6>";
					}
				?>
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
			
			<tbody id="bodyMove">
				<?php foreach($movimentations as $movimentation) : ?>
					<tr>
						<td><?= date('m-Y', strtotime($movimentation['date_financial_release']));?></td>
						<td><?= date('d-m-Y', strtotime($movimentation['due_date_pay']));?></td>
						<td><?= $movimentation['name'] ?></td>
						<td class=" right"> <?= $movimentation['value'] ?></td>
						<td><?= $movimentation['type_mov'] ?></td>
						<td> 
							<a href="update-movimentation-form/<?= $movimentation['id_financial_release'] ?>">Alterar</a>
							|
							<a href="#deleteMovModal" id="<?= $movimentation['id_financial_release'] ?>" class="deleteMovModal">Deletar</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>


		</table>
	</div>
<br><br>
	<div id="deleteMovModal" class="modal">
		<div class="modal-content">
			<form action="delete-movimentation" id="delete-c" method="POST">
				<div class="modal-content">
					<h4>Aviso</h4>
					<div class="row">
						<p>Realmente quer apagar esta movimentação?</p>
					</div>
				</div>
					<input id="idDeleteMov" name="DeleteMov" type="hidden" value="">
				<div class="modal-footer">
					<a href="#!" class=" closeModal waves-effect waves-green btn-flat">Cancelar</a>
					<a href="#!" onClick="document.getElementById('delete-c').submit();" class="waves-effect waves-red btn-flat">Apagar</a>
				</div>		
			</form>
		</div>
	</div>
</div>