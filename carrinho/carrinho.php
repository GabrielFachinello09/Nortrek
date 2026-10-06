<?php
require_once __DIR__ . '/../login/verifica_cliente.php';
require_once __DIR__ . '/../includes/functions.php';

$itens = listar_carrinho($conexao, (int) $_SESSION['id']);
$total = 0;
foreach ($itens as $item) {
    $total += $item['preco'] * $item['quantidade'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - Nortrek</title>
    <link rel="stylesheet" href="/mini-sistema/nortrek/css/style.css">
</head>
<body>
    <h1>Meu Carrinho</h1>

    <header class="header-publico">
        <nav>
            <a href="/mini-sistema/nortrek/index.php">Início</a>
            <a href="/mini-sistema/nortrek/login/logout.php">Sair (Logout)</a>
        </nav>
    </header>

    <?php if (empty($itens)): ?>
        <div class="alert alert-info" role="status">Seu carrinho está vazio.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th class="num">Preço</th>
                        <th class="num">Qtd.</th>
                        <th class="num">Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($itens as $item): ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($item['nome']) ?></strong><br>
                            <small><?= htmlspecialchars($item['marca']) ?></small>
                        </td>
                        <td class="num">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        <td class="num"><?= (int) $item['quantidade'] ?></td>
                        <td class="num">R$ <?= number_format($item['preco'] * $item['quantidade'], 2, ',', '.') ?></td>
                        <td>
                            <form action="/mini-sistema/nortrek/carrinho/remover.php" method="POST">
                                <input type="hidden" name="produto_id" value="<?= (int) $item['produto_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <p><strong>Total: R$ <?= number_format($total, 2, ',', '.') ?></strong></p>
    <?php endif; ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>