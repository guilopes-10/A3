<?php
// Inicia uma nova sessão ou resume a sessão existente
session_start();

// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once 'Conexao.php';
// Cria uma nova instância da classe Conexao
$conex = new Conexao();

// Estabelece uma conexão com o banco de dados utilizando o método fazConexao da classe Conexao
$conex->fazConexao();

// Verifica se o método de requisição é POST, ou seja, se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o nome de usuário e a senha enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara uma consulta SQL para verificar se o usuário existe no banco de dados
    $stmt = $conex->conn->prepare("SELECT * FROM usuario WHERE loginUsuario = ?");
    // Executa a consulta com o nome de usuário fornecido
    $stmt->execute([$username]);
    // Busca a primeira linha do resultado da consulta
    $user = $stmt->fetch();

    // Verifica se o usuário foi encontrado e se a senha fornecida corresponde à senha armazenada
    if ($user && password_verify($password, $user['senhaUsuario'])) {

        // Se a autenticação for bem-sucedida, armazena o ID do usuário e o nome de usuário na sessão
        $_SESSION['idUsuario'] = $user['idUsuario'];
        $_SESSION['loginUsuario'] = $user['loginUsuario'];
        // Redireciona o usuário para a página 'itens.php'
        header('Location: telainicial.php');
        exit();
    } else {
        // Se a autenticação falhar, define uma mensagem de erro
        $error = 'Nome de usuário ou senha inválidos';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card-login {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .card-login h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #54aec3;
        }

        .card-login input {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .card-login button {
            padding: 10px 20px;
            background-color: #54aec3;
            color: #fff;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .card-login button:hover {
            color: white;
            transform: scale(1.05);
            background-color: #2f8ba1;
        }

        .card-login label {
            font-weight: 600;
            line-height: 30px;
            color: #696a6b;
        }

        .buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0 30px 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card-login">
            <h2>Login</h2>
            <form method="POST">
                <label>Nome de usuário:</label>
                <input type="text" name="username" required>
                <br>
                <label>Senha:</label>
                <input type="password" name="password" required>
                <br>
                <div class="buttons">
                    <button type="submit">Entrar</button>
                    <a href="register.php">Deseja se registrar?</a>
                </div>
                <?php if (isset($error)): ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>