<div class="container">
	<h4 class="fontUt center">Alterar classificação</h4>
	<form action="<?= base_url("update-classification/$classification") ?>" method="POST">
		<ul>
			<li>
				<label>Nome: </label>
				<input type="text" value="" name="updateClasName"  required="required"/>
			</li>
			<li>
				<label>Tipo de classificação: </label>
			</li>
			<li>
				<input name="updateClasType" type="radio"  value="e" id="updateClasType1" checked/>
				<label for="updateClasType1" >Entrada</label>

				<input name="updateClasType" type="radio"  value="s" id="updateClasType2" />
				<label for="updateClasType2" >Saida</label>
			</li>
			<hr>
			<li>
				<button class="btn waves-effect waves-light" type="submit" id="submitButton">Enviar</button>
			</li>
		</ul>
	</form>
</div>