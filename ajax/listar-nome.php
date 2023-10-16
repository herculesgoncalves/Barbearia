<?php 
@session_start();
require_once("../sistema/conexao.php");
$data = date('Y-m-d');
$tel = @$_POST['tel'];

if($tel == ""){
	exit();
}

@$_SESSION['telefone'] = $tel;


$query = $pdo->query("SELECT * FROM clientes where telefone LIKE '$tel' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome = $res[0]['nome'];
	$id_cliente = $res[0]['id'];
	
}

//buscar agendamento
if(@$id_cliente != ""){
	$query = $pdo->query("SELECT * FROM agendamentos where cliente = '$id_cliente' and status = 'Agendado' order by id desc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0){
		$data = $res[0]['data'];
		$funcionario = $res[0]['funcionario'];
		$id = $res[0]['id'];
		$hora = $res[0]['hora'];
		$servico = $res[0]['servico'];
		$obs = $res[0]['obs'];


		$query = $pdo->query("SELECT * FROM usuarios where id LIKE '$funcionario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_func = $res[0]['nome'];
	}


		$query = $pdo->query("SELECT * FROM servicos where id LIKE '$servico' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_serv = $res[0]['nome'];
	}



		$horaF = date("H:i", strtotime($hora));

		$dataF = implode('/', array_reverse(explode('-', $data)));

	}

	echo @$nome.'*'.@$data.'*'.@$funcionario.'*'.@$id.'*'.@$horaF.'*'.@$servico.'*'.@$obs.'*'.@$dataF.'*'.@$nome_func.'*'.@$nome_serv;
}else{
	echo '*'.@$data;
}




?>

