<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');

@session_start();
$usuario_logado = @$_SESSION['id'];

$id = @$_POST['id'];
$cliente = @$_POST['cliente'];
$data_pgto = $_POST['data_pgto'];
$valor_serv = $_POST['valor'];
$valor_serv = str_replace(',', '.', $valor_serv);
$funcionario = $usuario_logado;

$pgto = @$_POST['pgto'];


$valor_serv_restante = @$_POST['valor_restante'];
$valor_serv_restante = str_replace(',', '.', $valor_serv_restante);
$pgto_restante = @$_POST['pgto_restante'];
$data_pgto_restante = @$_POST['data_pgto_restante'];

if($valor_serv_restante == ""){
	$valor_serv_restante = 0;
}

$valor_total_servico = $valor_serv + $valor_serv_restante;


if(@$cliente == ""){
	echo 'Selecione um Cliente!';
	exit();
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

if($valor_serv_restante > 0){
if($valor_taxa > 0 and strtotime($data_pgto_restante) <=  strtotime($data_atual)){
	if($taxa_sistema == 'Cliente'){
		$valor_serv_restante = $valor_serv_restante + $valor_serv_restante * ($valor_taxa / 100);
	}else{
		$valor_serv_restante = $valor_serv_restante - $valor_serv_restante * ($valor_taxa / 100);
	}
	
}
}


if(strtotime($data_pgto) <=  strtotime($data_atual)){
	$pago = 'Sim';
	$data_pgto2 = $data_pgto;
	$usuario_baixa = $usuario_logado;	
	
}else{
	$pago = 'Não';
	$data_pgto2 = '';
	$usuario_baixa = 0;

}


//dados do cliente
$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente' order by id desc limit 2");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res2[0]['telefone'];
$nome_cliente = $res2[0]['nome'];
$total_cartoes = $res2[0]['cartoes'];
$cartoes = $total_cartoes + 1;


$descricao = 'Comanda '.$nome_cliente;

$pdo->query("UPDATE receber SET valor = '0', pago = 'Sim', data_pgto = curDate(), usuario_baixa = '$usuario_logado', pgto = '$pgto' where comanda = '$id'");
$pdo->query("UPDATE comandas SET valor = '$valor_total_servico', status = 'Fechada' where id = '$id'");



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
$pdo->query("INSERT INTO $tabela SET descricao = '$descricao', tipo = 'Comanda', valor = '$valor_serv_restante', data_lanc = curDate(), data_venc = '$data_pgto_restante', data_pgto = '$data_pgto2_restante', usuario_lanc = '$usuario_logado', usuario_baixa = '$usuario_baixa', foto = 'sem-foto.jpg', pessoa = '$cliente', pago = '$pago_restante', pgto = '$pgto_restante', func_comanda = '$usuario_logado', comanda = '$id'");	
}




$pdo->query("INSERT INTO $tabela SET descricao = '$descricao', tipo = 'Comanda', valor = '$valor_serv', data_lanc = curDate(), data_venc = '$data_pgto', data_pgto = '$data_pgto2', usuario_lanc = '$usuario_logado', usuario_baixa = '$usuario_baixa', foto = 'sem-foto.jpg', pessoa = '$cliente', pago = '$pago', pgto = '$pgto', func_comanda = '$usuario_logado', comanda = '$id'");


$pdo->query("UPDATE clientes SET cartoes = '$cartoes' where id = '$cliente'");



echo 'Salvo com Sucesso'; 

?>