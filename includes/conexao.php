<?php

	//error_reporting(0);

	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "cva_help_desk";

	if ($conn = mysqli_connect($server, $user, $password, $db)) {
		//echo "<div class='alert alert-success' role='alert'>Conexão com o banco de dados realizada com sucesso !</div>";
	} else {
		//$_SESSION['conexaoError'] = "<h4 id='errorConexao'><i class='fas fa-exclamation-triangle'></i> Não foi possível estabelecer uma conexão com o banco de dados !</h4>";
      	//header("Location: ../index.php");
      	//die();
		//echo "<h1 align='center'><div class='alert alert-danger' role='alert' autofocus>Não foi possível estabelecer uma conexão com o banco de dados !</div></h1>";
		session_destroy();
		header('Location: http://192.168.12.171:9000/cva_help_desk/includes/error-connection-database.php');
	}

	//Função para mostrar data no formato brasileiro
	function invert_data($data) {
		$d = explode('-', $data);
		$escreve = $d[2] . "/" . $d[1] . "/" . $d[0];
		return $escreve;
	}

	function invert_data2($data) {
		
		return date('d/m/Y H:i:s', strtotime($data));
	}
/*define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'protocolos');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('<h1>Não foi possível conectar a base de dados !</h1>');*/