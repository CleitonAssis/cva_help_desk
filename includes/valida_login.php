<?php

  if (!isset($_SESSION)) {
    session_start();
  }
  require_once("conexao.php");
  ?>
  <?php
  
  //O campo usuário e senha preenchido entra no if para validar
  if ((isset($_POST['email'])) && (isset($_POST['senha']))) {
    $usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $senha = md5($senha);
                    
    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
    $result_usuario = "SELECT * FROM usuarios WHERE email_usuario = '$usuario' && senha_usuario = '$senha' LIMIT 1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $row_usuario = mysqli_fetch_assoc($resultado_usuario);
    //var_dump($row_usuario);
    //die();
                
    //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    if ($row_usuario != null){
      //verifica se o usuário está ativo
      if ($row_usuario['status_usuario'] == "ATIVO") {
        //Salva tempo atual do login na sessão
        $_SESSION['login_time'] = time();
        
        //salva os dados da sessão antes de verificar o nível de acesso do usuário
        $_SESSION['usuarioStatus'] = $row_usuario['status_usuario'];
        $_SESSION['usuarioId'] = $row_usuario['usuario_id'];
        $_SESSION['usuarioNiveisAcessoId'] = $row_usuario['perfis_perfil_id'];
        $_SESSION['usuarioSetorId'] = $row_usuario['setores_setor_id'];
        $_SESSION['usuarioNome'] = $row_usuario['nome_usuario'];
        $_SESSION['usuarioEmail'] = $row_usuario['email_usuario'];

        //caso os dados do usuário estejam corretos direciona-o ao nível de acesso correspondente 
        if ($_SESSION['usuarioNiveisAcessoId'] == "1") {
          header("Location: ../app/admin.php");
          //Gera arquivo de log de acesso
          $perfil_superuser = "SUPER USUÁRIO";
          $local_file = "../logs/log_acesso_superuser.log";
          $user = "$perfil_superuser _ " . $_SESSION['usuarioNome'] . " _ ACESSOU EM:";
          $data = date(" d-m-Y H:i:s " . PHP_EOL);
          $file = fopen($local_file, "a");

          fwrite($file, $user);
          fwrite($file, $data);
          fclose($file);
          die();

        } elseif ($_SESSION['usuarioNiveisAcessoId'] == "2") {
          header("Location: ../app/tecnico.php");
          //Gera arquivo de log de acesso
          $perfil_tecnico = "TÉCNICO";
          $local_file = "../logs/log_acesso_tecnico.log";
          $user = "$perfil_tecnico _ " . $_SESSION['usuarioNome'] . " _ ACESSOU EM:";
          $data = date(" d-m-Y H:i:s " . PHP_EOL);
          $file = fopen($local_file, "a");

          fwrite($file, $user);
          fwrite($file, $data);
          fclose($file);
          die();

        } elseif ($_SESSION['usuarioNiveisAcessoId'] == "3") {
          header("Location: ../app/usuario.php");
          //Gera arquivo de log de acesso
          $perfil_usuario = "USUÁRIO";
          $local_file = "../logs/log_acesso_usuario.log";
          $user = "$perfil_usuario _ " . $_SESSION['usuarioNome'] . " _ ACESSOU EM:";
          $data = date(" d-m-Y H:i:s " . PHP_EOL);
          $file = fopen($local_file, "a");

          fwrite($file, $user);
          fwrite($file, $data);
          fclose($file);
          die();
        }
      }else {
        $_SESSION['loginError5'] = "Usuário " . $row_usuario['nome_usuario'] . " se encontra bloqueado ! ";
        header('Location: ../index.php');
        //Gera arquivo de log de acesso
        //$nome_usuario = $row_usuario['nome_usuario'];
        $local_file = "../logs/log_error_login.log";
        $user = "#ERRO DE LOGIN: " . $row_usuario['nome_usuario'] . " _ ACESSO BLOQUEADO EM:";
        $data = date(" d-m-Y H:i:s#" . PHP_EOL);
        $file = fopen($local_file, "a");

        fwrite($file, $user);
        fwrite($file, $data);
        fclose($file);
        die();
      }
      
    //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    //redireciona o usuario para a página de login
    }else {

      //Váriavel global recebendo a mensagem de erro
      $_SESSION['loginError'] = "Usuário ou senha inválido !";
      header("Location: ../index.php");
      
      //Gera arquivo de log do erro de acesso
      $local_file = "../logs/log_error_login.log";
      $user = "#ERRO DE LOGIN: " . $_POST['email'] . "_" . $_POST['senha'] . " _";
      $data = date(" d-m-Y H:i:s#" . PHP_EOL);
      $file = fopen($local_file, "a");

      fwrite($file, $user);
      fwrite($file, $data);
      fclose($file);
      die();
    } 
  }
?>