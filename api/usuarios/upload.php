<?php
$pasta = 'perfil';
//PEGAR IMAGEM
$new_image_name = urldecode($_FILES["file"]["name"]).".jpg";
            
/* PEGAR EXTENÇÃO DO ARQUIVO */
$ext = strtolower(strrchr($new_image_name,"."));

$nome_img = date('d-m-Y-H-i-s').'-'.rand(0, 1000);

$nome_atual = $nome_img.$ext; //nome que dará a imagem
$tmp = $_FILES['file']['tmp_name']; //caminho temporário da imagem
$resultado = 0;
        
	//MOVER O ARQUIVO PARA PASTA FOTO
	if (move_uploaded_file($tmp, "../../sistema/painel/img/".$pasta."/".$nome_atual)){			
			//pegar nome da imagem
			$resultado=$nome_atual;		
			echo $resultado; 
		
        }

?>