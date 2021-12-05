/*
SQLyog Community
MySQL - 10.4.11-MariaDB : Database - apr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`apr` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `apr`;

/*Table structure for table `grad` */

DROP TABLE IF EXISTS `grad`;

CREATE TABLE `grad` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `postanski_broj` varchar(5) DEFAULT NULL,
  `naziv` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `grad` */

insert  into `grad`(`id`,`postanski_broj`,`naziv`) values 
(1,'11000','Beograd'),
(2,'12345','wrewg'),
(3,'14000','Nis'),
(4,'12400','Pancevo'),
(5,'14530','Smederevo'),
(7,'345','afds');

/*Table structure for table `preduzece` */

DROP TABLE IF EXISTS `preduzece`;

CREATE TABLE `preduzece` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sifra_delatnosti` varchar(4) NOT NULL,
  `maticni_broj` varchar(20) DEFAULT NULL,
  `tip` bigint(20) DEFAULT NULL,
  `naziv` varchar(60) DEFAULT NULL,
  `broj` varchar(30) DEFAULT NULL,
  `adresa` varchar(40) DEFAULT NULL,
  `odgovorno_lice` varchar(50) DEFAULT NULL,
  `grad` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tip` (`tip`),
  KEY `grad` (`grad`),
  CONSTRAINT `preduzece_ibfk_1` FOREIGN KEY (`tip`) REFERENCES `tip_preduzeca` (`id`),
  CONSTRAINT `preduzece_ibfk_2` FOREIGN KEY (`grad`) REFERENCES `grad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `preduzece` */

/*Table structure for table `tip_preduzeca` */

DROP TABLE IF EXISTS `tip_preduzeca`;

CREATE TABLE `tip_preduzeca` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tip_preduzeca` */

insert  into `tip_preduzeca`(`id`,`naziv`) values 
(1,'Preduzetnik'),
(2,'Ortacko preduzece'),
(3,'Drustvo sa ogranicenom odgovornoscu'),
(4,'Akcionarsko drustvo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
