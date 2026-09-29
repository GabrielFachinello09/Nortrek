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
<body>
    <br>
    <h1>Cadastro de Produtos</h1>
    <?php include __DIR__ .'/../includes/header.php'; ?>
    <br>
    <hr>
    <br>
    <form action="" method='POST' enctype="multipart/form-data">
        <label for="nome">Nome do produto: </label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="marca">Marca: </label>
        <input type="text" name="marca" id="marca" required><br> 

        <aside class="sidebar">
  <h3>Categorias</h3>
 <label for="categoria">Categorias:</label>
<select id="categoria" name="categoria">
  <option value="">Selecione uma categoria</option>
  <option value="todas">Todas</option>
  <option value="barracas">Barracas</option>
  <option value="mochilas">Mochilas</option>
  <option value="iluminacao">Iluminação</option>
  <option value="cozinha">Cozinha</option>
  <option value="vestuario">Vestuário</option>
  <option value="acessorios">Acessórios</option>
  <option value="equipamentos">Equipamentos</option>
  <option value="camping">Camping</option>
  <option value="trilhas">Trilhas</option>
</select>
<br>
        <label for="descricao">Descrição: </label>
        <textarea name="descricao" id="descricao" rows="4" cols="40" placeholder="Digite uma Descrição Breve do Produto" required></textarea><br>
        
        <label for="preco">Preço (R$): </label>
        <input type="number" name="preco" id="preco" step="0.01" min="0" required><br>

        <label for="estoque">Estoque: </label>
        <input type="number" name="estoque" id="estoque" min="0" value="0" required><br>

        <label for="avaliacao">Avaliação (0 a 5): </label>
        <input type="number" name="avaliacao" id="avaliacao" step="0.1" min="0" max="5"><br>
        
        
        <label for="imagem">Escolha o Arquivo da Imagem:  </label>
        <input type="file" name="imagem" id="imagem" accept="image/*" required><br>
        
        
        <br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Cadastrar">
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura o arquivo de $_FILES em vez de $_POST
    $imagem = $_FILES['imagem'] ?? null;

    cadastrar_produto(
        $conexao, 
        $_POST['nome'], 
        $_POST['marca'], 
        $_POST['categoria'], 
        $_POST['descricao'],
        $_POST['preco'], 
        $_POST['estoque'], 
        $_POST['avaliacao'], 
        $imagem // Passa $_FILES['imagem']
    );
}
        
        include __DIR__ . '/../includes/footer.php'; 
        ?>
</body>
</html>