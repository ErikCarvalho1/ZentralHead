-- =======================================
-- USUARIOS
-- =======================================
-- niveis
insert into niveis (nome, sigla) values ('cliente', 'cli');
-- usuarios
insert into usuarios (nome, email, senha, nivel_id, ativo) values ('erik','b@b', md5('123'), 11, 1);
call sp_usuario_insert ('erik', 'E@E', 123, 11 );
-- =======================================
-- PRODUTOS
-- =======================================

-- Cores
INSERT INTO cores (nome) VALUES ('Preto'), ('Branco'), ('Azul'), ('Vermelho');
-- Tamanhos
INSERT INTO tamanhos (nome) VALUES ('P'), ('M'), ('G'), ('GG'), ('Único');
-- Produtos
INSERT INTO produtos (nome, descricao_curta, descricao, valor_base, imagem_principal)
VALUES ('calça', 'calça de algodão confortável', 'Camiseta 100% algodão disponível em várias cores e tamanhos', 49.90, 'camiseta1.png');
-- produto_detalhes
INSERT INTO produto_detalhes (produto_id, cor_id, tamanho_id, estoque, imagem, destaque)
VALUES 
(3,  5, 11, 60, 'calca.png', 1);
-- =======================================
-- AVALIAÇÔES
-- =======================================
INSERT INTO avaliacoes (usuario_id, produto_id, nota, comentario)
VALUES (1012, 5, 5, 'Excelente qualidade, recomendo!');
-- =====================================================================================================================================================
	-- Selects 
-- =====================================================================================================================================================
select * from produtos;

select * from produto_detalhes;

select * from cores; 

select * from tamanhos;

select * from avaliacoes;

select * from usuarios;

select * from niveis;