<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$id = $_GET['id'];

//BUSCAR AS INFORMAÇÕES DO PEDIDO
$query = $pdo->query("SELECT * from comandas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id = $res[0]['id'];	
$cliente = $res[0]['cliente'];
$valor = $res[0]['valor'];
$descricao = '';
$data = $res[0]['data'];
$status = $res[0]['status'];
$funcionario = $res[0]['funcionario'];
$obs = $res[0]['obs'];


$valor_total_comandaF = number_format($valor, 2, ',', '.');
$dataF = implode('/', array_reverse(explode('-', $data)));
	//$horaF = date("H:i", strtotime($hora));	


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = @$res2[0]['nome'];
$telefone_cliente = @$res2[0]['telefone'];
$endereco_cliente = @$res2[0]['endereco'];

$query2 = $pdo->query("SELECT * FROM receber where comanda = '$id' and tipo = 'Comanda' and pago = 'Sim' order by id asc");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_de_pagos = @count($res2);
$total_pago = @$res2[0]['valor'];
$forma_pgto_pago = @$res2[0]['pgto'];
$total_pagoF = number_format($total_pago, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM receber where comanda = '$id' and tipo = 'Comanda' and pago != 'Sim' order by id asc");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_de_pendentes = @count($res2);
$total_pendente = @$res2[0]['valor'];
$forma_pgto_pendente = @$res2[0]['pgto'];
$data_pgto_pendente = @$res2[0]['data_venc'];
$data_pgto_pendenteF = implode('/', array_reverse(explode('-', $data_pgto_pendente)));
$total_pendenteF = number_format($total_pendente, 2, ',', '.');


$query2 = $pdo->query("SELECT * FROM receber where comanda = '$id' and tipo = 'Comanda' and pago = 'Sim' order by id desc");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

$total_pago2 = @$res2[0]['valor'];
$forma_pgto_pago2 = @$res2[0]['pgto'];
$total_pagoF2 = number_format($total_pago2, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM receber where comanda = '$id' and tipo = 'Comanda' and pago != 'Sim' order by id desc");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_pendente2 = @$res2[0]['valor'];
$forma_pgto_pendente2 = @$res2[0]['pgto'];
$data_pgto_pendente2 = @$res2[0]['data_venc'];
$data_pgto_pendenteF2 = implode('/', array_reverse(explode('-', $data_pgto_pendente2)));
$total_pendenteF2 = number_format($total_pendente2, 2, ',', '.');

?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<style type="text/css">
	*{
		margin:0px;

		/*Espaçamento da margem da esquerda e da Direita*/
		padding:0px;
		background-color:#ffffff;


	}
	.text {
		&-center { text-align: center; }
	}
	
	.printer-ticket {
		display: table !important;
		width: 100%;

		/*largura do Campos que vai os textos*/
		max-width: 400px;
		font-weight: light;
		line-height: 1.3em;

		/*Espaçamento da margem da esquerda e da Direita*/
		padding: 0px;
		font-family: TimesNewRoman, Geneva, sans-serif; 

		/*tamanho da Fonte do Texto*/
		font-size: 11px; 



	}
	
	.th { 
		font-weight: inherit;
		/*Espaçamento entre as uma linha para outra*/
		padding:5px;
		text-align: center;
		/*largura dos tracinhos entre as linhas*/
		border-bottom: 1px dashed #000000;
	}

	.itens { 
		font-weight: inherit;
		/*Espaçamento entre as uma linha para outra*/
		padding:5px;
		
	}

	.valores { 
		font-weight: inherit;
		/*Espaçamento entre as uma linha para outra*/
		padding:2px 5px;
		
	}


	.cor{
		color:#000000;
	}
	
	
	.title { 
		font-size: 12px;
		text-transform: uppercase;
		font-weight: bold;
	}

	/*margem Superior entre as Linhas*/
	.margem-superior{
		padding-top:5px;
	}
	
	
}
</style>



<div class="printer-ticket">		
	<div  class="th title"><?php echo $nome_sistema ?></div>

	<div  class="th">
		<?php echo $endereco_sistema ?> <br />
		<small>Contato: <?php echo $whatsapp_sistema ?> 
		<?php if($cnpj_sistema != ""){echo ' / CNPJ '. @$cnpj_sistema; } ?>
	</small>  
</div>



<div  class="th">Cliente <?php echo $nome_cliente ?> Tel: <?php echo $telefone_cliente ?>			
<br>
Comanda: <b><?php echo $id ?></b> - Data: <?php echo $dataF ?>
</div>

<div  class="th title" >Comprovante de Serviços</div>

<div  class="th">CUMPOM NÃO FISCAL</div>

<?php 

$res = $pdo->query("SELECT * from receber where tipo = 'Serviço' and comanda = '$id' order by id asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

$sub_tot = 0;
for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}
	$id_serv = $dados[$i]['id']; 
	$servico_serv = $dados[$i]['servico']; 
	$valor_serv = $dados[$i]['valor2'];
	$valor_servF = number_format($valor_serv, 2, ',', '.');

	$sub_tot += $valor_serv;
	$sub_totF = number_format($sub_tot, 2, ',', '.');

		$query2 = $pdo->query("SELECT * FROM servicos where id = '$servico_serv'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count(@$res2) > 0){
			$nome_serv = $res2[0]['nome'];			
		}else{
			$nome_serv = '';
		}

	


	?>

	<div class="row itens">

		<div align="left" class="col-9"> Serviço: <?php echo $nome_serv ?> 

	</div>		

	<div align="right" class="col-3">
		R$ <?php
		echo $valor_servF ;
		?>
	</div>


	

</div>


<?php } ?>




<?php 

$res = $pdo->query("SELECT * from receber where tipo = 'Venda' and comanda = '$id' order by id asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

$sub_tot = 0;
for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}
	$id_serv = $dados[$i]['id']; 
	$servico_serv = $dados[$i]['servico']; 
	$valor_serv = $dados[$i]['valor2'];
	$valor_servF = number_format($valor_serv, 2, ',', '.');
	$produto = $dados[$i]['produto'];
	$quantidade = $dados[$i]['quantidade'];

	$sub_tot += $valor_serv;
	$sub_totF = number_format($sub_tot, 2, ',', '.');

		$query2 = $pdo->query("SELECT * FROM produtos where id = '$produto'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count(@$res2) > 0){
			$nome_serv = $res2[0]['nome'];			
		}else{
			$nome_serv = '';
		}

	


	?>

	<div class="row itens">

		<div align="left" class="col-9"> (<?php echo $quantidade ?>) <?php echo $nome_serv ?> 

	</div>		

	<div align="right" class="col-3">
		R$ <?php
		echo $valor_servF ;
		?>
	</div>


	

</div>


<?php } ?>

<div class="th" style="margin-bottom: 7px"></div>
	

<div class="row valores">			
	<div class="col-6">SubTotal</div>
	<div class="col-6" align="right">R$ <b><?php echo @$valor_total_comandaF ?></b></div>	
</div>	

<?php if($total_pago > 0){ ?>
<div class="row valores">			
	<div class="col-6">Total Pago (<?php echo $forma_pgto_pago ?>)</div>
	<div class="col-6" align="right">R$ <b><?php echo @$total_pagoF ?></b></div>	
</div>
<?php } ?>

<?php if($total_pago2 > 0 and $total_de_pagos > 1){ ?>
<div class="row valores">			
	<div class="col-6">Total Pago (<?php echo $forma_pgto_pago2 ?>)</div>
	<div class="col-6" align="right">R$ <b><?php echo @$total_pagoF2 ?></b></div>	
</div>
<?php } ?>

<?php if($total_pendente > 0){ ?>
<div class="row valores">			
	<div class="col-6">Total Pendente (<?php echo $data_pgto_pendenteF ?>)</div>
	<div class="col-6" align="right">R$ <b><?php echo @$total_pendenteF ?></b></div>	
</div>
<?php } ?>


<?php if($total_pendente2 > 0 and $total_de_pendentes > 1){ ?>
<div class="row valores">			
	<div class="col-6">Total Pendente (<?php echo $data_pgto_pendenteF2 ?>)</div>
	<div class="col-6" align="right">R$ <b><?php echo @$total_pendenteF2 ?></b></div>	
</div>
<?php } ?>


</tr>




<div class="th" style="margin-bottom: 10px"></div>



<?php if($obs != ""){ ?>
	<div class="valores" align="center">
		<b>Observações do Pedido</b>		
			<br>			
			<?php echo $obs ?>
		</div>	
<div class="th" style="margin-bottom: 10px"></div>
<?php } ?>	



<?php if($total_pendente > 0){ ?>
<br><br>
<div align="center">
________________________________<br>
Assinatura Cliente
</div>

<?php } ?>