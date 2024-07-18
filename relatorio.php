<?php
session_start();
$result = isset($_SESSION['result']) ? $_SESSION['result'] : [];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100%;
            background-color: #f5f5f5;
        }

        .container {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .type-select {
            display: flex;
            flex-direction: column;
        }

        .date-input {
            display: flex;
            flex-direction: column;
        }
        label{
            font-weight: 600;
        }

        select {
            flex: 2;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
            font-size: 16px;
            appearance: none;
            -webkit-appearance: none;
            width: 100%;
        }

        .select-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .select-wrapper::after {
            content: '▼';
            font-size: 16px;
            color: #333;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        input[type="date"] {
            flex: 2;
            padding: 8.5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
            font-size: 16px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .custom-date-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-date-wrapper::after {
            content: '📅';
            font-size: 16px;
            color: #333;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .back-button {
            padding: 10px 20px;
            background-color: white;
            color: #54aec3;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: 600;
            border: 1px #54aec3 solid;
            border-radius: 5px;
            cursor: pointer;
            align-self: center;
        }

        .back-button:hover {
            color: #2f8ba1;
            transform: scale(1.05);
            background-color: #e9e9e9;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: #54aec3;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            align-self: center;
        }

        .button:hover {
            color: white;
            transform: scale(1.05);
            background-color: #2f8ba1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px 15px;
        }
        thead tr {
            background-color: #54aec3;
            color: #ffffff;
            text-align: left;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        tbody tr:hover {
            background-color: #ddd;
        }
        th, td {
            border: 1px solid #dddddd;
        }

        h1{
            color: #54aec3;
            margin-left: .5rem;
        }
    </style>
</head>

<body>
    <h1>Relatório</h1>
    <form action="ControllerRelatorio.php" method="POST">
        <div class="container">
            <div class="type-select">
                <label for="tipoatendimento">Escolha o tipo de atendimento:</label>
                <div class="select-wrapper">
                    <select name="tipoatendimento" id="tipoatendimento">
                        <option value="">TODOS</option>
                        <option value="1">Whatsapp</option>
                        <option value="2">Telefone</option>
                        <option value="3">Email</option>
                        <option value="4">Presencial</option>
                        <option value="5">Teams</option>
                        <option value="6">Redes Sociais</option>
                    </select>
                </div>
            </div>


            <div class="type-select">
                <label for="motivo">Motivo do atendimento:</label>
                <div class="select-wrapper">
                    <select name="motivo" id="motivo">
                        <option value="">TODOS</option>
                        <option value="1">Carteira de Trabalho, SD, Vagas</option>
                        <option value="2">Programa Gaúcho do Artesanato</option>
                        <option value="3">Vida Centro Humanístico</option>
                        <option value="4">Orientação sobre Empreendedorismo</option>
                        <option value="5">Orientação sobre Cursos de Qualificação</option>
                        <option value="6">Orientação sobre Mercado de Trabalho</option>
                        <option value="7">Outra</option>
                    </select>
                </div>
            </div>


            <div class="date-input">
                <label class="date-label" for="data-inicial">Data Inicial:</label>
                <div class="custom-date-wrapper">
                    <input type="date" id="data-inicial" name="data-inicial">
                </div>
            </div>

            <div class="date-input">
                <label class="date-label" for="data-final">Data Final:</label>
                <div class="custom-date-wrapper">
                    <input type="date" id="data-final" name="data-final">
                </div>
            </div>

            <div class="buttons">
                <button class="button" type="submit">Gerar Relatório</button>
            </div>

        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CPF</th>
                <th>CNPJ</th>
                <th>Tipo</th>
                <th>Perfil</th>
                <th>Descrição</th>
                <th>Atendente</th>
                <th>Motivo</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row['idCadastro']; ?></td>
                    <td><?php echo $row['nomeCadastro']; ?></td>
                    <td><?php echo $row['telefoneCadastro']; ?></td>
                    <td><?php echo $row['emailCadastro']; ?></td>
                    <td><?php echo $row['cpfCadastro']; ?></td>
                    <td><?php echo $row['cnpjCadastro']; ?></td>
                    <td><?php echo $row['tipoCadastro']; ?></td>
                    <td><?php echo $row['perfilCadastro']; ?></td>
                    <td><?php echo $row['descricao']; ?></td>
                    <td><?php echo $row['loginUsuario']; ?></td>
                    <td><?php echo $row['descricaoPergunta']; ?></td>
                    <td><?php echo $row['dataCadastro']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="buttons">
        <button type="button" class="back-button" onclick="window.location.href='telainicial.php'">Voltar</button>
    </div>

</body>

</html>