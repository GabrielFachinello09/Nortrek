<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/functions.php';

$erro = '';

// Processamento do formulário no TOPO (antes de qualquer HTML)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    $cliente = consulta_cliente($conexao, $email);
    
    // Suporta senha em texto puro ou criptografada via password_hash
    if ($cliente && $email === $cliente['email'] && ($senha === $cliente['senha'] || password_verify($senha, $cliente['senha']))) {
        
        // Salva os dados do usuário na sessão
        $_SESSION['id']     = $cliente['id'];
        $_SESSION['nome']   = $cliente['nome'];
        $_SESSION['perfil'] = $cliente['perfil']; // Espera 'admin' ou 'cliente'

        header("Location: /mini-sistema/nortrek/index.php");
        exit();
        
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nortrek</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
</head>
<body>

    <h1>Faça Login</h1>
    <br>

    <?php if (!empty($erro)): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="email">Digite seu E-mail: </label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Digite sua Senha: </label>
        <input type="password" name="senha" id="senha" required><br>

        <input type="submit" value="Fazer Login">
    </form>

    <br>
    <a href="/mini-sistema/nortrek/login/cadastrar.php">Ainda não possui login? Cadastre-se</a>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>