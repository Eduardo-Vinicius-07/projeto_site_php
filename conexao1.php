<?php 
$host = 'localhost';
$dbname = 'petchristian';
$username = 'root';
$password = '';

//criar conexão
$conexao = new mysqli($host, $username, $password, $dbname
);

//verificar se houve algum erro de conexão
if ($conexao->connect_error){
    die("Erro ao conectar ao banco de dados:" . $conexao->cennect_error);
}


?>