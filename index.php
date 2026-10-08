<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/includes/functions.php';

// Busca todos os produtos do banco PostgreSQL
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$stmt = $conexao->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Captura os filtros enviados pelo formulário GET
$busca     = trim($_GET['busca'] ?? '');
$categoria = trim($_GET['categoria'] ?? '');
$ordem     = trim($_GET['ordem'] ?? '');

// Chama a função centralizada do functions.php
$produtos = buscar_produtos_filtrados($conexao, $busca, $categoria, $ordem);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nortrek - Equipamentos de Camping</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
    <link rel="icon" type="image/png" href="assets/pinheiro.png">
</head>
<body>

    <?php 
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'admin') {
    include __DIR__ . '/includes/header.php';
} 

elseif (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'cliente') {
    ?>
    <header class="header-publico">
        <nav>
            <a href="/mini-sistema/nortrek/index.php">Início</a> | <a href="/mini-sistema/nortrek/sobre/sobre.php">Sobre</a>
            

            <a href="/mini-sistema/nortrek/carrinho/carrinho.php">
                🛒 Carrinho (<?= contar_itens_carrinho($conexao, (int) $_SESSION['id']) ?>)
            </a> |
            <a href="/mini-sistema/nortrek/login/logout.php">Sair (Logout)</a>
        </nav>
    </header>
    <?php
} 
else {
    ?>
    <header class="header-publico">
        <nav>
            <a href="/mini-sistema/nortrek/index.php">Início</a> | <a href="/mini-sistema/nortrek/sobre/sobre.php">Sobre </a>
            <a href="/mini-sistema/nortrek/login/login.php">Login / Entrar</a>
            <a href="/mini-sistema/nortrek/login/cadastrar.php">Cadastrar Cliente</a>
        </nav>
    </header>
    <?php
}
?>

<?php if (($_GET['carrinho'] ?? '') === 'ok'): ?>
    <div class="alert alert-success" role="status">Produto adicionado ao carrinho.</div>
<?php elseif (($_GET['carrinho'] ?? '') === 'erro'): ?>
    <div class="alert alert-danger" role="alert">Não foi possível adicionar o produto.</div>
<?php endif; ?>

<hr>
   <section class="painel-filtros">
    <form action="/mini-sistema/nortrek/index.php" method="GET" class="form-filtros">
        
        <input type="text" name="busca" placeholder="Buscar equipamento..." value="<?= htmlspecialchars($busca) ?>">

        
        <select name="categoria">
            <option value="">Todas as Categorias</option>
            <option value="barracas" <?= $categoria === 'barracas' ? 'selected' : '' ?>>Barracas</option>
            <option value="mochilas" <?= $categoria === 'mochilas' ? 'selected' : '' ?>>Mochilas</option>
            <option value="iluminacao" <?= $categoria === 'iluminacao' ? 'selected' : '' ?>>Iluminação</option>
            <option value="cozinha" <?= $categoria === 'cozinha' ? 'selected' : '' ?>>Cozinha</option>
            <option value="vestuario" <?= $categoria === 'vestuario' ? 'selected' : '' ?>>Vestuário</option>
            <option value="acessorios" <?= $categoria === 'acessorios' ? 'selected' : '' ?>>Acessórios</option>
            <option value="equipamentos" <?= $categoria === 'equipamentos' ? 'selected' : '' ?>>Equipamentos</option>
            <option value="camping" <?= $categoria === 'camping' ? 'selected' : '' ?>>Camping</option>
            <option value="trilhas" <?= $categoria === 'trilhas' ? 'selected' : '' ?>>Trilhas</option>
        </select>

        <select name="ordem">
            <option value="">Ordenar por</option>
            <option value="preco_asc" <?= $ordem === 'preco_asc' ? 'selected' : '' ?>>Menor Preço</option>
            <option value="preco_desc" <?= $ordem === 'preco_desc' ? 'selected' : '' ?>>Maior Preço</option>
            <option value="avaliacao" <?= $ordem === 'avaliacao' ? 'selected' : '' ?>>Melhor Avaliação</option>
        </select>

        <button type="submit">Filtrar</button>
        
        <?php if (!empty($busca) || !empty($categoria) || !empty($ordem)): ?>
            <a href="/mini-sistema/nortrek/index.php" class="btn-limpar">Limpar Filtros</a>
        <?php endif; ?>
    </form>
</section>





    <main class="container">
        <h1>Catálogo de Equipamentos</h1>

        <div class="vitrine-produtos">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="card-produto">
                        
                        <div class="container-imagem">
                            <?php 
                            
                            $nome_imagem = !empty($produto['imagem']) ? $produto['imagem'] : 'sem-foto.jpg';
                            ?>
                            
                            <img src="/mini-sistema/nortrek/assets/<?= htmlspecialchars($nome_imagem) ?>" 
                                 alt="<?= htmlspecialchars($produto['nome']) ?>" 
                                 class="imagem-produto">
                        </div>
                        
                        <div class="detalhes-produto">
                            <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                            <span class="marca"><?= htmlspecialchars($produto['marca']) ?></span>
                            <p class="descricao"><?= htmlspecialchars($produto['descricao']) ?></p>
                            
                            <div class="info-preco">
                                <span class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
                                <span class="avaliacao">★ <?= htmlspecialchars($produto['avaliacao']) ?></span>
                            </div>
                        </div>

                        
                        <?php if (($_SESSION['perfil'] ?? '') === 'cliente'): ?>
                            <div class="acoes-produto">
                                <form action="/mini-sistema/nortrek/carrinho/adicionar.php" method="POST">
                                    <input type="hidden" name="produto_id" value="<?= (int) $produto['id'] ?>">
                                    <button type="submit" class="btn btn-primary"
                                            <?= $produto['estoque'] < 1 ? 'disabled' : '' ?>>
                                        <?= $produto['estoque'] < 1 ? 'Sem estoque' : '🛒 Adicionar ao carrinho' ?>
                                    </button>
                                </form>
                            </div>
                        <?php elseif (!isset($_SESSION['perfil'])): ?>
                            <div class="acoes-produto">
                                <a class="btn btn-outline" href="/mini-sistema/nortrek/login/login.php">Entre para comprar</a>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto cadastrado até o momento.</p>
            <?php endif; ?>
        </div>
    </main>

 

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>