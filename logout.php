<?php
session_start();

// Destroi td as variaveis de sessao
$_SESSION = array();

// Destruir a sessão
session_destroy();

// manda pro login
header('Location: login.php');
exit();
?>