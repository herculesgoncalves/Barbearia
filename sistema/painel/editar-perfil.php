<?php 
require_once('../conexao.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$conf_senha = $_POST['conf_senha'];
$endereco = $_POST['endereco'];
$senha_crip = md5($senha);
$atendimento = $_POST['atendimento'];
$intervalo = $_POST['intervalo'];

$foto = '';

if($senha != $conf_senha){
	echo 'As senhas são diferentes!!';
	exit();
}

//validar email
$query = $pdo->query("SELECT * from usuarios where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0 and $id != $res[0]['id']){
	echo 'Email já Cadastrado, escolha outro!!';
	exit();
}

//validar cpf
$query = $pdo->query("SELECT * from usuarios where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0 and $id != $res[0]['id']){
	echo 'CPF já Cadastrado, escolha outro!!';
	exit();
}



//validar troca da foto
$query = $pdo->query("SELECT * FROM usuarios where id = '$id'");
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

$caminho = 'img/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('img/perfil/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}




$query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf, senha = :senha, senha_crip = '$senha_crip', endereco = :endereco, foto = '$foto', atendimento = '$atendimento', intervalo = '$intervalo' WHERE id = '$id'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":senha", "$senha");
$query->bindValue(":endereco", "$endereco");
$query->execute();

echo 'Editado com Sucesso';
 ?>