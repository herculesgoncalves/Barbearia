<?php 
require_once("../../../conexao.php");
$tabela = 'cat_servicos';

$id = $_POST['id'];

$query2 = $pdo->query("SELECT * FROM servicos where categoria = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);
if($total_reg2 > 0){
	echo 'Não é possível excluir o registro, pois existem serviços relacionados a ele primeiro exclua os serviços e depois exclua essa categoria!';
	exit();
}

$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso';
?>