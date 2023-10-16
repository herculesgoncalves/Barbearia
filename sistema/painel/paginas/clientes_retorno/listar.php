<?php 
require_once("../../../conexao.php");
$tabela = 'clientes';
$data_atual = date('Y-m-d');

$query = $pdo->query("SELECT * FROM $tabela where alertado != 'Sim' and data_retorno < curDate() ORDER BY data_retorno asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Telefone</th> 		
	<th class="esc">Retorno</th> 
	<th class="esc">Último Serviço</th>
	<th class="esc">Dias</th> 	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$data_nasc = $res[$i]['data_nasc'];
	$data_cad = $res[$i]['data_cad'];	
	$telefone = $res[$i]['telefone'];
	$endereco = $res[$i]['endereco'];
	$cartoes = $res[$i]['cartoes'];
	$data_retorno = $res[$i]['data_retorno'];
	$ultimo_servico = $res[$i]['ultimo_servico'];

	$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
	$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
	$data_retornoF = implode('/', array_reverse(explode('-', $data_retorno)));
	
	if($data_nascF == '00/00/0000'){
		$data_nascF = 'Sem Lançamento';
	}
	
	
	$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	$query2 = $pdo->query("SELECT * FROM servicos where id = '$ultimo_servico'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$nome_servico = $res2[0]['nome'];
	}else{
		$nome_servico = 'Nenhum!';
	}

	if($data_retorno != "" and strtotime($data_retorno) <  strtotime($data_atual)){
		$classe_retorno = 'text-danger';
	}else{
		$classe_retorno = '';
	}


//diferença de dias
$data_inicio = new DateTime($data_retorno);
$data_fim = new DateTime($data_atual);
$intvl = $data_inicio->diff($data_fim);

//echo $intvl->y . " year, " . $intvl->m." months and ".$intvl->d." day"; 
//echo "\n";
// Total amount of days
//echo $intvl->days . " days ";	
$dias = $intvl->days;

$url_agendamento = $url_sistema.'agendamento';


echo <<<HTML
<tr class="">
<td>{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc {$classe_retorno}">{$data_retornoF}</td>
<td class="esc">{$nome_servico}</td>
<td class="esc">{$dias}</td>
<td>
		
		<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$cartoes}', '{$data_cadF}', '{$data_nascF}', '{$endereco}', '{$data_retornoF}', '{$nome_servico}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<big><a onclick="alertar('{$id}')" href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=Olá $nome, já faz $dias dias que você não vem dar um trato no visual, caso queira fazer um novo agendamento é só acessar nosso site $url_agendamento, será um prazer atendê-lo novamente!!" target="_blank" title="Abrir Whatsapp"><i class="fa fa-whatsapp text-danger"></i></a></big>

		</td>
</tr>
HTML;

}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
</small>
HTML;


}else{
	echo '<small>Não possui nenhum registro Cadastrado!</small>';
}

?>

<script type="text/javascript">
	$(document).ready( function () {
    $('#tabela').DataTable({
    		"ordering": false,
			"stateSave": true
    	});
    $('#tabela_filter label input').focus();
} );
</script>


<script type="text/javascript">
	function editar(id, nome, telefone, endereco, data_nasc, cartoes){
		$('#id').val(id);
		$('#nome').val(nome);		
		$('#telefone').val(telefone);		
		$('#endereco').val(endereco);
		$('#data_nasc').val(data_nasc);
		$('#cartao').val(cartoes);

		
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#endereco').val('');
		$('#data_nasc').val('');
		$('#cartao').val('0');
	}
</script>



<script type="text/javascript">
	function mostrar(nome, telefone, cartoes, data_cad, data_nasc, endereco, retorno, servico){

		$('#nome_dados').text(nome);		
		$('#data_cad_dados').text(data_cad);
		$('#data_nasc_dados').text(data_nasc);
		$('#cartoes_dados').text(cartoes);
		$('#telefone_dados').text(telefone);
		$('#endereco_dados').text(endereco);
		$('#retorno_dados').text(retorno);		
		$('#servico_dados').text(servico);

		$('#modalDados').modal('show');
	}
</script>



<script type="text/javascript">
	function alertar(id){
		
    $.ajax({
        url: 'paginas/' + pag + "/alertar.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success:function(mensagem){
             if (mensagem.trim() === "Salvo com Sucesso") {
             	
                //$('#btn-fechar-horarios').click();
                listar(); 
            } 
        }
    });
	}
</script>