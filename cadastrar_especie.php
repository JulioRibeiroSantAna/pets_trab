<?php
include 'conexao.php';

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    
    if (empty($nome)) {
        echo "Preencha o nome da espécie";
    } else {
        $sql = "INSERT INTO especies (nome) VALUES ('$nome')";
        
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Espécie cadastrada com sucesso');</script>";
            echo "<script>window.location.href='listar_especies.php';</script>";
        } else {
            echo "Erro: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastrar Espécie</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; }
        input[type="text"] { width: 100%; padding: 8px; margin: 5px 0 15px; }
        input[type="submit"] { padding: 8px 15px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #45a049; }
    </style>
</head>
<body>
    <h2>Cadastrar Espécie</h2>
    <form method="post">
        Nome da Espécie: <br>
        <input type="text" name="nome" required><br>
        <input type="submit" name="enviar" value="Cadastrar">
    </form>
    <p><a href="listar_especies.php">Voltar para lista</a></p>
</body>
</html>