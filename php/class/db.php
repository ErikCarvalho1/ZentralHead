<?php 
function getConnection(): PDO{ // retorna um objeto PDO
    static $pdo;
    if ($pdo === null){ // = (atribuição) / == (comparação) / === (comparação tipo e valor)
        $pdo = new PDO(
            "mysql:host=sublimegrace.com.br;dbname=well7877_zentralhead",
            "well7877_erik",
            "r(Rvdx9FSBVX",
           [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
           ] 
        );
    }
    return $pdo;
}

?>