/*
Navicat MySQL Data Transfer

Source Server         : DE100
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : arma_online

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2016-11-24 17:19:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `text` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of logs
-- ----------------------------

-- ----------------------------
-- Table structure for `tracker`
-- ----------------------------
DROP TABLE IF EXISTS `tracker`;
CREATE TABLE `tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT '0',
  `ipAddr` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `trackedTime` int(11) DEFAULT NULL,
  `action` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tracker
-- ----------------------------
INSERT INTO `tracker` VALUES ('1', '0', '79.243.254.103', '1478781985', 'login');
INSERT INTO `tracker` VALUES ('2', '0', '79.243.254.103', '1478782052', 'login');
INSERT INTO `tracker` VALUES ('3', '0', '79.243.254.103', '1478783509', 'login');
INSERT INTO `tracker` VALUES ('4', '0', '79.243.254.103', '1478783521', 'login');
INSERT INTO `tracker` VALUES ('5', '0', '79.243.254.103', '1478783544', 'login');
INSERT INTO `tracker` VALUES ('6', '0', '79.243.254.103', '1478784219', 'login');
INSERT INTO `tracker` VALUES ('7', '0', '79.243.254.103', '1478786289', 'login');
INSERT INTO `tracker` VALUES ('8', '0', '79.243.254.103', '1478786294', 'login');
INSERT INTO `tracker` VALUES ('9', '1', '79.243.254.103', '1478786384', 'login');
INSERT INTO `tracker` VALUES ('10', '1', '79.243.254.103', '1478786387', 'login');
INSERT INTO `tracker` VALUES ('11', '0', '5.61.139.203', '1478786684', 'login');
INSERT INTO `tracker` VALUES ('12', '0', '5.61.139.203', '1478786693', 'login');
INSERT INTO `tracker` VALUES ('13', '0', '5.61.139.203', '1478786704', 'login');
INSERT INTO `tracker` VALUES ('14', '0', '79.243.254.103', '1478786746', 'login');
INSERT INTO `tracker` VALUES ('15', '0', '5.61.139.203', '1478786754', 'login');
INSERT INTO `tracker` VALUES ('16', '0', '78.42.5.151', '1478790498', 'login');
INSERT INTO `tracker` VALUES ('17', '0', '79.243.254.103', '1478790644', 'login');
INSERT INTO `tracker` VALUES ('18', '0', '79.243.254.103', '1478792154', 'login');
INSERT INTO `tracker` VALUES ('19', '0', '78.42.5.151', '1478792694', 'login');
INSERT INTO `tracker` VALUES ('20', '0', '79.243.254.103', '1478798385', 'login');
INSERT INTO `tracker` VALUES ('21', '0', '79.243.254.103', '1478798521', 'login');
INSERT INTO `tracker` VALUES ('22', '0', '37.201.243.2', '1478798525', 'login');
INSERT INTO `tracker` VALUES ('23', '0', '79.243.254.103', '1478799230', 'login');
INSERT INTO `tracker` VALUES ('24', '0', '79.243.254.103', '1478799356', 'login');
INSERT INTO `tracker` VALUES ('25', '0', '79.243.254.103', '1478805840', 'login');
INSERT INTO `tracker` VALUES ('26', '0', '79.243.254.103', '1478806424', 'login');
INSERT INTO `tracker` VALUES ('27', '0', '79.243.254.103', '1478806700', 'login');
INSERT INTO `tracker` VALUES ('28', '0', '79.243.254.103', '1478809098', 'login');
INSERT INTO `tracker` VALUES ('29', '0', '79.243.254.103', '1478809670', 'login');
INSERT INTO `tracker` VALUES ('30', '0', '109.84.3.118', '1478844679', 'login');
INSERT INTO `tracker` VALUES ('31', '0', '109.84.2.109', '1478857152', 'login');
INSERT INTO `tracker` VALUES ('32', '0', '79.243.247.157', '1478864889', 'login');
INSERT INTO `tracker` VALUES ('33', '0', '79.243.247.157', '1478864931', 'login');
INSERT INTO `tracker` VALUES ('34', '0', '79.243.247.157', '1478865735', 'login');
INSERT INTO `tracker` VALUES ('35', '0', '79.243.247.157', '1478865740', 'login');
INSERT INTO `tracker` VALUES ('36', '0', '79.243.247.157', '1478865761', 'login');
INSERT INTO `tracker` VALUES ('37', '0', '79.243.247.157', '1478865812', 'login');
INSERT INTO `tracker` VALUES ('38', '1', '79.243.247.157', '1478866410', 'login');
INSERT INTO `tracker` VALUES ('39', '0', '37.201.243.2', '1478867878', 'login');
INSERT INTO `tracker` VALUES ('40', '0', '37.201.243.2', '1478867906', 'login');
INSERT INTO `tracker` VALUES ('41', '0', '37.201.243.2', '1478867906', 'login');
INSERT INTO `tracker` VALUES ('42', '0', '37.201.243.2', '1478867906', 'login');
INSERT INTO `tracker` VALUES ('43', '0', '37.201.243.2', '1478867906', 'login');
INSERT INTO `tracker` VALUES ('44', '0', '79.243.247.157', '1478868312', 'login');
INSERT INTO `tracker` VALUES ('45', '0', '79.243.247.157', '1478869079', 'login');
INSERT INTO `tracker` VALUES ('46', '0', '188.99.223.36', '1478869105', 'login');
INSERT INTO `tracker` VALUES ('47', '0', '188.99.223.36', '1478869143', 'login');
INSERT INTO `tracker` VALUES ('48', '0', '188.99.223.36', '1478869147', 'login');
INSERT INTO `tracker` VALUES ('49', '0', '188.99.223.36', '1478869153', 'login');
INSERT INTO `tracker` VALUES ('50', '0', '37.201.243.2', '1478869171', 'login');
INSERT INTO `tracker` VALUES ('51', '0', '164.132.204.214', '1478869223', 'login');
INSERT INTO `tracker` VALUES ('52', '0', '79.243.247.157', '1478873415', 'login');
INSERT INTO `tracker` VALUES ('53', '0', '79.243.247.157', '1478873454', 'login');
INSERT INTO `tracker` VALUES ('54', '0', '37.201.243.2', '1478875842', 'login');
INSERT INTO `tracker` VALUES ('55', '0', '37.201.243.2', '1478875847', 'login');
INSERT INTO `tracker` VALUES ('56', '0', '79.243.247.157', '1478875876', 'login');
INSERT INTO `tracker` VALUES ('57', '0', '79.243.247.157', '1478875889', 'login');
INSERT INTO `tracker` VALUES ('58', '0', '79.243.247.157', '1478875895', 'login');
INSERT INTO `tracker` VALUES ('59', '0', '79.243.247.157', '1478875916', 'login');
INSERT INTO `tracker` VALUES ('60', '0', '37.201.243.2', '1478875953', 'login');
INSERT INTO `tracker` VALUES ('61', '0', '79.243.247.157', '1478875956', 'login');
INSERT INTO `tracker` VALUES ('62', '0', '37.201.243.2', '1478875991', 'login');
INSERT INTO `tracker` VALUES ('64', '0', '79.243.247.157', '1478876806', 'login');
INSERT INTO `tracker` VALUES ('65', '0', '79.223.91.170', '1478878148', 'login');
INSERT INTO `tracker` VALUES ('66', '0', '79.243.247.157', '1478879142', 'login');
INSERT INTO `tracker` VALUES ('67', '0', '79.243.247.157', '1478879208', 'login');
INSERT INTO `tracker` VALUES ('68', '0', '79.243.247.157', '1478879252', 'login');
INSERT INTO `tracker` VALUES ('69', '0', '79.223.91.170', '1478882816', 'login');
INSERT INTO `tracker` VALUES ('70', '0', '109.84.2.247', '1478889680', 'login');
INSERT INTO `tracker` VALUES ('71', '0', '109.84.2.247', '1478889713', 'login');
INSERT INTO `tracker` VALUES ('72', '0', '79.223.88.93', '1478891536', 'login');
INSERT INTO `tracker` VALUES ('73', '0', '37.201.243.2', '1478892527', 'login');
INSERT INTO `tracker` VALUES ('74', '0', '79.243.247.157', '1478892532', 'login');
INSERT INTO `tracker` VALUES ('75', '0', '79.243.247.157', '1478894176', 'login');
INSERT INTO `tracker` VALUES ('76', '0', '95.91.233.88', '1478946677', 'login');
INSERT INTO `tracker` VALUES ('77', '0', '95.91.233.88', '1478946692', 'login');
INSERT INTO `tracker` VALUES ('78', '0', '79.243.235.102', '1478949679', 'login');
INSERT INTO `tracker` VALUES ('79', '0', '46.87.177.212', '1478953645', 'login');
INSERT INTO `tracker` VALUES ('80', '0', '149.172.51.92', '1478955564', 'login');
INSERT INTO `tracker` VALUES ('81', '0', '149.172.51.92', '1478955571', 'login');
INSERT INTO `tracker` VALUES ('82', '0', '149.172.51.92', '1478955581', 'login');
INSERT INTO `tracker` VALUES ('83', '0', '87.178.73.129', '1478956014', 'login');
INSERT INTO `tracker` VALUES ('84', '0', '87.178.73.129', '1478956020', 'login');
INSERT INTO `tracker` VALUES ('85', '0', '79.243.235.102', '1478962191', 'login');
INSERT INTO `tracker` VALUES ('86', '0', '149.172.51.92', '1478962392', 'login');
INSERT INTO `tracker` VALUES ('87', '1', '79.243.235.102', '1478962394', 'login');
INSERT INTO `tracker` VALUES ('88', '0', '79.243.235.102', '1478962403', 'login');
INSERT INTO `tracker` VALUES ('89', '0', '149.172.51.92', '1478968121', 'login');
INSERT INTO `tracker` VALUES ('90', '0', '149.172.51.92', '1478968126', 'login');
INSERT INTO `tracker` VALUES ('91', '0', '109.84.2.164', '1478974889', 'login');
INSERT INTO `tracker` VALUES ('92', '0', '109.84.2.174', '1478982976', 'login');
INSERT INTO `tracker` VALUES ('93', '0', '149.172.51.92', '1478988289', 'login');
INSERT INTO `tracker` VALUES ('94', '0', '79.243.235.102', '1478988822', 'login');
INSERT INTO `tracker` VALUES ('95', '0', '79.243.235.102', '1478989627', 'login');
INSERT INTO `tracker` VALUES ('96', '0', '79.243.235.102', '1478996088', 'login');
INSERT INTO `tracker` VALUES ('97', '0', '149.172.51.92', '1479006856', 'login');
INSERT INTO `tracker` VALUES ('98', '0', '149.172.51.92', '1479006863', 'login');
INSERT INTO `tracker` VALUES ('99', '0', '79.243.234.167', '1479033354', 'login');
INSERT INTO `tracker` VALUES ('100', '0', '79.243.234.167', '1479039519', 'login');
INSERT INTO `tracker` VALUES ('101', '1', '79.243.234.167', '1479042178', 'login');
INSERT INTO `tracker` VALUES ('102', '0', '149.172.51.92', '1479048163', 'login');
INSERT INTO `tracker` VALUES ('103', '0', '149.172.51.92', '1479048171', 'login');
INSERT INTO `tracker` VALUES ('104', '0', '79.243.234.167', '1479053276', 'login');
INSERT INTO `tracker` VALUES ('105', '1', '79.243.234.167', '1479053695', 'login');
INSERT INTO `tracker` VALUES ('106', '0', '93.217.213.240', '1479053828', 'login');
INSERT INTO `tracker` VALUES ('107', '0', '79.243.234.167', '1479057940', 'login');
INSERT INTO `tracker` VALUES ('108', '0', '95.91.233.88', '1479057979', 'login');
INSERT INTO `tracker` VALUES ('109', '0', '95.91.233.88', '1479058052', 'login');
INSERT INTO `tracker` VALUES ('110', '0', '37.201.243.2', '1479059563', 'login');
INSERT INTO `tracker` VALUES ('111', '0', '149.172.51.92', '1479059952', 'login');
INSERT INTO `tracker` VALUES ('112', '0', '149.172.51.92', '1479059958', 'login');
INSERT INTO `tracker` VALUES ('113', '0', '79.243.234.167', '1479064565', 'login');
INSERT INTO `tracker` VALUES ('114', '0', '79.243.234.167', '1479073962', 'login');
INSERT INTO `tracker` VALUES ('115', '0', '79.243.234.167', '1479075794', 'login');
INSERT INTO `tracker` VALUES ('116', '0', '188.99.223.36', '1479118141', 'login');
INSERT INTO `tracker` VALUES ('117', '0', '109.84.3.243', '1479121021', 'login');
INSERT INTO `tracker` VALUES ('118', '0', '149.172.51.92', '1479122643', 'login');
INSERT INTO `tracker` VALUES ('119', '0', '109.84.1.138', '1479129912', 'login');
INSERT INTO `tracker` VALUES ('120', '1', '79.243.233.175', '1479140005', 'login');
INSERT INTO `tracker` VALUES ('121', '0', '79.243.233.175', '1479140231', 'login');
INSERT INTO `tracker` VALUES ('122', '0', '79.243.233.175', '1479140335', 'login');
INSERT INTO `tracker` VALUES ('123', '0', '79.243.233.175', '1479151771', 'login');
INSERT INTO `tracker` VALUES ('124', '0', '79.243.233.175', '1479151797', 'login');
INSERT INTO `tracker` VALUES ('125', '0', '79.243.233.175', '1479156112', 'login');
INSERT INTO `tracker` VALUES ('126', '0', '79.243.233.175', '1479157262', 'login');
INSERT INTO `tracker` VALUES ('127', '0', '88.128.80.222', '1479207268', 'login');
INSERT INTO `tracker` VALUES ('128', '0', '89.204.139.36', '1479207433', 'login');
INSERT INTO `tracker` VALUES ('129', '0', '80.146.228.74', '1479208680', 'login');
INSERT INTO `tracker` VALUES ('130', '0', '80.146.228.74', '1479208691', 'login');
INSERT INTO `tracker` VALUES ('131', '0', '95.91.241.53', '1479216084', 'login');
INSERT INTO `tracker` VALUES ('132', '0', '95.91.241.53', '1479224930', 'login');
INSERT INTO `tracker` VALUES ('133', '0', '95.91.241.53', '1479226050', 'login');
INSERT INTO `tracker` VALUES ('134', '0', '95.91.241.53', '1479230009', 'login');
INSERT INTO `tracker` VALUES ('135', '0', '79.243.241.154', '1479238158', 'login');
INSERT INTO `tracker` VALUES ('136', '0', '149.172.51.92', '1479275436', 'login');
INSERT INTO `tracker` VALUES ('137', '0', '95.91.241.142', '1479299363', 'login');
INSERT INTO `tracker` VALUES ('138', '0', '149.172.51.92', '1479306883', 'login');
INSERT INTO `tracker` VALUES ('139', '0', '95.91.241.142', '1479306992', 'login');
INSERT INTO `tracker` VALUES ('140', '0', '95.91.241.142', '1479307005', 'login');
INSERT INTO `tracker` VALUES ('141', '0', '149.172.51.92', '1479312246', 'login');
INSERT INTO `tracker` VALUES ('142', '0', '149.172.51.92', '1479312252', 'login');
INSERT INTO `tracker` VALUES ('143', '0', '37.201.243.2', '1479312520', 'login');
INSERT INTO `tracker` VALUES ('144', '0', '37.201.243.2', '1479312532', 'login');
INSERT INTO `tracker` VALUES ('145', '0', '37.201.243.2', '1479312549', 'login');
INSERT INTO `tracker` VALUES ('146', '0', '79.243.232.66', '1479313938', 'login');
INSERT INTO `tracker` VALUES ('147', '0', '87.149.246.78', '1479320198', 'login');
INSERT INTO `tracker` VALUES ('148', '0', '87.149.246.78', '1479320298', 'login');
INSERT INTO `tracker` VALUES ('149', '0', '87.149.246.78', '1479320321', 'login');
INSERT INTO `tracker` VALUES ('150', '0', '87.149.246.78', '1479320457', 'login');
INSERT INTO `tracker` VALUES ('151', '0', '87.149.246.78', '1479324989', 'login');
INSERT INTO `tracker` VALUES ('152', '0', '87.149.246.78', '1479324990', 'login');
INSERT INTO `tracker` VALUES ('153', '0', '87.149.246.78', '1479324991', 'login');
INSERT INTO `tracker` VALUES ('154', '0', '87.149.246.78', '1479324994', 'login');
INSERT INTO `tracker` VALUES ('155', '0', '87.149.246.78', '1479324997', 'login');
INSERT INTO `tracker` VALUES ('156', '0', '95.91.233.88', '1479325108', 'login');
INSERT INTO `tracker` VALUES ('157', '0', '37.201.243.2', '1479325270', 'login');
INSERT INTO `tracker` VALUES ('158', '0', '37.201.243.2', '1479325819', 'login');
INSERT INTO `tracker` VALUES ('159', '0', '149.172.51.92', '1479327340', 'login');
INSERT INTO `tracker` VALUES ('160', '0', '79.243.232.66', '1479332127', 'login');
INSERT INTO `tracker` VALUES ('161', '0', '149.172.51.92', '1479370809', 'login');
INSERT INTO `tracker` VALUES ('162', '0', '149.172.51.92', '1479370815', 'login');
INSERT INTO `tracker` VALUES ('163', '0', '79.223.69.185', '1479378542', 'login');
INSERT INTO `tracker` VALUES ('164', '0', '79.223.69.185', '1479378550', 'login');
INSERT INTO `tracker` VALUES ('165', '0', '79.223.69.185', '1479378832', 'login');
INSERT INTO `tracker` VALUES ('166', '0', '79.223.69.185', '1479378839', 'login');
INSERT INTO `tracker` VALUES ('167', '0', '79.223.69.185', '1479378976', 'login');
INSERT INTO `tracker` VALUES ('168', '0', '87.149.246.78', '1479380463', 'login');
INSERT INTO `tracker` VALUES ('169', '0', '87.149.246.78', '1479380468', 'login');
INSERT INTO `tracker` VALUES ('170', '0', '85.182.227.162', '1479380506', 'login');
INSERT INTO `tracker` VALUES ('171', '0', '149.172.51.92', '1479385258', 'login');
INSERT INTO `tracker` VALUES ('172', '0', '95.91.211.1', '1479385918', 'login');
INSERT INTO `tracker` VALUES ('173', '0', '79.243.246.97', '1479392187', 'login');
INSERT INTO `tracker` VALUES ('174', '0', '95.91.211.1', '1479399950', 'login');
INSERT INTO `tracker` VALUES ('175', '0', '37.201.243.2', '1479401043', 'login');
INSERT INTO `tracker` VALUES ('176', '0', '95.91.211.1', '1479403362', 'login');
INSERT INTO `tracker` VALUES ('177', '0', '79.243.246.97', '1479409518', 'login');
INSERT INTO `tracker` VALUES ('178', '0', '149.172.51.92', '1479421246', 'login');
INSERT INTO `tracker` VALUES ('179', '0', '79.243.237.196', '1479447392', 'login');
INSERT INTO `tracker` VALUES ('180', '0', '109.84.0.139', '1479467325', 'login');
INSERT INTO `tracker` VALUES ('181', '0', '79.251.133.114', '1479472165', 'login');
INSERT INTO `tracker` VALUES ('182', '0', '79.251.133.114', '1479472175', 'login');
INSERT INTO `tracker` VALUES ('183', '0', '79.251.133.114', '1479472182', 'login');
INSERT INTO `tracker` VALUES ('184', '0', '79.251.133.114', '1479472194', 'login');
INSERT INTO `tracker` VALUES ('185', '0', '79.243.237.196', '1479472759', 'login');
INSERT INTO `tracker` VALUES ('186', '0', '79.251.133.114', '1479472822', 'login');
INSERT INTO `tracker` VALUES ('187', '0', '95.91.241.27', '1479494147', 'login');
INSERT INTO `tracker` VALUES ('188', '0', '79.243.237.196', '1479495820', 'login');
INSERT INTO `tracker` VALUES ('189', '0', '79.243.237.196', '1479496980', 'login');
INSERT INTO `tracker` VALUES ('190', '0', '149.172.51.92', '1479497022', 'login');
INSERT INTO `tracker` VALUES ('191', '0', '79.251.133.114', '1479499116', 'login');
INSERT INTO `tracker` VALUES ('192', '0', '79.251.133.114', '1479499121', 'login');
INSERT INTO `tracker` VALUES ('193', '0', '87.149.246.78', '1479499266', 'login');
INSERT INTO `tracker` VALUES ('194', '0', '149.172.51.92', '1479499795', 'login');
INSERT INTO `tracker` VALUES ('195', '0', '37.201.243.2', '1479499842', 'login');
INSERT INTO `tracker` VALUES ('196', '0', '95.91.241.27', '1479500054', 'login');
INSERT INTO `tracker` VALUES ('197', '0', '95.91.241.27', '1479504586', 'login');
INSERT INTO `tracker` VALUES ('198', '0', '79.243.237.196', '1479516472', 'login');
INSERT INTO `tracker` VALUES ('199', '0', '79.243.237.196', '1479516720', 'login');
INSERT INTO `tracker` VALUES ('200', '0', '95.91.233.88', '1479516951', 'login');
INSERT INTO `tracker` VALUES ('201', '0', '149.172.51.92', '1479551179', 'login');
INSERT INTO `tracker` VALUES ('202', '0', '79.243.253.218', '1479553352', 'login');
INSERT INTO `tracker` VALUES ('203', '0', '::1', '1479557326', 'login');
INSERT INTO `tracker` VALUES ('204', '0', '149.172.51.92', '1479557456', 'login');
INSERT INTO `tracker` VALUES ('205', '0', '::1', '1479557577', 'login');
INSERT INTO `tracker` VALUES ('206', '0', '::1', '1479558511', 'login');
INSERT INTO `tracker` VALUES ('207', '0', '::1', '1479558593', 'login');
INSERT INTO `tracker` VALUES ('208', '0', '::1', '1479558800', 'login');
INSERT INTO `tracker` VALUES ('209', '0', '::1', '1479558880', 'login');
INSERT INTO `tracker` VALUES ('210', '0', '79.243.253.218', '1479561193', 'login');
INSERT INTO `tracker` VALUES ('211', '0', '79.243.253.218', '1479569835', 'login');
INSERT INTO `tracker` VALUES ('212', '0', '95.91.241.27', '1479585482', 'login');
INSERT INTO `tracker` VALUES ('213', '0', '79.243.253.218', '1479588469', 'login');
INSERT INTO `tracker` VALUES ('219', '0', '::1', '1479593888', 'login');
INSERT INTO `tracker` VALUES ('220', '0', '::1', '1479593924', 'login');
INSERT INTO `tracker` VALUES ('221', '0', '::1', '1479593993', 'login');
INSERT INTO `tracker` VALUES ('222', '0', '::1', '1479594098', 'login');
INSERT INTO `tracker` VALUES ('223', '0', '::1', '1479594412', 'login');
INSERT INTO `tracker` VALUES ('224', '0', '::1', '1479598059', 'login');
INSERT INTO `tracker` VALUES ('225', '0', '79.243.253.218', '1479602326', 'login');
INSERT INTO `tracker` VALUES ('226', '0', '78.35.88.33', '1479605804', 'login');
INSERT INTO `tracker` VALUES ('227', '0', '79.243.240.177', '1479653264', 'login');
INSERT INTO `tracker` VALUES ('228', '0', '::1', '1479654956', 'login');
INSERT INTO `tracker` VALUES ('229', '0', '149.172.51.92', '1479655846', 'login');
INSERT INTO `tracker` VALUES ('230', '0', '79.243.240.177', '1479656849', 'login');
INSERT INTO `tracker` VALUES ('231', '0', '109.84.2.228', '1479661413', 'login');
INSERT INTO `tracker` VALUES ('232', '0', '79.243.240.177', '1479662490', 'login');
INSERT INTO `tracker` VALUES ('233', '0', '79.243.240.177', '1479664255', 'login');
INSERT INTO `tracker` VALUES ('234', '0', '79.229.204.164', '1479665340', 'login');
INSERT INTO `tracker` VALUES ('235', '0', '79.229.204.164', '1479665345', 'login');
INSERT INTO `tracker` VALUES ('236', '0', '87.149.246.78', '1479665556', 'login');
INSERT INTO `tracker` VALUES ('237', '0', '95.91.241.27', '1479665856', 'login');
INSERT INTO `tracker` VALUES ('238', '0', '79.229.204.164', '1479669786', 'login');
INSERT INTO `tracker` VALUES ('239', '0', '79.229.204.164', '1479669791', 'login');
INSERT INTO `tracker` VALUES ('240', '0', '149.172.51.92', '1479670636', 'login');
INSERT INTO `tracker` VALUES ('241', '0', '79.243.240.177', '1479671178', 'login');
INSERT INTO `tracker` VALUES ('242', '0', '95.91.233.88', '1479671966', 'login');
INSERT INTO `tracker` VALUES ('243', '0', '79.243.240.177', '1479676589', 'login');
INSERT INTO `tracker` VALUES ('244', '0', '87.149.246.78', '1479687029', 'login');
INSERT INTO `tracker` VALUES ('245', '0', '149.172.51.92', '1479742602', 'login');
INSERT INTO `tracker` VALUES ('246', '0', '109.84.1.207', '1479743560', 'login');
INSERT INTO `tracker` VALUES ('247', '0', '95.91.241.27', '1479744430', 'login');
INSERT INTO `tracker` VALUES ('248', '0', '87.149.246.78', '1479744617', 'login');
INSERT INTO `tracker` VALUES ('249', '0', '149.172.51.92', '1479745034', 'login');
INSERT INTO `tracker` VALUES ('250', '0', '149.172.51.92', '1479746371', 'login');
INSERT INTO `tracker` VALUES ('251', '0', '87.149.246.78', '1479746625', 'login');
INSERT INTO `tracker` VALUES ('252', '0', '79.243.250.192', '1479747332', 'login');
INSERT INTO `tracker` VALUES ('253', '0', '::1', '1479747953', 'login');
INSERT INTO `tracker` VALUES ('254', '0', '87.149.246.78', '1479748671', 'login');
INSERT INTO `tracker` VALUES ('255', '0', '79.243.250.192', '1479752135', 'login');
INSERT INTO `tracker` VALUES ('256', '0', '149.172.51.92', '1479755267', 'login');
INSERT INTO `tracker` VALUES ('257', '0', '79.243.250.192', '1479756950', 'login');
INSERT INTO `tracker` VALUES ('258', '0', '149.172.51.92', '1479757904', 'login');
INSERT INTO `tracker` VALUES ('259', '0', '::1', '1479758260', 'login');
INSERT INTO `tracker` VALUES ('260', '0', '79.243.250.192', '1479763876', 'login');
INSERT INTO `tracker` VALUES ('261', '0', '149.172.51.92', '1479769074', 'login');
INSERT INTO `tracker` VALUES ('262', '0', '::1', '1479820918', 'login');
INSERT INTO `tracker` VALUES ('263', '0', '79.229.204.164', '1479827277', 'login');
INSERT INTO `tracker` VALUES ('264', '0', '79.229.204.164', '1479831258', 'login');
INSERT INTO `tracker` VALUES ('265', '0', '::1', '1479834064', 'login');
INSERT INTO `tracker` VALUES ('266', '0', '79.243.227.43', '1479834404', 'login');
INSERT INTO `tracker` VALUES ('267', '0', '::1', '1479835565', 'login');
INSERT INTO `tracker` VALUES ('268', '0', '79.243.227.43', '1479835801', 'login');
INSERT INTO `tracker` VALUES ('269', '0', '79.243.227.43', '1479837516', 'login');
INSERT INTO `tracker` VALUES ('270', '0', '79.229.204.164', '1479841187', 'login');
INSERT INTO `tracker` VALUES ('271', '0', '79.243.227.43', '1479849060', 'login');
INSERT INTO `tracker` VALUES ('272', '0', '::1', '1479849157', 'login');
INSERT INTO `tracker` VALUES ('273', '0', '::1', '1479849239', 'login');
INSERT INTO `tracker` VALUES ('274', '0', '87.149.246.78', '1479852430', 'login');
INSERT INTO `tracker` VALUES ('275', '0', '37.209.53.56', '1479852542', 'login');
INSERT INTO `tracker` VALUES ('276', '0', '37.209.53.56', '1479852624', 'login');
INSERT INTO `tracker` VALUES ('277', '0', '37.209.53.56', '1479852630', 'login');
INSERT INTO `tracker` VALUES ('278', '0', '37.209.53.56', '1479852666', 'login');
INSERT INTO `tracker` VALUES ('279', '0', '37.209.53.56', '1479853292', 'login');
INSERT INTO `tracker` VALUES ('280', '0', '79.243.241.64', '1479894565', 'login');
INSERT INTO `tracker` VALUES ('281', '0', '79.243.241.64', '1479897464', 'login');
INSERT INTO `tracker` VALUES ('282', '0', '149.172.51.92', '1479907802', 'login');
INSERT INTO `tracker` VALUES ('283', '0', '149.172.51.92', '1479913264', 'login');
INSERT INTO `tracker` VALUES ('284', '0', '79.229.204.164', '1479915471', 'login');
INSERT INTO `tracker` VALUES ('285', '0', '79.229.204.164', '1479915476', 'login');
INSERT INTO `tracker` VALUES ('286', '0', '95.91.241.128', '1479915491', 'login');
INSERT INTO `tracker` VALUES ('287', '0', '79.243.241.64', '1479917049', 'login');
INSERT INTO `tracker` VALUES ('288', '0', '::1', '1479917663', 'login');
INSERT INTO `tracker` VALUES ('289', '0', '37.209.53.56', '1479918791', 'login');
INSERT INTO `tracker` VALUES ('290', '0', '87.149.246.78', '1479921052', 'login');
INSERT INTO `tracker` VALUES ('291', '0', '::1', '1479922845', 'login');
INSERT INTO `tracker` VALUES ('292', '0', '37.209.53.56', '1479923048', 'login');
INSERT INTO `tracker` VALUES ('293', '0', '37.209.53.56', '1479923059', 'login');
INSERT INTO `tracker` VALUES ('294', '0', '37.209.53.56', '1479923072', 'login');
INSERT INTO `tracker` VALUES ('295', '0', '37.209.53.56', '1479923077', 'login');
INSERT INTO `tracker` VALUES ('296', '0', '79.243.241.64', '1479925502', 'login');
INSERT INTO `tracker` VALUES ('297', '0', '95.91.241.128', '1479926873', 'login');
INSERT INTO `tracker` VALUES ('298', '0', '79.243.241.64', '1479929575', 'login');
INSERT INTO `tracker` VALUES ('299', '0', '::1', '1479930050', 'login');
INSERT INTO `tracker` VALUES ('300', '0', '95.91.233.88', '1479932011', 'login');
INSERT INTO `tracker` VALUES ('301', '0', '::1', '1479932025', 'login');
INSERT INTO `tracker` VALUES ('302', '0', '149.172.51.92', '1479933839', 'login');
INSERT INTO `tracker` VALUES ('303', '0', '79.243.241.64', '1479934661', 'login');
INSERT INTO `tracker` VALUES ('304', '0', '149.172.51.92', '1479940928', 'login');
INSERT INTO `tracker` VALUES ('305', '0', '95.91.241.140', '1479994166', 'login');
INSERT INTO `tracker` VALUES ('306', '0', '149.172.51.92', '1479995742', 'login');
INSERT INTO `tracker` VALUES ('307', '0', '149.172.51.92', '1479996689', 'login');
INSERT INTO `tracker` VALUES ('308', '0', '149.172.51.92', '1479999199', 'login');
INSERT INTO `tracker` VALUES ('309', '0', '79.243.228.1', '1479999404', 'login');
INSERT INTO `tracker` VALUES ('310', '0', '149.172.51.92', '1480001154', 'login');
INSERT INTO `tracker` VALUES ('311', '0', '149.172.51.92', '1480001168', 'login');
INSERT INTO `tracker` VALUES ('312', '0', '79.243.228.1', '1480001819', 'login');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permissions` text,
  `user_rank_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'Maniac', '$2y$10$GwR6vUy52b37P9s/f5hiaeFzZnhPkicNk8iF0Rj.d0WYfItcCo49q', 'a:8:{i:0;s:11:\"PlayersView\";i:1;s:11:\"PlayersEdit\";i:4;s:6:\"BanTmp\";i:5;s:7:\"BanPerm\";i:6;s:7:\"BanKick\";i:7;s:11:\"VehicleView\";i:8;s:11:\"VehicleEdit\";i:9;s:12:\"VehicleReset\";}', '4');
INSERT INTO `users` VALUES ('4', 'Unlock', '$2y$10$UxAysqN.haJAIMcmIRBoHeRIqTxyyIwsFbPEVfYxaKXXdrKfoWfvi', 'a:7:{i:0;s:11:\"PlayersView\";i:1;s:11:\"PlayersEdit\";i:4;s:6:\"BanTmp\";i:5;s:7:\"BanPerm\";i:6;s:7:\"BanKick\";i:7;s:11:\"VehicleView\";i:8;s:12:\"VehicleReset\";}', '4');
INSERT INTO `users` VALUES ('12', 'root', '$2y$10$kO6zQ9e1a7CdWaApGMZH6uu5XV75QHrq5A.omZRCOh6l0nfSqWtvW', 'a:1:{i:4;s:7:\"UserAdd\";}', '1');
INSERT INTO `users` VALUES ('13', 'Lucian', '$2y$10$1pv2ucYktdJhUHn6ejeoMubhSbHjU.q6XiaAkBpg2GrX/AwG3/fde', 'a:13:{i:2;s:8:\"UserView\";i:3;s:8:\"UserEdit\";i:4;s:7:\"UserAdd\";i:7;s:11:\"BanUnbanAll\";i:8;s:7:\"BanKick\";i:12;s:11:\"PlayersEdit\";i:13;s:11:\"PlayersView\";i:15;s:11:\"VehicleEdit\";i:20;s:6:\"BanTmp\";i:21;s:7:\"BanPerm\";i:22;s:11:\"VehicleView\";i:23;s:8:\"UserRoot\";i:24;s:12:\"VehicleReset\";}', '1');
INSERT INTO `users` VALUES ('14', 'delaa', '$2y$10$UZDiTBHoDUdFFQhr0qVYsOOPoYZfGDcoFW5BQTRD34glvXm0Fub16', 'a:13:{i:2;s:8:\"UserView\";i:3;s:8:\"UserEdit\";i:4;s:7:\"UserAdd\";i:5;s:6:\"BanTmp\";i:6;s:7:\"BanPerm\";i:7;s:11:\"BanUnbanAll\";i:8;s:7:\"BanKick\";i:10;s:11:\"VehicleView\";i:11;s:11:\"VehicleEdit\";i:12;s:11:\"PlayersView\";i:13;s:11:\"PlayersEdit\";i:14;s:8:\"UserRoot\";i:15;s:12:\"VehicleReset\";}', '1');
INSERT INTO `users` VALUES ('15', 'FairZone', '$2y$10$nan5ekonxCJOsMfjYPQv1eVxtDCKzVqi5nvfp7pM3l/eGzyc2tB.S', 'a:7:{i:0;s:11:\"PlayersView\";i:1;s:11:\"PlayersEdit\";i:4;s:6:\"BanTmp\";i:5;s:7:\"BanPerm\";i:6;s:7:\"BanKick\";i:7;s:11:\"VehicleView\";i:8;s:12:\"VehicleReset\";}', '4');
INSERT INTO `users` VALUES ('16', 'PeterPwnGG', '$2y$10$qU5MjE.R5e8DJEi36TeZY.h04EcXDT5.vyK82n4AZ7KGSzh1kp93q', 'a:7:{i:0;s:11:\"PlayersView\";i:1;s:11:\"PlayersEdit\";i:4;s:6:\"BanTmp\";i:5;s:7:\"BanPerm\";i:6;s:7:\"BanKick\";i:7;s:11:\"VehicleView\";i:8;s:12:\"VehicleReset\";}', '4');
INSERT INTO `users` VALUES ('17', 'Lahe5', '$2y$10$m17qDHtLH39wZxGyiH3oF.s/DoGitMiqG0fUcY6mgYA54AXez6QUG', 'a:13:{i:0;s:11:\"PlayersView\";i:1;s:11:\"PlayersEdit\";i:2;s:8:\"UserView\";i:3;s:8:\"UserEdit\";i:4;s:7:\"UserAdd\";i:5;s:6:\"BanTmp\";i:6;s:7:\"BanPerm\";i:7;s:11:\"BanUnbanAll\";i:8;s:7:\"BanKick\";i:9;s:11:\"VehicleView\";i:10;s:11:\"VehicleEdit\";i:11;s:12:\"VehicleReset\";i:12;s:8:\"UserRoot\";}', '2');
INSERT INTO `users` VALUES ('18', 'Alex', '$2y$10$0U/u/fJtou1rmJOpOS2y5.vSve8R3fFcGJ9X2G4AnyqFAcwn0t8Ry', 'a:7:{i:0;s:11:\"PlayersView\";i:4;s:6:\"BanTmp\";i:5;s:7:\"BanPerm\";i:6;s:7:\"BanKick\";i:7;s:11:\"PlayersEdit\";i:8;s:11:\"VehicleView\";i:9;s:12:\"VehicleReset\";}', '4');
INSERT INTO `users` VALUES ('34', 'test', '$2y$10$qebrXU9D7apg43qI8YNgV.3PkDuQN/.53XzMrFUqIF7W1mAoqSKLi', 'a:2:{i:0;s:11:\"PlayersView\";i:1;s:8:\"UserView\";}', '4');
INSERT INTO `users` VALUES ('35', 'cwennrich', '$2y$10$K49XbJHrGpdrFf1WN5dVOeUK95ZLL7/NYvPIL5/RU3HB8J0B/50xy', 'a:7:{i:0;s:11:\"PlayersView\";i:1;s:11:\"PlayersEdit\";i:2;s:7:\"BanKick\";i:3;s:6:\"BanTmp\";i:4;s:7:\"BanPerm\";i:5;s:12:\"VehicleReset\";i:6;s:11:\"VehicleView\";}', '4');

-- ----------------------------
-- Table structure for `user_rank`
-- ----------------------------
DROP TABLE IF EXISTS `user_rank`;
CREATE TABLE `user_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_rank
-- ----------------------------
INSERT INTO `user_rank` VALUES ('1', 'Server Leitung', 'maroon');
INSERT INTO `user_rank` VALUES ('2', 'Server Admin', 'danger');
INSERT INTO `user_rank` VALUES ('3', 'DE100 Admin', 'info');
INSERT INTO `user_rank` VALUES ('4', 'DE100 Supporter', 'teal');
