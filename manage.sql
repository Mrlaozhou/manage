/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : manage

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2018-03-13 17:51:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for manage_admin
-- ----------------------------
DROP TABLE IF EXISTS `manage_admin`;
CREATE TABLE `manage_admin` (
  `uuid` char(32) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(60) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` char(32) NOT NULL DEFAULT '' COMMENT '盐值',
  `issalt` enum('0','1') NOT NULL DEFAULT '1' COMMENT '密码是否加盐',
  `createdby` char(32) NOT NULL DEFAULT '',
  `createdtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedby` char(32) NOT NULL DEFAULT '',
  `updatedtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` enum('-7','0','1') NOT NULL DEFAULT '1' COMMENT '状态',
  `intro` varchar(300) NOT NULL DEFAULT '' COMMENT '自我介绍',
  `avatar` varchar(120) NOT NULL DEFAULT '' COMMENT '头像地址',
  `email` varchar(60) NOT NULL DEFAULT '',
  `phone` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`uuid`),
  KEY `username` (`username`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_admin
-- ----------------------------
INSERT INTO `manage_admin` VALUES ('18B24A268E64969B26CB6F0C1BC12E54', 'commonAdmin', '$2y$10$SS0Ds20JeiA8pNwOjm0ybux8gWmDngPLmBoYGjdUB30bk5EMv0lBa', '', '0', '1.', '1520849749', '', '0', '1', '', '', '', '');
INSERT INTO `manage_admin` VALUES ('50EA79FD5D3949499FCD24BDADE2B343', 'articlaAdmin', '$2y$10$5/bHzfSXXHjaOmYmDlp1jOj/8TyUgk/AtaiVShmlQI4FGK/sqNZ.6', '95AF1D601881BEDEDB5FFEE8C34C427B', '1', '1.', '1520815294', '', '0', '1', 'NB', '', 'zgsself@163.com', '15565656196');

-- ----------------------------
-- Table structure for manage_mode
-- ----------------------------
DROP TABLE IF EXISTS `manage_mode`;
CREATE TABLE `manage_mode` (
  `uuid` char(32) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `createdby` char(32) NOT NULL DEFAULT '',
  `createdtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedby` char(32) NOT NULL DEFAULT '',
  `updatedtime` int(10) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(300) NOT NULL DEFAULT '',
  `status` enum('-7','0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`uuid`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_mode
-- ----------------------------
INSERT INTO `manage_mode` VALUES ('02A21F22EEEFD0EFE04AB723CE6F4819', 'Token限制', '18B24A268E64969B26CB6F0C1BC12E54', '1520906096', '', '0', '对携带合法token的用户开放', '1');
INSERT INTO `manage_mode` VALUES ('2062AC0A2E111F6AB8F0B62003209322', '最高限制', '50EA79FD5D3949499FCD24BDADE2B343', '1520930784', '50EA79FD5D3949499FCD24BDADE2B343', '1520930896', '只有特定用户可访问', '1');
INSERT INTO `manage_mode` VALUES ('5B700B55CEE3C231C17D1897C5E1112F', '无限制', '18B24A268E64969B26CB6F0C1BC12E54', '1520851939', '', '0', '对所有客户端开放', '1');
INSERT INTO `manage_mode` VALUES ('7EBC742C8C4F95898DB11977B3D05ADD', '登陆限制', '18B24A268E64969B26CB6F0C1BC12E54', '1520852237', '', '0', '验证客户端是否携带登录信息', '0');
INSERT INTO `manage_mode` VALUES ('804E67719FDE0F5F9180E9EB596B0042', '登陆Token限制', '18B24A268E64969B26CB6F0C1BC12E54', '1520906604', '', '0', '对携带合法Token的登陆用户开放', '1');
INSERT INTO `manage_mode` VALUES ('9C36A9607B71E2778A4A0114D39425FF', '登陆限制', '18B24A268E64969B26CB6F0C1BC12E54', '1520919120', '', '0', '对登陆的用户开放', '1');
INSERT INTO `manage_mode` VALUES ('F71BF4F5D91A1462651C54E90B041B07', '权限限制', '18B24A268E64969B26CB6F0C1BC12E54', '1520929916', '', '0', '都具有权限的用户开放', '1');

-- ----------------------------
-- Table structure for manage_privilege
-- ----------------------------
DROP TABLE IF EXISTS `manage_privilege`;
CREATE TABLE `manage_privilege` (
  `uuid` char(32) NOT NULL DEFAULT '' COMMENT '主键id',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '权限名称',
  `route` varchar(60) NOT NULL DEFAULT '' COMMENT '路由名称',
  `status` enum('-7','0','1') NOT NULL DEFAULT '1' COMMENT '当前状态 1.征程 0. 关闭 -7.软删除',
  `alias` varchar(60) NOT NULL DEFAULT '' COMMENT '别名',
  `createdby` char(32) NOT NULL DEFAULT '' COMMENT '创建操作者id',
  `createdtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatedby` char(32) NOT NULL DEFAULT '' COMMENT '更新操作者id',
  `updatedtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `module` varchar(30) NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(30) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(30) NOT NULL DEFAULT '' COMMENT '方法',
  `mode` char(32) NOT NULL DEFAULT '' COMMENT '模式id',
  `pid` char(32) NOT NULL DEFAULT '' COMMENT '父级id',
  `type` enum('9','1') NOT NULL DEFAULT '1' COMMENT '1.web 9.api',
  `is_back` enum('0','1') NOT NULL DEFAULT '1' COMMENT '是否后台显示',
  PRIMARY KEY (`uuid`),
  KEY `status` (`status`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`),
  KEY `mode` (`mode`),
  KEY `route` (`route`),
  KEY `pid` (`pid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_privilege
-- ----------------------------
INSERT INTO `manage_privilege` VALUES ('0855673C73F47EDAB848B9FC76987542', '角色修改', 'role-update', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927694', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '838F3FB7668F82437B25B249013749A6', '1', '1');
INSERT INTO `manage_privilege` VALUES ('27B5680DA6D86D7C140BA5FFBCA6836C', '用户管理', 'admin-index', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927835', '50EA79FD5D3949499FCD24BDADE2B343', '1520932349', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '6EE0CB07A26A9DBA76EDFFB259C1F2CE', '1', '1');
INSERT INTO `manage_privilege` VALUES ('68194F973A97C4B771606487A77C4062', '角色删除', 'role-delete', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927674', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '838F3FB7668F82437B25B249013749A6', '1', '1');
INSERT INTO `manage_privilege` VALUES ('6EE0CB07A26A9DBA76EDFFB259C1F2CE', 'RBAC', '-', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520919326', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '', '1', '1');
INSERT INTO `manage_privilege` VALUES ('730165620E8FD523485A61B6C4ED56EC', '登陆接口', 'api-login', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520928130', '', '0', '', '', '', '5B700B55CEE3C231C17D1897C5E1112F', '', '9', '0');
INSERT INTO `manage_privilege` VALUES ('7AE6C520562976B5FFB03AA89FCA2587', '登陆', 'login', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927938', '', '0', '', '', '', '5B700B55CEE3C231C17D1897C5E1112F', '', '1', '0');
INSERT INTO `manage_privilege` VALUES ('838F3FB7668F82437B25B249013749A6', '角色管理', 'role-index', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520919593', '50EA79FD5D3949499FCD24BDADE2B343', '1520932337', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '6EE0CB07A26A9DBA76EDFFB259C1F2CE', '1', '1');
INSERT INTO `manage_privilege` VALUES ('9CF683EC12F4B76839323C95060D6F2B', '用户添加', 'admin-create', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927862', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '27B5680DA6D86D7C140BA5FFBCA6836C', '1', '1');
INSERT INTO `manage_privilege` VALUES ('9DFD5C77E30048D91CD2DC4F60C9F5E7', '权限修改', 'privilege-update', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520919518', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', 'F2EA09775BEE036DF9ABB6643A4359AF', '1', '1');
INSERT INTO `manage_privilege` VALUES ('A615F5B3F06CA166CF27736345B3651E', '权限添加', 'privilege-create', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520919452', '50EA79FD5D3949499FCD24BDADE2B343', '1520927062', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', 'F2EA09775BEE036DF9ABB6643A4359AF', '1', '1');
INSERT INTO `manage_privilege` VALUES ('D736544C4820687990BC8814E6FD6E05', '登出接口', 'api-logout', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520934375', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '', '9', '0');
INSERT INTO `manage_privilege` VALUES ('DA4AED818A55B78FFF833BF790F8483E', '用户修改', 'admin-update', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927881', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '27B5680DA6D86D7C140BA5FFBCA6836C', '1', '1');
INSERT INTO `manage_privilege` VALUES ('E16D93ED6A0304D6C147780BDC737F00', '角色添加', 'role-create', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927517', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '838F3FB7668F82437B25B249013749A6', '1', '1');
INSERT INTO `manage_privilege` VALUES ('F1ED6CD5A4B444DC7E1DEFFBA6455462', '用户删除', 'admin-delete', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520927900', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '27B5680DA6D86D7C140BA5FFBCA6836C', '1', '1');
INSERT INTO `manage_privilege` VALUES ('F2EA09775BEE036DF9ABB6643A4359AF', '权限管理', 'privilege-index', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520919390', '50EA79FD5D3949499FCD24BDADE2B343', '1520932322', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', '6EE0CB07A26A9DBA76EDFFB259C1F2CE', '1', '1');
INSERT INTO `manage_privilege` VALUES ('F359D59C2CD64C84EDB4737272CC7BE9', '权限删除', 'privilege-delete', '1', '', '18B24A268E64969B26CB6F0C1BC12E54', '1520919551', '', '0', '', '', '', '9C36A9607B71E2778A4A0114D39425FF', 'F2EA09775BEE036DF9ABB6643A4359AF', '1', '1');

-- ----------------------------
-- Table structure for manage_relation1
-- ----------------------------
DROP TABLE IF EXISTS `manage_relation1`;
CREATE TABLE `manage_relation1` (
  `auuid` char(32) NOT NULL DEFAULT '',
  `ruuid` char(32) NOT NULL DEFAULT '',
  KEY `auuid` (`auuid`),
  KEY `ruuid` (`ruuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_relation1
-- ----------------------------

-- ----------------------------
-- Table structure for manage_relation2
-- ----------------------------
DROP TABLE IF EXISTS `manage_relation2`;
CREATE TABLE `manage_relation2` (
  `puuid` char(32) NOT NULL DEFAULT '',
  `ruuid` char(32) NOT NULL DEFAULT '',
  KEY `puuid` (`puuid`),
  KEY `ruuid` (`ruuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_relation2
-- ----------------------------

-- ----------------------------
-- Table structure for manage_role
-- ----------------------------
DROP TABLE IF EXISTS `manage_role`;
CREATE TABLE `manage_role` (
  `uuid` char(32) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `sign` varchar(60) NOT NULL DEFAULT '' COMMENT '标识',
  `status` enum('-7','0','1') NOT NULL DEFAULT '1' COMMENT '状态',
  `createdby` char(32) NOT NULL DEFAULT '' COMMENT '创建者id',
  `createdtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedby` char(32) NOT NULL DEFAULT '',
  `updatedtime` int(10) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(300) NOT NULL DEFAULT '' COMMENT '介绍',
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_role
-- ----------------------------
