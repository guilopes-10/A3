<?php require_once 'ControllerEditar.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar/Editar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100%;
            background-color: #f5f5f5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        th,
        td {
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

        th,
        td {
            border: 1px solid #dddddd;
        }

        h1{
            color: #54aec3;
            margin-left: .5rem;
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

        .remove-button {
            padding: 10px 20px;
            background-color: red;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            align-self: center;
        }

        .remove-button:hover {
            color: white;
            transform: scale(1.05);
            background-color: #891c1c;
        }
    </style>
</head>

<body>
    <h1>Visualizar/Editar Registros</h1>


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
                <th>Ações</th>
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
                    <td>
                        <button type="button" class="back-button"
                            onclick="window.location.href='vizualizarEditar.php?id=<?php echo $row['idCadastro']; ?>'">Editar</button>
                        
                        <button type="button" class="remove-button"
                            onclick="confirmRemoval(<?php echo $row['idCadastro']; ?>)">Remover</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="buttons">
        <button type="button" class="back-button" onclick="window.location.href='telainicial.php'">Voltar</button>
    </div>

    <script>
        function confirmRemoval(id) {
            if (confirm('Tem certeza que deseja remover este registro?')) {
                window.location.href = 'ControllerRemover.php?id=' + id;
            }
        }
    </script>
</body>

</html>