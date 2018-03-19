/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : main

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2018-03-19 18:33:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for main_blog
-- ----------------------------
DROP TABLE IF EXISTS `main_blog`;
CREATE TABLE `main_blog` (
  `uuid` char(32) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '' COMMENT '文章标题',
  `short` varchar(300) NOT NULL DEFAULT '' COMMENT '简短介绍',
  `cover` varchar(100) NOT NULL DEFAULT '' COMMENT '封面图',
  `content` text NOT NULL,
  `createdby` char(32) NOT NULL DEFAULT '',
  `createdtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `publishedtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `commentnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数量',
  `clicks` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击数量',
  `publishedtype` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0.默认1.置顶2.推荐',
  `agree` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '赞同',
  `oppose` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0.未发布1.已发布',
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_blog
-- ----------------------------
INSERT INTO `main_blog` VALUES ('689B646D3086CA89F2793B5D2FAB0B2D', '浅谈php前景', 'PHP 独特的语法混合了C、Java、Perl以及PHP自创的语法。它可以比CGI或者Perl更快速地执行动态网页。用PHP做出的动态页面与其他的编程语言相比，PHP是将程序嵌入到HTML（标准通用标记语言下的一个应用）文档中去执行，执行效率比完全生成HTML标记的CGI要高许多；PHP还可以执行编译后代码，编译可以达到加密和优化代码运行，使代码运行更快。', '', '', '8EDB176FDF444417E3939D70607805E9', '1521454381', '1521454381', '0', '0', '0', '0', '0', '1');
INSERT INTO `main_blog` VALUES ('E9563B40ED6C9BE1BF595FA82FC52B80', 'php7性能分析', '标量类型声明 有两种模式: 强制 (默认) 和 严格模式。 现在可以使用下列类型参数（无论用强制模式还是严格模式）： 字符串(string), 整数 (int), 浮点数 (float), 以及布尔值 (bool)。它们扩充了PHP5中引入的其他类型：类名，接口，数组和 回调类型。', '', '', '8EDB176FDF444417E3939D70607805E9', '1521455508', '1521455508', '0', '0', '1', '0', '0', '1');

-- ----------------------------
-- Table structure for main_blog_category
-- ----------------------------
DROP TABLE IF EXISTS `main_blog_category`;
CREATE TABLE `main_blog_category` (
  `uuid` char(32) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '名称',
  `sign` varchar(30) NOT NULL DEFAULT '' COMMENT '别名',
  `pid` char(32) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0.关闭1.开启',
  `createdby` char(32) NOT NULL DEFAULT '' COMMENT '添加人',
  `createdtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatedby` char(32) NOT NULL DEFAULT '' COMMENT '修改人',
  `updatedtime` int(32) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_blog_category
-- ----------------------------
INSERT INTO `main_blog_category` VALUES ('0CB1251106781E9729359D42EBCC567D', 'thinkphp5', 'thinkphp5', 'A04D0131A0467228B4BF7903194A4268', '1', '8EDB176FDF444417E3939D70607805E9', '1521438682', '', '0');
INSERT INTO `main_blog_category` VALUES ('158E8A463053EB76C72BD26B646B4EB5', '算法', 'algorithm', 'B010091D2F07064098B029374A1EBC9A', '1', '8EDB176FDF444417E3939D70607805E9', '1521437927', '8EDB176FDF444417E3939D70607805E9', '1521443781');
INSERT INTO `main_blog_category` VALUES ('49A313C10581DF1ECB7FE2127EF6C35A', 'laravel', 'laravel', 'A04D0131A0467228B4BF7903194A4268', '1', '8EDB176FDF444417E3939D70607805E9', '1521437910', '8EDB176FDF444417E3939D70607805E9', '1521443741');
INSERT INTO `main_blog_category` VALUES ('93B7BD14D16AD302C16DA40C36DB6C07', 'Jquery', 'jquery', 'B010091D2F07064098B029374A1EBC9A', '1', '8EDB176FDF444417E3939D70607805E9', '1521443800', '', '0');
INSERT INTO `main_blog_category` VALUES ('A04D0131A0467228B4BF7903194A4268', 'PHP', 'php', 'B010091D2F07064098B029374A1EBC9A', '1', '8EDB176FDF444417E3939D70607805E9', '1521437046', '8EDB176FDF444417E3939D70607805E9', '1521443307');
INSERT INTO `main_blog_category` VALUES ('AEBC1924D623A45C6D839C0414A67611', '生活', 'left', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521437949', '8EDB176FDF444417E3939D70607805E9', '1521443367');
INSERT INTO `main_blog_category` VALUES ('B010091D2F07064098B029374A1EBC9A', '技术相关', 'programme', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521436393', '8EDB176FDF444417E3939D70607805E9', '1521443734');
INSERT INTO `main_blog_category` VALUES ('CC8AEFC2CB7E948C4CABF636F9A51439', '名吃', 'foot', 'AEBC1924D623A45C6D839C0414A67611', '1', '8EDB176FDF444417E3939D70607805E9', '1521438389', '8EDB176FDF444417E3939D70607805E9', '1521443567');
INSERT INTO `main_blog_category` VALUES ('D9E76632B74297B28A1AC0356CF91AE8', '情感', 'emotion', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521438404', '8EDB176FDF444417E3939D70607805E9', '1521443709');
INSERT INTO `main_blog_category` VALUES ('FC3537E7E5BFEA1A6AF5D4167358EB99', '其他', 'other', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521450564', '', '0');

-- ----------------------------
-- Table structure for main_blog_category_relation
-- ----------------------------
DROP TABLE IF EXISTS `main_blog_category_relation`;
CREATE TABLE `main_blog_category_relation` (
  `buuid` char(32) NOT NULL DEFAULT '',
  `cuuid` char(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_blog_category_relation
-- ----------------------------
INSERT INTO `main_blog_category_relation` VALUES ('E9563B40ED6C9BE1BF595FA82FC52B80', 'A04D0131A0467228B4BF7903194A4268');
INSERT INTO `main_blog_category_relation` VALUES ('E9563B40ED6C9BE1BF595FA82FC52B80', '158E8A463053EB76C72BD26B646B4EB5');
