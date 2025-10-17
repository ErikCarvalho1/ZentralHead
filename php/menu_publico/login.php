<?php 
require_once "../class/usuarios.php";
$usuarioLogado = false; 
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($login !== "" && $senha !== "") {
        $user = new Usuarios();  
        $usuarioLogado = $user->efetuarLogin($login, $senha);
    }

    if ($usuarioLogado) {
        if (session_status() === PHP_SESSION_NONE) {
            session_name("zentralhead");
            session_start();
        }

        $_SESSION['email_usuario'] = $usuarioLogado['email'];
        $_SESSION['nivel_usuario'] = $usuarioLogado['nome_nivel']; 
        $_SESSION['nome_da_sessao'] = session_name();

        
        switch (strtolower($usuarioLogado['nome_nivel'])) {
            case ' administrador':
            case 'admin':
                echo "<script>window.open('../adm/index.php','_self')</script>";
                exit;

            case 'cliente':
            case 'cli':
                echo "<script>window.open('../clientes/index.php','_self')</script>";
                exit;

            default:
                echo "<script>alert('Nível de acesso desconhecido!'); window.location.href='../index.php';</script>";
                exit;
        }
    } else {
        $mensagem = "<div class='alert alert-danger text-center mt-3'>Usuário ou senha inválidos!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="30;url=../index.php">
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5.3 local  - totalmente moderno e atualizado! -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- CSS local (Nosso) -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- Bootstrap JS com parametro defer, que permite a execução js após o carregamento DOM -->
    <script src="../js/bootstrap.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
    <title>zentral login</title>
  </head>

<body>
    <main class="container my-5">
  <section>
    <article>
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <h1 class="text-info text-center mb-4">
        <a href="../../images/LogoZentralPreto.png" target="_blank">
         <img src="../../images/LogoZentralPreto.png" alt="Logo Zentral" />
        </a>
        </h1>


          <div class="card shadow-lg">
            <div class="card-body">
              <p class="text-info text-center mb-4" role="alert">
                <i class="bi bi-people-fill display-1"></i>
              </p>

              <div class="alert alert-info" role="alert">
                <form action="login.php" name="form_email" id="form_email" method="POST" enctype="multipart/form-data">
                  
                  <!-- Login -->
                  <div class="mb-3">
                    <label for="email" class="form-label">Login:</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-person-fill text-info"></i>
                      </span>
                      <input type="text" name="email" id="email" 
                             class="form-control" 
                             placeholder="Digite seu login" 
                             autofocus required autocomplete="off">
                    </div>
                  </div>

                  <!-- Senha -->
                  <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <i class="bi bi-lock-fill text-info"></i>
                      </span>
                      <input type="password" name="senha" id="senha" 
                             class="form-control" 
                             placeholder="Digite sua senha" 
                             required autocomplete="off">
                    </div>
                  </div>

                  <!-- Botão -->
                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                  </div>
                </form>
              </div>

              <p class="text-center mt-3">
                <small>
                  Caso não faça uma escolha em 30 segundos será redirecionado automaticamente para página inicial.
                </small>
              </p>
            </div>
          </div>
        </div>
      </div>
    </article>
  </section>
</main>
</body>
</html>