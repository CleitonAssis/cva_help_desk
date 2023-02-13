<?php
  require_once 'valida_acesso.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome_5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <title><?php echo $user_name = $_SESSION['usuarioNome'];?></title>
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

    <div class="container d-flex justify-content-center">
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <?php

            //error_reporting();
            // mb_strtoupper => transforma letras recebidas do formulário em maiúsculas
            //$nome = mb_strtoupper($_POST['nome']);
            $chamado_perfil_id = $_SESSION['usuarioNiveisAcessoId'];
            $categoria = $_POST['categoria'];
            $setor = $_POST['setor'];
            $endereco = $_POST['endereco'];
            $nome = $_SESSION['usuarioNome'];
            $email = $_SESSION['usuarioEmail'];
            $telefone = $_POST['telefone'];
            $descricao = $_POST['descricao'];
            $voltar = $_POST['voltar'];
            //$ativo = $_POST['ativo'];
            /*$status = "NULL";
            $data_cad = "NOW";
            $data_mod = "NULL";*/

            //verifica se o numero existe no banco de dados
            /*$result_cad = "SELECT endereco FROM chamados WHERE endereco = '$endereco'";
            $resultado_cad = mysqli_query($conn, $result_cad);

            if (($resultado_cad) AND ($resultado_cad->num_rows != 0)){
              echo "";
            } else {
            //verifica se o nome existe no banco de dados
            $result_cad = "SELECT descricao FROM chamados WHERE descricao = '$descricacao'";
            $resultado_cad = mysqli_query($conn, $result_cad);
            }

            if (($resultado_cad) AND ($resultado_cad->num_rows != 0)){
              header("Location: duplicado_abrir_chamado.php");
              echo "<br><br><br><br><br><br><br><br><br><center><img style='width: 150px;' src='bootstrap5/icons/emoji-frown.svg' class='rounded-circle bg-danger' alt=''><br><br><br><h2><div class='alert alert-danger' role='alert'>Não foi possível cadastrar este candidato ! <br> $nome ou o número $numero já está cadastrado no sistema !</div></h2></center>";
            } else {*/

            
            //Processamento de envio da imagem
            if (isset($_FILES['arquivoImg']['name'])) {

              $ext = strtolower(pathinfo($_FILES['arquivoImg']['name'], PATHINFO_EXTENSION)); //Pegando extensão do arquivo
              $new_name = $nome . "_" . md5(date('d_m_Y - H_i_s')) . "." . $ext; //Definindo um novo nome para o arquivo
              $dir = '../upload_img/'; //Diretório para uploads
              
              if (move_uploaded_file($_FILES['arquivoImg']['tmp_name'], $dir . $new_name)) {//Enviando nome do arquivo updado ao banco
                $new_name = '"' . $nome . '_' . md5(date('d_m_Y - H_i_s')) . '.' . $ext . '"';
              } else {
                $new_name = "NULL";

                //Gera arquivo de log de erro no envio da imagem
                /*$local_file = "../logs/log_env_img_error.log";
                $user = "ERRO AO ENVIAR IMG: $nome SETOR: $setor ";
                $data = "EM:" . date(" d-m-Y H:i:s " . PHP_EOL);
                //$data = " EM:" . date(" d-m-Y H:i:s " . PHP_EOL);
                $file = fopen($local_file, "a");

                fwrite($file, $user);
                //fwrite($file, $nome);
                fwrite($file, $data);
                fclose($file);*/
              }
            }

            $sql = "INSERT INTO `chamados`(`chamado_perfil_id`, `categoria`, `setor`, `endereco`, `nome`, `email`, `telefone`, `descricao`, `img_upload`, `data_cad`) VALUES ('$chamado_perfil_id', '$categoria', '$setor', '$endereco', '$nome', '$email', '$telefone', '$descricao', $new_name, NOW())";
            if (mysqli_query($conn, $sql)) {

              header("Location: sucesso_abrir_chamado.php?voltar=$voltar");

              //Gera arquivo de log de sucesso no cadastro
              //error_reporting(0);
              /*$local_file = "../logs/usuario_log/abrir_chamado_success.txt";
              $user = $_SESSION['usuarioNome'] . " CADASTROU CHAMADO EM: ";
              $data = date(" d-m-Y H:i:s " . PHP_EOL);
              //$data = " EM:" . date(" d-m-Y H:i:s " . PHP_EOL);
              $file = fopen($local_file, "a");

              fwrite($file, $user);
              //fwrite($file, $nome);
              fwrite($file, $data);
              fclose($file);*/

            } else {

              header("Location: erro_abrir_chamado.php?voltar=$voltar");

              //Gera arquivo de log de erro no cadastro
              //error_reporting(0);
              $local_file = "../logs/log_abrir_chamado_error.log";
              $user = "ERRO AO ABRIR CHAMADO: $nome SETOR: $setor ";
              $data = "EM:" . date(" d-m-Y H:i:s " . PHP_EOL);
              //$data = " EM:" . date(" d-m-Y H:i:s " . PHP_EOL);
              $file = fopen($local_file, "a");

              fwrite($file, $user);
              //fwrite($file, $nome);
              fwrite($file, $data);
              fclose($file);
            }
           //}
            ?>
          </div>
        </div>
      </div>
    </div>

   <!-- JavaScript (Opcional) -->
   <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="bootstrap_4.1/js/bootstrap.min.js"></script>
   <script src="js/sweetalert2/sweetalert2.all.min.js"></script>


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