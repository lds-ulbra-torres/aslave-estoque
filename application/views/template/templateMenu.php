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
</head>
<body>


  <div>
    <div class="col l12">

      <ul id="nav-mobile" class="side-nav">

        <li class=""><a href="<?= base_url() ?>"  class="blue-text">HOME</a></li>
        <li class=""><a href="stock" class="blue-text">ESTOQUE</a></li>
        <li>
        <a class="aColor dropdown-button blue-text" data-activates="financial2_buttons" href="#">FINANCEIRO
          </a>
            <ul id="financial2_buttons" class="dropdown-content">
                <li><a href="<?= base_url('classification'); ?>">Classificações</a></li>
                <li><a href="<?= base_url('people'); ?>">Pessoas</a></li>
                <li><a href="<?= base_url('financial-movimentation'); ?>">Movimentações</a></li>
                <li class="divider"></li>
                <li><a href="<?= base_url('financial') ?>">Visão Geral</a></li>
            </ul>
        </li>
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

          <a class="aColor dropdown-button" data-activates="financial_buttons" href="#">
            <li class="liclass">
              <p class="fontUt strMenu " style="vertical-align: middle;">FINANCEIRO
              <i class="material-icons right">arrow_drop_down</i></p>
            </li>
          </a>
            <ul id="financial_buttons" class="dropdown-content">
                <li><a href="<?= base_url('classification'); ?>">Classificações</a></li>
                <li><a href="<?= base_url('people'); ?>">Pessoas</a></li>
                <li><a href="<?= base_url('financial-movimentation'); ?>">Movimentações</a></li>
                <li class="divider"></li>
                <li><a href="<?= base_url('financial') ?>">Visão Geral</a></li>
            </ul>


        </ul>

      </div>




    </div>
  </div>


  <div id="contents">
  	<?php echo $contents ?>
  </div>

</body>
<script type="text/javascript" src="<?= base_url('assets/js/materialize.js')?>"></script>
<script>
  $(document).ready(function(){
    $(".button-collapse").sideNav();
  });
</script>
</html>