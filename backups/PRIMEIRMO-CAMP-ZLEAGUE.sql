-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: zleague
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acoes`
--

LOCK TABLES `acoes` WRITE;
/*!40000 ALTER TABLE `acoes` DISABLE KEYS */;
INSERT INTO `acoes` VALUES (1,'Abate',NULL,NULL),(2,'Assistência',NULL,NULL),(3,'Ward',NULL,NULL),(4,'Torre',NULL,NULL),(5,'Inibidor',NULL,NULL),(6,'Primeiro Abate',NULL,NULL),(7,'Primeira Torre',NULL,NULL),(8,'Morte',NULL,NULL),(9,'Vitória',NULL,NULL),(10,'Farm',NULL,NULL),(11,'Dano',NULL,NULL),(12,'Dano Recebido',NULL,NULL);
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
  `foto` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `preco` decimal(8,2) NOT NULL DEFAULT '20.00',
  `equipe_id` int(10) unsigned DEFAULT NULL,
  `funcao_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `atletas_criador_id_foreign` (`criador_id`),
  KEY `atletas_equipe_id_foreign` (`equipe_id`),
  KEY `atletas_funcao_id_foreign` (`funcao_id`),
  CONSTRAINT `atletas_criador_id_foreign` FOREIGN KEY (`criador_id`) REFERENCES `users` (`id`),
  CONSTRAINT `atletas_equipe_id_foreign` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`),
  CONSTRAINT `atletas_funcao_id_foreign` FOREIGN KEY (`funcao_id`) REFERENCES `funcoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atletas`
--

LOCK TABLES `atletas` WRITE;
/*!40000 ALTER TABLE `atletas` DISABLE KEYS */;
INSERT INTO `atletas` VALUES (3,'Felipe','brTT','Gonçalves','1996-12-29',1,'brTT.jpg',NULL,'2019-05-31 19:23:02','2019-05-31 19:23:02',20.00,2,4),(4,'Matheus','Mylon','Borges','1996-12-29',1,'mylon.jpg',NULL,'2019-05-31 23:32:07','2019-05-31 23:32:07',20.00,2,2),(5,'Gabriel','Kami','Bohm','1996-12-29',1,'kami.jpg',NULL,'2019-05-31 23:32:35','2019-05-31 23:32:35',20.00,2,1),(6,'Thulio','SirT','Carlos','1996-12-29',1,'sirt.jpg',NULL,'2019-05-31 23:32:51','2019-05-31 23:32:51',20.00,2,3),(7,'Hugo','Dioud','Padileau','1996-12-29',1,'dioud.jpg',NULL,'2019-05-31 23:33:07','2019-05-31 23:33:07',20.00,2,5);
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
  `estado` enum('em_criacao','em_andamento','finalizado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'em_criacao',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rodada_atual_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campeonatos_criador_id_foreign` (`criador_id`),
  CONSTRAINT `campeonatos_criador_id_foreign` FOREIGN KEY (`criador_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campeonatos`
--

LOCK TABLES `campeonatos` WRITE;
/*!40000 ALTER TABLE `campeonatos` DISABLE KEYS */;
INSERT INTO `campeonatos` VALUES (1,'ZLeague Campeonato','Campeonato para validação do ZLeague','2018-12-01','2019-01-01',1,1,0,'cblol.jpg','em_andamento',NULL,NULL,'2019-06-01 03:21:51',1);
/*!40000 ALTER TABLE `campeonatos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipes`
--

LOCK TABLES `equipes` WRITE;
/*!40000 ALTER TABLE `equipes` DISABLE KEYS */;
INSERT INTO `equipes` VALUES (1,'RED Canids',1,1,'red.jpg',NULL,'2019-05-31 18:25:58','2019-05-31 18:25:58'),(2,'Pain Gaming',1,1,'pain.jpg',NULL,'2019-05-31 19:18:37','2019-05-31 19:18:37');
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
  `rodada_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `escalacoes_invocador_id_foreign` (`invocador_id`),
  KEY `escalacoes_meio_id_foreign` (`meio_id`),
  KEY `escalacoes_topo_id_foreign` (`topo_id`),
  KEY `escalacoes_cacador_id_foreign` (`cacador_id`),
  KEY `escalacoes_atirador_id_foreign` (`atirador_id`),
  KEY `escalacoes_suporte_id_foreign` (`suporte_id`),
  KEY `escalacoes_rodada_id_foreign` (`rodada_id`),
  CONSTRAINT `escalacoes_atirador_id_foreign` FOREIGN KEY (`atirador_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_cacador_id_foreign` FOREIGN KEY (`cacador_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_invocador_id_foreign` FOREIGN KEY (`invocador_id`) REFERENCES `users` (`id`),
  CONSTRAINT `escalacoes_meio_id_foreign` FOREIGN KEY (`meio_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_rodada_id_foreign` FOREIGN KEY (`rodada_id`) REFERENCES `rodadas` (`id`),
  CONSTRAINT `escalacoes_suporte_id_foreign` FOREIGN KEY (`suporte_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `escalacoes_topo_id_foreign` FOREIGN KEY (`topo_id`) REFERENCES `atletas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escalacoes`
--

LOCK TABLES `escalacoes` WRITE;
/*!40000 ALTER TABLE `escalacoes` DISABLE KEYS */;
INSERT INTO `escalacoes` VALUES (1,1,5,4,6,3,7,'2019-05-31 23:50:09','2019-06-01 00:17:37',1),(4,2,5,4,6,3,7,'2019-06-01 05:07:41','2019-06-01 05:07:41',1),(5,8,5,4,6,3,7,'2019-06-01 06:34:48','2019-06-01 06:34:48',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcoes`
--

LOCK TABLES `funcoes` WRITE;
/*!40000 ALTER TABLE `funcoes` DISABLE KEYS */;
INSERT INTO `funcoes` VALUES (1,'meio',NULL,NULL),(2,'topo',NULL,NULL),(3,'cacador',NULL,NULL),(4,'atirador',NULL,NULL),(5,'suporte',NULL,NULL);
/*!40000 ALTER TABLE `funcoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ligas`
--

DROP TABLE IF EXISTS `ligas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ligas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campeonato_id` int(10) unsigned NOT NULL,
  `criador_id` int(10) unsigned NOT NULL,
  `brasao` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ligas_campeonato_id_foreign` (`campeonato_id`),
  KEY `ligas_criador_id_foreign` (`criador_id`),
  CONSTRAINT `ligas_campeonato_id_foreign` FOREIGN KEY (`campeonato_id`) REFERENCES `campeonatos` (`id`),
  CONSTRAINT `ligas_criador_id_foreign` FOREIGN KEY (`criador_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ligas`
--

LOCK TABLES `ligas` WRITE;
/*!40000 ALTER TABLE `ligas` DISABLE KEYS */;
INSERT INTO `ligas` VALUES (1,'Faker\'s league',1,1,'faker.jpg','2019-06-01 06:12:59','2019-06-01 06:12:59');
/*!40000 ALTER TABLE `ligas` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000001_create_tipos_usuarios',1),(2,'2014_10_12_000002_create_users_table',1),(3,'2014_10_12_000003_create_password_resets_table',1),(4,'2014_10_12_000004_create_campeonatos_table',1),(5,'2014_10_12_000005_create_rodadas_table',1),(6,'2014_10_12_000006_create_atletas_table',1),(7,'2014_10_12_000007_create_regra_pontuacaos_table',1),(8,'2014_10_12_000008_create_funcaos_table',1),(9,'2014_10_12_000009_create_acaos_table',1),(10,'2014_10_12_000010_alter_table_users',1),(11,'2014_10_12_000011_alter_table_regra_pontuacao',1),(12,'2014_10_12_000012_create_escalacaos_table',1),(13,'2014_10_12_000013_alter_table_users_add_column_patrimonio',1),(14,'2014_10_12_000014_create_equipes_table',1),(15,'2014_10_12_000015_alter_table_escalacoes',1),(16,'2014_10_12_000016_alter_table_atletas_add_column_preco',1),(17,'2014_10_12_000017_create_pontuacaos_table',1),(18,'2014_10_12_000018_create_ligas_table',1),(19,'2014_10_12_000019_add_pivot_table_participantes_liga',1),(20,'2014_10_12_000020_alter_table_users_confirm_email',1),(21,'2014_10_12_000021_create_resultado_partidas_table',1),(22,'2014_10_12_000022_create_partidas_table',1),(23,'2014_10_12_000023_alter_table_campeonatos',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participantes_liga`
--

DROP TABLE IF EXISTS `participantes_liga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `participantes_liga` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invocador_id` int(10) unsigned NOT NULL,
  `liga_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `participantes_liga_liga_id_invocador_id_unique` (`liga_id`,`invocador_id`),
  KEY `participantes_liga_invocador_id_foreign` (`invocador_id`),
  CONSTRAINT `participantes_liga_invocador_id_foreign` FOREIGN KEY (`invocador_id`) REFERENCES `users` (`id`),
  CONSTRAINT `participantes_liga_liga_id_foreign` FOREIGN KEY (`liga_id`) REFERENCES `ligas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participantes_liga`
--

LOCK TABLES `participantes_liga` WRITE;
/*!40000 ALTER TABLE `participantes_liga` DISABLE KEYS */;
INSERT INTO `participantes_liga` VALUES (1,1,1,'2019-06-01 06:13:03','2019-06-01 06:13:03'),(2,2,1,'2019-06-01 06:14:01','2019-06-01 06:14:01'),(3,8,1,'2019-06-01 06:25:18','2019-06-01 06:25:18');
/*!40000 ALTER TABLE `participantes_liga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidas`
--

DROP TABLE IF EXISTS `partidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `partidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rodada_id` int(10) unsigned NOT NULL,
  `timea_id` int(10) unsigned NOT NULL,
  `timeb_id` int(10) unsigned NOT NULL,
  `resultado_partida_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partidas_rodada_id_foreign` (`rodada_id`),
  KEY `partidas_timea_id_foreign` (`timea_id`),
  KEY `partidas_timeb_id_foreign` (`timeb_id`),
  KEY `partidas_resultado_partida_id_foreign` (`resultado_partida_id`),
  CONSTRAINT `partidas_resultado_partida_id_foreign` FOREIGN KEY (`resultado_partida_id`) REFERENCES `resultado_partidas` (`id`),
  CONSTRAINT `partidas_rodada_id_foreign` FOREIGN KEY (`rodada_id`) REFERENCES `rodadas` (`id`),
  CONSTRAINT `partidas_timea_id_foreign` FOREIGN KEY (`timea_id`) REFERENCES `equipes` (`id`),
  CONSTRAINT `partidas_timeb_id_foreign` FOREIGN KEY (`timeb_id`) REFERENCES `equipes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas`
--

LOCK TABLES `partidas` WRITE;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;
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
-- Table structure for table `pontuacoes`
--

DROP TABLE IF EXISTS `pontuacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `pontuacoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `atleta_id` int(10) unsigned NOT NULL,
  `acao_id` int(10) unsigned NOT NULL,
  `rodada_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pontuacoes_atleta_id_foreign` (`atleta_id`),
  KEY `pontuacoes_acao_id_foreign` (`acao_id`),
  KEY `pontuacoes_rodada_id_foreign` (`rodada_id`),
  CONSTRAINT `pontuacoes_acao_id_foreign` FOREIGN KEY (`acao_id`) REFERENCES `acoes` (`id`),
  CONSTRAINT `pontuacoes_atleta_id_foreign` FOREIGN KEY (`atleta_id`) REFERENCES `atletas` (`id`),
  CONSTRAINT `pontuacoes_rodada_id_foreign` FOREIGN KEY (`rodada_id`) REFERENCES `rodadas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pontuacoes`
--

LOCK TABLES `pontuacoes` WRITE;
/*!40000 ALTER TABLE `pontuacoes` DISABLE KEYS */;
INSERT INTO `pontuacoes` VALUES (8,5,5,1,1,'2019-06-01 15:41:14','2019-06-01 15:41:14'),(9,3,5,8,1,'2019-06-01 15:41:23','2019-06-01 15:41:23'),(10,7,5,2,1,'2019-06-01 15:41:31','2019-06-01 15:41:31'),(11,300,5,10,1,'2019-06-01 15:43:47','2019-06-01 15:43:47'),(12,30,5,11,1,'2019-06-01 15:44:25','2019-06-01 15:44:25'),(13,15,5,12,1,'2019-06-01 15:44:57','2019-06-01 15:44:57'),(14,1,7,1,1,'2019-06-01 15:46:08','2019-06-01 15:46:08'),(15,13,7,2,1,'2019-06-01 15:46:26','2019-06-01 15:46:26'),(16,2,7,8,1,'2019-06-01 15:46:39','2019-06-01 15:46:39'),(17,10,7,11,1,'2019-06-01 15:47:33','2019-06-01 15:47:33'),(18,20,7,12,1,'2019-06-01 15:47:41','2019-06-01 15:47:41'),(19,80,7,3,1,'2019-06-01 15:47:54','2019-06-01 15:47:54');
/*!40000 ALTER TABLE `pontuacoes` ENABLE KEYS */;
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
  `pontuacao` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campeonato_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regras_pontuacao`
--

LOCK TABLES `regras_pontuacao` WRITE;
/*!40000 ALTER TABLE `regras_pontuacao` DISABLE KEYS */;
INSERT INTO `regras_pontuacao` VALUES (5,1,1,3.00,'2019-06-01 14:56:51','2019-06-01 15:53:48',1),(6,1,4,3.00,'2019-06-01 14:57:00','2019-06-01 15:54:38',1),(7,1,3,3.00,'2019-06-01 14:57:18','2019-06-01 15:53:16',1),(8,8,1,-2.00,'2019-06-01 14:58:17','2019-06-01 15:53:53',1),(9,2,1,1.00,'2019-06-01 14:59:56','2019-06-01 15:54:01',1),(10,2,3,1.00,'2019-06-01 15:00:01','2019-06-01 15:53:23',1),(11,2,4,1.00,'2019-06-01 15:00:07','2019-06-01 15:54:44',1),(12,8,3,-2.00,'2019-06-01 15:03:54','2019-06-01 15:53:29',1),(13,8,4,-2.00,'2019-06-01 15:04:03','2019-06-01 15:54:50',1),(14,10,1,0.10,'2019-06-01 15:06:04','2019-06-01 15:54:05',1),(15,10,3,0.10,'2019-06-01 15:06:21','2019-06-01 15:53:34',1),(16,10,4,0.10,'2019-06-01 15:06:47','2019-06-01 15:54:55',1),(17,11,3,0.50,'2019-06-01 15:22:30','2019-06-01 15:53:38',1),(18,11,1,0.50,'2019-06-01 15:22:38','2019-06-01 15:54:22',1),(19,11,4,0.50,'2019-06-01 15:22:48','2019-06-01 15:55:00',1),(21,1,5,1.00,'2019-06-01 15:28:39','2019-06-01 15:55:11',1),(22,2,5,2.50,'2019-06-01 15:28:52','2019-06-01 15:55:18',1),(23,8,5,-1.00,'2019-06-01 15:29:10','2019-06-01 15:55:25',1),(24,3,5,0.60,'2019-06-01 15:33:28','2019-06-01 15:55:34',1),(25,1,2,4.00,'2019-06-01 15:34:54','2019-06-01 15:52:37',1),(26,8,2,-3.00,'2019-06-01 15:35:15','2019-06-01 15:52:46',1),(27,2,2,1.00,'2019-06-01 15:36:24','2019-06-01 15:52:54',1),(28,10,2,0.10,'2019-06-01 15:36:39','2019-06-01 15:52:57',1),(29,11,2,0.50,'2019-06-01 15:37:07','2019-06-01 15:53:07',1),(30,12,2,1.00,'2019-06-01 15:38:26','2019-06-01 15:53:11',1),(32,12,1,1.00,'2019-06-01 15:38:51','2019-06-01 15:54:28',1),(33,12,3,1.00,'2019-06-01 15:39:00','2019-06-01 15:53:43',1),(34,12,4,1.00,'2019-06-01 15:39:12','2019-06-01 15:55:05',1),(35,12,5,1.00,'2019-06-01 15:39:27','2019-06-01 15:55:49',1);
/*!40000 ALTER TABLE `regras_pontuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultado_partidas`
--

DROP TABLE IF EXISTS `resultado_partidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `resultado_partidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultado_partidas`
--

LOCK TABLES `resultado_partidas` WRITE;
/*!40000 ALTER TABLE `resultado_partidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultado_partidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rodadas`
--

DROP TABLE IF EXISTS `rodadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rodadas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num_rodada` int(11) NOT NULL,
  `descricao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campeonato_id` int(10) unsigned DEFAULT NULL,
  `estado` enum('em_criacao','em_andamento','finalizado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'em_criacao',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rodadas`
--

LOCK TABLES `rodadas` WRITE;
/*!40000 ALTER TABLE `rodadas` DISABLE KEYS */;
INSERT INTO `rodadas` VALUES (1,1,'Fase de Grupos',1,'em_criacao',NULL,NULL,'2019-05-31 23:11:02'),(2,2,'Quartas de Final',1,'em_criacao',NULL,NULL,'2019-05-31 23:11:02'),(3,3,'Semi Finais',1,'em_criacao',NULL,'2019-05-31 18:49:30','2019-05-31 23:11:02'),(4,4,'Finais',1,'em_criacao',NULL,'2019-05-31 18:51:07','2019-05-31 23:11:02');
/*!40000 ALTER TABLE `rodadas` ENABLE KEYS */;
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
  `patrimonio` decimal(8,2) NOT NULL DEFAULT '100.00',
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apelido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmado` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_tipo_usuario_id_foreign` (`tipo_usuario_id`),
  CONSTRAINT `users_tipo_usuario_id_foreign` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'fabio@zleague.com',3,'$2y$10$XQRM3bXKrVLnWQOpz2wjbeDmTrH6BnnQ124k9ZPBIZG4B9QM1eW8y',NULL,NULL,'2019-05-31 09:17:40','2019-06-01 03:22:29','faboka.jpg',0.00,'Fábio','Faboka',1,NULL),(2,'fabio.onofre166@gmail.com',1,'$2y$10$VgLZQwWpG2yaKnQXggZeo.gIicGr1lujEP86sE9NmsueQRZyfWVvu',NULL,NULL,'2019-06-01 04:59:21','2019-06-01 05:08:07','cabelao.jpg',0.00,'Fernando','Perdi a kbça msm',1,''),(8,'s1ahtmoraes@gmail.com',1,'$2y$10$KFh9nKNX8LAhGy5ENlmsROxzZw09UH8R5WOm2SEJPCVx0HYEtwkhy',NULL,NULL,'2019-06-01 06:25:18','2019-06-01 06:34:47',NULL,0.00,'Thais','tha1s',1,'');
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

-- Dump completed on 2019-06-01 11:26:31
