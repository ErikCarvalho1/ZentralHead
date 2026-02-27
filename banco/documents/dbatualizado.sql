-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema zentralhead
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema zentralhead
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `zentralhead` DEFAULT CHARACTER SET utf8mb4 ;
USE `zentralhead` ;

-- -----------------------------------------------------
-- Table `zentralhead`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`cliente` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `ativo` BIT(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 1031
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `imagem` VARCHAR(45) NULL DEFAULT NULL,
  `banner` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`produtos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `descricao_curta` TEXT NULL DEFAULT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `valor_base` DECIMAL(10,2) NOT NULL,
  `imagem_principal` VARCHAR(255) NULL DEFAULT NULL,
  `criado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  `atualizado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  `destaques` BIT(1) NULL DEFAULT NULL,
  `categorias_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categorias` (`categorias_id` ASC) VISIBLE,
  CONSTRAINT `fk_categorias`
    FOREIGN KEY (`categorias_id`)
    REFERENCES `zentralhead`.`categorias` (`id`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 37
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`avaliacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`avaliacoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuarios_id` INT(11) NOT NULL,
  `produtos_id` INT(11) NOT NULL,
  `nota` ENUM('1', '2', '3', '4', '5') NOT NULL,
  `comentario` VARCHAR(244) NULL DEFAULT NULL,
  `criado_em` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  `atualizado_em` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `usuarios_id` (`usuarios_id` ASC) VISIBLE,
  INDEX `produtos_id` (`produtos_id` ASC) VISIBLE,
  CONSTRAINT `avaliacoes_ibfk_1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `zentralhead`.`cliente` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_ibfk_2`
    FOREIGN KEY (`produtos_id`)
    REFERENCES `zentralhead`.`produtos` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`caixas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`caixas` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(4) NOT NULL,
  `data_abertura` DATETIME NOT NULL,
  `saldo_inicial` DECIMAL(10,2) NOT NULL,
  `status` CHAR(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`),
  INDEX `fk_Caixa_Usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_Caixa_Usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `zentralhead`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`cores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`cores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `criado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`descontos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`descontos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `tipo` ENUM('percentual', 'fixo') NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `data_inicio` DATE NOT NULL,
  `data_fim` DATE NOT NULL,
  `ativo` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`pedidos` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `cliente_id` INT(4) NOT NULL,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `status` CHAR(1) NOT NULL DEFAULT 'A',
  `desconto` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 100141
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`enderecos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` INT(11) NOT NULL,
  `pedido_id` INT(11) NULL DEFAULT NULL,
  `rua` VARCHAR(150) NOT NULL,
  `numero` VARCHAR(20) NOT NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `cidade` VARCHAR(100) NOT NULL,
  `estado` CHAR(2) NOT NULL,
  `cep` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_endereco_cliente` (`cliente_id` ASC) VISIBLE,
  INDEX `fk_endereco_pedido` (`pedido_id` ASC) VISIBLE,
  CONSTRAINT `fk_endereco_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `zentralhead`.`cliente` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_endereco_pedido`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `zentralhead`.`pedidos` (`id`)
    ON DELETE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`fornecedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`fornecedores` (
  `id` INT(4) NOT NULL,
  `razao_social` VARCHAR(100) NOT NULL,
  `fantasia` VARCHAR(40) NOT NULL,
  `cnpj` CHAR(14) NOT NULL,
  `contato` VARCHAR(60) NULL DEFAULT NULL,
  `telefone` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(60) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`itens_pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`itens_pedido` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` INT(11) NOT NULL,
  `produto_id` INT(11) NOT NULL,
  `quantidade` INT(11) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_item_pedido_pedido` (`pedido_id` ASC) VISIBLE,
  INDEX `fk_item_pedido_produto` (`produto_id` ASC) VISIBLE,
  CONSTRAINT `fk_item_pedido_pedido`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `zentralhead`.`pedidos` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_item_pedido_produto`
    FOREIGN KEY (`produto_id`)
    REFERENCES `zentralhead`.`produtos` (`id`)
    ON DELETE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 70
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`niveis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`niveis` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `sigla` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`pagamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`pagamentos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` INT(11) NOT NULL,
  `forma_pagamento` ENUM('pix', 'cartao', 'boleto') NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `status` ENUM('pendente', 'pago', 'cancelado') NULL DEFAULT 'pendente',
  `codigo_transacao` VARCHAR(100) NULL DEFAULT NULL,
  `criado_em` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `fk_pagamento_pedido` (`pedido_id` ASC) VISIBLE,
  CONSTRAINT `fk_pagamento_pedido`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `zentralhead`.`pedidos` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`produto_desconto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`produto_desconto` (
  `produto_id` INT(11) NOT NULL,
  `desconto_id` INT(11) NOT NULL,
  PRIMARY KEY (`produto_id`, `desconto_id`),
  INDEX `desconto_id` (`desconto_id` ASC) VISIBLE,
  CONSTRAINT `produto_desconto_ibfk_1`
    FOREIGN KEY (`produto_id`)
    REFERENCES `zentralhead`.`produtos` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `produto_desconto_ibfk_2`
    FOREIGN KEY (`desconto_id`)
    REFERENCES `zentralhead`.`descontos` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`tamanhos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`tamanhos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `criado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`produto_detalhes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`produto_detalhes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `produto_id` INT(11) NOT NULL,
  `cor_id` INT(11) NULL DEFAULT NULL,
  `tamanho_id` INT(11) NULL DEFAULT NULL,
  `estoque` INT(11) NULL DEFAULT 0,
  `imagem` VARCHAR(255) NULL DEFAULT NULL,
  `criado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  `atualizado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `fk_produto` (`produto_id` ASC) VISIBLE,
  INDEX `fk_cor` (`cor_id` ASC) VISIBLE,
  INDEX `fk_tamanho` (`tamanho_id` ASC) VISIBLE,
  CONSTRAINT `fk_cor`
    FOREIGN KEY (`cor_id`)
    REFERENCES `zentralhead`.`cores` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_produto`
    FOREIGN KEY (`produto_id`)
    REFERENCES `zentralhead`.`produtos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tamanho`
    FOREIGN KEY (`tamanho_id`)
    REFERENCES `zentralhead`.`tamanhos` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 30
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `zentralhead`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zentralhead`.`usuarios` (
  `id` INT(4) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `nivel_id` INT(11) NOT NULL,
  `ativo` BIT(1) NOT NULL DEFAULT b'1',
  `criado_em` DATETIME NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE,
  INDEX `fk_usuario_nivel` (`nivel_id` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_nivel`
    FOREIGN KEY (`nivel_id`)
    REFERENCES `zentralhead`.`niveis` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
