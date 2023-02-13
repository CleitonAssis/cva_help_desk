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
    <?php
    //Erro de variável de navegação não recebida
    if (!isset($_GET['voltar']) || empty($_GET['voltar'])) {
      echo "<div class='alert alert-danger'><h1>Erro! variável de navegação não recebida.</h1></div>";
      session_destroy();
      exit();
    }
    ?>

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
            <div class="card-header text-center font-weight-bold"><h3>Abrir Novo Chamado</h3><small class="form-text font-weight-bold" style="color: var(--red);">Os campos marcados com <b>*</b> são de preenchimento obrigatório.</small></div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  
                  <form id="form_abrir_chamado" method="post" enctype="multipart/form-data" action="proc_abrir_chamado.php">

                    <div class="form-group">
                    <div class="form-group">
                      <label><strong>Setor:</strong><b class="font-weight-bold" style="color: var(--red);">*</b></label>
                      <select class="form-control font-italic" name="setor" id="setor" onchange="validarForm2()" required>
                        <option selected disabled>Selecione o setor</option>
                        <?php
                          $result_setor = "SELECT * FROM setores";
                          $resultado_setor = mysqli_query($conn, $result_setor);
                          while ($row_setor = mysqli_fetch_assoc($resultado_setor)) {
                        ?>
                            <option value="<?php echo $row_setor['setor_id'];?>"><?php echo $row_setor['nome_setor'];?></option>
                        <?php
                          }
                        ?>
                            <option value="OUTRO">OUTRO</option>
                      </select>
                      <div class="form-inline" id="divSetor" hidden>
                        <input type="text" maxlength="25" class="form-control col-md-3 font-italic" placeholder="Por favor informe o setor" name="setor" id="inputSetor" onkeyup="maiuscula(this)">&nbsp
                        <button type="button" class="close" id="btnSetor" aria-label="Fechar">
                          <span style="color: var(--red);" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>

                    <label><strong>Categoria:</strong><b class="font-weight-bold" style="color: var(--red);">*</b></label>
                      <select class="form-control font-italic" name="categoria" id="categoria" onchange="validarForm()" required autofocus>
                        <option selected disabled>Selecione a categoria</option>
                        <option value="CRIAÇÃO DE USUÁRIO">Criação de Usuário</option>
                        <option value="COMPUTADOR/NOTEBOOK">Computador/Notebook</option>
                        <option value="IMPRESSORA">Impressora</option>
                        <!--<option value="CÂMERA DE SEGURANÇA">Câmera de Segurança</option>-->
                        <option value="REDE/INTERNET">Rede/Internet</option>
                        <option value="OUTRO">Outro</option>
                      </select>
                      <div class="form-inline" id="divCategoria" hidden>
                        <input type="text" maxlength="25" class="form-control col-md-3 font-italic" placeholder="Por favor informe uma categoria" name="categoria" id="inputCategoria" onkeyup="maiuscula(this)">&nbsp
                        <button type="button" class="close" id="btnCategoria" aria-label="Fechar">
                          <span style="color: var(--red);" aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>

                    <div class="form-group">
                      <label><strong>Endereço/Local:</strong><b class="font-weight-bold" style="color: var(--red);">*</b></label>
                      <input type="text" class="form-control font-italic" name="endereco" id="endereco" placeholder="Digite aqui o endereço ou local para atendimento" onkeyup="maiuscula(this)" required>
                    </div>

                    <div class="form-group">
                      <label><strong>Telefone:</strong><b class="font-weight-bold" style="color: var(--red);">*</b></label>
                      <input type="tel" maxlength="15" class="form-control font-italic" name="telefone" id="telefone" placeholder="Digite aqui o telefone para contato" required>
                    </div>
                    
                    <div class="form-group">
                      <label><strong>Descrição do Problema:</strong><b class="font-weight-bold" style="color: var(--red);">*</b></label>
                      <textarea maxlength="250" class="form-control font-italic" name="descricao" id="Descricao" placeholder="Digite aqui uma breve descrição do problema, com número máximo de 250 caracteres" rows="3" onkeyup="maiuscula(this)" required></textarea>
                    </div>

                    <div class="form-group">
                      <label><strong>Anexar Foto:</strong></label>
                      <br>
                      <div class="row">
                        <div class="container">
                          <button type="button" class="close" id="btnImg" aria-label="Fechar" hidden>
                            <span style="color: var(--red);" aria-hidden="true">&times;</span>
                          </button>
                  
                          <img src="#" class="rounded float-left" alt="" id="imgUp">
                        
                          <input type="file" class="form-control-file font-italic" accept="image/*" name="arquivoImg" id="inputImg" onchange="removerBtn()">
                          <br>
                          <button type="reset" class="btn btn-warning btn-sm" id="btn-reset">Limpar formulário</button>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row mt-5">
                      <div class="col-4 mx-auto">
                        <a class="btn btn-lg btn-warning btn-block" href="<?php echo $_GET['voltar']; //enviado via url na pag anterior?>">Voltar</button></a>
                      </div>
                      
                      <div class="col-4 mx-auto">
                        <input type="hidden" name="voltar" value="<?php echo $_GET['voltar'];?>">
                        <button class="btn btn-lg btn-info btn-block" type="submit">Abrir</button>
                      </div>
                    </div>
                  </form>
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

    
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/jquery_validation/jquery.validate.min.js"></script>
    <script src="js/jquery_validation/additional-methods.min.js"></script>
    <script src="js/jquery_validation/localization/messages_pt_BR.js"></script>
    <script src="js/abrir_chamado.js"></script>

    <!--Seta a validação no formulário--exige o preenchimento dos inputs-->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#form_abrir_chamado").validate({
          rules:{
            endereco:{
              required: true,
              minlength: 6,
              maxlength: 100
            },
            telefone:{
              required: true,
              minlength: 15,
              //nowhitespace: true,
              //alphanumeric: true
            },
            descricao:{
              required: true,
              minWords: 2
            }
          }
        })  
      })
    </script>

    <!--Função de preview da img antes do upload -->
    <script type="text/javascript">
      function readURL(input) {

        if (input.files && input.files[0]) {
          let reader = new FileReader();

          reader.onload = function (e) {
            $('#imgUp').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $('#inputImg').change(function(){
        readURL(this);
      });
    </script>

    <!--Dicas-->
    <script>//Tippy
      tippy('.close', {//passe uma #id, data-tippy-content, .class ou tag Ex:'#botao','[data-tippy-content]','.btn btn-outline-success','button'
        allowHTML: true,
        animateFill: false,
        //animation: 'scale',//'shift-away', 'shift-toward', 'scale', 'perspective',
        inertia: true,
        content: 'Fechar',//usado quando passado uma id ou classe
        duration: [500, 0],
        //delay: 500,
        followCursor: 'initial',//false, true, 'horizontal', 'vertical', 'initial',
        hideOnClick: true,//true, false, 'toggle',
        interactive: true,
        interactiveBorder: 30,
        maxWidth: 200,
        placement: 'top',//top, bottom, left, right, auto, variações start e end
        trigger: 'mouseenter focus',//'mouseenter focus', 'click', 'focusin', 'mouseenter click', 'manual',
      });
    </script>

    <!--Função para adicionar máscara ao formulário-->
    <script type="text/javascript">
      $(document).ready(function(){
        //$("#cartao_sus").mask("000-000-000-000-000");
        $("#telefone").mask("(00) 00000-0000");
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