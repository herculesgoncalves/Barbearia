<?php
header('Access-Control-Allow-Origin: *');

require_once("../sistema/conexao.php");

$dados = json_decode(file_get_contents('php://input'), false);

$id = $dados->id;
$status = $dados->status;

if ($status == '1') {
  //$pdo->query("UPDATE agendamentos SET status = 'Confirmado' where id = '$id'");
}else{
  $pdo->query("DELETE FROM agendamentos where id = '$id'");
  $pdo->query("DELETE FROM horarios_agd where agendamento = '$id'");
}



?>