<?php

$dados = '{
    "programado": false,
    "delay": '.$delay.',
    "numeros": '.$numeros_formatados.',
    "instancia": "'.$instancia.'",
    "mensagem": "'.$mensagem.'"
}';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://wordmensagens.com.br/massivo-texto.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $dados,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

//echo $response;

//Caso queira pausar o envio, vc pode pegar a hash que está retornando.
$res_hash = json_decode($response, false);
$hash = $res_hash->hash;

?>