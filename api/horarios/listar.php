<?php 
require_once("../../sistema/conexao.php");

$tabela = 'horarios';

$id_func = $_POST['id_usuario'];

$query = $pdo->query("SELECT * FROM $tabela where funcionario = '$id_func' ORDER BY horario asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){

for($i=0; $i < $total_reg; $i++){
	$id = $res[$i]['id'];
  $horario = $res[$i]['horario'];
  $horarioF = date("H:i", strtotime($horario));
  $data = $res[$i]['data'];
  $dataF = implode('/', array_reverse(explode('-', $data)));

  if($data != ""){
    $temp = ' <span style="color:red"><small>(Temporário Data: '.$dataF.'</small></span>';
  }else{
    $temp = '';
  }

		 echo '<li>';
             echo '<a href="#" class="item-link item-content" onclick="editarHorarios('.$id.', \''.$horarioF.'\')">';                          
              echo ' <div class="item-inner">';
                echo ' <div class="item-title" style="font-size:11px">';
                  echo $horarioF.$temp;                 
                 echo '</div>';                
               echo '</div>';
             echo '</a>';
           echo '</li>';

	}
	
}else{
	echo '<br><small><small><div align="center">Não encontramos nenhum registro!</div></small></small>';
}

?>

