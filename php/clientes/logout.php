<?php 
session_name('zentralhead');
session_start();
session_destroy(); // ao usar destroy, você obriga o usuario a refazer login 
header('location: ../menu_publico/index.php');
exit;

?>