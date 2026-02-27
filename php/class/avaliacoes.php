<?php 
require_once "db.php";


class Avaliacoes {

    private $pdo;

    public function __construct(){
        $this->pdo = getConnection();
    }

    /**
     * Obtém todas as avaliações de um produto
     */
    public function obterPorProduto(int $produtoId): array {
        $sql = "
            SELECT a.*, u.nome AS usuario_nome
            FROM avaliacoes a
            INNER JOIN usuarios u ON a.usuario_id = u.id
            WHERE a.produto_id = :produto_id
            ORDER BY a.criado_em DESC
        ";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
        $cmd->execute();
        
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtém a média de avaliações de um produto
     */
    public function obterMedia(int $produtoId): float {
        $sql = "
            SELECT ROUND(AVG(CAST(nota AS DECIMAL(3,2))), 2) as media
            FROM avaliacoes
            WHERE produto_id = :produto_id
        ";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
        $cmd->execute();
        
        $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
        return $resultado['media'] ? floatval($resultado['media']) : 0;
    }

    /**
     * Obtém a contagem de avaliações de um produto
     */
    public function obterContagem(int $produtoId): int {
        $sql = "
            SELECT COUNT(*) as total
            FROM avaliacoes
            WHERE produto_id = :produto_id
        ";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
        $cmd->execute();
        
        $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
        return intval($resultado['total']);
    }

    /**
     * Adiciona uma nova avaliação
     */
    public function adicionar(int $usuarioId, int $produtoId, int $nota, string $comentario = ""): bool {
        $sql = "
            INSERT INTO avaliacoes (usuario_id, produto_id, nota, comentario, criado_em)
            VALUES (:usuario_id, :produto_id, :nota, :comentario, NOW())
        ";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":usuario_id", $usuarioId, PDO::PARAM_INT);
        $cmd->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
        $cmd->bindValue(":nota", $nota, PDO::PARAM_INT);
        $cmd->bindValue(":comentario", $comentario);
        
        return $cmd->execute();
    }

    /**
     * Atualiza uma avaliação existente
     */
    public function atualizar(int $avaliacaoId, int $nota, string $comentario = ""): bool {
        $sql = "
            UPDATE avaliacoes 
            SET nota = :nota, comentario = :comentario, atualizado_em = NOW()
            WHERE id = :id
        ";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $avaliacaoId, PDO::PARAM_INT);
        $cmd->bindValue(":nota", $nota, PDO::PARAM_INT);
        $cmd->bindValue(":comentario", $comentario);
        
        return $cmd->execute();
    }

    /**
     * Deleta uma avaliação
     */
    public function deletar(int $avaliacaoId): bool {
        $sql = "DELETE FROM avaliacoes WHERE id = :id";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":id", $avaliacaoId, PDO::PARAM_INT);
        
        return $cmd->execute();
    }

    /**
     * Verifica se um usuário já avaliou um produto
     */
    public function usuarioJaAvaliou(int $usuarioId, int $produtoId): bool {
        $sql = "
            SELECT COUNT(*) as total
            FROM avaliacoes
            WHERE usuario_id = :usuario_id AND produto_id = :produto_id
        ";
        
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(":usuario_id", $usuarioId, PDO::PARAM_INT);
        $cmd->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
        $cmd->execute();
        
        $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0;
    }
}

?>
