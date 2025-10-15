<?php 
include_once "db.php";  

class pedidos {

    private $id;
    private $usuario_id;
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
    public function setUsuario_id(int $usuario_id){
        $this->usuario_id = $usuario_id;
    }
    public function getUsuario_id() {
        return $this->usuario_id;
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
        $cmd->bindValue(":usuario_id", $this->usuario_id);
        $cmd->bindValue(":cliente_id", $this->cliente_id);
        $cmd->bindValue(":data", $this->data);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":pedidos", $this->pedidos);
        $cmd->execute();
    }

}




?>