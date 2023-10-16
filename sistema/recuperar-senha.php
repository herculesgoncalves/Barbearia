<?php 
require_once("conexao.php");

$email = $_POST['email'];

$query = $pdo->query("SELECT * from usuarios where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$senha = $res[0]['senha'];

	//envio do email
	$destinatario = $email;
    $assunto = $nome_sistema . ' - Recuperação de Senha';
    $mensagem = 'Sua senha é ' .$senha;
    $cabecalhos = "From: ".$email_sistema;
   
    @mail($destinatario, $assunto, $mensagem, $cabecalhos);

    echo 'Recuperado com Sucesso';
}else{
	echo 'Esse email não está Cadastrado!';
}

 ?>