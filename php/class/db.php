<?php 
function getConnection(): PDO{//ddd
    static $pdo; 
    if ($pdo === null){ 
        // $pdo = new  PDO("mysql:host=10.91.47.99;dbname=zentralhead",
        // "root",
        // "123",
         $pdo = new  PDO("mysql:host=localhost;dbname=zentralhead",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    }
    return $pdo;
}



?>