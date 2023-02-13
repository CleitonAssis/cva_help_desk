<!--<?php
//if (!isset($_SESSION)) {
  //session_start();
//}
//Passa msg de erro de conexão com a base de dados para página de login
//$_SESSION['loginError5'] = "Sem conexão com o banco de dados !";
?>-->
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<meta http-equiv="refresh" content="5">--><!--Recarrega a página automaticamente de 5 em 5 segundos-->

    <link rel="stylesheet" type="text/css" href="../bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../font-awesome_5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">

    <title>CVA Help Desk</title>
    <style>
        .centralizar {
          position: absolute;
          top: 50%; /* centralizar a parte interna do preload (onde fica a animação)*/
          left: 50%;
          transform: translate(-50%, -50%);  
        }
        /* end: Preloader */
        #errorConexao {
          font-size: 2rem;
          position: relative;
          color: var(--danger);
          /*margin: auto -50% auto;*/
        }
    </style>
  </head>
  <body onload="redireciona()">
    
      <div class="centralizar">
        <h1 class="animate__animated animate__pulse animate__repeat-3 text-center" id='errorConexao'><i class='fas fa-exclamation-triangle'></i> Não foi possível conectar com o banco de dados !</h1>
        <img style="width: 50rem;" src="../img/server-error.svg">
      </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="bootstrap_4.1/js/jquery/jquery-3.5.1.min.js"></script>
    <script src="bootstrap_4.1/js/popper_tippy/popper.min.js"></script>
    <script src="bootstrap_4.1/js/bootstrap.min.js"></script>

    <!--Função recarrega a página automáticamente de 5 em 5 segundos-->
    <!--<script type="text/javascript">
      function reload() {
        document.location.reload();
      }
      setTimeout(reload, 5000);
    </script>-->

    <!--Função redireciona a página automáticamente após 30 segundos-->
    <script type="text/javascript">
      function redireciona(){
        setTimeout("location.href = 'http://192.168.12.171:9000/cva_help_desk/index.php';", 20000);
      }
    </script>
    
  </body>
</html>