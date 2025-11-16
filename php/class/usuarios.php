<?php 
include_once "db.php";

class Usuarios{
    private $id;
    private $nivelId;
    private $nome;
    private $email;
    private $senha;
    private $ativo;
    private $pdo;

  public function __construct() {
        $this->pdo = getConnection();
    }
    public function getId(){
        return $this->id;

    }
    public function getNivelId(){
        return $this->nivelId;

    }
    public function setNiveld(int $nivelId){
        $this->nivelId = $nivelId;

    }
    public function getNome(){
        return $this->nome;

    }
    public function setNome(string $nome){
        $this->nome = $nome;

    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function setSenha(string $senha){
        $this->senha = $senha;
    }
    public function getAtivo(){
       return $this->ativo;
    }
    public function setAtivo(bool $ativo){
        $this->ativo = $ativo;
    }

    public function Inserir(){
        // use MD5(:senha) if você quer armazenar MD5 (inseguro). Recomenda-se password_hash.
        $sql = "CALL sp_usuarios_insert (nome, email, senha, nivel_id, ativo) VALUES (:nome, :email, MD5(:senha), :nivel_id, :ativo)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome, PDO::PARAM_STR);
        $cmd->bindValue(":email", $this->email, PDO::PARAM_STR);
        $cmd->bindValue(":senha", $this->senha, PDO::PARAM_STR);
        $cmd->bindValue(":nivel_id", $this->nivelId, PDO::PARAM_INT);
        $cmd->bindValue(":ativo", $this->ativo, PDO::PARAM_INT);

        if($cmd->execute()){
            $this->id = $this->pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function Atualizar(int $idUpdate):bool{
             $id = $idUpdate;
        if(!$this->id) return false;
         // ajustado para incluir :id no CALL (se a procedure espera id como primeiro parâmetro)
         $sql = "CALL sp_usuario_update(:id, :nivel_id, :nome, :email, :ativo)";
         $cmd = $this->pdo->prepare($sql);
         $cmd->bindValue(":id", $this->id, PDO::PARAM_INT);
         $cmd->bindValue(":nivel_id", $this->nivelId, PDO::PARAM_INT);
         $cmd->bindValue(":nome", $this->nome);
         $cmd->bindValue(":email", $this->email);
         $cmd->bindValue(":ativo", $this->ativo);
         $cmd->execute();

         return $cmd ->execute();
    }
   
    public function listar(): array {
        $cmd = $this->pdo->query("select * from usuarios order by id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
public function efetuarLogin(string $loginInformado, string $senhaInformada): array|bool {
    $sql = "SELECT u.*, n.nome AS nome_nivel
            FROM usuarios u
            INNER JOIN niveis n ON n.id = u.nivel_id
            WHERE u.email = :email 
              AND u.senha = MD5(:senha)
              AND u.ativo = 1
            LIMIT 1";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":email", $loginInformado);
    $cmd->bindValue(":senha", $senhaInformada);
    $cmd->execute();

    $dados = $cmd->fetch(PDO::FETCH_ASSOC);
    return $dados ?: false; 
}
}





?>