<?php
session_start();
include 'conexao.php';

class UserAuthenticator {
    private $conexao;

    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function authenticate($username, $password){
        $stmt = $this->conexao->prepare("SELECT usuario_id,senha FROM usuarios WHERE nome = ?");
        if (!stmt) {
            die("erro no prepare (authenticate):".$this->conexao->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            //Verifica a senha criptografada
            if (password_verify($password,))
        }
    }
}
?>