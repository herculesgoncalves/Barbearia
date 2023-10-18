<?php 



$banco = '';
$usuario = '';
$senha = '';
$servidor = '';


$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/barbearia/";
}

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não conectado ao Banco de Dados! <br><br>' .$e;
}


//VARIAVEIS DO SISTEMA
$nome_sistema = 'sisteme Barbearia';
$email_sistema = 'herculesgoncalves09@gmail.com';
$whatsapp_sistema = '(11) 995780434';
$not_sistema = 'Sim';


$query = $pdo->query("SELECT * from config ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone_whatsapp = '$whatsapp_sistema', logo = 'logo.png', icone = 'favicon.ico', logo_rel = 'logo_rel.jpg', tipo_rel = 'pdf', tipo_comissao = 'Porcentagem', texto_rodape = 'Edite este texto nas configurações do painel administrador', img_banner_index = 'hero-bg.jpg', quantidade_cartoes = 10, texto_agendamento = 'Selecionar Prestador de Serviço', msg_agendamento = 'Sim', agendamento_dias = '30', itens_pag = '10', minutos_aviso = '0'");
}else{
	$nome_sistema = $res[0]['nome'];
	$email_sistema = $res[0]['email'];
	$whatsapp_sistema = $res[0]['telefone_whatsapp'];
	$tipo_rel = $res[0]['tipo_rel'];
	$telefone_fixo_sistema = $res[0]['telefone_fixo'];
	$endereco_sistema = $res[0]['endereco'];
	$logo_rel = $res[0]['logo_rel'];
	$logo_sistema = $res[0]['logo'];
	$icone_sistema = $res[0]['icone'];
	$instagram_sistema = $res[0]['instagram'];
	$tipo_comissao = $res[0]['tipo_comissao'];
	$texto_rodape = $res[0]['texto_rodape'];
	$img_banner_index = $res[0]['img_banner_index'];
	$icone_site = $res[0]['icone_site'];
	$texto_sobre = $res[0]['texto_sobre'];
	$imagem_sobre = $res[0]['imagem_sobre'];
	$mapa = $res[0]['mapa'];
	$quantidade_cartoes = $res[0]['quantidade_cartoes'];
	$texto_fidelidade = $res[0]['texto_fidelidade'];
	$texto_agendamento = $res[0]['texto_agendamento'];
	$msg_agendamento = $res[0]['msg_agendamento'];
	$cnpj_sistema = $res[0]['cnpj'];
	$cidade_sistema = $res[0]['cidade'];
	$agendamento_dias = $res[0]['agendamento_dias'];
	$itens_pag = $res[0]['itens_pag'];
	$minutos_aviso = $res[0]['minutos_aviso'];
	$token = $res[0]['token'];
	$instancia = $res[0]['instancia'];
	$url_video = $res[0]['url_video'];
	$posicao_video = $res[0]['posicao_video'];
	$taxa_sistema = $res[0]['taxa_sistema'];
	$lanc_comissao = $res[0]['lanc_comissao'];
	$ativo_sistema = $res[0]['ativo'];

	$horas_confirmacaoF = $minutos_aviso.':00:00';

	$tel_whatsapp = '55'.preg_replace('/[ ()-]+/' , '' , $whatsapp_sistema);
	

	if($ativo_sistema != 'Sim' and $ativo_sistema != ''){ ?>
	<style type="text/css">
		@media only screen and (max-width: 700px) {
  .imgsistema_mobile{
    width:300px;
  }
    
}
	</style>
	<div style="text-align: center; margin-top: 100px">
	<img src="sistema/img/bloqueio.png" class="imgsistema_mobile">	
	</div>
<?php 
exit();
} 
	
}







 ?>