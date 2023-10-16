<?php 
require_once("../../../conexao.php");
$tabela = 'saidas';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Produto</th>	
	<th class="">Quantidade</th> 	
	<th class="esc">Motivo</th> 	
	<th class="esc">Usuário Lançou</th> 
	<th class="esc">Data</th>	
	
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$produto = $res[$i]['produto'];	
	$quantidade = $res[$i]['quantidade'];
	$motivo = $res[$i]['motivo'];
	$usuario = $res[$i]['usuario'];
	$data = $res[$i]['data'];
			

		$query2 = $pdo->query("SELECT * FROM produtos where id = '$produto'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_produto = $res2[0]['nome'];
			$foto_produto = $res2[0]['foto'];
		}else{
			$nome_produto = 'Sem Referência!';
			$foto_produto = 'sem-foto.jpg';
		}


		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_usuario = $res2[0]['nome'];
			
		}else{
			$nome_usuario = 'Sem Referência!';
			
		}


		$dataF = implode('/', array_reverse(explode('-', $data)));
		


echo <<<HTML
<tr class="">
<td>
<img src="img/produtos/{$foto_produto}" width="27px" class="mr-2">
{$nome_produto}
</td>
<td class="">{$quantidade}</td>
<td class="esc">{$motivo}</td>
<td class="esc"> {$nome_usuario}</td>
<td class="esc">{$dataF}</td>

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

