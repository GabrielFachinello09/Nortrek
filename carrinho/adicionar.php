<?php
require_once __DIR__ . '/../login/verifica_cliente.php';   // exige login
require_once __DIR__ . '/../includes/functions.php';

// Só aceita POST e só para perfil "cliente"
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_SESSION['perfil'] ?? '') !== 'cliente') {
    header("Location: /mini-sistema/nortrek/index.php");
    exit();
}

$produto_id = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
$ok = $produto_id && adicionar_ao_carrinho($conexao, (int) $_SESSION['id'], $produto_id);

header("Location: /mini-sistema/nortrek/index.php?carrinho=" . ($ok ? 'ok' : 'erro'));
exit();