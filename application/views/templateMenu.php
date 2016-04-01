<!DOCTYPE html>
<html>
<head>
  <title>Sistema</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="css/materialize.css">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="css/templateMenu.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>


</head>
<body>


  <div class="">
    <div class="col l12">


      <ul id="nav-mobile" class="side-nav">

        <li class=""><a href="#"  class="blue-text">HOME</a></li>
        <li class=""><a href="#" class="blue-text">CONTROLE</a></li>
        <li class=""><a href="#" class="blue-text">FINANCEIRO</a></li>

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
          <a href="#" class="aColor"><li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">HOME</p></li></a>  
          <a href="#" class="aColor"><li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">CONTROLE</p></li></a>
          <a href="#" class="aColor"><li class="liclass"><p class="fontUt strMenu " style="vertical-align: middle;">FINANCEIRO</p></li></a>


        </ul>

      </div>




    </div>
  </div>








  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script>
    $(".button-collapse").sideNav();

    $(document).ready(function(){
      $('.parallax').parallax();
    });

  </script>
</body>
</html>