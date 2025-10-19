<?php 
include_once "db.php";

class Cliente{
    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $senha;
    private $dataNasc;
    private $dataCad;
    private $ativo;
    private $pdo;

  public function __construct() {
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
    public function getCpf(){
        return $this->cpf;

    }
   
    public function setCpf(string $cpf){
        $this->cpf = $cpf;

    } 
    public function getTelefone(){
        return $this->telefone;

    }
    public function setTelefone(int $telefone){
        $this->telefone = $telefone;

    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail(string $email){
        $this->email = $email;
    }
    public function getDataNasc(){
        return $this->dataNasc;

    }
    public function setDataNasc(string $dataNasc){
        $this->dataNasc = $dataNasc;

    }
    public function getDataCad(){
        return $this->dataCad;

    }
    public function setDataCad(int $DataCad){
        $this->dataCad = $DataCad;

    }
    public function getAtivo(){
       return $this->ativo;
    }
    public function setAtivo(bool $ativo){
        $this->ativo = $ativo;
    }


    public function Inserir(){
        $sql = "CALL sp_cliente_insert(:nome, :cpf, :telefone, :email, :senha, :data_nasc :ativo)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":nome", $this->nome);
        $cmd->bindValue(":cpf", $this->nome);
        $cmd->bindValue(":telefone", $this->nome);
        $cmd->bindValue(":email", $this->email);
        $cmd->bindValue(":senha", $this->senha);
        $cmd->bindValue(":data_nasc", $this->dataNasc);
        $cmd->bindValue(":ativo", $this->ativo);
        $cmd->execute();
        if($cmd->execute()){
            $this->id = $this->pdo->lastInsertId();
            return true; 

        }
        return false;
    }

    public function Atualizar(int $idUpdate):bool{
             $id = $idUpdate;
        if(!$this->id) return false;
         $sql = "CALL sp_cliente_update(:nome,  :telefone, :email, :ativo)";
         $cmd = $this->pdo->prepare($sql);
         $cmd->bindValue(":nome", $this->nome);
         $cmd->bindValue(":telefone", $this->telefone);
         $cmd->bindValue(":email", $this->email);
         $cmd->bindValue(":ativo", $this->ativo);
         $cmd->bindValue(":id", $this ->id, PDO:: PARAM_INT);
 
        return $cmd ->execute();
    }
   
    public function listar(): array {
        $cmd = $this->pdo->query("select * from clientes order by id DESC");
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

       public function efetuarLogin(string $loginInformado, string $senhaInformada):array {
        $sql = "select * from clientes where email = :email and senha = md5(:senha)";
        $cmd =  $this->pdo->prepare($sql);
        $cmd-> bindValue(":email", $loginInformado);
        $cmd-> bindValue(":senha", $senhaInformada);
        $cmd->execute();
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            return $dados;
         
 
    }
}





?>