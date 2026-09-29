<?php require_once __DIR__ . '/../includes/functions.php'; 
session_start();?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
</head>
    <body>

     <h1>Faça Login</h1>
    <br>
        <form action="" method="post">
            <label for="email">Digite seu E-mail: </label>
            <input type="text" name="email" id="email" required><br>

            <label for="senha">Digite sua Senha: </label>
            <input type="password" name="senha" id="senha" required><br>

            <input type="submit" value="Fazer Login">
        </form>

       
   

<?php
        if($_SERVER['REQUEST_METHOD']=="POST") {
            $cliente = consulta_cliente($conexao, $_POST['email']);
            
            if($cliente && $_POST['email'] == $cliente['email'] && $_POST['senha'] == $cliente['senha']){
                
                $_SESSION['id'] = $cliente['id'];
                $_SESSION['nome'] = $cliente['nome'];
                $_SESSION['perfil'] = $cliente['perfil'];
                header("Location: ../index.php");
                exit();
                
            } else {
                echo "Usuário ou senha inválidos.";
            }
        }
    ?>

    <?php include __DIR__ .'/../includes/footer.php'; ?>
</body>
</html>