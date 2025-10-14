<?php 
include_once "db.php";
class catergorias{

 private $id;
 private $nome;
 private $sigla;
 private $pdo;

    public function  __construct(){
        $this->pdo = getConnection();
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setNome (string $nome){
        $this->nome = $nome; 
    }
    public function getSigla(){
        return $this->sigla;

    }
    public function setSigla (string $sigla){
        $this->sigla = $sigla;
    }
    public function insert (){
        $sql = "INSERT INTO categorias (nome, sigla) VALUES (:nome, :sigla)";
        $cmd = $this->pdo-> prepare()
    }
    
}





?>