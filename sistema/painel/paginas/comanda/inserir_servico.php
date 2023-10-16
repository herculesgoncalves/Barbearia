<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');

@session_start();
$usuario_logado = @$_SESSION['id'];

$cliente = $_POST['cliente'];
$id = @$_POST['id'];
$funcionario = $_POST['funcionario'];
$servico = $_POST['servico'];

if($id == ""){
	$id = 0;
}


$query = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor'];
$comissao = $res[0]['comissao'];
$descricao = $res[0]['nome'];
$descricao2 = 'Comissão - '.$res[0]['nome'];
$dias_retorno = $res[0]['dias_retorno'];
$data_retorno = date('Y-m-d', strtotime("+$dias_retorno days",strtotime($data_atual)));
$nome_servico = $res[0]['nome'];

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
	$valor_comissao = ($comissao * $valor) / 100;
}else{
	$valor_comissao = $comissao;
}



$pdo->query("INSERT INTO $tabela SET descricao = '$nome_servico', tipo = 'Serviço', valor = '$valor', data_lanc = curDate(), data_venc = curDate(), usuario_lanc = '$usuario_logado',  foto = 'sem-foto.jpg', pessoa = '$cliente', pago = 'Não', servico = '$servico', funcionario = '$funcionario', func_comanda = '$usuario_logado', comanda = '$id', valor2 = '$valor'");
$ult_id = $pdo->lastInsertId();


//lançar a conta a pagar para a comissão do funcionário
	$pdo->query("INSERT INTO pagar SET descricao = '$descricao2', tipo = 'Comissão', valor = '$valor_comissao', data_lanc = curDate(), data_venc = curDate(), usuario_lanc = '$usuario_logado', foto = 'sem-foto.jpg', pago = 'Não', funcionario = '$funcionario', servico = '$servico', cliente = '$cliente', id_ref = '$ult_id'");



echo 'Salvo com Sucesso'; 

?>