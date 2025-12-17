<?php 
include_once "db.php";

class categorias {
    private $id;
    private $nome;
    private $imagem;
    private $pdo;

    public function __construct(){
        $this->pdo = getConnection();
    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome(string $nome){
        $this->nome = $nome; 
    }

    public function getSigla(){
        return $this->imagem;
    }

    public function setSigla(string $imagem){
        $this->imagem = $imagem;
    }

    public function insert(){
        $sql = "CALL sp_categoria_insert(:nome, :imagem)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":imagem", $this->imagem);
        $cmd->execute();
    }

    public function update($id){
        $sql = "CALL sp_categoria_update(:id, :nome, :imagem)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":imagem", $this->imagem);
        $cmd->execute();
    }

    public function delete($id){
        $sql = "CALL sp_categoria_delete(:id)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    public function listar(){
        $sql = "SELECT * FROM categorias";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Nova função para pegar categoria pelo ID
public function listarPorId(int $id) {
    $sql = "SELECT * FROM categorias WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":id", $id, PDO::PARAM_INT);
    $cmd->execute();
    return $cmd->fetch(PDO::FETCH_ASSOC); // retorna apenas uma categoria
}

}
?>
