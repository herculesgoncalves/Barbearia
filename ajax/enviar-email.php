<?php 
require_once("../sistema/conexao.php");

$remetente = $email_sistema;
$assunto = 'Contato - ' .$nome_sistema;

$mensagem = utf8_decode('Nome: '.$_POST['nome']. "\r\n"."\r\n" . 'Telefone: '.$_POST['telefone']. "\r\n"."\r\n" . 'Mensagem: ' . "\r\n"."\r\n" .$_POST['mensagem']);
$dest = $_POST['email'];
$cabecalhos = "From: " .$dest;

mail($remetente, $assunto, $mensagem, $cabecalhos);

echo 'Enviado com Sucesso';

 ?>