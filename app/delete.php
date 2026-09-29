<?php require_once __DIR__ . '/../login/verifica_admin.php';
require_once __DIR__ . '/../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Produto</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">

</head>
<body>
    <br>
    <h1>Excluir Produto</h1>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <form action="" method="post">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id">
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        deletar_produto($conexao, $_POST['id']);
    }
    include __DIR__ . '/../includes/footer.php'; 
    ?>
    <br>
</body>
</html>
