<?php 
require_once("../../sistema/conexao.php");
$url_img = $_POST['url_img'];
$query = $pdo->query("SELECT * FROM fornecedores order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i<$total_reg; $i++){
		$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$data_cad = $res[$i]['data_cad'];	
	$telefone = $res[$i]['telefone'];
	$endereco = $res[$i]['endereco'];
	$tipo_chave = $res[$i]['tipo_chave'];
	$chave_pix = $res[$i]['chave_pix'];

	

	$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
	
	$whats = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

		

		 echo '<li>';
             echo '<a href="#" class="item-link item-content" onclick="editarForn('.$id.', \''.$nome.'\', \''.$telefone.'\', \''.$data_cadF.'\', \''.$whats.'\', \''.$tipo_chave.'\', \''.$chave_pix.'\', \''.$endereco.'\')">'; 
                         
              echo ' <div class="item-inner">';
                echo ' <div class="item-title" style="font-size:11px">';
                  echo ' <div class="item-header " style="font-size:9px">Endereço: '.$endereco.'</div>'.$nome;
                  echo'<div class="item-footer" style="font-size:9px">'.$telefone.'</div>';
                 echo '</div>';
                echo ' <div class="item-after" style="font-size:9px">'.$data_cadF.'</div>';
               echo '</div>';
             echo '</a>';
           echo '</li>';

	}
}

?>

