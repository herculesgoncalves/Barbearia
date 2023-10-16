<?php 
require_once("../../../conexao.php");
$tabela = 'pagar';
@session_start();
$id_usuario = $_SESSION['id'];


$id = $_POST['id'];

$pdo->query("UPDATE $tabela SET pago = 'Sim', usuario_baixa = '$id_usuario', data_pgto = curDate() where id = '$id'");

echo 'Baixado com Sucesso';
 ?>