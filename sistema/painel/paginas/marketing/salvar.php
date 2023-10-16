<?php 
require_once("../../../conexao.php");
$tabela = 'marketing';

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$mensagem = $_POST['mensagem'];
$item1 = $_POST['item1'];
$item2 = $_POST['item2'];
$item3 = $_POST['item3'];
$item4 = $_POST['item4'];
$item5 = $_POST['item5'];
$item6 = $_POST['item6'];
$item7 = $_POST['item7'];
$item8 = $_POST['item8'];

$item9 = $_POST['item9'];
$item10 = $_POST['item10'];
$item11 = $_POST['item11'];
$item12 = $_POST['item12'];
$item13 = $_POST['item13'];
$item14 = $_POST['item14'];
$item15 = $_POST['item15'];
$item16 = $_POST['item16'];
$item17 = $_POST['item17'];
$item18 = $_POST['item18'];
$item19 = $_POST['item19'];
$item20 = $_POST['item20'];

$conclusao = $_POST['conclusao'];


$mensagem = str_replace('*', '', $mensagem);
$mensagem = str_replace('"', '', $mensagem);
$mensagem = str_replace("'", "", $mensagem);


$titulo = str_replace('*', '', $titulo);
$titulo = str_replace('"', '', $titulo);
$titulo = str_replace("'", "", $titulo);


$item1 = str_replace('*', '', $item1);
$item1 = str_replace('"', '', $item1);
$item1 = str_replace("'", "", $item1);


$item2 = str_replace('*', '', $item2);
$item2 = str_replace('"', '', $item2);
$item2 = str_replace("'", "", $item2);


$item3 = str_replace('*', '', $item3);
$item3 = str_replace('"', '', $item3);
$item3 = str_replace("'", "", $item3);


$item4 = str_replace('*', '', $item4);
$item4 = str_replace('"', '', $item4);
$item4 = str_replace("'", "", $item4);


$item5 = str_replace('*', '', $item5);
$item5 = str_replace('"', '', $item5);
$item5 = str_replace("'", "", $item5);


$item6 = str_replace('*', '', $item6);
$item6 = str_replace('"', '', $item6);
$item6 = str_replace("'", "", $item6);


$item7 = str_replace('*', '', $item7);
$item7 = str_replace('"', '', $item7);
$item7 = str_replace("'", "", $item7);


$item8 = str_replace('*', '', $item8);
$item8 = str_replace('"', '', $item8);
$item8 = str_replace("'", "", $item8);

$item9 = str_replace('*', '', $item9);
$item9 = str_replace('"', '', $item9);
$item9 = str_replace("'", "", $item9);


$item10 = str_replace('*', '', $item10);
$item10 = str_replace('"', '', $item10);
$item10 = str_replace("'", "", $item10);


$item11 = str_replace('*', '', $item11);
$item11 = str_replace('"', '', $item11);
$item11 = str_replace("'", "", $item11);


$item12 = str_replace('*', '', $item12);
$item12 = str_replace('"', '', $item12);
$item12 = str_replace("'", "", $item12);


$item13 = str_replace('*', '', $item13);
$item13 = str_replace('"', '', $item13);
$item13 = str_replace("'", "", $item13);


$item14 = str_replace('*', '', $item14);
$item14 = str_replace('"', '', $item14);
$item14 = str_replace("'", "", $item14);


$item15 = str_replace('*', '', $item15);
$item15 = str_replace('"', '', $item15);
$item15 = str_replace("'", "", $item15);


$item16 = str_replace('*', '', $item16);
$item16 = str_replace('"', '', $item16);
$item16 = str_replace("'", "", $item16);


$item17 = str_replace('*', '', $item17);
$item17 = str_replace('"', '', $item17);
$item17 = str_replace("'", "", $item17);


$item18 = str_replace('*', '', $item18);
$item18 = str_replace('"', '', $item18);
$item18 = str_replace("'", "", $item18);


$item19 = str_replace('*', '', $item19);
$item19 = str_replace('"', '', $item19);
$item19 = str_replace("'", "", $item19);


$item20 = str_replace('*', '', $item20);
$item20 = str_replace('"', '', $item20);
$item20 = str_replace("'", "", $item20);

$conclusao = str_replace('*', '', $conclusao);
$conclusao = str_replace('"', '', $conclusao);
$conclusao = str_replace("'", "", $conclusao);


//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['arquivo'];
}else{
	$foto = 'sem-foto.jpg';
}

//validar troca da audio
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$audio = $res[0]['audio'];
}else{
	$audio = '';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/marketing/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'PNG'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../img/marketing/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



$nome_audio = date('d-m-Y H:i:s') .'-'.@$_FILES['audio']['name'];
$nome_audio = preg_replace('/[ :]+/' , '-' , $nome_audio);

$caminho_audio = '../../img/marketing/' .$nome_audio;

$audio_temp = @$_FILES['audio']['tmp_name']; 

if(@$_FILES['audio']['name'] != ""){
	$ext = pathinfo($nome_audio, PATHINFO_EXTENSION);   
	if($ext == 'ogg' or $ext == 'OGG'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($audio != ""){
				@unlink('../../img/marketing/'.$audio);
			}

			$audio = $nome_audio;
		
		move_uploaded_file($audio_temp, $caminho_audio);
	}else{
		echo 'Extensão de Áudio não permitida!';
		exit();
	}
}




if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), titulo = :titulo, mensagem = :mensagem, item1 = :item1, item2 = :item2, item3 = :item3, item4 = :item4, item5 = :item5, item6 = :item6, item7 = :item7, item8 = :item8, conclusao = :conclusao, arquivo = '$foto', audio = '$audio', item9 = :item9, item10 = :item10, item11 = :item11, item12 = :item12, item13 = :item13, item14 = :item14, item15 = :item15, item16 = :item16, item17 = :item17, item18 = :item18, item19 = :item19, item20 = :item20");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET titulo = :titulo, mensagem = :mensagem, item1 = :item1, item2 = :item2, item3 = :item3, item4 = :item4, item5 = :item5, item6 = :item6, item7 = :item7, item8 = :item8, conclusao = :conclusao, arquivo = '$foto', audio = '$audio', item9 = :item9, item10 = :item10, item11 = :item11, item12 = :item12, item13 = :item13, item14 = :item14, item15 = :item15, item16 = :item16, item17 = :item17, item18 = :item18, item19 = :item19, item20 = :item20 WHERE id = '$id'");
}

$query->bindValue(":titulo", "$titulo");
$query->bindValue(":mensagem", "$mensagem");
$query->bindValue(":item1", "$item1");
$query->bindValue(":item2", "$item2");
$query->bindValue(":item3", "$item3");
$query->bindValue(":item4", "$item4");
$query->bindValue(":item5", "$item5");
$query->bindValue(":item6", "$item6");
$query->bindValue(":item7", "$item7");
$query->bindValue(":item8", "$item8");

$query->bindValue(":item9", "$item9");
$query->bindValue(":item10", "$item10");
$query->bindValue(":item11", "$item11");
$query->bindValue(":item12", "$item12");
$query->bindValue(":item13", "$item13");
$query->bindValue(":item14", "$item14");
$query->bindValue(":item15", "$item15");
$query->bindValue(":item16", "$item16");
$query->bindValue(":item17", "$item17");
$query->bindValue(":item18", "$item18");
$query->bindValue(":item19", "$item19");
$query->bindValue(":item20", "$item20");


$query->bindValue(":conclusao", "$conclusao");
$query->execute();

echo 'Salvo com Sucesso';
 ?>