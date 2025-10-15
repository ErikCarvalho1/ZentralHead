# ZentralHead


Projeto **King Of Kings** – uma aplicação web desenvolvida para gerenciar produtos, cardápio e atendimento de uma churrascaria/steakhouse online.  
O objetivo é oferecer uma experiência simples, rápida e responsiva para clientes e administradores.

---

## Tecnologias Utilizadas

- **Frontend:** HTML5, CSS3, JavaScript  
- **Backend:** Node.js / PHP   
- **Banco de Dados:** MySQL
- **Estilização:** Bootstrap / CSS puro  
- **Controle de Versão:** Git & GitHub  

---

## Estrutura do Projeto
### king-of-kings/

/
├── css/
│   └── style.css
│   └── bootstrap.min.css
├── js/
│   └── script.js
│   └── bootstrap.bundle.min.js
├── img/
│   └── (imagens do projeto)
├── includes/ oupartials/
│   └── header.php
│   └── footer.php
│   └── conexao.php
├── sql/
│   └── banco_de_dados.sql
├── index.php
└── README.md


# 🛒 Sistema de Vendas

Um sistema web completo para gerenciamento de produtos, clientes e vendas, desenvolvido com foco em uma experiência de usuário clara e funcional em ambientes desktop.

## 📝 Índice

- [Sobre o Projeto](#-sobre-o-projeto)
- [✨ Funcionalidades](#-funcionalidades)
- [🖼️ Screenshots](#️-screenshots)
- [🛠️ Tecnologias Utilizadas](#️-tecnologias-utilizadas)
- [⚙️ Pré-requisitos e Instalação](#️-pré-requisitos-e-instalação)
  - [Pré-requisitos](#pré-requisitos)
  - [Instalação Local](#instalação-local)
- [🚀 Como Usar](#-como-usar)
- [📂 Estrutura de Pastas](#-estrutura-de-pastas)
- [👨‍💻 Autor](#-autor)
- [📄 Licença](#-licença)

## 📖 Sobre o Projeto

Este projeto foi criado como uma solução para o controle de vendas em pequenos e médios estabelecimentos. A aplicação permite o cadastro de produtos, gerenciamento de estoque, registro de clientes e a efetivação de vendas de forma simples e intuitiva. A interface foi desenvolvida com a abordagem **Desktop-First**, garantindo uma experiência robusta e completa para usuários em computadores.

---

## ✨ Funcionalidades

-   [x] **Login de Usuário:** Sistema de autenticação para acesso seguro.
-   [x] **Dashboard:** Painel inicial com resumo de vendas e estatísticas.
-   [x] **Gerenciamento de Produtos:**
    -   [x] Cadastro, Edição, Visualização e Exclusão de produtos (CRUD).
    -   [x] Controle de estoque.
-   [x] **Gerenciamento de Clientes:**
    -   [x] CRUD de clientes.
-   [x] **Registro de Vendas:**
    -   [x] Interface para realizar novas vendas, associando produtos e clientes.
    -   [x] Histórico de vendas.
-   [ ] **Relatórios:** Geração de relatórios de vendas por período.

---

## 🖼️ Screenshots

*(Adicione aqui screenshots da sua aplicação para demonstrar as principais telas)*

| Login | Dashboard | Cadastro de Produtos |
| :----------------------------------------------------------: | :------------------------------------------------------: | :------------------------------------------------------------: |
| <img src="caminho/para/screenshot_login.png" width="250"> | <img src="caminho/para/screenshot_dashboard.png" width="250"> | <img src="caminho/para/screenshot_produtos.png" width="250"> |

---

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído com as seguintes tecnologias:

-   **Frontend:**
    -   HTML5
    -   CSS3
    -   Bootstrap 5
-   **Backend:**
    -   PHP 8+
-   **Banco de Dados:**
    -   MySQL
-   **Servidor Web (Ambiente Local):**
    -   XAMPP / WAMP / LAMP

---

## ⚙️ Pré-requisitos e Instalação

Siga os passos abaixo para configurar e executar o projeto em seu ambiente local.

### Pré-requisitos

-   **Git:** Para clonar o repositório.
-   **Servidor Web Local:** Um ambiente como [XAMPP](https://www.apachefriends.org/pt_br/index.html) ou [WAMP](https://www.wampserver.com/en/) que inclua Apache, PHP e MySQL.

### Instalação Local

1.  **Clone o repositório:**
    ```bash
    git clone [URL_DO_SEU_REPOSITORIO_AQUI]
    cd nome-da-pasta-do-projeto
    ```

2.  **Mova os arquivos para a pasta do servidor:**
    -   Copie todos os arquivos do projeto para a pasta `htdocs` (no XAMPP) ou `www` (no WAMP).

3.  **Configure o Banco de Dados:**
    -   Inicie os serviços Apache e MySQL no seu painel de controle (ex: XAMPP Control Panel).
    -   Acesse `http://localhost/phpmyadmin/`.
    -   Crie um novo banco de dados. Ex: `sistema_vendas_db`.
    -   Importe o arquivo `.sql` do projeto (geralmente localizado em uma pasta `/database` ou `/sql`) para criar as tabelas e estruturas necessárias.

4.  **Configure a Conexão:**
    -   Encontre o arquivo de configuração de conexão com o banco de dados (ex: `config/conexao.php` ou `db_connect.php`).
    -   Abra este arquivo e altere as credenciais do banco de dados para corresponder à sua configuração local:
    ```php
    <?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root'); // Usuário padrão do XAMPP
    define('DB_PASS', '');     // Senha padrão do XAMPP é vazia
    define('DB_NAME', 'sistema_vendas_db'); // Nome do banco que você criou
    ```

---

## 🚀 Como Usar

1.  Certifique-se de que os serviços Apache e MySQL estão em execução.
2.  Abra seu navegador e acesse a URL correspondente ao projeto.
    -   Exemplo: `http://localhost/nome-da-pasta-do-projeto`
3.  Utilize as credenciais de acesso padrão (se houver) ou crie um novo usuário.

---

## 📂 Estrutura de Pastas

A estrutura de arquivos do projeto está organizada da seguinte forma:
