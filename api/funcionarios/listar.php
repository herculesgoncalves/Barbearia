<?php 
require_once("../../sistema/conexao.php");
$url_img = $_POST['url_img'];
$query = $pdo->query("SELECT * FROM usuarios order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i<$total_reg; $i++){
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

	$whatsapp = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	$dataF = implode('/', array_reverse(explode('-', $data)));
	
	if($nivel == 'Administrador'){
		$senhaF = '******';
	}else{
		$senhaF = $senha;
	}

		if($ativo != "Sim"){
			$classe_ativo = 'item-footer';
			$valor_op = '0.3';
		}else{
			$classe_ativo = '';
			$valor_op = '1';
		}

		

		 echo '<li>';
             echo '<a href="#" class="item-link item-content" onclick="editarFunc('.$id.', \''.$nome.'\', \''.$email.'\', \''.$telefone.'\', \''.$nivel.'\', \''.$dataF.'\', \''.$foto.'\', \''.$ativo.'\', \''.$endereco.'\', \''.$whatsapp.'\')">'; 
             echo ' <div class="item-media"><img src="'.$url_img.'perfil/'.$foto.'" width="40px" height="40px" style="object-fit: cover; opacity:'.$valor_op.'"></div>';              
              echo ' <div class="item-inner">';
                echo ' <div class="item-title '.$classe_ativo.'" style="font-size:11px">';
                  echo ' <div class="item-header " style="font-size:9px">Cargo: '.$nivel.'</div>'.$nome;
                  echo'<div class="item-footer" style="font-size:9px">'.$email.'</div>';
                 echo '</div>';
                echo ' <div class="item-after" style="font-size:9px">'.$dataF.'</div>';
               echo '</div>';
             echo '</a>';
           echo '</li>';

	}
}

?>

