<?php require_once 'ControllerEditar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar/Editar</title>
    <style>
        body,
        html {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f5f5f5;
            margin: 0;
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

        .card {
            background: #fff;
            padding: 0 20px 20px 20px;
            margin: 30px 0 30px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .card h2 {
            text-align: center;
            color: #54aec3;
        }

        .card-form {
            display: flex;
            flex-direction: column;
        }

        .card-form-item {
            display: flex;
            flex-direction: column;
        }

        .text-label {
            font-weight: 600;
        }

        label {
            flex: 1;
            margin-right: 10px;
        }

        input[type="text"],
        textarea {
            flex: 2;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 95%;
        }

        input[type="email"],
        textarea {
            flex: 2;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 95%;
        }

        input[type="radio"],
        textarea {
            flex: 2;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: none;
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

        .type-select {
            display: flex;
            flex-direction: column;
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

    </style>
</head>

<body>
    <div class="card">
        <?php if (isset($registro)): ?>
            <h2>Editar Registro</h2>
            <form action="vizualizarEditar.php" method="POST">
                <div class="card-form">
                    <input type="hidden" name="idCadastro" value="<?php echo htmlspecialchars($registro['idCadastro']); ?>">

                    <div class="card-form-item">
                        <label class="text-label" for="nome">Nome:</label>
                        <input type="text" id="nome" name="nomeCadastro"
                            value="<?php echo htmlspecialchars($registro['nomeCadastro']); ?>"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefoneCadastro"
                            value="<?php echo htmlspecialchars($registro['telefoneCadastro']); ?>"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="email">Email:</label>
                        <input type="email" id="email" name="emailCadastro"
                            value="<?php echo htmlspecialchars($registro['emailCadastro']); ?>"><br>
                    </div>
                    <div class="card-form-item">
                        <label class="text-label" for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpfCadastro"
                            value="<?php echo htmlspecialchars($registro['cpfCadastro']); ?>"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="cnpj">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpjCadastro"
                            value="<?php echo htmlspecialchars($registro['cnpjCadastro']); ?>"><br>
                    </div>

                <div class="type-select">
                    <label class="text-label" for="tipoCadastro">Tipo:</label>
                    <div class="select-wrapper">
                        <select name="tipoCadastro" id="tipoCadastro">
                            <option value="<?php echo htmlspecialchars($registro['tipoCadastro']); ?>"><?php echo htmlspecialchars($registro['tipoCadastro']); ?></option>
                            <option value="whatsapp">Whatsapp</option>
                            <option value="telefone">Telefone</option>
                            <option value="email">Email</option>
                            <option value="presencial">Presencial</option>
                            <option value="teams">Teams</option>
                            <option value="redesocial">Redes Sociais</option>
                        </select>
                    </div>
                </div>
            
                <div class="type-select">
                    <label class="text-label" for="perfilCadastro">Perfil:</label>
                    <div class="select-wrapper">
                        <select name="perfilCadastro" id="perfilCadastro">
                            <option value="<?php echo htmlspecialchars($registro['perfilCadastro']); ?>"><?php echo htmlspecialchars($registro['perfilCadastro']); ?></option>
                            <option value="empregador">Empregador</option>
                            <option value="trabalhador">Trabalhador</option>
                            <option value="outras agencias">Outras Agencias</option>
                            <option value="ads">ADS</option>
                            <option value="setores da fgtas">FGTAS</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                </div>

                    <div class="card-form-item">
                        <label class="text-label" for="descricao">Descrição do Atendimento:</label>
                        <textarea id="descricao" name="descricao" rows="4"
                            cols="50"><?php echo htmlspecialchars($registro['descricao']); ?></textarea><br>
                    </div>
                    <div class="buttons">
                        <input class="button" type="submit" value="Salvar">
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>