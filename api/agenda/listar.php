<?php 
require_once("../../sistema/conexao.php");
$url_img = $_POST['url_img'];

$tabela = 'pagar';
$data_hoje = date('Y-m-d');

$dataInicial = @$_POST['dataInicial'];
$funcionario = @$_POST['id_usuario'];


$query = $pdo->query("SELECT * FROM agendamentos where funcionario = '$funcionario' and data = '$dataInicial' ORDER BY hora asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

for($i=0; $i < $total_reg; $i++){
	$id = $res[$i]['id'];
$funcionario = $res[$i]['funcionario'];
$cliente = $res[$i]['cliente'];
$hora = $res[$i]['hora'];
$data = $res[$i]['data'];
$usuario = $res[$i]['usuario'];
$data_lanc = $res[$i]['data_lanc'];
$obs = $res[$i]['obs'];
$status = $res[$i]['status'];
$servico = $res[$i]['servico'];

$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));


if($status == 'Concluído'){		
	$classe_linha = '';
}else{		
	$classe_linha = 'text-muted';
}



if($status == 'Agendado'){
	$imagem = 'icone-relogio.png';
	$classe_status = '';
	$oc = '';	
}else{
	$imagem = 'icone-relogio-verde.png';
	$classe_status = 'ocultar';
	$oc = 'none';
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu = $res2[0]['nome'];
}else{
	$nome_usu = 'Cliente';
}


$query2 = $pdo->query("SELECT * FROM servicos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_serv = $res2[0]['nome'];
	$valor_serv = $res2[0]['valor'];
}else{
	$nome_serv = 'Não Lançado';
	$valor_serv = '';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];
	$total_cartoes = $res2[0]['cartoes'];
}else{
	$nome_cliente = 'Sem Cliente';
	$total_cartoes = 0;
}

if($total_cartoes >= $quantidade_cartoes and $status == 'Agendado'){
	$ocultar_cartoes = '';
}else{
	$ocultar_cartoes = 'none';
}


		 echo '<li>';
             echo '<a href="#" class="item-link item-content" onclick="editarAgenda('.$id.', \''.$nome_usu.'\', \''.$nome_cliente.'\', \''.$horaF.'\', \''.$dataF.'\', \''.$obs.'\', \''.$status.'\', \''.$nome_serv.'\', \''.$cliente.'\', \''.$servico.'\', \''.$funcionario.'\', \''.$valor_serv.'\', \''.$oc.'\')">'; 
               echo ' <div class="item-media"><img src="'.$url_img.$imagem.'" width="40px" height="40px" style="object-fit: cover;"></div>';                        
              echo ' <div class="item-inner">';
                echo ' <div class="item-title" style="font-size:12px;">';
                  echo ' <div class="item-header " style="font-size:9px">Serviço: '.$nome_serv.'</div><b>'.$horaF.'</b>';
                  echo'<div class="item-footer" style="font-size:9px"> Cliente: '.$nome_cliente.' <img src="'.$url_img.'presente.jpg" width="15px" height="15px" style="object-fit: cover; display:'.$ocultar_cartoes.'">  </div>';
                 echo '</div>';
                
               echo '</div>';
             echo '</a>';
           echo '</li>';

	}


	
}else{
	echo '<br><small><small><div align="center">Não encontramos nenhum registro!</div></small></small>';
}

?>

