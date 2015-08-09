/*
Navicat MySQL Data Transfer

Source Server         : only
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : sqlstu

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-08-08 09:52:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `course`
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cno` varchar(20) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `score` float NOT NULL,
  `tno` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tno` (`tno`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '1', '计算机组成', '90', '101');
INSERT INTO `course` VALUES ('2', '2', '编译原理', '90', '102');
INSERT INTO `course` VALUES ('3', '3', 'C++', '90', '103');

-- ----------------------------
-- Table structure for `grade`
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sno` varchar(20) NOT NULL,
  `cno` varchar(20) NOT NULL,
  `grade` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sno` (`sno`),
  KEY `cno` (`cno`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES ('1', '1307084332', '1', '90');
INSERT INTO `grade` VALUES ('2', '1307084332', '2', '80');
INSERT INTO `grade` VALUES ('3', '1307084332', '3', '84');
INSERT INTO `grade` VALUES ('4', '1307084333', '1', '80');
INSERT INTO `grade` VALUES ('5', '1307084333', '2', '87');
INSERT INTO `grade` VALUES ('6', '1307084333', '3', '78');
INSERT INTO `grade` VALUES ('7', '1307084334', '1', '78');
INSERT INTO `grade` VALUES ('8', '1307084334', '2', '80');
INSERT INTO `grade` VALUES ('9', '1307084334', '3', '67');
INSERT INTO `grade` VALUES ('10', '1307084335', '1', '80');
INSERT INTO `grade` VALUES ('11', '1307084335', '2', '66');
INSERT INTO `grade` VALUES ('12', '1307084335', '3', '66');

-- ----------------------------
-- Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sno` varchar(20) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `ssex` varchar(20) NOT NULL,
  `sage` smallint(6) NOT NULL,
  `sdept` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '在校',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '1307084332', '吕布', '男', '20', '网络工程', 'dd76c442f2f751919913839d5a7c77f7', '在校');
INSERT INTO `student` VALUES ('2', '1307084333', '张飞', '男', '18', '网络工程', 'dc8bc1c17cfc97fa4350caaacf20dce4', '在校');
INSERT INTO `student` VALUES ('3', '1307084334', '武松', '男', '19', '网络工程', '84a8f4232c29a7cf7be1ca1b4a45d468', '在校');
INSERT INTO `student` VALUES ('4', '1307084335', '李逵', '男', '20', '网络工程', '4a78a8370bccc40169e1c6fd03b6be30', '在校');
INSERT INTO `student` VALUES ('6', '1307084336', '李明', '男', '20', '啊发发', '3b7281e5a8e3178bba62b02dc0e39fdd', '在校');

-- ----------------------------
-- Table structure for `teacher`
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tno` varchar(20) NOT NULL,
  `tname` varchar(20) NOT NULL,
  `tsex` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', '101', '陈够喜', '男', '38b3eff8baf56627478ec76a704e9b52');
INSERT INTO `teacher` VALUES ('2', '102', '张静', '女', 'ec8956637a99787bd197eacd77acce5e');
INSERT INTO `teacher` VALUES ('3', '103', '潘广贞', '男', '6974ce5ac660610b44d9b9fed0ff9548');
