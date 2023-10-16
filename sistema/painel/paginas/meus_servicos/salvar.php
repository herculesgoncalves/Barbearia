<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');

if(@$_POST['id_usuario'] != ""){
	$usuario_logado = $_POST['id_usuario'];
}else{
	@session_start();
$usuario_logado = @$_SESSION['id'];
}


$cliente = @$_POST['cliente'];
$data_pgto = $_POST['data_pgto'];
$valor_serv = $_POST['valor_serv'];
$valor_serv = str_replace(',', '.', $valor_serv);
$funcionario = $usuario_logado;
$servico = $_POST['servico'];
$pgto = @$_POST['pgto'];
$obs = @$_POST['obs'];

$valor_serv_restante = $_POST['valor_serv_agd_restante'];
$pgto_restante = $_POST['pgto_restante'];
$data_pgto_restante = $_POST['data_pgto_restante'];

if($valor_serv_restante == ""){
	$valor_serv_restante = 0;
}

$valor_total_servico = $valor_serv + $valor_serv_restante;


if(@$cliente == ""){
	echo 'Selecione um Cliente!';
	exit();
}

$query = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor'];
$nome_servico = $res[0]['nome'];
$comissao = $res[0]['comissao'];
$descricao = $res[0]['nome'];
$descricao2 = 'Comissão - '.$res[0]['nome'];
$dias_retorno = $res[0]['dias_retorno'];
$data_retorno = date('Y-m-d', strtotime("+$dias_retorno days",strtotime($data_atual)));

//dados do cliente
$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente' order by id desc limit 2");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res2[0]['telefone'];
$nome_cliente = $res2[0]['nome'];

$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$comissao_func = $res[0]['comissao'];

if($comissao_func > 0){
	$comissao = $comissao_func;
}

if($tipo_comissao == 'Porcentagem'){
	$valor_comissao = ($comissao * $valor_total_servico) / 100;
}else{
	$valor_comissao = $comissao;
}

$query = $pdo->query("SELECT * FROM formas_pgto where nome = '$pgto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor_taxa = $res[0]['taxa'];

if($valor_taxa > 0 and strtotime($data_pgto) <=  strtotime($data_atual)){
	if($taxa_sistema == 'Cliente'){
		$valor_serv = $valor_serv + $valor_serv * ($valor_taxa / 100);
	}else{
		$valor_serv = $valor_serv - $valor_serv * ($valor_taxa / 100);
	}
	
}




$query = $pdo->query("SELECT * FROM formas_pgto where nome = '$pgto_restante'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor_taxa = @$res[0]['taxa'];

if($valor_taxa > 0 and strtotime($data_pgto_restante) <=  strtotime($data_atual)){
	if($taxa_sistema == 'Cliente'){
		$valor_serv_restante = $valor_serv_restante + $valor_serv_restante * ($valor_taxa / 100);
	}else{
		$valor_serv_restante = $valor_serv_restante - $valor_serv_restante * ($valor_taxa / 100);
	}
	
}



if(strtotime($data_pgto) <=  strtotime($data_atual)){
	$pago = 'Sim';
	$data_pgto2 = $data_pgto;
	$usuario_baixa = $usuario_logado;

	//lançar a conta a pagar para a comissão do funcionário
	$pdo->query("INSERT INTO pagar SET descricao = '$descricao2', tipo = 'Comissão', valor = '$valor_comissao', data_lanc = '$data_pgto', data_venc = '$data_pgto', usuario_lanc = '$usuario_logado', foto = 'sem-foto.jpg', pago = 'Não', funcionario = '$funcionario', servico = '$servico', cliente = '$cliente'");

	$telefone = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
if($msg_agendamento == 'Api'){
//agendar mensagem de retorno
	$mensagem = '*Olá tudo bem '.$nome_cliente.'! Nós '.$nome_sistema.', queremos ouvir você!*  %0A %0A';
	$mensagem .= 'Como foi seu último serviço de '.$nome_servico.' conosco? Você teria alguma sugestão de melhoria? Você é muito importante pra gente!%0A %0A Faz um tempo que não nós vemos você aqui. Quando você vai dar aquele tapa no visual? Você merece o que há de melhor, conheça nossos pacotes de desconto. *Promoção especial apenas hoje!*';	
	$data_mensagem = $data_retorno.' 08:00:00';
	require('../../../../ajax/api-agendar.php');
	
}
	
}else{
	$pago = 'Não';
	$data_pgto2 = '';
	$usuario_baixa = 0;

	if($lanc_comissao == 'Sempre'){
		//lançar a conta a pagar para a comissão do funcionário
	$pdo->query("INSERT INTO pagar SET descricao = '$descricao2', tipo = 'Comissão', valor = '$valor_comissao', data_lanc = '$data_pgto', data_venc = '$data_pgto', usuario_lanc = '$usuario_logado', foto = 'sem-foto.jpg', pago = 'Não', funcionario = '$funcionario', servico = '$servico', cliente = '$cliente'");
	}
}




if($valor_serv_restante > 0){
if(strtotime($data_pgto_restante) <=  strtotime($data_atual)){
	$pago_restante = 'Sim';
	$data_pgto2_restante = $data_pgto;
	$usuario_baixa_restante = $usuario_logado;
}else{
	$pago_restante = 'Não';
	$data_pgto2_restante = '';
	$usuario_baixa_restante = 0;
}

//lançar o restante
$pdo->query("INSERT INTO $tabela SET descricao = '$descricao', tipo = 'Serviço', valor = '$valor_serv_restante', data_lanc = curDate(), data_venc = '$data_pgto_restante', data_pgto = '$data_pgto2_restante', usuario_lanc = '$usuario_logado', usuario_baixa = '$usuario_baixa', foto = 'sem-foto.jpg', pessoa = '$cliente', pago = '$pago_restante', servico = '$servico', funcionario = '$funcionario', obs = '$obs', pgto = '$pgto_restante'");	
}


$query2 = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$dias_retorno = $res2[0]['dias_retorno'];
$nome_servico = $res2[0]['nome'];

//dados do cliente
$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_cartoes = $res2[0]['cartoes'];
$cartoes = $total_cartoes + 1;
$data_retorno = date('Y-m-d', strtotime("+$dias_retorno days",strtotime($data_atual)));

$pdo->query("INSERT INTO $tabela SET descricao = '$nome_servico', tipo = 'Serviço', valor = '$valor_serv', data_lanc = curDate(), data_venc = '$data_pgto', data_pgto = '$data_pgto2', usuario_lanc = '$usuario_logado', usuario_baixa = '$usuario_baixa', foto = 'sem-foto.jpg', pessoa = '$cliente', pago = '$pago', servico = '$servico', funcionario = '$funcionario', pgto = '$pgto', obs = '$obs'");


$pdo->query("UPDATE clientes SET cartoes = '$cartoes', data_retorno = '$data_retorno', ultimo_servico = '$servico', alertado = 'Não' where id = '$cliente'");

echo 'Salvo com Sucesso'; 

?>