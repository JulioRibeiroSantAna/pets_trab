<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Juliusss Pet</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px 0;
            text-align: center;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        h1 {
            margin: 0;
            font-size: 2.5em;
        }
        
        .menu {
            display: flex;
            justify-content: center;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .menu a {
            margin: 0 15px;
            padding: 10px 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .menu a:hover {
            background-color: #4CAF50;
            color: white;
            transform: translateY(-2px);
        }
        
        .welcome-section {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        h2 {
            color: #4CAF50;
            margin-bottom: 15px;
        }
        
        p {
            font-size: 1.1em;
            color: #666;
        }
        
        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: #666;
            font-size: 0.9em;
        }
        
        @media (max-width: 768px) {
            .menu {
                flex-direction: column;
                align-items: center;
            }
            
            .menu a {
                margin: 5px 0;
                width: 80%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Juliusss Pet</h1>
        </div>
    </header>
    
    <div class="container">
        <nav class="menu">
            <a href="cadastrar_pet.php">Cadastrar Pet</a>
            <a href="cadastrar_especie.php">Cadastrar Espécie</a>
            <a href="listar_pets.php">Listar Pets</a>
            <a href="listar_especies.php">Listar Espécies</a>
        </nav>
        
        <section class="welcome-section">
            <h2>Bem-vindo ao Sistema Juliusss Pet</h2>
            <p>Gerencie seus pets e espécies de forma simples e eficiente</p>
        </section>
    </div>
    
    <footer>
        <div class="container">
            <p>Sistema desenvolvido para amantes de pets</p>
        </div>
    </footer>
</body>
</html>