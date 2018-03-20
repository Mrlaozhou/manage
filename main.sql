/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : main

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2018-03-20 18:12:52
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
INSERT INTO `main_blog` VALUES ('9546DEC2FF69CFC35E966D98E2384301', 'php新特性总结', '随着我大php不断的更新调优、衍生出来很多新特性信用法', '', '<p><img src=\"/uploads/editor/image/2018-03-20/ApgamW9ERoaw9PjRe4Z5c8cA2RJZAmJ9PjwMnxN4.jpeg\" title=\"http://www.52laozhou.com\" alt=\"\" width=\"354\" height=\"172\"/></p><ul class=\" list-paddingleft-2\" style=\"list-style-type: disc;\"><li><p>标量类型声明</p></li><li><p>返回值类型声明</p></li><li><p>null合并运算符</p></li><li><p>太空船操作</p></li><li><p>常量数组定于</p></li><li><p>匿名类</p></li><li><p>Unicode Codepoint 转义语法</p></li><li><p>Closure::all()</p></li><li><p>为unserilize提供过滤</p></li><li><p>IntlChar</p></li></ul><pre class=\"brush:php;toolbar:false\">&lt;?php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\nfunction&nbsp;sumOfInts(int&nbsp;...$ints)\n{\n&nbsp;&nbsp;return&nbsp;array_sum($ints);\n}\nvar_dump(sumOfInts(2,&nbsp;&#39;3&#39;,&nbsp;4.1));</pre><p><br/></p>', '8EDB176FDF444417E3939D70607805E9', '1521536177', '0', '0', '0', '0', '0', '0', '0');

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
INSERT INTO `main_blog_category_relation` VALUES ('9546DEC2FF69CFC35E966D98E2384301', 'A04D0131A0467228B4BF7903194A4268');
