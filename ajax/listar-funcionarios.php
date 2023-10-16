<?php 
require_once("../sistema/conexao.php");

$serv = $_POST['serv'];

$query = $pdo->query("SELECT * FROM usuarios where ativo = 'Sim' and atendimento = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);	
echo '<option value="">'.$texto_agendamento.'</option>';
if(@count($res) > 0){
	for($i=0; $i < @count($res); $i++){
		$nome_func = @$res[$i]['nome'];
		$func = @$res[$i]['id'];

		$query2 = $pdo->query("SELECT * FROM servicos_func where servico = '$serv' and funcionario = '$func'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);	
		if(@count($res2) > 0){
			echo '<option value="'.$func.'">'.$nome_func.'</option>';
		}
	}
}




?>

