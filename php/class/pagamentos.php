<?php
include_once "db.php";

class pagamentos {

    private $id;
    private $pedido_id;
    private $forma_pagamento;
    private $valor;
    private $status;
    private $codigo_transacao;
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    public function setPedido_id(int $pedido_id) {
        $this->pedido_id = $pedido_id;
    }

    public function setForma_pagamento(string $forma) {
        $this->forma_pagamento = $forma;
    }

    public function setValor(float $valor) {
        $this->valor = $valor;
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setCodigo_transacao(?string $codigo) {
        $this->codigo_transacao = $codigo;
    }

    public function inserir() {
        $sql = "INSERT INTO pagamentos
                (pedido_id, forma_pagamento, valor, status, codigo_transacao)
                VALUES
                (:pedido_id, :forma, :valor, :status, :codigo)";

        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":pedido_id", $this->pedido_id);
        $cmd->bindValue(":forma", $this->forma_pagamento);
        $cmd->bindValue(":valor", $this->valor);
        $cmd->bindValue(":status", $this->status);
        $cmd->bindValue(":codigo", $this->codigo_transacao);
        $cmd->execute();
    }
}
