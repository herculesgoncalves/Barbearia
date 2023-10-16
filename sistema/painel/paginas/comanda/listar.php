<?php 
require_once("../../../conexao.php");
$tabela = 'comandas';
$data_hoje = date('Y-m-d');

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = '%'.@$_POST['status'].'%';
$status2 = @$_POST['status'];

@session_start();
$usuario_logado = @$_SESSION['id'];

$query = $pdo->query("SELECT * FROM $tabela where data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '$status' and funcionario = '$usuario_logado' ORDER BY id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
for($i=0; $i < $total_reg; $i++){
	$id = $res[$i]['id'];
	$cliente = $res[$i]['cliente'];
	$valor = $res[$i]['valor'];
	$data = $res[$i]['data'];
	$funcionario = $res[$i]['funcionario'];
	$status = $res[$i]['status'];
	$obs = $res[$i]['obs'];

	$dataF = implode('/', array_reverse(explode('-', $data)));
	$valorF = number_format($valor, 2, ',', '.');

	$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_pessoa = $res2[0]['nome'];			
		}else{
			$nome_pessoa = '';			
		}


		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_funcionario = $res2[0]['nome'];
		}else{
			$nome_funcionario = 'Nenhum!';
		}

		if($status == 'Aberta'){
	$imagem = 'aberta.png';
	$classe_status = '';
	$classe_imp = 'ocultar';	
}else{
	$imagem = 'fechada.png';
	$classe_status = 'ocultar';
	$classe_imp = '';
}



echo <<<HTML
			<div class="col-xs-12 col-md-3 widget cardTarefas">
        		<div class="r3_counter_box">  

				<li class="dropdown head-dpdn2" style="list-style-type: none;">
				<a href="#" class="dropdown-toggle {$classe_status}" data-toggle="dropdown" aria-expanded="false">
		<button type="button" class="close" title="Excluir agendamento" style="margin-top: -10px">
					<span aria-hidden="true"><big>&times;</big></span>
				</button>
				</a>

		<ul class="dropdown-menu" style="margin-left:-30px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluirComanda('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

		<a class="{$classe_imp}" href="rel/comprovante_comanda.php?id={$id}" target="_blank" title="Gerar Comprovante"><img src="img/comanda.png" width="30px" style="position:absolute; right:1px; top:1px"></a>



		<div class="row">
        		<div class="col-md-3">
				
				<a href="#" onclick="editar('{$id}', '{$valor}', '{$cliente}', '{$obs}', '{$status}', '{$nome_pessoa}', '{$nome_funcionario}', '{$dataF}')" class="" aria-expanded="false">
		<img class="icon-rounded-vermelho" src="img/{$imagem}" width="45px" height="45px" >				</a>
	
        			 
        		</div>
        		<div class="col-md-9" >
        			<h5><strong> R$ {$valorF}</strong> </h5>

        			
        		</div>
        		</div>
        		
        					
        		                    
                    <div class="stats esc" align="center" style="border-top: 1px solid #6e6d6d">
                      <span style="color:#070130">                      
                        <small>{$nome_pessoa}</small></span>
                    </div>
                </div>
        	</div>
HTML;
}
}else{
	echo '<small>Não possui Nenhuma Comanda '.$status2.'!</small>';
}

?>


<script type="text/javascript">
	function editar(id, valor, cliente, obs, status, nome_cliente, nome_func, data){

		
		if(status.trim() === 'Fechada'){
			
			$('#cliente_dados').text(nome_cliente);
			$('#valor_dados').text(valor);
			$('#data_dados').text(data);
			$('#func_dados').text(nome_func);
			$('#modalDados').modal('show');

			listarServicosDados(id)
			listarProdutosDados(id)

		}else{
			$('#id').val(id);
		$('#cliente').val(cliente).change();		
		$('#valor_serv').val(valor);
		$('#obs').val(obs);

		$('#valor_serv_agd_restante').val('');
										
		$('#titulo_comanda').text('Editar Comanda Aberta');
		$('#btn_fechar_comanda').show();
		$('#modalForm').modal('show');

		listarServicos(id)
		listarProdutos(id)	
		calcular();
		


		}
		
		


		
	}

	function limparCampos(){
		
		$('#btn_fechar_comanda').hide();
		$('#titulo_comanda').text('Nova Comanda');
		$('#id').val('');		
		$('#valor_serv').val('');
		
		$('#cliente').val('').change();

		$('#salvar_comanda').val('').change();	
				

		$('#data_pgto').val('<?=$data_hoje?>');	

		$('#valor_serv_agd_restante').val('');
		$('#data_pgto_restante').val('');
		$('#pgto_restante').val('').change();
		listarServicos()
		listarProdutos()	
		calcular();
		
	}

	function excluirComanda(id){
    $.ajax({
        url: 'paginas/' + pag + "/excluir.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {   
             
            if (mensagem.trim() == "Excluído com Sucesso") {                
                listar();                
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                alert(mensagem)
            }

        },      

    });
}
</script>


