<?php
include 'conexao.php';
include 'verificar_sessao.php';

if (isset($_POST['enviar'])) {
    $nome = trim($_POST['nome']);

    if (empty($nome)) {
        $erro = "<div class='alert alert-danger'>Por favor, informe o nome da espécie</div>";
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
            $erro = "<div class='alert alert-danger'>Erro no cadastro: " . mysqli_error($con) . "</div>";
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
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="card-header">Cadastrar Nova Espécie</h2>

            <div class="card-body">
                <?php if (isset($erro)) echo $erro; ?>

                <form method="post" class="form">
                    <div class="form-group">
                        <label for="nome">Nome da Espécie</label>
                        <input type="text" id="nome" name="nome" class="form-control"
                            placeholder="Digite o nome da espécie (ex: Cachorro, Gato)" required>
                    </div>

                    <div class="alinhamento-botoes">
                        <a href="principal.php" class="btn btn-secondary voltar-esquerda">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>

                        <div class="botoes-direita">
                            <button type="submit" name="enviar" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cadastrar
                            </button>
                            <a href="listar_especies.php" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Lista Espécies
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
