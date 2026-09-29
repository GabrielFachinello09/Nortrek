<?php require_once __DIR__ . '/../includes/functions.php'; 
require_once __DIR__ . '/../login/verifica_admin.php';?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
</head>
<body>
        <h1>Cadastro de Clientes</h1>
        <?php include __DIR__ . '/../includes/header.php'; ?>
        <br>
        <form action="" method="post">
            
            <label for="nome">Digite seu Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" required><br>

            <label for="email">Digite seu E-mail: </label>
            <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required><br>
            
            <label for="telefone">Digite seu Telefone: </label>
            <input type="tel" name="telefone" id="telefone" placeholder="(11) 99999-9999" maxlength="15" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}" required><br>

            <label for="senha">Digite sua Senha: </label>
            <input type="password" name="senha" id="senha" required><br>

            <input type="submit" value="Fazer Cadastro">
        </form>
        <br>
        <a href="/mini-sistema/nortrek/login/login.php">Fazer Login</a>
   
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST") {
            cadastrar_cliente(
                $conexao,
                $_POST['nome'],
                $_POST['email'],
                $_POST['senha'],
                $_POST['telefone']
            );
        }
        include __DIR__ .'/../includes/footer.php'; 
    ?>
</body>
</html>