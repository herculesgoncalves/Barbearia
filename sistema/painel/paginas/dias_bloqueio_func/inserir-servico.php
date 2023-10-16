<?php 
require_once("../../../conexao.php");
$tabela = 'dias_bloqueio';

@session_start();
$id_usuario = $_SESSION['id'];

$data = $_POST['data'];
$func = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where data = '$data'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo 'Data já adicionada!';
	exit();
}

$pdo->query("INSERT INTO $tabela SET data = '$data', funcionario = '$id_usuario', usuario = '$func'");

echo 'Salvo com Sucesso';
 ?>