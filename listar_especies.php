<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lista de Espécies</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .acoes a { margin-right: 5px; }
    </style>
</head>
<body>
    <h2>Lista de Espécies</h2>
    <p><a href="cadastrar_especie.php">Nova Espécie</a></p>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM especies ORDER BY nome";
        $result = mysqli_query($con, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['id_especie']}</td>
                    <td>{$row['nome']}</td>
                    <td class='acoes'>
                        <a href='editar_especie.php?id={$row['id_especie']}'>Editar</a>
                        <a href='excluir_especie.php?id={$row['id_especie']}' onclick='return confirm(\"Tem certeza?\")'>Excluir</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhuma espécie cadastrada</td></tr>";
        }
        ?>
    </table>
    <p><a href="index.php">Voltar ao início</a></p>
</body>
</html>