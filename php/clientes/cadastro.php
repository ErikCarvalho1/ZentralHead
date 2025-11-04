<?php
include_once '../class/usuarios.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = new Usuarios();
    $usuario->setNiveld(11); // nível padrão para clientes
    $usuario->setNome(trim($_POST['nome'] ?? ''));
    $usuario->setEmail(trim($_POST['email'] ?? ''));
    $usuario->setSenha(($_POST['senha'] ?? ''));
    $usuario->setAtivo(1);

    if($usuario->Inserir()){
        header('Location: index.php');
        exit;
    } else {
        $error = 'Erro ao cadastrar usuário. Tente novamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../css/style.css" />
  <script src="../../js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="bg-light">
  <div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card p-4" style="width: 420px;">
      <div class="text-center mb-3">
        <img src="../../images/LogoZentralPreto.png" width="200" alt="Logo">
      </div>

      <?php if(!empty($error)): ?>
        <div class="alert alert-danger"><?php echo htmlentities($error); ?></div>
      <?php endif; ?>

      <form method="post" action="" novalidate>
        <div class="mb-3">
          <label for="nome" class="form-label">Nome</label>
          <input type="text" name="nome" id="nome" class="form-control" required value="<?php echo isset($_POST['nome'])?htmlspecialchars($_POST['nome']):''; ?>">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" name="email" id="email" class="form-control" required value="<?php echo isset($_POST['email'])?htmlspecialchars($_POST['email']):''; ?>">
        </div>

        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" name="senha" id="senha" class="form-control" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-danger">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>