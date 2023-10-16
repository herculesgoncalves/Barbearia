<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.wordmensagens.com.br/agendar-program',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "instance": "'.$instancia.'",
    "to": "'.$telefone.'",
    "message":"'.$mensagem.'",
    "msg_erro": "Desculpe, responda apenas com 1 ou 2 Muito Obrigado!!!",
    "msg_confirma": "Confirmado ✅",
    "msg_reagendar": "Cancelado, Reagende pelo Site",
    "id_consulta":"'.$id_envio.'",
    "url_recebe": "'.$url_sistema.'ajax/retorno.php",
    "data": "'.$data_envio.'",
    "aviso": "'.$horas_confirmacaoF.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//pegando o id
$response = json_decode($response, false);
$id = $response->id;

?>