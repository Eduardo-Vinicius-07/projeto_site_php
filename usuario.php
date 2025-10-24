<?php

class usuario{
    private $conn;
    private $usuario_id;
    public $nome;
    public $endereco;
    public $telefone;
    public $email;
    protected $senhaHash;

    public function _construct($conn, $nome, $endereco, $telefone, $email, $senha){
        $this->conn = $conn;
        $this->nome = trim($nome);
        $this->endereco = $endereco;
        
        $email = strtolower(trim($email));
        if(!filter_var($email, FILTER_VALIDADE_EMAIL)){
            throw new Exception("Erro existente");
        }
        $this->email=($email);
        $this->senhaHash = password_hash($senha,PASSWORD_DEFAULT);
    }
    
    public function getId(){
        return $this->usuario_id;
    }

    public function salvar (){
        $sql = "INSERT INTO usuarios (nome, endereco, telefone, email, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this-> conn->prepare($sql);

        if($stmt ->executer([$this->nome, $this->endereco, $this->email, $this->senhaHah])){
            $this->usuario_id = $this->conn->lastInsertId();
            return $this->usuario_id;
        } else {
            throw new Exception ("Erro ao salvar o usuario");
        }
    }
}
?>