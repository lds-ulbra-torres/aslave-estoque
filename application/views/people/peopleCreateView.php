<script type="text/javascript"  src="<?= base_url('assets/js/jquery-2.2.2.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
<meta charset="UTF-8">
<script type="text/javascript">
$(document).ready(function(){
//Mascaras
$('.cpf').mask("999.999.999-99",{placeholder:" "});
$(".cnpj").mask("99.999.999/9999-99",{placeholder:" "});
$('.inscEstadual').mask("9999-99999",{placeholder:" "});
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
});

//Validação Pessoa fisica e juridica
$(function() {
	var peopleRegistration = $('.peopleRegistration');
	var documentFisic = $('.documentFisic');
	var documentJuridic = $('.documentJuridic');
	peopleRegistration.hide();
	documentFisic.hide();
	documentJuridic.hide();
	function showInput(id) {
		peopleRegistration.show();
		if(id == 'fisica') {
			documentJuridic.hide();
			documentFisic.show();
		}
		else if(id == 'juridica') {
			documentFisic.hide();
			documentJuridic.show();
		}
	}
	$(document).on('click', 'input[type=radio]', function(){
		var id = $(this).prop('id');
		showInput(id);
	});
});
</script>
<body>
	<div>
		<div>
			<div>
				<h4>Cadastro de pessoa</h4>
				<div>
					<form action="create-people" id="formPeople" method="POST">
						<p>
							<input type="radio" value="1" name="peopleClassification" id="fisica">
							<label for="fisica">Pessoa Física</label>
						</p>
						<p>
							<input type="radio" value="2" name="peopleClassification" id="juridica">
							<label for="juridica">Pessoa Jurídica</label>
						</p>
						<ul class="peopleRegistration">
							<div class="container" id="mensagens"></div>

							<li>
								<label>Nome: </label>
								<input type="text" name="peopleName">
							</li>
							<li class="documentFisic">
								<label>CPF</label>
								<input type="text" class="cpf" name="peopleCpf">
							</li>
							<li class="documentJuridic">
								<label>CNPJ:</label>
								<input type="text" class="cnpj" name="peopleCnpj">
							</li>
							<li class="documentFisic">
								<label>RG: </label>
								<input type="text" class="rg" name="peopleRg">
							</li>
							<li class="documentJuridic">
								<label>Inscrição Estadual: </label>
								<input type="text" class="inscEstadual" name="peopleInscricao">
							</li>
							<li>
								<label>Endereço: </label>
								<input type="text" name="peopleAdress">
							</li>
							<li>
								<label>Numero: </label>
								<input type="text" name="peopleNumber" value="">
							</li>
							<li>
								<label>Bairro: </label>
								<input type="text" name="peopleNeighborhood">
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
	                        <select class="browser-default" name="peopleCitie" id="localidade">
    		                        <option value="">Escolha o seu estado</option>
                            </select>
							</li>
							<li>
								<label>CEP: </label>
								<input type="text" class="cep" name="peopleCep">
							</li>
							<li>
								<label>Data de Nascimento: </label>
								<input type="date" name="peopleDateBirth"class="datepicker">
							</li>
							<li>
								<label>Telefone: </label>
								<input type="text" class="phone" name="peoplePhone1" value="">
							</li>
							<li>
								<label>Telefone 2: </label>
								<input type="text" class="phone" name="peoplePhone2">
							</li>
							<button class="btn waves-effect waves-light" type="submit" name="action">Enviar</button>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>