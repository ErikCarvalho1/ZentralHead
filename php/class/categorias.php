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
        $sql = "call sp_categoria_insert (nome, sigla) VALUES (:nome, :sigla)";
        $cmd = $this->pdo-> prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":sigla", $this->sigla);
        $cmd->execute();

    }
    public function update($id){
        $sql = "CALL sp_categoria_upadate SET nome = :nome, sigla = :sigla WHERE id = :id";
        $cmd = $this->pdo-> prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":sigla", $this->sigla);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
    public function delete($id){
        $sql = " CALL sp_categoria_delelete WHERE id = :id";
        $cmd = $this->pdo-> prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
    public function listar (){
        $sql = "SELECT * FROM categorias";
        $cmd = $this->pdo-> prepare($sql);
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>