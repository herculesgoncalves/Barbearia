<?php 
require_once("../../../conexao.php");
$tabela = 'comentarios';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Cliente</th>	
	<th class="esc">Texto</th> 		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];	
	$foto = $res[$i]['foto'];
	$texto = $res[$i]['texto'];
	$nome = $res[$i]['nome'];
	$ativo = $res[$i]['ativo'];

	$textoF = mb_strimwidth($texto, 0, 100, "...");

	if($ativo == 'Sim'){
			$icone = 'fa-check-square';
			$titulo_link = 'Desativar Item';
			$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'fa-square-o';
			$titulo_link = 'Ativar Item';
			$acao = 'Sim';
			$classe_linha = 'text-muted';
		}


echo <<<HTML
<tr class="{$classe_linha}">
<td>
<img src="img/comentarios/{$foto}" width="27px" class="mr-2">
{$nome}
</td>
<td class="esc">{$textoF}</td>
<td>
		<big><a href="#" onclick="editar('{$id}','{$nome}', '{$texto}', '{$foto}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$texto}', '{$foto}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>



		<big><a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>


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
	function editar(id, nome, texto, foto){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#texto').val(texto);
					
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#foto').val('');
		$('#target').attr('src','img/comentarios/' + foto);
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#texto').val('');
		
		$('#foto').val('');
		$('#target').attr('src','img/comentarios/sem-foto.jpg');
	}
</script>



<script type="text/javascript">
	function mostrar(nome, texto, foto){

		$('#nome_dados').text(nome);
		$('#texto_dados').text(texto);
				
		$('#target_mostrar').attr('src','img/comentarios/' + foto);

		$('#modalDados').modal('show');
	}
</script>