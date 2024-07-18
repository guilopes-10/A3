<?php
    // Inicia uma nova sessão ou retoma a sessão existente
    session_start();

    // Remove todas as variáveis de sessão
    session_unset();

    // Destrói completamente a sessão atual
    session_destroy();

    // Redireciona o usuário para a página de login
    header('Location: login.php');

    // Encerra a execução do script para garantir que o 
    // redirecionamento ocorra imediatamente
    exit();
?>
