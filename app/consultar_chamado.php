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

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand font-weight-bold" href="#"><img src="../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""> CVA Help Desk</a>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="logoff.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-home">
          <div class="card">
            <div class="card-header text-center font-weight-bold"><h3>Chamados</h3></div>
            
              <div class="card-body">

                <form id="form_busca" class="form-inline" action="consultar_chamado.php" method="GET">
                  <div class="form-group mx-sm-3 mb-2">
                    <input type="search" maxlength="5" class="form-control font-italic" placeholder="Código do chamado" name="busca" id="busca" autofocus>
                    <input type="hidden" name="voltar" value="<?php echo $_GET['voltar']; ?>">

                    <button class="btn btn-info" type="submit">Buscar <i class="fas fa-search"></i></button>
                  </div>
                </form>

                <?php
                if (isset($_SESSION['usuarioNiveisAcessoId'])) {
                  $perfil = $_SESSION['usuarioNiveisAcessoId'];
                  $user_id = $_SESSION['usuarioId'];
                  $voltar = $_GET['voltar'];
                }
                echo "
                  <div class='table-responsive'>
                    <table class='table table-hover'>
                      <thead>
                        <tr>
                          <th class='text-center' style='color:#808080;' scope='col'>Cod. do Chamado</th>
                          <th class='text-center' style='color:#808080;' scope='col'>Setor</th>
                          <th class='text-center' style='color:#808080;' scope='col'>Categoria</th>
                          <th class='text-center' style='color:#808080;' scope='col'>Status</th>
                          <th class='text-center' style='color:#808080;' scope='col'>Data</th>
                          <th class='text-center' style='color:#808080;' scope='col'>Última Atualização</th>
                          <th class='text-center' style='color:#808080;' scope='col'>Funções</th>
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
                        $qnt_result_pg = 1;

                      //calcular o inicio visualização
                      $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                      $result_chamados = "SELECT * FROM `chamados` WHERE chamado_id LIKE '%$pesquisa%' AND usuarios_usuario_id = '$user_id' AND chamado_ativo = 'S' ORDER BY data_cad_chamado DESC LIMIT $inicio, $qnt_result_pg";
                      $resultado_chamados = mysqli_query($conn, $result_chamados);
                      while($row_chamado = mysqli_fetch_assoc($resultado_chamados)) {
                        $chamado_id = $row_chamado['chamado_id'];

                        $recebe_set = $row_chamado['setores_setor_id'];
                        $result_setor = "SELECT setores.nome_setor AS set_result FROM setores WHERE setor_id = '$recebe_set'";
                        $resultado_setor = mysqli_query($conn, $result_setor);
                        $row_setor = mysqli_fetch_assoc($resultado_setor);
                        $setor = $row_setor['set_result'];

                        $recebe_cat = $row_chamado['categorias_categoria_id'];
                        $result_categoria = "SELECT categorias.nome_categoria AS cat_result FROM categorias WHERE categoria_id = '$recebe_cat'";
                        $resultado_categoria = mysqli_query($conn, $result_categoria);
                        $row_categoria = mysqli_fetch_assoc($resultado_categoria);
                        $categoria = $row_categoria['cat_result'];

                        $endereco = $row_chamado['endereco_chamado'];
                        $status = $row_chamado['status_chamado'];
                        if ($status == NULL) {
                          $status = "<b style='color:#007bff'>ABERTO</a>";
                        }else {
                          $status = $row_chamado['status_chamado'];
                        }
                        /*$img_upload = $row_chamado['img_upload'];
                        if ($img_upload == NULL) {
                          $img_upload = "NÃO ENVIADO";
                        }else {
                          $img_upload = "<a target='_blank' href='../upload_img/$img_upload'>" . $row_chamado['img_upload'] . "</a>";
                        }*/
                        $data_cad = invert_data2($row_chamado['data_cad_chamado']);
                        if ($data_mod = $row_chamado['data_mod_chamado']) {
                          $data_mod = invert_data2($data_mod);
                        }else {
                          $data_mod = $row_chamado['data_mod_chamado'];
                        }

                        echo "<tr>
                                <th class='text-center' style='color:#808080;' scope='row'>$chamado_id</th>
                                <td class='text-center'>$setor</td>
                                <td class='text-center'>$categoria</td>
                                <td class='text-center'>$status</td>
                                <td class='text-center'>$data_cad</td>
                                <td class='text-center'>$data_mod</td>
                                <td class='d-flex justify-content-center'>
                                  <button type='button' class='btn btn-info btn-sm m-1' data-toggle='modal' data-target='#ModalVerMais' onclick=" . '"' . "pegarId($chamado_id)" . '"' . ">Mostrar <i class='fas fa-plus'></i></button>
                                </td>
                              </tr>";
                      }
                      echo "        
                      </tbody>
                    </table>
                  </div>";
                ?>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="ModalVerMais" tabindex="-1" aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" style="color:#808080;">Detalhes</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <dl class="row">
                          <dt class="col-sm-3">Número do Chamado</dt>
                          <dd class="col-sm-9"><span id="idChamado"></span></dd>
                          
                          <dt class="col-sm-3">Nome</dt>
                          <dd class="col-sm-9"><span id="nomeUsuario"></span></dd>
                          
                          <dt class="col-sm-3">E-mail</dt>
                          <dd class="col-sm-9"><span id="emailUsuario"></span></dd>
                          
                          <dt class="col-sm-3">Logradouro</dt>
                          <dd class="col-sm-9"><span id="logradouroUsuario"></span></dd>
                          
                          <dt class="col-sm-3">Número</dt>
                          <dd class="col-sm-9"><span id="numeroUsuario"></span></dd>

                      </dl>
                    </div>
                    <!--<div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <button type="button" class="btn btn-primary">Salvar mudanças</button>
                    </div>-->
                  </div>
                </div>
              </div>

              <div class="mb-3 mx-auto">

                <?php
                  //Paginção
                  $result_pg = "SELECT COUNT(chamado_id) AS num_result FROM chamados WHERE usuarios_usuario_id = '$user_id' AND chamado_ativo = 'S'";
                  $resultado_pg = mysqli_query($conn, $result_pg);
                  $row_pg = mysqli_fetch_assoc($resultado_pg);
                               
                  //Quantidade de pagina
                  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
                            
                  //Limitar os link antes depois
                  $max_links = 2;
                  echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=1&voltar=usuario.php'>Primeira</a> ";

                  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                    if($pag_ant >= 1){
                      echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=$pag_ant&voltar=usuario.php'><i class='fas fa-chevron-left'></i></a> ";
                    }
                  }

                  echo "<a class='btn btn-secondary'>$pagina</a> ";
                            
                  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
                    if($pag_dep <= $quantidade_pg){
                      echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=$pag_dep&voltar=usuario.php'><i class='fas fa-chevron-right'></i></a> ";
                    }
                  }
                            
                  echo "<a class='btn btn-info' href='consultar_chamado.php?pagina=$quantidade_pg&voltar=usuario.php'>Última</a> ";                    
                ?>
                <div class="row mt-5">
                  <div class="col-12">
                    <a class="btn btn-lg btn-warning btn-block" href="<?php echo $voltar; //enviando variável de navegação?>">Voltar</button></a>
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
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/tippy/popper.min.js"></script>
    <script src="js/tippy/tippy-bundle.umd.js"></script>
    <script src="bootstrap_4.1/js/bootstrap.min.js"></script>

    <script src="js/jquery_validation/jquery.validate.min.js"></script>
    <script src="js/jquery_validation/additional-methods.min.js"></script>
    <script src="js/jquery_validation/localization/messages_pt_BR.js"></script>

    <script type="text/javascript">
      function pegarId(id){
        //console.log("Acessou ID: " + id)
        document.getElementById('chamado_id').value = idChamado;
        //document.getElementById('chamado_id').innerHTML = idChamado;
      }
    </script>

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
              number: true,
              maxlength: 5
            }
          },
          messages:{
            busca:{
              number: "Digite apenas números!"
            }
          }
        })  
      })
    </script>

    <!--Dicas-->
    <script>//Tippy
      tippy('#busca', {//passe uma #id, data-tippy-content, .class ou tag Ex:'#botao','[data-tippy-content]','.btn btn-outline-success','button'
        allowHTML: true,
        animateFill: false,
        //animation: 'scale',//'shift-away', 'shift-toward', 'scale', 'perspective',
        inertia: true,
        content: 'Digite o código do chamado para realizar a busca',//usado quando passado uma id ou classe
        duration: [500, 0],
        //delay: 500,
        followCursor: 'initial',//false, true, 'horizontal', 'vertical', 'initial',
        hideOnClick: true,//true, false, 'toggle',
        interactive: true,
        interactiveBorder: 30,
        maxWidth: 200,
        placement: 'top',//top, bottom, left, right, auto, variações start e end
        trigger: 'click',//'mouseenter focus', 'click', 'focusin', 'mouseenter click', 'manual',
      });
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