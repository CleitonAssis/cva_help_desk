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
    
    <link rel="stylesheet" type="text/css" href="../bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/custom.css">

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
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="logoff.php">Sair</a></li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header text-center font-weight-bold"><h4>Gestão de chamados</h4></div>
            
              <div class="card-body">

                <form id="form_busca" class="input-group mb-3" action="gerenciar_chamado_tecnico.php" method="GET">
                  <input type="search" maxlength="5" class="form-control font-italic" placeholder="Digite o número do chamado e clique em pesquisar para efetuar a busca" name="busca" autofocus>
                  <input type="hidden" name="voltar" value="<?php echo $_GET['voltar']; ?>">
                  <button class="btn btn-info" type="submit">Pesquisar</button>
                </form>

                <?php

                if (isset($_SESSION['usuarioNiveisAcessoId'])) {
                  $perfil = $_SESSION['usuarioNiveisAcessoId'];
                }
                echo "
                  <div class='table-responsive'>
                    <table class='table table-hover table-sm'>
                      <thead>
                        <tr>
                          <th class='text-center' scope='col'>Nº do Chamado</th>
                          <!--<th class='text-center' scope='col'>Nº do Perfil</th>-->
                          <th class='text-center' scope='col'>Categoria</th>
                          <th class='text-center' scope='col'>Setor</th>
                          <th class='text-center' scope='col'>Endereço</th>
                          <th class='text-center' scope='col'>Nome</th>
                          <!--<th class='text-center' scope='col'>E-Mail</th>
                          <th class='text-center' scope='col'>Telefone</th>-->
                          <th class='text-center' scope='col'>Descrição</th>
                          <th class='text-center' scope='col'>Ativo</th>
                          <th class='text-center' scope='col'>Status</th>
                          <!--<th class='text-center' scope='col'>Data de Cadastro</th>
                          <th class='text-center' scope='col'>Data de Modificação Status</th>-->
                          <th class='text-center' scope='col'>Funções</th>
                        </tr>
                      </thead>
                      <tbody>";


                      //Pesquisar no banco
                      if (isset($_GET['busca'])) {
                        $pesquisa = $_GET['busca'];
                      }else {
                        $pesquisa = '';
                      }
                        
                      //Receber o número da página
                      $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);       
                      $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                                                  
                      //Setar a quantidade de itens por pagina
                      $qnt_result_pg = 10;

                      //calcular o inicio visualização
                      $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                      $result_chamados = "SELECT * FROM `chamados` WHERE chamado_id LIKE '%$pesquisa%' ORDER BY data_cad DESC LIMIT $inicio, $qnt_result_pg";
                      $resultado_chamados = mysqli_query($conn, $result_chamados);
                      while($row_chamado = mysqli_fetch_assoc($resultado_chamados)) {
                        $chamado_id = $row_chamado['chamado_id'];
                        //$chamado_perfil_id = $row_chamado['chamado_perfil_id'];
                        $categoria = $row_chamado['categoria'];
                        $setor = $row_chamado['setor'];
                        $endereco = $row_chamado['endereco'];
                        $nome = $row_chamado['nome'];
                        //$email = $row_chamado['email'];
                        //$telefone = $row_chamado['telefone'];
                        $descricao = $row_chamado['descricao'];
                        if ($ativo = $row_chamado['ativo'] == "S") {
                          $ativo = "SIM";
                        } else {
                          $ativo = "NÃO";
                        }
                        $status = $row_chamado['status'];
                        /*$data_cad = $row_chamado['data_cad'];
                        $data_cad = invert_data2($data_cad);*/
                        /*if ($data_mod = $row_chamado['data_mod']) {
                          $data_mod = invert_data2($data_mod);
                        }else {
                          $data_mod = $row_chamado['data_mod'];
                        }*/

                        echo "<tr>
                                <th class='text-center' scope='row'>$chamado_id</th>
                                <td class='text-center'>$categoria</td>
                                <td class='text-center'>$setor</td>
                                <td class='text-center'>$endereco</td>
                                <td class='text-center'>$nome</td>
                                <td class='text-center'>$descricao</td>
                                <td class='text-center'>$ativo</td>
                                <td class='text-center'>$status</td>
                                <td class='text-center'>
                                  <div class='mx-auto' style='width: 200px;'>
                                  <a class='btn btn-warning btn-sm' href='edit_protocolo.php?id=$chamado_id' role='button'> Editar</a>
                                  <a class='btn btn-info btn-sm' href='edit_liberar_adm.php?id=$chamado_id' role='button'> Liberar</a>
                                  <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#confirma' onclick=" .'"' ."pegar_dados('$chamado_id', '$nome')" .'"' ."> Excluir</a>
                            </div>
                                </td>
                              </tr>";
                      }
                      echo "        
                      </tbody>
                    </table>
                  </div>";
                ?>

                <!-- Modal -->
                <div class="modal fade" id="confirma" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 align="center" class="modal-title" id=""><strong>Aviso !</strong></h4>
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                          <span aria-hidden="true">&times;</span>-->
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="excluir_chamado.php" method="POST">
                        <p class="fs-5 text-center"><b id="nome"></b> será deletado(a) permanentemente dos registros.</p>
                        <p class="fs-5 text-center">Deseja prosseguir ?</p> 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
                        <input type="hidden" name="nome" id="nome_2" value="">
                        <input type="hidden" name="id" id="chamado_id" value="">
                        <input type="submit" class="btn btn-danger" value="Sim">
                      </form>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="mb-3 mx-auto">

                <?php
                  //Paginção
                  $result_pg = "SELECT COUNT(chamado_perfil_id) AS num_result FROM chamados WHERE chamado_perfil_id = '$perfil' AND ativo = 'S'";
                  $resultado_pg = mysqli_query($conn, $result_pg);
                  $row_pg = mysqli_fetch_assoc($resultado_pg);
                               
                  //Quantidade de pagina
                  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
                            
                  //Limitar os link antes depois
                  $max_links = 5;
                  echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=1'>Primeira</a> ";

                  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                    if($pag_ant >= 1){
                      echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=$pag_ant'>$pag_ant</a> ";
                    }
                  }

                  echo "<a class='btn btn-secondary'>$pagina</a> ";
                            
                  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
                    if($pag_dep <= $quantidade_pg){
                      echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=$pag_dep'>$pag_dep</a> ";
                    }
                  }
                            
                  echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=$quantidade_pg'>Última</a> ";            
                            
                ?>
                <div class="row mt-5">
                  <div class="col-12">
                    <a class="btn btn-lg btn-warning btn-block" href="<?php echo $_GET['voltar']; //enviado via url na pag anterior?>">Voltar</button></a>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="../bootstrap_4.1/js/jquery/jquery-3.5.1.min.js"></script>
    <script src="../bootstrap_4.1/js/jquery_mask/jquery.mask.min.js"></script>
    <script src="../bootstrap_4.1/js/jquery_validation/jquery.validate.min.js"></script>
    <script src="../bootstrap_4.1/js/jquery_validation/additional-methods.min.js"></script>
    <script src="../bootstrap_4.1/js/jquery_validation/localization/messages_pt_BR.js"></script>
    <script src="../bootstrap_4.1/js/popper_tippy/popper.min.js"></script>
    <script src="../bootstrap_4.1/js/popper_tippy/tippy-bundle.umd.js"></script>
    <script src="../bootstrap_4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../bootstrap_4.1/js/bootstrap.min.js"></script>

    <!--Função transformar letras em maiúsculas em tempo real no input-->
    <script type="text/javascript">
      function maiuscula(string){
        res = string.value.toUpperCase();
        string.value = res;
      }
    </script>

    <!--Seta a validação no formulário--exige o preenchimento dos inputs-->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#form_busca").validate({
          rules:{
            busca:{
              number: true
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