<?php 
if (!function_exists('getConnection')) {
    function getConnection(): PDO {
        static $pdo; 
        if ($pdo === null){ 
            $pdo = new PDO(
                "mysql:host=localhost;dbname=zentralhead",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
        return $pdo;
    }
}
?>
