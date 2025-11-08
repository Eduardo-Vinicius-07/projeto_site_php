<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'conexao.php';
require 'usuario.php';
require 'pet.php';
require 'service.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
} 

try{
if ($_POST['senha'] !== $_POST['confirmar_senha']){
     throw new Exception (" As senhas não coincidem");
}

$usuario = new Usuario($conexao,
    ($_POST['nome_usuario']),
    ($_POST['endereco']),
    ($_POST['telefone']),
    ($_POST['email']),
    ($_POST['senha'])

);

$usuarioId = $usuario->salvar();
    if (!$usuarioId) {
        throw new Exception ("Falha ao cadastrar o usuario");
    }
if (!empty($_POST['pets']) && is_array($_POST['pets'])){
    $uploadService = new CadastroService();

    foreach ($_POST['pets'] as $i => $pet){
        
        $nome = ($pet['nome']??"");
        $sexo = ($pet['sexo']??"");
        $porte = ($pet['porte']??"");
        $raca = ($pet['raca']??"");

        if(!$nome || !$sexo ||  !$porte || !$raca) continue;

        $foto = 'img/pet_padrao.jpg';
        if(!empty($_FILES['pet_fotos']['name'][$i]) && $_FILES['pet_fotos']['error'][$i] === UPLOAD_ERR_OK){
            $foto = $uploadService->salvarFoto($_FILES['pet_fotos'],$i) ?: $foto;
        }

        try {
            $novoPet =  new Pet($conexao, $nome, $porte, $raca, $usuarioId, $foto, $sexo);
            if($novoPet->salvar());
        }catch (Exception $e){ 
            echo "Erro ao cadastrar pet" . $e->getMessage();
        }
    }
}
    echo "Cadastro realizado com Sucesso";
    header ('Refresh: 2; URL=index.html');
    exit;
}catch (Exception $e){
    echo "Erro no cadastro" . $e->getMessage();
}

?>