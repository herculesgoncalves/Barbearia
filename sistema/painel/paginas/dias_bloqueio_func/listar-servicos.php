<?php 
require_once("../../../conexao.php");
$tabela = 'dias_bloqueio';

@session_start();
$id_usuario = $_SESSION['id'];

$id_func = $_POST['func'];

$pdo->query("DELETE FROM $tabela where data < curDate()");

$query = $pdo->query("SELECT * FROM $tabela where funcionario = '$id_usuario' order by data asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small><small>
	<table class="table table-hover">
	<thead> 
	<tr> 
	<th>Data</th>	
	<th>Lançado Por</th>	
	<th>Excluir</th>
	
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$data = $res[$i]['data'];
	$usuario = $res[$i]['usuario'];
	
	
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);	
$nome_servico = @$res2[0]['nome'];

$dataF = implode('/', array_reverse(@explode('-', $data)));

echo <<<HTML
<tr class="">
<td class="">{$dataF}</td>
<td class="">{$nome_servico}</td>
<td>


		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluirServico('{$id}', '{$id_func}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>



		</td>
</tr>
HTML;

}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-servico-excluir"></div></small>
</table>
</small></small>
HTML;


}else{
	echo '<small>Não possui nenhuma data Cadastrada!</small>';
}

?>


<script type="text/javascript">
	function excluirServico(id, func){
    $.ajax({
        url: 'paginas/' + pag + "/excluir-servico.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {            
            if (mensagem.trim() == "Excluído com Sucesso") {   
            	            
                listarServicos(func);                   
            } else {
                $('#mensagem-servico-excluir').addClass('text-danger')
                $('#mensagem-servico-excluir').text(mensagem)
            }

        },      

    });
}
</script>