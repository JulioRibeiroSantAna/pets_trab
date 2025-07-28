<?php
include 'conexao.php';

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    
    if (empty($nome)) {
        $erro = "<div class='erro-mensagem'>Por favor, informe o nome da espécie</div>";
    } else {
        $sql = "INSERT INTO especies (nome) VALUES ('$nome')";
        
        if (mysqli_query($con, $sql)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Espécie cadastrada com sucesso',
                    confirmButtonColor: '#4CAF50'
                }).then(() => {
                    window.location.href='listar_especies.php';
                });
            </script>";
        } else {
            $erro = "<div class='erro-mensagem'>Erro no cadastro: " . mysqli_error($con) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Espécie</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #3e8e41;
            --error-color: #f44336;
            --text-color: #333;
            --light-gray: #f5f5f5;
            --border-color: #ddd;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
        }
        
        .form-container {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: var(--text-color);
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input[type="text"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        
        .btn {
            display: block;
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        
        .btn:hover {
            background-color: var(--primary-hover);
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        .erro-mensagem {
            background-color: #ffebee;
            color: var(--error-color);
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border-left: 4px solid var(--error-color);
            font-size: 14px;
        }
        
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                margin: 20px auto;
            }
            
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Cadastrar Nova Espécie</h1>
        
        <?php if(isset($erro)) echo $erro; ?>
        
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome da Espécie</label>
                <input type="text" id="nome" name="nome" required 
                       placeholder="Digite o nome da espécie (ex: Cachorro, Gato)">
            </div>
            
            <button type="submit" name="enviar" class="btn">Cadastrar</button>
            <a href="listar_especies.php" class="back-link">← Voltar para a lista</a>
        </form>
    </div>
</body>
</html>