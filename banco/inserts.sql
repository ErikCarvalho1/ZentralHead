-- =======================================
-- PRODUTOS
-- =======================================

-- Cores
INSERT INTO cores (nome) VALUES ('Preto'), ('Branco'), ('Azul'), ('Vermelho');
-- Tamanhos
INSERT INTO tamanhos (nome) VALUES ('P'), ('M'), ('G'), ('GG'), ('Único');
-- Produtos
INSERT INTO produtos (nome, descricao_curta, descricao, valor_base, imagem_principal)
VALUES ('calça', 'calça de algodão confortável', 'Camiseta 100% algodão disponível em várias cores e tamanhos', 49.90, 'camiseta.jpg');
-- produto_detalhes
INSERT INTO produto_detalhes (produto_id, cor_id, tamanho_id, estoque, imagem, destaque)
VALUES 
(2,  3, 2, 60, 'calca.png', 1);
-- =====================================================================================================================================================
	-- Selects 
-- =====================================================================================================================================================
select * from produtos;

select * from produto_detalhes;

select * from cores; 

select * from tamanhos;