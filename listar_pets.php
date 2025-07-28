<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Pets</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .btn-novo {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn-novo:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .acoes a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
        }
        .editar {
            background-color: #2196F3;
            color: white;
        }
        .excluir {
            background-color: #f44336;
            color: white;
        }
        .voltar {
            display: inline-block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
        .voltar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Lista de Pets</h2>
    <a href="cadastrar_pet.php" class="btn-novo">Novo Pet</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Espécie</th>
                <th>Nascimento</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT p.*, e.nome as especie_nome 
                    FROM pets p 
                    JOIN especies e ON p.id_especie = e.id_especie 
                    ORDER BY p.nome";
            $result = mysqli_query($con, $sql);
            
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data_nasc = $row['nascimento'] ? date('d/m/Y', strtotime($row['nascimento'])) : 'Não informado';
                    
                    echo "<tr>
                        <td>{$row['id_pet']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['especie_nome']}</td>
                        <td>{$data_nasc}</td>
                        <td>{$row['genero']}</td>
                        <td class='acoes'>
                            <a href='editar_pet.php?id={$row['id_pet']}' class='editar'>Editar</a>
                            <a href='excluir_pet.php?id={$row['id_pet']}' class='excluir' onclick='return confirm(\"Tem certeza que deseja excluir este pet?\")'>Excluir</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum pet cadastrado</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php" class="voltar">← Voltar ao início</a>
</body>
</html>