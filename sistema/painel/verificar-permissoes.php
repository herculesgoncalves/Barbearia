<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];


$home = 'ocultar';
$configuracoes = 'ocultar';
$comanda = 'ocultar';
$marketing = 'ocultar';
$calendario = 'ocultar';

//grupo pessoas
$usuarios = 'ocultar';
$funcionarios = 'ocultar';
$clientes = 'ocultar';
$clientes_retorno = 'ocultar';
$fornecedores = 'ocultar';


//grupo cadastros
$servicos = 'ocultar';
$cargos = 'ocultar';
$cat_servicos = 'ocultar';
$grupos = 'ocultar';
$acessos = 'ocultar';
$pgto = 'ocultar';
$dias_bloqueio = 'ocultar';

//grupo produtos
$produtos = 'ocultar';
$cat_produtos = 'ocultar';
$estoque = 'ocultar';
$saidas = 'ocultar';
$entradas = 'ocultar';


//grupo financeiro
$vendas = 'ocultar';
$compras = 'ocultar';
$pagar = 'ocultar';
$receber = 'ocultar';
$comissoes = 'ocultar';


//agendamentos / servico
$agendamentos = 'ocultar';
$servicos_agenda = 'ocultar';


//relatorios
$rel_produtos = 'ocultar';
$rel_entradas = 'ocultar';
$rel_saidas = 'ocultar';
$rel_comissoes = 'ocultar';
$rel_contas = 'ocultar';
$rel_aniv = 'ocultar';
$rel_lucro = 'ocultar';
$rel_servicos = 'ocultar';

//dados site
$textos_index = 'ocultar';
$comentarios = 'ocultar';




$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];

		if($chave == 'home'){
			$home = '';
		}


		if($chave == 'configuracoes'){
			$configuracoes = '';
		}


		if($chave == 'comanda'){
			$comanda = '';
		}

		if($chave == 'marketing'){
			$marketing = '';
		}

		if($chave == 'calendario'){
			$calendario = '';
		}





		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'funcionarios'){
			$funcionarios = '';
		}

		if($chave == 'clientes'){
			$clientes = '';
		}

		if($chave == 'clientes_retorno'){
			$clientes_retorno = '';
		}

		if($chave == 'fornecedores'){
			$fornecedores = '';
		}





		if($chave == 'servicos'){
			$servicos = '';
		}

		if($chave == 'cargos'){
			$cargos = '';
		}

		if($chave == 'cat_servicos'){
			$cat_servicos = '';
		}

		if($chave == 'grupos'){
			$grupos = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}

		if($chave == 'pgto'){
			$pgto = '';
		}

		if($chave == 'dias_bloqueio'){
			$dias_bloqueio = '';
		}





		if($chave == 'produtos'){
			$produtos = '';
		}

		if($chave == 'cat_produtos'){
			$cat_produtos = '';
		}

		if($chave == 'estoque'){
			$estoque = '';
		}

		if($chave == 'saidas'){
			$saidas = '';
		}

		if($chave == 'entradas'){
			$entradas = '';
		}





		if($chave == 'compras'){
			$compras = '';
		}

		if($chave == 'vendas'){
			$vendas = '';
		}

		if($chave == 'pagar'){
			$pagar = '';
		}

		if($chave == 'receber'){
			$receber = '';
		}

		if($chave == 'comissoes'){
			$comissoes = '';
		}




		if($chave == 'agendamentos'){
			$agendamentos = '';
		}

		if($chave == 'servicos_agenda'){
			$servicos_agenda = '';
		}




		if($chave == 'rel_produtos'){
			$rel_produtos = '';
		}

		if($chave == 'rel_entradas'){
			$rel_entradas = '';
		}

		if($chave == 'rel_saidas'){
			$rel_saidas = '';
		}

		if($chave == 'rel_comissoes'){
			$rel_comissoes = '';
		}

		if($chave == 'rel_contas'){
			$rel_contas = '';
		}

		if($chave == 'rel_aniv'){
			$rel_aniv = '';
		}

		if($chave == 'rel_lucro'){
			$rel_lucro = '';
		}

		if($chave == 'rel_servicos'){
			$rel_servicos = '';
		}





		if($chave == 'textos_index'){
			$textos_index = '';
		}

		if($chave == 'comentarios'){
			$comentarios = '';
		}



	}

}



if($home != 'ocultar'){
	$pag_inicial = 'home';
}else if($atendimento == 'Sim'){
	$pag_inicial = 'agenda';
}else{
	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){	
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pag_inicial = $res2[0]['chave'];		

	}
}



if($usuarios == 'ocultar' and $funcionarios == 'ocultar' and $clientes == 'ocultar' and $clientes_retorno == 'ocultar' and $fornecedores == 'ocultar'){
	$menu_pessoas = 'ocultar';
}else{
	$menu_pessoas = '';
}



if($servicos == 'ocultar' and $cargos == 'ocultar' and $cat_servicos == 'ocultar' and $grupos == 'ocultar' and $acessos == 'ocultar' and $pgto == 'ocultar' and $dias_bloqueio == 'ocultar'){
	$menu_cadastros = 'ocultar';
}else{
	$menu_cadastros = '';
}



if($produtos == 'ocultar' and $cat_produtos == 'ocultar' and $estoque == 'ocultar' and $saidas == 'ocultar' and $entradas == 'ocultar'){
	$menu_produtos = 'ocultar';
}else{
	$menu_produtos = '';
}



if($compras == 'ocultar' and $vendas == 'ocultar' and $pagar == 'ocultar' and $receber == 'ocultar' and $comissoes == 'ocultar'){
	$menu_financeiro = 'ocultar';
}else{
	$menu_financeiro = '';
}



if($agendamentos == 'ocultar' and $servicos_agenda == 'ocultar' ){
	$menu_agendamentos = 'ocultar';
}else{
	$menu_agendamentos = '';
}



if($rel_produtos == 'ocultar' and $rel_lucro == 'ocultar' and $rel_aniv == 'ocultar' and $rel_contas == 'ocultar' and $rel_comissoes == 'ocultar' and $rel_saidas == 'ocultar' and $rel_entradas == 'ocultar' and $rel_servicos == 'ocultar'){
	$menu_relatorio = 'ocultar';
}else{
	$menu_relatorio = '';
}



if($textos_index == 'ocultar' and $comentarios == 'ocultar' ){
	$menu_site = 'ocultar';
}else{
	$menu_site = '';
}


 ?>