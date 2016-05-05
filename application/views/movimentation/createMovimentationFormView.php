<?php 
date_default_timezone_set('America/Sao_Paulo');
$datePick = date('Y-m-d');
$monPick = date('Y-m');
?>
<a class="modal-trigger waves-effect waves-light btn" href="<?= base_url('financial-movimentation') ?>" >Voltar</a>
<div class="container">
	<form action="create-movimentation" method="POST" >
		<div class="row">
			<div class="col s6">
				<label for="type">Tipo:</label>
				<select class="browser-default" required name="type" id="type"> 
					<option value="" disabled selected>Selecione</option>
					<option value="e">Entrada</option>
					<option value="s">Saida</option>
				</select>
			</div>
			<div class="col s6">
				<label for="classification" >Classificação:</label>
				<select class="browser-default" required name="classification" id="classification">
					<option>Escolha um tipo</option>
				</select>
			</div>
			
			<a class="col s12 waves-effect waves-light  modal-trigger openSearchModal"  href="#searchModal">
				<div>
					<label for="inputPerson">Pessoa:</label>
					<input type="text" name="people" id="inputPerson" placeholder="Clique aqui para escolher uma pessoa." value="" disabled required></input>
					<input type="hidden" name="idPeople" id="idPeople" ></input>
				</div>
			</a>


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
					<input type="month" class="datepicker" value="" required name="date" >
				</div>
				<div class="col s6">
					<label for="movimentationDate">Data do lançamento:</label>
					<input type="date" class="datepicker" value="<?php echo $datePick ?>" required name="movimentationDate">
				</div>

				

				<div class="col s12">
					<label for="historic">Histórico</label>
					<textarea class="materialize-textarea" name="historic" maxlength="255" cols="30" rows="10"></textarea>
					<button type="submit" class="btn green">Salvar 
						<i class="material-icons right">send</i>
					</button>
				</div>
		</div>
	</form>

	<!-- Modal Structure -->
		<div id="searchModal" class="modal">
			<div class="modal-content">
				<nav>
					<div class="nav-wrapper color">
						<div class="input-field">
							<input id="search" name="search" type="search" required placeholder="Pesquisar...">
							<label for="search"><i class="material-icons">search</i></label>
						</div>
					</div>
				</nav>

				<br><br>

				<table class="striped hightlight">
					<thead>
						<tr>

						</tr>
					</thead>
					<tbody id="finalResult">
						<tr>
						
						</tr>
					</tbody>
				</table>
					<div class="modal-footer">
						<a href=" <?= base_url('/PeopleController/create') ?>" class=" modal-action "><button class="waves-effect waves-green btn">Adicionar Nova Pessoa</button></a>
					</div>
			</div>
		</div>
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

		$(".openSearchModal").click(function(){
       		$('#searchModal').openModal();
       		document.getElementById('search').value="";
     	});

		$("input[name=search]").keyup(function(){
			if($(this).val() != ''){
				$.ajax({
					url: "<?php echo site_url('/SearchController/buscar')?>",
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
									items.push($('<tr><td>' + val.name + '<button class="right btn button" id="'+ val.id_people +'" name ="'+ val.name +'" >SELECIONAR</button></td></tr>'));
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

	$(document).on('click','.button', function(){
        document.getElementById('inputPerson').value=$(this).attr('name');
        document.getElementById('idPeople').value=$(this).attr('id');
        $('#searchModal').closeModal();	
        $('#finalResult').empty();

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