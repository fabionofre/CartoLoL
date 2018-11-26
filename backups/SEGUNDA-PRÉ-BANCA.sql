-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: cartolol
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acoes`
--

DROP TABLE IF EXISTS `acoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `acoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acoes`
--

LOCK TABLES `acoes` WRITE;
/*!40000 ALTER TABLE `acoes` DISABLE KEYS */;
INSERT INTO `acoes` VALUES (1,'Abate',NULL,NULL),(2,'Assistência',NULL,NULL),(3,'Ward',NULL,NULL),(4,'Torre',NULL,NULL),(5,'Inibidor',NULL,NULL),(6,'Primeiro Abate',NULL,NULL),(7,'Primeira Torre',NULL,NULL),(8,'Morte',NULL,NULL),(9,'Vitória',NULL,NULL);
/*!40000 ALTER TABLE `acoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atletas`
--

DROP TABLE IF EXISTS `atletas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `atletas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobrenome` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `criador_id` int(10) unsigned NOT NULL,
  `equipe_id` int(10) unsigned DEFAULT NULL,
  `foto` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atletas_criador_id_foreign` (`criador_id`),
  KEY `atletas_equipe_id_foreign` (`equipe_id`),
  CONSTRAINT `atletas_criador_id_foreign` FOREIGN KEY (`criador_id`) REFERENCES `users` (`id`),
  CONSTRAINT `atletas_equipe_id_foreign` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atletas`
--

LOCK TABLES `atletas` WRITE;
/*!40000 ALTER TABLE `atletas` DISABLE KEYS */;
INSERT INTO `atletas` VALUES (4,'Felipe','brTT','Gonçalves','1992-11-21',3,NULL,'brtt.jpg',NULL,'2018-11-24 08:31:14','2018-11-24 08:31:14'),(5,'Thúlio','SirT','Carlos','1994-11-11',3,NULL,'sirt.jpg',NULL,'2018-11-24 08:45:15','2018-11-24 08:45:15'),(6,'Matheus','Mylon','Borges','1995-11-11',3,NULL,'mylon.jpg',NULL,'2018-11-24 08:45:30','2018-11-24 08:45:30'),(7,'Hugo','Dioud','Padioleau','1996-11-07',3,NULL,'dioud.jpg',NULL,'2018-11-24 08:45:44','2018-11-24 08:45:44'),(8,'Gabriel','Kami','Bohm','1998-11-04',3,NULL,'kami.jpg',NULL,'2018-11-24 08:46:03','2018-11-24 08:46:03');
/*!40000 ALTER TABLE `atletas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campeonatos`
--

DROP TABLE IF EXISTS `campeonatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `campeonatos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `criador_id` int(10) unsigned NOT NULL,
  `fl_publico` tinyint(1) NOT NULL,
  `fl_profissional` tinyint(1) NOT NULL,
  `brasao` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campeonatos_criador_id_foreign` (`criador_id`),
  CONSTRAINT `campeonatos_criador_id_foreign` FOREIGN KEY (`criador_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonatos`
--

LOCK TABLES `campeonatos` WRITE;
/*!40000 ALTER TABLE `campeonatos` DISABLE KEYS */;
INSERT INTO `campeonatos` VALUES (3,'CBLOL','Circuito Brasilieiro de League of Legends','2018-11-26','2018-12-26',3,1,1,'cblol.jpg',NULL,'2018-11-27 00:15:20','2018-11-27 00:15:20');
/*!40000 ALTER TABLE `campeonatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disputam_campeonato`
--

DROP TABLE IF EXISTS `disputam_campeonato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `disputam_campeonato` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipe_id` int(10) unsigned NOT NULL,
  `campeonato_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disputam_campeonato`
--

LOCK TABLES `disputam_campeonato` WRITE;
/*!40000 ALTER TABLE `disputam_campeonato` DISABLE KEYS */;
INSERT INTO `disputam_campeonato` VALUES (1,3,1);
/*!40000 ALTER TABLE `disputam_campeonato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `equipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criador_id` int(10) unsigned NOT NULL,
  `fl_profissional` tinyint(1) NOT NULL,
  `brasao` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `equipes_criador_id_foreign` (`criador_id`),
  CONSTRAINT `equipes_criador_id_foreign` FOREIGN KEY (`criador_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipes`
--

LOCK TABLES `equipes` WRITE;
/*!40000 ALTER TABLE `equipes` DISABLE KEYS */;
INSERT INTO `equipes` VALUES (1,'Pain Gaming',3,1,'pain.png',NULL,'2018-11-27 00:32:24','2018-11-27 00:32:24');
/*!40000 ALTER TABLE `equipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escalacoes`
--

DROP TABLE IF EXISTS `escalacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `escalacoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invocador_id` int(10) unsigned NOT NULL,
  `meio_id` int(10) unsigned NOT NULL,
  `topo_id` int(10) unsigned NOT NULL,
  `cacador_id` int(10) unsigned NOT NULL,
  `atirador_id` int(10) unsigned NOT NULL,
  `suporte_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `escalacoes_invocador_id_foreign` (`invocador_id`),
  KEY `escalacoes_meio_id_foreign` (`meio_id`),
  KEY `escalacoes_topo_id_foreign` (`topo_id`),
  KEY `escalacoes_cacador_id_foreign` (`cacador_id`),
  KEY `escalacoes_atirador_id_foreign` (`atirador_id`),
  KEY `escalacoes_suporte_id_foreign` (`suporte_id`),
  CONSTRAINT `escalacoes_atirador_id_foreign` FOREIGN KEY (`atirador_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_cacador_id_foreign` FOREIGN KEY (`cacador_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_invocador_id_foreign` FOREIGN KEY (`invocador_id`) REFERENCES `users` (`id`),
  CONSTRAINT `escalacoes_meio_id_foreign` FOREIGN KEY (`meio_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_suporte_id_foreign` FOREIGN KEY (`suporte_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_topo_id_foreign` FOREIGN KEY (`topo_id`) REFERENCES `atletas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escalacoes`
--

LOCK TABLES `escalacoes` WRITE;
/*!40000 ALTER TABLE `escalacoes` DISABLE KEYS */;
INSERT INTO `escalacoes` VALUES (5,3,8,6,5,4,7,'2018-11-24 12:07:06','2018-11-27 00:45:46');
/*!40000 ALTER TABLE `escalacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcoes`
--

DROP TABLE IF EXISTS `funcoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `funcoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcoes`
--

LOCK TABLES `funcoes` WRITE;
/*!40000 ALTER TABLE `funcoes` DISABLE KEYS */;
INSERT INTO `funcoes` VALUES (1,'Meio',NULL,NULL),(2,'Topo',NULL,NULL),(3,'Caçador',NULL,NULL),(4,'Atirador',NULL,NULL),(5,'Suporte',NULL,NULL),(6,'Técnico',NULL,NULL);
/*!40000 ALTER TABLE `funcoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2018_08_28_175701_create_tipos_usuarios',1),(2,'2014_10_12_000000_create_users_table',2),(3,'2014_10_12_100000_create_password_resets_table',2),(4,'2018_08_28_175215_create_campeonatos_table',2),(5,'2018_09_11_204734_create_equipes_table',2),(6,'2018_09_17_042614_disputam_campeonato',2),(7,'2018_09_17_175703_create_atletas_table',2),(8,'2018_11_08_233332_create_regra_pontuacaos_table',2),(9,'2018_11_08_233417_create_funcaos_table',2),(10,'2018_11_08_233423_create_acaos_table',2),(11,'2018_11_11_165849_alter_table_users',2),(12,'2018_11_12_162825_alter_table_regra_pontuacao',2),(13,'2018_11_24_051508_create_escalacaos_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regras_pontuacao`
--

DROP TABLE IF EXISTS `regras_pontuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `regras_pontuacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acao_id` int(10) unsigned NOT NULL,
  `funcao_id` int(10) unsigned NOT NULL,
  `pontuacao` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campeonato_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regras_pontuacao`
--

LOCK TABLES `regras_pontuacao` WRITE;
/*!40000 ALTER TABLE `regras_pontuacao` DISABLE KEYS */;
INSERT INTO `regras_pontuacao` VALUES (12,2,5,30,'2018-11-22 20:38:59','2018-11-22 20:38:59',1),(13,1,3,20,'2018-11-22 21:24:39','2018-11-22 21:24:39',1),(15,3,4,25,'2018-11-24 03:15:28','2018-11-24 03:15:28',1),(19,5,1,35,'2018-11-24 03:16:38','2018-11-24 11:35:46',1),(20,7,5,12,'2018-11-24 03:18:02','2018-11-24 03:18:02',1),(21,9,2,20,'2018-11-24 03:25:59','2018-11-24 03:25:59',1),(22,1,1,40,'2018-11-24 11:35:30','2018-11-24 11:35:30',1);
/*!40000 ALTER TABLE `regras_pontuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tipos_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_usuario`
--

LOCK TABLES `tipos_usuario` WRITE;
/*!40000 ALTER TABLE `tipos_usuario` DISABLE KEYS */;
INSERT INTO `tipos_usuario` VALUES (1,'Invocador',NULL,NULL),(2,'Juiz',NULL,NULL),(3,'Organizador',NULL,NULL);
/*!40000 ALTER TABLE `tipos_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_usuario_id` int(10) unsigned NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_tipo_usuario_id_foreign` (`tipo_usuario_id`),
  CONSTRAINT `users_tipo_usuario_id_foreign` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'foo@bar.com',1,'$2y$10$edFBwokK1VOM0edSVkjuCO8rh6BFVf.pPmtcjSt/iB0KNgGW1Fyj6',NULL,NULL,'2018-11-20 17:50:43','2018-11-20 17:50:43',NULL),(3,'fabio.onofre166@gmail.com',3,NULL,'1955035907912362',NULL,'2018-11-20 17:50:51','2018-11-20 17:50:51','https://graph.facebook.com/v3.0/1955035907912362/picture?type=normal'),(17,'fabio@teste.com',1,'$2y$10$4W6YFwqqQWZY9BhUXZofB.Gg9cJEG22nQfRHPCBYS743fGUo1BmOa',NULL,NULL,'2018-11-24 15:22:21','2018-11-24 15:22:21',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-26 18:02:03
