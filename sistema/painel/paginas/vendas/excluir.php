<?php 
require_once("../../../conexao.php");
$tabela = 'receber';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['foto'];
$produto = $res[0]['produto'];
$quantidade = $res[0]['quantidade'];

if($foto != "sem-foto.jpg"){
	@unlink('../../img/contas/'.$foto);
}

$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$estoque = $res[0]['estoque'];

$total_estoque = $estoque + $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_estoque' WHERE id = '$produto'");


$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso';
 ?>