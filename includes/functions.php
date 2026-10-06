<?php
require_once __DIR__ . '/../database/connect.php';

function cadastrar_produto($conexao, $nome, $marca, $categoria, $descricao, $preco, $estoque, $avaliacao, $file_imagem) {
    // Valida se a imagem foi enviada sem erros
    if (!$file_imagem || $file_imagem['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Erro no envio da imagem. Verifique se escolheu um arquivo válido.');</script>";
        return;
    }

    // Processamento da imagem
    $extensao = strtolower(pathinfo($file_imagem['name'], PATHINFO_EXTENSION));
    $nome_imagem = uniqid('prod_') . '.' . $extensao;
    
    $diretorio_destino = __DIR__ . '/../assets/';
    $caminho_completo = $diretorio_destino . $nome_imagem;

    if (move_uploaded_file($file_imagem['tmp_name'], $caminho_completo)) {
        $sql = "INSERT INTO produtos (nome, marca, categoria, descricao, preco, estoque, avaliacao, imagem) 
                VALUES (:nome, :marca, :categoria, :descricao, :preco, :estoque, :avaliacao, :imagem)";
                
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':marca' => $marca,
            ':categoria' => $categoria,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':estoque' => $estoque,
            ':avaliacao' => $avaliacao,
            ':imagem' => $nome_imagem
        ]);
        
        echo "<script>alert('Produto cadastrado com sucesso!'); window.location.href='/mini-sistema/nortrek/index.php';</script>";
    } else {
        echo "<script>alert('Erro ao salvar o arquivo de imagem na pasta assets.');</script>";
    }
}
function deletar_produto($conexao, $id) 
{
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $sql = "DELETE FROM produtos WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    echo "Produto ". $id ." excluído.";
    } else {
        echo "Insira o ID para excluir. <br>";
    }
}

function listar_produtos($conexao)
{
    $sql = "SELECT * FROM produtos ORDER BY id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtos as $produto) {
        echo "<hr>";
        echo "ID: {$produto['id']} <br>";
        echo "Nome: {$produto['nome']} <br>";
        echo "Marca: {$produto['marca']} <br>";
        echo "Categoria: {$produto['categoria']} <br>";
        echo "Preço: R$ {$produto['preco']} <br>";
        echo "Estoque: {$produto['estoque']} <br>";
        echo "Avaliação: {$produto['avaliacao']} <br>";
    }
}

function consultar_produto($conexao, $id)
{

     $sql = "SELECT nome, marca, categoria, descricao, preco, estoque, avaliacao, imagem
            FROM produtos
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt-> bindParam(":id", $id);
    $stmt->execute();

    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Produto: {$produto['nome']}<br>
          Marca: {$produto['marca']}<br>
          Categoria: {$produto['categoria']}<br>
          Descrição: {$produto['descricao']}<br>
          Preço: R$ {$produto['preco']}<br>
          Estoque: {$produto['estoque']}<br>
          Avaliação: {$produto['avaliacao']}<br>";
}


function atualizar_produto($conexao, $id, $nome, $marca, $categoria, $descricao, $preco, $estoque, $avaliacao, $file_imagem = null)
{
    $stmt = $conexao->prepare("SELECT imagem FROM produtos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $atual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$atual) {
        echo "Produto não encontrado.";
        return;
    }

    $nome_imagem = $atual['imagem'];   
    $imagem_trocada = false;
    $diretorio_destino = __DIR__ . '/../assets/';

    
    if ($file_imagem && $file_imagem['error'] !== UPLOAD_ERR_NO_FILE) {

        if ($file_imagem['error'] !== UPLOAD_ERR_OK) {
            echo "Erro no envio da imagem.";
            return;
        }

        
        if ($file_imagem['size'] > 2 * 1024 * 1024) {
            echo "A imagem deve ter no máximo 2 MB.";
            return;
        }

       
        $extensao = strtolower(pathinfo($file_imagem['name'], PATHINFO_EXTENSION));
        if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            echo "Formato inválido. Use JPG, PNG ou WEBP.";
            return;
        }

 
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file_imagem['tmp_name']);
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp'], true)) {
            echo "O arquivo enviado não é uma imagem válida.";
            return;
        }

        
        $novo_nome = uniqid('prod_') . '.' . $extensao;

        if (!move_uploaded_file($file_imagem['tmp_name'], $diretorio_destino . $novo_nome)) {
            echo "Erro ao salvar a imagem na pasta assets.";
            return;
        }

        $nome_imagem = $novo_nome;
        $imagem_trocada = true;
    }


    $sql = "UPDATE produtos
            SET nome = :nome, marca = :marca, categoria = :categoria, descricao = :descricao,
                preco = :preco, estoque = :estoque, avaliacao = :avaliacao, imagem = :imagem
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':nome'      => $nome,
        ':marca'     => $marca,
        ':categoria' => $categoria,
        ':descricao' => $descricao,
        ':preco'     => $preco,
        ':estoque'   => $estoque,
        ':avaliacao' => ($avaliacao === '' ? null : $avaliacao),
        ':imagem'    => $nome_imagem,
        ':id'        => $id
    ]);


    if ($imagem_trocada && !empty($atual['imagem']) && $atual['imagem'] !== 'sem-foto.jpg'
        && !str_starts_with($atual['imagem'], 'http')) {
        $caminho_antigo = $diretorio_destino . basename($atual['imagem']);
        if (is_file($caminho_antigo)) {
            unlink($caminho_antigo);
        }
    }

    echo "Produto atualizado com sucesso!";
}

// Funções para sistema de login
function cadastrar_cliente($conexao, $nome, $email, $senha, $telefone)
{
    $sql = "INSERT INTO clientes (nome, email, senha, telefone, perfil) VALUES (:nome, :email, :senha, :telefone, 'cliente')";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha);
    $stmt->bindParam(":telefone", $telefone);

    $stmt->execute();
    echo "Cliente cadastrado com sucesso!";
}

function consulta_cliente($conexao, $email)
{
    $sql = "SELECT id, nome, email, senha, perfil
            FROM clientes
            WHERE email = :email";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    return $cliente;
}

function buscar_produtos_filtrados($conexao, $busca = '', $categoria = '', $ordem = '') {
    $sql = "SELECT * FROM produtos WHERE 1=1";
    $params = [];

    // Filtro por Nome ou Descrição (insensível a maiúsculas/minúsculas)
    if (!empty($busca)) {
        $sql .= " AND (LOWER(nome) LIKE LOWER(:busca) OR LOWER(descricao) LIKE LOWER(:busca))";
        $params[':busca'] = '%' . $busca . '%';
    }

    // Filtro por Categoria
    if (!empty($categoria) && $categoria !== 'todas') {
        $sql .= " AND LOWER(categoria) = LOWER(:categoria)";
        $params[':categoria'] = strtolower($categoria);
    }

    // Ordenação dos resultados
    switch ($ordem) {
        case 'preco_asc':
            $sql .= " ORDER BY preco ASC";
            break;
        case 'preco_desc':
            $sql .= " ORDER BY preco DESC";
            break;
        case 'avaliacao':
            $sql .= " ORDER BY avaliacao DESC";
            break;
        default:
            $sql .= " ORDER BY id DESC";
            break;
    }

    $stmt = $conexao->prepare($sql);
    $stmt->execute($params);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ===== Carrinho =====

function adicionar_ao_carrinho($conexao, $cliente_id, $produto_id)
{
    // Só adiciona se o produto existe e tem estoque
    $stmt = $conexao->prepare("SELECT estoque FROM produtos WHERE id = :p");
    $stmt->execute([':p' => $produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto || $produto['estoque'] < 1) {
        return false;
    }

    // Se já existe no carrinho, soma 1 (sem passar do estoque)
    $sql = "INSERT INTO carrinho (cliente_id, produto_id, quantidade)
            VALUES (:c, :p, 1)
            ON CONFLICT (cliente_id, produto_id)
            DO UPDATE SET quantidade = LEAST(carrinho.quantidade + 1, :estoque)";

    $stmt = $conexao->prepare($sql);
    return $stmt->execute([
        ':c'       => $cliente_id,
        ':p'       => $produto_id,
        ':estoque' => $produto['estoque']
    ]);
}

function listar_carrinho($conexao, $cliente_id)
{
    $sql = "SELECT c.produto_id, c.quantidade, p.nome, p.marca, p.preco, p.imagem, p.estoque
            FROM carrinho c
            JOIN produtos p ON p.id = c.produto_id
            WHERE c.cliente_id = :c
            ORDER BY c.adicionado_em DESC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute([':c' => $cliente_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function remover_do_carrinho($conexao, $cliente_id, $produto_id)
{
    $stmt = $conexao->prepare("DELETE FROM carrinho WHERE cliente_id = :c AND produto_id = :p");
    return $stmt->execute([':c' => $cliente_id, ':p' => $produto_id]);
}

function contar_itens_carrinho($conexao, $cliente_id)
{
    $stmt = $conexao->prepare("SELECT COALESCE(SUM(quantidade), 0) FROM carrinho WHERE cliente_id = :c");
    $stmt->execute([':c' => $cliente_id]);
    return (int) $stmt->fetchColumn();
}