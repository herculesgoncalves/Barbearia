<?php 
require_once("../../sistema/conexao.php");


$query = $pdo->query("SELECT * FROM produtos where valor_venda > 0 and estoque > 0 ORDER BY nome asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].'</option>';
	}
}else{
	echo '<option value="0">Cadastre um Cargo</option>';
}


?>

