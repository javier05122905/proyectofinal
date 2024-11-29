/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - veterinaria
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`veterinaria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `veterinaria`;

/*Table structure for table `captchas` */

DROP TABLE IF EXISTS `captchas`;

CREATE TABLE `captchas` (
  `idcap` int(11) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `captchas` */

insert  into `captchas`(`idcap`,`ruta`,`valor`) values 
(1,'c1.png','LuPe'),
(2,'c2.png','AEp'),
(3,'c3.png','3aPb'),
(4,'c4.png','ABC');

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `idcat` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `categorias` */

insert  into `categorias`(`idcat`,`nombre`) values 
(1,'productos'),
(2,'medicamentos'),
(3,'accesorios'),
(4,'alimentos');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `idcli` int(11) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `sexo` varchar(2) DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`idcli`,`nombre`,`apellido`,`sexo`,`tipo`,`archivo`) values 
(1,'Hugo','Rosas','M','VIP','hugo.png'),
(2,'PAco','Perez','M','NORMAL','paco.png'),
(3,'Francisca','Ramirez','F','NORMAL','francisca.png');

/*Table structure for table `colores` */

DROP TABLE IF EXISTS `colores`;

CREATE TABLE `colores` (
  `idco` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `colores` */

insert  into `colores`(`idco`,`nombre`,`activo`) values 
(1,'Blanco','Si'),
(2,'Negro','No'),
(3,'Cafe','Si');

/*Table structure for table `especies` */

DROP TABLE IF EXISTS `especies`;

CREATE TABLE `especies` (
  `ide` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `especies` */

insert  into `especies`(`ide`,`nombre`) values 
(1,'Perros'),
(2,'Gatos'),
(3,'Huron'),
(4,'Hamster'),
(5,'Aves'),
(6,'Reptiles');

/*Table structure for table `mascotas` */

DROP TABLE IF EXISTS `mascotas`;

CREATE TABLE `mascotas` (
  `idma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `ide` int(11) DEFAULT NULL,
  `idco` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  `cartilla` text DEFAULT NULL,
  PRIMARY KEY (`idma`),
  KEY `ide` (`ide`),
  KEY `idco` (`idco`),
  CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`ide`) REFERENCES `especies` (`ide`),
  CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`idco`) REFERENCES `colores` (`idco`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `mascotas` */

insert  into `mascotas`(`idma`,`nombre`,`edad`,`cp`,`costo`,`fecha`,`sexo`,`ide`,`idco`,`observaciones`,`foto`,`created_at`,`updated_at`,`activo`,`cartilla`) values 
(2,'Chorizo',2,72310,200.32,'2024-01-10','m',2,3,'Maulla mucho','sinfoto.PNG','2024-01-24 20:13:02','2024-03-06 19:02:37','Si',NULL),
(5,'Panfilo',3,52145,100,'2024-01-27','h',1,3,'Todo Ok','sinfoto.PNG',NULL,NULL,'Si',NULL),
(6,'Taquito',3,55345,345.23,'2024-01-28','h',1,3,'Todo Ok','sinfoto.PNG','2024-01-26 10:56:35','2024-01-26 10:56:35','Si',NULL),
(7,'Paulinax',19,23234,123.34,'2024-02-08','h',1,3,'Prueba','sinfoto.PNG','2024-02-02 10:32:22','2024-02-23 16:55:41','No',NULL),
(8,'Pipucho',17,43566,123.34,'2024-02-09','m',3,3,'haber','sinfoto.PNG','2024-02-02 10:37:41','2024-02-02 10:37:41','Si',NULL),
(9,'MOlejas',15,23456,123.34,'2024-02-07','m',1,1,'Prueba','1709751003ej1.PNG','2024-02-02 10:39:08','2024-03-06 18:50:03','Si',NULL),
(11,'Kenni',19,53234,100.26,'2024-02-23','h',2,3,'haber que psa','sinfoto.PNG','2024-02-23 10:57:15','2024-02-23 17:15:27','No',NULL),
(12,'Taco',15,45478,200.2,'2024-02-23','m',6,3,'Prueba 2','1709313273NASA.PNG','2024-02-23 11:04:18','2024-02-23 11:04:18','Si',NULL),
(13,'Firulais',3,72130,123.34,'2024-03-01','h',1,1,'prueba','1709313870logointranet.png','2024-03-01 10:49:58','2024-03-01 10:49:58','Si',NULL),
(20,'MOlejas',17,72130,123.34,'2024-03-01','h',6,1,'Rrwerwe','1709750968jill4.png','2024-03-01 11:37:01','2024-03-06 18:49:28','Si',NULL),
(21,'Solovino',14,72130,123.34,'2024-03-06','h',3,3,'Toodo ok','sinfoto.PNG','2024-03-06 12:26:59','2024-03-06 12:26:59','Si',NULL),
(22,'Gorila',13,72130,123.34,'2024-03-06','m',1,3,'Prubea','1709753410NASA.PNG','2024-03-06 13:30:10','2024-03-06 13:30:10','Si','1709753410computadora bericap (003).pdf');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idprod` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `lote` varchar(255) DEFAULT NULL,
  `fechacad` date DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `idcat` int(11) DEFAULT NULL,
  `activo` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`idprod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `productos` */

insert  into `productos`(`idprod`,`nombre`,`lote`,`fechacad`,`existencia`,`costo`,`idcat`,`activo`) values 
(1,'Diclofenaco','235253','2024-05-20',954,150,1,'Si'),
(2,'Vacuna rabia','23566','2029-02-10',50,200,1,'Si'),
(3,'Paracetamol','856859','2028-10-10',89,10,2,'Si'),
(4,'Collar de perro grande','346346','2028-10-10',78,300,3,'Si'),
(5,'Croqueta Royal Canin 20 Kg','535236','2029-05-10',653,4000,4,'Si'),
(6,'Plato comida ','48569','2029-05-10',956,50,2,'No');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idu` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `pasword` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `activo` varchar(255) DEFAULT NULL,
  `fechavigencia` datetime DEFAULT NULL,
  `bloqueo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idu`,`nombre`,`apellido`,`correo`,`pasword`,`tipo`,`activo`,`fechavigencia`,`bloqueo`) values 
(1,'JOel','HErrera','joel@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','Administrador','Si','2024-11-04 21:27:31',0),
(2,'Paulina','Guerra','paulina@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','user','Si',NULL,0);

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `idven` int(11) DEFAULT NULL,
  `idcli` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idu` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ventas` */

insert  into `ventas`(`idven`,`idcli`,`fecha`,`idu`,`created_at`,`updated_at`) values 
(1,2,'2024-05-19',2,NULL,NULL),
(2,3,'2024-05-29',2,NULL,NULL),
(3,3,'2024-06-24',1,'2024-06-24 21:28:18','2024-06-24 21:28:18'),
(4,3,'2024-06-24',1,'2024-06-24 21:29:48','2024-06-24 21:29:48'),
(5,1,'2024-06-24',1,'2024-06-24 21:46:50','2024-06-24 21:46:50'),
(6,3,'2024-06-24',1,'2024-06-24 21:48:26','2024-06-24 21:48:26'),
(7,3,'2024-07-15',1,'2024-07-15 20:06:40','2024-07-15 20:06:40'),
(8,3,'2024-07-15',1,'2024-07-15 20:19:56','2024-07-15 20:19:56'),
(9,1,'2024-07-15',1,'2024-07-15 21:35:22','2024-07-15 21:35:22'),
(10,1,'2024-08-05',1,'2024-08-05 20:16:29','2024-08-05 20:16:29'),
(11,1,NULL,1,'2024-08-05 20:27:25','2024-08-05 20:27:25'),
(12,3,NULL,1,'2024-08-05 20:38:34','2024-08-05 20:38:34'),
(13,3,NULL,1,'2024-08-09 20:30:40','2024-08-09 20:30:40'),
(14,1,NULL,1,'2024-08-09 20:50:14','2024-08-09 20:50:14'),
(15,3,NULL,1,'2024-08-09 20:51:19','2024-08-09 20:51:19'),
(16,3,NULL,1,'2024-08-09 20:58:22','2024-08-09 20:58:22'),
(17,3,NULL,1,'2024-08-09 20:59:56','2024-08-09 20:59:56'),
(18,3,NULL,1,'2024-08-09 21:01:45','2024-08-09 21:01:45'),
(19,1,NULL,1,'2024-08-09 21:05:30','2024-08-09 21:05:30'),
(20,3,NULL,1,'2024-08-09 21:17:17','2024-08-09 21:17:17'),
(21,3,NULL,1,'2024-08-09 21:19:09','2024-08-09 21:19:09'),
(22,3,NULL,1,'2024-08-09 21:20:41','2024-08-09 21:20:41'),
(23,3,NULL,1,'2024-08-09 21:22:19','2024-08-09 21:22:19'),
(24,3,NULL,1,'2024-08-09 21:33:23','2024-08-09 21:33:23'),
(25,3,'2024-09-10',1,'2024-09-10 00:39:47','2024-09-10 00:39:47');

/*Table structure for table `ventasdetalles` */

DROP TABLE IF EXISTS `ventasdetalles`;

CREATE TABLE `ventasdetalles` (
  `idvd` int(11) NOT NULL AUTO_INCREMENT,
  `idven` int(11) DEFAULT NULL,
  `idprod` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `lote` varchar(233) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idvd`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ventasdetalles` */

insert  into `ventasdetalles`(`idvd`,`idven`,`idprod`,`cantidad`,`costo`,`lote`,`created_at`,`updated_at`) values 
(3,5,2,1,200,'NA','2024-06-24 21:47:58','2024-06-24 21:47:58'),
(4,6,4,1,300,'NA','2024-06-24 21:48:26','2024-06-24 21:48:26'),
(5,1,1,3,100,'NA',NULL,NULL),
(6,1,2,2,200,'NA',NULL,NULL),
(8,3,2,4,433,'NA',NULL,NULL),
(9,4,1,3,533,'NA',NULL,NULL),
(10,7,4,1,300,'NA','2024-07-15 20:06:40','2024-07-15 20:06:40'),
(11,8,4,1,300,'NA','2024-07-15 20:19:56','2024-07-15 20:19:56'),
(12,8,5,2,235,'NA','2024-07-15 20:49:41','2024-07-15 20:49:41'),
(13,8,5,2,353,'NA','2024-07-15 20:56:28','2024-07-15 20:56:28'),
(14,8,2,1,200,'NA','2024-07-15 20:59:31','2024-07-15 20:59:31'),
(15,8,3,2,345,'NA','2024-07-15 20:59:40','2024-07-15 20:59:40'),
(16,8,2,1,200,'NA','2024-07-15 21:29:18','2024-07-15 21:29:18'),
(17,8,2,1,200,'NA','2024-07-15 21:29:42','2024-07-15 21:29:42'),
(18,9,4,1,300,'NA','2024-07-15 21:35:22','2024-07-15 21:35:22'),
(20,11,4,10,300,'NA','2024-08-05 20:27:25','2024-08-05 20:27:25'),
(21,11,5,1,234,'NA','2024-08-05 20:27:35','2024-08-05 20:27:35'),
(22,11,2,1,200,'NA','2024-08-05 20:28:25','2024-08-05 20:28:25'),
(23,11,4,2,300,'NA','2024-08-05 20:36:26','2024-08-05 20:36:26'),
(24,12,4,1,300,'NA','2024-08-05 20:38:34','2024-08-05 20:38:34'),
(25,12,5,1,534,'NA','2024-08-05 20:39:44','2024-08-05 20:39:44'),
(26,13,4,1,300,'NA','2024-08-09 20:30:40','2024-08-09 20:30:40'),
(27,13,5,1,541,'NA','2024-08-09 20:30:50','2024-08-09 20:30:50'),
(28,13,2,1,200,'NA','2024-08-09 20:36:36','2024-08-09 20:36:36'),
(29,13,3,1,200,'NA','2024-08-09 20:41:23','2024-08-09 20:41:23'),
(30,13,3,1,400,'NA','2024-08-09 20:41:38','2024-08-09 20:41:38'),
(31,13,3,1,200,'NA','2024-08-09 20:41:52','2024-08-09 20:41:52'),
(32,13,3,1,233,'NA','2024-08-09 20:42:06','2024-08-09 20:42:06'),
(33,14,4,1,300,'NA','2024-08-09 20:50:14','2024-08-09 20:50:14'),
(34,14,5,1,256,'NA','2024-08-09 20:50:18','2024-08-09 20:50:18'),
(35,15,4,1,300,'NA','2024-08-09 20:51:19','2024-08-09 20:51:19'),
(36,15,5,1,345,'NA','2024-08-09 20:51:23','2024-08-09 20:51:23'),
(39,17,4,1,300,'NA','2024-08-09 20:59:56','2024-08-09 20:59:56'),
(41,17,2,1,200,'NA','2024-08-09 21:00:09','2024-08-09 21:00:09'),
(51,19,1,1,150,'NA','2024-08-09 21:15:13','2024-08-09 21:15:13'),
(52,20,1,1,150,'NA','2024-08-09 21:17:17','2024-08-09 21:17:17'),
(53,20,1,1,150,'NA','2024-08-09 21:17:22','2024-08-09 21:17:22'),
(54,21,1,1,150,'NA','2024-08-09 21:19:09','2024-08-09 21:19:09'),
(55,21,1,1,150,'NA','2024-08-09 21:19:22','2024-08-09 21:19:22'),
(56,21,1,1,150,'NA','2024-08-09 21:20:03','2024-08-09 21:20:03'),
(57,21,1,1,150,'NA','2024-08-09 21:20:07','2024-08-09 21:20:07'),
(58,21,1,1,150,'NA','2024-08-09 21:20:27','2024-08-09 21:20:27'),
(63,22,1,1,150,'NA','2024-08-09 21:21:51','2024-08-09 21:21:51'),
(64,22,1,1,150,'NA','2024-08-09 21:21:55','2024-08-09 21:21:55'),
(70,23,1,1,150,'NA','2024-08-09 21:30:08','2024-08-09 21:30:08'),
(71,23,3,1,564,'NA','2024-08-09 21:30:14','2024-08-09 21:30:14'),
(72,23,2,1,200,'NA','2024-08-09 21:31:36','2024-08-09 21:31:36'),
(73,23,5,1,234,'NA','2024-08-09 21:31:43','2024-08-09 21:31:43'),
(74,23,4,2,300,'NA','2024-08-09 21:32:26','2024-08-09 21:32:26'),
(75,24,4,1,300,'NA','2024-08-09 21:33:23','2024-08-09 21:33:23'),
(76,24,5,2,453,'NA','2024-08-09 21:33:50','2024-08-09 21:33:50'),
(77,10,4,1,300,'NA','2024-08-09 21:58:08','2024-08-09 21:58:08'),
(78,2,4,1,300,'NA','2024-08-09 22:02:08','2024-08-09 22:02:08'),
(79,2,4,2,300,'NA','2024-08-09 22:02:13','2024-08-09 22:02:13'),
(80,2,2,1,200,'NA','2024-08-09 22:02:47','2024-08-09 22:02:47'),
(81,25,3,5,10,'NA','2024-09-10 00:39:47','2024-09-10 00:39:47');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
