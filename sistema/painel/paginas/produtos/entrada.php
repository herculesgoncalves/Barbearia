<?php 
require_once("../../../conexao.php");
$tabela = 'entradas';
@session_start();
$id_usuario = $_SESSION['id'];

$id_produto = $_POST['id'];
$estoque = $_POST['estoque'];
$quantidade_entrada = $_POST['quantidade_entrada'];
$motivo_entrada = $_POST['motivo_entrada'];

$novo_estoque = $estoque + $quantidade_entrada;

$query = $pdo->prepare("INSERT INTO $tabela SET produto = '$id_produto', quantidade = '$quantidade_entrada', motivo = :motivo, usuario = '$id_usuario', data = curDate()");


$query->bindValue(":motivo", "$motivo_entrada");
$query->execute();


//atualizar o total no estoque do produto
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'");

echo 'Salvo com Sucesso';
 ?>