<?php
session_start();

// ve se ta logado
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    // Se esta manda para a pagina principal
    header('Location: principal.php');
    exit();
} else {
    // Se não manda pro login
    header('Location: login.php');
    exit();
}
?>