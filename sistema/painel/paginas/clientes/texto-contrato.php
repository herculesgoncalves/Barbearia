<?php 
require_once("../../../conexao.php");
$tabela = 'clientes';

$id = $_POST['id'];

$data_hoje = date('Y-m-d');
$data_hojeF = implode('/', array_reverse(explode('-', $data_hoje)));

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_extenso = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$query = $pdo->query("SELECT * FROM clientes where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
$id = $res[0]['id'];
	$nome = $res[0]['nome'];	
	$data_nasc = $res[0]['data_nasc'];
	$data_cad = $res[0]['data_cad'];	
	$telefone = $res[0]['telefone'];
	$endereco = $res[0]['endereco'];
	$cartoes = $res[0]['cartoes'];
	$data_retorno = $res[0]['data_retorno'];
	$ultimo_servico = $res[0]['ultimo_servico'];
	$cpf = $res[0]['cpf'];
}

$cidade_data = mb_strtoupper($cidade_sistema).' '.mb_strtoupper($data_extenso);
$nome_sistemaF = mb_strtoupper($nome_sistema);
$nomeF = mb_strtoupper($nome);

echo <<<HTML
<p>Pelo presente instrumento, de um lado, a CONTRATADA, {$nome_sistemaF}, CNPJ: {$cnpj_sistema }, com sede na {$endereco_sistema}, e de outro lado, CONTRATANTE, {$nomeF} CPF: {$cpf}, partes qualificadas acima, tem entre si, justo e contratado este instrumento e com cláusulas e condições que seguem: 
	</p>


	<p><b>I-OBJETO</b></p> 
 
 <p>
Cláusula, 1°- Por este instrumento, a CONTRATADA, através de profissionais, regularmente habilitados obriga-se a prestar serviços para prótese capilar à CONTRATANTE, através do(s) tratamentos abaixo descriminado(s). </p>
 
 <p>
Parágrafo Primeiro - A CONTRATADA obriga-se a prestar serviços de prótese capilar à CONTRATANTE, com aplicação de métodos e equipamentos, próprios, objetivando o tratamento
CONTRATANTE, nos termos das condições gerais contidas nesse instrumento. 
</p>


<p>
Parágrafo Segundo - Os serviços de prótese capilar contratados compreendem na realização do número de manutenção contratadas nas datas e horários de acordo com agendamento prévio. </p>
 
  <p>
Parágrafo Terceiro - Caso haja necessidade de alteração nos horários e datas em anexo, decorrentes de algum imprevisto que impossibilite a CONTRATANTE de comparecer no horário pré-estabelecido, a mesma deverá avisar a CONTRATADA com no mínimo 12 horas de antecedência, assim será reagendada. </p>
 
<p>
Parágrafo Quarto - Em caso da desmarcação de sessão com menos de 12 horas de antecedência ou não comparecimento, acarretará na perda da manutenção. 
</p>
 
 <p>
Parágrafo Quinto - Ocorrendo a hipótese do parágrafo terceiro, o reagendamento dependerá da disponibilidade da CONTRATADA. 
</p>
 
  <p>
Parágrafo Sexto - Caso a CONTRATANTE não compareça nas datas e horários pré-definidos a CONTRATADA exime-se de qualquer responsabilidade no que diz respeito a resultados esperados dos procedimentos, restando rescindido o presente contrato de pleno direito, sem necessidade de qualquer outra formalidade, sendo devido pagamento os valores contratados a CONTRATADA em sua integralidade como forma de compensação por perdas e danos. 
 </p>



<p><b>II- DO PREÇO</b></p> 

<p>
Cláusula 1°- <b>R$ 500,00</b>, valor por extenso Quinhentos Reais foi devidamente convencionado entre as partes. </p>

<p>
Cláusula 2°- O preço livremente ajustado para a realização dos procedimentos descritos na clausula 1°.
</p>

 <p><b>III-CONDIÇÕES GERAIS </b></p> 
 
 <p>

Cláusula 3°- A CONTRATANTE declara ter sido previamente informada sobre todos os benefícios, risco, indicações, contraindicações, principais efeito colaterais e advertências gerais, relacionadas aos procedimentos, ora contratados, sendo que referidas informações foram suficientes esclarecidas, claras e elucidativas. 
</p>

 <p>
Cláusula 4°- A CONTRATANTE declara que todos os termos técnicos foram explicados, bem como todas as dúvidas foram-lhe sanadas. 
</p>

 <p> 
Cláusula 5°- A CONTRATANTE compromete-se a seguir todas as orientações e, havendo necessidade, fazer uso de produtos contidos em sua prescrição domiciliar, respeitando indicados de utilização sem o que os resultados almejados poderão não ser alcançados. 

 <p> 
Cláusula 6°- A CONTRATANTE declara ter plena ciência de que os resultados dos procedimentos estão condicionados a rigorosa fazer as manutenção subscrita, sendo todos estes fatos externos e independente do controle da contratada. 
 
  <p>
Cláusula 7°- O prazo deste instrumento inicia-se na data da primeira colocação da prótese capilares agendada, descrita acima, e seu término dar-se-á de acordo com o indicado no protocolo, caso não haja nenhum erro ou acidente de responsabilidade da CONTRATADA, que resultem em prorrogação do prazo previsto. 
 
  <p>
Cláusula 8°- A CONTRATANTE não poderá rescindir o presente contrato alegando insatisfação com o resultado. 
 
  <p>
Cláusula 9°- Ocorrendo atraso por parte da CONTRATATE para apresentação para manutenção agendada no estabelecimento da CONTRATADA, o tempo das manutenção serão reduzidos, na mesma medida do tempo de atraso da CONTRATANTE. 
 
  <p>
Clausula 10°- A CONTRATANTE declara ter plena ciência de que o serviço contratado neste instrumento não poderá ser trocado por outros serviços oferecidos pela empresa no setor 
 <p><br><br><br>

<div align="center">
_______________________________________________________________________________<br>
Assinatura do Cliente

<br><br><br>
{$cidade_data}

</div>
	</div>

HTML;
 ?>