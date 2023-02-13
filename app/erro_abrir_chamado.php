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

    <!--RECEBE DA PÁGINA ANTERIOR A VARIÁVEL VIA URL-->
    <?php
      $voltar = $_GET['voltar'];
    ?>

   <!-- JavaScript (Opcional) -->
   <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
   <script src="../js/jquery-3.5.1.min.js"></script>
   <script src="../bootstrap_4.1/js/bootstrap.min.js"></script>
   <script src="../js/sweetalert2/sweetalert2.all.min.js"></script>

   <!--Preloader-->
   <script>
     $(window).on('load', function () {
       $('#preloader .inner').fadeOut();
       $('#preloader').delay(400).fadeOut('slow'); 
       $('body').delay(400).css({'overflow': 'visible'});
     })
   </script>

   <!--Direciona para uma página após algum tempo
    <script>
      $(window).on('load', function () {
        swal.fire('Cadastro efetuado com sucesso !', '', 'success');
        setTimeout(function() {
          window.location.href = "cadastra_candidato.php";
        }, 5000)
      })
    </script>-->

    <!--Popup de aviso-->
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-info',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          icon: 'error',
          title: '<h1 style="color: var(--danger);">Erro...<h1>',
          //text: 'Não foi possível cadastrar o candidato!',
          timer: 10000,
          timerProgressBar: true,
          /*imageUrl: 'https://media.giphy.com/media/2vpc11EI5DPzNkowzG/giphy.gif',
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: 'Custom image',*/
          background: 'var(--white)',//'#008000',// url(/images/trees.png)',
          /*backdrop: `
              rgb(0, 128, 0)
              url("https://media.giphy.com/media/ZyuSUCXjt3E0T6Vwb2/giphy.gif")
              left top
              no-repeat
            `,*/
          /*didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },*/
          //showConfirmButton: false,
          //showCloseButton: true,
          //confirmButtonColor: '#0d6efd',
          html:
              '<em style="color: var(--danger);">Chamado não cadastrado !</em>' /*+
              '<a href="//sweetalert2.github.io">links</a> ' +
              'and other HTML tags'*/
          }).then(function() {
          let voltar = "<?=$voltar?>";//RECEBE VARIÁVEL VOLTAR DO PHP E PASSA AO JAVASCRIPT
          window.location = "abrir_chamado.php"+"?voltar="+voltar;
        });
    </script>
  </body>
</html>