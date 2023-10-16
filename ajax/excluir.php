<?php 
require_once("../sistema/conexao.php");

$id = @$_POST['id'];

$query = $pdo->query("SELECT * FROM agendamentos where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cliente = $res[0]['cliente'];
$usuario = $res[0]['funcionario'].'';
$data = $res[0]['data'];
$hora = $res[0]['hora'];
$servico = $res[0]['servico'];
$hash = $res[0]['hash'];

$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

$query = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = $res[0]['nome'];
$telefone = $res[0]['telefone'];

$pdo->query("DELETE FROM agendamentos where id = '$id'");
$pdo->query("DELETE FROM horarios_agd where agendamento = '$id'");

echo 'Cancelado com Sucesso';

if($not_sistema == 'Sim'){
	$mensagem_not = $nome_cliente;
	$titulo_not = 'Agendamento Cancelado '.$dataF.' - '.$horaF;
	$id_usu = $usuario;
	require('../api/notid.php');
} 



if($msg_agendamento == 'Api'){

$query = $pdo->query("SELECT * FROM usuarios where id = '$usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_func = $res[0]['nome'];
$tel_func = $res[0]['telefone'];

$query = $pdo->query("SELECT * FROM servicos where id = '$servico' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_serv = $res[0]['nome'];


$mensagem = '_Agendamento Cancelado_ %0A';
$mensagem .= 'Profissional: *'.$nome_func.'* %0A';
$mensagem .= 'Serviço: *'.$nome_serv.'* %0A';
$mensagem .= 'Data: *'.$dataF.'* %0A';
$mensagem .= 'Hora: *'.$horaF.'* %0A';
$mensagem .= 'Cliente: *'.$nome_cliente.'* %0A';

$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

require('api-texto.php');

if($tel_func != $whatsapp_sistema){
	$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $tel_func);
	require('api-texto.php');	
}

if($hash != ""){
	require('api-excluir.php');
}
}

?>