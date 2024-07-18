<?php
// Inicia uma nova sessão ou retoma a sessão existente
session_start();
// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once 'Conexao.php';
// Cria uma nova instância da classe Conexao
$conex = new Conexao();
// Estabelece uma conexão com o banco de dados utilizando o método fazConexao da classe Conexao

$conex->fazConexao();
// Verifica se o usuário está logado verificando se o 'user_id' está definido na sessão
if (!isset($_SESSION['loginUsuario'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header('Location: login.php');
    // Encerra a execução do script para garantir que o redirecionamento ocorra imediatamente
    exit();
}
// Executa uma consulta ao banco de dados para obter todos os itens da tabela 'items'
// $stmt = $conex->conn->query("SELECT * FROM items");
// Busca todos os resultados da consulta e armazena na variável $items
// $items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Escolha de Atendimento</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
            margin-top: -50px;
        }

        .return {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .title {
            margin-bottom: 4rem;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        button {
            padding: 50px;
            font-size: 22px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            background-color: white;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-weight: 600;
        }

        button:hover {
            background-color: #54aec3;
            color: white;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="return">
            <a href="login.php">Voltar para a tela de login</a>
        </div>
        <h1 class="title">
            Bem-vindo, <?= $_SESSION['loginUsuario'] ?>!
        </h1>
        <div class="buttons">
            <button onclick="window.location.href='cadastrar.php'">Cadastrar</button>
            <button onclick="window.location.href='relatorio.php'">Relatório</button>
            <button onclick="window.location.href='editar.php'">Visualizar/Editar</button>
        </div>
    </div>
</body>

</html>