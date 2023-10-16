<?php 
require_once("../../../conexao.php");
$tabela = 'produtos';

$id = $_POST['id'];
$nome = $_POST['nome'];
$valor_compra = $_POST['valor_compra'];
$valor_compra = str_replace(',', '.', $valor_compra);
$valor_venda = $_POST['valor_venda'];
$valor_venda = str_replace(',', '.', $valor_venda);
$descricao = $_POST['descricao'];
$nivel_estoque = $_POST['nivel_estoque'];

$categoria = $_POST['categoria'];

if($categoria == 0){
	echo 'Cadastre uma Categoria de Produtos para o Produto';
	exit();
}

//validar nome
$query = $pdo->query("SELECT * from $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0 and $id != $res[0]['id']){
	echo 'Nome já Cadastrado, escolha outro!!';
	exit();
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

$caminho = '../../img/produtos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../img/produtos/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}




if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, categoria = '$categoria', valor_compra = :valor_compra, valor_venda = :valor_venda, descricao = :descricao, foto = '$foto', nivel_estoque = '$nivel_estoque'");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, categoria = '$categoria', valor_compra = :valor_compra, valor_venda = :valor_venda, descricao = :descricao, foto = '$foto', nivel_estoque = '$nivel_estoque' WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":valor_venda", "$valor_venda");
$query->bindValue(":valor_compra", "$valor_compra");
$query->bindValue(":descricao", "$descricao");
$query->execute();

echo 'Salvo com Sucesso';
 ?>