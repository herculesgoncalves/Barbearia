<?php 
require_once("../../../conexao.php");
$tabela = 'horarios';

$id = $_POST['id'];
$horario = $_POST['horario'];
$data = @$_POST['data'];

if($data == ""){
	$pdo->query("INSERT INTO $tabela SET horario = '$horario', funcionario = '$id'");
}else{
	$pdo->query("INSERT INTO $tabela SET horario = '$horario', funcionario = '$id', data = '$data'");
}



echo 'Salvo com Sucesso';
 ?>