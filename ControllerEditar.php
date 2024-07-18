<?php

include_once 'Conexao.php';

$database = new Conexao();
$conn = $database->fazConexao();

$registro = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT cadastro.*, 
            publico.nomePublico as perfilCadastro,
            publico.idPublico as codigopublico,
            tipoatendimento.idTipoAtendimento as codigoatendimento,
            tipoatendimento.descricao as tipoCadastro
        FROM cadastro
        INNER JOIN publico ON cadastro.perfilCadastro = publico.idPublico
        INNER JOIN tipoatendimento ON cadastro.tipoCadastro = tipoatendimento.idTipoAtendimento
        WHERE idCadastro = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $id = $_POST['idCadastro'];
        $nome = $_POST['nomeCadastro'];
        $telefone = $_POST['telefoneCadastro'];
        $email = $_POST['emailCadastro'];
        $cpf = $_POST['cpfCadastro'];
        $cnpj = $_POST['cnpjCadastro'];
        $tipo = $_POST['tipoCadastro'];
        $perfil = $_POST['perfilCadastro'];
        $descricao = $_POST['descricao'];

        $codigoperfil = "SELECT idPublico FROM publico WHERE nomePublico LIKE :perfil";
        $codigoperf = $conn->prepare($codigoperfil);
        $codigoperf->execute([':perfil' => "%$perfil%"]);
        $perfilRow = $codigoperf->fetch(PDO::FETCH_ASSOC);
        $codigoperfilID = $perfilRow['idPublico'];


        $codigotipo = "SELECT idTipoAtendimento FROM tipoatendimento WHERE descricao LIKE :tipo";
        $codigotip = $conn->prepare($codigotipo);
        $codigotip->execute([':tipo' => "%$tipo%"]);
        $tipoRow = $codigotip->fetch(PDO::FETCH_ASSOC);
        $codigotipoID = $tipoRow['idTipoAtendimento'];


        $sql = "UPDATE cadastro SET 
                    nomeCadastro = :nome, 
                    telefoneCadastro = :telefone, 
                    emailCadastro = :email, 
                    cpfCadastro = :cpf, 
                    cnpjCadastro = :cnpj, 
                    tipoCadastro = :tipo, 
                    perfilCadastro = :perfil,
                    descricao = :descricao
                WHERE idCadastro = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':tipo', $codigotipoID);
        $stmt->bindParam(':perfil', $codigoperfilID);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            header('Location: editar.php');
        } else {
            echo "Erro ao executar a atualização.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

$sql = "SELECT cadastro.*, 
            publico.nomePublico as perfilCadastro,
            publico.idPublico as codigopublico,
            tipoatendimento.idTipoAtendimento as codigoatendimento,
            tipoatendimento.descricao as tipoCadastro
    FROM cadastro
    INNER JOIN publico ON cadastro.perfilCadastro = publico.idPublico
    INNER JOIN tipoatendimento ON cadastro.tipoCadastro = tipoatendimento.idTipoAtendimento";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$conn = null;

?>
