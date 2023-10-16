<?php 
require_once("../../../conexao.php");
$tabela = 'comentarios';

$id = $_POST['id'];
$nome = $_POST['nome'];
$texto = $_POST['texto'];
$cliente = @$_POST['cliente'];

if($cliente == 1){
	$ativo = 'Não';
}else{
	$ativo = 'Sim';
}

//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/comentarios/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../img/comentarios/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}




if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, texto = :texto, ativo = '$ativo', foto = '$foto'");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, texto = :texto, foto = '$foto' WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":texto", "$texto");
$query->execute();

echo 'Salvo com Sucesso';
 ?>