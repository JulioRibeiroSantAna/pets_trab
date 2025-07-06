<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Juliusss Pet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .menu {
            margin-bottom: 20px;
        }
        .menu a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="cadastrar_pet.php">Cadastrar Pet</a>
        <a href="cadastrar_especie.php">Cadastrar Espécie</a>
        <a href="listar_pets.php">Listar Pets</a>
        <a href="listar_especies.php">Listar Espécies</a>
    </div>
    
    <h2>Bem-vindo ao Juliusss Pet</h2>
    <p>Sistema de gestão de Pets</p>
</body>
</html>