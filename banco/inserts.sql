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
INSERT INTO produtos (nome, descricao_curta, descricao, valor_base, imagem_principal, destaques)
VALUES ('tetinho', 'calça de algodão confortável', 'Camiseta 100% algodão disponível em várias cores e tamanhos', 85.60, 'testinho.png', 1);
-- produto_detalhes
INSERT INTO produto_detalhes (produto_id, cor_id, tamanho_id, estoque, imagem)
VALUES 
(5,  4, 10, 60, 'calca.png');
-- ===========================================================================
-- desconto
-- ===========================================================================
INSERT INTO descontos (nome, tipo, valor, data_inicio, data_fim, ativo)
VALUES 	
('Promoção de Inverno', 'percentual', 15.00, '2025-11-01', '2025-11-30', 1),
('Queima de Estoque', 'fixo', 50.00, '2025-11-05', '2025-11-10', 1);
INSERT INTO produto_desconto (produto_id, desconto_id)
VALUES
(7, 1),  
(8, 2);  
-- JOIN do desconto com produto
SELECT p.nome AS produto, d.nome AS desconto, d.tipo, d.valor
FROM produtos p
JOIN produto_desconto pd ON p.id = pd.produto_id
JOIN descontos d ON pd.desconto_id = d.id
WHERE d.ativo = 1
AND CURDATE() BETWEEN d.data_inicio AND d.data_fim;

-- =======================================
-- AVALIAÇÔES
-- =======================================
INSERT INTO avaliacoes (usuario_id, produto_id, nota, comentario)
VALUES (1012, 5, 5, 'Excelente qualidade, recomendo!');


-- =====================================================================================================================================================
	-- Selects 
-- =====================================================================================================================================================
select * from produtos;
SELECT * FROM produtos WHERE destaques = 1 ORDER BY criado_em DESC;


select * from produto_detalhes;

select * from cores; 

select * from tamanhos;

select * from avaliacoes;

select * from usuarios;

select * from niveis;	