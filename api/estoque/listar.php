<?php 
require_once("../../sistema/conexao.php");
$url_img = $_POST['url_img'];
$query = $pdo->query("SELECT * FROM produtos order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i<$total_reg; $i++){
		$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$descricao = $res[$i]['descricao'];
	$categoria = $res[$i]['categoria'];
	$valor_compra = $res[$i]['valor_compra'];
	$valor_venda = $res[$i]['valor_venda'];
	$foto = $res[$i]['foto'];
	$estoque = $res[$i]['estoque'];
	$nivel_estoque = $res[$i]['nivel_estoque'];

	$valor_vendaF = number_format($valor_venda, 2, ',', '.');
	$valor_compraF = number_format($valor_compra, 2, ',', '.');

	

		$query2 = $pdo->query("SELECT * FROM cat_produtos where id = '$categoria'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if($total_reg2 > 0){
			$nome_cat = $res2[0]['nome'];
		}else{
			$nome_cat = 'Sem Referência!';
		}


		if($nivel_estoque >= $estoque){

		 echo '<li>';
             echo '<a href="#" class="item-link item-content" onclick="editarEstoque('.$id.', \''.$nome.'\', \''.$descricao.'\', \''.$nome_cat.'\', \''.$valor_compraF.'\', \''.$valor_vendaF.'\', \''.$foto.'\', \''.$estoque.'\', \''.$nivel_estoque.'\')">'; 
             echo ' <div class="item-media"><img src="'.$url_img.'produtos/'.$foto.'" width="40px" height="40px" style="object-fit: cover; "></div>';              
              echo ' <div class="item-inner">';
                echo ' <div class="item-title" style="font-size:11px">';
                  echo ' <div class="item-header " style="font-size:9px">Nível Mínimo: '.$nivel_estoque.' </div>'.$nome;
                  echo'<div class="item-footer" style="font-size:9px">Categoria: '.$nome_cat.'</div>';
                 echo '</div>';
                echo ' <div class="item-after" style="font-size:10px">Estoque <b> : ' .$estoque.'</b></div>';
               echo '</div>';
             echo '</a>';
           echo '</li>';

       }

	}
}

?>

