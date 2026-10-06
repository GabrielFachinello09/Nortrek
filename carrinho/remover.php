<?php
require_once __DIR__ . '/../login/verifica_cliente.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
    if ($produto_id) {
        remover_do_carrinho($conexao, (int) $_SESSION['id'], $produto_id);
    }
}

header("Location: /mini-sistema/nortrek/carrinho/carrinho.php");
exit();