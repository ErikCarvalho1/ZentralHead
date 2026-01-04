<?php 
include_once "db.php";

private $id;
private $cliente_id;
private $pedido_id;
private $motivo;
private $data_devolucao;
private $status;
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
public function setPedido_id(int $pedido_id) {
    $this->pedido_id = $pedido_id;
}
public function getPedido_id() {
    return $this->pedido_id;
}
public function setMotivo(string $motivo) {
    $this->motivo = $motivo;
}
public function getMotivo() {
    return $this->motivo;
}
public function setData_devolucao(string $data_devolucao) {
    $this->data_devolucao = $data_devolucao;
}
public function getData_devolucao() {
    return $this->data_devolucao;
}
public function setStatus(string $status) {
    $this->status = $status;
}
public function getStatus() {
    return $this->status;
}
public function inserir($cliente_id, $pedido_id, $motivo, $data_devolucao) {

    $sql = "INSERT INTO devolucoes 
            (cliente_id, pedido_id, motivo, data_devolucao)
            VALUES 
            (:cliente_id, :pedido_id, :motivo, :data_devolucao)";

    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":cliente_id", $cliente_id, PDO::PARAM_INT);
    $cmd->bindValue(":pedido_id", $pedido_id, PDO::PARAM_INT);
    $cmd->bindValue(":motivo", $motivo);
    $cmd->bindValue(":data_devolucao", $data_devolucao);
    $cmd->execute();
}
public function listarPorCliente($cliente_id) {
    $sql = "SELECT * FROM devolucoes WHERE cliente_id = :cliente_id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":cliente_id", $cliente_id, PDO::PARAM_INT);
    $cmd->execute();
    return $cmd->fetchAll(PDO::FETCH_ASSOC);
}
public function atualizarStatus($devolucao_id, $status) {
    $sql = "UPDATE devolucoes SET status = :status WHERE id = :devolucao_id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":status", $status);
    $cmd->bindValue(":devolucao_id", $devolucao_id, PDO::PARAM_INT);
    $cmd->execute();
}
public function excluir($devolucao_id) {
    $sql = "DELETE FROM devolucoes WHERE id = :devolucao_id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":devolucao_id", $devolucao_id, PDO::PARAM_INT);
    $cmd->execute();
}
public function listarTodas() {
    $sql = "SELECT * FROM devolucoes";
    $cmd = $this->pdo->query($sql);
    return $cmd->fetchAll(PDO::FETCH_ASSOC);
}
public function buscarPorId($devolucao_id) {
    $sql = "SELECT * FROM devolucoes WHERE id = :devolucao_id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":devolucao_id", $devolucao_id, PDO::PARAM_INT);
    $cmd->execute();
    return $cmd->fetch(PDO::FETCH_ASSOC);
}
public function contarDevolucoesPorStatus($status) {
    $sql = "SELECT COUNT(*) as total FROM devolucoes WHERE status = :status";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":status", $status);
    $cmd->execute();
    $result = $cmd->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}
?>