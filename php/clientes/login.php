<?php 
require_once "../class/usuarios.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    $user = new Usuarios();  
    $usuarioLogado = $user->efetuarLogin($email, $senha);

    if ($usuarioLogado) {
        if (session_status() === PHP_SESSION_NONE) {
            session_name("zentralhead");
            session_start();
        }

        // Guarda dados principais do usuário logado
        $_SESSION['id_usuario']    = $usuarioLogado['id'];
        $_SESSION['nome_usuario']  = $usuarioLogado['nome'];
        $_SESSION['email_usuario'] = $usuarioLogado['email'];
        $_SESSION['nivel_usuario'] = $usuarioLogado['nivel_id'];
        $_SESSION['nome_da_sessao'] = session_name();

        // Redirecionamento conforme o nível de acesso
        switch ($usuarioLogado['nivel_id']) {
            case 1: // Administrador
                echo "<script>window.location.href='../admn/index.php';</script>";
                break;
            case 2: // Cliente
                echo "<script>window.location.href='reserva_mesa.php';</script>";
                break;
            default:
                echo "<script>alert('Nível de acesso desconhecido.');</script>";
        }
    } else {
        echo "<script>alert('E-mail ou senha inválidos ou usuário inativo.');</script>";
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
    <!-- Bootstrap 5.3 local  - totalmente moderno e atualizado! -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <!-- CSS local (Nosso) -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- Bootstrap JS com parametro defer, que permite a execução js após o carregamento DOM -->
    <script src="../../js/bootstrap.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
    <title>Chuleta Quente</title>
  </head>

<body>
    <main class="container my-5">
  <section>
    <article>
      <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
          <h1 class="text-info text-center mb-4">Faça seu login</h1>

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