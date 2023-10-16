<?php 
require_once("../../../conexao.php");
@session_start();
$usuario = @$_SESSION['id'];
$data_atual = date('Y-m-d');

$funcionario = @$_POST['funcionario'];
$data = @$_POST['data'];

if($data == ""){
	$data = date('Y-m-d');
}

if($funcionario == ""){
	echo '<small>Selecione um Funcionário!</small>';
	exit();
}

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM agendamentos where funcionario = '$funcionario' and data = '$data' ORDER BY hora asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$funcionario = $res[$i]['funcionario'];
$cliente = $res[$i]['cliente'];
$hora = $res[$i]['hora'];
$data = $res[$i]['data'];
$usuario = $res[$i]['usuario'];
$data_lanc = $res[$i]['data_lanc'];
$obs = $res[$i]['obs'];
$status = $res[$i]['status'];
$servico = $res[$i]['servico'];

$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));


if($status == 'Concluído'){		
	$classe_linha = '';
}else{		
	$classe_linha = 'text-muted';
}



if($status == 'Agendado'){
	$imagem = 'icone-relogio.png';
	$classe_status = '';	
}else{
	$imagem = 'icone-relogio-verde.png';
	$classe_status = 'ocultar';
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu = $res2[0]['nome'];
}else{
	$nome_usu = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_serv = $res2[0]['nome'];
	$valor_serv = $res2[0]['valor'];
}else{
	$nome_serv = 'Não Lançado';
	$valor_serv = '';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];
	$total_cartoes = $res2[0]['cartoes'];
}else{
	$nome_cliente = 'Sem Cliente';
	$total_cartoes = 0;
}

if($total_cartoes >= $quantidade_cartoes and $status == 'Agendado'){
	$ocultar_cartoes = '';
}else{
	$ocultar_cartoes = 'ocultar';
}

//retirar aspas do texto do obs
$obs = str_replace('"', "**", $obs);

$classe_deb = '#043308';
$total_debitos = 0;
$total_pagar = 0;
$total_vencido = 0;
$total_debitosF = 0;
$total_pagarF = 0;
$total_vencidoF = 0;
$query2 = $pdo->query("SELECT * FROM receber where pessoa = '$cliente' and pago != 'Sim'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);
if($total_reg2 > 0){
	$classe_deb = '#661109';
	for($i2=0; $i2 < $total_reg2; $i2++){	
	$valor_s = $res2[$i2]['valor'];		
	$data_venc = $res2[$i2]['data_venc'];	
	
	$total_debitos += $valor_s;
	$total_debitosF = number_format($total_debitos, 2, ',', '.');
	

	if(strtotime($data_venc) < strtotime($data_atual)){		
		$total_vencido += $valor_s;
	}else{
		$total_pagar += $valor_s;
	}

	$total_pagarF = number_format($total_pagar, 2, ',', '.');
	$total_vencidoF = number_format($total_vencido, 2, ',', '.');
}
}

echo <<<HTML
			<div class="col-xs-12 col-md-4 widget cardTarefas">
        		<div class="r3_counter_box">     		
        		
        		

				<li class="dropdown head-dpdn2" style="list-style-type: none;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		<button type="button" class="close" title="Excluir agendamento" style="margin-top: -10px">
					<span aria-hidden="true"><big>&times;</big></span>
				</button>
				</a>

		<ul class="dropdown-menu" style="margin-left:-30px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$horaF}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


		<div class="row">
        		<div class="col-md-3">


				<li class="dropdown head-dpdn2" style="list-style-type: none;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		<img class="icon-rounded-vermelho" src="img/{$imagem}" width="45px" height="45px">
				</a>

		<ul class="dropdown-menu" style="margin-left:-30px;">
		<li>
		<div class="notification_desc2">
		<p>
		<span style="margin-right: 20px; ">Total Vencido <span style="color:red">R$ {$total_vencidoF}</span></span><br>
<span style="margin-right: 20px; ">Total à Vencer <span style="color:blue">R$ {$total_pagarF}</span></span><br>
<span >Total Pagar <span style="color:green">R$ {$total_debitosF}</span></span>
		</p>
		<p>Observações: {$obs}</p>
		</div>
		</li>										
		</ul>
		</li>
        			 
        		</div>
        		<div class="col-md-9">
        			<h5><strong>{$horaF}</strong> <a href="#" onclick="fecharServico('{$id}', '{$cliente}', '{$servico}', '{$valor_serv}', '{$funcionario}', '{$nome_serv}')" title="Finalizar Serviço" class="{$classe_status}"> <img class="icon-rounded-vermelho" src="img/check-square.png" width="15px" height="15px"></a></h5>

        			
        		</div>
        		</div>
        		
        					
        		<hr style="margin-top:-2px; margin-bottom: 3px">                    
                    <div class="stats esc" align="center">
                      <span style="">                      
                        <small> <span class="{$ocultar_cartoes}" style=""><img class="icon-rounded-vermelho" src="img/presente.jpg" width="20px" height="20px"></span> <span style="color:{$classe_deb}; font-size:13px">{$nome_cliente}</span> (<i><span style="color:#061f9c; font-size:12px">{$nome_serv}</span></i>)</small></span>
                    </div>
                </div>
        	</div>
HTML;
}

}else{
	echo 'Nenhum horário para essa Data!';
}

?>





<script type="text/javascript">
	function fecharServico(id, cliente, servico, valor_servico, funcionario, nome_serv){
	
		$('#id_agd').val(id);
		$('#cliente_agd').val(cliente);		
		$('#servico_agd').val(servico);	
		$('#valor_serv_agd').val(valor_servico);	
		$('#funcionario_agd').val(funcionario).change();	
		$('#titulo_servico').text(nome_serv);	
		$('#descricao_serv_agd').val(nome_serv);
		$('#obs2').val('');	

		$('#valor_serv_agd_restante').val('');
		$('#data_pgto_restante').val('');
		$('#pgto_restante').val('').change();	

		$('#modalServico').modal('show');
	}
</script>