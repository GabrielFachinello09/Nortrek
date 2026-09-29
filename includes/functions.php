<?php
require_once __DIR__ . '/../database/connect.php';

function cadastrar_produto($conexao, $nome, $marca, $categoria, $descricao, $preco, $estoque, $avaliacao, $imagem)
{
    $sql = "INSERT INTO produtos (nome, marca, categoria, descricao, preco, estoque, avaliacao, imagem) VALUES (:nome, :marca, :categoria, :descricao, :preco, :estoque, :avaliacao, :imagem)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":marca", $marca);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":estoque", $estoque);
    $stmt->bindParam(":avaliacao", $avaliacao);
    $stmt->bindParam(":imagem", $imagem);

    $stmt->execute();
    echo "Produto Cadastrado com Sucesso!";
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


function atualizar_produto($conexao, $id, $nome, $marca, $categoria, $descricao, $preco, $estoque, $avaliacao, $imagem)
{
    $sql = "UPDATE produtos
            SET nome = :nome, marca = :marca, categoria = :categoria, descricao = :descricao,
                preco = :preco, estoque = :estoque, avaliacao = :avaliacao, imagem = :imagem
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":marca", $marca);
    $stmt->bindParam(":categoria", $categoria);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":estoque", $estoque);
    $stmt->bindParam(":avaliacao", $avaliacao);
    $stmt->bindParam(":imagem", $imagem);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

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