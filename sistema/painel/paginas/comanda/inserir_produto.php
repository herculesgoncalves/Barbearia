<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');

@session_start();
$usuario_logado = @$_SESSION['id'];

$cliente = $_POST['cliente'];
$id = @$_POST['id'];
$funcionario = $_POST['funcionario'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];

if($id == ""){
	$id = 0;
}


$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$descricao = 'Venda - ('.$quantidade.') '.$res[0]['nome'];
$estoque = $res[0]['estoque'];
$valor = $res[0]['valor_venda'];

$valor =  $valor * $quantidade;

if($quantidade > $estoque){
	echo 'Você não pode vendar mais do que você possui em estoque! Você tem '.$estoque. ' produtos em estoque!';
	exit();
}

//atualizar dados do produto
$total_estoque = $estoque - $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_estoque' WHERE id = '$produto'");


$query = $pdo->prepare("INSERT INTO $tabela SET descricao = :descricao, tipo = 'Venda', valor = :valor, data_lanc = curDate(), data_venc = curDate(), usuario_lanc = '$usuario_logado', foto = 'sem-foto.jpg', pessoa = '$cliente', pago = 'Não', produto = '$produto', quantidade = '$quantidade', func_comanda = '$usuario_logado', comanda = '$id', funcionario = '$funcionario', valor2 = '$valor'");

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->execute();


echo 'Salvo com Sucesso'; 

?>