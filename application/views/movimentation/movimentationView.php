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
									items.push($('<option id="'+ val.id_people +'" value="'+ val.name +'"> ' + val.name + '</option>'));
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
					var saida = 0;
					var entrada = 0;
					document.getElementById('searchPeopleId').value="";
					document.getElementById('searchPeople').value="";
					document.getElementById('searchDate').value="";
					document.getElementById('typeSearch').value="";

					$('#bodyMove').html("");
					$('#tSaida').html("");
					$('#tEntrada').html("");

					var obj = JSON.parse(data);
					if(obj != null){
						try{
							var items=[];
							var itemPositive=[];
							var itemNegative=[];
							$.each(obj, function(i,val){

								if(val.type_mov == "E"){
									entrada += parseFloat(val.value);
								}else{
									saida += parseFloat(val.value);
								}

								items.push($('<tr><td>' + val.date_financial_release +'</td><td>'+ val.due_date_pay +'</td><td>'+ val.name +'</td><td class="right">'+ val.value +' </td><td>'+ val.type_mov +' </td><td> <a href="update-movimentation-form/'+ val.id_financial_release +'">Alterar</a> | <a href="#deleteMovModal" id="'+ val.id_financial_release +'"class="deleteMovModal">Deletar</a></td> </tr>'));
							});

								itemPositive.push($('<h4 class="formatedNum">Total entrada:'+ entrada +'</h4>'));

								if(saida == 0){
									itemNegative.push($('<h4>Total saída:</h4>'));
								}else{
									itemNegative.push($('<h4 class="formatedNum">Total saída:-'+ saida + '</h4>'));
								}


							$('#bodyMove').append.apply($('#bodyMove'), items);
							$('#tEntrada').append.apply($('#tEntrada'), itemPositive); 
							$('#tSaida').append.apply($('#tSaida'), itemNegative);

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
	
	<div class="container">
		<h4>Lançamentos</h4>
		<div class="card-panel row">
			<form id="toFound" method="POST">	
			    <div class="col s12 m3">
                    <a class="margin-alter btn green" href="<?= base_url('create-movimentation-form');?>">ADICIONAR NOVO</a>
			    </div>
				<div class="col s12 m3 ">
					<label for="searchPeople" class="black-text ">Pessoa:</label>
					<input type="text" autocomplete="off" name="searchPeople" id="searchPeople"></input>
					<input type="hidden" name="searchPeopleId" id="searchPeopleId"></input>
					<a href="#" id="found">
					</a>
				</div>
				<div class="col s12 m3">
				    <label for="searchDate" class="black-text">Competência:</label>
					<input  class="typeMonth" type="month" name="searchDate" id="searchDate" value="">
					
				</div>
				<div class="col s12 m1" style="margin-top: 22px;">
					<select name="typeSearch" id="typeSearch" > 
						<option value="">Ambos</option>
						<option value="E">E</option>
						<option value="S">S</option>
					</select>
					<label class="black-text">Tipo:</label>
				</div>
				<div class="col s12 m1">
				    <input class="btn green margin-alter" value="Buscar" type="submit"></input>
				</div>
			</form>


		</div> 

		<div class="row">
			<div class="col s12 collection">
				<table class="bordered highlight">
					<thead>
						<tr>
							<td><strong>Competência:</strong></td>
							<td><strong>Lançamento:</strong></td>
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
								<td class=" right"> <?= number_format($movimentation['value'],2,',','.'); ?></td>
								<td><?= $movimentation['type_mov'] ?></td>
								<td> 
									<a href="update-movimentation-form/<?= $movimentation['id_financial_release'] ?>">Alterar</a>
									|
									<a href="#deleteMovModal" id="<?= $movimentation['id_financial_release'] ?>" class="deleteMovModal">Apagar</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>


				</table>
			</div>
			<div class="row center">
			
				<div class="col s6" id="tEntrada">
					<h4>Total entrada: <?= number_format($totalPositive,2,',','.'); ?></h4>
				</div>
				<div class="col s6" id="tSaida">
				<?php if($totalNegative == 0){ ?>
					<h4>Total saída: <?= number_format($totalNegative,2,',','.'); ?></h4>
				<?php }else{ ?>
					<h4>Total saída: -<?= number_format($totalNegative,2,',','.'); ?></h4>
				<?php } ?>
				</div>
			</div>
		</div>
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
					<a href="#!" onClick="document.getElementById('delete-c').submit();" class="waves-effect waves-red btn red">Apagar</a>
				</div>		
			</form>
		</div>
	</div>
</div>