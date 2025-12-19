<?php
include_once "db.php";

class Itempedido {

    private $id;
    private $pedido_id;
    private $produto_id;
    private $quantidade;
    private $preco;
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    public function getId() {
        return $this->id;
    }

    public function setPedido_id(int $pedido_id) {
        $this->pedido_id = $pedido_id;
    }

    public function getPedido_id() {
        return $this->pedido_id;
    }

    public function setProduto_id(int $produto_id) {
        $this->produto_id = $produto_id;
    }

    public function getProduto_id() {
        return $this->produto_id;
    }

    public function setQuantidade(int $quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setPreco(float $preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function inserir() {
        $sql = "INSERT INTO itens_pedido
                (pedido_id, produto_id, quantidade, preco)
                VALUES (:pedido_id, :produto_id, :quantidade, :preco)";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":pedido_id", $this->pedido_id);
        $cmd->bindValue(":produto_id", $this->produto_id);
        $cmd->bindValue(":quantidade", $this->quantidade);
        $cmd->bindValue(":preco", $this->preco);
        $cmd->execute();
    }
}
