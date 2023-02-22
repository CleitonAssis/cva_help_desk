<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once 'includes/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="app/bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app/font-awesome_5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="app/css/login.css">
    <link rel="stylesheet" type="text/css" href="app/css/animate.css">

    <title>CVA Help Desk</title>

    <style type="text/css">
      <?php
      //Background randômico a cada atualização de página
        $bg = array('bg-01.jpg', 'bg-02.jpg');     
        $i = rand(0, count($bg)-1); 
        $selectedBg = "$bg[$i]";
      ?>
      body{
        background: url(img/<?php echo $selectedBg; ?>);
      }
    </style>
  </head>

  <body>

    <!-- início do preloader -->
    <div id="preloader">
      <div class="inner">
        <img style="width: 10rem;" src="img/preloader.svg">
        <h3 class="text-center text-muted"><strong>Carregando ...</strong></h3>
        </div>
      </div>
    </div>
    <!-- fim do preloader -->

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
      <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""><strong> CVA Help Desk V1.0</strong></a>

      <div class="errorConexao" id="errorConexao">
        <?php
          if (isset($_SESSION['loginError5'])) {//NÃO CONSEGUE CONECTAR AO BANCO DE DADOS
            echo "<span class='animate__animated animate__pulse animate__repeat-3 text-center'><i class='fas fa-exclamation-triangle'></i> ";
            echo $_SESSION['loginError5'];
            unset($_SESSION['loginError5']);
            session_destroy();
            echo "</span>";
          }elseif (isset($_SESSION['loginError2'])){//USUÁRIO NÃO FEZ LOGIN
            echo $_SESSION['loginError2'];
            unset($_SESSION['loginError2']);
            session_destroy();
          } elseif (isset($_SESSION['loginError3'])){//SESSÃO EXPIRADA
            echo $_SESSION['loginError3'];
            unset($_SESSION['loginError3']);
            session_destroy();
          } elseif(isset($_SESSION['loginError4'])){//PERMISSÃO DE PERFIL
            echo $_SESSION['loginError4'];
            unset($_SESSION['loginError4']);
            session_destroy();
          }
        ?>
      </div>
      <div class="sucess">
        <h4>
          <?php 
            if(isset($_SESSION['logoff'])){//MSG DE  LOGOFF
              echo $_SESSION['logoff'];
              unset($_SESSION['logoff']);
              session_destroy();
            }
          ?>
        </h4>
      </div>
      
     <!--<div class="dropdown">
        <button class="btn btn-outline-info  font-weight-bold" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mais</button>
        <div class="dropdown-menu bg-dark">
          <a class="dropdown-item text-info font-weight-bold" href="#">Ação</a>
          <a class="dropdown-item text-info font-weight-bold" href="#">Outra ação</a>
          <a class="dropdown-item text-info font-weight-bold" href="#">Algo mais aqui</a>
        </div>
      </div>-->
    </nav>

    <div class="container-fluid">    
      <div class="row">
        <div class="col-md-3 offset-md-0 card-login">
          <!--<center>
            <img class="img-fluid" alt="imagem de login" src="img/atendimento1.jpg" style="width: 20rem" class="d-inline-block align-top" alt="">
          </center>-->

          <h1 class="text-light text-center font-weight-bold">Login</h1>
            
          <form id="form_login" action="includes/valida_login.php" method="POST" novalidate>
            <div class="error">
              <h4>
                <?php
                  if (isset($_SESSION['loginError'])){//USUÁRIO OU SENHA INCORRETO
                    echo $_SESSION['loginError'];
                    unset($_SESSION['loginError']);
                    session_destroy();
                  }
                ?>
              </h4>
            </div>
            

            <div class="form-group">
              <input type="email" maxlength="250" class="form-control font-italic" placeholder="E-mail" name="email" id="email-login" onkeyup="minuscula(this)" required autofocus>
            </div>

            <div class="form-group">
              <div class="senha">
                <input type="password" maxlength="250" class="form-control font-italic" placeholder="Senha" name="senha" id="senhaLogin" required>
                <span class="show-btn"><i class="fas fa-eye"></i></span>
              </div>
            </div>

            <button type="submit" class="btn btn-info btn-lg btn-block font-weight-bold">Entrar</button>
          </form>

          <footer class="rodape">
            <div class="text-center">
              <a style="text-decoration: none; color: black;" href="https://www.cvacentertech.com.br"><img class="text-muted fw-light" style="width: 10rem;" src="img/logo_1.png"><strong><?=" " . date('Y');?></strong></a>
            </div>
          </footer>
        </div>
      </div>
    </div>

    <!-- JavaScript (Opcional) -->
    
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="app/js/jquery-3.5.1.min.js"></script>
    <script src="app/bootstrap_4.1/js/bootstrap.min.js"></script>

    <script src="app/js/jquery.mask.min.js"></script>
    <script src="app/js/jquery_validation/jquery.validate.min.js"></script>
    <script src="app/js/jquery_validation/additional-methods.min.js"></script>
    <script src="app/js/jquery_validation/localization/messages_pt_BR.js"></script>
    <script src="app/js/sweetalert2/sweetalert2.all.min.js"></script>
    
    <script src="app/js/login.js"></script>

    <!--Mostrar e ocultar senha digitada-->
    <script>
      const passField = document.querySelector("#senhaLogin");
      const showBtn = document.querySelector("span i");
      showBtn.onclick = (()=>{
        if(passField.type === "password"){
          passField.type = "text";
          showBtn.classList.add("hide-btn");
        }else{
          passField.type = "password";
          showBtn.classList.remove("hide-btn");
        }
      });
    </script>

    <!--Seta a validação no formulário--exige o preenchimento dos inputs-->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#form_login").validate({
          rules:{
            email:{
              email: true,
              nowhitespace: true,
              minlength: 10
            },
            senha:{
              minlength: 5,
              nowhitespace: true,
              alphanumeric: true
            }
          }
        })  
      })
    </script>

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