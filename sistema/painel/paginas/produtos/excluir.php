<?php 
require_once("../../../conexao.php");
$tabela = 'produtos';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['foto'];

if($foto != "sem-foto.jpg"){
	@unlink('../../img/produtos/'.$foto);
}

$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso';
 ?>