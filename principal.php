<?php 
include 'verificar_sessao.php';
include 'conexao.php'; 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Sistema de Gerenciamento de Pets</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="alinhamento-botoes">
            <h1 class="page-title">Sistema de Gerenciamento de Pets</h1>
            <div class="botoes-direita">
                <span style="margin-right: 15px;">Olá, <?php echo $_SESSION['usuario']; ?></span>
                <a href="logout.php" class="btn btn-danger btn-sm">Sair</a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <!-- Card Espécies -->
                    <div class="text-center">
                        <h2>Espécies</h2>
                        <p>Gerencie as espécies de animais</p>
                        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
                            <a href="listar_especies.php" class="btn btn-primary">Ver Espécies</a>
                            <a href="cadastrar_especie.php" class="btn btn-secondary">Adicionar Espécie</a>
                        </div>
                    </div>
                    
                    <!-- Card Pets -->
                    <div class="text-center">
                        <h2>Pets</h2>
                        <p>Gerencie os pets cadastrados</p>
                        <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
                            <a href="listar_pets.php" class="btn btn-primary">Ver Pets</a>
                            <a href="cadastrar_pet.php" class="btn btn-secondary">Adicionar Pet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($con); ?>