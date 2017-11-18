/*
SQLyog Community v11.31 (32 bit)
MySQL - 5.7.14 : Database - fet_homologacion
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `adendas` */

CREATE TABLE `adendas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `solicitud_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adendas_solicitudes1_idx` (`solicitud_id`),
  KEY `fk_adendas_usuario_id` (`usuario_id`),
  CONSTRAINT `fk_adendas_solicitudes1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_adendas_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `adendas` */

LOCK TABLES `adendas` WRITE;

insert  into `adendas`(`id`,`codigo`,`solicitud_id`,`usuario_id`,`nombre`,`descripcion`,`archivo`,`created_at`,`updated_at`,`estado`) values (29,'HFET29',61,21,'Adenda 1','Descripcion adenda 1','','2017-10-21 05:21:05','2017-10-21 06:30:31',0),(30,'HFET30',61,21,'Adenda 2','Descripcion adenda 2','','2017-10-21 06:14:21','2017-10-21 06:30:40',0),(31,'HFET31',61,21,'Adenda 4','Descripcion adenda 4','','2017-10-21 06:15:50','2017-10-21 06:30:47',0),(32,'HFET32',66,21,'Adenda 1','Descripción  1','','2017-10-24 03:28:15','2017-10-25 06:23:41',0),(33,'HFET33',67,21,'Adenda 1','Adenda 1','00Y94nZTLqFE9ybacDvG5Jsjt8OMqUvBSKaLOmOc.pdf','2017-10-27 02:08:59','2017-10-27 06:09:55',1),(34,'HFET34',67,21,'Adenda 2','Adenda 2','mI6ERpTeej0hTQsKQQIuMSEp8sMUWp55jCtl7mZQ.pdf','2017-10-27 04:16:14','2017-10-27 07:21:15',1),(35,'HFET35',67,21,'Adenda 3','Adenda 3','n3s8iQIWIfUxq66vEHCOhRAGBmQaDCRp9JSfbWGX.pdf','2017-10-27 07:21:40','2017-10-27 07:22:35',1),(36,'HFET36',68,21,'Homologacion 1','Homologacion 1','','2017-10-27 21:57:44','2017-10-27 21:57:47',0),(37,'HFET37',69,21,'Homologacion 1','Homologacion 1','KzMqT0ZvCdc70qUbutRMRTW5iWQQfuhsFfulNJMM.pdf','2017-10-27 22:12:15','2017-10-27 22:17:14',1),(38,'HFET38',69,21,'Homologacion 2','Homologacion 2','','2017-10-27 22:17:42','2017-10-27 22:17:42',0);

UNLOCK TABLES;

/*Table structure for table `asig_progra` */

CREATE TABLE `asig_progra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asignatura_id` int(10) unsigned NOT NULL,
  `programa_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asig_progra_asignatura_id_foreign` (`asignatura_id`),
  KEY `asig_progra_programa_id_foreign` (`programa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `asig_progra` */

LOCK TABLES `asig_progra` WRITE;

insert  into `asig_progra`(`id`,`asignatura_id`,`programa_id`,`created_at`,`updated_at`) values (2,1,1,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(3,2,1,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(4,3,1,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(5,4,1,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(6,5,1,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(7,6,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(8,7,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(9,8,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(10,9,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(11,10,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(12,11,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(13,12,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(14,13,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(15,14,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(16,15,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(17,16,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(18,17,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(19,18,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(20,19,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(21,20,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(22,21,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(23,22,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(24,23,1,'2017-10-18 15:44:29','2017-10-18 15:44:29'),(25,24,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(26,25,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(27,26,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(28,27,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(29,28,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(30,29,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(31,30,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(32,31,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(33,32,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(34,33,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(35,34,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(36,35,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(37,36,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(38,37,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(39,38,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(40,39,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(41,40,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(42,41,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(43,42,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(44,43,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(45,44,1,'2017-10-18 15:44:30','2017-10-18 15:44:30'),(46,45,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(47,46,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(48,47,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(49,48,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(50,49,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(51,50,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(52,51,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(53,52,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(54,53,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(55,54,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(56,55,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(57,56,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(58,57,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(59,58,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(60,59,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(61,60,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(62,61,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(63,62,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(64,63,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(65,64,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(66,65,1,'2017-10-18 15:44:31','2017-10-18 15:44:31'),(67,66,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(68,67,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(69,68,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(70,69,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(71,70,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(72,71,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(73,72,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(74,73,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(75,74,1,'2017-10-18 15:44:32','2017-10-18 15:44:32'),(76,75,1,'2017-10-18 15:44:32','2017-10-18 15:44:32');

UNLOCK TABLES;

/*Table structure for table `asignaturas` */

CREATE TABLE `asignaturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cog_asignatura` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `semestre` int(11) NOT NULL,
  `creditos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `asignaturas` */

LOCK TABLES `asignaturas` WRITE;

insert  into `asignaturas`(`id`,`cog_asignatura`,`nombre`,`semestre`,`creditos`,`created_at`,`updated_at`) values (1,'SOF1-02','ARQUITECTURA DE COMPUTADORES',1,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(2,'SOF1-04','CONSTITUCIÓN POLÍTICA',1,1,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(3,'SOF1-05','CULTURA AMBIENTAL',1,1,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(4,'SOF1-14','INGLÉS I',1,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(5,'SOF1-18','INTRODUCCIÓN A LA INFORMÁTICA',1,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(6,'SOF1-20','LEGISLACIÓN INFORMÁTICA',1,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(7,'SOF1-23','LIDERAZGO Y EMPRENDIMIENTO',1,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(8,'SOF1-24','LÓGICA MATEMÁTICA',1,3,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(9,'SOF1-31','TÉCNICA DE EXPRESIÓN ORAL ',1,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(10,'SOF1-06','DIAGRAMACIÓN Y ALGORITMO',2,3,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(11,'SOF1-08','ENSAMBLE Y MANTENIMIENTO DE COMPUTADORES I',2,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(12,'SOF1-12','FÍSICA MECÁNICA',2,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(13,'SOF1-15','INGLÉS II',2,2,'2017-10-18 15:44:25','2017-10-18 15:44:25'),(14,'SOF1-25','MATEMÁTICA FUNDAMENTAL',2,3,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(15,'SOF1-28','SISTEMAS OPERATIVOS I (WINDOWS)',2,3,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(16,'SOF1-30','TÉCNICA DE EXPRESIÓN ESCRITA',2,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(17,'SOF1-01','ALGEBRA LINEAL',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(18,'SOF1-33','ELECTIVA I',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(19,'SOF1-07','ELECTRÓNICA BÁSICA',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(20,'SOF1-09','LENGUAJE C (ENSAMBLE Y MANTENIMIENTO DE COMPUTADORES II)',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(21,'SOF1-11','ESTRUCTURA DE DATOS ',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(22,'SOF1-16','INGLÉS III',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(23,'SOF1-19','INTRODUCCIÓN A LAS BASES DE DATOS',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(24,'SOF1-21','LENGUAJE DE PROGRAMACIÓN I',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(25,'SOF1-29','SISTEMAS OPERATIVOS II (LINUX)',3,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(26,'SOF1-03','CALCULO DIFERENCIAL',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(27,'SOF1-32','ELECTIVA DE FORMACIÓN COMPLEMENTARIA I',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(28,'SOF1-34','ELECTIVA II',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(29,'SOF1-10','ESTADÍSTICA ',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(30,'SOF1-13','FUNDAMENTOS DE INVESTIGACIÓN',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(31,'SOF1-17','INGLÉS IV',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(32,'SOF1-22','LENGUAJE DE PROGRAMACIÓN II',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(33,'SOF1-26','MODELADO DE BASES DE DATOS ',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(34,'SOF1-27','REDES Y COMUNICACIONES I',4,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(35,'SOF2-35','ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN',5,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(36,'SOF2-36','ANÁLISIS Y DISEÑO DE SISTEMAS DE INFORMACIÓN',5,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(37,'SOF2-37','CALCULO INTEGRAL',5,3,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(38,'SOF2-38','ELECTIVA TECNOLÓGICA I',5,2,'2017-10-18 15:44:26','2017-10-18 15:44:26'),(39,'SOF2-42','INGLÉS V',5,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(40,'SOF2-44','MOTORES DE BASES DE DATOS',5,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(41,'SOF2-72','PROBABILIDAD',5,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(42,'SOF2-45','REDES Y COMUNICACIONES II',5,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(43,'SOF2-73','ECUACIONES DIFERENCIALES',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(44,'SOF2-39','ELECTIVA TECNOLÓGICA II',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(45,'SOF2-40','GESTIÓN ADMINISTRATIVA (PLANEACIÓN Y ORGANIZACIÓN)',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(46,'SOF2-41','INGENIERÍA DE SOFTWARE I',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(47,'SOF2-74','INVESTIGACION DE OPERACIONES',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(48,'SOF2-43','LENGUAJE PROGRAMACIÓN III',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(49,'SOF2-46','SERVIDORES Y SERVICIOS',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(50,'SOF2-47','TEORÍA GENERAL DE SISTEMAS',6,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(51,'SOF3-55','ÉTICA PROFESIONAL',7,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(52,'SOF3-56','FORMULACIÓN Y EVALUACIÓN DE PROYECTOS',7,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(53,'SOF3-12','GESTIÓN ADMINISTRATIVA II (DIRECCIÓN – TALENTO HUMANO)',7,3,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(54,'SOF3-59','INGENIERÍA DE SOFTWARE II',7,3,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(55,'SOF3-63','MATEMÁTICAS ESPECIALES',7,3,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(56,'SOF3-66','SEGURIDAD INFORMÁTICA',7,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(57,'SOF3-68','SISTEMAS DISTRIBUIDOS',7,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(58,'SOF3-71','TELEMÁTICA',7,2,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(59,'SOF3-48','ANÁLISIS NUMÉRICO',8,3,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(60,'SOF3-49','ARQUITECTURA DE SOFTWARE',8,3,'2017-10-18 15:44:27','2017-10-18 15:44:27'),(61,'SOF3-52','ELECTIVA PROFESIONAL I',8,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(62,'SOF3-62','MATEMÁTICAS DISCRETAS',8,3,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(63,'SOF3-65','PROGRAMACIÓN AVANZADA',8,3,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(64,'SOF3-69','SISTEMAS EXPERTOS',8,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(65,'SOF3-50','AUDITORÍA DE SISTEMAS',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(66,'SOF3-51','ECONOMÍA PARA INGENIEROS',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(67,'SOF3-53','ELECTIVA PROFESIONAL II',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(68,'SOF3-57','GERENCIA DE PROYECTOS SISTEMÁTICOS',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(69,'SOF3-60','INTELIGENCIA ARTIFICIAL',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(70,'SOF3-61','INVESTIGACIÓN E INNOVACIÓN TECNOLÓGICA',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(71,'SOF3-67','SIMULACIÓN',9,3,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(72,'SOF3-70','TELECOMUNICACIONES',9,3,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(73,'SOF3-54','ELECTIVA PROFESIONAL III',9,2,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(74,'SOF3-64','PRÁCTICA PROFESIONAL',9,10,'2017-10-18 15:44:28','2017-10-18 15:44:28'),(75,'','TRABAJO DE GRADO',9,6,'2017-10-18 15:44:28','2017-10-18 15:44:28');

UNLOCK TABLES;

/*Table structure for table `estudios` */

CREATE TABLE `estudios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_estudio_id` int(10) unsigned NOT NULL,
  `solicitud_id` int(10) unsigned NOT NULL,
  `nombre_institucion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_carrera` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_archivo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Estudios_Tipo_Estudio1_idx` (`tipo_estudio_id`),
  KEY `fk_estudios_solicitud1_idx` (`solicitud_id`),
  CONSTRAINT `fk_Estudios_Tipo_Estudio1` FOREIGN KEY (`tipo_estudio_id`) REFERENCES `tipos_estudios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_estudios_solicitud1` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estudios` */

LOCK TABLES `estudios` WRITE;

insert  into `estudios`(`id`,`tipo_estudio_id`,`solicitud_id`,`nombre_institucion`,`nombre_carrera`,`nombre_archivo`,`created_at`,`updated_at`) values (1,2,41,'Platzi','Angular 2','m7R01jG88Sfo1bAi7buhNrkuZJAidrNqB8yVTCIL.pdf','2017-10-18 21:05:20','2017-10-18 21:05:20'),(2,4,42,'Sena','Adsi','arCyZbzjuwAg7TeJOx7j0rMVmdzypFQjrhdbkhu6.pdf','2017-10-18 21:36:12','2017-10-18 21:36:12'),(3,1,43,'Laravel 5.4','Taller','URILfqyblRSXiVfARMGCWHjZvfcCRd9gnu0NpxQS.pdf','2017-10-18 22:20:38','2017-10-18 22:20:38'),(4,3,61,'Sena','Mantenimiento de Computo','vbC2IYIfwOu8U6hFg7IgxJxTQTSWd4IcW4hQsnNE.pdf','2017-10-19 20:43:55','2017-10-19 20:43:55'),(5,4,61,'Universidad Surcolombiana','Desarrollo de software','5YZCdrgYiBPZS4SyoyrjSZN8P1BwCsj6Pnbax3tG.pdf','2017-10-19 20:43:55','2017-10-19 20:43:55'),(8,6,65,'Universidad nacional','Ingeniería de Sotware','j01znd5G7pBMxsLgG2bzXOgd42rXqeHYplfSCix6.pdf','2017-10-19 22:03:19','2017-10-19 22:03:19'),(9,5,66,'adasdsad','asddadsd','wu1NZ6mm214wkQkbDXdxq0PFvPyJ11pPBgD2teLw.pdf','2017-10-19 22:24:39','2017-10-19 22:24:39'),(10,3,67,'Sena','Desarrollo de software','fIcZk2ugW8KrFXOghCD9YENZkLqcta2laevc6ijC.pdf','2017-10-27 02:01:52','2017-10-27 02:01:52'),(11,4,68,'Sena','Desarrollo de software','ozfrqiw7DrIuNNS4PsLjS2k6yJJ3UCXO3FVMdPJQ.pdf','2017-10-27 21:56:42','2017-10-27 21:56:42'),(12,4,69,'Sena','Desarrollo de software','NKee2CVCiv1JpXr2QeDcKmJLDP0qm3qNA3JObHiD.pdf','2017-10-27 22:10:18','2017-10-27 22:10:18');

UNLOCK TABLES;

/*Table structure for table `homologaciones` */

CREATE TABLE `homologaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adendas_id` int(10) unsigned NOT NULL,
  `asig_progra_id` int(10) unsigned NOT NULL,
  `nota` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_homologaciones_adendas1_idx` (`adendas_id`),
  KEY `fk_homologaciones_asig_progra1_idx` (`asig_progra_id`),
  CONSTRAINT `fk_homologaciones_adendas1` FOREIGN KEY (`adendas_id`) REFERENCES `adendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_homologaciones_asig_progra1` FOREIGN KEY (`asig_progra_id`) REFERENCES `asig_progra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `homologaciones` */

LOCK TABLES `homologaciones` WRITE;

insert  into `homologaciones`(`id`,`adendas_id`,`asig_progra_id`,`nota`,`created_at`,`updated_at`) values (36,29,5,'1','2017-10-21 05:33:28','2017-10-21 05:33:28'),(37,29,32,'4','2017-10-21 05:33:29','2017-10-21 05:33:31'),(38,29,40,'5','2017-10-21 05:33:34','2017-10-21 05:43:17'),(39,29,23,'3','2017-10-21 05:33:36','2017-10-21 05:40:32'),(40,29,14,'2','2017-10-21 05:33:40','2017-10-21 05:33:40'),(41,31,50,'1','2017-10-21 21:42:46','2017-10-21 21:42:46'),(42,31,23,'3','2017-10-21 21:42:47','2017-10-21 21:42:47'),(43,31,60,'3','2017-10-21 21:42:48','2017-10-21 21:42:48'),(44,31,33,'5','2017-10-21 21:42:51','2017-10-21 21:42:51'),(45,31,70,'4','2017-10-21 21:42:52','2017-10-21 21:42:52'),(46,31,6,'3','2017-10-21 21:42:57','2017-10-21 21:42:57'),(47,31,43,'2','2017-10-21 21:42:58','2017-10-21 21:42:58'),(48,31,16,'5','2017-10-21 21:42:59','2017-10-21 21:42:59'),(49,31,53,'5','2017-10-21 21:43:00','2017-10-23 16:28:53'),(50,31,26,'4.5','2017-10-21 21:43:03','2017-10-21 21:43:03'),(51,32,50,'5','2017-10-24 03:28:31','2017-10-24 03:28:31'),(52,32,23,'4.5','2017-10-24 03:28:34','2017-10-26 21:28:46'),(53,32,60,'4','2017-10-24 03:28:45','2017-10-24 03:28:45'),(54,32,33,'4.5','2017-10-24 03:28:53','2017-10-24 03:28:53'),(55,32,70,'4.2','2017-10-24 03:28:57','2017-10-24 03:28:57'),(56,32,6,'2','2017-10-24 03:29:04','2017-10-24 03:29:04'),(57,32,43,'5','2017-10-24 03:29:10','2017-10-24 03:29:10'),(58,32,40,'4.5','2017-10-26 21:28:48','2017-10-26 21:28:48'),(59,32,5,'4.5','2017-10-26 21:28:49','2017-10-26 21:28:49'),(60,32,32,'4.5','2017-10-26 21:28:51','2017-10-26 21:28:51'),(61,32,14,'4.5','2017-10-26 21:28:55','2017-10-26 21:28:55'),(62,32,56,'4.5','2017-10-26 21:29:15','2017-10-26 21:29:15'),(63,32,63,'4.5','2017-10-26 21:29:17','2017-10-26 21:29:17'),(64,32,18,'4.5','2017-10-26 21:29:30','2017-10-26 21:29:30'),(65,33,50,'4.5','2017-10-27 02:09:32','2017-10-27 02:09:41'),(66,33,23,'3.80','2017-10-27 02:09:45','2017-10-27 02:09:45'),(67,33,60,'4','2017-10-27 02:10:06','2017-10-27 02:10:06'),(68,35,50,'1','2017-10-27 07:21:48','2017-10-27 07:25:08'),(69,36,50,'2','2017-10-27 21:57:57','2017-10-27 21:57:58'),(70,36,23,'5','2017-10-27 21:58:04','2017-10-27 21:58:04'),(71,36,60,'4.5','2017-10-27 21:58:25','2017-10-27 21:58:25'),(72,37,50,'4.5','2017-10-27 22:12:37','2017-10-27 22:12:37'),(73,37,23,'4.5','2017-10-27 22:12:40','2017-10-27 22:12:40'),(74,37,60,'4.5','2017-10-27 22:12:43','2017-10-27 22:12:43'),(75,38,50,'4','2017-10-27 22:17:52','2017-10-27 22:17:52'),(76,38,60,'4','2017-10-27 22:17:53','2017-10-27 22:17:53'),(77,38,33,'4','2017-10-27 22:17:54','2017-10-27 22:17:54'),(78,38,6,'4','2017-10-27 22:17:55','2017-10-27 22:17:55'),(79,38,70,'4','2017-10-27 22:17:55','2017-10-27 22:17:55'),(80,38,43,'4','2017-10-27 22:17:55','2017-10-27 22:17:55'),(81,38,16,'4','2017-10-27 22:17:55','2017-10-27 22:17:55');

UNLOCK TABLES;

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `migrations` */

LOCK TABLES `migrations` WRITE;

insert  into `migrations`(`id`,`migration`,`batch`) values (19,'2017_10_07_233044_create_adendas_table',1),(20,'2017_10_07_233044_create_asig_progra_table',1),(21,'2017_10_07_233044_create_asignaturas_table',1),(22,'2017_10_07_233044_create_estudios_table',1),(23,'2017_10_07_233044_create_homologaciones_table',1),(24,'2017_10_07_233044_create_password_resets_table',1),(25,'2017_10_07_233044_create_personas_table',1),(26,'2017_10_07_233044_create_programas_table',1),(27,'2017_10_07_233044_create_solicitudes_table',1),(28,'2017_10_07_233044_create_tipo_documentos_table',1),(29,'2017_10_07_233044_create_tipo_estudios_table',1),(30,'2017_10_07_233044_create_users_table',1),(31,'2017_10_07_233046_add_foreign_keys_to_adendas_table',1),(32,'2017_10_07_233046_add_foreign_keys_to_estudios_table',1),(33,'2017_10_07_233046_add_foreign_keys_to_homologaciones_table',1),(34,'2017_10_08_012518_create_tipos_usuario_table',1),(35,'2017_10_08_015826_add_foreign_keys_to_users_table',1),(36,'2017_10_16_233958_add_foreign_keys_to_programas_table',1),(38,'2017_10_18_052844_alter_table_estudios',2),(40,'2017_10_18_195045_alter_table_solicitudes',3),(44,'2017_10_18_200634_normalizar_db_homologaciones',4),(45,'2017_10_19_221344_add_column_personas_table',5),(54,'2017_10_20_041727_add_column_adendas_table',6);

UNLOCK TABLES;

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `password_resets` */

LOCK TABLES `password_resets` WRITE;

UNLOCK TABLES;

/*Table structure for table `personas` */

CREATE TABLE `personas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipoIdent_id` int(11) NOT NULL,
  `numIdent` bigint(20) NOT NULL,
  `telefono` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `genero` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `personas` */

LOCK TABLES `personas` WRITE;

insert  into `personas`(`id`,`nombres`,`apellidos`,`tipoIdent_id`,`numIdent`,`telefono`,`direccion`,`fechaNac`,`genero`,`created_at`,`updated_at`) values (1,'Isadore Quitzon','Reynolds',3,353272578,'+1982702021876','','2003-09-11','M','2017-10-18 04:49:15','2017-10-18 04:49:15'),(2,'Brenda Mante','Pouros',3,967696065,'+4214205474433','','1972-03-18','M','2017-10-18 04:49:15','2017-10-18 04:49:15'),(3,'Nash Reichel','Stehr',3,925304412,'+4343439122915','','1970-06-08','M','2017-10-18 04:49:15','2017-10-18 04:49:15'),(4,'Prof. Jarred Muller','Ledner',3,583213899,'+1153632593794','','1995-03-02','M','2017-10-18 04:49:16','2017-10-18 04:49:16'),(5,'Prof. Marquis Stoltenberg Jr.','Zemlak',3,175136319,'+8876333905063','','1994-11-11','M','2017-10-18 04:49:21','2017-10-18 04:49:21'),(6,'Horacio Krajcik','Friesen',3,657387963,'+9285128293365','','1985-02-13','M','2017-10-18 04:49:21','2017-10-18 04:49:21'),(7,'Bria O\'Connell','Tremblay',3,387670299,'+1142861487973','','1973-02-08','M','2017-10-18 04:49:21','2017-10-18 04:49:21'),(8,'Jillian Mayert I','Lindgren',3,816820654,'+3071478340227','','1979-03-21','M','2017-10-18 04:49:22','2017-10-18 04:49:22'),(9,'Carolanne Goodwin','Fay',3,324683877,'+1770383005361','','2005-10-05','M','2017-10-18 04:49:22','2017-10-18 04:49:22'),(10,'Pink Donnelly','King',3,283147201,'+5561747460256','','2016-05-10','M','2017-10-18 04:49:22','2017-10-18 04:49:22'),(11,'Tara Gaylord PhD','Marquardt',3,846674198,'+2644038793235','','1998-12-09','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(12,'Raegan Kohler Jr.','Mueller',3,902696883,'+1572175263420','','2016-11-01','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(13,'Ms. Cassidy Moen II','Hansen',3,829103418,'+4244092252389','','1980-10-12','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(14,'Mozell Stracke','McKenzie',3,566922928,'+8274742140534','','1985-01-18','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(15,'Prof. Wyatt Braun DVM','Buckridge',3,622678577,'+3711187487663','','2005-11-19','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(16,'Andres Huels','Hilll',3,773663653,'+8149278890682','','2006-02-12','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(17,'Dr. Claude Bernhard','Robel',3,193437450,'+7268093003503','','1993-09-08','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(18,'Cheyenne Batz IV','Boehm',3,507433155,'+3703169187207','','1989-09-14','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(19,'Keenan Gorczany','Kuvalis',3,801078070,'+5607762880473','','2002-10-30','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(20,'Edwardo Balistreri','Beahan',3,607962480,'+5065284702666','','1993-04-18','M','2017-10-18 04:49:31','2017-10-18 04:49:31'),(21,'Gustavo Adolfo','Polania Ardila',3,1075297926,'3184860672','CALL 4 # 2 - 36 EL jUNCAL','1996-07-14','M','2017-10-18 04:51:15','2017-10-18 04:51:15'),(22,'Miguel','Antonio',3,0,'','','1900-01-01','','2017-10-19 22:16:01','2017-10-19 22:16:01');

UNLOCK TABLES;

/*Table structure for table `programas` */

CREATE TABLE `programas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `jefe_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_programa_user_id` (`jefe_id`),
  CONSTRAINT `fk_programa_user_id` FOREIGN KEY (`jefe_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `programas` */

LOCK TABLES `programas` WRITE;

insert  into `programas`(`id`,`nombre`,`jefe_id`,`created_at`,`updated_at`) values (1,'Ingeniería de Software',21,'2017-10-18 15:44:25','2017-10-18 15:44:25');

UNLOCK TABLES;

/*Table structure for table `solicitudes` */

CREATE TABLE `solicitudes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `programa_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `solicitudes` */

LOCK TABLES `solicitudes` WRITE;

insert  into `solicitudes`(`id`,`usuario_id`,`programa_id`,`estado`,`created_at`,`updated_at`) values (41,20,1,0,'2017-10-01 21:05:19','2017-10-18 19:44:17'),(42,19,1,0,'2017-10-02 21:36:11','2017-10-18 19:44:17'),(43,1,1,0,'2017-10-03 22:20:37','2017-10-18 19:44:17'),(61,18,1,0,'2017-10-19 20:43:54','2017-10-19 20:43:54'),(65,17,1,0,'2017-10-19 22:03:19','2017-10-19 22:03:19'),(66,16,1,0,'2017-10-19 22:24:38','2017-10-19 22:24:38'),(67,10,1,0,'2017-10-27 02:01:51','2017-10-27 02:01:51'),(68,6,1,0,'2017-10-27 21:56:42','2017-10-27 21:56:42'),(69,8,1,0,'2017-10-27 22:10:17','2017-10-27 22:10:17');

UNLOCK TABLES;

/*Table structure for table `tipos_documentos` */

CREATE TABLE `tipos_documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipos_documentos_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipos_documentos` */

LOCK TABLES `tipos_documentos` WRITE;

insert  into `tipos_documentos`(`id`,`codigo`,`nombre`,`created_at`,`updated_at`) values (1,'RC','Registro Civil','2017-10-18 04:48:38','2017-10-18 04:48:38'),(2,'TI','Tarjeta de identidad','2017-10-18 04:48:38','2017-10-18 04:48:38'),(3,'CC','Cédula de ciudadanía','2017-10-18 04:48:38','2017-10-18 04:48:38'),(4,'CE','Cédula de extranjería','2017-10-18 04:48:38','2017-10-18 04:48:38'),(5,'P','Pasaporte','2017-10-18 04:48:38','2017-10-18 04:48:38');

UNLOCK TABLES;

/*Table structure for table `tipos_estudios` */

CREATE TABLE `tipos_estudios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipos_estudios` */

LOCK TABLES `tipos_estudios` WRITE;

insert  into `tipos_estudios`(`id`,`nombre`,`created_at`,`updated_at`) values (1,'Taller','2017-10-18 04:48:39','2017-10-18 04:48:39'),(2,'Curso','2017-10-18 04:48:39','2017-10-18 04:48:39'),(3,'Técnico Profesional','2017-10-18 04:48:39','2017-10-18 04:48:39'),(4,'Tecnológico','2017-10-18 04:48:39','2017-10-18 04:48:39'),(5,'Profesional','2017-10-18 04:48:39','2017-10-18 04:48:39'),(6,'Especialización','2017-10-18 04:48:39','2017-10-18 04:48:39'),(7,'Maestría','2017-10-18 04:48:39','2017-10-18 04:48:39'),(8,'Doctorado','2017-10-18 04:48:39','2017-10-18 04:48:39');

UNLOCK TABLES;

/*Table structure for table `tipos_usuarios` */

CREATE TABLE `tipos_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipos_usuarios` */

LOCK TABLES `tipos_usuarios` WRITE;

insert  into `tipos_usuarios`(`id`,`nombre`,`created_at`,`updated_at`) values (1,'Root','2017-10-18 04:48:48','2017-10-18 04:48:48'),(2,'Administrador','2017-10-18 04:48:48','2017-10-18 04:48:48'),(3,'Jefe de programa','2017-10-18 04:48:48','2017-10-18 04:48:48'),(4,'Estudiante','2017-10-18 04:48:48','2017-10-18 04:48:48');

UNLOCK TABLES;

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `persona_id` int(10) unsigned NOT NULL,
  `tipo_usuario_id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_persona_id_unique` (`persona_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_users_tipos_usuarios_id` (`tipo_usuario_id`),
  CONSTRAINT `fk_users_personas_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_tipos_usuarios_id` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`persona_id`,`tipo_usuario_id`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,1,4,'rempel.weston@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','fon2SsR0KFciYD6g6q5b6B5J3zqTZUoJ6CV2Uceh3FfDJVbCgAjWJon9c2Yu','2017-10-18 04:49:22','2017-10-18 04:49:22'),(2,2,4,'marcella59@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','k5rDfEYN1l','2017-10-18 04:49:22','2017-10-18 04:49:22'),(3,3,4,'providenci94@example.net','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','wLeQpC9kWe','2017-10-18 04:49:22','2017-10-18 04:49:22'),(4,4,4,'waters.casimer@example.net','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','qoMc5wS5kH','2017-10-18 04:49:22','2017-10-18 04:49:22'),(5,5,4,'oreilly.josefina@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','WoGKSEm05S','2017-10-18 04:49:22','2017-10-18 04:49:22'),(6,6,4,'mhermiston@example.net','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','NlZj7ZaUse454WznorZQlF6DVIQOtd4NYJmhg4HN7dCdv72akM2yTAPVzuxF','2017-10-18 04:49:22','2017-10-18 04:49:22'),(7,7,4,'louvenia.jenkins@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','yM5kJgTLMF','2017-10-18 04:49:22','2017-10-18 04:49:22'),(8,8,4,'trisha.raynor@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','NpjppqoENtRcjgh4gNNCFF8zC84JmfrbqRsQ9vJCl5CE097BrNKIXqekfGY6','2017-10-18 04:49:22','2017-10-18 04:49:22'),(9,9,4,'broderick.fay@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','DiU7edurOsPEVVGsL1sX4MTIA28nYMGupVBVBXiOklTJKUl69krWVpyrrl7m','2017-10-18 04:49:22','2017-10-18 04:49:22'),(10,10,4,'strosin.keith@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','MMDOYnhLyHi6Q7YUUDOVSD3XMkjbcx0IZYPi4zRfU2DFDNhDsdbCgRONupBX','2017-10-18 04:49:22','2017-10-18 04:49:22'),(11,11,4,'rashad.green@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','vqVhIPvXAG','2017-10-18 04:49:31','2017-10-18 04:49:31'),(12,12,4,'ubahringer@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','o3UG0wa6Oz','2017-10-18 04:49:31','2017-10-18 04:49:31'),(13,13,4,'sierra29@example.net','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','h8BcmEZOUX','2017-10-18 04:49:31','2017-10-18 04:49:31'),(14,14,4,'fay.jada@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','tJoR3qUgjP','2017-10-18 04:49:31','2017-10-18 04:49:31'),(15,15,4,'eondricka@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','C50V9qUhs1','2017-10-18 04:49:31','2017-10-18 04:49:31'),(16,16,4,'leif.carter@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','gKyN3DzmDqwbJuJ7SUHyA6bvx61ODHnTm7m736AvXMZ9dMZPhpeqWPw6toTh','2017-10-18 04:49:31','2017-10-18 04:49:31'),(17,17,4,'kbarrows@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','DhkReH4Ez0ce9b8sIs1wgMQLMJR40FHVZo7TK6yvAjoSREcbPUJ8u6Ma14Oe','2017-10-18 04:49:31','2017-10-18 04:49:31'),(18,18,4,'lori68@example.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','ufPTaTyFltPTX959nYz9bokbtOSa6axeI6emarUDgyGhkgXQRiRhLmq6RukC','2017-10-18 04:49:31','2017-10-18 04:49:31'),(19,19,4,'thurman10@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','sA2G3FRqCFZx6BD9oRxnrMlwbgw2oa6CfxMt2CquNvW0EC6CWYANSDmvfyrd','2017-10-18 04:49:31','2017-10-18 04:49:31'),(20,20,4,'johnston.marge@example.org','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','JvWYEawDue4jQelo9GGZqotxatFZiNN4fHqyG9HTqArOXmYNZMNqRyggq20m','2017-10-18 04:49:31','2017-10-18 04:49:31'),(21,21,3,'gustav0796@hotmail.com','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','fjaC6J0CjdEVPlaNAdidxKexKK87U5HyMjjgLYnYTitTYWKZOAogWW9t942L','2017-10-18 04:51:15','2017-10-18 04:51:15'),(22,22,4,'gapolania0@misena.edu.co','$2y$10$D5v2cV.mUErsTbT5cpM9w.UsvaZJ3F3utWkpqM7wuLI1x4kMa9nyq','OSXakXx2kGisAmv25Yl7EuuH4m0zwhuTsJ5gcGSMvxKU14ms4yaJ6Vse2a5u','2017-10-19 22:16:01','2017-10-19 22:16:01');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
