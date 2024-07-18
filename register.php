<?php
// Inicia uma nova sessão ou retoma a sessão existente
session_start();

// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once 'Conexao.php';

// Cria uma nova instância da classe Conexao
$conex = new Conexao();

// Estabelece uma conexão com o banco de dados utilizando o método fazConexao da classe Conexao
$conex->fazConexao();

// Verifica se o método de requisição é POST, ou seja, se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o nome de usuário, a senha e a confirmação de senha enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Verifica se as senhas coincidem
    if ($password !== $password_confirm) {
        $error = 'As senhas não coincidem.';
    } elseif (strlen($password) < 8) {
        $error = 'A senha deve ter no mínimo 8 caracteres.';
    } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $error = 'A senha deve conter pelo menos 1 caracter especial.';
    } else {
        // Prepara uma consulta SQL para verificar se o nome de usuário já existe no banco de dados
        $stmt = $conex->conn->prepare("SELECT * FROM usuario WHERE loginUsuario = ?");
        // Executa a consulta com o nome de usuário fornecido
        $stmt->execute([$username]);
        // Verifica se o nome de usuário já foi registrado
        if ($stmt->fetch()) {
            // Define uma mensagem de erro se o nome de usuário já existir
            $error = 'Nome de usuário já existe.';
        } else {
            // Cria um hash da senha utilizando o algoritmo bcrypt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            // Prepara uma consulta SQL para inserir o novo usuário no banco de dados
            $stmt = $conex->conn->prepare("INSERT INTO usuario (loginUsuario, senhaUsuario) VALUES (?, ?)");
            // Executa a consulta para inserir o novo usuário
            if ($stmt->execute([$username, $hashed_password])) {
                // Define uma mensagem de sucesso se o usuário for registrado com sucesso
                $success = 'Usuário registrado com sucesso. Você pode fazer login agora.';
            } else {
                // Define uma mensagem de erro se houver um problema ao registrar o usuário
                $error = 'Erro ao registrar o usuário. Tente novamente.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Novo Usuário</title>
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

        .card-register {
            width: 435px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .card-register h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #54aec3;
        }

        .card-register input {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .card-register button {
            padding: 10px 20px;
            background-color: #54aec3;
            color: #fff;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            font-size: 16px;
        }

        .card-register button:hover {
            color: white;
            transform: scale(1.05);
            background-color: #2f8ba1;
        }

        .card-register label {
            font-weight: 600;
            line-height: 30px;
            color: #696a6b;
        }

        .buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column;
            gap: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-register">
            <h2>Registro de Novo Usuário</h2>
            <form method="POST">
                <label>Nome de usuário:</label>
                <input type="text" name="username" required><br>
                <label>Senha:</label>
                <input type="password" name="password" required><br>
                <label>Confirme a senha:</label>
                <input type="password" name="password_confirm" required><br>
                <div class="buttons">
                    <button type="submit">Registrar</button>
                    <a href="login.php">Já tem uma conta? Faça login</a>
                </div>
                <?php if (isset($error)): ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <p style="color:green;"><?php echo $success; ?></p>
                <?php endif; ?>
            </form>
            <br>
        </div>
    </div>
</body>

</html>