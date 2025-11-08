<?php
class CadastroService{

    public function salvarFoto($filesArray, $index){
        if(!isset($filesArray['name'][$index])
        || $filesArray['error'][$index] 
        !== UPLOAD_ERR_OK){
            return null;// Caso não envie a foto
        }
        $uploadDir= __DIR__. "/uploads/";
        if (!is_dir ($uploadDir)){
        mkdir($uploadDir,077,true);
    }
    $nomeArquivo = uniqid() ."". basename
    ($filesArray['name'][$index]);
    $destino = $uploadDir .$nomeArquivo;

    if(move_uploaded_file($filesArray
    ['tmp_name'][$index], $destino)){
        return "uploads/" . 
        $nomeArquivo;// salva a foto
    } else{
        return null;
    }

    }


}


?>