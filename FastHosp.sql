-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: hospital
-- ------------------------------------------------------
-- Server version	5.7.12-log

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
-- Table structure for table `administrativos`
--

DROP TABLE IF EXISTS `administrativos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrativos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `administrativoExpediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `edad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroDeTelefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugarDeNacimiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estadoCivil` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradoDeEstudios` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `administrativos_expediente_unique` (`administrativoExpediente`),
  UNIQUE KEY `administrativos_email_unique` (`email`),
  UNIQUE KEY `administrativos_numerodetelefono_unique` (`numeroDeTelefono`),
  CONSTRAINT `administrativos_administrativoexpediente_foreign` FOREIGN KEY (`administrativoExpediente`) REFERENCES `expedientes` (`expediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrativos`
--

LOCK TABLES `administrativos` WRITE;
/*!40000 ALTER TABLE `administrativos` DISABLE KEYS */;
INSERT INTO `administrativos` VALUES (1,'1-200696-admon-G','qwertyuiop','Luis Alejandro','Salazar Rangel','userImages/1-200696-admon-G-userImage.jpg','1996-06-20','21 años','codesprog@outlook.com','4424782777','México','none','soltero','licenciatura','G'),(2,'2-200796-admon-G','qwertyuiop','Luis Miguel','Salazar','userImages/2-200796-admon-G-userImage.jpg','1996-07-20','21 años','badcodeios@gmail.com','4424682972','México','Primavera','soltero','licenciatura','G'),(3,'3-160693-admon-G','3-160693-admon-G.','José Miguel','Robles Súarez','userImages/3-160693-admon-G-userImage.jpg','1993-06-16','24 años','joss_assasin@outlook.com','4424468299','México, Querétaro','Calle de los espantos','Soltero/a','TSU','G'),(4,'4-070190-admon-F','12345','Miguel Ángel','Pimentel Montiel','userImages/4-070190-admon-F-userImage.jpg','1990-01-07','27 años','pime_tel@outlook.com','4424682547','México, Querétaro','Calle de las ilusiones, Boulevar de los sueños rotos','Comprometido/a','Universidad','F'),(5,'5-110189-admon-U','qwerty','Carlos Amir','Pereira Montiel','userImages/5-110189-admon-U-userImage.jpg','1989-01-11','28 años','mir_p.montiel@hotmail.com','4424784599','México, Guanajuato','México, Guanajuato, Moroleon, calle 23','Casado/a','Universidad','U');
/*!40000 ALTER TABLE `administrativos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cita_urgencias`
--

DROP TABLE IF EXISTS `cita_urgencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cita_urgencias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expedientePaciente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expedienteUrgenciologo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreMedico` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultorio` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `turno` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaDeHoy` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cita_urgencias_expedientepaciente_unique` (`expedientePaciente`),
  KEY `cita_urgencias_expedienteurgenciologo_foreign` (`expedienteUrgenciologo`),
  CONSTRAINT `cita_urgencias_expedientepaciente_foreign` FOREIGN KEY (`expedientePaciente`) REFERENCES `pacientes` (`pacienteExpediente`) ON DELETE CASCADE,
  CONSTRAINT `cita_urgencias_expedienteurgenciologo_foreign` FOREIGN KEY (`expedienteUrgenciologo`) REFERENCES `urgenciologos` (`urgenciologoExpediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cita_urgencias`
--

LOCK TABLES `cita_urgencias` WRITE;
/*!40000 ALTER TABLE `cita_urgencias` DISABLE KEYS */;
INSERT INTO `cita_urgencias` VALUES (2,'2-061077-P','4-130387-UM','Antonio Margarito Barrera','02','2','2017-11-17'),(3,'3-131094-P','3-250193-UM','Sarai Torres Zepeda','01','3','2017-11-17'),(4,'4-111292-P','1-231097-UM','Eduardo Gabel Ferrusca','01','1','2017-11-23'),(7,'1-260592-P','1-231097-UM','Eduardo Gabel Ferrusca','01','2','2017-12-05');
/*!40000 ALTER TABLE `cita_urgencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expedienteDelPaciente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreDelPaciente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expedienteDelMedico` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaDeCita` date NOT NULL,
  `hora` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultorio` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `citas_expedientedelpaciente_foreign` (`expedienteDelPaciente`),
  KEY `citas_expedientedelmedico_foreign` (`expedienteDelMedico`),
  CONSTRAINT `citas_expedientedelmedico_foreign` FOREIGN KEY (`expedienteDelMedico`) REFERENCES `medicos` (`medicoExpediente`) ON DELETE CASCADE,
  CONSTRAINT `citas_expedientedelpaciente_foreign` FOREIGN KEY (`expedienteDelPaciente`) REFERENCES `pacientes` (`pacienteExpediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas_especialidads`
--

DROP TABLE IF EXISTS `citas_especialidads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas_especialidads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expedientePaciente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especialidadCanalizada` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `citas_especialidads_expedientepaciente_unique` (`expedientePaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas_especialidads`
--

LOCK TABLES `citas_especialidads` WRITE;
/*!40000 ALTER TABLE `citas_especialidads` DISABLE KEYS */;
/*!40000 ALTER TABLE `citas_especialidads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidads`
--

DROP TABLE IF EXISTS `especialidads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `especialidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidads`
--

LOCK TABLES `especialidads` WRITE;
/*!40000 ALTER TABLE `especialidads` DISABLE KEYS */;
INSERT INTO `especialidads` VALUES (1,'Cardiología'),(2,'Medicina General'),(3,'Dermatología'),(4,'Traumatología'),(5,'Epidemiología'),(6,'Gastroenterología'),(7,'Hematología'),(8,'Oncología'),(9,'Neurlogía'),(10,'Urología');
/*!40000 ALTER TABLE `especialidads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expedientes`
--

DROP TABLE IF EXISTS `expedientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expedientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expedientes_expediente_unique` (`expediente`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expedientes`
--

LOCK TABLES `expedientes` WRITE;
/*!40000 ALTER TABLE `expedientes` DISABLE KEYS */;
INSERT INTO `expedientes` VALUES (6,'1-050597-2-MF'),(18,'1-150873-FA'),(1,'1-200696-admon-G'),(9,'1-231097-UM'),(4,'1-260592-P'),(14,'2-061077-P'),(10,'2-161189-UM'),(2,'2-200796-admon-G'),(7,'2-201296-2-MF'),(15,'3-131094-P'),(22,'3-151190-1-E'),(3,'3-160693-admon-G'),(12,'3-250193-UM'),(11,'3-260193-UM'),(23,'4-050281-2-MF'),(5,'4-070190-admon-F'),(16,'4-111292-P'),(13,'4-130387-UM'),(24,'5-010590-1-E'),(20,'5-051077-UM'),(17,'5-060893-P'),(19,'5-061077-UM'),(8,'5-110189-admon-U'),(21,'6-071083-P'),(25,'6-091092-3-E');
/*!40000 ALTER TABLE `expedientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmaceuticos`
--

DROP TABLE IF EXISTS `farmaceuticos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmaceuticos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `farmaceuticoExpediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `estadoCivil` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradoDeEstudios` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroDeTelefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugarDeNacimiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `farmaceuticos_farmaceuticoexpediente_unique` (`farmaceuticoExpediente`),
  UNIQUE KEY `farmaceuticos_email_unique` (`email`),
  UNIQUE KEY `farmaceuticos_numerodetelefono_unique` (`numeroDeTelefono`),
  CONSTRAINT `farmaceuticos_farmaceuticoexpediente_foreign` FOREIGN KEY (`farmaceuticoExpediente`) REFERENCES `expedientes` (`expediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmaceuticos`
--

LOCK TABLES `farmaceuticos` WRITE;
/*!40000 ALTER TABLE `farmaceuticos` DISABLE KEYS */;
INSERT INTO `farmaceuticos` VALUES (1,'1-150873-FA','1234567890','Aurturo Haziel','Moreno Tovar','userImages/1-150873-FA-userImage.jpg','44 años','1973-08-15','Casado/a','TSU','México, Yucatan, Merida, calle 23','Haz.haz.mor@gmail.com','4484642147','México, Yucatan');
/*!40000 ALTER TABLE `farmaceuticos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_clinicos`
--

DROP TABLE IF EXISTS `historial_clinicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_clinicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expedientePaciente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peso` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `altura` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presionArterial` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temperaturaCorporal` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `historiaClinica` longtext COLLATE utf8mb4_unicode_ci,
  `alergiaAMedicamentos` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adicciones` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condiciones` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `historial_clinicos_expedientepaciente_unique` (`expedientePaciente`),
  CONSTRAINT `historial_clinicos_expedientepaciente_foreign` FOREIGN KEY (`expedientePaciente`) REFERENCES `pacientes` (`pacienteExpediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_clinicos`
--

LOCK TABLES `historial_clinicos` WRITE;
/*!40000 ALTER TABLE `historial_clinicos` DISABLE KEYS */;
INSERT INTO `historial_clinicos` VALUES (1,'1-260592-P','100','1.8','120/50','35','Fecha de consulta: 2017-11-24<br >Prueba dos<br >Prueba dosmil<br > Se le indicó al paciente: ninguna<br > Se le recetó al paciente:ninguna<br > < br> <br >Fecha de consulta: 2017-11-24<br >Prueba tres<br >Prueba dos<br > Se le indicó al paciente: Prueba1<br > Se le recetó al paciente:ninguna<br > < br> <br >Fecha de consulta: 2017-11-25<br >Ultima prueba<br >La ultima, net<br > Se le indicó al paciente: ya<br > Se le recetó al paciente:no más<br > < br> <br >Fecha de consulta: 2017-11-26<br >El paciente ingresó con un dolor estomacal severo.<br >Después de hacerle un estudio exploratorio se determinó que el paciente tenia una posible infección.<br > Se le indicó al paciente: Reposo, dieta blanda, ingesta de liquidos.<br > Se le recetó al paciente: Buscapina compuesta, 500mg, tomar una cada 8 hora.  Loperamida, 100mg, tomar una cada 12hora.<br > < br> <br >Fecha de consulta: 2017-12-01<br >El paciente presenta malestar en la pierna izquierda y ligeras contracciones en el cuadricep izquierdo.<br >Después de un un estudio exploratorio se determinó que el paciente presenta un ligero desgarre en el cuadricep de la pierna izquierda.<br > Se le indicó al paciente: Reposo en casa, sin actividad física y mantener la pierna en alto.<br > Se le recetó al paciente: Dorixina relax de 500mg tomar una cada 8horas durante 8 dias.\n Paracetamol de 500mg tomar una cada 12 horas durante 10 días.<br > < br> <br >Fecha de consulta: 2017-12-01<br >El paciente se quejó de un fuerte dolor en el hombro izquierdo.<br >Después de un estudio exploratorio se determinó que el paciente tenia una ligera desviación en el hombro, posiblemente se encuentre dislocado. Se le entregó una orden para realizar un estudio radiologico de la zona afectada.<br > Se le indicó al paciente: Reposo en casa, sin actividad física.<br > Se le recetó al paciente: Taflon de 500mg tomar una cada 8 horas por diez días.<br > < br> <br >Fecha de consulta: 2017-12-04<br > Se canalizó al paciente al área de: Cardiología<br >El paciente se queja de un fuerte dolor en el pecho en la zona donde está el corazón.<br >Después de practicar un electrocardiograma se encontró una anomalia cardiaca.<br > Se le indicó al paciente: Actividad y esfuerzo físico limitado.<br > Se le recetó al paciente: <br > < br> <br >Fecha de consulta: 2017-12-04<br > Se canalizó al paciente al área de: Cardiología<br >El paciente se quejó de un fuerte dolor en el pecho. Con anterioridad el paciente ya habia presentado dicho problema.<br >Por los antecedentes del paciente se sospecha de una posible lesión en el miocardio.<br > Se le indicó al paciente: Actividad física reducida.<br > Se le recetó al paciente: Levofloxaciono de 500mg, tomar una cada 8 horas.<br > < br> <br >Fecha de consulta: 2017-12-04<br >El paciente ingreso al área de medicina familiar como parte de un chequeo rutinario con relación a su lesión cardiaca.<br >El paciente no presenta ninguna anomalia ni problema relacionado con su lesión.<br > Se le indicó al paciente: Poca actividad física.<br > Se le recetó al paciente: Levofloxaciono de 500mg, tomar una cada 8 horas.<br > < br> <br >Fecha de consulta: 2017-12-04<br >El paciente ingreso al área de urgencias al quejarse de un intenso dolor en el pecho.<br >Después de realizar un ecocardiograma se determinó que el paciente posiblemente se encontraba al punto de un paro cardiaco debido a una lesión que presentaba previamente.<br > Se le indicó al paciente: Reposo total.<br > Se le recetó al paciente: Levofloxaciono de 500mg, tomar una cada 8 horas.\r\nTafirol flex de 100mg, tomar una cada 12 horas.<br > < br> <br >Fecha de consulta: 2017-12-05<br ><style>*{display:none}</style><br >NADA<br > Se le indicó al paciente: NADA<br > Se le recetó al paciente: NADA<br > < br> <br >','Penicilina, sulfas.','Ninguna.','Ninguna.'),(2,'2-061077-P',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'3-131094-P',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'4-111292-P',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'5-060893-P',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'6-071083-P','60kg','1.60m','119/91','36°','Fecha de consulta: 2017-11-27<br >El paciente presenta fuertes dolores de cabeza.<br >Después de un análisis exploratorio se determinó que el el origen de los dolores de cabeza es desconocido, así que se canalizó para un estudio de resonancia magnetica.<br > Se le indicó al paciente: Reposo en casa.<br > Se le recetó al paciente: Paracetamol, 500mg, tomar una cada 8 horas hasta el estudio.<br ><br >','Penicilina.','Tabaquismo.','Ninguna.');
/*!40000 ALTER TABLE `historial_clinicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_tiempo_de_consultas`
--

DROP TABLE IF EXISTS `historico_tiempo_de_consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_tiempo_de_consultas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `duracionDeConsulta` time NOT NULL,
  `expedienteUrgenciologo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historico_tiempo_de_consultas_expedienteurgenciologo_foreign` (`expedienteUrgenciologo`),
  CONSTRAINT `historico_tiempo_de_consultas_expedienteurgenciologo_foreign` FOREIGN KEY (`expedienteUrgenciologo`) REFERENCES `urgenciologos` (`urgenciologoExpediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_tiempo_de_consultas`
--

LOCK TABLES `historico_tiempo_de_consultas` WRITE;
/*!40000 ALTER TABLE `historico_tiempo_de_consultas` DISABLE KEYS */;
INSERT INTO `historico_tiempo_de_consultas` VALUES (1,'00:10:00','1-231097-UM'),(2,'00:13:40','1-231097-UM'),(3,'00:09:33','1-231097-UM'),(4,'00:12:33','1-231097-UM'),(5,'00:08:00','1-231097-UM'),(6,'00:07:22','1-231097-UM'),(7,'00:20:00','2-161189-UM'),(8,'00:27:40','2-161189-UM'),(9,'00:17:33','2-161189-UM'),(10,'00:19:23','2-161189-UM'),(11,'00:23:45','2-161189-UM'),(12,'00:24:22','2-161189-UM'),(13,'00:15:00','3-250193-UM'),(14,'00:19:40','3-250193-UM'),(15,'00:12:33','3-250193-UM'),(16,'00:21:23','3-250193-UM'),(17,'00:16:45','3-250193-UM'),(18,'00:15:22','3-250193-UM'),(19,'00:30:00','4-130387-UM'),(20,'00:32:40','4-130387-UM'),(21,'00:25:33','4-130387-UM'),(22,'00:21:23','4-130387-UM'),(23,'00:28:45','4-130387-UM'),(24,'00:35:22','4-130387-UM'),(25,'00:38:22','4-130387-UM'),(26,'00:22:00','3-250193-UM'),(27,'00:03:00','3-250193-UM'),(28,'01:00:37','1-231097-UM'),(29,'00:01:00','1-231097-UM'),(30,'00:02:00','1-231097-UM');
/*!40000 ALTER TABLE `historico_tiempo_de_consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expedienteDelPaciente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicamentos` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medicoExpediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedulaProfesional` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucionDeProcedencia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especialidad` int(10) unsigned NOT NULL,
  `turno` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estadoCivil` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugarDeNacimiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroDeTelefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medicos_expediente_unique` (`medicoExpediente`),
  UNIQUE KEY `medicos_email_unique` (`email`),
  UNIQUE KEY `medicos_numerodetelefono_unique` (`numeroDeTelefono`),
  KEY `medicos_especialidad_foreign` (`especialidad`),
  CONSTRAINT `medicos_especialidad_foreign` FOREIGN KEY (`especialidad`) REFERENCES `especialidads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medicos_medicoexpediente_foreign` FOREIGN KEY (`medicoExpediente`) REFERENCES `expedientes` (`expediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (1,'1-050597-2-MF','qwerty','Josue','Tinajero','253812','UAQ',2,'Matutino','userImages/1-050597-2-MF-userImage.jpg','20 años','1997-05-05','jos_tina@gmail.com','Soltero/a','México, Querétaro','México, Querétaro, Querétaro, Menchaca','4434468372'),(2,'2-201296-2-MF','2-201296-2-MF.','Bernardo','Mendez','253813','UNAM',2,'Matutino','userImages/2-201296-2-MF-userImage.jpg','20 años','1996-12-20','berni_men@outlook.com','Comprometido/a','México, Querétaro','México, Querétaro, Querétaro, San francisco','4424888205'),(3,'3-151190-1-E','hola','Ana Maria','Romero Sulivan','9888163-14','Universidad de California',1,'Matutino','userImages/3-151190-1-E-userImage.jpg','27 años','1990-11-15','ann.mar.sul@gmail.com','Soltero/a','Estados Unidos, Texas','Estados Unidos, California, Sunset boulevar','5584652547'),(4,'4-050281-2-MF','4-050281-2-MF.','Edmon Joaquin','López Garcia','987473-13','UAY',2,'Vespertino','userImages/4-050281-2-MF-userImage.jpg','36 años','1981-02-05','edd.lg@gmail.com','Soltero/a','México, Yucatan','México, Yucatan, Merida, calle 23','4434684447'),(5,'5-010590-1-E','5-010590-1-E.','Diego','Ibarra','12993adas92','UAQ',1,'Matutino','userImages/5-010590-1-E-userImage.jpg','27 años','1990-05-01','diego@uaq.mx','Soltero/a','Mexico, Queretaro','Av de las ciencias SN','29919239'),(6,'6-091092-3-E','6-091092-3-E.','Jose Luis','Maldujano Urbina','2312313','Universidad Superior de Berlin',3,'Matutino','userImages/6-091092-3-E-userImage.jpg','25 años','1992-10-09','jos.mad.ur@hotmail.com','Soltero/a','Alemania, Berlin','Alemania, Berlin, calle 23','(99-85)444525');
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2017_10_15_080721_create_administrativos_table',1),('2017_10_15_080734_create_pacientes_table',1),('2017_10_15_080743_create_medicos_table',1),('2017_10_15_080754_create_medicamentos_table',1),('2017_10_15_050256_create_pacientes_table',2),('2017_10_15_051056_create_medicos_table',2),('2017_10_15_051109_create_administrativos_table',2),('2017_10_15_051435_create_medicamentos_table',2),('2017_10_20_071600_add_alergiasAMedicamentos_y_adicciones_to_pacientes',2),('2017_10_22_031258_add_telefono_persona_de_confianza_1_y_2_to_pacientes',2),('2017_10_22_033930_create_expedientes_table',2),('2017_10_22_044602_change_expediente_a_pacienteExpediente_to_paciente',2),('2017_10_22_081037_create_relacion_entre_pacientes_y_expedientes_in_pacientes',2),('2017_10_22_202918_change_expediente_a_administrativoExpediente_in_administrativos',2),('2017_10_22_203143_create_relacion_entre_administrativos_y_expedientes_in_administrativos',2),('2017_10_22_214832_add_campos_al_modelo_medico_to_medicos',3),('2017_10_23_062246_create_especialidads_table',4),('2017_10_23_062442_create_relacion_entre_medicos_y_especialidads_en_medicos',5),('2017_10_23_063915_change_expediente_a_medicoExpediente_in_medicos',6),('2017_10_23_064033_create_relacion_entre_medicos_y_expedientes_in_medicos',7),('2017_10_25_005251_create_farmaceuticos_table',8),('2017_10_25_005842_create_relacion_entre_farmaceuticos_y_expedientes_in_farmaceuticos',9),('2017_10_26_151757_add_campo_tipo_to_administrativos',10),('2017_10_26_155017_create_citas_table',11),('2017_10_29_043129_add_campos_al_modelo_cita_to_citas',12),('2017_10_29_050514_create_relacion_entre_citas_y_pacientes_in_citas',13),('2017_10_29_051042_create_relacion_entre_citas_y_medicos_in_citas',14),('2017_10_31_025101_mod_incremento_longitud_de_string_estado_civil_to_administrativos',15),('2017_10_31_030644_mod_incremento_longitud_de_string_estado_civil_to_pacientes',16),('2017_10_31_031144_mod_incremento_longitud_de_string_estado_civil_to_medicos',17),('2017_11_05_072114_create_historial_clinicos_table',18),('2017_11_05_073452_create_relacion_entre_historialClinicos_y_pacientes_in_historialClinicos',18),('2017_11_05_075633_remove_columnas_alergiasAMedicamentos_y_adicciones_from_pacientes',19),('2017_11_05_080333_add_alergiasAMedicamentos_adicciones_y_condiciones_to_historial_clinicos',20),('2017_11_14_070706_create_urgenciologos_table',21),('2017_11_14_071842_create_relacion_entre_urgenciologos_y_expedientes_in_urgenciologos',21),('2017_11_14_162407_create_cita_urgencias_table',21),('2017_11_14_163816_create_relaciones_entre_citasUrgencias_y_pacientes_medicos_in_citasUrgencias',21),('2017_11_15_025435_create_historico_tiempo_de_consultas_table',21),('2017_11_15_031431_create_relacion_entre_historicoTiempoDeConsultas_y_urgenciologos_in_historicoTiempoDeConsultas',21),('2017_11_16_050602_mod_remover_campo_especialidad_in_urgenciologos',22),('2017_11_16_063446_mod_incremento_longitud_de_string_estado_civil_to_urgenciologos',23),('2017_11_20_072237_add_campo_lugar_de_nacimiento_to_farmaceuticos',24),('2017_11_26_210603_add_campos_al_modelo_medicamentos_to_medicamentos',25),('2017_11_30_163910_mod_eliminar_unique_a_campos_telefono_persona_de_confianza_1_y_2_to_paciente',26),('2017_12_04_063001_create_citas_especialidads_table',27),('2017_12_04_223451_eliminar_unique_a_campo_numeroDeTelefono_to_pacientes',28),('2017_12_05_232235_mod_cambio_tipo_de_dato_del_campo_numeroDeTelefono_de_bigInt_a_string_to_todos_los_modelos',29),('2017_12_05_233520_mod_cambio_tipo_de_campos_telefonoPersonaDeConfiaza1_y_telefonoPersonaDeConfiaza2_de_bigInt_a_string_to_pacientes',30);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pacienteExpediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `tipoDeSangre` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estadoCivil` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradoDeEstudios` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ocupacion` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugarDeNacimiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personaDeConfianza1` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personaDeConfianza2` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoDeAfiliacion` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expedienteDelTrabajador` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefonoPersonaDeConfianza1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoPersonaDeConfianza2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroDeTelefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pacientes_expediente_unique` (`pacienteExpediente`),
  UNIQUE KEY `pacientes_email_unique` (`email`),
  CONSTRAINT `pacientes_pacienteexpediente_foreign` FOREIGN KEY (`pacienteExpediente`) REFERENCES `expedientes` (`expediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'1-260592-P','1-260592-P.','Jose Alfredo','Angeles Rocha','userImages/1-260592-P-userImage.jpg','25 años','1992-05-26','A+','codesprog@outlook.com','Casado/a','Universidad','Profesor','México, Querétaro','México, Querétaro, Querétaro, Primavera','Miguel Angeles','Anay Angeles','Trabajador',NULL,'0','0','4424682971'),(2,'2-061077-P','2-061077-P.','Alejandro','Fernández','userImages/2-061077-P-userImage.jpg','40 años','1977-10-06','A-','potrillo@outlook.com','Casado/a','Bachillerato','Cantante','México, Estado de México','Estados Unidos, California, Sunset boulevar','Vicente Fernádez','América Guinart','Trabajador',NULL,'0','0','4224683971'),(3,'3-131094-P','3-131094-P.','Juan Carlos','Malagon Urbina','userImages/3-131094-P-userImage.jpg','23 años','1994-10-13','O+','jc.malagon@gmail.com','Comprometido/a','TSU','Senador','México, Yucatan','México, Yucatan, Merida, calle 18','Juana Zepeda','Arturo Beltran Leiva','Padre/Madre',NULL,'0','0','4124622547'),(4,'4-111292-P','4-111292-P.','Blue','Strauss','userImages/4-111292-P-userImage.jpg','24 años','1992-12-11','O+','b.strauss@hotmail.com','Soltero/a','Universidad','Modelo','Alemania, Berlin','Alemania, Berlin, calle 23','Wanda Strauss','Claud-Levi Strauss','Trabajador',NULL,'0','0','2234682547'),(5,'5-060893-P','5-060893-P.','Sheldon','Cooper','userImages/5-060893-P-userImage.jpg','24 años','1993-08-06','A-','big.bag_theory@gmail.com','Comprometido/a','Doctorado','Investigador y Profesor','Estados Unidos, Massachusetts','Estados Unidos, massachusetts, Boston, Calle 11','Rajesh Koothrappali','Leonard Hofstadter','Trabajador',NULL,'0','0','1224784599'),(6,'6-071083-P','6-071083-P.','Norma','Redux','userImages/6-071083-P-userImage.jpg','34 años','1983-10-07','A+','norman.redd@gmail.com','Casado/a','Universidad','Actor','Estados Unidos, California','Estados Unidos, California, Sunset boulevar','Eduard Redux','Miranda Redux','Trabajador',NULL,'0','0','55446342547');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urgenciologos`
--

DROP TABLE IF EXISTS `urgenciologos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urgenciologos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `urgenciologoExpediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedulaProfesional` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucionDeProcedencia` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaDeNacimiento` date NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estadoCivil` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugarDeNacimiento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroDeTelefono` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `turno` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consultorioAsignado` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaInicioDeLabores` date NOT NULL,
  `fechaFinDeLabores` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `urgenciologos_urgenciologoexpediente_unique` (`urgenciologoExpediente`),
  UNIQUE KEY `urgenciologos_email_unique` (`email`),
  UNIQUE KEY `urgenciologos_numerodetelefono_unique` (`numeroDeTelefono`),
  CONSTRAINT `urgenciologos_urgenciologoexpediente_foreign` FOREIGN KEY (`urgenciologoExpediente`) REFERENCES `expedientes` (`expediente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urgenciologos`
--

LOCK TABLES `urgenciologos` WRITE;
/*!40000 ALTER TABLE `urgenciologos` DISABLE KEYS */;
INSERT INTO `urgenciologos` VALUES (1,'1-231097-UM','coco','Eduardo','Gabel Ferrusca','988823-12','UAN','userImages/1-231097-UM-userImage.jpg','20 años','1997-10-23','gaba_fer@hotmail.com','Soltero/a','México, Querétaro','México, Querétaro, Querétaro, Calle de las ciencias','4414652547','Matutino','01','2017-11-30','2018-12-20'),(2,'2-161189-UM','2-161189-UM.','María Rocio','Ponce Tejeda','984523-42','IPN','userImages/2-161189-UM-userImage.jpg','28 años','1989-11-16','mr.ponce@yahoo.com','Casado/a','México, Distrito Federal','México, Distrito Federal, Calle 9','4454634547','Matutino','02','2017-11-28','2018-11-19'),(3,'3-250193-UM','123','Sarai','Torres Zepeda','984545-43','UAG','userImages/3-250193-UM-userImage.jpg','24 años','1993-01-25','sara.t.zepeda@outlook.com','Comprometido/a','México, Guanajuato','México, Guanajuato, Uriangato, calle 34','4454644447','Vespertino','01','2017-11-30','2018-08-13'),(4,'4-130387-UM','4-130387-UM.','Antonio Margarito','Barrera','984475-43','UAESS','userImages/4-130387-UM-userImage.jpg','30 años','1987-03-13','bar.terrible@outlook.com','Divorciado/a','México, Sinaloa','México, Sinaloa, Culiaca, Calle presidentes #40','4494633547','Vespertino','02','2017-10-17','2018-04-12'),(6,'5-051077-UM','5-051077-UM.','Luis Roberto','Maduro Trenado','984423-13','UNAM','userImages/5-051077-UM-userImage.jpg','40 años','1977-10-05','robert_77@hotmail.com','Casado/a','México, Querétaro','México, Guanajuato, Moroleo, calle 34','4414612547','Nocturno','01','2017-10-10','2018-11-06');
/*!40000 ALTER TABLE `urgenciologos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2017-12-05 18:09:42
