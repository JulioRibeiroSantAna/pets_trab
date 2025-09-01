<?php
declare(strict_types=1);

include 'verificar_sessao.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'conexao.php';

function go(string $url): void {
    header("Location: {$url}");
    exit;
}

if (!isset($_GET['tabela'], $_GET['id'])) {
    go('index.php?erro=parametros_invalidos');
}

$tabela = $_GET['tabela'];
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

$map = [
    'pets'     => ['pk' => 'id_pet',     'redirect' => 'listar_pets.php'],
    'especies' => ['pk' => 'id_especie', 'redirect' => 'listar_especies.php'],
];

if ($id === false || !isset($map[$tabela])) {
    go('index.php?erro=parametros_invalidos');
}

$redirect = $map[$tabela]['redirect'];
$pk       = $map[$tabela]['pk'];

// Verifica se tem dependencia
if ($tabela === 'especies') {
    $stmt = $con->prepare('SELECT COUNT(*) FROM pets WHERE id_especie = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($qtd);
    $stmt->fetch();
    $stmt->close(); 

    if ($qtd > 0) {
        go($redirect . '?erro=dependencias');
    }
}

// Exclusão
$sql  = "DELETE FROM {$tabela} WHERE {$pk} = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    $stmt->close();
    $con->close();
    go($redirect . '?sucesso=exclusao');
} else {
    $msg = urlencode($stmt->error);
    $stmt->close();
    $con->close();
    go($redirect . '?erro=exclusao&msg=' . $msg);
}
