<a class="modal-trigger waves-effect waves-light btn" href="<?= base_url('financial-movimentation') ?>" style="margin-left: 5px;" >Voltar</a>
<div class="container">
	<form action="<?= base_url("update-movimentation/"); ?><?= "/".$movimentation[0]['id_financial_release']; ?> " method="POST" >
		<div class="row">
			<div class="col s6">
				<label for="type">Tipo:</label>
				<select class="browser-default" name="type" id="type" required> 
					<option value="" disabled selected>Selecione</option>
					<option value="e" <?php if($movimentation[0]['type_mov'] == 'e'){echo "selected";}?> >Entrada</option>
					<option value="s" <?php if($movimentation[0]['type_mov'] == 's'){echo "selected";}?> >Saida</option>
				</select>
			</div>

			<div class="col s6">
				<label for="classification" >Classificação:</label>
				<select class="browser-default" name="classification" id="classification" required>
					<option value="<?= $movimentation[0]['id_classification']; ?>"><?= $movimentation[0]['name_classification']; ?></option>
				</select>
			</div >
			<a class="col s12 waves-effect waves-light  modal-trigger openSearchModal"  href="#searchModal">
				<div>
					<label for="inputPerson">Pessoa:</label>
					<input type="text" name="people" id="inputPerson" required placeholder="Clique aqui para escolher uma pessoa." value="<?= $movimentation[0]['name']; ?>" disabled></input>
					<input type="hidden" name="idPeople" id="idPeople" value="<?= $movimentation[0]['id_people'] ?>" ></input>
				</div>	
			</a>

				<div class="col s6">
					<label for="numDoc">Numero do documento:</label>
					<input type="number" name="numDoc" value="<?= $movimentation[0]['num_doc']; ?>" required>
				</div>

				<div class="col s6">
					<label for="value">Valor:</label>
					<input required type="text" id="value" name="value" class="money" value="<?= $movimentation[0]['value']; ?>">	
				</div>	

				<div class="col s6">
					<label for="date">Data da competência: </label>
					<input type="month" required class="datepicker" name="date" value="<?= date('Y-m', strtotime($movimentation[0]['date_financial_release'])); ?>">
				</div>
				<div class="col s6">
					<label for="movimentationDate">Data do lançamento:</label>
					<input required type="date" class="datepicker" name="movimentationDate" value="<?= $movimentation[0]['due_date_pay']; ?>">
				</div>

				

				<div class="col s12">
					<label for="historic">Histórico</label>
					<textarea required class="materialize-textarea" name="historic" maxlength="255" cols="30" rows="10" ><?= $movimentation[0]['historic']; ?></textarea>
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
					alert(data);
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