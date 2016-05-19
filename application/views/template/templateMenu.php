<!doctype html>
<html>
<head>
  <title>ASLAVE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="<?= base_url ('assets/css/materialize.css');?>">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/templateMenu.css'); ?>">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.2.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/jquery.maskedinput.js');?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/jquery.validate.js'); ?>"></script>
  <style type="text/css">
    .bodyModal{
      margin: 0 auto; 
      max-width: 100% !important;
    }
  </style>

</head>
<body>

  <div>
    <div class="col l12">

      <ul id="nav-mobile" class="side-nav">

        <li class="">
          <a href="<?= base_url() ?>" class="blue-text">HOME</a>
        </li>
        <li class="">
          <a class="dropdown-button blue-text" data-activates="nav_estoque" href="#">ESTOQUE</a>
              <ul id="nav_estoque" class="dropdown-content">

                  <li><a href="<?= base_url('people'); ?>">Pessoas</a></li>
                  <li class="divider"></li>
                  <li><a href="<?= base_url('stock/products'); ?>">Produtos</a></li>
                  <li><a href="<?= base_url('stock/groups'); ?>">Categorias</a></li>
                  <li class="divider"></li>
                  <li><a href="<?= base_url('stock/entries'); ?>">Entradas</a></li>
                  <li><a href="<?= base_url('stock/outputs'); ?>">Saídas</a></li>         
              </ul>
        </li>
        <li>
        <a class="dropdown-button blue-text" data-activates="nav_financial" href="#">FINANCEIRO</a>
            <ul id="nav_financial" class="dropdown-content">
            	<li><a href="<?= base_url('people'); ?>">Pessoas</a></li>
            	<li class="divider"></li>
                <li><a href="<?= base_url('classification'); ?>">Classificações</a></li>                
                <li><a href="<?= base_url('financial-movimentation'); ?>">Lançamentos</a></li>                
            </ul>
        </li>
        <li>
          <a class="blue-text"  href="<?= base_url('UserController/logout'); ?>">SAIR</a>
        </li>
        
      </ul>



      <div class="hide-on-large-only center nav-wrapper"> 
        <nav class="color" role="navigation">
          <label class="white-text labelLogo fontUt"><strong>PROJETO ASLAVE</strong></label>
          <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </nav>
      </div>

        <div class="col l12 center hide-on-med-and-down">
        <ul class="ulMenu hide-on-small-only color tamanhoMenu ">
          <label class="white-text labelLogo left fontUt"  style="margin-left: 25px;"><strong>ASLAVE</strong></label>
            <a href="<?= base_url() ?>" class="aColor">
              <li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">HOME</p>
              </li>
            </a>  
          <a class="aColor dropdown-button" data-activates="estoque_buttons" href="#">
            <li class="liclass">
              <p class="fontUt strMenu " style="vertical-align: middle;">ESTOQUE
                  <i class="material-icons right">arrow_drop_down</i>
              </p>
            </li>
          </a>
          <a class="aColor dropdown-button" data-activates="financial_buttons" href="#">
            <li class="liclass">
              <p class="fontUt strMenu " style="vertical-align: middle;">FINANCEIRO
              <i class="material-icons right">arrow_drop_down</i></p>
            </li>
          </a>
          <a class="aColor"  href="<?= base_url('UserController/logout'); ?>">
            <li class="liclass">
              <p class="fontUt strMenu " style="vertical-align: middle;">SAIR
            </li>
          </a>
            <ul id="financial_buttons" class="dropdown-content">
            	<li>
                   <a href="<?= base_url('people'); ?>">Pessoas</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?= base_url('classification'); ?>">Classificações</a>
                </li>
                
                <li>
                   <a href="<?= base_url('financial-movimentation'); ?>">Lançamentos</a>
                </li>
                <!--<li class="divider"></li>
                <li>
                   <a href="<?= base_url('financial') ?>">Visão Geral</a>
                </li>-->
            </ul>
        

        </ul>
        <ul id="estoque_buttons" class="dropdown-content">
        	<li>
                <a href="<?= base_url('people'); ?>">Pessoas</a>
            </li>
             <li class="divider"></li>
            <li>
                <a href="<?= base_url('stock/products'); ?>">Produtos</a>
            </li>
            <li>
               <a href="<?= base_url('stock/groups'); ?>">Categorias</a>
            </li>
            <li class="divider"></li>
            <li>
               <a href="<?= base_url('stock/entries'); ?>">Entradas</a>
            </li>
            <li>
                <a href="<?= base_url('stock/outputs'); ?>">Saídas</a>
            </li>
            <li class="divider"></li>
           
        </ul>
        </div>
      </div>
    </div>
  <div id="contents">
    <?php echo $contents ?>
  </div>

</body>
<script type="text/javascript" src="<?= base_url('assets/js/materialize.js');?>"></script>

<script>
  $(document).ready(function(){
    $(".button-collapse").sideNav();
    $('select').material_select();
  });
</script>
</html>