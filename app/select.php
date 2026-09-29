<?php require_once __DIR__ . '/../login/verifica_admin.php';
require_once __DIR__ . '/../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">

</head>

<body>
    <br>
    <h1>Catálogo de Produtos</h1>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <main>
        <div style="width: 50%; margin:auto; text-align:center; border:1px solid black; border-radius:5px;">
        <h3>Lista Completa de Produtos</h3>
        <?php
        listar_produtos($conexao);
        ?>
        </div>
    </main>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>