<?php
  require_once 'valida_acesso.php';
  //PERMISSÃO POR PERFIL
  if ($_SESSION['usuarioNiveisAcessoId'] != "3") {
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
    <!-- fim do preloader -->

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand font-weight-bold" href="#"><img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""> CVA Help Desk</a>

      <div class="btn-group">
        <a style="text-decoration: none; color: var(--cyan);" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-lg" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <b>
              <?php
              /*--TRAZ O NOME DO USUÁRIO DA SESSÃO*/
              echo $user_name = $_SESSION['usuarioNome'];
              ?>
            </b>
        </a>
        <li class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalConta" data-backdrop="static"><i class="fas fa-user-cog"></i> Minha Conta</a>
          <!--<a class="dropdown-item" href="#">Outra ação</a>-->
          <a class="dropdown-item" href="logoff.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </li>
      </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="modalConta" tabindex="-1" aria-hidden="false">
      <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" style="color:#808080;"><?php echo $user_name; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <?php
              if (isset($_SESSION['usuarioNiveisAcessoId'])) {
                $perfil = $_SESSION['usuarioNiveisAcessoId'];
                $user_id = $_SESSION['usuarioId'];
                //$username = $_SESSION['usuarioNome'];
                //$voltar = $_GET['voltar'];
              }
              echo "
                <div class='table-responsive'>
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th class='text-center' style='color:#808080;' scope='col'>Cod. do Usuário</th>
                        <th class='text-center' style='color:#808080;' scope='col'>Perfil</th>
                        <th class='text-center' style='color:#808080;' scope='col'>Setor</th>
                        <th class='text-center' style='color:#808080;' scope='col'>E-mail</th>
                        <th class='text-center' style='color:#808080;' scope='col'>Status</th>
                        <th class='text-center' style='color:#808080;' scope='col'>Funções</th>
                      </tr>
                    </thead>
                    <tbody>";

              $result_usuario = "SELECT * FROM usuarios WHERE nome_usuario LIKE '%$user_name%' AND usuario_id = '$user_id'";
              $resultado_usuario = mysqli_query($conn, $result_usuario);
              while($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
                $usuario_id = $row_usuario['usuario_id'];

                $recebe_perf = $row_usuario['perfis_perfil_id'];
                $result_perfil = "SELECT perfis.nome_perfil AS perf_result FROM perfis WHERE perfil_id = '$recebe_perf'";
                $resultado_perfil = mysqli_query($conn, $result_perfil);
                $row_perfil = mysqli_fetch_assoc($resultado_perfil);
                $perfil = $row_perfil['perf_result'];

                $recebe_set = $row_usuario['setores_setor_id'];
                $result_setor = "SELECT setores.nome_setor AS set_result FROM setores WHERE setor_id = '$recebe_set'";
                $resultado_setor = mysqli_query($conn, $result_setor);
                $row_setor = mysqli_fetch_assoc($resultado_setor);
                $setor = $row_setor['set_result'];

                $email = $row_usuario['email_usuario'];

                /*$recebe_cat = $row_chamado['categorias_categoria_id'];
                $result_categoria = "SELECT categorias.nome_categoria AS cat_result FROM categorias WHERE categoria_id = '$recebe_cat'";
                $resultado_categoria = mysqli_query($conn, $result_categoria);
                $row_categoria = mysqli_fetch_assoc($resultado_categoria);
                $categoria = $row_categoria['cat_result'];*/

                /*$endereco = $row_chamado['endereco_chamado'];*/
                $status = "<b style='color:#28a745'>" . $row_usuario['situacao_usuario'] . "</b>";
                /*$data_cad = invert_data2($row_usuario['data_cad_usuario']);
                if ($data_mod = $row_usuario['data_mod_usuario']) {
                  $data_mod = invert_data2($data_mod);
                }else {
                  $data_mod = $row_usuario['data_mod_usuario'];
                }*/

              echo "<tr>
                      <th class='text-center' style='color:#808080;' scope='row'>$usuario_id</th>
                        <td class='text-center'>$perfil</td>
                        <td class='text-center'>$setor</td>
                        <td class='text-center'>$email</td>
                        <td class='text-center'>$status</td>
                        <!--<td class='d-flex justify-content-center'>
                          <button type='button' class='btn btn-info btn-sm m-1' data-toggle='modal' data-target='#ModalVerMais' onclick=" . '"' . "pegarId($usuario_id)" . '"' . ">Mostrar <i class='fas fa-plus'></i></button>
                        </td>-->
                    </tr>";
              }
              echo "        
                </tbody>
                  </table>
                </div>";
              ?>
            </div>
          </div>
          <!--<div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Salvar mudanças</button>
          </div>-->
        </div>
      </div>
    </div>

    <div class="container">    
      <div class="row">

        <div class="card-home">
          <div class="card">
            <div class="card-header text-center font-weight-bold"><h3>Menu</h3></div>
            <div class="card-body">
              <div class="row">
                <div class="col-6 d-flex justify-content-center">
                  <a style="text-decoration: none;" href="abrir_chamado.php?voltar=usuario.php"><img src="../img/formulario_abrir_chamado.png" width="70" height="70"><b style="color: black;">Abrir Chamado</b></a>
                </div>
                <div class="col-6 d-flex justify-content-center">
                  <a style="text-decoration: none;" href="consultar_chamado.php?voltar=usuario.php"><img src="../img/formulario_consultar_chamado.png" width="70" height="70"><b style="color: black;">Ver  Chamados</b></a>
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
