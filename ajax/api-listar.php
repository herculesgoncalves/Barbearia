<?php
require_once("../sistema/conexao.php");
  $url = "http://api.wordmensagens.com.br/agendar-list";

  $data = array('instance' => $instancia,
                'token' => $token);

  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = @file_get_contents($url, false, $stream);

  echo "<pre>";print_r($result);echo"</pre>";
?>
  
  