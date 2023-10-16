<?php 
require_once("../../sistema/conexao.php");

$id_usuario = $_POST['id_usuario'];

$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";

if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
    $dia_final_mes = '30';
}else if($mes_atual == '2'){
    $dia_final_mes = '28';
}else{
    $dia_final_mes = '31';
}

$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;




//buscar o total de usuarios
$query = $pdo->query("SELECT * FROM clientes");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_usuarios = @count($res);




//buscar o saldo do dia
$total_debitos_dia = 0;
$query = $pdo->query("SELECT * FROM pagar where data_pgto = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_debitos_dia += $res[$i]['valor'];
    }
}

$total_ganhos_dia = 0;
$query = $pdo->query("SELECT * FROM receber where data_pgto = curDate() ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_ganhos_dia += $res[$i]['valor'];
    }
}

$saldo_total_dia = $total_ganhos_dia - $total_debitos_dia;
$saldo_total_diaF = number_format($saldo_total_dia, 2, ',', '.');

if($saldo_total_dia < 0){
    $classe_saldo_dia = 'red';
    $imagem_saldo_dia = 'money-red.png';
}else{
    $classe_saldo_dia = 'green';
    $imagem_saldo_dia = 'money.png';
}





//TOTALIZAR CONTAS PENDENTES NO MES
$total_pagar_mes = 0;
$query = $pdo->query("SELECT * FROM pagar where data_venc >= '$data_inicio_mes' and data_venc <= '$data_final_mes' and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_pagar_mes += $res[$i]['valor'];
    }
}
$total_pagar_mesF = number_format($total_pagar_mes, 2, ',', '.');

$total_receber_mes = 0;
$query = $pdo->query("SELECT * FROM receber where data_venc >= '$data_inicio_mes' and data_venc <= '$data_final_mes' and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_receber_mes += $res[$i]['valor'];
    }
}
$total_receber_mesF = number_format($total_receber_mes, 2, ',', '.');







//TOTALIZAR COMISSÕES E COMPRAS PENDENTES MES
$total_compra_mes = 0;
$query = $pdo->query("SELECT * FROM pagar where data_venc >= '$data_inicio_mes' and data_venc <= '$data_final_mes' and pago != 'Sim' and tipo = 'Compra'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_compra_mes += $res[$i]['valor'];
    }
}
$total_compra_mesF = number_format($total_compra_mes, 2, ',', '.');

$total_comissao_mes = 0;
$query = $pdo->query("SELECT * FROM pagar where data_venc >= '$data_inicio_mes' and data_venc <= '$data_final_mes' and pago != 'Sim' and tipo = 'Comissão'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_comissao_mes += $res[$i]['valor'];
    }
}
$total_comissao_mesF = number_format($total_comissao_mes, 2, ',', '.');


//estoque baixo quantidade produtos
$query = $pdo->query("SELECT * FROM produtos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$estoque_baixo = 0;
if($total_reg > 0){
    for($i=0; $i < $total_reg; $i++){
    foreach ($res[$i] as $key => $value){}
        $estoque = $res[$i]['estoque'];
        $nivel_estoque = $res[$i]['nivel_estoque'];

        if($nivel_estoque >= $estoque){
            $estoque_baixo += 1;
        }
    }
}




//totalizando agendamentos
$query = $pdo->query("SELECT * FROM agendamentos where data = curDate() ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_agendamentos_hoje = @count($res);



//totalizando agendamentos usuario
$query = $pdo->query("SELECT * FROM agendamentos where data = curDate() and funcionario = '$id_usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_agendamentos_usuario = @count($res);

//totalizando agendamentos usuario concluido
$query = $pdo->query("SELECT * FROM agendamentos where data = curDate() and funcionario = '$id_usuario' and status = 'Concluído'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_agendamentos_usuario_conc = @count($res);


//total comissao pendente do usuario
$total_comissao_pendente = 0;
$query = $pdo->query("SELECT * FROM pagar where pago != 'Sim' and tipo = 'Comissão' and funcionario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_comissao_pendente += $res[$i]['valor'];
    }
}
$total_comissao_pendenteF = number_format($total_comissao_pendente, 2, ',', '.');



//total comissao pendente do usuario hoje
$total_comissao_pendente_hoje = 0;
$query = $pdo->query("SELECT * FROM pagar where pago != 'Sim' and tipo = 'Comissão' and funcionario = '$id_usuario' and data_lanc = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_comissao_pendente_hoje += $res[$i]['valor'];
    }
}
$total_comissao_pendente_hojeF = number_format($total_comissao_pendente_hoje, 2, ',', '.');



//total serviços do usuario hoje
$total_servicos_hoje = 0;
$query = $pdo->query("SELECT * FROM receber where tipo = 'Serviço' and funcionario = '$id_usuario' and data_lanc = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_servicos_executado = @count($res);
if(@count($res) > 0){
for($i=0; $i < @count($res); $i++){
    foreach ($res[$i] as $key => $value){}
        $total_servicos_hoje += $res[$i]['valor'];
    }
}
$total_servicos_hojeF = number_format($total_servicos_hoje, 2, ',', '.');




$dados = array(
	'total_usuarios' => $total_usuarios,
	'saldo_total_diaF' => $saldo_total_diaF,
	'classe_saldo_dia' => $classe_saldo_dia,
	'imagem_saldo_dia' => $imagem_saldo_dia,
	'total_pagar_mesF' => $total_pagar_mesF,
	'total_receber_mesF' => $total_receber_mesF,
	'total_compra_mesF' => $total_compra_mesF,
	'total_comissao_mesF' => $total_comissao_mesF,
	'estoque_baixo' => $estoque_baixo,
	'total_agendamentos_hoje' => $total_agendamentos_hoje,
    'total_agendamentos_usuario' => $total_agendamentos_usuario,
    'total_agendamentos_usuario_conc' => $total_agendamentos_usuario_conc,
    'total_comissao_pendenteF' => $total_comissao_pendenteF,
    'total_comissao_pendente_hojeF' => $total_comissao_pendente_hojeF,
    'total_servicos_executado' => $total_servicos_executado,
    'total_servicos_hojeF' => $total_servicos_hojeF,
	
);

$result = json_encode($dados);
echo $result;



?>