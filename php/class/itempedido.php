<?php 
include_once "db.php";
class itempedido{
    private $id;
    private $pedido_id;
    private $produto_id;
    private $valor_Unitario;
    private $quantidade;
    private $desconto;
    private $pdo;

    public function __construct(){
        $this->pdo = getConnection();
    }
    public function getId(){
        return $this->id;
    }
    public function setPedidos_id(int $pedido_id){
        $this ->pedido_id = $pedido_id;
    }
    public function getPedidos_id(){
        return $this->pedido_id;
    }
    public function setProduto_id(int $produto_id){
        $this ->produto_id = $produto_id;
    }
    public function getPoduto_id(){
        return $this->produto_id;

    }
    public function seValor_Unitario(float $valor_Unitario){
        $this->valor_Unitario = $valor_Unitario;
    }   
    public function getValor_Unitario(){
        return $this->valor_Unitario;
    }
    
?>
