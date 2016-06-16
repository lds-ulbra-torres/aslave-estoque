	<div class="container">
		<a href="<?= base_url('people') ?>" >< Voltar para pessoas</a>
		<div div class="row card-panel">
			<h4 align="center">Cadastro de pessoa</h4>


			<form class="col s12" action="create-people" id="formPeople" method="POST">
				<div class="col s12">
					<input class="with-gap" type="radio" value="1" name="peopleClassification" id="fisica">
					<label for="fisica">Pessoa Física</label>
				</div>
				<div class="col s12">
					<input class="with-gap" type="radio" value="2" name="peopleClassification" id="juridica">
					<label for="juridica">Pessoa Jurídica</label>
				</div>
				<div class="peopleRegistration">                        
					<div class="col s12">
						<label for="nome">Nome *</label>
						<input type="text" id="nome" name="peopleName">
					</div>
					<div class="col s6">
						<div class="documentFisic">
							<label>CPF *</label>
							<input type="text" class="cpf" id="cpf" name="peopleCpf">
						</div>
						<div class="documentJuridic">
							<label>CNPJ *</label>	
							<input type="text" class="cnpj" id="cnpj" name="peopleCnpj">							    
						</div>
					</div>
					<div class="col s6">
						<div class="documentFisic">
							<label>RG </label>
							<input type="text" class="rg" name="peopleRg">
						</div>
						<div class="documentJuridic">
							<label>Inscrição Estadual </label>
							<input type="text" class="inscEstadual" name="peopleInscricao">
						</div>
					</div>
					<div class="col s12">
						<label for="adress">Endereço </label>
						<input type="text" id="adress" name="peopleAdress">

					</div>
					<div class="col s6">
						<label for="number">Nmero </label>
						<input type="text" id="number" name="peopleNumber" value="">

					</div>
					<div class="col s6">
						<label>Bairro </label>
						<input type="text" name="peopleNeighborhood">

					</div>
					<div class="col s6">
						<label>Estado *</label>
						<select class="browser-default" name="state" id="state">
							<option disabled selected> Escolha o Estado</option>
							<?php 
							foreach($states as $fila)
							{
								?>
								<option value="<?=$fila -> id_states ?>"><?=$fila -> name . " / (" . $fila -> uf . ")"?></option>
								<?php
							}
							?>		
						</select>
					</div>
					<div class="col s6">
						<label>Cidade *</label>
						<select class="browser-default" name="peopleCitie" id="localidade">
							<option disabled selected> -- </option>    		                        
						</select>
					</div>
					<div class="col s6">
						<label>CEP </label>
						<input type="text" class="cep" name="peopleCep">

					</div>
					<div class="col s6">
						<label for="dataNasc">Data de Nascimento </label>
						<input type="date" id="dataNasc" name="peopleDateBirth" class="datepicker">
					</div>
					<div class="col s6">
						<label>Telefone</label>
						<input type="text" class="phone" name="peoplePhone1" value="">

					</div>
					<div class="col s6">
						<label>Telefone 2</label>
						<input type="text" class="phone" name="peoplePhone2">

					</div>
					<div class="col s6" align="left">
						<label style="color:black;">* campos obrigatórios</label>
					</div>
					<div class="col s6" align="right">
						<button type="submit" id="sendPeople" class="waves-green btn green">Salvar 
							<i class="material-icons right">send</i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
//Mascaras
$('.cpf').mask("999.999.999-99",{placeholder:" "});
$(".cnpj").mask("99.999.999/9999-99",{placeholder:" "});
$(".phone").mask("(99) 9999-9999",{placeholder:" "});
$(".cep").mask("99999/999",{placeholder:" "}); 
//Validações
jQuery.validator.addMethod("isString", function(value, element) {
	var regExp = /[0-9]/;
	if(regExp.test(value)) return false;
	else return true
}, "<p class='col s6' style='color: red; margin-top:1px;'>Por favor insira somente letras</p><br>");

$('#formPeople').validate({  

	rules: {  
		peopleName: { required: true, minlength: 5,isString: true},  
		peopleDateBirth: {maxlength: 10}, 
		peopleNumber: {digits:true,},  
		state: {required: true,},
		peopleCnpj: { required: true,},  
		peopleCpf: { required: true,},  
		peopleRg:{maxlength: 14, digits:true},
		peopleCitie: {required: true,},
	},  
	messages: {  
		peopleName: { required: '<span class="col s6" style="color: red; margin-top:1px;">Preencha o campo Nome<br>', minlength: '<p class="col s6" style="color: red; margin-top:1px;">No mínimo 5 letras <br>'}, 
		eopleDateBirth: {maxlength:'<p style="color: red; margin-top:1px;">Informe uma data válida<br>'}, 
		peopleNumber: {digits:'<p class="col s6" style="color: red; margin-top:1px;">Apenas numeros <br>'}, 
		state: {required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha um estado <br>',},
		peopleCnpj: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CNPJ <br>'}, 
		peopleCpf: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CPF<br>',},  
		peopleRg:{maxlength:'<p class="col s6" style="color: red; margin-top:1px;">No máximo 14 digitos<br>' ,digits:'<p class="col s6" style="color: red; margin-top:1px;">Apenas números<br>' },
		peopleCitie :{required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha uma cidade <br>',},
	},


});
//Procura cidade atraves do estado
$("#state").change(function(){
	var state = $('#state option:selected').val();
	$.ajax({
		url: "<?php echo site_url('/PeopleController/searchLocalidade/') ?>",
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
//06/06/2016, Caciano Verifica se o CPF já existe
$("input[name=peopleCpf]").keyup(function(e){
	e.preventDefault();
	$.ajax({
		url: "<?php echo site_url('/PeopleController/checkCPF')?>",
		type: "POST",
		data: $("#formPeople").serialize(),
		success: function(data){
			if(data == "1"){
				$("input[name=peopleCpf]").css("border-bottom", "1px solid green");
				$("#sendPeople").attr("disabled", false);
				return true;
			}else{
				Materialize.toast("Este CPF já está sendo usado.",2000);
				$("input[name=peopleCpf]").css("border-bottom", "1px solid red");
				$("#sendPeople").attr("disabled", true);
				return false;
			}
		},	
		error: function(data){
			console.log(data);
			Materialize.toast("Ocorreu algum erro", 4000);
		}
	});

});
// 06/06/2016, Caciano Verifica se o CNPJ já existe
$("input[name=peopleCnpj]").keyup(function(e){
	e.preventDefault();
	$.ajax({
		url: "<?php echo site_url('/PeopleController/checkCPF')?>",
		type: "POST",
		data: $("#formPeople").serialize(),
		success: function(data){
			if(data == "1"){
				$("input[name=peopleCnpj]").css("border-bottom", "1px solid green");
				$("#sendPeople").attr("disabled", false);
				return true;
			}else{
				Materialize.toast("Este CNPJ já está sendo usado.",2000);
				$("input[name=peopleCnpj]").css("border-bottom", "1px solid red");
				$("#sendPeople").attr("disabled", true);
				return false;
			}
		},	
		error: function(data){
			console.log(data);
			Materialize.toast("Ocorreu algum erro", 4000);
		}
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
			$(":text").each(function () {
				$(this).val("");
			});
			documentJuridic.hide();
			documentFisic.show();
		}
		else if(id == 'juridica') {
			$(":text").each(function () {
				$(this).val("");
			});
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