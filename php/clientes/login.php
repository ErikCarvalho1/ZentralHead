<?php     

require_once "../class/usuarios.php";

// $usuarioLogado = false; 
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($login !== "" && $senha !== "") {
        $user = new Usuarios();  
        $usuarioLogado = $user->efetuarLogin($login, $senha);
        
        if ($usuarioLogado) {
          if (session_status() === PHP_SESSION_NONE) {
            session_name("zentralhead");
            session_start();
          }
        $_SESSION['nome_usuario'] = $usuarioLogado['nome'];
        $_SESSION['email_usuario'] = $usuarioLogado['email'];
        $_SESSION['nome_da_sessao'] = session_name();
        
        // Redireciona todos os usuários para a página de clientes
        echo "<script>window.open('index.php','_self')</script>";
        exit;
            
        } else {
          $mensagem = "<div class='alert alert-danger text-center mt-3'>Usuário ou senha inválidos!</div>";
        }
    } 
}   
          ?>
<?php
// login.php
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zentral Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- custom login styles -->
    <style>
      body.login-page {
        background: linear-gradient(135deg, #161222ff 0%, #6316c9ff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .login-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 2rem 1.5rem;
      }

      .login-card .bi {
        color: #7c4dff;
      }

      .login-card .form-control {
        border-radius: 8px;
      }

      .btn-gradient {
        background: linear-gradient(135deg, #6431f1ff 0%, #764faaff 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: opacity 0.25s;
      }

      .btn-gradient:hover {
        opacity: 0.9;
      }

      .login-note {
        font-size: 0.875rem;
        color: #666;
        margin-top: 0.25rem;
      }
    </style>
  </head>

  <body class="login-page">

    <main class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">

          <!-- Logo -->
          <div class="text-center mb-4">
            <a href="../../images/LogoZentralPreto.png" target="_blank" class="text-decoration-none">
            
            </a>

          </div>

          <!-- Card -->
          <div class="login-card">
              
              <div class="text-center mb-3">
                 <img src="../../images/login.png" alt="Logo Zentral" class="img-fluid mb-3" style="max-width: 130px;">
                
                <p class="login-note">Você será direcionado para a página inicial</p>
              </div>

              <form action="login.php" method="POST" id="form_email" enctype="multipart/form-data">
                <!-- Login -->
                <div class="mb-3">
                  <label for="email" class="form-label fw-medium">Login</label>
                  <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">
                      <i class="bi bi-envelope text-primary"></i>
                    </span>
                    <input 
                      type="text" 
                      name="email" 
                      id="email" 
                      class="form-control border-start-0 shadow-none" 
                      placeholder="Digite seu login" 
                      required 
                      autocomplete="off"
                      autofocus
                    >
                  </div>
                </div>

                <!-- Senha -->
                <div class="mb-3">
                  <label for="senha" class="form-label fw-medium">Senha</label>
                  <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0">
                      <i class="bi bi-lock text-primary"></i>
                    </span>
                    <input 
                      type="password" 
                      name="senha" 
                      id="senha" 
                      class="form-control border-start-0 shadow-none" 
                      placeholder="Digite sua senha" 
                      required 
                      autocomplete="off"
                    >
                  </div>
                </div>

                <!-- Botão -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-gradient">
                    Submit
                  </button>
                </div>
              </form>

              <p><a class="link" href="cadastro.php">Crie sua conta! </a></p>
            </div>
          </div>

        </div>
      </div>
    </main>
  </body>
</html>
