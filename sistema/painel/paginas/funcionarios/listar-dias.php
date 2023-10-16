<?php 
require_once("../../../conexao.php");
$tabela = 'dias';

$id_func = $_POST['func'];

$query = $pdo->query("SELECT * FROM $tabela where funcionario = '$id_func' ORDER BY id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small><small>
	<table class="table table-hover">
	<thead> 
	<tr> 
	<th>Dia</th>	
	<th>Jornada</th>	
	<th>Almoço</th>		
	<th>Excluir</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$dia = $res[$i]['dia'];
	$inicio = $res[$i]['inicio'];
	$final = $res[$i]['final'];
	$inicio_almoco = $res[$i]['inicio_almoco'];
	$final_almoco = $res[$i]['final_almoco'];

	if($inicio_almoco == '00:00:00'){
		$inicio_almoco = 'Não Lançado';
	}

	if($final_almoco == '00:00:00'){
		$final_almoco = 'Não Lançado';
	}
	
echo <<<HTML
<tr class="">
<td class="">{$dia}</td>
<td class="">{$inicio} / {$final}</td>
<td class="">{$inicio_almoco} / {$final_almoco}</td>

<td>


		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluirDias('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

		<big><a href="#" onclick="editarDias('{$id}','{$dia}', '{$inicio}', '{$final}', '{$inicio_almoco}', '{$final_almoco}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		</td>

</tr>
HTML;

}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-dias-excluir"></div></small>
</table>
</small></small>
HTML;


}else{
	echo '<small>Não possui nenhum Dia Cadastrado!</small>';
}

?>


<script type="text/javascript">
	function excluirDias(id){
    $.ajax({
        url: 'paginas/' + pag + "/excluir-dias.php",
        method: 'POST',
        data: {id},
        dataType: "text",

        success: function (mensagem) {            
            if (mensagem.trim() == "Excluído com Sucesso") {   
            	var func = $("#id_dias").val();             
                listarDias(func);                
            } else {
                $('#mensagem-dias-excluir').addClass('text-danger')
                $('#mensagem-dias-excluir').text(mensagem)
            }

        },      

    });
}


function editarDias(id, dia, inicio, final, inicio_almoco, final_almoco){
		$('#id_d').val(id);
		$('#dias').val(dia).change();
		$('#inicio').val(inicio);
		$('#final').val(final);
		$('#inicio_almoco').val(inicio_almoco);
		$('#final_almoco').val(final_almoco);	
	}


	function limparCampos(){
		$('#id_d').val('');
		
	}

</script>