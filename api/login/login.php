<?php 
require_once("../../sistema/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];
$senha_crip = md5($senha);

$query = $pdo->prepare("SELECT * from usuarios where (email = :email or cpf = :email) and senha_crip = :senha");
$query->bindValue(":email", "$email");
$query->bindValue(":senha", "$senha_crip");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome = $res[0]['nome'];
		$email = $res[0]['email'];
		$senha = $res[0]['senha'];
		$nivel = $res[0]['nivel'];
		$data = $res[0]['data'];
		$id = $res[0]['id'];
		$foto = $res[0]['foto'];
		$ativo = $res[0]['ativo'];

		$dados = array(
			'nome' => $nome,
			'email' => $email,
			'id' => $id,
			'nivel' => $nivel,
			'foto' => $foto,
			'nomeSistema' => $nome_sistema,
		);

		if($ativo != 'Sim'){		
		
			$dados = array(
			'msg' =>'Seu usuário foi desativado, contate o administrador!',			
		);
		}


		
}else{
	$dados = array(
			'msg' =>'Usuário ou Senha Incorretos!!',			
		);
		
}


$result = json_encode($dados);
echo $result;

?>