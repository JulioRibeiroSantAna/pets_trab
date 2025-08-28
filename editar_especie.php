<?php 
include 'conexao.php'; 
include 'verificar_sessao.php';?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Espécie</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
        .form-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .form-buttons .btn {
            flex: 1;
            min-width: 120px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Editar Espécie</h1>

        <?php
        // Verifica se o ID da espécie foi passado
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo '<div class="alert alert-danger">ID da espécie não especificado.</div>';
            echo '<div class="text-center" style="margin-top: 20px;"><a href="listar_especies.php" class="btn btn-primary">Voltar</a></div>';
            exit();
        }

        $id_especie = $_GET['id'];
        
        // Busca os dados da espécie
        $sql = "SELECT * FROM especies WHERE id_especie = $id_especie";
        $result = mysqli_query($con, $sql);
        
        if ($result && mysqli_num_rows($result) == 1) {
            $especie = mysqli_fetch_assoc($result);
            $nome = $especie['nome'];
        } else {
            echo '<div class="alert alert-danger">Espécie não encontrada.</div>';
            echo '<div class="text-center" style="margin-top: 20px;"><a href="listar_especies.php" class="btn btn-primary">Voltar</a></div>';
            exit();
        }
        
        // Processa o formulário quando enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $novo_nome = mysqli_real_escape_string($con, $_POST['nome']);
            
            if (!empty($novo_nome)) {
                $sql_update = "UPDATE especies SET nome = '$novo_nome' WHERE id_especie = $id_especie";
                
                if (mysqli_query($con, $sql_update)) {
                    header('Location: listar_especies.php?sucesso=edicao');
                    exit();
                } else {
                    $erro = "Erro ao atualizar: " . mysqli_error($con);
                }
            } else {
                $erro = "Por favor, preencha o nome da espécie.";
            }
            
            if (isset($erro)) {
                echo '<div class="alert alert-danger">' . $erro . '</div>';
            }
        }
        ?>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nome">Nome da Espécie:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required class="form-control">
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="listar_especies.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
                
                <div class="text-center" style="margin-top: 20px;">
                    <a href="principal.php" class="link">← Voltar ao Início</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($con); ?>