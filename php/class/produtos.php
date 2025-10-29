<?php 
include "db.php";
class Produtos {

private $id;
private $codBarras;
private $descricao;
private $valorUnit;
private $unidade_Venda;
private $categoria_Id;
private $estoque_Minimo;
private $classe_Desconto;
private $imagem;
private $data_Cadastro;
private $descontinuado;
private $pdo;

public function  __construct(){
    $this->pdo = getConnection();
}
public function getId (): int {
    return $this->id;
}
public function getCodBarras (){
    return $this->codBarras;
}
public function setCodBarras (string $codBarras){
    $this->codBarras = $codBarras;

}
public function getDescricao (){
    return $this->descricao;
}
public function setDescricao (string $descricao){
    $this->descricao = $descricao;
}
public function getValorUnit (){
    return $this->valorUnit;
}
public function setValorUnit (float $valorUnit){
    $this->valorUnit = $valorUnit;
}
public function getUnidade_Venda (){
    return $this->unidade_Venda;
}
public function setUnidade_Venda (string $unidade_Venda){
    $this->unidade_Venda = $unidade_Venda;
}
public function getCategoria_Id (){
    return $this->categoria_Id;
}
public function setCategoria_Id (int $categoria_Id){
    $this->categoria_Id = $categoria_Id;
}
public function getEstoque_Minimo (){
    return $this->estoque_Minimo;
}
public function setEstoque_Minimo (int $estoque_Minimo){
    $this->estoque_Minimo = $estoque_Minimo;
}
public function getClasse_Desconto (){
    return $this->classe_Desconto;
}
public function setClasse_Desconto (string $classe_Desconto){
    $this->classe_Desconto = $classe_Desconto;
}
public function getImagem (){
    return $this->imagem;
}
public function setImagem (string $imagem){
    $this->imagem = $imagem;
}
public function getData_Cadastro (){
    return $this->data_Cadastro;
}
public function setData_Cadastro (string $data_Cadastro){
    $this->data_Cadastro = $data_Cadastro;
}
public function getDescontinuado (){
   return $this->descontinuado;
}
public function setDescontinuado (bool $descontinuado){
    $this->descontinuado = $descontinuado;
}
public function insert(){
    $sql= "CALL sp_produtos_insert (codBarras, descricao, valorUnit, unidade_vendas, categoria_id, estoque_minimo, classe_desconto, imagem, data_cadastro, descontinuado) VALUES (:codBarras, :descricao, :valorUnit, :unidade_venda, :categoria_id, :estoque_minimo, :classe_desconto, :imagem, :data_cadastro, :descontinuado)";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":codBarras", $this->codBarras);
    $cmd->bindValue(":descricao", $this->descricao);
    $cmd->bindValue(":valorUnit", $this->valorUnit);
    $cmd->bindValue(":unidade_venda", $this->unidade_Venda);
    $cmd->bindValue(":categoria_id", $this->categoria_Id);
    $cmd->bindValue(":estoque_minimo", $this->estoque_Minimo);
    $cmd->bindValue(":classe_desconto", $this->classe_Desconto);
    $cmd->bindValue(":imagem", $this->imagem);
    $cmd->bindValue(":data_cadastro", $this->data_Cadastro);
    $cmd->bindValue(":descontinuado", $this->descontinuado);
    $cmd->execute();

}
public function listar (){
    $sql = "SELECT * FROM produtos";
    $cmd = $this->pdo->prepare($sql);
    $cmd->execute();
    return $cmd->fetchAll(PDO::FETCH_ASSOC);
}

public function listarPorId ($id){
    $sql = "SELECT * FROM  produtos WHERE id = :id LIMIT 1";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(':id', $id, PDO::PARAM_INT);
    $cmd->execute();
    return $cmd->fetch(PDO::FETCH_ASSOC);
}

public function atualizar (){
    $sql = "CALL sp_produtos_update SET codBarras = :codBarras, descricao = :descricao, valorUnit = :valorUnit, unidade_vendas = :unidade_venda, categoria_id = :categoria_id, estoque_minimo = :estoque_minimo, classe_desconto = :classe_desconto, imagem = :imagem, data_cadastro = :data_cadastro, descontinuado = :descontinuado WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":codBarras", $this->codBarras);
    $cmd->bindValue(":descricao", $this->descricao);
    $cmd->bindValue(":valorUnit", $this->valorUnit);
    $cmd->bindValue(":unidade_venda", $this->unidade_Venda);
    $cmd->bindValue(":categoria_id", $this->categoria_Id);
    $cmd->bindValue(":estoque_minimo", $this->estoque_Minimo);
    $cmd->bindValue(":classe_desconto", $this->classe_Desconto);
    $cmd->bindValue(":imagem", $this->imagem);
    $cmd->bindValue(":data_cadastro", $this->data_Cadastro);
    $cmd->bindValue(":descontinuado", $this->descontinuado);
    $cmd->bindValue(":id", $this->id);
    $cmd->execute();
}
public function excluir (int $id){
    $sql = "DELETE FROM produtos WHERE id = :id";
    $cmd = $this->pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
}
}
?>