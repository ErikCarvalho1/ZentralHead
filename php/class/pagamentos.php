<?php
require_once "db.php";

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

/**
 * Inserir novo pagamento.
 *
 * @param int $pedido_id
 * @param string $forma_pagamento
 * @param float $valor
 * @param string $status (opcional) default 'pendente'
 * @param string|null $codigo_transacao (opcional)
 * @return int|null ID do pagamento inserido
 */
public function inserir($pedido_id, $forma_pagamento, $valor, $status = 'pendente', $codigo_transacao = null) {

    $sql = "INSERT INTO pagamentos 
            (pedido_id, forma_pagamento, valor, status, codigo_transacao)
            VALUES 
            (:pedido_id, :forma_pagamento, :valor, :status, :codigo)";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":pedido_id", $pedido_id, PDO::PARAM_INT);
    $cmd->bindValue(":forma_pagamento", $forma_pagamento);
    $cmd->bindValue(":valor", $valor);
    $cmd->bindValue(":status", $status);
    $cmd->bindValue(":codigo", $codigo_transacao);
    $cmd->execute();

    return (int) $this->pdo->lastInsertId();
}
public function confirmarPagamento($pedido_id, $codigo_transacao = null) {

    // 1 - Atualiza pagamento
    $sql = "UPDATE pagamentos
            SET status = 'pago',
                codigo_transacao = :codigo
            WHERE pedido_id = :pedido_id";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":codigo", $codigo_transacao);
    $cmd->bindValue(":pedido_id", $pedido_id);
    $cmd->execute();

    // 2 - Atualiza pedido
    $sql = "UPDATE pedidos
            SET status = 'P'
            WHERE id = :pedido_id";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":pedido_id", $pedido_id);
    $cmd->execute();
}
public function atualizarStatusPorCodigo($codigo_transacao, $status)
{
    $sql = "UPDATE pagamentos 
            SET status = ? 
            WHERE codigo_transacao = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$status, $codigo_transacao]);
}

}
