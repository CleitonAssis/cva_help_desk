<?php
  require_once 'valida_acesso.php';
  //PERMISSÃO POR PERFIL
  if ($_SESSION['usuarioNiveisAcessoId'] != "2") {
    $_SESSION['loginError4'] = "Você não tem acesso a este perfil !";
    header('Location: ../index.php');
    die();
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" type="text/css" href="bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <title>CVA Help Desk</title>
  </head>

  <body>

    <!-- início do preloader -->
    <div id="preloader">
      <div class="inner">
        <img style="width: 10rem;" src="../img/preloader.svg">
        <h3 class="text-center fst-italic text-muted"><strong>Carregando ...</strong></h3>
        </div>
      </div>
    </div>
    <!-- fim do preloader -->

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand font-weight-bold" href="#"><img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""> CVA Help Desk</a>

      <div class="dropdown">
        <button class="btn btn-outline-info" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
            /*--TRAZ O NOME DO USUÁRIO DA SESSÃO*/
            $user_name = $_SESSION['usuarioNome'];
            echo "Seja bem vindo(a) $user_name !";
          ?>
        </button>
        <div class="dropdown-menu bg-dark">
          <!--<a class="dropdown-item text-info font-weight-bold" href="#">Ação</a>
          <a class="dropdown-item text-info font-weight-bold" href="#">Outra ação</a>-->
          <a class="dropdown-item text-info text-center font-weight-bold" href="logoff.php">Sair</a>
        </div>
      </div>
      <!--<ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="logoff.php">Sair</a></li>
      </ul>-->
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-home">
          <div class="card">
            <div class="card-header text-center font-weight-bold"><h3>Menu</h3></div>
            <div class="card-body">
              <div class="row">
                <div class="col-6 d-flex justify-content-center">
                  <a style="text-decoration: none;" href="abrir_chamado.php?voltar=tecnico.php"><img src="../img/formulario_abrir_chamado.png" width="70" height="70"><b style="color: black;">Abrir Chamado</b></a>
                </div>
                <div class="col-6 d-flex justify-content-center">
                  <a style="text-decoration: none;" href="consultar_chamado.php?voltar=tecnico.php"><img src="../img/formulario_consultar_chamado.png" width="70" height="70"><b style="color: black;">Gestão de Chamados</b></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/jquery_validation/jquery.validate.min.js"></script>
    <script src="js/jquery_validation/additional-methods.min.js"></script>
    <script src="js/jquery_validation/localization/messages_pt_BR.js"></script>
    <script src="js/popper_tippy/popper.min.js"></script>
    <script src="js/popper_tippy/tippy-bundle.umd.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Preloader-->
    <script>
      $(window).on('load', function () {
        $('#preloader .inner').fadeOut();
        $('#preloader').delay(400).fadeOut('slow'); 
        $('body').delay(400).css({'overflow': 'visible'});
      })
    </script>
  </body>
</html>
