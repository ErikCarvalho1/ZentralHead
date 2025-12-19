<?php 
include_once "db.php";  

class Pedidos {

    private $id;
    private $cliente_id;
    private $data;
    private $status;
    private $pedidos;
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }
    public function getId(){
        return $this->id;
    }

 
    public function setCliente_id(int $cliente_id){
        $this->cliente_id = $cliente_id;
    }
    public function getCliente_id() {
        return $this-> cliente_id;
    }
    public function setData(string $data){
        $this->data = $data;
    }
    public function getData(){
        return $this->data;
    }
    public function setStatus(string $status){
        $this->status = $status;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setPedidos(string $pedidos){
        $this->pedidos = $pedidos;
    }
    public function getPedidos(){
        return $this->pedidos;
    }
    public function Inserir(){
        $sql = "CALL sp_pedido_insert(:usuario_id, :cliente_id, :data, :status, :pedidos)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":cliente_id", $this->cliente_id);
        $cmd->bindValue(":data", $this->data);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":pedidos", $this->pedidos);
        $cmd->execute();
    }
    public function listarPedidos(){
        $sql = "SELECT * FROM pedidos";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
    public function excluir(int $id){
    $sql = "DELETE FROM pedidos WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    }
    public function atualizar(int $id){
    $sql = "CALL sp_pedido_update(:usuario_id, :cliente_id, :data, :status, :pedidos) WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":cliente_id", $this->cliente_id);
    $cmd->bindValue(":data", $this->data);
    $cmd->bindValue(":status", $this->status);
    $cmd->bindValue(":pedidos", $this->pedidos);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
}
public function criarPedido() {

    $sql = "INSERT INTO pedidos (cliente_id, status)
            VALUES (:cliente_id, :status)";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":cliente_id", $this->cliente_id);
    $cmd->bindValue(":status", $this->status);
    $cmd->execute();

    return $this->pdo->lastInsertId();
}


// Atualiza o status do pedido
public function atualizarStatus(int $id) {

    $sql = "UPDATE pedidos
            SET status = :status
            WHERE id = :id";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":status", $this->status);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
}
}

?>