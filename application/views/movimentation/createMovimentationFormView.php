<?php 
date_default_timezone_set('America/Sao_Paulo');
$datePick = date('Y-m-d');
$monPick = date('Y-m');
?>
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
					<label for="inputPerson">Pessoa:</label>
					<input type="text" name="people" id="inputPerson" placeholder="Pesquise uma pessoa aqui." value="" required></input>
					<input type="hidden" name="idPeople" id="idPeople" ></input>

					<a href="#" id="found">
						
					</a>
				</div>


				<div class="col s6">
					<label for="numDoc">Numero do documento:</label>
					<input type="number" name="numDoc" required>
				</div>

				<div class="col s6">
					<label for="value">Valor:</label>
					<input type="text" id="value" required name="value" class="money" value="0.00">				
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

		var mask = {
			money: function() {
				var el = this
				,exec = function(v) {
					v = v.replace(/\D/g,"");
					v = new String(Number(v));
					var len = v.length;
					if (1== len)
						v = v.replace(/(\d)/,"0.0$1");
					else if (2 == len)
						v = v.replace(/(\d)/,"0.$1");
					else if (len > 2) {
						v = v.replace(/(\d{2})$/,'.$1');
					}
					return v;
				};

				setTimeout(function(){
					el.value = exec(el.value);
				},1);
			}

		}

		$(function(){
			$('.money').bind('keypress',mask.money);
			$('.money').bind('keyup',mask.money);
		});

	});
</script>