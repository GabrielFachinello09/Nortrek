<?php require_once __DIR__ . '/../login/verifica_admin.php';
require_once __DIR__ . '/../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Consulta de Produtos</title>
        <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
</head>
<hr>

<body>  
  
    <h1>Consulta de Produto</h1>
    <?php include __DIR__ . '/../includes/header.php'; ?>


    <form action="" method="post">
        <label for="id">Digite o ID do produto que você deseja visualizar: </label>
        <input type="number" name="id" id="id"><br>
        <br><br>
        <input type="submit" value="Consultar">
    </form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        consultar_produto($conexao, $_POST['id']);
    }
    include __DIR__ . '/../includes/footer.php';
?>
</body>
</html>



