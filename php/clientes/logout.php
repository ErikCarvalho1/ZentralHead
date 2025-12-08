<?php 
session_name('zentralhead');
session_start();
header('location: ../menu_publico/index.php');
session_unset();
session_destroy(); // ao usar destroy, você obriga o usuario a refazer login 

$userId = $_SESSION['usuario_id'] ?? '';


?>
<script>localStorage.clear();</script>
<script>
    localStorage.removeItem("carrinho_<?php echo $userId; ?>");
</script>
<?php
header("Location: login.php");
exit;
