<?php 
include 'conexao.php'; 
include 'verificar_sessao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Lista de Pets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="page-title">Lista de Pets</h1>

        <?php
        if (isset($_GET['sucesso'])) {
            if ($_GET['sucesso'] == 'exclusao') {
                echo '<div class="alert alert-success">✅ Pet excluído com sucesso!</div>';
            } elseif ($_GET['sucesso'] == 'edicao') {
                echo '<div class="alert alert-success">✅ Pet atualizado com sucesso!</div>';
            }
        }
        if (isset($_GET['erro'])) {
            $msg = 'Erro ao excluir pet.' . (isset($_GET['msg']) ? ' ' . htmlspecialchars($_GET['msg']) : '');
            echo '<div class="alert alert-danger">'.$msg.'</div>';
        }
        ?>

        <div class="actions-bar">
            <a href="cadastrar_pet.php" class="btn btn-primary">+ Novo Pet</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Espécie</th>
                            <th>Nascimento</th>
                            <th>Prontuário</th>
                            <th>Gênero</th>
                            <th class="acoes-col">Ações</th>
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
                                $prontuario = $row['prontuario'] ? $row['prontuario'] : 'Nenhum prontuário cadastrado';

                                echo "<tr>
                                    <td>{$row['nome']}</td>
                                    <td>{$row['especie_nome']}</td>
                                    <td>{$data_nasc}</td>
                                    <td>{$prontuario}</td>
                                    <td>{$row['genero']}</td>
                                    <td class='botoes-direita'>
                                        <a href='editar_pet.php?id={$row['id_pet']}' class='btn btn-secondary btn-sm'>Editar</a>
                                        <a href='delete.php?tabela=pets&id={$row['id_pet']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este pet?\")'>Excluir</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Nenhum pet cadastrado</td></tr>";
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