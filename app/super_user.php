<?php
  require_once 'valida_acesso.php';
  //PERMISSÃO POR PERFIL
  if ($_SESSION['usuarioNiveisAcessoId'] != "1") {
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
    
    <!--<link rel="stylesheet" type="text/css" href="bootstrap_4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="font-awesome_5.15.4/css/all.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/styles.css">


    <title><?php echo $user_name = $_SESSION['usuarioNome'];?></title>
  </head>
    <body class="sb-nav-fixed">

        <!-- início do preloader -->
        <div id="preloader">
            <div class="inner">
                <img style="width: 10rem;" src="../img/preloader.svg">
                <h3 class="text-center fst-italic text-muted"><strong>Carregando ...</strong></h3>
            </div>
        </div>
        <!-- fim do preloader -->

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">
                <?php
                    //TRAZ O PERFIL DO USUÁRIO DA SESSÃO
                    if ($_SESSION['usuarioNiveisAcessoId'] == "1") {
                      $perfil = "Super Usuário";
                    }
                    echo "<b>$perfil</b>";
                ?>
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <b class="navbar-brand font-weight-bold"><img src="../img/logo_hospital.svg" width="35" height="35" class="d-inline-block align-top" alt=""> CVA Help Desk</b>
            <!-- Navbar Search-->
            <!--<form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-cog"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configurações</a></li>
                        <!--<li><a class="dropdown-item" href="#!">Logs</a></li>-->
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logoff.php">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="super_user.php">
                                <div class="sb-nav-link-icon"><i class="far fa-hospital"></i></div>
                                Home
                            </a>
                            <!--<div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pacientes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>-->
                            <!--<div class="sb-sidenav-menu-heading">Complementos</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Gráficos
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tabelas
                            </a>-->

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-hospital-user"></i></div>
                                Usuários
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Cadastrar Usuário</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Cadastro de Usuários</a>
                                    <a class="nav-link" href="#">Editar Cadastro de Usuário</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse1" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
                                Médicos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Cadastrar Médico</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Cadastro de Médicos</a>
                                    <a class="nav-link" href="#">Editar Cadastro de Médico</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse2" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Pacientes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Cadastrar Paciente</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Cadastro de Pacientes</a>
                                    <a class="nav-link" href="#">Editar Cadastro de Paciente</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse3" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-injured"></i></i></div>
                                Triagem
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Triar Paciente</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Triagem</a>
                                    <a class="nav-link" href="#">Editar Triagem de Paciente</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse4" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-medical"></i></div>
                                Prontuários
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Cadastrar Usuário</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Cadastro de Usuários</a>
                                    <a class="nav-link" href="#">Editar Cadastro de Usuário</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse5" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-procedures"></i></div>
                                Procedimentos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse5" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Cadastrar Usuário</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Cadastro de Usuários</a>
                                    <a class="nav-link" href="#">Editar Cadastro de Usuário</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapse6" aria-expanded="false" aria-controls="pagesCollapse">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Logs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapse6" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="cadastrar_paciente.php?voltar=super_user.php">Triar Paciente</a>
                                    <a class="nav-link" href="cadastro_paciente.php?voltar=super_user.php">Ver Triagem</a>
                                    <a class="nav-link" href="#">Editar Triagem de Paciente</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado como:</div>
                        <i class="fas fa-user"></i>
                        <?php
                            /*--TRAZ O NOME DO USUÁRIO DA SESSÃO*/
                            $user_name = $_SESSION['usuarioNome'];
                            echo "$user_name";
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Painel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Painel</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Ver Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Ver Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Ver Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Ver Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        <b>Total de Chamados Cadastrados em <?php echo date('Y');?></b>
                                    </div>
                                    <div class="card-body"><div id="graf_pizza_3d" style="width: 480px; height: 380px;"></div></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        <b>Total de Chamados Cadastrados por Setor</b>
                                    </div>
                                    <div class="card-body"><div id="graf_barras" style="width: 480px; height: 380px;"></div></div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <b>Tabela de Pacientes Cadastrados</b>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr>
                                        <tr>
                                            <td>Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                        </tr>
                                        <tr>
                                            <td>Brielle Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>61</td>
                                            <td>2012/12/02</td>
                                            <td>$372,000</td>
                                        </tr>
                                        <tr>
                                            <td>Herrod Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>59</td>
                                            <td>2012/08/06</td>
                                            <td>$137,500</td>
                                        </tr>
                                        <tr>
                                            <td>Rhona Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>55</td>
                                            <td>2010/10/14</td>
                                            <td>$327,900</td>
                                        </tr>
                                        <tr>
                                            <td>Colleen Hurst</td>
                                            <td>Javascript Developer</td>
                                            <td>San Francisco</td>
                                            <td>39</td>
                                            <td>2009/09/15</td>
                                            <td>$205,500</td>
                                        </tr>
                                        <tr>
                                            <td>Sonya Frost</td>
                                            <td>Software Engineer</td>
                                            <td>Edinburgh</td>
                                            <td>23</td>
                                            <td>2008/12/13</td>
                                            <td>$103,600</td>
                                        </tr>
                                        <tr>
                                            <td>Jena Gaines</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>30</td>
                                            <td>2008/12/19</td>
                                            <td>$90,560</td>
                                        </tr>
                                        <tr>
                                            <td>Quinn Flynn</td>
                                            <td>Support Lead</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2013/03/03</td>
                                            <td>$342,000</td>
                                        </tr>
                                        <tr>
                                            <td>Charde Marshall</td>
                                            <td>Regional Director</td>
                                            <td>San Francisco</td>
                                            <td>36</td>
                                            <td>2008/10/16</td>
                                            <td>$470,600</td>
                                        </tr>
                                        <tr>
                                            <td>Haley Kennedy</td>
                                            <td>Senior Marketing Designer</td>
                                            <td>London</td>
                                            <td>43</td>
                                            <td>2012/12/18</td>
                                            <td>$313,500</td>
                                        </tr>
                                        <tr>
                                            <td>Tatyana Fitzpatrick</td>
                                            <td>Regional Director</td>
                                            <td>London</td>
                                            <td>19</td>
                                            <td>2010/03/17</td>
                                            <td>$385,750</td>
                                        </tr>
                                        <tr>
                                            <td>Michael Silva</td>
                                            <td>Marketing Designer</td>
                                            <td>London</td>
                                            <td>66</td>
                                            <td>2012/11/27</td>
                                            <td>$198,500</td>
                                        </tr>
                                        <tr>
                                            <td>Paul Byrd</td>
                                            <td>Chief Financial Officer (CFO)</td>
                                            <td>New York</td>
                                            <td>64</td>
                                            <td>2010/06/09</td>
                                            <td>$725,000</td>
                                        </tr>
                                        <tr>
                                            <td>Gloria Little</td>
                                            <td>Systems Administrator</td>
                                            <td>New York</td>
                                            <td>59</td>
                                            <td>2009/04/10</td>
                                            <td>$237,500</td>
                                        </tr>
                                        <tr>
                                            <td>Bradley Greer</td>
                                            <td>Software Engineer</td>
                                            <td>London</td>
                                            <td>41</td>
                                            <td>2012/10/13</td>
                                            <td>$132,000</td>
                                        </tr>
                                        <tr>
                                            <td>Dai Rios</td>
                                            <td>Personnel Lead</td>
                                            <td>Edinburgh</td>
                                            <td>35</td>
                                            <td>2012/09/26</td>
                                            <td>$217,500</td>
                                        </tr>
                                        <tr>
                                            <td>Jenette Caldwell</td>
                                            <td>Development Lead</td>
                                            <td>New York</td>
                                            <td>30</td>
                                            <td>2011/09/03</td>
                                            <td>$345,000</td>
                                        </tr>
                                        <tr>
                                            <td>Yuri Berry</td>
                                            <td>Chief Marketing Officer (CMO)</td>
                                            <td>New York</td>
                                            <td>40</td>
                                            <td>2009/06/25</td>
                                            <td>$675,000</td>
                                        </tr>
                                        <tr>
                                            <td>Caesar Vance</td>
                                            <td>Pre-Sales Support</td>
                                            <td>New York</td>
                                            <td>21</td>
                                            <td>2011/12/12</td>
                                            <td>$106,450</td>
                                        </tr>
                                        <tr>
                                            <td>Doris Wilder</td>
                                            <td>Sales Assistant</td>
                                            <td>Sidney</td>
                                            <td>23</td>
                                            <td>2010/09/20</td>
                                            <td>$85,600</td>
                                        </tr>
                                        <tr>
                                            <td>Angelica Ramos</td>
                                            <td>Chief Executive Officer (CEO)</td>
                                            <td>London</td>
                                            <td>47</td>
                                            <td>2009/10/09</td>
                                            <td>$1,200,000</td>
                                        </tr>
                                        <tr>
                                            <td>Gavin Joyce</td>
                                            <td>Developer</td>
                                            <td>Edinburgh</td>
                                            <td>42</td>
                                            <td>2010/12/22</td>
                                            <td>$92,575</td>
                                        </tr>
                                        <tr>
                                            <td>Jennifer Chang</td>
                                            <td>Regional Director</td>
                                            <td>Singapore</td>
                                            <td>28</td>
                                            <td>2010/11/14</td>
                                            <td>$357,650</td>
                                        </tr>
                                        <tr>
                                            <td>Brenden Wagner</td>
                                            <td>Software Engineer</td>
                                            <td>San Francisco</td>
                                            <td>28</td>
                                            <td>2011/06/07</td>
                                            <td>$206,850</td>
                                        </tr>
                                        <tr>
                                            <td>Fiona Green</td>
                                            <td>Chief Operating Officer (COO)</td>
                                            <td>San Francisco</td>
                                            <td>48</td>
                                            <td>2010/03/11</td>
                                            <td>$850,000</td>
                                        </tr>
                                        <tr>
                                            <td>Shou Itou</td>
                                            <td>Regional Marketing</td>
                                            <td>Tokyo</td>
                                            <td>20</td>
                                            <td>2011/08/14</td>
                                            <td>$163,000</td>
                                        </tr>
                                        <tr>
                                            <td>Michelle House</td>
                                            <td>Integration Specialist</td>
                                            <td>Sidney</td>
                                            <td>37</td>
                                            <td>2011/06/02</td>
                                            <td>$95,400</td>
                                        </tr>
                                        <tr>
                                            <td>Suki Burks</td>
                                            <td>Developer</td>
                                            <td>London</td>
                                            <td>53</td>
                                            <td>2009/10/22</td>
                                            <td>$114,500</td>
                                        </tr>
                                        <tr>
                                            <td>Prescott Bartlett</td>
                                            <td>Technical Author</td>
                                            <td>London</td>
                                            <td>27</td>
                                            <td>2011/05/07</td>
                                            <td>$145,000</td>
                                        </tr>
                                        <tr>
                                            <td>Gavin Cortez</td>
                                            <td>Team Leader</td>
                                            <td>San Francisco</td>
                                            <td>22</td>
                                            <td>2008/10/26</td>
                                            <td>$235,500</td>
                                        </tr>
                                        <tr>
                                            <td>Martena Mccray</td>
                                            <td>Post-Sales support</td>
                                            <td>Edinburgh</td>
                                            <td>46</td>
                                            <td>2011/03/09</td>
                                            <td>$324,050</td>
                                        </tr>
                                        <tr>
                                            <td>Unity Butler</td>
                                            <td>Marketing Designer</td>
                                            <td>San Francisco</td>
                                            <td>47</td>
                                            <td>2009/12/09</td>
                                            <td>$85,675</td>
                                        </tr>
                                        <tr>
                                            <td>Howard Hatfield</td>
                                            <td>Office Manager</td>
                                            <td>San Francisco</td>
                                            <td>51</td>
                                            <td>2008/12/16</td>
                                            <td>$164,500</td>
                                        </tr>
                                        <tr>
                                            <td>Hope Fuentes</td>
                                            <td>Secretary</td>
                                            <td>San Francisco</td>
                                            <td>41</td>
                                            <td>2010/02/12</td>
                                            <td>$109,850</td>
                                        </tr>
                                        <tr>
                                            <td>Vivian Harrell</td>
                                            <td>Financial Controller</td>
                                            <td>San Francisco</td>
                                            <td>62</td>
                                            <td>2009/02/14</td>
                                            <td>$452,500</td>
                                        </tr>
                                        <tr>
                                            <td>Timothy Mooney</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>37</td>
                                            <td>2008/12/11</td>
                                            <td>$136,200</td>
                                        </tr>
                                        <tr>
                                            <td>Jackson Bradshaw</td>
                                            <td>Director</td>
                                            <td>New York</td>
                                            <td>65</td>
                                            <td>2008/09/26</td>
                                            <td>$645,750</td>
                                        </tr>
                                        <tr>
                                            <td>Olivia Liang</td>
                                            <td>Support Engineer</td>
                                            <td>Singapore</td>
                                            <td>64</td>
                                            <td>2011/02/03</td>
                                            <td>$234,500</td>
                                        </tr>
                                        <tr>
                                            <td>Bruno Nash</td>
                                            <td>Software Engineer</td>
                                            <td>London</td>
                                            <td>38</td>
                                            <td>2011/05/03</td>
                                            <td>$163,500</td>
                                        </tr>
                                        <tr>
                                            <td>Sakura Yamamoto</td>
                                            <td>Support Engineer</td>
                                            <td>Tokyo</td>
                                            <td>37</td>
                                            <td>2009/08/19</td>
                                            <td>$139,575</td>
                                        </tr>
                                        <tr>
                                            <td>Thor Walton</td>
                                            <td>Developer</td>
                                            <td>New York</td>
                                            <td>61</td>
                                            <td>2013/08/11</td>
                                            <td>$98,540</td>
                                        </tr>
                                        <tr>
                                            <td>Finn Camacho</td>
                                            <td>Support Engineer</td>
                                            <td>San Francisco</td>
                                            <td>47</td>
                                            <td>2009/07/07</td>
                                            <td>$87,500</td>
                                        </tr>
                                        <tr>
                                            <td>Serge Baldwin</td>
                                            <td>Data Coordinator</td>
                                            <td>Singapore</td>
                                            <td>64</td>
                                            <td>2012/04/09</td>
                                            <td>$138,575</td>
                                        </tr>
                                        <tr>
                                            <td>Zenaida Frank</td>
                                            <td>Software Engineer</td>
                                            <td>New York</td>
                                            <td>63</td>
                                            <td>2010/01/04</td>
                                            <td>$125,250</td>
                                        </tr>
                                        <tr>
                                            <td>Zorita Serrano</td>
                                            <td>Software Engineer</td>
                                            <td>San Francisco</td>
                                            <td>56</td>
                                            <td>2012/06/01</td>
                                            <td>$115,000</td>
                                        </tr>
                                        <tr>
                                            <td>Jennifer Acosta</td>
                                            <td>Junior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>43</td>
                                            <td>2013/02/01</td>
                                            <td>$75,650</td>
                                        </tr>
                                        <tr>
                                            <td>Cara Stevens</td>
                                            <td>Sales Assistant</td>
                                            <td>New York</td>
                                            <td>46</td>
                                            <td>2011/12/06</td>
                                            <td>$145,600</td>
                                        </tr>
                                        <tr>
                                            <td>Hermione Butler</td>
                                            <td>Regional Director</td>
                                            <td>London</td>
                                            <td>47</td>
                                            <td>2011/03/21</td>
                                            <td>$356,250</td>
                                        </tr>
                                        <tr>
                                            <td>Lael Greer</td>
                                            <td>Systems Administrator</td>
                                            <td>London</td>
                                            <td>21</td>
                                            <td>2009/02/27</td>
                                            <td>$103,500</td>
                                        </tr>
                                        <tr>
                                            <td>Jonas Alexander</td>
                                            <td>Developer</td>
                                            <td>San Francisco</td>
                                            <td>30</td>
                                            <td>2010/07/14</td>
                                            <td>$86,500</td>
                                        </tr>
                                        <tr>
                                            <td>Shad Decker</td>
                                            <td>Regional Director</td>
                                            <td>Edinburgh</td>
                                            <td>51</td>
                                            <td>2008/11/13</td>
                                            <td>$183,000</td>
                                        </tr>
                                        <tr>
                                            <td>Michael Bruce</td>
                                            <td>Javascript Developer</td>
                                            <td>Singapore</td>
                                            <td>29</td>
                                            <td>2011/06/27</td>
                                            <td>$183,000</td>
                                        </tr>
                                        <tr>
                                            <td>Donna Snider</td>
                                            <td>Customer Support</td>
                                            <td>New York</td>
                                            <td>27</td>
                                            <td>2011/01/25</td>
                                            <td>$112,000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>-->
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">
                                <a style="text-decoration: none; color: black;" href="https://www.cvacentertech.com.br"><img class="text-muted fw-light" style="width: 12rem;" src="../img/logo_p.svg"><b>Copyright <?= date('Y');?></b></a>
                            
                            </div>
                            <div>
                                <a href="#">Política de Privacidade</a>
                                &middot;
                                <a href="#">Termos &amp; Condições</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="js/scripts.js"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="bootstrap_4.1/js/bootstrap.min.js"></script>
        <script src="font-awesome_5.15.4/js/all.min.js"></script>
        <script src="js/google-charts-loader.js"></script>
        
        <!--Preloader-->
        <script>
          $(window).on('load', function () {
            $('#preloader .inner').fadeOut();
            $('#preloader').delay(400).fadeOut('slow'); 
            $('body').delay(400).css({'overflow': 'visible'});
          })
        </script>

        <!-- Gráfico pizza -->
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Mês', 'Total'],
                <?php
                    $data = date('Y');
                    //Buscando no banco o total de pacientes cadastrados por mês dentro do ano
                    $result = "SELECT month(chamados.data_cad_chamado) AS mes, COUNT(chamados.data_cad_chamado) AS total FROM chamados WHERE chamados.data_cad_chamado LIKE '$data%' GROUP BY month(chamados.data_cad_chamado) ORDER BY `mes` ASC";
                    $resultado = mysqli_query($conn, $result);
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $mes = $row['mes'];
                        if ($mes == 1) {
                            $mes = "Janeiro";
                        } elseif ($mes == 2) {
                            $mes = "Fevereiro";
                        } elseif ($mes == 3) {
                            $mes = "Março";
                        } elseif ($mes == 4) {
                            $mes = "Abril";
                        } elseif ($mes == 5) {
                            $mes = "Maio";
                        } elseif ($mes == 6) {
                            $mes = "Junho";
                        } elseif ($mes == 7) {
                            $mes = "Julho";
                        } elseif ($mes == 8) {
                            $mes = "Agosto";
                        } elseif ($mes == 9) {
                            $mes = "Setembro";
                        } elseif ($mes == 10) {
                            $mes = "Outubro";
                        } elseif ($mes == 11) {
                            $mes = "Novembro";
                        } elseif ($mes == 12) {
                            $mes = "Dezembro";
                        } 
                        $quantidade = $row['total'];
                        echo "['$mes', $quantidade],";
                    };
                ?>
              ]);

              var options = {
                //title: 'Total de Pacientes Cadastrados em 2022',
                titleTextStyle: {color: 'black', fontName: 'Arial', fontSize: 25},//Estilo do título
                legend: {position: 'right'/*bottom,labeled,left,'none,top*/, alignment: 'center', textStyle: {color: 'black', fontSize: 15, italic: true, bold: true}},//Estilo da legenda
                pieSliceText: 'porcentage',//porcentage, value, label, none /Conteúdo exibido dentro da fatia
                //colors:['red','#004411', 'blue','gray'],//Cor do gráfico geral
                //chartArea: {left:20,top:80,width:'50%',height:'75%'},//Posicionamento do gráfico
                //pieStartAngle: 25,//Rotacionar o gráfico
                //slices: { 1: {offset: 0.3}, 4: {offset: 0.3}, 11: {offset: 0.3}},//Retirar fatia
                sliceVisibilityThreshold: .5/360,
                pieSliceTextStyle: {color: 'white', fontName: 'Arial', fontSize: 15},//Texto dentro da fatia
                //slices: [{color: 'green'}, {}, {}, {color: 'gray'}],//{0: {color: 'black'}, 3: {color: 'red'}},//Cor por fatia
                tooltip: {text: 'both',/*both,porcentage,value*/ textStyle: {color: 'Black', italic: true, bold: true}, showColorCode: true/*, trigger: 'focus' selection,focus,none/ isHtml: true*/},//Estilo do título do popup dentro da fatia
                is3D: true
              };

              var chart = new google.visualization.PieChart(document.getElementById('graf_pizza_3d'));
              //Habilitar a impressão do gráfico como img.png
              /*google.visualization.events.addListener(chart, 'ready', function () {
                graf_pizza_3d.innerHTML = '<img src="' + chart.getImageURI() + '">';
                console.log(graf_pizza_3d.innerHTML);
              });*/
              chart.draw(data, options);

            }
        </script>

        <!-- Gráfico de barras -->
        <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart2);

            function drawChart2() {
              var data = google.visualization.arrayToDataTable([
                ['Setores', 'Ano de <?php echo $data; ?>'/*, 'Ano de 2021'*/],
                <?php
                    //Buscando no banco a quantidade total de cadastros e total de cadastros por setor
                    $result2 = "SELECT chamados.setores_setor_id, setores.nome_setor, COUNT(setores.nome_setor) AS totalSetor FROM chamados INNER JOIN setores ON chamados.setores_setor_id = setores.setor_id WHERE chamados.data_cad_chamado LIKE'$data%' GROUP BY setores.setor_id ORDER BY setores.setor_id ASC";
                    $resultado2 = mysqli_query($conn, $result2);
                    while ($linha = mysqli_fetch_assoc($resultado2)) {

                        $nome_setor = mb_convert_encoding($linha['nome_setor'], 'UTF-8', 'ISO-8859-1');
                        $totalSetor = $linha['totalSetor'];
                         echo "['$nome_setor', $totalSetor],";
                    };
                ?>
              ]);

              var options = {
                //chart: {/*title: 'Quantidade Total de Cadastros nos Últimos 2 Anos',subtitle: 'Sales, Expenses, and Profit: 2014-2017',*/},
              
                hAxis: {title: 'Total de Cadastros', minValue: 0, textStyle: {bold: true, fontSize: 18, color: '#4d4d4d'}, titleTextStyle: {fontSize: 18, bold: true, color: 'Black'}, format: ''/*Short, Decimal*/},

                vAxis: {title: 'Setores', textStyle: {fontSize: 15, bold: false, italic: true, color: '#848484'}, titleTextStyle: {fontSize: 18, bold: true, color: 'Black'}},

                bars: 'horizontal', //Necessário para gráficos de barras do tipo barchart_material

                //height: 300//Largura da barra
                //colors: ['#1b9e77', '#d95f02']//cor da barra

              };

              var chart = new google.charts.Bar(document.getElementById('graf_barras'));

              chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    </body>
</html>
