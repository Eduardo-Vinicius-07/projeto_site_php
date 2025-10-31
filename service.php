<?php

class CadastroService{


  public function salvaFoto($filesArray, $index){

  if(!isset($filesArray['name'][$index])||$filesArray['error'][$index]
  !== UPLOAD_ERR_OK){

     return null; //Caso não envie a foto
     
  }

   $uploadDir =__DIR__. "/uploads/";
   if (!is_dir($uploadDir)){mkdir($uploadDir, 0777,true);
     
   }
   $nomeArquivo= uniqid() ."_". basename($filesArray['name'][$index]);
   $destino = $uploadDir .$nomeArquivo;

   if(move_uploaded_file($filesArray['tmp'][$index],$destino)){return "/uploads/".$nomeArquivo;}else{ return null;}//salva a foto





  }



  }

















?>