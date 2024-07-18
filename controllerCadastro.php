<?php

include 'Conexao.php';

$database = new Conexao();
$conn = $database->fazConexao();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $cnpj = $_POST['cnpj'];
    $tipo = $_POST['tipo_atendimento'];
    $perfil = $_POST['perifl-atendimento'];
    $descricao = $_POST['descricaoatendimento'];
    $atendente = $_POST['atendente'];
    $motivo = $_POST['motivo-atendimento'];

    if (empty($cpf)) {
        $cpf = null;
    }
    if (empty($cnpj)) {
        $cnpj = null;
    }

    try {
        $sql = "INSERT INTO cadastro (nomeCadastro, telefoneCadastro, emailCadastro, cpfCadastro, cnpjCadastro, tipoCadastro, perfilCadastro, descricao, idUsuario, idPerguntaPublico) VALUES (:nome, :telefone, :email, :cpf, :cnpj, :tipo, :perfil, :descricao, :idusuario, :idmotivo)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':perfil', $perfil);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':idusuario', $atendente);
        $stmt->bindParam(':idmotivo', $motivo);

        
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
                alert("Novo registro inserido com sucesso!");
                        setTimeout(function(){
                            window.location.href = "telainicial.php";
                        }, 1200);
            </script>';    
        } else {
            echo "Erro ao inserir registro.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    
    $conn = null;
} ?>
