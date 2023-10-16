<?php 
require_once("../../../conexao.php");
$tabela = 'textos_index';

$id = $_POST['id'];

$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso';
?>