<script type="text/javascript" src="<?= base_url('assets/js/jquery-2.2.2.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
<meta charset="UTF-8">
<script type="text/javascript">
$(document).ready(function(){
//Mascaras
$(".cpf").mask("999.999.999-99",{placeholder:" "});
$(".cnpj").mask("99.999.999/9999-99",{placeholder:" "});
$(".inscEstadual").mask("9999-99999",{placeholder:" "});
$(".phone").mask("(99) 9999-9999",{placeholder:" "});
$(".rg").mask("99.999.999-99",{placeholder:" "});
$(".cep").mask("99999/999",{placeholder:" "}); 
$("#state").change(function() {
	    $("#state option:selected").each(function() {
		    state = $('#state').val();
		    $.post("<?= base_url('peopleController/searchLocalidade')?>", {
			    state : state
		    }, function(data) {
			    $("#localidade").html(data);
		    });
	    });
    });
$(function() {
	    var documentFisic = $('.documentFisic');
	    var documentJuridic = $('.documentJuridic');
	    function showInput(id) {
		    if(id == 'fisica') {
			    documentJuridic.hide();
			    documentFisic.show();
		    }
		    else if(id == 'juridica') {
			    documentFisic.hide();
			    documentJuridic.show();
		    }
	    }
	});
});
</script>
<body>
	<div>
		
		<h4>Alterar Dados</h4>
		<form action="<?= base_url("update-people/$id")?>" method="POST">
			<ul>
			<input type="hidden" name="updatePeopleId" id="id" value="<?= $id ?>" >
				<li>
					<label>Nome: </label>
					<input type="text" name="updatePeopleName" required="required">

				</li>
				<li class="documentFisic">
					<label>CPF</label>
					<input type="text" class="cpf" name="updatePeopleCpf">
				</li>
				<li class="documentJuridic">
					<label>CNPJ:</label>
					<input type="text" class="cnpj" name="updatePeopleCnpj">
				</li>
				<li class="documentFisic">
					<label>RG: </label>
					<input type="text" class="rg" name="updatePeopleRg">
				</li>
				<li class="documentJuridic">
					<label>Inscrição Estadual: </label>
					<input type="text" class="inscEstadual" name="updatePeopleInsc">
				</li>
				<li>
					<label>Endereço: </label>
					<input type="text" name="updatePeopleAdress" required="required">
				</li>
				<li>
					<label>Numero: </label>
					<input type="text" name="updatePeopleNumber" value="" required="required">
				</li>
				<li>
					<label>Bairro: </label>
					<input type="text" name="updatePeopleNeighborhood" required="required">
				</li>
				<li>
				<label>Estado: </label>
				<select class="browser-default" name="state" id="state">
						<?php 
						foreach($states as $fila)
						{
							?>
				<option value="<?=$fila -> id_states ?>"><?=$fila -> name ?></option>
							<?php
						}
						?>		
				</select>
				</li>
				<li>
					<label>Cidade: </label>
					<select class="browser-default" name="updatePeopleCitie" id="localidade">
						<option value="">Escolha o seu estado</option>
					</select>
				</select>
			</li>
			<li>
				<label>CEP: </label>
				<input type="text" class="cep" name="updatePeopleCep" required="required">
			</li>
			<li>
				<label>Data de Nascimento: </label>
				<input type="date" name="updatePeopleDateBirth"class="datepicker">
			</li>
			<li>
				<label>Telefone: </label>
				<input type="text" class="phone" name="updatePeoplePhone1" value="" required="required">
			</li>
			<li>
				<label>Telefone 2: </label>
				<input type="text" class="phone" name="updatePeoplePhone2" required="required">
			</li>
			<button class="btn waves-effect waves-light" type="submit" name="action">Enviar</button>
		</ul>
	</form>
</div>
</div>