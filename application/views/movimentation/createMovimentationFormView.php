<?php 
date_default_timezone_set('America/Sao_Paulo');
$datePick = date('Y-m-d');
$monPick = date('Y-m');
?>

<script>
	$(document).ready(function(){		
		var people_json = "<?php echo site_url('/StockController/searchPeople')?>";
	    $('#idPeople').simpleSelect2Json(people_json,'id_people','name');
	});
</script>
<div class="container">
    <a href="<?= base_url('financial-movimentation') ?>" >< Voltar para lançamentos</a>
	<form action="create-movimentation" method="POST" >
		<div class="row">
			<div class="col s6">
				<label for="type">Tipo:</label>
				<select class="browser-default" required name="type" id="type"> 
					<option value="" disabled selected>Selecione</option>
					<option value="E">Entrada</option>
					<option value="S">Saida</option>
				</select>
			</div>
			<div class="col s6">
				<label for="classification" >Classificação:</label>
				<select class="browser-default" required name="classification" id="classification">
					<option>Escolha um tipo</option>
				</select>
			</div>
			
			
			<div class="col s12">
				<label for="searchPeopleId">Pessoa:</label>
				<div class="col s12 m12">
					<div class="input-field">
						<select id="idPeople" class="selectSearch" name="idPeople">
							<option value="" selected>Todos</option>
						</select>
					</div>    
				</div>
			</div>


				<div class="col s6">
					<label for="numDoc">Numero do documento:</label>
					<input type="number" name="numDoc" required>
				</div>

				<div class="col s6">
					<label for="value">Valor:</label>
					<input type="text" id="value" required name="value" maxlength="20" >				
				</div>	

				<div class="col s6">
					<label for="date">Data da competência: </label>
					<input class="typeMonth" type="month" class="datepicker" value="" required name="date" >
				</div>
				<div class="col s6">
					<label for="movimentationDate">Data do lançamento:</label>
					<input type="date" class="datepicker" value="<?php echo $datePick ?>" required name="movimentationDate">
				</div>

				

				<div class="col s12">
					<label for="historic">Histórico</label>
					<textarea class="materialize-textarea" required name="historic" maxlength="255" cols="30" rows="10"></textarea>
					<button type="submit" class="btn green right">Salvar 
						<i class="material-icons right">send</i>
					</button>
				</div>
		</div>
	</form>


</div>
<script type="text/javascript">
	  
	$(document).ready(function(){
		$(function(){
 			$("#value").maskMoney({symbol:'', 
			showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 		});

		$('select').material_select();
		$("#type").change(function(){
			var type = $('#type option:selected').val();
			$.ajax({
				url: "<?= site_url('/ClassificationController/searchClassification'); ?>",
				type: "POST",
				dataType: "html",
				data:{
					type : type
				},
				success: function(data){

					$("#classification").append().html(data);
				},
				error: function(data){
					alert(data)
				}
			});
		});

		$(document).on('click','option', function(){
	      	document.getElementById('idPeople').value=$(this).attr('id');
	      	document.getElementById('inputPerson').value=$(this).attr('value');
	      	$('#found').empty();
   		});

		$("#inputPerson").keyup(function(){
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
	});
</script>