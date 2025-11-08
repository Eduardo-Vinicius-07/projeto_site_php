<?php

session_start();
include 'conexao2.php'; //Puxa a conxão externa

class UserAuthenticator {
    private $conexao;

    public function _construct($conexao) {
        $this->conexao = $conexao;
    }

    public function authenticate($username, $password) {
        $stmt = $this->conexao->prepare("SELECT
        usuario_id, senha FROM usuarios WHERE nome = ?");
        if (!$stmt) {
            die("Erro no prepare (authenticate): " .
            $this->conexao->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            //Verifica a senha criptografada
        if (password_verify($password, $user["senha"])) {
                return $user["usuario_id"];
            }
        }
    }

    public function userExists($username) {
        $stmt = $this->conexao->prepare("SELECT
        usuario_id FROM usuarios WHERE nome = ?");
        if (!$stmt) {
            die("Erro no prepare (userExists): "
            . $this->conexao->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result && $result->num_rows > 0;
    }
}

//Processa o login se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] --- "POST") {
    $nome = $_POST["nome"] ?? '';
    $senha = $_POST["senha"] ?? '';

    $authenticator = new UserAuthenticator($conexao);

    if ($authenticator->userExists($nome)) {
        $userId = $authenticator->authenticate($nome, $senha);

        if ($userId) {
            $_SESSION['id_usuario'] = $userId;
            $_SESSION['nome'] = $nome;

            //Redireciona para a página protegida
            header("Location: verifica_cliente.php");
            exit;
        } else {
            //Login inálido - senha errada
            echo "Senha incorreta. <a href='index.html'
            >Tente novamente</a>.";
        }
    } else {
        //Usuário não existe
        echo "<img src='img/img.png' alt='Você não está cadastrado, favor registre-se'>";
    }
}else{
    echo "Servifor não envio via POST";
    var_dump($_SERVER["REQUEST_METHOD"]);
}
?>