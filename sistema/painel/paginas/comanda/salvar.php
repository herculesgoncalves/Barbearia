<?php 
$tabela = 'comandas';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');

@session_start();
$usuario_logado = @$_SESSION['id'];

$cliente = $_POST['cliente'];
$valor = $_POST['valor_serv'];
$id = @$_POST['id'];
$obs = @$_POST['obs'];


if($valor == "" or $valor <= 0){
	echo 'Insira serviço ou produto';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET cliente = :cliente, valor = :valor, data = curDate(), funcionario = '$usuario_logado', status = 'Aberta', obs = :obs");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET cliente = :cliente, valor = :valor, obs = :obs WHERE id = '$id'");
}



$query->bindValue(":cliente", "$cliente");
$query->bindValue(":valor", "$valor");
$query->bindValue(":obs", "$obs");
$query->execute();
$ult_id = $pdo->lastInsertId();

$pdo->query("UPDATE receber SET comanda = '$ult_id' WHERE func_comanda = '$usuario_logado' and comanda = 0 ");

echo 'Salvo com Sucesso*'.$ult_id; 

?>

