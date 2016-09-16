<div class="container">
<a href="<?= base_url("classification") ?>" >< Voltar para classificações</a>
	<h4 class=" center">Alterar classificação</h4>
	<?php $id = $classification[0]['id_classification'];?>
	<form action="<?= base_url("update-classification/$id") ?>" method="POST">
		<ul>
			<li>
				<label>Nome: </label>
				<input type="text" value="<?php echo $classification[0]['name_classification']; ?>" name="updateClasName"  required="required"/>
			</li>
			<li>
				<label>Tipo de classificação: </label>
			</li>
			<li>
				<input name="updateClasType" type="radio"  value="e" id="updateClasType1" <?php if($classification[0]['classification_type']=="e"){ echo "checked"; } ?>/>
				<label for="updateClasType1" >Entrada</label>

				<input name="updateClasType" type="radio"  value="s" id="updateClasType2" <?php if($classification[0]['classification_type']=="s"){ echo "checked"; } ?>/>
				<label for="updateClasType2" >Saida</label>
			</li>
			<hr>
			<li>
				<button id="sendClassification" class="btn green right" type="submit" name="action">Salvar 
					<i class="material-icons right">send</i>
				</button>    
			</li>
		</ul>
	</form>
</div>