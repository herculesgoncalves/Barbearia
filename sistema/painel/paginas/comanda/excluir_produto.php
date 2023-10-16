<?php 
require_once("../../../conexao.php");
$tabela = 'receber';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM receber where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produto = $res[0]['produto'];
$quantidade = $res[0]['quantidade'];

$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];

//atualizar estoque do produto
$total_estoque = $estoque + $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_estoque' WHERE id = '$produto'");

$pdo->query("DELETE from $tabela where id = '$id'");


 ?>