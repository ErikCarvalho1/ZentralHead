-- =======================================
-- USUARIOS
-- =======================================
-- niveis
insert into niveis (nome, sigla) values ('cliente', 'cli');
-- usuarios
insert into usuarios (nome, email, senha, nivel_id, ativo) values ('erik','b@b', md5('123'), 11, 1);

-- =======================================
-- PRODUTOS
-- =======================================
insert into categorias (nome, imagem, banner) values ('camisetas', 'calças.png', 'camisaBanner.png');
-- Cores
INSERT INTO cores (nome) VALUES ('Preto'), ('Branco'), ('Azul'), ('Vermelho');
-- Tamanhos
INSERT INTO tamanhos (nome) VALUES ('P'), ('M'), ('G'), ('GG'), ('Único');
-- Produtos
INSERT INTO produtos (nome, descricao_curta, descricao, valor_base, imagem_principal, destaques, categorias_id)
VALUES ('camiseta', 'Camisetobna', 'Camiseta 100% algodão disponível em várias cores e tamanhos', 90.00, 'camisaPreta.png', 0, 4);
-- produto_detalhes
INSERT INTO produto_detalhes (produto_id, cor_id, tamanho_id, estoque, imagem)
VALUES 
(13,  5, 11, 60, 'camisa1.png');
INSERT INTO descontos (nome, tipo, valor, data_inicio, data_fim, ativo)
VALUES 	
('TESTE', 'percentual', 5.00, '2025-11-01', '2025-11-30', 1),
('Queima de Estoque', 'fixo', 50.00, '2025-11-05', '2025-11-10', 1);
INSERT INTO produto_desconto (produto_id, desconto_id)
VALUES
(6, 3),  
(4, 2);  

-- =======================================
-- AVALIAÇÔES
-- =======================================
INSERT INTO avaliacoes (usuario_id, produto_id, nota, comentario)
VALUES (1012, 5, 5, 'Excelente qualidade, recomendo!');
-- =====================================================================================================================================================
	-- Selects 
-- =====================================================================================================================================================
select * from PRODUTOS;

select * from categorias;

select * from produto_detalhes;

select * from cores; 

select * from tamanhos;

select * from avaliacoes;

select * from usuarios;

select * from niveis;