 🛒 **Zentral Head**

## 📖 Sobre o Projeto
O **Zentral Head** é um sistema de **vendas online** desenvolvido em **PHP**, **HTML**, **CSS** e **Bootstrap**, utilizando **MySQL** como banco de dados.  
Seu objetivo é oferecer uma experiência de compra moderna e prática para os clientes, enquanto se integra diretamente com um **sistema desktop de gerenciamento**, responsável pelo controle de estoque, pedidos, usuários e relatórios administrativos.

Essa integração garante que todas as informações — como produtos, pedidos e clientes — sejam sincronizadas entre o ambiente **web** e o **desktop**, proporcionando um ecossistema de vendas unificado, eficiente e seguro.

---

## 🚀 Funcionalidades Principais
- 🛍️ **Catálogo de produtos** com filtros e destaques.  
- 🧺 **Carrinho lateral interativo** (usando Bootstrap e JavaScript).  
- 💳 **Checkout e finalização de compra.**  
- 👤 **Cadastro e login de clientes.**   
- 🔄 **Integração total com o sistema desktop (C# / .NET).**  
- ⚙️ **Painel de administração web** (controle básico de produtos e pedidos).  

---

## 🧱 Tecnologias Utilizadas
| Camada | Tecnologias |
|:-------|:-------------|
| **Frontend** | HTML5, CSS3, Bootstrap 5, JavaScript |
| **Backend** | PHP 8 (Programação Orientada a Objetos) |
| **Banco de Dados** | MySQL |
| **Integração** | Comunicação com sistema desktop em C# (.NET 8) |
| **Servidor Local** | XAMPP / WAMP |

---

## 🗂️ Estrutura de Pastas
```
📦 zentral-head
├── 📁 assets           # Imagens, ícones e recursos visuais
├── 📁 css              # Estilos personalizados
├── 📁 js               # Scripts JavaScript
├── 📁 php
│   ├── 📁 class        # Classes (Produtos, Carrinho, Usuário, etc.)
│   ├── 📁 pages        # Páginas internas do sistema
│   ├── conexao.php     # Conexão com o banco de dados
│   └── index.php       # Página inicial principal
├── 📁 uploads          # Imagens de produtos
├── index.php           # Página inicial pública
└── README.md           # Documentação do projeto
```

---

## ⚙️ Instalação e Configuração

### 🔧 Pré-requisitos
- PHP 8 ou superior  
- MySQL 5.7+  
- Servidor local (XAMPP, WAMP, Laragon etc.)  
- Navegador atualizado  

### 📥 Passos
1. Clone o repositório:
   ```bash
   git clone https://github.com/ErikCarvalho1/zentralhead.git
   ```
2. Copie os arquivos para a pasta `htdocs` (no XAMPP) ou similar.  
3. Importe o arquivo `banco.sql` no **phpMyAdmin**.  
4. Configure a conexão em `php/conexao.php`:
   ```php
   $this->pdo = new PDO("mysql:host=localhost;dbname=zentralhead", "root", "");
   ```
5. Inicie o servidor e acesse:  
   ```
   http://localhost/zentralhead/
   ```

---

## 🔗 Integração com o Sistema Desktop
O **Zentral Head Web** é totalmente integrado ao **Zentral Head Desktop**, desenvolvido em **C# (.NET 8)**.  
A comunicação pode ocorrer de duas formas:
- **Banco de dados compartilhado (MySQL)**, ou  
- **API RESTful** para sincronização em tempo real.

Com isso, as vendas feitas pelo site são automaticamente refletidas no sistema desktop, garantindo controle total de estoque, clientes e relatórios.

---

## 🧑‍💻 Autor
**Erik Carvalho**  
💼 Desenvolvedor Full Stack  
📧 [erikcarvalhosilva2005@gmail.com]  


---

## 📝 Licença
Este projeto é de uso **educacional e livre para modificações**, desde que mantidos os créditos do autor.

---

## 🌟 Futuras Implementações
- 📱 Versão mobile responsiva aprimorada.  
- 📦 Integração com gateways de pagamento (ex: Pix, Cartão).  
- 🔔 Sistema de notificações em tempo real.  
- 📊 Dashboard de vendas e relatórios gráficos.  

---

## 💳 Pagamentos com Mercado Pago (Cartão)

Esta integração adiciona processamento de cartão via API `/v1/payments` do Mercado Pago.

Resumo rápido:
- Frontend gera `token` do cartão com `mercadopago.js` usando `MP_PUBLIC_KEY`.
- Backend usa `MP_ACCESS_TOKEN` para chamar `/v1/payments` enviando `transaction_amount`, `token`, `installments`, `payment_method_id` e `payer.email`.
- É usado `X-Idempotency-Key` para evitar cobranças duplicadas.

Como configurar:
1. Abra `php/config/mercadopago.php` e preencha:
    - `MP_ACCESS_TOKEN` (server token)
    - `MP_PUBLIC_KEY` (publishable key para o frontend)
    - `MP_DEBUG = true` para desenvolvimento/local

Testes locais (mock):
- O backend possui modo mock (somente quando `MP_DEBUG === true`). Para simular um pagamento aprovado:

```bash
curl.exe -i -X POST "http://localhost/ZentralHead/php/clientes/processa_checkout.php?test_cart=1&mock_mp=1&mock_status=approved" \
   -d "forma_pagamento=cartao" \
   -d "total=1.00" \
   -d "token=FAKE_TOKEN" \
   -d "payment_method_id=visa" \
   -d "installments=1" \
   -d "email=cliente@teste.com"
```

`mock_status` pode ser `approved`, `pending` ou `rejected`.

Testes com token real (sandbox):
1. Defina `MP_PUBLIC_KEY` com sua chave de testes.
2. Acesse `/php/clientes/checkout.php`, selecione `Cartão` e preencha os dados de teste (ex.: `4111 1111 1111 1111`, `12/30`, `123`).
3. O formulário será tokenizado no browser e enviado para `processa_checkout.php`.

Logs e depuração:
- Erros das chamadas à API são gravados em `php/config/log_mp_error.txt` quando `MP_DEBUG=true`.

Banco de dados:
- Pagamentos são salvos na tabela `pagamentos` com os campos `pedido_id`, `forma_pagamento`, `valor`, `status`, `codigo_transacao`.

Arquivos alterados/adiicionados:
- `php/config/mercadopago.php` (nova constante `MP_PUBLIC_KEY`)
- `php/clientes/checkout.php` (tokenização + campos cartão)
- `php/clientes/processa_checkout.php` (processamento /v1/payments, mock, validações)
- `php/class/pagamentos.php` (inserir status e codigo_transacao)
- `php/clientes/pedido_sucesso.php` e `php/clientes/pedido_erro.php` (páginas simples)

Se quiser, posso adicionar instruções passo-a-passo para criar chaves sandbox no painel do Mercado Pago.
