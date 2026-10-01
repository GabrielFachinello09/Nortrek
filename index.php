<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/includes/functions.php';

// Busca todos os produtos do banco PostgreSQL
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$stmt = $conexao->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nortrek - Equipamentos de Camping</title>
    <!-- Estilo CSS em caminho absoluto -->
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
</head>
<body>

    <?php 
// 1. Administrador Logado
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'admin') {
    include __DIR__ . '/includes/header.php';
} 
// 2. Cliente Logado
elseif (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'cliente') {
    ?>
    <header class="header-publico">
        <nav>
            <a href="/mini-sistema/nortrek/index.php">Início</a> | 
            <a href="/mini-sistema/nortrek/login/logout.php">Sair (Logout)</a>
        </nav>
    </header>
    <?php
} 
// 3. Visitante Não Logado
else {
    ?>
    <header class="header-publico">
        <nav>
            <a href="/mini-sistema/nortrek/index.php">Início</a> | 
            <a href="/mini-sistema/nortrek/login/login.php">Login / Entrar</a>
            <a href="/mini-sistema/nortrek/login/cadastrar.php">Cadastrar Cliente</a>
        </nav>
    </header>
    <?php
}
?>

    <main class="container">
        <h1>Catálogo de Equipamentos</h1>

        <div class="vitrine-produtos">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="card-produto">
                        
                        <div class="container-imagem">
                            <?php 
                            // Garante imagem padrão caso a coluna esteja vazia
                            $nome_imagem = !empty($produto['imagem']) ? $produto['imagem'] : 'sem-foto.jpg';
                            ?>
                            <!-- Caminho absoluto para os arquivos de imagem em assets/ -->
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