<div class="container">
     <a href="<?= base_url('internal') ?>" >< Voltar para internos</a>
        <div class="row card-panel">
            <h4 class="center" ">Cadastro de Internos</h4>
                <form class="col s12" action="" id="formInternal" method="POST">
                    <div class="col s12">
                        <label for="nome">Nome *</label>
                            <input type="text" name="nome" id="nome">
                    </div>
					<div class="col s6">
						<label>CPF *</label>
						<input type="text" class="cpf" id="cpf" name="peopleCpf">
					</div>
					<div class="col s6">
						<label>RG </label>
						<input type="text" class="rg" name="peopleRg">
					</div>
					<div class="col s12">
						<label for="adress">Endereço </label>
						<input type="text" id="adress" name="peopleAdress">

					</div>
					<div class="col s6">
						<label for="number">Número </label>
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
						<label for="dataEntrada">Data de Entrada </label>
						<input type="date" id="dataEntrada" name="peopleDateBirth" class="datepicker">
					</div>

					<div class="col s6 center margin-alter">
						<button type="submit" id="" class="waves-green btn green">Adicionar Responsavel 
							<i class="material-icons right">add</i>
						</button>
					</div>

					 <div class="col s12">
					    <label for="comments">Observações</label>
                        <textarea id="comments" class="materialize-textarea"></textarea>
                    </div>
                    <div class="col s6" align="left">
						<label style="color:black;">* campos obrigatórios</label>
					</div>
					<div class="col s6" align="right">
						<button type="submit" id="sendInternal" class="waves-green btn green">Salvar 
							<i class="material-icons right">send</i>
						</button>
					</div>
                </form>
        </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

$('.cpf').mask("999.999.999-99",{placeholder:" "});
$(".phone").mask("(99) 9999-9999",{placeholder:" "});
$(".cep").mask("99999/999",{placeholder:" "}); 
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
</script>