	<div class="container">
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
							    <label>RG *</label>
								    <input type="text" class="rg" name="peopleRg">
							    </div>
							    <div class="documentJuridic">
							        <label>Inscrição Estadual *</label>
								    <input type="text" class="inscEstadual" name="peopleInscricao">
							    </div>
							</div>
							<div class="col s12">
							<label for="adress">Endereço *</label>
								<input type="text" id="adress" name="peopleAdress">
																
							</div>
							<div class="col s6">
							<label for="number">Numero *</label>
								<input type="text" id="number" name="peopleNumber" value="">
																
							</div>
							<div class="col s6">
							<label>Bairro *</label>
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
							    <label>CEP *</label>
								<input type="text" class="cep" name="peopleCep">

							</div>
							<div class="col s6">
							    <label for="dataNasc">Data de Nascimento *</label>
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
							<button type="submit" class="waves-green btn green">Salvar 
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
$('.inscEstadual').mask("9999-99999",{placeholder:" "});
$(".phone").mask("(99) 9999-9999",{placeholder:" "});
$(".rg").mask("99.999.999-99",{placeholder:" "});
$(".cep").mask("99999/999",{placeholder:" "}); 
//Validações
jQuery.validator.addMethod("isString", function(value, element) {
                var regExp = /[0-9]/;
                if(regExp.test(value)) return false;
                else return true
            }, "Por favor insira somente caracteres alfabeticos<br>");

$('#formPeople').validate({  
 
            rules: {  
                peopleName: { required: true, minlength: 5,isString: true},  
                peopleAdress: { required: true,}, 
                peopleNeighborhood:{ required:true,},
                peopleDateBirth: { required: true, maxlength: 10}, 
                peopleCep: { required: true,},
                peopleNumber: { required: true, digits:true,},  
                state: {required: true,},
                peopleCnpj: { required: true,},  
                peopleInscricao: { required: true,}, 
                peopleCpf: { required: true,},  
                peopleRg: { required: true,},
                peopleCitie: {required: true,},
            },  
            messages: {  
                peopleName: { required: '<span class="col s6" style="color: red; margin-top:1px;">Preencha o campo Nome<br>', minlength: '<p class="col s6" style="color: red; margin-top:1px;">No mínimo 5 letras <br>'}, 
                peopleAdress: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Endereco <br>'},
                peopleNeighborhood: {required:'<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Bairro<br>'},
                peopleDateBirth: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha a Data de Nascimento<br>',maxlength:'<p style="color: red; margin-top:1px;">Informe uma data válida<br>'}, 
                peopleCep: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CEP<br>',}, 
                peopleNumber: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Numero <br>', digits:'<p class="col s6" style="color: red; margin-top:1px;">Apenas numeros <br>'}, 
                state: {required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha um estado <br>',},
                peopleCnpj: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CNPJ <br>'}, 
                peopleInscricao: { required: '<p class="col s8" style="color: red; margin-top:1px;">Preencha o campo Inscrição Estadual <br>'},
                peopleCpf: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CPF<br>',},  
                peopleRg: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo RG<br>',},
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