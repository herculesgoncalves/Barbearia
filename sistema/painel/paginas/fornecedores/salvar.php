<?php 
require_once("../../../conexao.php");
$tabela = 'fornecedores';

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$tipo_chave = $_POST['tipo_chave'];
$chave_pix = $_POST['chave_pix'];


//validar tel
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0 and $id != $res[0]['id']){
	echo 'Telefone já Cadastrado, escolha outro!!';
	exit();
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, data_cad = curDate(), endereco = :endereco, tipo_chave = '$tipo_chave', chave_pix = :chave_pix");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone,  endereco = :endereco, tipo_chave = '$tipo_chave', chave_pix = :chave_pix WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":chave_pix", "$chave_pix");
$query->execute();

echo 'Salvo com Sucesso';
 ?>