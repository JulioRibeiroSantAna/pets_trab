<?php
include 'conexao.php';

$especies = [];
$sql_especies = "SELECT * FROM especies ORDER BY nome";
$result_especies = mysqli_query($con, $sql_especies);
if ($result_especies) {
    while ($row = mysqli_fetch_assoc($result_especies)) {
        $especies[] = $row;
    }
}

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $id_especie = $_POST['id_especie'];
    $prontuario = $_POST['prontuario'];
    $genero = $_POST['genero'];
    
    $erros = [];
    
    if (empty($nome)) $erros[] = "Preencha o nome do pet";
    if (empty($id_especie)) $erros[] = "Selecione uma espécie";
    
    if (count($erros) == 0) {
        $sql = "INSERT INTO pets (nome, nascimento, id_especie, prontuario, genero) 
                VALUES ('$nome', '$nascimento', $id_especie, '$prontuario', '$genero')";
        
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Pet cadastrado com sucesso');</script>";
            echo "<script>window.location.href='listar_pets.php';</script>";
        } else {
            echo "Erro: " . mysqli_error($con);
        }
    } else {
        foreach ($erros as $erro) {
            echo "<div class='erro'>$erro</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastrar Pet</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4CAF50;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .radio-group {
            margin-top: 10px;
        }
        
        .radio-option {
            display: inline-block;
            margin-right: 20px;
        }
        
        .radio-option input {
            margin-right: 8px;
        }
        
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-right: 10px;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
        
        .btn-secondary {
            background-color: #6c757d;
        }
        
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        
        .erro {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .actions {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Novo Pet</h2>
        
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome do Pet:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="nascimento">Data de Nascimento:</label>
                <input type="date" id="nascimento" name="nascimento">
            </div>
            
            <div class="form-group">
                <label for="id_especie">Espécie:</label>
                <select id="id_especie" name="id_especie" required>
                    <option value="">Selecione uma espécie</option>
                    <?php foreach ($especies as $especie): ?>
                        <option value="<?= $especie['id_especie'] ?>"><?= htmlspecialchars($especie['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="prontuario">Prontuário:</label>
                <textarea id="prontuario" name="prontuario"></textarea>
            </div>
            
            <div class="form-group">
                <label>Gênero:</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="genero_macho" name="genero" value="Macho" checked>
                        <label for="genero_macho">Macho</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="genero_femea" name="genero" value="Fêmea">
                        <label for="genero_femea">Fêmea</label>
                    </div>
                </div>
            </div>
            
            <div class="actions">
                <button type="submit" name="enviar" class="btn">Cadastrar Pet</button>
                <a href="listar_pets.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>