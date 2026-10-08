
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$perfil = $_SESSION['perfil'] ?? '';

// Só usa o carrinho se as funções já existirem
$tem_carrinho = false;
if ($perfil === 'cliente') {
    require_once __DIR__ . '/../includes/functions.php';
    $tem_carrinho = function_exists('contar_itens_carrinho') && isset($conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conheça a Nortrek, loja especializada em equipamentos de acampamento, trilhas e aventura.">
    <title>Sobre a Nortrek - Equipamentos de Camping</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/sobre.css">
</head>
<body>

<?php
if ($perfil === 'admin') {
    include __DIR__ . '/../includes/header.php';
} elseif ($perfil === 'cliente') {
    ?>
    <header class="header-publico">
        <nav>
            <a href="../index.php">Início</a>
            <a href="sobre.php" aria-current="page">Sobre</a>
            <?php if ($tem_carrinho): ?>
                <a href="../carrinho/carrinho.php">
                    Carrinho (<?= contar_itens_carrinho($conexao, (int) $_SESSION['id']) ?>)
                </a>
            <?php endif; ?>
            <a href="../login/logout.php">Sair (Logout)</a>
        </nav>
    </header>
    <?php
} else {
    ?>
    <header class="header-publico">
        <nav>
            <a href="../index.php">Início</a>
            <a href="sobre.php" aria-current="page">Sobre</a>
            <a href="../login/login.php">Login / Entrar</a>
            <a href="../login/cadastrar.php">Cadastrar Cliente</a>
        </nav>
    </header>
    <?php
}
?>

    <main class="container sobre">

        <!-- Hero / Banner principal -->
        <section class="sobre-hero revelar" aria-labelledby="titulo-sobre">
            <div class="sobre-hero-conteudo">
                <span class="sobre-eyebrow">Camping · Trilhas · Aventura</span>
                <h1 id="titulo-sobre">Sobre a Nortrek</h1>
                <p>
                    A Nortrek é uma loja especializada em equipamentos de acampamento e aventura.
                    Reunimos em um só lugar o que você precisa para acampar, fazer trilhas e explorar
                    a natureza com alta qualidade e confiança.
                </p>
                <div class="sobre-hero-acoes">
                    <a class="btn btn-primary" href="../index.php">Ver catálogo</a>
                    <a class="btn btn-outline" href="#contato">Fale conosco</a>
                </div>
            </div>
            <div class="sobre-hero-logo-wrapper">
                <img class="sobre-hero-logo" src="../assets/logo-nortrek.png" alt="Logo da Nortrek">
            </div>
        </section>

        <!-- Faixa de Números em Destaque -->
        <ul class="sobre-numeros" aria-label="A Nortrek em números">
            <li class="revelar">
                <strong>9</strong>
                <span>categorias completas de produtos</span>
            </li>
            <li class="revelar">
                <strong>2</strong>
                <span>perfis de acesso: cliente e gerente</span>
            </li>
            <li class="revelar">
                <strong>100%</strong>
                <span>do catálogo reunido em um só lugar</span>
            </li>
        </ul>

        <!-- Quem somos -->
        <section aria-labelledby="titulo-quem-somos">
            <div class="sobre-secao-topo revelar">
                <h2 id="titulo-quem-somos">Quem somos</h2>
                <p>
                    Somos uma loja do segmento outdoor que une o espírito de aventura a uma gestão
                    simples e eficiente do catálogo.
                </p>
            </div>

            <div class="sobre-grid">
                <article class="sobre-card revelar">
                    <span class="sobre-tag-indicador">01</span>
                    <h3>Nossa identidade</h3>
                    <p>
                        Uma loja dedicada a quem gosta de natureza, trilhas e noites sob as estrelas.
                        Nosso catálogo reúne barracas, mochilas, iluminação, utensílios de cozinha,
                        vestuário e muito mais.
                    </p>
                </article>

                <article class="sobre-card revelar">
                    <span class="sobre-tag-indicador">02</span>
                    <h3>Nossa missão</h3>
                    <p>
                        Centralizar o catálogo da loja, tornando a exibição dos produtos mais agradável
                        para o cliente e o controle de estoque mais rápido e eficiente para o lojista.
                    </p>
                </article>

                <article class="sobre-card revelar">
                    <span class="sobre-tag-indicador">03</span>
                    <h3>Como trabalhamos</h3>
                    <p>
                        Utilizamos um sistema web próprio, desenvolvido em PHP com banco de dados
                        PostgreSQL, que mantém as informações dos produtos organizadas, atualizadas
                        e seguras.
                    </p>
                </article>
            </div>
        </section>

        <!-- Categorias -->
        <section aria-labelledby="titulo-categorias">
            <div class="sobre-secao-topo revelar">
                <h2 id="titulo-categorias">O que você encontra aqui</h2>
                <p>
                    Nosso acervo é dividido em categorias para facilitar a busca pelo equipamento ideal
                    para a sua próxima aventura. Clique em uma delas para ver os produtos.
                </p>
            </div>

            <ul class="sobre-categorias">
                <?php
                $categorias = [
                    'barracas' => 'Barracas', 'mochilas' => 'Mochilas', 'iluminacao' => 'Iluminação',
                    'cozinha' => 'Cozinha', 'vestuario' => 'Vestuário', 'acessorios' => 'Acessórios',
                    'equipamentos' => 'Equipamentos', 'camping' => 'Camping', 'trilhas' => 'Trilhas',
                ];
                foreach ($categorias as $valor => $nome): ?>
                    <li class="revelar"><a href="../index.php?categoria=<?= $valor ?>"><?= $nome ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <!-- Como funciona -->
        <section aria-labelledby="titulo-perfis">
            <div class="sobre-secao-topo revelar">
                <h2 id="titulo-perfis">Como funciona</h2>
                <p>
                    A plataforma foi pensada para dois perfis, cada um com as permissões de que precisa.
                </p>
            </div>

            <div class="sobre-grid">
                <article class="sobre-card sobre-card--perfil revelar">
                    <span class="sobre-badge">Cliente</span>
                    <h3>Para clientes</h3>
                    <ul class="sobre-lista-check">
                        <li>Navegar pela vitrine de produtos com foto, preço e avaliação.</li>
                        <li>Buscar por nome e filtrar por categoria.</li>
                        <li>Ordenar por menor preço, maior preço ou melhor avaliação.</li>
                        <li>Criar uma conta de cliente de forma rápida.</li>
                    </ul>
                </article>

                <article class="sobre-card sobre-card--perfil sobre-card--admin revelar">
                    <span class="sobre-badge sobre-badge--admin">Gestão</span>
                    <h3>Para a equipe da loja</h3>
                    <ul class="sobre-lista-check">
                        <li>Acesso autenticado de administrador (gerente).</li>
                        <li>Cadastrar novos produtos com imagem, preço e estoque.</li>
                        <li>Consultar, atualizar e excluir produtos do acervo.</li>
                        <li>Manter o estoque sempre em dia.</li>
                    </ul>
                </article>
            </div>
        </section>

        <!-- Contato -->
        <section class="sobre-contato" id="contato" aria-labelledby="titulo-contato">
            <div class="sobre-secao-topo revelar">
                <h2 id="titulo-contato">Contato</h2>
                <p>
                    Dúvidas sobre um produto, sobre o seu cadastro ou sobre o estoque? Fale com a
                    equipe da Nortrek pelos canais abaixo.
                </p>
            </div>

            <div class="sobre-grid">
                <article class="sobre-card revelar">
                    <span class="sobre-tag-indicador">Canal Direto</span>
                    <h3>Telefone e WhatsApp</h3>
                    <a class="sobre-contato-destaque" href="tel:+551155550123">(11) 5555-0123</a>
                    <p>Ligue ou chame para falar com o atendimento.</p>
                </article>

                <article class="sobre-card revelar">
                    <span class="sobre-tag-indicador">Atendimento Digital</span>
                    <h3>E-mail</h3>
                    <a class="sobre-contato-destaque" href="mailto:contato@nortrek.example">contato@nortrek.example</a>
                    <p>Respondemos em até 1 dia útil.</p>
                </article>

                <article class="sobre-card revelar">
                    <span class="sobre-tag-indicador">Horários</span>
                    <h3>Funcionamento</h3>
                    <div class="sobre-horarios">
                        <p><strong>Segunda a sexta:</strong> 8h às 18h</p>
                        <p><strong>Sábado:</strong> 9h às 13h</p>
                        <p><strong>Domingo e feriados:</strong> fechado</p>
                    </div>
                </article>
            </div>
        </section>

        <!-- Chamada final / CTA -->
        <section class="sobre-cta revelar" aria-labelledby="titulo-cta">
            <div class="sobre-cta-info">
                <h2 id="titulo-cta">Pronto para a próxima aventura?</h2>
                <p>Explore o catálogo e encontre o equipamento certo para o seu roteiro.</p>
            </div>
            <div class="sobre-cta-acoes">
                <a class="btn btn-primary" href="../index.php">Ver catálogo</a>
                <?php if ($perfil === ''): ?>
                    <a class="btn btn-outline" href="../login/cadastrar.php">Criar conta</a>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Script de animação ao descer a página -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observador = new IntersectionObserver((entradas, observer) => {
                entradas.forEach(entrada => {
                    if (entrada.isIntersecting) {
                        entrada.target.classList.add('ativo');
                        observer.unobserve(entrada.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -40px 0px'
            });

            document.querySelectorAll('.revelar').forEach(el => observador.observe(el));
        });
    </script>
</body>
</html>