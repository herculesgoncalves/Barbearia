<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$id = $_GET['id'];

//BUSCAR AS INFORMAÇÕES DO PEDIDO
$query = $pdo->query("SELECT * from receber where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$id = $res[0]['id'];	
$cliente = $res[0]['pessoa'];
$valor = $res[0]['valor'];
$descricao = $res[0]['descricao'];
$data = $res[0]['data_pgto'];
$servico = $res[0]['servico'];
$funcionario = $res[0]['funcionario'];
$obs = $res[0]['obs'];
$pgto = $res[0]['pgto'];

$comanda = $res[0]['comanda'];
	$valor2 = $res[0]['valor2'];

	if($comanda > 0){
		$valor = $valor2;
	}


$valorF = number_format($valor, 2, ',', '.');
$dataF = implode('/', array_reverse(explode('-', $data)));
	//$horaF = date("H:i", strtotime($hora));	


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_cliente = @$res2[0]['nome'];
$telefone_cliente = @$res2[0]['telefone'];
$endereco_cliente = @$res2[0]['endereco'];


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
Serviço: <b><?php echo $id ?></b> - Data: <?php echo $dataF ?>
</div>

<div  class="th title" >Comprovante de Serviço</div>

<div  class="th">CUMPOM NÃO FISCAL</div>

<?php 

$res = $pdo->query("SELECT * from receber where data_pgto = '$data' and pessoa = '$cliente' and tipo = 'Serviço' order by id asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

$sub_tot = 0;
for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}
	$id_serv = $dados[$i]['id']; 
	$servico_serv = $dados[$i]['servico']; 
	$valor_serv = $dados[$i]['valor'];

	$comanda = $dados[$i]['comanda'];
	$valor2 = $dados[$i]['valor2'];

	if($comanda > 0){
		$valor_serv = $valor2;
	}
	
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

		<div align="left" class="col-9"> <?php echo $nome_serv ?> 

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
	<div class="col-6" align="right">R$ <b><?php echo @$sub_totF ?></b></div>	
</div>	


</tr>


<div class="th" style="margin-bottom: 7px"></div>

<div class="row valores">			
	<div class="col-6">Forma de Pagamento</div>
	<div class="col-6" align="right"><?php echo @$pgto ?></div>	
</div>	




<div class="th" style="margin-bottom: 10px"></div>



<?php if($obs != ""){ ?>
	<div class="valores" align="center">
		<b>Observações do Pedido</b>		
			<br>			
			<?php echo $obs ?>
		</div>	
<div class="th" style="margin-bottom: 10px"></div>
<?php } ?>	