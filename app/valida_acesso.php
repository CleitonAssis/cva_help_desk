
<?php
  session_start();
  //Verifica se existe o usuário logado
  if (!isset($_SESSION['usuarioStatus']) || $_SESSION['usuarioStatus'] != "ATIVO") {
    $_SESSION['loginError2'] = "Efetue login para acessar o sistema !";
    header('Location: ../index.php');
    die();
  }
  //header('Location: ../index.php?login=error2');

  include_once '../includes/conexao.php';

  //Verifica e valida o tempo limite da sessão
  if (time() - $_SESSION['login_time'] >= 1800) {//tempo em segundos
    session_unset(
      $_SESSION['login_time'],
      $_SESSION['usuarioStatus'],
      $_SESSION['usuarioId'],
      $_SESSION['usuarioNiveisAcessoId'],
      $_SESSION['usuarioSetorId'],
      $_SESSION['usuarioNome'],
      $_SESSION['usuarioEmail']
    );

    session_destroy();
    session_start();
    $_SESSION['loginError3'] = "Sessão Expirada ! Faça login novamente.";
    header('Location: ../index.php');
    die();
  }else{
    $_SESSION['login_time'] = time();
  }
?>