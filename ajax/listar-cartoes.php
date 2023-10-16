<?php 
require_once("../sistema/conexao.php");

$telefone = @$_POST['tel'];

$query = $pdo->query("SELECT * FROM clientes where telefone LIKE '$telefone' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$cartoes = $res[0]['cartoes'];
	$id_cliente = $res[0]['id'];
	


?>


<div class="row">
 <?php 
for($i=1; $i<=$quantidade_cartoes; $i++){ 
		if($cartoes >= $i){
			$valor = 0;
			$opacity = 1;
		}else{
			$valor = 1;
			$opacity = 0.4;		}
	?>

<div class="col-md-1 col-2" align="center">
<img src="images/favicon.png" width="100%" style="filter: grayscale(<?php echo $valor ?>); filter: opacity(<?php echo $opacity ?>)">
</div>
<?php } ?>
</div>

<br>
<div align="center"><small><small>Você possui <?php echo $cartoes ?> de <?php echo $quantidade_cartoes ?> cartões Fidelidade</small></small></div>


<?php } ?>