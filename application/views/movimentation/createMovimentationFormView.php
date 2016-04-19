<div class="container">
	<form action="create-movimentation" method="POST" >
		<div class="row">
			<div class="col s6">
				<label for="type">Tipo:</label>
				<select class="browser-default" name="type" id="type"> 
					<option value="" disabled selected>Choose your option</option>
					<option value="e">Entrada</option>
					<option value="s">Saida</option>
				</select>
			</div>

			<div class="col s6">
				<label for="classification" >Classificação:</label>
				<select class="browser-default" name="classification" id="classification">
					<option>Escolha um tipo</option>
				</select>
			</div>
			
			<div class="col s8">
				<label for="people">Pessoa:</label>
				<input type="text" name="people" id="people" placeholder="Escolha uma pessoa ao lado." value="" disabled> 
			</div>

			<div class="col s4">
				<!-- Modal Trigger -->
				<a class="waves-effect waves-light  modal-trigger openSearchModal"  href="#SearchModal">
					<nav>
						<div class="nav-wrapper color">
							<form>
								<div class="input-field">
									<i class="material-icons">search</i>
									<i class="material-icons">close</i>
								</div>
							</form>
						</div>
					</nav>
				</a>
			</div>

				<div class="col s12">
					<label for="numDoc">Numero do documento:</label>
					<input type="text" name="numDoc">
				</div>

				<div class="col s6">
					<label for="date">Data atual:</label>
					<input type="text" name="date" >
				</div>
				<div class="col s6">
					<label for="movimentationDate">Data do movimento:</label>
					<input type="text" name="movimentationDate">
				</div>

				<div class="col s10">
					<label for="value">Valor:</label>
					<input type="text" id="value" name="value">				
				</div>	

				<div class="col s12">
					<label for="historic">Histórico</label>
					<textarea class="materialize-textarea" name="historic" maxlength="255" cols="30" rows="10"></textarea>
					<button type="submit" class="btn green">Salvar 
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</div>
	</form>

	<!-- Modal Structure -->
		<div id="SearchModal" class="modal">
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
					<tr>
						<tbody id="finalResult">

						</tbody>
					</tr>
				</table>
					<div class="modal-footer">
						<a href=" <?php echo base_url('/PeopleController/create') ?>" class=" modal-action "><button class="waves-effect waves-green btn">Adicionar Nova Pessoa</button></a>
					</div>
			</div>
		</div>
</div>
<script type="text/javascript">
	$(document).on('click','#batata', function(){
        document.getElementByName('people').id=$(this).attr('name');
        $('#SearchModal').closeModal();
    });

	$(document).ready(function(){
		$("#type").change(function(){
			var type = $('#type option:selected').val();
			$.ajax({
				url: "ClassificationController/searchClassification",
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
       		$('#SearchModal').openModal();
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
									items.push($('<tr><td>' + val.name + '<button class="right btn" name ="'+ val.id_people +'" id="batata">SELECIONAR</button></td></tr>'));
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