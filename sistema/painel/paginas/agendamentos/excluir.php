<?php 
$tabela = 'agendamentos';
require_once("../../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cliente = $res[0]['cliente'];
$usuario = $res[0]['funcionario'].'';
$data = $res[0]['data'];
$hora = $res[0]['hora'];
$hash = $res[0]['hash'];

$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

$query = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = $res[0]['nome'];

$pdo->query("DELETE FROM $tabela where id = '$id'");
$pdo->query("DELETE FROM horarios_agd where agendamento = '$id'");

echo 'Excluído com Sucesso';

if($hash != ""){
	require('../../../../ajax/api-excluir.php');
}

if($not_sistema == 'Sim'){
	$mensagem_not = $nome_cliente;
	$titulo_not = 'Agendamento Cancelado '.$dataF.' - '.$horaF;
	$id_usu = $usuario;
	require('../../../../api/notid.php');
} 

?>