<?php

class Pet{
private $conn;
private $usuario_id;
public $nome;
public $sexo;
public $raca;
public $foto;
public $porte;

public function __construct($conn, $nome, $sexo, 
$porte, $raca, $usuario_id, $foto=null){
    $this->conn = $conn;
    $this->nome = $nome;
    $this->sexo = $sexo;
    $this->porte= $porte;
    $this->usuario_id= $usuario_id;
    $this->foto = $foto;
    $this->raca = $raca;
}
public function salvar(){
    $sql = "INSERT INTO pets (nome, sexo, porte, raca,
    usuario_id,foto) VALUES (?,?,?,?,?,?)";
    $stmt = $this->conn->prepare($sql);

    if($stmt->execute([$this->nome, $this->sexo,
    $this->porte, $this->raca, $this->usuario_id,
    $this->foto])){
        $this->usuario_id = $this->conn->lastInsertId();
        return $this->usuario_id;

    } else{
        throw new Exception ("Erro ao salvar o Pet.");
    }
}
}

?>