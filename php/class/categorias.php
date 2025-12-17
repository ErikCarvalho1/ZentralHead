<?php 
include_once "db.php";

class categorias {
    private $id;
    private $nome;
    private $imagem;
    private $banner;
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

    public function getImagem(){
        return $this->imagem;
    }

    public function setImagem(string $imagem){
        $this->imagem = $imagem;
    }

    public function getBanner(){
        return $this->banner;
    }

    public function setBanner(string $banner){
        $this->banner = $banner;
    }

    // INSERT com banner
    public function insert(){
        $sql = "INSERT INTO categorias (nome, imagem, banner)
                VALUES (:nome, :imagem, :banner)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":imagem", $this->imagem);
        $cmd->bindValue(":banner", $this->banner);
        $cmd->execute();
    }

    // UPDATE com banner
    public function update($id){
        $sql = "UPDATE categorias 
                SET nome = :nome, imagem = :imagem, banner = :banner
                WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":imagem", $this->imagem);
        $cmd->bindValue(":banner", $this->banner);
        $cmd->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM categorias WHERE id = :id";
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

    // ✅ Buscar categoria por ID (com banner)
    public function listarPorId(int $id){
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id, PDO::PARAM_INT);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_ASSOC);
    }
}
?>
