<?php
include_once "db.php";

class enderecos {

    private $id;
    private $cliente_id;
    private $pedido_id;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    public function getId() {
        return $this->id;
    }

    public function setCliente_id(int $cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function getCliente_id() {
        return $this->cliente_id;
    }

    public function setPedido_id(?int $pedido_id) {
        $this->pedido_id = $pedido_id;
    }

    public function getPedido_id() {
        return $this->pedido_id;
    }

    public function setRua(string $rua) {
        $this->rua = $rua;
    }

    public function getRua() {
        return $this->rua;
    }

    public function setNumero(string $numero) {
        $this->numero = $numero;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setBairro(string $bairro) {
        $this->bairro = $bairro;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setCidade(string $cidade) {
        $this->cidade = $cidade;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setEstado(string $estado) {
        $this->estado = $estado;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setCep(string $cep) {
        $this->cep = $cep;
    }

    public function getCep() {
        return $this->cep;
    }

    public function inserir() {
        $sql = "INSERT INTO enderecos
                (cliente_id, pedido_id, rua, numero, bairro, cidade, estado, cep)
                VALUES
                (:cliente_id, :pedido_id, :rua, :numero, :bairro, :cidade, :estado, :cep)";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":cliente_id", $this->cliente_id);
        $cmd->bindValue(":pedido_id", $this->pedido_id);
        $cmd->bindValue(":rua", $this->rua);
        $cmd->bindValue(":numero", $this->numero);
        $cmd->bindValue(":bairro", $this->bairro);
        $cmd->bindValue(":cidade", $this->cidade);
        $cmd->bindValue(":estado", $this->estado);
        $cmd->bindValue(":cep", $this->cep);
        $cmd->execute();
    }
}
