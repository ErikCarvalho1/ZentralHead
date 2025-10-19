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
    public function setQuantidade(int $quantidade){
        $this->quantidade = $quantidade;
    }
    public function getQuantidade(){
        return $this->quantidade;
    }
    public function setDesconto(float $desconto){
        $this->desconto = $desconto;
    }
    public function getDesconto(){
        return $this->desconto;
    }
    public function insert (){
        $sql = "CALL sp_itempedido_insert (pedido_id, produto_id, valor_Unitario, quantidade, desconto) VALUES (:pedido_id, :produto_id, :valor_Unitario, :quantidade, :desconto)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":pedido_id", $this->pedido_id);
        $cmd->bindValue(":produto_id", $this->produto_id);
        $cmd->bindValue(":valor_Unitario", $this->valor_Unitario);
        $cmd->bindValue(":quantidade", $this->quantidade);
        $cmd->bindValue(":desconto", $this->desconto);
        $cmd->execute();
    }
    public function listarItempedidos(){
        $sql = "SELECT * FROM itempedido";
        $cmd = $this->pdo->prepare($sql);
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
    public function excluir(int $id){
        $sql = "CALL sp_itempedido_delete WHERE id = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
    public function atualizar($id){
    $sql = "CALL sp_itempedido_update (:pedido_id, :produto_id, :valor_Unitario, :quantidade, :desconto) WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd -> bindValue(":pedido_id", $this->pedido_id);
    $cmd -> bindValue(":produto_id", $this->produto_id);
    $cmd -> bindValue(":valor_Unitario", $this->valor_Unitario);
    $cmd -> bindValue(":quantidade", $this->quantidade);
    $cmd -> bindValue(":desconto", $this->desconto);
    $cmd -> bindValue(":id", $id);
    $cmd->execute();

    }
    public function calcularTotalItempedido(): float {
        $total = ($this->valor_Unitario * $this->quantidade) - $this->desconto;
        return $total;
    }
    public function aplicarDesconto(float $percentual): void {
        $descontoCalculado = ($this->valor_Unitario * $this->quantidade) * ($percentual / 100);
        $this->desconto += $descontoCalculado;
    }
}
?>
