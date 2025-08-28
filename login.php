<?php
session_start();
include 'conexao.php';

// Verifica se ta logado
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header('Location: index.php');
    exit();
}

// Processa o form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $senha = $_POST['senha'];
    
    if (!empty($usuario) && !empty($senha)) {

        // Verificacao
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $result = mysqli_query($con, $sql);
        
        if ($result && mysqli_num_rows($result) == 1) {

            // Login deu certo
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php');
            exit();
        } else {
            $erro = "Usuário ou senha inválidos!";
        }
    } else {
        $erro = "Por favor, preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Login - Sistema de Pets</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
        }
        
        .login-card {
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 10px var(--shadow);
            padding: 30px;
        }
        
        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="login-card">
            <h1 class="login-title">Sistema de Pets</h1>
            
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required class="form-control" 
                        value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required class="form-control">
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
            </form>
            
            <div style="margin-top: 20px; text-align: center; font-size: 14px; color: #666;">
                <p>Usuário: <strong>user</strong><br>Senha: <strong>123</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($con); ?>