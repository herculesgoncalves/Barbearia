<?php 
require_once("../../../conexao.php");
$tabela = 'receber';
$data_hoje = date('Y-m-d');

$id = @$_POST['id'];

if($id == ""){
	$id = 0;
}

@session_start();
$usuario_logado = @$_SESSION['id'];


$total_servicos = 0;

$query = $pdo->query("SELECT * FROM $tabela where tipo = 'Venda' and comanda = '$id' and func_comanda = '$usuario_logado' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover" id="">
	<thead> 
	<tr> 
	
	<th>Produto</th>	
	<th class="esc">Valor</th> 
	<th class="esc">Estoque</th>
	<th>Vendedor</th>		
	
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];	
	$descricao = $res[$i]['descricao'];
	$tipo = $res[$i]['tipo'];
	$valor = $res[$i]['valor'];
	$valor2 = $res[$i]['valor2'];
	$data_lanc = $res[$i]['data_lanc'];
	$data_pgto = $res[$i]['data_pgto'];
	$data_venc = $res[$i]['data_venc'];
	$usuario_lanc = $res[$i]['usuario_lanc'];
	$usuario_baixa = $res[$i]['usuario_baixa'];
	$foto = $res[$i]['foto'];
	$pessoa = $res[$i]['pessoa'];
	$funcionario = $res[$i]['funcionario'];
	$obs = $res[$i]['obs'];
	$comanda = $res[$i]['comanda'];
	$produto = $res[$i]['produto'];
	$quantidade = $res[$i]['quantidade'];
	
	$pago = $res[$i]['pago'];
	$servico = $res[$i]['servico'];
	
	$valorF = number_format($valor, 2, ',', '.');
	$valorF2 = number_format($valor2, 2, ',', '.');
	$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
	$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
	$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
	

		$query2 = $pdo->query("SELECT * FROM clientes where id = '$pessoa'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_pessoa = $res2[0]['nome'];
			$telefone_pessoa = $res2[0]['telefone'];
		}else{
			$nome_pessoa = 'Nenhum!';
			$telefone_pessoa = 'Nenhum';
		}


		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_usuario_pgto = $res2[0]['nome'];
		}else{
			$nome_usuario_pgto = 'Nenhum!';
		}



		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_usuario_lanc = $res2[0]['nome'];
		}else{
			$nome_usuario_lanc = 'Sem Referência!';
		}



		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_func = $res2[0]['nome'];
		}else{
			$nome_func = '';
		}

	


		if($data_pgto == '0000-00-00'){
			$classe_alerta = 'text-danger';
			$data_pgtoF = 'Pendente';
			$visivel = '';
			
			$japago = 'ocultar';
		}else{
			$classe_alerta = 'verde';
			$visivel = 'ocultar';
			
			$japago = '';
		}

		$total_servicos += $valor2;


			//extensão do arquivo
$ext = pathinfo($foto, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else{
	$tumb_arquivo = $foto;
}
		

if($data_venc < $data_hoje and $pago != 'Sim'){
	$classe_debito = 'vermelho-escuro';
}else{
	$classe_debito = '';
}
		

$query2 = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_produto = $res2[0]['nome'];
$estoque_produto = $res2[0]['estoque'];

echo <<<HTML
<tr class="{$classe_debito}">
<td>{$quantidade} {$nome_produto}</td>
<td class="esc">R$ {$valorF2}</td>
<td class="esc">{$estoque_produto}</td>
<td>{$nome_func}</td>


</tr>
HTML;

}

$total_servicosF = number_format($total_servicos, 2, ',', '.');

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir-servicos"></div></small>
</table>
	
<div align="right">Total Produtos: <span class="verde">R$ {$total_servicosF}</span> </div>

</small>
HTML;


}else{
	echo '<small>Nenhum Produto ainda Lançado!</small>';
}

?>

