<?php 
include 'conexao.php'; 
include 'verificar_sessao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Lista de Espécies</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="page-title">Lista de Espécies</h1>

        <?php
        if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'exclusao') {
            echo '<div class="alert alert-success">✅ Espécie excluída com sucesso!</div>';
        }
        if (isset($_GET['erro'])) {
            $msg = '';
            if ($_GET['erro'] == 'dependencias') {
                $msg = '⚠️ Não é possível excluir: existem pets vinculados a esta espécie.';
            } elseif ($_GET['erro'] == 'exclusao') {
                $msg = '❌ Erro ao excluir espécie. ' . (isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : '');
            }
            echo '<div class="alert alert-danger">'.$msg.'</div>';
        }
        ?>

        <div class="actions-bar">
            <a href="cadastrar_especie.php" class="btn btn-primary">+ Nova Espécie</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome da Espécie</th>
                            <th class="acoes-col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM especies ORDER BY nome";
                        $result = mysqli_query($con, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$row['nome']}</td>
                                    <td class='botoes-direita'>
                                        <a href='editar_especie.php?id={$row['id_especie']}' class='btn btn-secondary btn-sm'>Editar</a>
                                        <a href='delete.php?tabela=especies&id={$row['id_especie']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir esta espécie?\")'>Excluir</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center'>Nenhuma espécie cadastrada</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="text-center" style="margin-top: 20px;">
                    <a href="principal.php" class="link">← Voltar ao Início</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($con); ?>