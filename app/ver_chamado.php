<?php
  include_once "../includes/conexao.php";

//Recebendo id pela url
$chamado_id = filter_input(INPUT_GET, 'chamado_id', FILTER_SANITIZE_NUMBER_INT);
if (!empty($chamado_id)) {
  $retorna = ['status' => true, 'dados' => $chamado_id];
}else {
  $retorna = ['status' => false, 'msg' => "<div class='alert-danger' role='alert'>Erro: Nenhum id encontrado!</div>"];
}
echo json_encode($retorna);
?>