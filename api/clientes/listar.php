<?php 
require_once("../../sistema/conexao.php");
$url_img = $_POST['url_img'];
$query = $pdo->query("SELECT * FROM clientes order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i<$total_reg; $i++){
		$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$data_nasc = $res[$i]['data_nasc'];
	$data_cad = $res[$i]['data_cad'];	
	$telefone = $res[$i]['telefone'];
	$endereco = $res[$i]['endereco'];
	$cartoes = $res[$i]['cartoes'];
	$data_retorno = $res[$i]['data_retorno'];
	$ultimo_servico = $res[$i]['ultimo_servico'];
	$cpf = $res[$i]['cpf'];

	$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
	$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
	$data_retornoF = implode('/', array_reverse(explode('-', $data_retorno)));
	
	if($data_nascF == '00/00/0000'){
		$data_nascF = 'Sem Lançamento';
	}
	
	
	$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

		

		 echo '<li>';
             echo '<a href="#" class="item-link item-content" onclick="editarCliente('.$id.', \''.$nome.'\', \''.$telefone.'\', \''.$data_cadF.'\', \''.$whats.'\', \''.$cartoes.'\', \''.$data_retornoF.'\')">'; 
                         
              echo ' <div class="item-inner">';
                echo ' <div class="item-title" style="font-size:11px">';
                  echo ' <div class="item-header " style="font-size:9px">Cartões: '.$cartoes.'</div>'.$nome;
                  echo'<div class="item-footer" style="font-size:9px">'.$telefone.'</div>';
                 echo '</div>';
                echo ' <div class="item-after" style="font-size:9px">'.$data_cadF.'</div>';
               echo '</div>';
             echo '</a>';
           echo '</li>';

	}
}else{
	echo '<br><small><small><div align="center">Não encontramos nenhum registro!</div></small></small>';
}

?>

