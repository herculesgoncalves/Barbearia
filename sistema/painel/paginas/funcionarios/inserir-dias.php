<?php 
require_once("../../../conexao.php");
$tabela = 'dias';

$id = $_POST['id'];
$id_dias = $_POST['id_d'];
$dias = $_POST['dias'];
$inicio = $_POST['inicio'];
$final = $_POST['final'];
$inicio_almoco = $_POST['inicio_almoco'];
$final_almoco = $_POST['final_almoco'];

if($id_dias == ''){
	$pdo->query("INSERT INTO $tabela SET dia = '$dias',  inicio = '$inicio',  final = '$final', funcionario = '$id', inicio_almoco = '$inicio_almoco', final_almoco = '$final_almoco'");
}else{
	$pdo->query("UPDATE $tabela SET dia = '$dias',  inicio = '$inicio',  final = '$final', funcionario = '$id', inicio_almoco = '$inicio_almoco', final_almoco = '$final_almoco' WHERE id = '$id_dias'");
}



echo 'Salvo com Sucesso';
 ?>