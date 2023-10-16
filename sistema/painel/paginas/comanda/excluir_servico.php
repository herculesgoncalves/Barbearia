<?php 
require_once("../../../conexao.php");
$tabela = 'receber';

$id = $_POST['id'];

$pdo->query("DELETE from $tabela where id = '$id'");
$pdo->query("DELETE from pagar where id_ref = '$id'");

 ?>