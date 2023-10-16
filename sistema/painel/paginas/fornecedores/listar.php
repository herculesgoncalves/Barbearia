<?php 
require_once("../../../conexao.php");
$tabela = 'fornecedores';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
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
	<th class="esc">Cadastro</th> 	
	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	
	$data_cad = $res[$i]['data_cad'];	
	$telefone = $res[$i]['telefone'];
	$endereco = $res[$i]['endereco'];
	$tipo_chave = $res[$i]['tipo_chave'];
	$chave_pix = $res[$i]['chave_pix'];

	

	$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
	
	$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	


echo <<<HTML
<tr class="">
<td>{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$data_cadF}</td>

<td>
		<big><a href="#" onclick="editar('{$id}','{$nome}', '{$telefone}', '{$endereco}', '{$tipo_chave}', '{$chave_pix}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$data_cadF}', '{$endereco}', '{$tipo_chave}', '{$chave_pix}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



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


		<big><a href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=" target="_blank" title="Abrir Whatsapp"><i class="fa fa-whatsapp verde"></i></a></big>

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
	function editar(id, nome, telefone, endereco, tipo_chave, chave_pix){
		$('#id').val(id);
		$('#nome').val(nome);		
		$('#telefone').val(telefone);		
		$('#endereco').val(endereco);
		$('#chave_pix').val(chave_pix);
		$('#tipo_chave').val(tipo_chave).change();
				
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#endereco').val('');
		$('#chave_pix').val('');
		
	}
</script>



<script type="text/javascript">
	function mostrar(nome, telefone, data_cad, endereco, tipo_chave, chave_pix){

		$('#nome_dados').text(nome);		
		$('#data_cad_dados').text(data_cad);
		
		$('#telefone_dados').text(telefone);
		$('#endereco_dados').text(endereco);
		$('#tipo_chave_dados').text(tipo_chave);
		$('#chave_pix_dados').text(chave_pix);		

		$('#modalDados').modal('show');
	}
</script>