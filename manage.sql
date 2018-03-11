/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : manage

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2018-03-12 06:55:29
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
