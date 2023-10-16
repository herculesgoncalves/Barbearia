<?php 
require_once("../../../conexao.php");
$tabela = 'marketing';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['arquivo'];
$audio = $res[0]['audio'];

if($foto != "sem-foto.jpg"){
	@unlink('../../img/marketing/'.$foto);
}

@unlink('../../img/marketing/'.$audio);

$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso';
 ?>