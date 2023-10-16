<?php 
require_once("../../../conexao.php");
$tabela = 'textos_index';

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET titulo = :titulo, descricao = :descricao");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET titulo = :titulo, descricao = :descricao WHERE id = '$id'");
}

$query->bindValue(":titulo", "$titulo");
$query->bindValue(":descricao", "$descricao");
$query->execute();

echo 'Salvo com Sucesso';
 ?>