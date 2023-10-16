<?php 
require_once("../../sistema/conexao.php");

$id_usuario = $_POST['id_usuario'];


$query = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$atendimento = $res[0]['atendimento'];
$nivel = $res[0]['nivel'];


$home = 'none';
$configuracoes = 'none';

//grupo pessoas
$usuarios = 'none';
$funcionarios = 'none';
$clientes = 'none';
$clientes_retorno = 'none';
$fornecedores = 'none';


//grupo cadastros
$servicos = 'none';
$cargos = 'none';
$cat_servicos = 'none';
$grupos = 'none';
$acessos = 'none';
$pgto = 'none';

//grupo produtos
$produtos = 'none';
$cat_produtos = 'none';
$estoque = 'none';
$saidas = 'none';
$entradas = 'none';


//grupo financeiro
$vendas = 'none';
$compras = 'none';
$pagar = 'none';
$receber = 'none';
$comissoes = 'comissoes';


//agendamentos / servico
$agendamentos = 'none';
$servicos_agenda = 'none';


//relatorios
$rel_produtos = 'none';
$rel_entradas = 'none';
$rel_saidas = 'none';
$rel_comissoes = 'none';
$rel_contas = 'none';
$rel_aniv = 'none';
$rel_lucro = 'none';
$rel_servicos = 'none';

//dados site
$textos_index = 'none';
$comentarios = 'none';




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



if($home != 'none'){
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



if($usuarios == 'none' and $funcionarios == 'none' and $clientes == 'none' and $clientes_retorno == 'none' and $fornecedores == 'none'){
	$menu_pessoas = 'none';
}else{
	$menu_pessoas = '';
}



if($servicos == 'none' and $cargos == 'none' and $cat_servicos == 'none' and $grupos == 'none' and $acessos == 'none' and $pgto == 'none'){
	$menu_cadastros = 'none';
}else{
	$menu_cadastros = '';
}



if($produtos == 'none' and $cat_produtos == 'none' and $estoque == 'none' and $saidas == 'none' and $entradas == 'none'){
	$menu_produtos = 'none';
}else{
	$menu_produtos = '';
}



if($compras == 'none' and $vendas == 'none' and $pagar == 'none' and $receber == 'none'){
	$menu_financeiro = 'none';
}else{
	$menu_financeiro = '';
}



if($agendamentos == 'none' and $servicos_agenda == 'none' ){
	$menu_agendamentos = 'none';
}else{
	$menu_agendamentos = '';
}



if($rel_produtos == 'none' and $rel_lucro == 'none' and $rel_aniv == 'none' and $rel_contas == 'none' and $rel_comissoes == 'none' and $rel_saidas == 'none' and $rel_entradas == 'none' and $rel_servicos == 'none'){
	$menu_relatorio = 'none';
}else{
	$menu_relatorio = '';
}



if($textos_index == 'none' and $comentarios == 'none' ){
	$menu_site = 'none';
}else{
	$menu_site = '';
}



$dados = array(
			'home' => $home,
			'usuarios' => $usuarios,
			'funcionarios' => $funcionarios,
			'clientes' => $clientes,
			'clientes_retorno' => $clientes_retorno,
			'fornecedores' => $fornecedores,
			'vendas' => $vendas,
			'compras' => $compras,
			'receber' => $receber,
			'pagar' => $pagar,			
			'estoque' => $estoque,
			'atendimento' => $atendimento,
			'menu_financeiro' => $menu_financeiro,
			'menu_pessoas' => $menu_pessoas,

			
);


$result = json_encode($dados);
echo $result;


 ?>