<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
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
	});
</script>
<div class="container">
	<form action="create-movimentation" method="POST" >

		<label for="type">Tipo:</label>
		<select required class="browser-default" name="type" id="type">
			<option value="" disabled selected>Choose your option</option>
			<option value="e">Entrada</option>
			<option value="s">Saida</option>
		</select>
		

		<label for="people">Pessoa:</label>
		<input required type="text" name="people">

		<label for="numDoc">Numero do documento:</label>
		<input type="text" name="numDoc">

		<label for="classification" >Classificação:</label>
		<select required class="browser-default" name="classification" id="classification">
			<option value="">Carregando...</option>
		</select>

		<label for="date">Data atual:</label>
		<input required type="text" name="date" >
		
		<label for="movimentationDate">Data do movimento:</label>
		<input required type="text" name="movimentationDate">

		<label for="value">Valor:</label>
		<input required type="number" name="value">

		<label for="historic">Histórico</label>
		<input required type="text" name="historic">

		<button type="submit" class="waves-effect waves-light btn">Enviar</button>
	</form>
</div>