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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php 
    // Exibe o cabeçalho completo se for admin
    if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'admin') {
        include __DIR__ . '/includes/header.php';
    } 
    ?>

    <main class="container">
        <h1>Catálogo de Equipamentos</h1>

        <div class="vitrine-produtos">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="card-produto">
                        <!-- Exibe a imagem salva na pasta assets/ -->
                        <div class="container-imagem">
                            <img src="assets/<?= htmlspecialchars($produto['imagem']) ?>" 
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