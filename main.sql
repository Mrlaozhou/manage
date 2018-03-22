/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : main

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2018-03-22 17:44:03
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
  PRIMARY KEY (`uuid`),
  KEY `createdby` (`createdby`),
  KEY `publishedtype` (`publishedtype`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_blog
-- ----------------------------
INSERT INTO `main_blog` VALUES ('9546DEC2FF69CFC35E966D98E2384301', 'php新特性总结', '随着我大php不断的更新调优、衍生出来很多新特性信用法', '', '<p><br/></p><hr/><p>1.变量类型约束<br/></p><pre class=\"brush:php;toolbar:false\">&lt;?php&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\nfunction&nbsp;sumOfInts(int&nbsp;...$ints)\n{\n&nbsp;&nbsp;return&nbsp;array_sum($ints);\n}\nvar_dump(sumOfInts(2,&nbsp;&#39;3&#39;,&nbsp;4.1));</pre><p>2.返回值类型声明</p><pre class=\"brush:php;toolbar:false\">&lt;?php&nbsp;\nfunction&nbsp;getArray($data):array\n{\n&nbsp;&nbsp;&nbsp;&nbsp;return&nbsp;array_filter($data);\n}</pre><p>2.null合并运算符</p><pre class=\"brush:php;toolbar:false\">&lt;?php\n$name&nbsp;=&nbsp;$_GET[&#39;name&#39;]&nbsp;??&nbsp;&#39;luke&#39;&nbsp;\n//&nbsp;等效\n$name&nbsp;=&nbsp;iset($_GET[&#39;name&#39;])&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?&nbsp;$_GET[&#39;name&#39;]&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&#39;luke&#39;;</pre><p><br/></p>', '8EDB176FDF444417E3939D70607805E9', '1521536177', '1521697217', '32', '155', '0', '81', '6', '1');
INSERT INTO `main_blog` VALUES ('D220E0BB723A2B3710E39946CBDC91D2', 'laravel模型连表跨库操作', '官方没有给出具体用法。', '', '<pre class=\"brush:php;toolbar:false\">//&nbsp;whereIn&nbsp;条件\n$whereIn&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;$where[&#39;in&#39;]&nbsp;??&nbsp;[];\n//&nbsp;where条件\n$where&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;array_filter(array_merge(&nbsp;$where[&#39;where&#39;]&nbsp;??&nbsp;[[]],&nbsp;[&nbsp;[&#39;b.status&#39;,1]&nbsp;]&nbsp;));\n$builder&nbsp;=&nbsp;&nbsp;Blog::from(&#39;blog&nbsp;as&nbsp;b&#39;)-&gt;select(...$this-&gt;allowFields)\n&nbsp;&nbsp;&nbsp;&nbsp;-&gt;leftjoin(&#39;blog_category_relation&nbsp;as&nbsp;r&#39;,&#39;b.uuid&#39;,&#39;=&#39;,&#39;r.buuid&#39;);\n$where&nbsp;&amp;&amp;&nbsp;$builder-&gt;where(&nbsp;$where&nbsp;);\n$whereIn&nbsp;&amp;&amp;&nbsp;$builder-&gt;whereIn(&nbsp;$whereIn&nbsp;);\n\nreturn&nbsp;$builder;</pre><p><br/></p>', '8EDB176FDF444417E3939D70607805E9', '1521689786', '1521689786', '0', '0', '1', '0', '0', '1');

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
  PRIMARY KEY (`uuid`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_blog_category
-- ----------------------------
INSERT INTO `main_blog_category` VALUES ('02984B9F87CF698066A439C62786A3FD', '名吃', 'eat', 'C0C4C6B4E0FE9EA798982B53C7B6989B', '1', '8EDB176FDF444417E3939D70607805E9', '1521678409', '8EDB176FDF444417E3939D70607805E9', '1521678488');
INSERT INTO `main_blog_category` VALUES ('099C8A278CEF6FDE0E62FE66644D39F8', 'Javascript', 'javascript', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521617976', '', '0');
INSERT INTO `main_blog_category` VALUES ('0CB1251106781E9729359D42EBCC567D', 'ThinkPHP5', 'thinkphp5', 'A04D0131A0467228B4BF7903194A4268', '1', '8EDB176FDF444417E3939D70607805E9', '1521438682', '195981127530E628ED488680CE94DD6A', '1521711563');
INSERT INTO `main_blog_category` VALUES ('1C0D52B841B812CA857AA06DD698022D', 'Linux', 'linux', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521696129', '', '0');
INSERT INTO `main_blog_category` VALUES ('3028EE40D64CD6ABDB083DD3CF9F695B', 'CrossFire', 'cf', 'D9133F6B43A2F855FBCCA3B12BF3C34A', '1', '195981127530E628ED488680CE94DD6A', '1521711659', '', '0');
INSERT INTO `main_blog_category` VALUES ('466612D5F551D8BB893DA169363D9054', 'ThinkPHP3', 'thinkphp3', 'A04D0131A0467228B4BF7903194A4268', '1', '195981127530E628ED488680CE94DD6A', '1521711506', '195981127530E628ED488680CE94DD6A', '1521711572');
INSERT INTO `main_blog_category` VALUES ('49A313C10581DF1ECB7FE2127EF6C35A', 'Laravel', 'laravel', 'A04D0131A0467228B4BF7903194A4268', '1', '8EDB176FDF444417E3939D70607805E9', '1521437910', '195981127530E628ED488680CE94DD6A', '1521711581');
INSERT INTO `main_blog_category` VALUES ('4DF48CBBFACA02187B8759E311E52EE7', '美妆', 'beauty', 'C0C4C6B4E0FE9EA798982B53C7B6989B', '1', '8EDB176FDF444417E3939D70607805E9', '1521678457', '', '0');
INSERT INTO `main_blog_category` VALUES ('7D8E62774340AF8ACE6747B4A75244A4', 'Symfony', 'symfony', 'A04D0131A0467228B4BF7903194A4268', '1', '195981127530E628ED488680CE94DD6A', '1521711598', '', '0');
INSERT INTO `main_blog_category` VALUES ('A04D0131A0467228B4BF7903194A4268', 'PHP', 'php', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521437046', '8EDB176FDF444417E3939D70607805E9', '1521617902');
INSERT INTO `main_blog_category` VALUES ('A3BBD9EAD20DE78F817274E767EEBAF0', '租房', 'home', 'C0C4C6B4E0FE9EA798982B53C7B6989B', '1', '8EDB176FDF444417E3939D70607805E9', '1521678505', '', '0');
INSERT INTO `main_blog_category` VALUES ('C0C4C6B4E0FE9EA798982B53C7B6989B', '生活', 'left', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521618009', '', '0');
INSERT INTO `main_blog_category` VALUES ('D9133F6B43A2F855FBCCA3B12BF3C34A', '游戏', 'game', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521617145', '', '0');
INSERT INTO `main_blog_category` VALUES ('D9E76632B74297B28A1AC0356CF91AE8', '情感', 'emotion', '', '0', '8EDB176FDF444417E3939D70607805E9', '1521438404', '8EDB176FDF444417E3939D70607805E9', '1521684155');
INSERT INTO `main_blog_category` VALUES ('FC3537E7E5BFEA1A6AF5D4167358EB99', '其他', 'other', '', '1', '8EDB176FDF444417E3939D70607805E9', '1521450564', '', '0');

-- ----------------------------
-- Table structure for main_blog_category_relation
-- ----------------------------
DROP TABLE IF EXISTS `main_blog_category_relation`;
CREATE TABLE `main_blog_category_relation` (
  `buuid` char(32) NOT NULL DEFAULT '',
  `cuuid` char(32) NOT NULL DEFAULT '',
  KEY `buuid` (`buuid`),
  KEY `cuuid` (`cuuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_blog_category_relation
-- ----------------------------
INSERT INTO `main_blog_category_relation` VALUES ('D220E0BB723A2B3710E39946CBDC91D2', '49A313C10581DF1ECB7FE2127EF6C35A');
INSERT INTO `main_blog_category_relation` VALUES ('9546DEC2FF69CFC35E966D98E2384301', 'A04D0131A0467228B4BF7903194A4268');
