/*
 Navicat Premium Data Transfer

 Source Server         : corona_db
 Source Server Type    : MySQL
 Source Server Version : 50616
 Source Host           : localhost:3306
 Source Schema         : corona_db

 Target Server Type    : MySQL
 Target Server Version : 50616
 File Encoding         : 65001

 Date: 11/03/2022 23:42:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'admin', 'admin@gmail.com', 'admin', '', NULL, NULL);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for check_in
-- ----------------------------
DROP TABLE IF EXISTS `check_in`;
CREATE TABLE `check_in`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `user_id` int(11) NULL DEFAULT NULL,
  `people` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time` datetime(0) NULL DEFAULT NULL,
  `utilities` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `additional_info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for chv_list
-- ----------------------------
DROP TABLE IF EXISTS `chv_list`;
CREATE TABLE `chv_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `age` int(11) NULL DEFAULT NULL,
  `id_num` int(11) NULL DEFAULT NULL,
  `nhif` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `village` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nearname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mask` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `provide` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mal` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `diabet` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `hyper` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ward` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `indicate` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for chv_mother_list
-- ----------------------------
DROP TABLE IF EXISTS `chv_mother_list`;
CREATE TABLE `chv_mother_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `age` int(11) NULL DEFAULT NULL,
  `nhif` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_id` int(11) NULL DEFAULT NULL,
  `tel_num` int(11) NULL DEFAULT NULL,
  `clinic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `due_date` datetime(0) NULL DEFAULT NULL,
  `folic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mary` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `children` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `village` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ward` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for collection_center
-- ----------------------------
DROP TABLE IF EXISTS `collection_center`;
CREATE TABLE `collection_center`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of collection_center
-- ----------------------------
INSERT INTO `collection_center` VALUES (1, 'new collection', NULL, '2020-06-16 20:04:03');
INSERT INTO `collection_center` VALUES (2, 'collection center2', NULL, '2020-06-16 20:04:20');

-- ----------------------------
-- Table structure for colors_against_symptoms
-- ----------------------------
DROP TABLE IF EXISTS `colors_against_symptoms`;
CREATE TABLE `colors_against_symptoms`  (
  `number_of_symptoms` int(11) NULL DEFAULT NULL,
  `color_code` varchar(254) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of colors_against_symptoms
-- ----------------------------
INSERT INTO `colors_against_symptoms` VALUES (35, 'green');

-- ----------------------------
-- Table structure for enforce
-- ----------------------------
DROP TABLE IF EXISTS `enforce`;
CREATE TABLE `enforce`  (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for gbv_list
-- ----------------------------
DROP TABLE IF EXISTS `gbv_list`;
CREATE TABLE `gbv_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `county` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nature` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `age` int(11) NULL DEFAULT NULL,
  `report_date` datetime(0) NULL DEFAULT NULL,
  `report_place` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for information_center
-- ----------------------------
DROP TABLE IF EXISTS `information_center`;
CREATE TABLE `information_center`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `seen` int(2) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_04_24_002221_create_news_table', 1);
INSERT INTO `migrations` VALUES (4, '2018_04_30_000740_create_categories_table', 1);
INSERT INTO `migrations` VALUES (5, '2018_05_05_051928_update_news_table', 1);
INSERT INTO `migrations` VALUES (6, '2018_05_07_140243_alter_news_table', 1);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for report
-- ----------------------------
DROP TABLE IF EXISTS `report`;
CREATE TABLE `report`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `second_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `report_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `symptom` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `additional_info` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `video_or_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `lng` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `collection_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `collection_center`(`collection_id`) USING BTREE,
  CONSTRAINT `collection_center` FOREIGN KEY (`collection_id`) REFERENCES `collection_center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 76 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of report
-- ----------------------------
INSERT INTO `report` VALUES (59, 39, NULL, NULL, 'self report', '1', NULL, '5ec020cecd66d1589649614181.jpeg', 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.011253488966474', '102.62958107249214', '2020-05-16 19:20:14', '2020-06-16 20:09:16', 1);
INSERT INTO `report` VALUES (60, 39, NULL, NULL, 'self report', '1,2,3,4,7,8,6,5', NULL, '5ec02c6b413c21589652586430.jpeg', 'Anambra', 'Anambra', 'Anambra', 'Anambra', '16.57440472146835', '94.19646628074561', '2020-05-16 20:09:47', '2020-06-16 20:09:16', 1);
INSERT INTO `report` VALUES (61, 39, NULL, NULL, 'self report', '1,2', 'dfg', '5ec0688c6fdc81589667979518.jpeg', 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.01129426418969', '102.6297487529972', '2020-05-17 00:26:20', '2020-06-16 20:09:15', 1);
INSERT INTO `report` VALUES (62, 39, NULL, NULL, 'self report', '5,6', 'gyu', '5ec07c22f11aa1589672993829.jpeg', 'Anambra', 'Anambra', 'Anambra', 'Anambra', '15.829186761910382', '89.84889132317262', '2020-05-17 01:49:54', '2020-06-16 20:09:15', 1);
INSERT INTO `report` VALUES (63, 39, NULL, NULL, 'self report', '2,7', 'gyufvyg', '5ec1267088f1e1589716591812.jpeg', 'Anambra', 'Anambra', 'Anambra', 'Anambra', '15.829203481611252', '89.84883996121634', '2020-05-17 13:56:32', '2020-06-16 20:09:15', 1);
INSERT INTO `report` VALUES (64, 39, '', '', 'self report', '1', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.01127817397629', '102.62976218014957', '2020-05-22 12:05:37', '2020-06-16 20:09:14', 1);
INSERT INTO `report` VALUES (65, 39, '', '', 'self report', '2', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '17.85707751799285', '101.72177910804749', '2020-05-22 12:05:37', '2020-06-16 20:09:14', 1);
INSERT INTO `report` VALUES (66, 39, '', '', 'self report', '1', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.01127817397629', '102.62976218014957', '2020-05-22 12:07:04', '2020-06-16 20:09:13', 1);
INSERT INTO `report` VALUES (67, 39, '', '', 'self report', '2', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '17.85707751799285', '101.72177910804749', '2020-05-22 12:07:04', '2020-06-16 20:09:14', 1);
INSERT INTO `report` VALUES (68, 39, '', '', 'self report', '1', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.01127817397629', '102.62976218014957', '2020-05-22 12:11:06', '2020-06-16 20:09:13', 1);
INSERT INTO `report` VALUES (69, 39, '', '', 'self report', '2', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '17.85707751799285', '101.72177910804749', '2020-05-22 12:11:06', '2020-06-16 20:09:13', 1);
INSERT INTO `report` VALUES (70, 39, '', '', 'self report', '6', 't', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '16.132015392338943', '91.61358475685118', '2020-05-22 12:12:55', '2020-06-16 20:09:12', 1);
INSERT INTO `report` VALUES (71, 39, '', '', 'self report', '3,7', 'fg', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.0112536228214', '102.62975614517927', '2020-05-22 12:12:55', '2020-06-16 20:09:12', 1);
INSERT INTO `report` VALUES (72, 39, '', '', 'self report', '6', 'tgv', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.0112536228214', '102.62975614517927', '2020-05-22 12:15:57', '2020-06-16 20:09:11', 2);
INSERT INTO `report` VALUES (73, 39, '', '', 'self report', '1', 'fgh', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '18.0112536228214', '102.62975614517927', '2020-05-22 12:18:25', '2020-06-16 20:09:11', 1);
INSERT INTO `report` VALUES (74, 39, '', '', 'self report', '5', 'dfg', NULL, 'Anambra', 'Anambra', 'Anambra', 'Anambra', '15.101602778181899', '85.62253832817078', '2020-05-22 13:18:58', '2020-06-16 20:09:08', 1);
INSERT INTO `report` VALUES (75, 94, NULL, NULL, 'self report', '6,7,5,8', NULL, NULL, '71/708, Thaltej, Ahmedabad, Gujarat 380054, India', 'Ahmedabad', 'Gujarat', 'India', '23.057489780127952', '72.52504631632097', '2020-05-28 18:24:15', '2020-06-16 20:05:06', 2);

-- ----------------------------
-- Table structure for report_notifications
-- ----------------------------
DROP TABLE IF EXISTS `report_notifications`;
CREATE TABLE `report_notifications`  (
  `notification_count` int(11) NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of report_notifications
-- ----------------------------
INSERT INTO `report_notifications` VALUES (0, 1, '[]', '2022-03-05 05:12:32');

-- ----------------------------
-- Table structure for symptoms
-- ----------------------------
DROP TABLE IF EXISTS `symptoms`;
CREATE TABLE `symptoms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symptom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of symptoms
-- ----------------------------
INSERT INTO `symptoms` VALUES (1, 'fever');
INSERT INTO `symptoms` VALUES (2, 'cough');
INSERT INTO `symptoms` VALUES (3, 'tiredness');
INSERT INTO `symptoms` VALUES (4, 'loss of taste ');
INSERT INTO `symptoms` VALUES (5, 'smell');

-- ----------------------------
-- Table structure for tracing
-- ----------------------------
DROP TABLE IF EXISTS `tracing`;
CREATE TABLE `tracing`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passenger_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `unique_card_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `service_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tel_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vehicle_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `destination` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tracing_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `publish_date` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `home_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tracing_passenger
-- ----------------------------
DROP TABLE IF EXISTS `tracing_passenger`;
CREATE TABLE `tracing_passenger`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `id_num` int(11) NULL DEFAULT NULL,
  `passenger_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `temp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tel_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vehicle_num` int(11) NULL DEFAULT NULL,
  `seat_num` int(11) NULL DEFAULT NULL,
  `from_village` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `to_village` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `publish_date` datetime(0) NULL DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_num` int(11) NULL DEFAULT NULL,
  `infect_str` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `history_last` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `collection_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `age` int(11) NULL DEFAULT NULL,
  `collection_id` int(11) NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enforce_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gover_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `border_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `gbv_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `chv_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_type_id` int(11) NULL DEFAULT NULL,
  `user_role` int(1) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 33, 1, 'alek', 'todo', 'alek@gmail.com', 'male', 'on', NULL, '1', '1', '1', '1', '1', 1, NULL, '21232f297a57a5a743894a0e4a801fc3', '2022-03-11 19:57:53', '2022-03-11 19:27:17');
INSERT INTO `users` VALUES (2, 33, NULL, 'sammy', 'sss', 'sammy@gmail.com', 'male', 'on', NULL, NULL, '1', NULL, NULL, NULL, 1, NULL, '21232f297a57a5a743894a0e4a801fc3', '2022-03-11 19:44:20', '2022-03-11 19:43:54');
INSERT INTO `users` VALUES (3, 33, 2, 'sammy', 'sss', 'sammy1@gmail.com', 'male', 'on', NULL, NULL, '1', '1', '1', '1', 1, NULL, '21232f297a57a5a743894a0e4a801fc3', '2022-03-11 19:57:56', '2022-03-11 19:44:07');

SET FOREIGN_KEY_CHECKS = 1;
