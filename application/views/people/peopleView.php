<script type="text/javascript"  src="<?= base_url('assets/js/jquery-2.2.2.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.maskedinput.js'); ?>" type="text/javascript"></script>
<meta charset="UTF-8">
<script type="text/javascript">
$(document).ready(function(){
//Mascaras
  $('#cpf').mask("999.999.999-99",{placeholder:" "});
  $("#cnpj").mask("99.999.999/9999-99",{placeholder:" "});
  $('#inscEstadual').mask("9999-99999",{placeholder:" "});
  $(".phone").mask("(99) 9999-9999",{placeholder:" "});
  $("#rg").mask("99.999.999-99",{placeholder:" "});
  $("#cep").mask("99999/999",{placeholder:" "});
  $("#date").mask("99/99/9999",{placeholder:" "});

  $("#openIt2").click(function(){
    $('#modal2').openModal();
  });
  $('#state').change(function(){
    var teste = document.getElementById('state').value;
    var teste2 = document.getElementById('city').value;

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
   <!-- MODAL 2 -->
   <a class="modal-trigger waves-effect waves-light btn" id="openIt2" href="#modal2">+CADASTRO DE PESSOA</a>


   <!-- Modal Estrutura -->
   <div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content">
     <h4>Cadastro de pessoa</h4>
     <div>
       <form action="create-people" id="formPeople" method="POST">
         <p>
           <input type="radio" name="peopleClassification" id="fisica" required="required"> 
           <label for="fisica">Pessoa Física</label>
         </p>
         <p>
           <input type="radio" name="peopleClassification" id="juridica" required="required"> 
           <label for="juridica">Pessoa Jurídica</label>
         </p>
         <ul class="peopleRegistration">

           <li>
             <label>Nome: </label>
             <input type="text" name="peopleName" required="required">
           </li>
           <li class="documentFisic">
            <label>CPF</label>
            <input type="text" id="cpf" name="peopleCpf" required="required">
          </li>
          <li class="documentJuridic">
            <label>CNPJ:</label>
            <input type="text" id="cnpj" name="peopleCnpj" required="required">
          </li>
          <li class="documentFisic">
           <label>RG: </label>
           <input type="text" id="rg" name="peopleRg" required="required">
         </li>
         <li class="documentJuridic">
           <label>Inscrição Estadual: </label>
           <input type="text" id="inscEstadual" name="peopleInscricaoEstadual" required="required">
         </li>
         <li>
           <label>Endereço: </label>
           <input type="text" name="peopleAdress" required="required">
         </li>
         <li>
           <label>Numero: </label>
           <input type="text" name="peopleNumber" required="required">
         </li>
         <li>
           <label>Bairro: </label>
           <input type="text" name="peopleNeighborhood" required="required">
         </li>
         <li>
            <label>Estado: </label>
            <select class="browser-default" id="state" name="peopleState">
              <?php foreach($states as $state) :?>
                <option value="<?= $state['id'] ?>"><?= $state['nome']?> - <?= $state['uf'] ?></option>
              <?php endforeach ?>
            </select>
         </li>
          <li>
           <label>City: </label>
              <select class="browser-default" id="city" name="peopleCity">
                <?php foreach ($cities as $city): ?>
                  <option value="<?= $city['id'] ?>"><?= $city['nome'] ?></option>
                <?php endforeach ?>
              </select>
         </li>
         <li>
           <label>CEP: </label>
           <input type="text" id="cep" name="peopleCep" required="required">
         </li>
         <li>
          <label>Data de Nascimento: </label>
          <input type="date" id="date" name="peopleDateBirth"class="datepicker" required="required">
        </li>
        <li>
         <label>Telefone: </label>
         <input type="text" class="phone" name="peoplePhone1" required="required">
       </li>
       <li>
         <label>Telefone 2: </label>
         <input type="text" class="phone" name="peoplePhone2" required="required">
       </li>
       <button class="btn waves-effect waves-light" type="submit" name="action">Enviar</button>
     </ul>
   </form>
 </div>

</div>
<div class="modal-footer">
 <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Fechar</a>
</div>
</div>
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