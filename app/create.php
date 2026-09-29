<?php require_once __DIR__ . '/../login/verifica_admin.php';
require_once __DIR__ . '/../includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">

</head>
<body style="text-align:center;">
    <br>
    <h1>Cadastro de Produtos</h1>
    <?php include __DIR__ .'/../includes/header.php'; ?>
    <br>
    <hr>
    <br>
    <form action="" method='POST'>
        <label for="nome">Nome do produto: </label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="marca">Marca: </label>
        <input type="text" name="marca" id="marca" required><br> 

        <label for="categoria">Categoria: </label>
        <select name="categoria" id="categoria" required>
            <option value="Barracas">Barracas</option>
            <option value="Mochilas">Mochilas</option>
            <option value="Iluminação">Iluminação</option>
            <option value="Cozinha">Cozinha</option>
            <option value="Vestuário">Vestuário</option>
            <option value="Acessórios">Acessórios</option>
            <option value="Equipamentos">Equipamentos</option>
            <option value="Camping">Camping</option>
            <option value="Trilhas">Trilhas</option>
        </select><br>

        <label for="descricao">Descrição: </label>
        <textarea name="descricao" id="descricao" rows="4" cols="40" placeholder="Digite uma Descrição Breve do Produto" required></textarea><br>
        
        <label for="preco">Preço (R$): </label>
        <input type="number" name="preco" id="preco" step="0.01" min="0" required><br>

        <label for="estoque">Estoque: </label>
        <input type="number" name="estoque" id="estoque" min="0" value="0" required><br>

        <label for="avaliacao">Avaliação (0 a 5): </label>
        <input type="number" name="avaliacao" id="avaliacao" step="0.1" min="0" max="5"><br>

        <label for="imagem">URL da imagem: </label>
        <input type="text" name="imagem" id="imagem" placeholder="https://..."><br>
        <br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Cadastrar">
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            cadastrar_produto(
                $conexao, 
                $_POST['nome'], 
                $_POST['marca'], 
                $_POST['categoria'], 
                $_POST['descricao'],
                $_POST['preco'], 
                $_POST['estoque'], 
                $_POST['avaliacao'], 
                $_POST['imagem']
            );
                
        }
        
        include __DIR__ . '/../includes/footer.php'; 
        ?>
</body>
</html>