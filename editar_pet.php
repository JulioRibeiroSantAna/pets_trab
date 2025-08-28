<?php 
include 'conexao.php'; 
include 'verificar_sessao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Editar Pet</title>
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
        <h1 class="page-title">Editar Pet</h1>

        <?php
        // Verifica se o ID do pet foi passado
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo '<div class="alert alert-danger">ID do pet não especificado.</div>';
            echo '<div class="text-center" style="margin-top: 20px;"><a href="listar_pets.php" class="btn btn-primary">Voltar</a></div>';
            exit();
        }

        $id_pet = $_GET['id'];
        
        // Busca os dados do pet
        $sql = "SELECT p.*, e.nome as especie_nome 
                FROM pets p 
                JOIN especies e ON p.id_especie = e.id_especie 
                WHERE p.id_pet = $id_pet";
        $result = mysqli_query($con, $sql);
        
        if ($result && mysqli_num_rows($result) == 1) {
            $pet = mysqli_fetch_assoc($result);
            $nome = $pet['nome'];
            $id_especie = $pet['id_especie'];
            $nascimento = $pet['nascimento'];
            $prontuario = $pet['prontuario'];
            $genero = $pet['genero'];
        } else {
            echo '<div class="alert alert-danger">Pet não encontrado.</div>';
            echo '<div class="text-center" style="margin-top: 20px;"><a href="listar_pets.php" class="btn btn-primary">Voltar</a></div>';
            exit();
        }
        
        // Processa o formulário quando enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $novo_nome = mysqli_real_escape_string($con, $_POST['nome']);
            $novo_id_especie = mysqli_real_escape_string($con, $_POST['id_especie']);
            $novo_nascimento = mysqli_real_escape_string($con, $_POST['nascimento']);
            $novo_prontuario = mysqli_real_escape_string($con, $_POST['prontuario']);
            $novo_genero = mysqli_real_escape_string($con, $_POST['genero']);
            
            if (!empty($novo_nome) && !empty($novo_id_especie)) {
                $sql_update = "UPDATE pets SET 
                                nome = '$novo_nome', 
                                id_especie = '$novo_id_especie', 
                                nascimento = " . (!empty($novo_nascimento) ? "'$novo_nascimento'" : "NULL") . ", 
                                prontuario = '$novo_prontuario', 
                                genero = '$novo_genero' 
                              WHERE id_pet = $id_pet";
                
                if (mysqli_query($con, $sql_update)) {
                    header('Location: listar_pets.php?sucesso=edicao');
                    exit();
                } else {
                    $erro = "Erro ao atualizar: " . mysqli_error($con);
                }
            } else {
                $erro = "Por favor, preencha todos os campos obrigatórios.";
            }
            
            if (isset($erro)) {
                echo '<div class="alert alert-danger">' . $erro . '</div>';
            }
        }
        
        // Busca todas as espécies para o dropdown
        $sql_especies = "SELECT * FROM especies ORDER BY nome";
        $result_especies = mysqli_query($con, $sql_especies);
        ?>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nome">Nome do Pet:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="id_especie">Espécie:</label>
                        <select id="id_especie" name="id_especie" required class="form-control">
                            <option value="">Selecione uma espécie</option>
                            <?php
                            if ($result_especies && mysqli_num_rows($result_especies) > 0) {
                                while ($especie = mysqli_fetch_assoc($result_especies)) {
                                    $selected = ($especie['id_especie'] == $id_especie) ? 'selected' : '';
                                    echo "<option value='{$especie['id_especie']}' $selected>{$especie['nome']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="nascimento">Data de Nascimento:</label>
                        <input type="date" id="nascimento" name="nascimento" value="<?php echo $nascimento; ?>" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="prontuario">Prontuário:</label>
                        <textarea id="prontuario" name="prontuario" class="form-control" rows="4"><?php echo htmlspecialchars($prontuario); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Gênero:</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" id="genero_m" name="genero" value="Macho" <?php echo ($genero == 'Macho') ? 'checked' : ''; ?> required>
                                Macho
                            </label>
                            <label class="radio-option">
                                <input type="radio" id="genero_f" name="genero" value="Fêmea" <?php echo ($genero == 'Fêmea') ? 'checked' : ''; ?> required>
                                Fêmea
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="listar_pets.php" class="btn btn-secondary">Cancelar</a>
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