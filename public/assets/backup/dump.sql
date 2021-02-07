-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: coviar
-- ------------------------------------------------------
-- Server version 	5.5.5-10.4.17-MariaDB
-- Date: Thu, 04 Feb 2021 14:12:16 +0100

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `categoria_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `categoria` VALUES (1,'Administrador'),(2,'Establecimiento');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `categoria` with 2 row(s)
--

--
-- Table structure for table `emails_send`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_send` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tag` varchar(255) NOT NULL,
  `emails` longtext NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `id_mail_theme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_send`
--

LOCK TABLES `emails_send` WRITE;
/*!40000 ALTER TABLE `emails_send` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `emails_send` VALUES (16,'Facturacion Coviar - 2021-01-11 12:45:54','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-11','',12),(17,'Facturacion Coviar - 2021-01-12 09 55 13','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-12','',12),(18,'Facturacion Coviar - 2021-01-13 08 13 13','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Facturacion Coviar',12),(19,'Envio de prueba - 2021-01-13 08 17 26','a:0:{}','2021-01-13','Envio de prueba',12),(20,'Envio de prueba - 2021-01-13 08 21 13','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Envio de prueba',12),(21,'Envio de prueba - 2021-01-13 09 17 50','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Envio de prueba',12),(22,'Envio de prueba - 2021-01-13 09 19 41','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Envio de prueba',12),(23,'Envio de prueba - 2021-01-13 09 22 22','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Envio de prueba',12),(24,'Envio de prueba - 2021-01-13 09 26 08','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Envio de prueba',12),(25,'Envio de prueba - 20210113094616','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-13','Envio de prueba',12),(26,'Envio de prueba - 20210114085240','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-14','Envio de prueba',12),(27,'Envio de prueba - 20210114090603','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-14','Envio de prueba',12),(28,'Facturacion Coviar - 20210114121223','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-14','Facturacion Coviar',12),(29,'Facturacion Coviar - 20210114121351','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-14','Facturacion Coviar',12),(30,'Facturacion Coviar - 20210114121428','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-14','Facturacion Coviar',12),(31,'Facturacion Coviar - 20210115082809','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-15','Facturacion Coviar',12),(32,'Envio de prueba - 20210115100329','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-15','Envio de prueba',14),(33,'Envio de prueba - 20210115100435','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-15','Envio de prueba',14),(34,'Envio de prueba - 20210115100549','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-15','Envio de prueba',14),(35,'Envio de prueba - 20210115100932','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-15','Envio de prueba',14),(36,'Envio de prueba - 20210115101850','a:2:{i:0;s:28:\"adriel.bustos@octopia.com.ar\";i:1;s:25:\"adriel.bustos01@gmail.com\";}','2021-01-15','Envio de prueba',14),(37,'Notificacion Anual - 2021-01-19','a:0:{}','2021-01-19','Consulta por pago contado o cuotas. Elaboración 20',0),(38,'Notificacion Anual - 2021-01-19','a:0:{}','2021-01-19','Consulta por pago contado o cuotas. Elaboración 20',0),(39,'Notificacion Anual - 2021-01-19','a:0:{}','2021-01-19','Consulta por pago contado o cuotas. Elaboración 2021',0);
/*!40000 ALTER TABLE `emails_send` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `emails_send` with 24 row(s)
--

--
-- Table structure for table `emails_send_detail`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails_send_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_emails_send` int(10) unsigned NOT NULL,
  `numero_establecimiento` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visto` datetime DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `rebote` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails_send_detail`
--

LOCK TABLES `emails_send_detail` WRITE;
/*!40000 ALTER TABLE `emails_send_detail` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `emails_send_detail` VALUES (7,1,'A70003','adriel.bustos@octopia.com.ar','2021-01-15 16:03:29',NULL,NULL,NULL),(8,1,'A70000','adriel.bustos@octopia.com.ar','2021-01-15 16:03:29',NULL,NULL,NULL),(9,1,'A70000','adriel.bustos01@gmail.com','2021-01-15 16:03:29',NULL,NULL,NULL),(10,35,'A70003','adriel.bustos@octopia.com.ar','2021-01-15 16:55:17',NULL,'Error',' no such tag \"You provided one or more invalid tags: Envio de prueba - 20210115100932\"'),(11,35,'A70000','adriel.bustos@octopia.com.ar','2021-01-15 16:55:17',NULL,'Error',' no such tag \"You provided one or more invalid tags: Envio de prueba - 20210115100932\"'),(12,35,'A70000','adriel.bustos01@gmail.com','2021-01-15 16:55:17',NULL,'Error',' no such tag \"You provided one or more invalid tags: Envio de prueba - 20210115100932\"'),(13,36,'A70003','adriel.bustos@octopia.com.ar','2021-01-15 16:32:22',NULL,'Error',' no such tag \"You provided one or more invalid tags: Envio de prueba - 20210115101850\"'),(14,36,'A70000','adriel.bustos@octopia.com.ar','2021-01-15 16:32:22',NULL,'Error',' no such tag \"You provided one or more invalid tags: Envio de prueba - 20210115101850\"'),(15,36,'A70000','adriel.bustos01@gmail.com','2021-01-15 16:40:31',NULL,'Error',' no such tag \"You provided one or more invalid tags: Envio de prueba - 20210115101850\"');
/*!40000 ALTER TABLE `emails_send_detail` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `emails_send_detail` with 9 row(s)
--

--
-- Table structure for table `establecimiento`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `numero_establecimiento` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `establecimiento` VALUES (1,'A70003',NULL,NULL,NULL),(2,'A70000',NULL,NULL,NULL),(3,'A89431',NULL,NULL,NULL),(9,'A70001',NULL,NULL,NULL),(51,'K72907',NULL,NULL,NULL),(52,'L80001',NULL,NULL,NULL),(53,'K87529',NULL,NULL,NULL),(54,'A70002',NULL,NULL,NULL),(55,'A70004',NULL,NULL,NULL),(56,'A70005',NULL,NULL,NULL),(57,'A70006',NULL,NULL,NULL),(58,'A70007',NULL,NULL,NULL),(59,'A70008',NULL,NULL,NULL),(60,'A70009',NULL,NULL,NULL),(61,'A70010',NULL,NULL,NULL),(62,'A70011',NULL,NULL,NULL),(63,'A70012',NULL,NULL,NULL),(64,'A70013',NULL,NULL,NULL),(65,'A70014',NULL,NULL,NULL),(66,'A70015',NULL,NULL,NULL),(67,'A70016',NULL,NULL,NULL),(68,'A70017',NULL,NULL,NULL),(69,'A70018',NULL,NULL,NULL),(70,'A70019',NULL,NULL,NULL),(71,'A70020',NULL,NULL,NULL),(72,'A70021',NULL,NULL,NULL),(73,'A70022',NULL,NULL,NULL),(74,'A70023',NULL,NULL,NULL),(75,'A70024',NULL,NULL,NULL),(76,'A70025',NULL,NULL,NULL);
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `establecimiento` with 30 row(s)
--

--
-- Table structure for table `establecimiento_informe_anual`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento_informe_anual` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pers_nuri` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nro_inv` varchar(255) CHARACTER SET utf8 NOT NULL,
  `persona` varchar(255) CHARACTER SET utf8 NOT NULL,
  `total` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `importe` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pago_contado` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pago_10_cuotas_de` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tipo_pago_id` int(10) DEFAULT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `id_emails_send` int(10) unsigned DEFAULT NULL,
  `id_envio_mandril` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rebote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pers_nuri` (`pers_nuri`),
  KEY `nro_inv` (`nro_inv`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_informe_anual`
--

LOCK TABLES `establecimiento_informe_anual` WRITE;
/*!40000 ALTER TABLE `establecimiento_informe_anual` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `establecimiento_informe_anual` VALUES (1,'59745','A70003','Adriel Bustos','89910','adriel.bustos@octopia.com.ar','4,572.55','4,115.30','457.26',2,'2021-01-19 13:16:11',NULL,'d9db958176914a119750d2082238c334','sent',NULL),(2,'59745','A70003','Juan Castorino','89910','juan.castorino@octopia.com.ar','4,572.55','4,115.30','457.26',NULL,'2021-01-19 13:16:11',NULL,'d19f6ad799824f00b4b47bb6e1be9299','sent',NULL),(3,'59745','A70003','Adriel Bustos','89910','adriel.bustos01@gmail.com','4,572.55','4,115.30','457.26',NULL,'2021-01-19 13:16:11',NULL,'e0d063e13c024d79a1b74a39c14eb17d','rejected','recipient-domain-mismatch');
/*!40000 ALTER TABLE `establecimiento_informe_anual` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `establecimiento_informe_anual` with 3 row(s)
--

--
-- Table structure for table `mail_theme`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `asunto` varchar(64) NOT NULL,
  `theme` text DEFAULT NULL,
  `directorio` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mail_tipo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_theme`
--

LOCK TABLES `mail_theme` WRITE;
/*!40000 ALTER TABLE `mail_theme` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mail_theme` VALUES (12,'Coviar Noviembre 2020','Facturacion Coviar','<p>\r\n	Estimado/a, N&uacute;mero de INV: [NUM-ESTABLECIMIENTO] le enviamos adjunto su boleto de pago del mes de Febrero de 2016 corresponde a los fraccionamientos de Noviembre de 2015 y la sexta cuota de Elaboraci&oacute;n 2015. Su vencimiento actual es el 29/02/2016. En caso de efectuar el pago por transferencia o dep&oacute;sito bancario favor de enviarnos copia del comprobante contestando el mail e indicando el n&uacute;mero de INV del establecimiento al que est&aacute;n pagando. Nos despedimos de Ud muy atentamente. Cualquier consulta puede comunicarse a los siguientes telefonos: Mendoza 0261-4203877 0261-4290407 0261-4256857 San Juan 0264 -4200291</p>\r\n','Noviembre 2020',NULL,NULL,NULL,0),(13,'Coviar Diciembre 2020','Facturacion diciembre','Test','Diciembre 2020',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `mail_theme` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mail_theme` with 2 row(s)
--

--
-- Table structure for table `mail_tipo`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_tipo`
--

LOCK TABLES `mail_tipo` WRITE;
/*!40000 ALTER TABLE `mail_tipo` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `mail_tipo` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `mail_tipo` with 0 row(s)
--

--
-- Table structure for table `menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  `url` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `target` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `orden` int(2) DEFAULT NULL,
  `menu` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menu` VALUES (1,'Inicio',NULL,NULL,'Login/welcome','_self',1,1,NULL,NULL,NULL),(2,'Usuarios',NULL,NULL,'Usuarios/listado','_self',NULL,0,NULL,NULL,NULL),(3,'Establecimientos',NULL,NULL,'establecimientos/listado','_self',NULL,0,NULL,NULL,NULL),(4,'Mails',NULL,NULL,'Mail/listado','_self',NULL,0,NULL,NULL,NULL),(5,'Gestion de establecimientos',3,NULL,'establecimientos/listado','_self',NULL,1,NULL,NULL,NULL),(6,'Importar establecimientos',3,NULL,'establecimientos/importar','_self',NULL,1,NULL,NULL,NULL),(7,'Listado por establecimientos',3,NULL,'establecimientos/listadoEstablecimiento','_self',NULL,0,NULL,NULL,NULL),(8,'Desconectarse',NULL,NULL,'login/logout','_self',NULL,1,NULL,NULL,NULL),(9,'Mails',4,NULL,'Mail/listado','_self',NULL,0,NULL,NULL,NULL),(10,'Detalles de envios',4,NULL,'Mail/listado','_self',NULL,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menu` with 10 row(s)
--

--
-- Table structure for table `tipo_pago`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_pago` (
  `id` int(10) unsigned NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_pago`
--

LOCK TABLES `tipo_pago` WRITE;
/*!40000 ALTER TABLE `tipo_pago` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `tipo_pago` VALUES (1,'Pago Contado'),(2,'Pago en Cuotas');
/*!40000 ALTER TABLE `tipo_pago` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `tipo_pago` with 2 row(s)
--

--
-- Table structure for table `usuario`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_id` bigint(20) NOT NULL,
  `modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `activo` tinyint(1) NOT NULL,
  `fecha_alta` datetime DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cuit` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usuario` VALUES (1,'admin','admin',1,'2020-09-16 09:06:46',1,'2017-07-04 00:00:00','ApellidoAdminsxz','NombreAdmin','juan.castorino@octopia.com.ar','30708766514','razon social  admin',NULL,NULL,NULL),(324,'adriel.bustos@octopia.com.ar','63f9a6fa52e93efaaf35c044ef27377f',2,'2020-12-17 17:47:29',1,'2020-12-17 14:47:29','','','adriel.bustos@octopia.com.ar','','',NULL,NULL,NULL),(325,'juan.octopia@gmail.com','a7eaecaae69fbdb84849c9b6b0df85f0',2,'2020-12-17 17:47:29',1,'2020-12-17 14:47:29','','','juan.octopia@gmail.com','','',NULL,NULL,NULL),(326,'marcio.fuentes@octopia.com.ar','20458bce076189f050f5f0d84da36ff2',2,'2020-12-17 17:47:29',1,'2020-12-17 14:47:29','','','marcio.fuentes@octopia.com.ar','','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario` with 4 row(s)
--

--
-- Table structure for table `usuario_establecimiento`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_establecimiento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  `establecimiento_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_establecimiento`
--

LOCK TABLES `usuario_establecimiento` WRITE;
/*!40000 ALTER TABLE `usuario_establecimiento` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usuario_establecimiento` VALUES (1,324,2),(2,325,2),(3,1,2),(4,326,2),(5,324,9),(6,325,9),(7,1,9),(8,324,54),(9,325,54),(10,1,54),(11,324,1),(12,325,1),(13,1,1),(14,324,55),(15,325,55),(16,1,55),(17,324,56),(18,325,56),(19,1,56),(20,324,57),(21,325,57),(22,1,57),(23,324,58),(24,325,58),(25,1,58),(26,324,59),(27,325,59),(28,1,59),(29,324,60),(30,325,60),(31,1,60),(32,324,61),(33,325,61),(34,1,61),(35,324,62),(36,325,62),(37,1,62),(38,324,63),(39,325,63),(40,1,63),(41,324,64),(42,325,64),(43,1,64),(44,324,65),(45,325,65),(46,1,65),(47,324,66),(48,325,66),(49,1,66),(50,324,67),(51,325,67),(52,1,67),(53,324,68),(54,325,68),(55,1,68),(56,324,69),(57,325,69),(58,1,69),(59,324,70),(60,325,70),(61,1,70),(62,324,71),(63,325,71),(64,1,71),(65,324,72),(66,325,72),(67,1,72),(68,324,73),(69,325,73),(70,1,73),(71,324,74),(72,325,74),(73,1,74),(74,324,75),(75,325,75),(76,1,75),(77,324,76),(78,325,76),(79,1,76);
/*!40000 ALTER TABLE `usuario_establecimiento` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario_establecimiento` with 79 row(s)
--

--
-- Stand-In structure for view `listado_establecimientos`
--

CREATE TABLE IF NOT EXISTS `listado_establecimientos` (
`id` bigint(20)
,`numero_establecimiento` varchar(255)
,`email` varchar(255)
);
--
-- View structure for view `listado_establecimientos`
--

DROP TABLE IF EXISTS `listado_establecimientos`;
/*!50001 DROP VIEW IF EXISTS `listado_establecimientos`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `listado_establecimientos` AS (select `usuario_establecimiento`.`id` AS `id`,`establecimiento`.`numero_establecimiento` AS `numero_establecimiento`,`usuario`.`email` AS `email` from ((`establecimiento` join `usuario_establecimiento` on(`establecimiento`.`id` = `usuario_establecimiento`.`establecimiento_id`)) join `usuario` on(`usuario`.`id` = `usuario_establecimiento`.`usuario_id`)) where `usuario`.`categoria_id` = 2 group by `usuario`.`id`,`establecimiento`.`id`) */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Thu, 04 Feb 2021 14:12:16 +0100
