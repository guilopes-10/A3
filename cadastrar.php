<?php
session_start();
$result = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : [];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Escolha de Atendimento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f5f5f5;
            margin: 0;
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

        .hidden {
            display: none;
        }

        .card-form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .card-form-item {
            margin-bottom: 5px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            width: 100%;
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

        p {
            width: 100%;
            text-align: left;
            font-weight: 600;
        }
    </style>

</head>

<body>
    <div class="card">
        <h2>Cadastrar</h2>
        <form action="controllerCadastro.php" method="POST">
            <div class="card-form">
                <div class="card-form-item">
                    <input type="hidden" id="atendente" name="atendente" value="<?= $result ?>">
                    <label for="atendente" style="display: none;"></label>
                </div>

                <p>Escolha o tipo do Atendimento:</p>
                <div class="card-form-item">
                    <input type="radio" id="whatsapp" name="tipo_atendimento" value="1" onclick="showProfiles()">
                    <label for="whatsapp">WhatsApp</label><br>
                </div>

                <div class="card-form-item">
                    <input type="radio" id="telefone" name="tipo_atendimento" value="2" onclick="showProfiles()">
                    <label for="telefone">Telefone</label><br>
                </div>
                <div class="card-form-item">
                    <input type="radio" id="email" name="tipo_atendimento" value="3" onclick="showProfiles()">
                    <label for="email">Email</label><br>
                </div>
                <div class="card-form-item">
                    <input type="radio" id="presencial" name="tipo_atendimento" value="4" onclick="showProfiles()">
                    <label for="presencial">Presencial</label><br>
                </div>
                <div class="card-form-item">
                    <input type="radio" id="teams" name="tipo_atendimento" value="5" onclick="showProfiles()">
                    <label for="teams">Teams</label><br>
                </div>
                <div class="card-form-item">
                    <input type="radio" id="redesocial" name="tipo_atendimento" value="6" onclick="showProfiles()">
                    <label for="redesocial">Redes Sociais</label><br>
                </div>
                <div class="card-form-item">
                    <input type="radio" id="Outros" name="tipo_atendimento" value="7" onclick="showProfiles()">
                    <label for="Outros">Outros</label><br>
                </div>

                <div id="profile-options" class="hidden">
                    <p>Escolha o perfil atendido:</p>
                    <div class="card-form-item">
                        <input type="radio" id="empregador" name="perifl-atendimento" value="1"
                            onclick="showQuestions('PF')">
                        <label for="empregador">Empregador</label><br>
                    </div>

                    <div class="card-form-item">
                        <input type="radio" id="trabalhador" name="perifl-atendimento" value="2"
                            onclick="showQuestions('PF')">
                        <label for="trabalhador">Trabalhador</label><br>
                    </div>

                    <div class="card-form-item">
                        <input type="radio" id="outras_agencias" name="perifl-atendimento" value="3"
                            onclick="showQuestions('PF')">
                        <label for="outras_agencias">Outras Agências</label><br>
                    </div>

                    <div class="card-form-item">
                        <input type="radio" id="ads" name="perifl-atendimento" value="4" onclick="showQuestions('PF')">
                        <label for="ads">ADS</label><br>
                    </div>

                    <div class="card-form-item">
                        <input type="radio" id="setores_fgtas" name="perifl-atendimento" value="5"
                            onclick="showQuestions('PF')">
                        <label for="setores_fgtas">Setores da FGTS</label><br>
                    </div>

                    <div class="card-form-item">
                        <input type="radio" id="outros" name="perifl-atendimento" value="6"
                            onclick="showQuestions('PF')">
                        <label for="outros">Outros</label><br>
                    </div>

                </div>

                <div id="questions-pf" class="hidden">
                    <p>Responda as perguntas:</p>

                    <div class="card-form-item">
                        <label class="text-label" for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="telefone">Telefone:</label>
                            <input type="text" id="telefone" name="telefone" placeholder="51000000000" pattern="\d{11}" required><br>
                        </div>

                    <div class="card-form-item">
                        <label class="text-label" for="email">Email:</label>
                        <input type="email" id="email" name="email"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" placeholder="51000000000" pattern="\d{11}"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="cnpj">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpj" placeholder="51000000000000" pattern="\d{14}"><br>
                    </div>

                    <div class="card-form-item">
                        <label class="text-label" for="descricaoatendimento">Descrição do Atendimento:</label><br>
                        <textarea id="descricaoatendimento" name="descricaoatendimento" rows="4" cols="50"></textarea>
                    </div>

                    <p>Escolha o motivo do atendimento:</p>
                    <div class="card-form-item">
                        <input type="radio" id="carteiraTrab" name="motivo-atendimento" value="1">
                        <label for="carteiraTrab">Carteira de Trabalho, SD, Vagas</label><br>
                    </div>
                    <div class="card-form-item">
                        <input type="radio" id="artesanato" name="motivo-atendimento" value="2">
                        <label for="artesanato">Programa Gaúcho do Artesanato</label><br>
                    </div>
                    <div class="card-form-item">
                        <input type="radio" id="humanisticos" name="motivo-atendimento" value="3">
                        <label for="humanisticos">Vida Centro Humanístico</label><br>
                    </div>
                    <div class="card-form-item">
                        <input type="radio" id="empreendedorismo" name="motivo-atendimento" value="4">
                        <label for="empreendedorismo">Orientação sobre Empreendedorismo</label><br>
                    </div>
                    <div class="card-form-item">
                        <input type="radio" id="qualificacao" name="motivo-atendimento" value="5">
                        <label for="qualificacao">Orientação sobre Cursos de Qualificação</label><br>
                    </div>
                    <div class="card-form-item">
                        <input type="radio" id="mercadotrab" name="motivo-atendimento" value="6">
                        <label for="mercadotrab">Orientação sobre Mercado de Trabalho</label><br>
                    </div>
                    <div class="card-form-item">
                        <input type="radio" id="outra" name="motivo-atendimento" value="7">
                        <label for="outra">Outra</label><br>
                    </div>
                    <div class="buttons">
                        <button class="button" type="submit">Submit</button>
                        <button type="button" class="back-button" onclick="window.location.href='telainicial.php'">Voltar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function showProfiles() {
            var profileOptions = document.getElementById("profile-options");
            profileOptions.classList.remove("hidden");
        }
        function showQuestions(profile) {
            var pfQuestions = document.getElementById("questions-pf");
            if (profile === 'PF') {
                pfQuestions.classList.remove("hidden");

            }
        }
    </script>
</body>
</body>

</html>