<?php 
require_once('../conexao.php');


$nome = $_POST['nome_sistema'];
$email = $_POST['email_sistema'];
$whatsapp = $_POST['whatsapp_sistema'];
$fixo = $_POST['telefone_fixo_sistema'];
$endereco = $_POST['endereco_sistema'];
$tipo_rel = $_POST['tipo_rel'];
$instagram = $_POST['instagram_sistema'];
$tipo_comissao = $_POST['tipo_comissao'];
$texto_rodape = $_POST['texto_rodape'];
$texto_sobre = $_POST['texto_sobre'];
$mapa = $_POST['mapa'];
$quantidade_cartoes = $_POST['quantidade_cartoes'];
$texto_fidelidade = $_POST['texto_fidelidade'];
$texto_agendamento = $_POST['texto_agendamento'];
$msg_agendamento = $_POST['msg_agendamento'];
$cnpj_sistema = $_POST['cnpj_sistema'];
$cidade_sistema = $_POST['cidade_sistema'];
$agendamento_dias = $_POST['agendamento_dias'];
$itens_pag = $_POST['itens_pag'];
$token = $_POST['token'];
$minutos_aviso = $_POST['minutos_aviso'];
$instancia = $_POST['instancia'];
$url_video = $_POST['url_video'];
$posicao_video = $_POST['posicao_video'];
$taxa_sistema = $_POST['taxa_sistema'];
$lanc_comissao = $_POST['lanc_comissao'];

if($minutos_aviso == ""){
	$minutos_aviso = 0;
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$caminho = '../img/logo.png';
$imagem_temp = @$_FILES['foto-logo']['tmp_name']; 
if(@$_FILES['foto-logo']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para a Logo é somente *PNG';
		exit();
	}

}



$caminho = '../img/favicon.png';
$imagem_temp = @$_FILES['foto-icone']['tmp_name']; 
if(@$_FILES['foto-icone']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-icone']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para a ícone é somente *ICO';
		exit();
	}

}



$caminho = '../img/logo_rel.jpg';
$imagem_temp = @$_FILES['foto-logo-rel']['tmp_name']; 
if(@$_FILES['foto-logo-rel']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo-rel']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para o Relatório é somente *Jpg';
		exit();
	}

}


$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$img_banner_index = $res[0]['img_banner_index'];

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = @$_FILES['foto-banner-index']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../images/' .$nome_img;

$imagem_temp = @$_FILES['foto-banner-index']['tmp_name']; 

if(@$_FILES['foto-banner-index']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
				
	$img_banner_index = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



//validar troca da foto
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$img_sobre = $res[0]['imagem_sobre'];

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = @$_FILES['foto-sobre']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../images/' .$nome_img;

$imagem_temp = @$_FILES['foto-sobre']['tmp_name']; 

if(@$_FILES['foto-sobre']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
				
	$img_sobre = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}





$caminho = '../../images/favicon.png';
$imagem_temp = @$_FILES['foto-icone-site']['tmp_name']; 
if(@$_FILES['foto-icone-site']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-icone-site']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para a ícone é somente *PNG';
		exit();
	}

}



$query = $pdo->prepare("UPDATE config SET nome = :nome, email = :email, telefone_whatsapp = :whatsapp, telefone_fixo = :telefone_fixo, endereco = :endereco, logo = 'logo.png', icone = 'favicon.png', logo_rel = 'logo_rel.jpg', tipo_rel = '$tipo_rel', instagram = :instagram, tipo_comissao = '$tipo_comissao', texto_rodape = :texto_rodape, img_banner_index = '$img_banner_index', icone_site = 'favicon.png', imagem_sobre = '$img_sobre', texto_sobre = :texto_sobre, mapa = :mapa, quantidade_cartoes = '$quantidade_cartoes', texto_fidelidade = :texto_fidelidade, texto_agendamento = :texto_agendamento, msg_agendamento = :msg_agendamento, cnpj = :cnpj, cidade = :cidade, agendamento_dias = '$agendamento_dias', itens_pag = '$itens_pag', token = :token, minutos_aviso = '$minutos_aviso', instancia = :instancia, url_video = :url_video, posicao_video = :posicao_video, taxa_sistema = :taxa_sistema, lanc_comissao = :lanc_comissao ");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":whatsapp", "$whatsapp");
$query->bindValue(":telefone_fixo", "$fixo");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":instagram", "$instagram");
$query->bindValue(":texto_rodape", "$texto_rodape");
$query->bindValue(":texto_sobre", "$texto_sobre");
$query->bindValue(":mapa", "$mapa");
$query->bindValue(":texto_fidelidade", "$texto_fidelidade");
$query->bindValue(":texto_agendamento", "$texto_agendamento");
$query->bindValue(":msg_agendamento", "$msg_agendamento");
$query->bindValue(":cnpj", "$cnpj_sistema");
$query->bindValue(":cidade", "$cidade_sistema");
$query->bindValue(":token", "$token");
$query->bindValue(":instancia", "$instancia");
$query->bindValue(":url_video", "$url_video");
$query->bindValue(":posicao_video", "$posicao_video");
$query->bindValue(":taxa_sistema", "$taxa_sistema");
$query->bindValue(":lanc_comissao", "$lanc_comissao");
$query->execute();

echo 'Editado com Sucesso';
 ?>