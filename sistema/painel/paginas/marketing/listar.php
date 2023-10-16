<?php 
require_once("../../../conexao.php");
$tabela = 'marketing';

$query = $pdo->query("SELECT * FROM clientes where telefone != '' and telefone is not null");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_clientes = @count($res);

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Título</th>	
	<th class="esc">Útimo Envio</th> 
	<th class="esc">Tipo Envio</th> 	
	<th class="esc">Total Envios</th> 	
	<th class="esc">Arquivo</th> 
	<th class="esc">Áudio</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$titulo = $res[$i]['titulo'];	
	$mensagem = $res[$i]['mensagem'];
	$item1 = $res[$i]['item1'];
	$item2 = $res[$i]['item2'];
	$item3 = $res[$i]['item3'];
	$item4 = $res[$i]['item4'];
	$item5 = $res[$i]['item5'];
	$item6 = $res[$i]['item6'];
	$item7 = $res[$i]['item7'];
	$item8 = $res[$i]['item8'];

	$item9 = $res[$i]['item9'];
	$item10 = $res[$i]['item10'];
	$item11 = $res[$i]['item11'];
	$item12 = $res[$i]['item12'];
	$item13 = $res[$i]['item13'];
	$item14 = $res[$i]['item14'];
	$item15 = $res[$i]['item15'];
	$item16 = $res[$i]['item16'];
	$item17 = $res[$i]['item17'];
	$item18 = $res[$i]['item18'];
	$item19 = $res[$i]['item19'];
	$item20 = $res[$i]['item20'];

	$conclusao = $res[$i]['conclusao'];
	$arquivo = $res[$i]['arquivo'];
	$audio = $res[$i]['audio'];
	$data_envio = $res[$i]['data_envio'];
	$data = $res[$i]['data'];
	$envios = $res[$i]['envios'];
	$forma_envio = $res[$i]['forma_envio'];
	$hash = $res[$i]['hash'];
	$hash2 = $res[$i]['hash2'];
	$hash3 = $res[$i]['hash3'];


	$data_envioF = implode('/', array_reverse(@explode('-', $data_envio)));
	$dataF = implode('/', array_reverse(@explode('-', $data)));

	$ocultar_audio = 'ocultar';
	if($audio != ""){
		$ocultar_audio = '';
	}

	if($forma_envio == ""){
		$forma_envio = "Todos";
	}

echo <<<HTML
<tr class="{}">
<td>
{$titulo}
</td>
<td class="esc">{$data_envioF}</td>
<td class="esc">{$forma_envio}</td>
<td class="esc">{$envios}</td>
<td class="esc"><img src="img/marketing/{$arquivo}" width="27px" class="mr-2"></td>
<td class="esc">

<audio controls="controls" class="{$ocultar_audio}" style="height:25px; width:180px">
<source src="img/marketing/{$audio}" type="audio/mp3" />
</audio>
</td>

<td>
		<big><a href="#" onclick="editar('{$id}','{$titulo}', '{$mensagem}', '{$item1}', '{$item2}', '{$item3}', '{$item4}', '{$item5}', '{$item6}', '{$item7}', '{$item8}', '{$conclusao}', '{$arquivo}', '{$audio}', '{$item9}', '{$item10}', '{$item11}', '{$item12}', '{$item13}', '{$item14}', '{$item15}', '{$item16}', '{$item17}', '{$item18}', '{$item19}', '{$item20}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$titulo}', '{$mensagem}', '{$item1}', '{$item2}', '{$item3}', '{$item4}', '{$item5}', '{$item6}', '{$item7}', '{$item8}', '{$conclusao}', '{$arquivo}', '{$audio}', '{$dataF}', '{$data_envioF}', '{$envios}', '{$item9}', '{$item10}', '{$item11}', '{$item12}', '{$item13}', '{$item14}', '{$item15}', '{$item16}', '{$item17}', '{$item18}', '{$item19}', '{$item20}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a title="Excluir Campanha" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


		<big><a href="#" onclick="disparar('{$id}','{$titulo}', '{$mensagem}', '{$item1}', '{$item2}', '{$item3}', '{$item4}', '{$item5}', '{$item6}', '{$item7}', '{$item8}', '{$conclusao}', '{$arquivo}', '{$audio}', '{$item9}', '{$item10}', '{$item11}', '{$item12}', '{$item13}', '{$item14}', '{$item15}', '{$item16}', '{$item17}', '{$item18}', '{$item19}', '{$item20}')" title="Enviar Disparos"><i class="fa fa-sign-out verde"></i></a></big>

		
		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a title="Cancelar Disparos" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-ban text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Cancelamento Campanha? <a href="#" onclick="parar('{$hash}', '{$hash2}', '{$hash3}')"><span class="text-danger">Sim</span></a></p>
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
	function editar(id, titulo, mensagem, item1, item2, item3, item4, item5, item6, item7, item8, conclusao, arquivo, audio, item9, item10, item11, item12, item13, item14, item15, item16, item17, item18, item19, item20){
		$('#id').val(id);
		$('#titulo').val(titulo);
		$('#mensagem_input').val(mensagem);
		$('#item1').val(item1);		
		$('#item2').val(item2);
		$('#item3').val(item3);
		$('#item4').val(item4);
		$('#item5').val(item5);
		$('#item6').val(item6);
		$('#item7').val(item7);
		$('#item8').val(item8);

		$('#item9').val(item9);
		$('#item10').val(item10);
		$('#item11').val(item11);
		$('#item12').val(item12);
		$('#item13').val(item13);
		$('#item14').val(item14);
		$('#item15').val(item15);
		$('#item16').val(item16);
		$('#item17').val(item17);
		$('#item18').val(item18);
		$('#item19').val(item19);
		$('#item20').val(item20);

		$('#conclusao').val(conclusao);
		
		$('#audio').val('');

						
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#foto').val('');
		$('#target').attr('src','img/marketing/' + arquivo);
	}

	function limparCampos(){
		$('#id').val('');
		$('#titulo').val('');
		$('#mensagem_input').val('');
		$('#item1').val('');
		$('#item2').val('');
		$('#item3').val('');
		$('#item4').val('');
		$('#item5').val('');
		$('#item6').val('');
		$('#item7').val('');
		$('#item8').val('');

		$('#item9').val('');
		$('#item10').val('');
		$('#item11').val('');
		$('#item12').val('');
		$('#item13').val('');
		$('#item14').val('');
		$('#item15').val('');
		$('#item16').val('');
		$('#item17').val('');
		$('#item18').val('');
		$('#item19').val('');
		$('#item20').val('');

		$('#conclusao').val('');		
		$('#foto').val('');
		$('#audio').val('');
		$('#target').attr('src','img/marketing/sem-foto.jpg');
	}
</script>


<script type="text/javascript">
	function mostrar(titulo, mensagem, item1, item2, item3, item4, item5, item6, item7, item8, conclusao, arquivo, audio, dataF, data_envioF, envios, item9, item10, item11, item12, item13, item14, item15, item16, item17, item18, item19, item20){

		$('#item1_dad').show();
		$('#item2_dad').show();
		$('#item3_dad').show();
		$('#item4_dad').show();
		$('#item5_dad').show();
		$('#item6_dad').show();
		$('#item7_dad').show();
		$('#item8_dad').show();
		$('#item9_dad').show();
		$('#item10_dad').show();
		$('#item11_dad').show();
		$('#item12_dad').show();
		$('#item13_dad').show();
		$('#item14_dad').show();
		$('#item15_dad').show();
		$('#item16_dad').show();
		$('#item17_dad').show();
		$('#item18_dad').show();
		$('#item19_dad').show();
		$('#item20_dad').show();

		if(item1 == ""){
			$('#item1_dad').hide();
		}

		if(item2 == ""){
			$('#item2_dad').hide();
		}

		if(item3 == ""){
			$('#item3_dad').hide();
		}

		if(item4 == ""){
			$('#item4_dad').hide();
		}

		if(item5 == ""){
			$('#item5_dad').hide();
		}

		if(item6 == ""){
			$('#item6_dad').hide();
		}

		if(item7 == ""){
			$('#item7_dad').hide();
		}

		if(item8 == ""){
			$('#item8_dad').hide();
		}

		if(item9 == ""){
			$('#item9_dad').hide();
		}

		if(item10 == ""){
			$('#item10_dad').hide();
		}

		if(item11 == ""){
			$('#item11_dad').hide();
		}

		if(item12 == ""){
			$('#item12_dad').hide();
		}

		if(item13 == ""){
			$('#item13_dad').hide();
		}

		if(item14 == ""){
			$('#item14_dad').hide();
		}

		if(item15 == ""){
			$('#item15_dad').hide();
		}

		if(item16 == ""){
			$('#item16_dad').hide();
		}

		if(item17 == ""){
			$('#item17_dad').hide();
		}

		if(item18 == ""){
			$('#item18_dad').hide();
		}

		if(item19 == ""){
			$('#item19_dad').hide();
		}

		if(item20 == ""){
			$('#item20_dad').hide();
		}



		$('#nome_dados').text(titulo);

		$('#titulo_dados').text(titulo);
		$('#mensagem_dados').text(mensagem);
		$('#item1_dados').text(item1);
		$('#item2_dados').text(item2);
		$('#item3_dados').text(item3);
		$('#item4_dados').text(item4);
		$('#item5_dados').text(item5);
		$('#item6_dados').text(item6);
		$('#item7_dados').text(item7);
		$('#item8_dados').text(item8);

		$('#item9_dados').text(item9);
		$('#item10_dados').text(item10);
		$('#item11_dados').text(item11);
		$('#item12_dados').text(item12);
		$('#item13_dados').text(item13);
		$('#item14_dados').text(item14);
		$('#item15_dados').text(item15);
		$('#item16_dados').text(item16);
		$('#item17_dados').text(item17);
		$('#item18_dados').text(item18);
		$('#item19_dados').text(item19);
		$('#item20_dados').text(item20);

		$('#conclusao_dados').text(conclusao);	

		$('#data_dados').text(dataF);
		$('#data_envio_dados').text(data_envioF);
		$('#envios').text(envios);	
				
		$('#target_dados').attr('src','img/marketing/' + arquivo);
		$('#audio_dados').attr('src','img/marketing/' + audio);

		if(arquivo == 'sem-foto.jpg'){
			$('#target_dados').hide();
		}else{
			$('#target_dados').show();
		}

		if(audio == ''){
			$('#audio_dados').hide();
		}else{
			$('#audio_dados').show();
		}

		$('#modalDados').modal('show');
	}
</script>



<script type="text/javascript">
	function disparar(id, titulo, mensagem, item1, item2, item3, item4, item5, item6, item7, item8, conclusao, arquivo, audio, item9, item10, item11, item12, item13, item14, item15, item16, item17, item18, item19, item20){


		$('#item1_dis').show();
		$('#item2_dis').show();
		$('#item3_dis').show();
		$('#item4_dis').show();
		$('#item5_dis').show();
		$('#item6_dis').show();
		$('#item7_dis').show();
		$('#item8_dis').show();

		$('#item9_dis').show();
		$('#item10_dis').show();
		$('#item11_dis').show();
		$('#item12_dis').show();
		$('#item13_dis').show();
		$('#item14_dis').show();
		$('#item15_dis').show();
		$('#item16_dis').show();
		$('#item17_dis').show();
		$('#item18_dis').show();
		$('#item19_dis').show();
		$('#item20_dis').show();

		if(item1 == ""){
			$('#item1_dis').hide();
		}

		if(item2 == ""){
			$('#item2_dis').hide();
		}

		if(item3 == ""){
			$('#item3_dis').hide();
		}

		if(item4 == ""){
			$('#item4_dis').hide();
		}

		if(item5 == ""){
			$('#item5_dis').hide();
		}

		if(item6 == ""){
			$('#item6_dis').hide();
		}

		if(item7 == ""){
			$('#item7_dis').hide();
		}

		if(item8 == ""){
			$('#item8_dis').hide();
		}


		if(item9 == ""){
			$('#item9_dis').hide();
		}

		if(item10 == ""){
			$('#item10_dis').hide();
		}

		if(item11 == ""){
			$('#item11_dis').hide();
		}

		if(item12 == ""){
			$('#item12_dis').hide();
		}

		if(item13 == ""){
			$('#item13_dis').hide();
		}

		if(item14 == ""){
			$('#item14_dis').hide();
		}

		if(item15 == ""){
			$('#item15_dis').hide();
		}

		if(item16 == ""){
			$('#item16_dis').hide();
		}

		if(item17 == ""){
			$('#item17_dis').hide();
		}

		if(item18 == ""){
			$('#item18_dis').hide();
		}

		if(item19 == ""){
			$('#item19_dis').hide();
		}

		if(item20 == ""){
			$('#item20_dis').hide();
		}



		$('#nome_entrada').text(titulo);		
		$('#id_entrada').val(id);	

		$('#total_clientes').text("Alterar Opção de Teste: 0");	

		if(item1 == ""){
			$('#itens_disparar').hide();
		}else{
			$('#itens_disparar').show();
		}



		$('#titulo_disparar').text(titulo);
		$('#mensagem_disparar').text(mensagem);
		$('#item1_disparar').text(item1);
		$('#item2_disparar').text(item2);
		$('#item3_disparar').text(item3);
		$('#item4_disparar').text(item4);
		$('#item5_disparar').text(item5);
		$('#item6_disparar').text(item6);
		$('#item7_disparar').text(item7);
		$('#item8_disparar').text(item8);

		$('#item9_disparar').text(item9);
		$('#item10_disparar').text(item10);
		$('#item11_disparar').text(item11);
		$('#item12_disparar').text(item12);
		$('#item13_disparar').text(item13);
		$('#item14_disparar').text(item14);
		$('#item15_disparar').text(item15);
		$('#item16_disparar').text(item16);
		$('#item17_disparar').text(item17);
		$('#item18_disparar').text(item18);
		$('#item19_disparar').text(item19);
		$('#item20_disparar').text(item20);

		$('#conclusao_disparar').text(conclusao);	

		$('#clientes').val('Teste');	
		
				
		$('#target_disparar').attr('src','img/marketing/' + arquivo);
		$('#audio_disparar').attr('src','img/marketing/' + audio);

		if(arquivo == 'sem-foto.jpg'){
			$('#target_disparar').hide();
		}else{
			$('#target_disparar').show();
		}

		if(audio == ''){
			$('#audio_disparar').hide();
		}else{
			$('#audio_disparar').show();
		}

		$('#modalEntrada').modal('show');
	}
</script>


<script type="text/javascript">
	function parar(hash, hash2, hash3){
		pararDisparo(hash);
		pararDisparo(hash2);
		pararDisparo(hash3);
	}
</script>


