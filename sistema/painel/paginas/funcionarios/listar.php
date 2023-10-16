<?php 
require_once("../../../conexao.php");
$tabela = 'usuarios';

if($tipo_comissao == 'Porcentagem'){
		$tipo_comissao = '%';
	}


$query = $pdo->query("SELECT * FROM $tabela where nivel != 'Administrador' ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Email</th> 	
	<th class="esc">CPF</th> 	
	<th class="esc">Cargo</th> 	
	<th class="esc">Cadastro</th>
	<th class="esc">Comissão <small>({$tipo_comissao})</small></th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$email = $res[$i]['email'];
	$cpf = $res[$i]['cpf'];
	$senha = $res[$i]['senha'];
	$nivel = $res[$i]['nivel'];
	$data = $res[$i]['data'];
	$ativo = $res[$i]['ativo'];
	$telefone = $res[$i]['telefone'];
	$endereco = $res[$i]['endereco'];
	$foto = $res[$i]['foto'];
	$atendimento = $res[$i]['atendimento'];
	$tipo_chave = $res[$i]['tipo_chave'];
	$chave_pix = $res[$i]['chave_pix'];
	$intervalo = $res[$i]['intervalo'];
	$comissao = $res[$i]['comissao'];

	$dataF = implode('/', array_reverse(explode('-', $data)));
	
	
	$senha = '*******';
	

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

		$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

		if($tipo_comissao == '%'){
			$comissaoF = number_format($comissao, 0, ',', '.').'%';
			
			}else{
				$comissaoF = 'R$ '.number_format($comissao, 2, ',', '.');
			}

			if($comissao == ""){
				$comissaoF = "";
			}


echo <<<HTML
<tr class="{$classe_linha}">
<td>
<img src="img/perfil/{$foto}" width="27px" class="mr-2">
{$nome}
</td>
<td class="esc">{$email}</td>
<td class="esc">{$cpf}</td>
<td class="esc">{$nivel}</td>
<td class="esc">{$dataF}</td>
<td class="esc">{$comissaoF}</td>
<td>
		<big><a href="#" onclick="editar('{$id}','{$nome}', '{$email}', '{$telefone}', '{$cpf}', '{$nivel}', '{$endereco}', '{$foto}', '{$atendimento}', '{$tipo_chave}', '{$chave_pix}', '{$intervalo}', '{$comissao}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$email}', '{$cpf}', '{$senha}', '{$nivel}', '{$dataF}', '{$ativo}', '{$telefone}', '{$endereco}', '{$foto}', '{$atendimento}', '{$tipo_chave}', '{$chave_pix}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



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

		
		<a href="#" onclick="dias('{$id}', '{$nome}')" title="Ver Dias"><i class="fa fa-calendar text-danger"></i></a>


		<big><a href="http://api.whatsapp.com/send?1=pt_BR&phone=$whats&text=" target="_blank" title="Abrir Whatsapp"><i class="fa fa-whatsapp verde"></i></a></big>

			<a href="#" onclick="servico('{$id}', '{$nome}')" title="Definir Serviços"><i class="fa fa-briefcase" style="color:#a60f4b"></i></a>


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
	function editar(id, nome, email, telefone, cpf, nivel, endereco, foto, atendimento, tipo_chave, chave_pix, intervalo, comissao){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#email').val(email);
		$('#telefone').val(telefone);
		$('#cpf').val(cpf);
		$('#cargo').val(nivel).change();
		$('#endereco').val(endereco);
		$('#atendimento').val(atendimento).change();
		$('#chave_pix').val(chave_pix);
		$('#tipo_chave').val(tipo_chave).change();
		$('#intervalo').val(intervalo);
		$('#comissao').val(comissao);
		
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#foto').val('');
		$('#target').attr('src','img/perfil/' + foto);
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#email').val('');
		$('#cpf').val('');
		$('#endereco').val('');
		$('#foto').val('');
		$('#chave_pix').val('');
		$('#target').attr('src','img/perfil/sem-foto.jpg');
		$('#intervalo').val('');
		$('#comissao').val('');
	}
</script>



<script type="text/javascript">
	function mostrar(nome, email, cpf, senha, nivel, data, ativo, telefone, endereco, foto, atendimento, tipo_chave, chave_pix){

		$('#nome_dados').text(nome);
		$('#email_dados').text(email);
		$('#cpf_dados').text(cpf);
		$('#senha_dados').text(senha);
		$('#nivel_dados').text(nivel);
		$('#data_dados').text(data);
		$('#ativo_dados').text(ativo);
		$('#telefone_dados').text(telefone);
		$('#endereco_dados').text(endereco);
		$('#atendimento_dados').text(atendimento);
		$('#tipo_chave_dados').text(tipo_chave);
		$('#chave_pix_dados').text(chave_pix);

		$('#target_mostrar').attr('src','img/perfil/' + foto);

		$('#modalDados').modal('show');
	}
</script>




<script type="text/javascript">
	function horarios(id, nome){

		$('#nome_horarios').text(nome);		
		$('#id_horarios').val(id);		

		$('#modalHorarios').modal('show');
		listarHorarios(id);
	}
</script>


<script type="text/javascript">
	function dias(id, nome){

		$('#nome_dias').text(nome);		
		$('#id_dias').val(id);		

		$('#modalDias').modal('show');
		listarDias(id);
	}
</script>



<script type="text/javascript">
	function servico(id, nome){

		$('#nome_servico').text(nome);		
		$('#id_servico').val(id);		

		$('#modalServicos').modal('show');
		listarServicos(id);
	}
</script>
