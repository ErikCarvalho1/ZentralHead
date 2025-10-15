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
    public function getCliente_id(){
        return $this = $cliente_id;
    }
    public function setData(string $data){
        $this->data = $data;
    }
}




?>