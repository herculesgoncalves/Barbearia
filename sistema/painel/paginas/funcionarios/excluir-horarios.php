<?php 
require_once("../../../conexao.php");
$tabela = 'horarios';

$id = $_POST['id'];


$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso';
 ?>