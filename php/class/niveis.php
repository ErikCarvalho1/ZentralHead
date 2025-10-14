<?php 
include_once "db.php";
class niveis {

private $id;
private $nome;
private $sigla;
private $pdo;

public function  __construct(){
    $this->pdo = getConnection();
}
public function getId (): int {
    return $this->id;

}
public function getNome (string $nome){
    $this->nome = $nome;
}
public function setNome (string $nome){
    return $this->nome = $nome; 

}
public function getSigla (string $sigla){
    $this->sigla = $sigla;

}
public function setSigla (string $sigla){
    return $this->sigla = $sigla;
}

public function insert (){
    $sql= "INSERT INTO niveis (nome, sigla) VALUES (:nome, :sigla)";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":nome", $this->nome);
    $cmd->bindValue(":sigla", $this->sigla);
    $cmd->execute();
}

public function listar (){
    $sql = "SELECT * FROM niveis";
    $cmd = $this->pdo->prepare($sql);
    $cmd->execute();
    return $cmd->fetchAll(PDO::FETCH_ASSOC);

}
public function excluir (int $id){
    $sql = "DELETE FROM niveis WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();

}
public function atualizar (int $id){
    $sql = "UPDATE niveis SET nome = :nome, sigla = :sigla WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":nome", $this->nome);
    $cmd->bindValue(":sigla", $this->sigla);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
}
}
?>