<script type="text/javascript"  src="<?= base_url('assets/js/jquery-2.2.2.js')?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $("#openIt").click(function(){
    $('#modal1').openModal();
  });
   $("#typeSelect").change(function(){
    if($(this).val("fisica")){
      alert("OI");
      $('input[name=cpf]').attr('type', 'text');
      $("#cpf").text("CPF");
      $('input[name=cnpj]').attr('type', 'hidden');
      $("#cnpj").text("");
    }else if($(this).val("juridica")){
      $('input[name=cnpj]').attr('type', 'text');
      $("#cnpj").text("CNPJ");
      $('input[name=cpf]').attr('type', 'hidden');
      $("#cpf").text("");
    }

  });
   $("#openIt2").click(function(){
    $('#modal2').openModal();
  });
   $(".openIt3").click(function(){
    $('#modal3').openModal();
  });

   $('input#input_text, textarea#textarea1').characterCounter();
 });
</script>



<div>
	<!-- MODAL 1 -->
	<a class="modal-trigger waves-effect waves-light btn" id="openIt" href="#modal1">+CLASSIFICAÇÃO</a>
	<!-- MODAL 2 -->
	<a class="modal-trigger waves-effect waves-light btn" id="openIt2" href="#modal2">+CADASTRO DE PESSOA</a>

	<!-- Modal Estrutura -->
  <div id="modal1" class="modal modal-fixed-footer">
   <div class="modal-content">
    <h4>Cadastrar classificação</h4>
    <div>
     <form action="create-classification" method="POST">
      <ul>
       <li>
        <label>Nome: </label>
        <input type="text" name="classificationName">
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
      <button class="btn waves-effect waves-light" type="submit" name="action">Enviar</button>	
    </li>
  </ul>
</form>
</div>
</div>
<div class="modal-footer">
  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
</div>
</div>

<!-- Modal Altera pessoa-->
<div id="modal3" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h4>Alterar classificação</h4>
		<form action="update-classification" method="POST">
			<ul>
				<li>
					<label>Nome: </label>
					<input type="text" value="" name="classificationName">
				</li>
				<li>
					<label>Tipo de classificação: </label>
				</li>
				<li>
					<input name="updateClasType" type="radio"  value="e" id="updateClasType1" checked/>
					<label for="updateClasType1" >Entrada</label>

					<input name="updateClasType" type="radio"  value="s" id="updateClasType2" />
					<label for="updateClasType2" >Saida</label>
				</li>
				<hr>
				<li>
					<button class="btn waves-effect waves-light" type="submit">Enviar</button>
				</li>
			</ul>
		</form>
	</div>
</div>




<!-- Modal Estrutura -->
<div id="modal2" class="modal modal-fixed-footer">
  <div class="modal-content">
   <h4>Cadastro de pessoa</h4>
   <div>
    <ul>
      <form action="create-people" id="formPeople" method="POST">
        <label>Browser Select</label>
        <select id="typeSelect" class="browser-default">
          <option value="" disabled selected>Choose your option</option>
          <option value="fisica">Pessoa Física</option>
          <option value="juridica">Pessoa Jurídica</option>
        </select> 
        <li>
         <label>Nome: </label>
         <input type="text" name="peopleName">
       </li>
       <li>
        <label id="cpf">CPF</label>
        <input type="text" name="cpf">
      </li>
      <li>
        <label id="cnpj"> </label>
        <input type="hidden" name="cnpj">
      </li>
      <li>
       <label>RG: </label>
       <input type="text" name="peopleRg">
     </li>
     <li>
       <label>Inscrição Estadual: </label>
       <input type="text" name="peopleInscricaoEstadual">
     </li>
     <li>
       <label>Endereço: </label>
       <input type="text" name="peopleAdress">
     </li>
     <li>
       <label>Numero: </label>
       <input type="text" name="peopleNumber">
     </li>
     <li>
       <label>Bairro: </label>
       <input type="text" name="peopleNeighborhood">
     </li>
     <li>
       <label>City: </label>
       <input type="text" name="peopleCity">
     </li>
     <li>
       <label>Estado: </label>
       <input type="text" name="peopleState">
     </li>
     <li>
       <label>CEP: </label>
       <input type="text" name="peopleCep">
     </li>
     <li>
      <label>Data de Nascimento: </label>
      <input type="date" name="peopleDateBirth"class="datepicker">
    </li>
    <li>
     <label>Telefone: </label>
     <input type="text" name="peoplePhone1">
   </li>
   <li>
     <label>Telefone 2: </label>
     <input type="text" name="peoplePhone2">
   </li>
   <button class="btn waves-effect waves-light" type="submit" name="action">Enviar</button>
 </form>
</div>

</div>
<div class="modal-footer">
 <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
</div>
</div>
</div>

<!-- MOSTRAR DADOS DO DB CLASSIFICAÇÃO -->
<div class="container">
	<h3 align="center">Classificações</h3>
	<table class="striped">
		<thead>
			<td><strong>Nome: </strong></td>
			<td><strong>Tipo de classificação: </strong></td>
		</thead>
		<tbody>
			<?php foreach ($classifications as $classification) :?>
				<tr>
					<td><?= $classification['name'] ?></td>
					<td><?= $classification['classification_type'] ?></td>
					<td>
						<a class="openIt3" href="#modal3">
							<button class="modal-trigger waves-effect waves-light btn" >Alterar</button></a>

              <a href="delete-classification/<?= $classification['id'] ?>">
               <button id="<?= $classification['id'] ?>" class="btn waves-effect waves-light">Deletar</button></a>
             </td>
           </tr>
         <?php endforeach ?>
       </tbody>
     </table>
   </div>

   <!-- MOSTRAR DADOS DO DB PESSOAS -->
   <div>
     <h3 align="center">Pessoas</h3>
     <table class="striped">
       <thead>
        <td><strong>Nome </strong></td>
        <td><strong>CPF </strong></td>
        <td><strong>Nome </strong></td>
        <td><strong>CNPJ </strong></td>
        <td><strong>RG </strong></td>
        <td><strong>Inscrição Estadual </strong></td>
      </thead>
      <tbody>
        <?php foreach ($peoples as $people) :?>
          <tr>
           <td><?= $people['name'] ?></td>
           <td><?= $people['cpf'] ?></td>
           <td><?= $people['cnpj'] ?></td>
           <td><?= $people['rg'] ?></td>
           <td><?= $people['inscricao_estadual'] ?></td>
           <td><?= $people['adress'] ?></td>
           <td><?= $people['number'] ?></td>
           <td><?= $people['neighborhood'] ?></td>
           <td><?= $people['city'] ?></td>
           <td><?= $people['state'] ?></td>
           <td><?= $people['cep'] ?></td>
           <td><?= $people['date_birth'] ?></td>
           <td><?= $people['phone1'] ?></td>
           <td><?= $people['phone2'] ?></td>
           <td>
            <a href="delete-people/<?= $people['id'] ?>">
              <button class="btn waves-effect waves-light" >Deletar</button></a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>