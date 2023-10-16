<?php 
require_once("../../sistema/conexao.php");

$tabela = 'receber';

$foto = $_POST['nome_foto'];
$id_usuario = $_POST['id_usuario'];
$id = $_POST['id'];
$produto = $_POST['produto'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$pessoa = $_POST['pessoa'];
$data_venc = $_POST['data_venc'];
$data_pgto = $_POST['data_pgto'];
$quantidade = $_POST['quantidade'];
$pgto = $_POST['pgto'];

if($produto == 0 || $produto == ""){
	echo 'Cadastre um Produto e Depois selecione!';
	exit();
}



$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$descricao = 'Venda - ('.$quantidade.') '.$res[0]['nome'];
$estoque = $res[0]['estoque'];

if($data_pgto != ''){
	$usuario_pgto = $id_usuario;
	$pago = 'Sim';
}else{
	$usuario_pgto = 0;
	$pago = 'Não';
}


if($quantidade > $estoque){
	echo 'Você não pode vendar mais do que você possui em estoque! Você tem '.$estoque. ' produtos em estoque!';
	exit();
}


//atualizar dados do produto
$total_estoque = $estoque - $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_estoque' WHERE id = '$produto'");





if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET descricao = :descricao, tipo = 'Venda', valor = :valor, data_lanc = curDate(), data_venc = '$data_venc', data_pgto = '$data_pgto', usuario_lanc = '$id_usuario', usuario_baixa = '$usuario_pgto', foto = '$foto', pessoa = '$pessoa', pago = '$pago', produto = '$produto', quantidade = '$quantidade', pgto = '$pgto'");

}else{

//tratamento para trocar a foto e apagar a antiga
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto_antiga = $res[0]['foto'];

if($foto_antiga != "sem-foto.jpg" and $foto != $foto_antiga){	
	unlink("../../sistema/painel/img/contas/".$foto_antiga);	
}


$query = $pdo->prepare("UPDATE $tabela SET descricao = :descricao, valor = :valor, data_venc = '$data_venc', data_pgto = '$data_pgto', foto = '$foto', pessoa = '$pessoa', produto = '$produto', quantidade = '$quantidade' WHERE id = '$id'");

}

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->execute();

echo 'Salvo';

/*
//enviar notificação
$mensagem_not = 'Usuário '.$nome;
$titulo_not = 'Novo Usuário Cadastrado!';
require("../not.php");
*/

 ?>