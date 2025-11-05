-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 10.91.47.99    Database: zentralhead
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.11-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `produto_detalhes`
--

DROP TABLE IF EXISTS `produto_detalhes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_detalhes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `cor_id` int(11) DEFAULT NULL,
  `tamanho_id` int(11) DEFAULT NULL,
  `estoque` int(11) DEFAULT 0,
  `imagem` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_produto` (`produto_id`),
  KEY `fk_cor` (`cor_id`),
  KEY `fk_tamanho` (`tamanho_id`),
  CONSTRAINT `fk_cor` FOREIGN KEY (`cor_id`) REFERENCES `cores` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tamanho` FOREIGN KEY (`tamanho_id`) REFERENCES `tamanhos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_detalhes`
--

LOCK TABLES `produto_detalhes` WRITE;
/*!40000 ALTER TABLE `produto_detalhes` DISABLE KEYS */;
INSERT INTO `produto_detalhes` VALUES (14,1,2,1,10,'camiseta_azul_p.jpg','2025-10-31 13:49:51','2025-10-31 13:49:51'),(15,1,3,2,60,'camiseta1.png','2025-10-31 13:53:05','2025-10-31 13:53:05'),(16,2,3,2,60,'calca.png','2025-10-31 13:57:54','2025-10-31 13:57:54'),(17,3,3,2,60,'camiseta1.png','2025-10-31 14:42:25','2025-10-31 14:42:25'),(19,4,3,2,60,'camiseta1.png','2025-10-31 14:42:58','2025-10-31 14:42:58'),(20,5,3,2,60,'camiseta1.png','2025-10-31 14:43:18','2025-10-31 14:43:18'),(27,5,4,10,60,'calca.png','2025-11-03 12:00:09','2025-11-03 12:00:09');
/*!40000 ALTER TABLE `produto_detalhes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-03 11:45:43
