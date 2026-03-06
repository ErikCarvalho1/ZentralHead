<?php
include_once '../class/usuarios.php';

$mensagem = "";
$tipo_mensagem = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = new Usuarios();
    $usuario->setNome(trim($_POST['nome'] ?? ''));
    $usuario->setEmail(trim($_POST['email'] ?? ''));
    $usuario->setSenha(($_POST['senha'] ?? ''));
    $usuario->setAtivo(1);

    if($usuario->Inserir()){
        $mensagem = "<div class='alert alert-success text-center mt-3'><i class='bi bi-check-circle me-2'></i>Cadastro realizado com sucesso! Redirecionando...</div>";
        $tipo_mensagem = "sucesso";
        echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
    } else {
        $mensagem = "<div class='alert alert-danger text-center mt-3'>Erro ao cadastrar usuário. Tente novamente.</div>";
        $tipo_mensagem = "erro";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zentral Cadastro</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  
  <!-- custom cadastro styles -->
  <style>
    body.cadastro-page {
      background: linear-gradient(135deg, #161222ff 0%, #6316c9ff 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cadastro-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      padding: 2rem 1.5rem;
    }

    .cadastro-card .bi {
      color: #7c4dff;
    }

    .cadastro-card .form-control {
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

    .cadastro-note {
      font-size: 0.875rem;
      color: #666;
      margin-top: 0.25rem;
    }
  </style>
</head>

<body class="cadastro-page">

  <main class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">

        <!-- Logo -->
        <div class="text-center mb-4">
          <a href="../../images/LogoZentralPreto.png" target="_blank" class="text-decoration-none">
          
          </a>
        </div>

        <!-- Card -->
        <div class="cadastro-card">
            
            <div class="text-center mb-3">
               <img src="../../images/cadastro.png" alt="Logo Zentral" class="img-fluid mb-3" style="max-width: 300px;">
              
              <p class="cadastro-note">Crie sua conta para acessar a plataforma</p>
            </div>

            <?php if(!empty($mensagem)): ?>
              <?php echo $mensagem; ?>
            <?php endif; ?>

            <form action="cadastro.php" method="POST" id="form_cadastro" enctype="multipart/form-data">
              <!-- Nome -->
              <div class="mb-3">
                <label for="nome" class="form-label fw-medium">Nome</label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0">
                    <i class="bi bi-person text-primary"></i>
                  </span>
                  <input 
                    type="text" 
                    name="nome" 
                    id="nome" 
                    class="form-control border-start-0 shadow-none" 
                    placeholder="Digite seu nome completo" 
                    required 
                    autocomplete="off"
                    value="<?php echo isset($_POST['nome'])?htmlspecialchars($_POST['nome']):''; ?>"
                  >
                </div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label fw-medium">E-mail</label>
                <div class="input-group">
                  <span class="input-group-text bg-transparent border-end-0">
                    <i class="bi bi-envelope text-primary"></i>
                  </span>
                  <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control border-start-0 shadow-none" 
                    placeholder="Digite seu e-mail" 
                    required 
                    autocomplete="off"
                    value="<?php echo isset($_POST['email'])?htmlspecialchars($_POST['email']):''; ?>"
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
                  Cadastrar
                </button>
              </div>
            </form>

            <p class="text-center mt-3"><a class="link" href="login.php">Já tem conta? Faça login! </a></p>
          </div>
        </div>

      </div>
    </div>
  </main>
</body>
</html>