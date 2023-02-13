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
    
    <link rel="stylesheet" type="text/css" href="bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <title>CVA Help Desk</title>
  </head>

  <body>

    <!-- início do preloader -->
    <div id="preloader">
      <div class="inner">
        <img style="width: 10rem;" src="../img/preloader2.svg">
        <h3 class="text-center fst-italic text-muted"><strong>Carregando ...</strong></h3>
        </div>
      </div>
    </div>
    <!-- fim do preloader -->

    <div class="container">
    	<div class="row">
        <div class="col">
          <div class="mb-3">
            <?php

        		//error_reporting();
        		$id = $_POST['id'];
        		$nome = $_POST['nome'];
        		
        		$sql= "DELETE FROM `chamados` WHERE chamado_id = $id";

        		if (mysqli_query($conn, $sql)) {
              echo "
                <center><div class='row'>
                  <div class='col'>
                    <div class='mb-3'>
                      <br><br><br><br><br><br>
                      <img style='width: 150px;' src='../bootstrap5/icons/check-circle.svg' class='rounded-circle bg-success' alt=''>
                      <br><br><br>
                      <h2 class='text-center alert alert-success' role='alert' autofocus>$nome deletado(a) com sucesso !</h2>
                    </div>
                  </div>
                </div></center>";
                //Gera arquivo de log de sucesso na exclusão no cadastro
                //error_reporting(0);
                $local_file = "../logs/log_deletado_success.txt";
                $user = $_SESSION['usuarioNome'] . " DELETOU: ";
                $data = " EM:" . date(" d-m-Y H:i:s " . PHP_EOL);
                $file = fopen($local_file, 'a');

                fwrite($file, $user);
                fwrite($file, $nome);
                fwrite($file, $data);
                fclose($file);
        		} else {
              echo "
                <center><div class='row'>
                    <div class='col'>
                      <div class='mb-3'>
                        <br><br><br><br><br><br>
                        <img style='width: 150px;' src='../bootstrap5/icons/emoji-frown.svg' class='rounded-circle bg-danger' alt=''>
                        <br><br><br>
                        <h2 class='text-center alert alert-danger' role='alert' autofocus>Não foi possível deletar $nome !</h2>
                      </div>
                    </div>
                  </div></center>";
             }
        		?>
          </div>
      		<center><div class="mb-3">
      			<a class="btn btn-primary rounded-pill" href="gestao_protocolos.php" role="button">Ok</a>
      		</center></div>
      	</div>
      </div>
    </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="js/jquery/jquery-3.5.1.min.js"></script>
    <script src="js/jquery_mask/jquery.mask.min.js"></script>
    <script src="js/jquery_validation/jquery.validate.min.js"></script>
    <script src="js/jquery_validation/additional-methods.min.js"></script>
    <script src="js/jquery_validation/localization/messages_pt_BR.js"></script>
    <script src="js/popper_tippy/popper.min.js"></script>
    <script src="js/popper_tippy/tippy-bundle.umd.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap_4.1/js/bootstrap.min.js"></script>

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
