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
					    <label>RG *</label>
						    <input type="text" class="rg" value="<?php echo $dados_pessoa[0]->documment; ?>" name="updatePeopleRg">
						    
					    </div>
					    <div class="documentJuridic">
					    <label>Inscrição Estadual *</label>
						    <input type="text" class="inscEstadual" value="<?php echo $dados_pessoa[0]->documment; ?>" name="updatePeopleInsc">
						    
					    </div>
					</div>
					<div class="col s12">
					<label>Endereço *</label>
						<input type="text" name="updatePeopleAdress" value="<?php echo $dados_pessoa[0]->adress; ?>" required="required">
						
					</div>
					<div class="col s6">
					<label>Numero *</label>
						<input type="text" name="updatePeopleNumber" value="<?php echo $dados_pessoa[0]->number; ?>" required="required">
						
					</div>
					<div class="col s6">
					<label>Bairro *</label>
						<input type="text" name="updatePeopleNeighborhood" value="<?php echo $dados_pessoa[0]->neighborhood; ?>" required="required">
						
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
				<label>CEP *</label>
					<input type="text" class="cep" value="<?php echo $dados_pessoa[0]->cep; ?>" name="updatePeopleCep" required="required">
		            
				</div>
				<div class="col s6">
					<label>Data de Nascimento *</label>
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
				    <button type="submit" class="waves-green btn green">Salvar 
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

$('#update-form').validate({  
 
            rules: {  
                updatePeopleName: { required: true, minlength: 5,isString: true},  
                updatePeopleAdress: { required: true,}, 
                updatePeopleNeighborhood:{ required:true,},
                updatePeopleDateBirth: { required: true,maxlength: 10}, 
                updatePeopleCep: { required: true,},
                updatePeopleNumber: { required: true, digits:true,},  
                state: {required: true,},
                updatePeopleCnpj: { required: true,},  
                updatePeopleInsc: { required: true,}, 
                updatePeopleCpf: { required: true,},  
                updatePeopleRg: { required: true,},
                updatePeopleCitie: {required: true,},
            },  
            messages: {  
                updatePeopleName: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Nome<br>', minlength: '<p class="col s6" style="color: red; margin-top:1px;">No mínimo 5 letras <br>'}, 
                updatePeopleAdress: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Endereco <br>'},
                updatePeopleNeighborhood: {required:'<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Bairro<br>'},
                updatePeopleDateBirth:  { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha a Data de Nascimento<br>',maxlength:'<p style="color: red; margin-top:1px;">Informe uma data válida<br>'}, 
                updatePeopleCep: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CEP<br>',}, 
                updatePeopleNumber:  { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Numero <br>', digits:'<p class="col s6" style="color: red; margin-top:1px;">Apenas numeros <br>'}, 
                state: {required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha um estado <br>',},
                updatePeopleCnpj: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CNPJ <br>'}, 
                updatePeopleInsc: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo Inscrição Estadual <br>'},
                updatePeopleCpf: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo CPF<br>',}, 
                updatePeopleRg: { required: '<p class="col s6" style="color: red; margin-top:1px;">Preencha o campo RG<br>',},
                updatePeopleCitie: {required: '<p class="col s6" style="color: red; margin-top:1px;">Escolha uma cidade <br>',},
 
            },

});
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
});
</script>