<?php
include 'conexao.php';
include 'verificar_sessao.php';

// Buscar espécies
$especies = [];
$sql_especies = "SELECT * FROM especies ORDER BY nome";
$result_especies = mysqli_query($con, $sql_especies);
if ($result_especies) {
    while ($row = mysqli_fetch_assoc($result_especies)) {
        $especies[] = $row;
    }
}

// Cadastrar Pet
if (isset($_POST['enviar'])) {
    $nome = trim($_POST['nome']);
    $nascimento = $_POST['nascimento'];
    $id_especie = $_POST['id_especie'];
    $prontuario = trim($_POST['prontuario']);
    $genero = $_POST['genero'] ?? "Macho";

    $erros = [];

    if (empty($nome)) $erros[] = "Preencha o nome do pet";
    if (empty($id_especie)) $erros[] = "Selecione uma espécie";

    if (count($erros) == 0) {
        $sql = "INSERT INTO pets (nome, nascimento, id_especie, prontuario, genero) 
                VALUES ('$nome', '$nascimento', $id_especie, '$prontuario', '$genero')";

        if (mysqli_query($con, $sql)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: 'Pet cadastrado com sucesso',
                    confirmButtonColor: '#4CAF50'
                }).then(() => {
                    window.location.href='listar_pets.php';
                });
            </script>";
        } else {
            echo "<div class='alert alert-danger'>Erro: " . mysqli_error($con) . "</div>";
        }
    } else {
        foreach ($erros as $erro) {
            echo "<div class='alert alert-danger'>$erro</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastrar Pet</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="card-header">Cadastrar Novo Pet</h2>

            <div class="card-body">
                <form method="post" class="form">
                    <div class="form-group">
                        <label for="nome">Nome do Pet</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite o nome do pet" required>
                    </div>

                    <div class="form-row" style="display:flex; gap:20px; flex-wrap:wrap;">
                        <div class="form-group col-md-6" style="flex:1;">
                            <label for="nascimento">Data de Nascimento</label>
                            <input type="date" id="nascimento" name="nascimento" class="form-control">
                        </div>

                        <div class="form-group col-md-6" style="flex:1;">
                            <label for="id_especie">Espécie</label>
                            <select id="id_especie" name="id_especie" class="form-control" required>
                                <option value="">Selecione uma espécie</option>
                                <?php foreach ($especies as $especie): ?>
                                    <option value="<?= $especie['id_especie'] ?>"><?= htmlspecialchars($especie['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Gênero</label>
                        <div class="radio-group" style="display:flex; gap:20px; margin-top:5px;">
                            <label class="radio-option">
                                <input type="radio" name="genero" value="Macho" checked>
                                <span class="radio-label">Macho</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="genero" value="Fêmea">
                                <span class="radio-label">Fêmea</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prontuario">Prontuário</label>
                        <textarea id="prontuario" name="prontuario" class="form-control" rows="4" placeholder="Informações sobre saúde, comportamento, etc."></textarea>
                    </div>

                    <div class="alinhamento-botoes">
                        <a href="principal.php" class="btn btn-secondary voltar-esquerda">
                            <i class="fas fa-arrow-left"></i> Voltar ao início
                        </a>

                        <div class="botoes-direita">
                            <a href="listar_pets.php" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Lista de pets
                            </a>
                            <button type="submit" name="enviar" class="btn btn-primary">
                                <i class="fas fa-paw"></i> Cadastrar Pet
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
