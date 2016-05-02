<!DOCTYPE html>
<html>
<head>
  <title>Slave</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="<?= base_url ('assets/css/materialize.css')?>">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/templateMenu.css') ?>">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <script type="text/javascript" language="javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script>
  <script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
</head>


<script type="text/javascript">

  $(document).ready(function(){



    $("input[name=search]").keyup(function(){
      if($(this).val() != ''){
        $.ajax({
          url: "<?= site_url('/SearchController/buscar'); ?>",
          type: "POST",
          cache: false,
          data: {name_people: $(this).val()},
          success: function(data){
            $('#finalResult').html("");
            var obj = JSON.parse(data);
            if(obj.length>0){
              try{
                var items=[];   
                $.each(obj, function(i,val){                      
                  items.push($('<tr><td>' + val.name + '<button class="right btn" name ="'+ val.id_people +'" id="batata">SELECIONAR</button></a></td></tr>'));
                }); 
                $('#finalResult').append.apply($('#finalResult'), items);
              }catch(e) {   
                alert('Exception while request..');
              }   
            }else{
              $('#finalResult').html($('<span/>').text("Nenhum nome encontrado"));    
            }   
          },
          error: function(){
            alert("ERRO!");
          }
        });
      }else{
        $('#finalResult').empty();
      }
    });

       
  });
</script>
<body>


  <input type="text" id="teste">

  <!-- Modal Trigger -->
  <a class="waves-effect waves-light  modal-trigger openSearchModal"  href="#SearchModal">
    <nav>
      <div class="nav-wrapper color">
        <form>
          <div class="input-field">
            <input id="search1" type="search" class="white-text" disabled value="<?php  ?>" placeholder="Pesquisar...">
            <label for="search1"><i class="material-icons">search</i></label>
            <i class="material-icons">close</i>
          </div>
        </form>
      </div>
    </nav>
  </a>

  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">


      <nav>
        <div class="nav-wrapper color">
          <div class="input-field">
            <input id="search" name="search" type="search" required placeholder="Pesquisar...">
            <label for="search"><i class="material-icons">search</i></label>
          </div>
        </div>
      </nav>
      <br><br>

      <table class="striped hightlight">
        <thead>
          <tr>
            
          </tr>
        </thead>
        <tr>
          <tbody id="finalResult">

          </tbody>
        </tr>
      </table>

      <div class="modal-footer">
      <a href=" <?php echo base_url('/PeopleController/create') ?>" class=" modal-action "><button class="waves-effect waves-green btn">Adicionar Nova Pessoa</button></a>
      </div>
    </div>  


  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/materialize.js')?>"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".openSearchModal").click(function(){
        $('#SearchModal').openModal();
      })
    });
    
    $(document).on('click','#batata', function(){
        document.getElementById('teste').value=$(this).attr('name');
        $('#SearchModal').closeModal();
    });
  </script>
  </html>