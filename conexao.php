<?php 
 try {
    $conn = new PDO("mysql: host=localhost;
    dbname=pet2","root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
 } catch (PDOexpetion $e) {
    echo"Erro de conexao:" . $e-> getmessage(); 
    die();
 }

?>