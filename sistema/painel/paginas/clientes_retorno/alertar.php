<?php 
require_once("../../../conexao.php");
$tabela = 'clientes';

$id = $_POST['id'];

$pdo->query("UPDATE $tabela SET alertado = 'Sim' WHERE id = '$id'");
echo 'Salvo com Sucesso';
 ?>