<div class="input-field col s3">
<a class="modal-trigger waves-effect waves-light btn" href="<?= base_url("classification") ?>" style="margin-left: 5px;">Voltar</a>
</div>
<div class="container">
<h4 class="center">Cadastrar classificação</h4>
	<form action="create-classification" method="POST">
	<div class="row">
	<div class="card-panel col s12 m12">
		<div class="row  conter">
			<div class="col s12  center">
			<br>
				<label class="left">Nome: </label>
				<input type="text" name="classificationName" required="">
			</div>
		</div>
		<div class="row  conter">	
			<div class="col s12 ">    
				<label>Tipo de classificação: </label>
			</div>
		</div>
		<div class="row  conter">
			<div class="col s12 ">
				<input name="classificationType" type="radio"  value="e" id="classificationType1" checked/>
				<label for="classificationType1" >Entrada</label>
				<input name="classificationType" type="radio"  value="s" id="classificationType2" />
				<label for="classificationType2" >Saida</label>

			</div>
		</div>
		<div class="row conter">
			<div class="col s12 ">
						<hr>
				<button id="sendClassification" class="btn green" type="submit" name="action">Salvar 
					<i class="material-icons right">send</i>
				</button>    
			</div>
		</div>
	</div>
	</div>
	</form>
</div>