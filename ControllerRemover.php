<?php
include_once 'Conexao.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $database = new Conexao();
        $conn = $database->fazConexao();
        $sql = "DELETE FROM cadastro WHERE idCadastro = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $conn = null;

        header('Location: editar.php');
        exit();
    }
?>