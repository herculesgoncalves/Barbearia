<?php 
require_once("../../../conexao.php");
$tabela = 'saidas';
@session_start();
$id_usuario = $_SESSION['id'];

$id_produto = $_POST['id'];
$estoque = $_POST['estoque'];
$quantidade_saida = $_POST['quantidade_saida'];
$motivo_saida = $_POST['motivo_saida'];

$novo_estoque = $estoque - $quantidade_saida;

$query = $pdo->prepare("INSERT INTO $tabela SET produto = '$id_produto', quantidade = '$quantidade_saida', motivo = :motivo, usuario = '$id_usuario', data = curDate()");


$query->bindValue(":motivo", "$motivo_saida");
$query->execute();


//atualizar o total no estoque do produto
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'");

echo 'Salvo com Sucesso';
 ?>