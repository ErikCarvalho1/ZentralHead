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
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `descricao_curta` text DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor_base` decimal(10,2) NOT NULL,
  `imagem_principal` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `destaques` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Camiseta Básica','Camiseta de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta.jpg','2025-10-31 12:52:26','2025-10-31 12:52:26',NULL),(2,'calça','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta.jpg','2025-10-31 13:57:24','2025-10-31 13:57:24',NULL),(3,'top','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta.jpg','2025-10-31 14:42:22','2025-10-31 14:42:22',NULL),(4,'a','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta1.jpg','2025-10-31 14:42:54','2025-10-31 14:42:54',NULL),(5,'a','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta1.png','2025-10-31 14:43:18','2025-10-31 14:43:18',NULL),(6,'calça','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta1.png','2025-11-03 11:57:17','2025-11-03 11:57:17',NULL),(7,'calça','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',49.90,'camiseta1.png','2025-11-03 12:22:05','2025-11-03 12:22:05',_binary ''),(8,'tetinho','calça de algodão confortável','Camiseta 100% algodão disponível em várias cores e tamanhos',85.60,'testinho.png','2025-11-03 12:27:25','2025-11-03 12:27:25',_binary '');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
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
