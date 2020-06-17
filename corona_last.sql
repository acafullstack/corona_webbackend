/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 10.4.8-MariaDB : Database - corona_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`corona_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `corona_db`;

/*Table structure for table `collection_center` */

DROP TABLE IF EXISTS `collection_center`;

CREATE TABLE `collection_center` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_name` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `collection_center` */

insert  into `collection_center`(`id`,`collection_name`,`updated_at`,`created_at`) values 
(1,'new collection',NULL,'2020-06-16 20:04:03'),
(2,'collection center2',NULL,'2020-06-16 20:04:20');

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `second_name` varchar(100) DEFAULT NULL,
  `report_type` varchar(100) NOT NULL,
  `symptom` text NOT NULL,
  `additional_info` text DEFAULT NULL,
  `video_or_image` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `collection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `collection_center` (`collection_id`),
  CONSTRAINT `collection_center` FOREIGN KEY (`collection_id`) REFERENCES `collection_center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `report` */

insert  into `report`(`id`,`user_id`,`first_name`,`second_name`,`report_type`,`symptom`,`additional_info`,`video_or_image`,`address`,`city`,`state`,`country`,`lat`,`lng`,`created_at`,`updated_at`,`collection_id`) values 
(59,39,NULL,NULL,'self report','1',NULL,'5ec020cecd66d1589649614181.jpeg','Anambra','Anambra','Anambra','Anambra','18.011253488966474','102.62958107249214','2020-05-16 19:20:14','2020-06-16 20:09:16',1),
(60,39,NULL,NULL,'self report','1,2,3,4,7,8,6,5',NULL,'5ec02c6b413c21589652586430.jpeg','Anambra','Anambra','Anambra','Anambra','16.57440472146835','94.19646628074561','2020-05-16 20:09:47','2020-06-16 20:09:16',1),
(61,39,NULL,NULL,'self report','1,2','dfg','5ec0688c6fdc81589667979518.jpeg','Anambra','Anambra','Anambra','Anambra','18.01129426418969','102.6297487529972','2020-05-17 00:26:20','2020-06-16 20:09:15',1),
(62,39,NULL,NULL,'self report','5,6','gyu','5ec07c22f11aa1589672993829.jpeg','Anambra','Anambra','Anambra','Anambra','15.829186761910382','89.84889132317262','2020-05-17 01:49:54','2020-06-16 20:09:15',1),
(63,39,NULL,NULL,'self report','2,7','gyufvyg','5ec1267088f1e1589716591812.jpeg','Anambra','Anambra','Anambra','Anambra','15.829203481611252','89.84883996121634','2020-05-17 13:56:32','2020-06-16 20:09:15',1),
(64,39,'','','self report','1','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','18.01127817397629','102.62976218014957','2020-05-22 12:05:37','2020-06-16 20:09:14',1),
(65,39,'','','self report','2','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','17.85707751799285','101.72177910804749','2020-05-22 12:05:37','2020-06-16 20:09:14',1),
(66,39,'','','self report','1','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','18.01127817397629','102.62976218014957','2020-05-22 12:07:04','2020-06-16 20:09:13',1),
(67,39,'','','self report','2','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','17.85707751799285','101.72177910804749','2020-05-22 12:07:04','2020-06-16 20:09:14',1),
(68,39,'','','self report','1','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','18.01127817397629','102.62976218014957','2020-05-22 12:11:06','2020-06-16 20:09:13',1),
(69,39,'','','self report','2','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','17.85707751799285','101.72177910804749','2020-05-22 12:11:06','2020-06-16 20:09:13',1),
(70,39,'','','self report','6','t',NULL,'Anambra','Anambra','Anambra','Anambra','16.132015392338943','91.61358475685118','2020-05-22 12:12:55','2020-06-16 20:09:12',1),
(71,39,'','','self report','3,7','fg',NULL,'Anambra','Anambra','Anambra','Anambra','18.0112536228214','102.62975614517927','2020-05-22 12:12:55','2020-06-16 20:09:12',1),
(72,39,'','','self report','6','tgv',NULL,'Anambra','Anambra','Anambra','Anambra','18.0112536228214','102.62975614517927','2020-05-22 12:15:57','2020-06-16 20:09:11',2),
(73,39,'','','self report','1','fgh',NULL,'Anambra','Anambra','Anambra','Anambra','18.0112536228214','102.62975614517927','2020-05-22 12:18:25','2020-06-16 20:09:11',1),
(74,39,'','','self report','5','dfg',NULL,'Anambra','Anambra','Anambra','Anambra','15.101602778181899','85.62253832817078','2020-05-22 13:18:58','2020-06-16 20:09:08',1),
(75,94,NULL,NULL,'self report','6,7,5,8',NULL,NULL,'71/708, Thaltej, Ahmedabad, Gujarat 380054, India','Ahmedabad','Gujarat','India','23.057489780127952','72.52504631632097','2020-05-28 18:24:15','2020-06-16 20:05:06',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
