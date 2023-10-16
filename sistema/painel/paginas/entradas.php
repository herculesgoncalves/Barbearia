<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'entradas';

//verificar se ele tem a permissão de estar nessa página
if(@$entradas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

