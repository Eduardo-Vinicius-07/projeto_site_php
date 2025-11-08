<?php

try{
    $conexao = new PDO("mysql:host=localhost;dbname=eduardor1", "root", "");
    $conexao->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
} catch (PDOexpetion $e){
    echo "Erro de conexão:" . $e->getMessage();
    die();
}
?>