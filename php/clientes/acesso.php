<?php 
// ======================================================
// AUTENTICAÇÃO E VALIDAÇÃO DE SESSÃO - CENTRALIZADO
// ======================================================

// 1 - Define nome da sessão e inicia
session_name('zentralhead');
session_start();

// 2 - Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    // Usuário não autenticado → redireciona para login
    header('Location: login.php');
    exit;
}

// 3 - Verifica se o nome da sessão corresponde
if (!isset($_SESSION['nome_da_sessao'])) {
    $_SESSION['nome_da_sessao'] = session_name();
} elseif ($_SESSION['nome_da_sessao'] !== session_name()) {
    session_destroy();
    header('Location: login.php');
    exit;    
}

// 4 - Segurança extra: associa IP e agente de navegação
if (!isset($_SESSION['ip_usuario'])) {
    $_SESSION['ip_usuario'] = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
}

// 5 - Se o IP ou navegador mudarem, invalida a sessão
if (
    ($_SESSION['ip_usuario'] !== ($_SERVER['REMOTE_ADDR'] ?? '')) ||
    ($_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? ''))
) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
