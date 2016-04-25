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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function(){
    $(".button-collapse").sideNav();
  });
</script>
</head>
<body>


  <div>
    <div class="col l12">

      <ul id="nav-mobile" class="side-nav">

        <li class=""><a href="<?= base_url() ?>"  class="blue-text">HOME</a></li>
        <li class=""><a href="stock" class="blue-text">ESTOQUE</a></li>
        <li class=""><a href="<?= base_url('financial') ?>" class="blue-text">FINANCEIRO</a></li>

      </ul>



      <div class="hide-on-large-only center nav-wrapper"> 
        <nav class="color" role="navigation">
          <label class="white-text labelLogo fontUt"><strong>PROJETO SLAVE</strong></label>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </nav>
      </div>

      <div class="col l12 center hide-on-med-and-down">



        <ul class="ulMenu hide-on-small-only color tamanhoMenu ">

          <label class="white-text labelLogo left fontUt"  style="margin-left: 25px;"><strong>PROJETO SLAVE</strong></label>
          <a href="<?= base_url() ?>" class="aColor"><li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">HOME</p></li></a>  
          <a href="stock" class="aColor"><li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">ESTOQUE</p></li></a>
          <a href="financial" class="aColor"><li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">FINANCEIRO</p></li></a>


        </ul>

      </div>




    </div>
  </div>


  <div id="contents">
  	<?php echo $contents ?>
  </div>

</body>
</html>