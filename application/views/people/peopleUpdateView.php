		<div class="container">
			<a href="<?= base_url('people') ?>" >< Voltar para pessoas</a>
			<div class="row card-panel">
				<h4 align="center">Alterar Dados</h4>

				<form class="col s12" action="<?= base_url("update-people/$id")?>" id="update-form" method="POST">
					<div>
						<input type="hidden" name="updatePeopleId" id="id" value="<?= $id ?>" >

						<div class="col s12">
							<label>Nome *</label>
							<input type="text" name="updatePeopleName" value="<?php echo $dados_pessoa[0]->name; ?>" >

						</div>
						<div class="col s6">
							<div class="documentFisic">
								<label>CPF *</label>
								<input type="text" class="cpf" value="<?php echo $dados_pessoa[0]->cpf_cnpj; ?>" name="updatePeopleCpf">

							</div>
							<div class="documentJuridic">
								<label>CNPJ *</label>
								<input type="text" class="cnpj" id="teste" value="<?php echo $dados_pessoa[0]->cpf_cnpj; ?>" name="updatePeopleCnpj">

							</div>
						</div>
						<div class="col s6">
							<div class="documentFisic">
								<label>RG </label>
								<input type="text" class="rg" value="<?php echo $dados_pessoa[0]->documment; ?>" name="updatePeopleRg">

							</div>
							<div class="documentJuridic">
								<label>Inscrição Estadual </label>
								<input type="text" class="inscEstadual" value="<?php echo $dados_pessoa[0]->documment; ?>" name="updatePeopleInsc">

							</div>
						</div>
						<div class="col s12">
							<label>Endereço </label>
							<input type="text" name="updatePeopleAdress" value="<?php echo $dados_pessoa[0]->adress; ?>">

						</div>
						<div class="col s6">
							<label>Numero </label>
							<input type="text" name="updatePeopleNumber" value="<?php echo $dados_pessoa[0]->number; ?>">

						</div>
						<div class="col s6">
							<label>Bairro </label>
							<input type="text" name="updatePeopleNeighborhood" value="<?php echo $dados_pessoa[0]->neighborhood; ?>">

						</div>
						<div class="col s6">
							<label>Estado *</label>
							<select class="browser-default" name="state" id="state">
								<?php
								foreach($states as $fila)
								{
									?>
									<option
									value="<?php echo $fila->id_states ?>"
									<?php echo $fila->id_states==$alter_states[0]->id_states ?'selected':'';?>
									>
									<?=$fila -> name . " / (" . $fila -> uf . ")"?>
								</option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="col s6">
						<label>Cidade *</label>
						<select class="browser-default" name="updatePeopleCitie" id="localidade">
						</select>
					</select>
				</div>
				<div class="col s6">
					<label>CEP </label>
					<input type="text" class="cep" value="<?php echo $dados_pessoa[0]->cep; ?>" name="updatePeopleCep">

				</div>
				<div class="col s6">
					<label>Data de Nascimento </label>
					<input type="date" name="updatePeopleDateBirth" value="<?php echo $dados_pessoa[0]->date_birth; ?>" class="datepicker">
				</div>
				<div class="col s6">
					<label>Telefone</label>
					<input type="text" class="phone" name="updatePeoplePhone1" value="<?php echo $dados_pessoa[0]->phone1; ?>">

				</div>
				<div class="col s6">
					<label>Telefone 2</label>
					<input type="text" class="phone" name="updatePeoplePhone2" value="<?php echo $dados_pessoa[0]->phone2; ?>">

				</div>
				<div class="col s6" align="left">
					<label style="color:black;">* campos obrigatórios</label>
				</div>
				<div class="col s12" align="right">
					<button type="submit" id="sendPeople" class="waves-green btn green">Salvar
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</form>

	</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
//Escode Pessoa juridica ou fisica
$(function() {
	var documentFisic = $('.documentFisic');
	var documentJuridic = $('.documentJuridic');
	var cpf_cnpj = "<?php echo $dados_pessoa[0]->cpf_cnpj; ?>";
	var tamanho = cpf_cnpj.length;
	documentFisic.hide();
	documentJuridic.hide();
	if(tamanho == 18) {
		documentJuridic.show();
	}
	else if(tamanho == 14) {
		documentFisic.show();
	}
//Mascaras
$('.cpf').mask("999.999.999-99",{placeholder:" "});
$(".cnpj").mask("99.999.999/9999-99",{placeholder:" "});
$(".phone").mask("(99) 99999-9999",{placeholder:" "});
$(".cep").mask("99999/999",{placeholder:" "});
//Validações
jQuery.validator.addMethod("isString", function(value, element) {
	var regExp = /[0-9]/;
	if(regExp.test(value)) return false;
	else return true
}, "<p class='col s6' style='color: red; margin-top:1px;'>Por favor insira somente letras</p><br>");
$('#update-form').validate({
	rules: {
		updatePeopleName: { required: true, minlength: 5,isString: true},
		updatePeopleDateBirth: {maxlength: 10},
		updatePeopleNumber: {digits:true,},
		state: {required: true,},
		updatePeopleCnpj: { required: true,},
		updatePeopleCpf: { required: true,},
		updatePeopleRg:{ maxlength: 14, digits:true,},
		updatePeopleCitie: {required: true,},
	},
	messages: {
		updatePeopleName: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Nome<br>', minlength: '<p class="col s6" style="color: red; margin-top:1px;">No mínimo 5 letras <br>'},
		updatePeopleDateBirth:  {maxlength:'<p style="color: red; margin-top:1px;">Informe uma data válida<br>'},
		updatePeopleNumber:  {digits:'<p class="col s6" style="color: red; margin-top:1px;">Apenas números <br>'},
		state: {required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha um estado <br>',},
		updatePeopleCnpj: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CNPJ <br>'},
		updatePeopleCpf: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CPF<br>',},
		updatePeopleRg:{ maxlength: '<p class="col s6" style="color: red; margin-top:1px;">No máximo 14 digitos<br>', digits:'<p class="col s6" style="color: red; margin-top:1px;">Apenas números<br>'},
		updatePeopleCitie: {required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha uma cidade <br>',},
	},
});
$("#state").change(function(){
	var state = $('#state option:selected').val();
	$.ajax({
		url: "<?php echo site_url('/CityStateController/searchLocalidade/') ?>",
		type: "POST",
		dataType: "html",
		data:{
			state : state
		},
		success: function(data){
			$("#localidade").append().html(data);
			console.log(data);
		},
		error: function(data){
			console.log(data);
		}
	});
});
var validateCpfCnpj = "<?php echo $dados_pessoa[0]->cpf_cnpj; ?>";
$("input[name=updatePeopleCpf]").keyup(function(e){
	e.preventDefault();
	if($(this).val() == validateCpfCnpj){
		$("#sendPeople").attr("disabled", false);
		$("input[name=updatePeopleCpf]").css("border-bottom", "1px solid green");
	}else{
		$.ajax({
			url: "<?php echo site_url('/PeopleController/checkCPF')?>",
			type: "POST",
			data: $("#update-form").serialize(),
			success: function(data){
				if(data == "1"){
					$("input[name=updatePeopleCpf]").css("border-bottom", "1px solid green");
					$("#sendPeople").attr("disabled", false);
					return true;
				}else{
					Materialize.toast("Este CPF já está sendo usado.",2000);
					$("input[name=updatePeopleCpf]").css("border-bottom", "1px solid red");
					$("#sendPeople").attr("disabled", true);
					return false;
				}
			},
			error: function(data){
				console.log(data);
				Materialize.toast("Ocorreu algum erro", 4000);
			}
		});
	}
});
$("input[name=updatePeopleCnpj]").keyup(function(e){
	e.preventDefault();
	if($(this).val() == validateCpfCnpj){
		$("#sendPeople").attr("disabled", false);
		$("input[name=updatePeopleCnpj]").css("border-bottom", "1px solid green");
	}else{
		$.ajax({
			url: "<?php echo site_url('/PeopleController/checkCPF')?>",
			type: "POST",
			data: $("#update-form").serialize(),
			success: function(data){
				if(data == "1"){
					$("input[name=updatePeopleCnpj]").css("border-bottom", "1px solid green");
					$("#sendPeople").attr("disabled", false);
					return true;
				}else{
					Materialize.toast("Este CNPJ já está sendo usado.",2000);
					$("input[name=updatePeopleCnpj]").css("border-bottom", "1px solid red");
					$("#sendPeople").attr("disabled", true);
					return false;
				}
			},
			error: function(data){
				console.log(data);
				Materialize.toast("Ocorreu algum erro", 4000);
			}
		});
	}
});
});
//Procura Cidade atraves do estado
var state = $('#state option:selected').val();
$.ajax({
	url: "<?php echo site_url('PeopleController/alterCitie/'.$id)?>",
	type: "POST",
	dataType: "html",
	data:{
		state : state
	},
	success: function(data){
		$("#localidade").append().html(data);
		console.log(data);
	},
	error: function(data){
		console.log(data);
	}
});
});
</script>
