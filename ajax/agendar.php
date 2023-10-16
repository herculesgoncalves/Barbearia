<?php 
require_once("../sistema/conexao.php");
@session_start();
$telefone = $_POST['telefone'];
$nome = $_POST['nome'];
$funcionario = $_POST['funcionario'];
$hora = @$_POST['hora'];
$servico = $_POST['servico'];
$obs = $_POST['obs'];
$data = @$_POST['data'];
$data_agd = @$_POST['data'];
$hora_do_agd = @$_POST['hora'];
$id = @$_POST['id'];

$hash = "";

if($telefone == $whatsapp_sistema){
	echo 'Insira seu Telefone!';
	exit();
}


$tel_cli = $_POST['telefone'];

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$intervalo = $res[0]['intervalo'];

$query = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$tempo = $res[0]['tempo'];


$hora_minutos = strtotime("+$tempo minutes", strtotime($hora));			
$hora_final_servico = date('H:i:s', $hora_minutos);

$nova_hora = $hora;



$diasemana = array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sabado");
$diasemana_numero = date('w', strtotime($data));
$dia_procurado = $diasemana[$diasemana_numero];

//percorrer os dias da semana que ele trabalha
$query = $pdo->query("SELECT * FROM dias where funcionario = '$funcionario' and dia = '$dia_procurado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0){
		echo 'Este Profissional não trabalha neste Dia!';
	exit();
}else{
	$inicio = $res[0]['inicio'];
	$final = $res[0]['final'];
	$inicio_almoco = $res[0]['inicio_almoco'];
	$final_almoco = $res[0]['final_almoco'];
}

//verificar se possui essa data nos dias bloqueio geral
$query = $pdo->query("SELECT * FROM dias_bloqueio where funcionario = '0' and data = '$data_agd'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Não estaremos funcionando nesta Data!';
	exit();
}

//verificar se possui essa data nos dias bloqueio func
$query = $pdo->query("SELECT * FROM dias_bloqueio where funcionario = '$funcionario'  and data = '$data_agd'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
		echo 'Este Profissional não irá trabalhar nesta Data, selecione outra data ou escolhar outro Profissional!';
		exit();
}

while (strtotime($nova_hora) < strtotime($hora_final_servico)){
		
		$hora_minutos = strtotime("+$intervalo minutes", strtotime($nova_hora));			
		$nova_hora = date('H:i:s', $hora_minutos);		
		
		//VERIFICAR NA TABELA HORARIOS AGD SE TEM O HORARIO NESSA DATA
		$query_agd = $pdo->query("SELECT * FROM horarios_agd where data = '$data' and funcionario = '$funcionario' and horario = '$nova_hora'");
		$res_agd = $query_agd->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res_agd) > 0){
			echo 'Este serviço demora cerca de '.$tempo.' minutos, precisa escolher outro horário, pois neste horários não temos disponibilidade devido a outros agendamentos!';
			exit();
		}



		//VERIFICAR NA TABELA AGENDAMENTOS SE TEM O HORARIO NESSA DATA e se tem um intervalo entre o horario marcado e o proximo agendado nessa tabela
		$query_agd = $pdo->query("SELECT * FROM agendamentos where data = '$data' and funcionario = '$funcionario' and hora = '$nova_hora'");
		$res_agd = $query_agd->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res_agd) > 0){
			if($tempo <= $intervalo){

			}else{
				if($hora_final_servico == $res_agd[0]['hora']){
					
				}else{
					echo 'Este serviço demora cerca de '.$tempo.' minutos, precisa escolher outro horário, pois neste horários não temos disponibilidade devido a outros agendamentos!';
						exit();
				}
				
			}
			
		}


		if(strtotime($nova_hora) > strtotime($inicio_almoco) and strtotime($nova_hora) < strtotime($final_almoco)){
		echo 'Este serviço demora cerca de '.$tempo.' minutos, precisa escolher outro horário, pois neste horários não temos disponibilidade devido ao horário de almoço!';
			exit();
	}

}



@$_SESSION['telefone'] = $telefone;

if($hora == ""){
	echo 'Escolha um Horário para Agendar!';
	exit();
}

if($data < date('Y-m-d')){
	echo 'Escolha uma data igual ou maior que Hoje!';
	exit();
}

//validar horario
$query = $pdo->query("SELECT * FROM agendamentos where data = '$data' and hora = '$hora' and funcionario = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Este horário não está disponível!';
	exit();
}

//Cadastrar o cliente caso não tenha cadastro
$query = $pdo->query("SELECT * FROM clientes where telefone LIKE '$telefone' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0){
	$query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, telefone = :telefone, data_cad = curDate(), cartoes = '0', alertado = 'Não'");

	$query->bindValue(":nome", "$nome");
	$query->bindValue(":telefone", "$telefone");	
	$query->execute();
	$id_cliente = $pdo->lastInsertId();

}else{
	$id_cliente = $res[0]['id'];
}






$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

if($not_sistema == 'Sim'){
	$mensagem_not = $nome;
	$titulo_not = 'Novo Agendamento '.$dataF.' - '.$horaF;
	$id_usu = $funcionario;
	require('../api/notid.php');
} 


if($msg_agendamento == 'Api'){

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_func = $res[0]['nome'];
$tel_func = $res[0]['telefone'];

$query = $pdo->query("SELECT * FROM servicos where id = '$servico' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_serv = $res[0]['nome'];

$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

$mensagem = '_Novo Agendamento_ %0A';
$mensagem .= 'Profissional: *'.$nome_func.'* %0A';
$mensagem .= 'Serviço: *'.$nome_serv.'* %0A';
$mensagem .= 'Data: *'.$dataF.'* %0A';
$mensagem .= 'Hora: *'.$horaF.'* %0A';
$mensagem .= 'Cliente: *'.$nome.'* %0A';
if($obs != ""){
	$mensagem .= 'Obs: *'.$obs.'* %0A';
}

$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

require('api-texto.php');

if($tel_func != $whatsapp_sistema){
	$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $tel_func);
	require('api-texto.php');	
}


$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $tel_cli);
//agendar o alerta de confirmação
$hora_atual = date('H:i:s');
$data_atual = date('Y-m-d');
$hora_minutos = strtotime("-$minutos_aviso hours", strtotime($hora));
$nova_hora = date('H:i:s', $hora_minutos);


}


//marcar o agendamento
$query = $pdo->prepare("INSERT INTO agendamentos SET funcionario = '$funcionario', cliente = '$id_cliente', hora = '$hora', data = '$data_agd', usuario = '0', status = 'Agendado', obs = :obs, data_lanc = curDate(), servico = '$servico', hash = '$hash'");

echo 'Agendado com Sucesso';
	

$query->bindValue(":obs", "$obs");
$query->execute();

$ult_id = $pdo->lastInsertId();
if($msg_agendamento == 'Api'){
if(strtotime($hora_atual) < strtotime($nova_hora) or strtotime($data_atual) != strtotime($data_agd)){

		$mensagem = '*Confirmação de Agendamento* ';
		$mensagem .= '                              _(1 para Confirmar, 2 para Cancelar)_';
		$id_envio = $ult_id;
		$data_envio = $data_agd.' '.$hora_do_agd;
		
		if($minutos_aviso > 0){
			require("confirmacao.php");
			$id_hash = $id;		
			$pdo->query("UPDATE agendamentos SET hash = '$id_hash' WHERE id = '$ult_id'");		
		}
	
}
}

while (strtotime($hora) < strtotime($hora_final_servico)){
		
		$hora_minutos = strtotime("+$intervalo minutes", strtotime($hora));			
		$hora = date('H:i:s', $hora_minutos);

		if(strtotime($hora) < strtotime($hora_final_servico)){
			$query = $pdo->query("INSERT INTO horarios_agd SET agendamento = '$ult_id', horario = '$hora', funcionario = '$funcionario', data = '$data_agd'");
		}
	

}

?>