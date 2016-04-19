
<div class="container">
<br>
<br>
<h4 class="fontUt center">Cadastrar classificação</h4>
	<form action="create-classification" method="POST">
		<ul>
			<li>
				<label>Nome: </label>
				<input type="text" name="classificationName" required="">
			</li>
			<li>    
				<label>Tipo de classificação: </label>
			</li>
			<li>
				<input name="classificationType" type="radio"  value="e" id="classificationType1" checked/>
				<label for="classificationType1" >Entrada</label>
				<input name="classificationType" type="radio"  value="s" id="classificationType2" />
				<label for="classificationType2" >Saida</label>

			</li>
			<hr>
			<li>
				<button id="sendClassification" class="btn green" type="submit" name="action">Salvar 
					<i class="material-icons right">send</i>
				</button>    
			</li>
		</ul>
	</form>
</div>