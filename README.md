# 🏕️ Nortrek - Sistema de Gestão para Loja de Camping

O **Nortrek** é uma aplicação web desenvolvida em PHP com foco no gerenciamento de estoque e catálogo de uma loja especializada em equipamentos de acampamento e aventura. O sistema foi criado com o objetivo de facilitar e padronizar o processo de cadastro e controle dos itens disponíveis (como barracas, mochilas, iluminação e vestuário), oferecendo uma interface com identidade visual temática (outdoor/rústica), organizada e eficiente para os administradores.

A plataforma permite realizar operações essenciais de gerenciamento, como cadastro, consulta, edição e exclusão de registros, utilizando o conceito de CRUD integrado a um banco de dados **PostgreSQL**. Dessa forma, o sistema auxilia no controle das informações dos produtos e validação de usuários, tornando a operação mais prática e segura.

---

## 🚀 Como Executar o Projeto Localmente

Para rodar este projeto na sua máquina, será necessário ter instalado um ambiente de servidor local (PHP) e o banco de dados PostgreSQL.

### Pré-Requisitos
* PHP (v7.4 ou superior) habilitado com a extensão `pdo_pgsql`.
* PostgreSQL instalado e a rodar na porta 5432 (padrão).
* Git instalado na máquina.

### Passo 1: Clonar o Repositório
Abra o terminal e execute:
```bash
# Clone este repositório
git clone [https://github.com/GabrielFachinello09/nortrek.git](https://github.com/GabrielFachinello09/nortrek.git)

# Acesse a pasta do projeto
cd nortrek
```

### Passo 3: Configurar a Conexão no PHP
Na pasta includes (ou raiz do projeto), abra o ficheiro functions.php (ou connect.php).

Altere as credenciais para corresponderem às do seu ambiente local PostgreSQL:

```php
$host = 'Seu ip do servidor';
$port = '5432';
$dbname = 'nortrek';
$user = 'nortrek'; // O seu usuário do PostgreSQL
$password = 'sua_senha_aqui'; // A sua senha do usuário nortrek
```

Passo 4: Acessar a Aplicação
Com o banco de dados configurado, inicie o servidor embutido do PHP. Certifique-se de que o seu terminal está na raiz do projeto e execute:

```bash
php -S localhost:8000
```
O servidor estará ativo! Agora, basta abrir o seu navegador de preferência e acessar:
http://localhost:8000 (isso, caso você esteja na pasta nortrek)

## 📋 Especificação de Requisitos de Software (SRS)
Estrutura Baseada na ISO/IEC/IEEE 29148:2018

### 1. Introdução
---
#### 1.1 Escopo do Sistema

Este documento define os requisitos para a aplicação Nortrek, que tem como escopo o gerenciamento de um catálogo de loja de camping por meio de uma aplicação web. A plataforma será responsável pelo controle dos equipamentos disponíveis no acervo (barracas, mochilas, utensílios de cozinha, vestuário, etc.), permitindo operações completas de manutenção do catálogo.
A aplicação será desenvolvida utilizando PHP para o back-end e PostgreSQL para o armazenamento e persistência dos dados, oferecendo uma estrutura segura para diferenciar o acesso entre clientes comuns e a gestão administrativa da loja.

#### 1.2 Propósito
O projeto Nortrek tem como propósito desenvolver uma aplicação web capaz de centralizar o catálogo de uma loja do segmento outdoor, tornando a exibição para o cliente mais agradável e o controle de estoque pelo lojista mais rápido e eficiente. Além disso, o sistema busca aplicar na prática conceitos de desenvolvimento web, integração com banco de dados PostgreSQL e segurança no controle de acessos (CRUD).

### 2. Descrição Global

#### 2.1 Funções do Sistema
O sistema deve realizar as seguintes funções principais:

- Verificar e autenticar o acesso de administradores.

- Verificar e validar o cadastro de clientes.

- Cadastrar novos produtos/equipamentos de camping.

- Consultar todos os produtos disponíveis (com filtros de categorias).

- Fazer update (atualização) nas informações de um produto.

- Excluir um produto do banco de dados.


#### 2.2 Características dos Usuários
---
| Usuário | Descrição |
|---|---|
| **Administrador (Gerente)** | Usuário que possui total acesso ao sistema. Pode realizar todas as operações do CRUD (cadastro, consulta, atualização e exclusão) dos produtos, garantindo a gestão do estoque. Precisa estar autenticado. |
| **Cliente** | Usuário focado na visualização do sistema. Possui permissão apenas para consultar os produtos disponíveis na vitrine e navegar pelas categorias. |


### 3. Requisitos do Sistema

#### 3.1 Requisitos Funcionais

##### Módulo de Acesso e Segurança

| ID | Título | Descrição | Prioridade |
|---|---|---|---|
| **RF01** | Verificar Administrador | O sistema deve validar as credenciais de login para identificar se o usuário é um Administrador, liberando o acesso às ferramentas de gestão (Update, Exclusão, Cadastro). | Alta |
| **RF02** | Verificar Cliente | O sistema deve possuir um mecanismo para cadastrar e validar o acesso/identificação de clientes, garantindo que operem apenas com permissões de visualização. | Média |

##### Módulo de Gestão de Produtos (Acervo)

| ID | Título | Descrição | Prioridade |
|---|---|---|---|
| **RF03** | Cadastrar Produto | O sistema deve fornecer um formulário para inserir novos itens de camping no banco de dados (inserindo nome, categoria, preço, estoque, avaliação e imagem). | Alta |
| **RF04** | Consultar Produto | O sistema deve listar todos os produtos cadastrados na vitrine principal, permitindo a leitura das informações e o uso de filtros dinâmicos por categoria via menu suspenso. | Alta |
| **RF05** | Fazer Update no Produto | O sistema deve possuir uma interface que permita ao administrador alterar e atualizar os dados (como preço e estoque) de um produto já cadastrado. | Alta |
| **RF06** | Excluir Produto | O sistema deve permitir que o administrador remova definitivamente um produto do banco de dados PostgreSQL. | Alta |


#### 3.2 Requisitos Não Funcionais (RNFs)

#### Módulo 1: Ambiente e Arquitetura

| ID | Título | Descrição | Prioridade |
|---|---|---|---|
| **RNF01** | Tecnologias Base | O back-end do sistema deve ser desenvolvido estritamente na linguagem PHP e utilizar o SGBD PostgreSQL para armazenamento persistente dos dados. | Alta |
| **RNF02** | Padrão de Arquitetura | O sistema deve organizar a camada de dados e a lógica da aplicação separando conexões e regras de negócio, aplicando a estrutura CRUD (Create, Read, Update, Delete) para as operações do banco. | Alta |
| **RNF03** | Compatibilidade Web | A aplicação deve ser executada e acessível em navegadores web modernos (Google Chrome, Mozilla Firefox, Microsoft Edge) sem requerer a instalação de plugins ou softwares adicionais nas estações de trabalho. | Alta |

#### Módulo 2: Segurança e Integridade

| ID | Título | Descrição | Prioridade |
|---|---|---|---|
| **RNF04** | Proteção contra SQL Injection | A comunicação entre o PHP e o PostgreSQL deve utilizar exclusivamente a extensão PDO (PHP Data Objects) com Prepared Statements e vinculação segura de parâmetros. | Alta |
| **RNF05** | Gestão de Sessões e Autenticação | O controle de acesso e a diferenciação de permissões por perfil devem ser gerenciados através do uso seguro de sessões nativas do PHP (`$_SESSION`), com destruição e invalidação correta no logout. | Alta |
| **RNF06** | Processamento Seguro de Uploads | O envio de capas de produtos deve restringir extensões para formatos de imagem permitidos (JPG, PNG, WEBP), limitar o tamanho máximo em 2 MB e gerar um hash único para renomear o arquivo antes de salvá-lo no servidor. | Alta |
| **RNF07** | Proteção de Servidor e Validação de Rotas | O sistema deve validar no lado do servidor (back-end) o perfil do usuário ativo antes de processar qualquer requisição para URLs ou endpoints restritos (como ações de exclusão). | Alta |

#### Módulo 3: Interface e Usabilidade

| ID | Título | Descrição | Prioridade |
|---|---|---|---|
| **RNF08** | Design System Global | A interface visual do sistema deve adotar a padronização baseada no tema de natureza, utilizando variáveis CSS nativas para o controle de paleta de cores tonais e padronização dos componentes. | Alta |
| **RNF09** | Interface Intuitiva | A interface gráfica (HTML/CSS) deve ser simples e padronizada, permitindo que a operação de tarefas frequentes (cadastros, consultas) seja executada com um fluxo mínimo de cliques. | Média |
| **RNF10** | Responsividade de Tela | As telas do sistema devem adaptar seus componentes de forma legível a diferentes resoluções (como monitores de balcão de atendimento e tablets utilizados na checagem de acervo). | Média |
| **RNF11** | Feedback ao Usuário | O sistema deve exibir mensagens de confirmação, alerta ou erro claras e visíveis imediatamente após a execução de qualquer ação (ex: "Produto excluído com sucesso", "Acesso negado" ou "Cliente inativo"). | Média |

#### Módulo 4: Desempenho e Confiabilidade

| ID | Título | Descrição | Prioridade |
|---|---|---|---|
| **RNF12** | Tempo de Resposta | O carregamento de consultas no acervo e a abertura de telas de listagem devem ser concluídos em um tempo limite de até 2 segundos sob condições normais de rede local. | Média |











