<?php
  $url = "http://api.wordmensagens.com.br/delete-agenda";
  

  $data = array('token' => $token,
                'hash' => $hash);

  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = @file_get_contents($url, false, $stream);

  //echo $result;
?>

  