/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : manage

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2018-03-19 18:33:02
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
  `lastlogintime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uuid`),
  KEY `username` (`username`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_admin
-- ----------------------------
INSERT INTO `manage_admin` VALUES ('4203A4F8837C1B66C201F9C230F8E3D1', 'SuperAdmin', '$2y$10$X.J62.PPXB0ONn/ZO6NGdu2Z2lqwr68gESrmiP3fXAKGHgZ0V0gxu', '0D8EB08B8BB75654D3BB3AED794E21A6', '1', '1.', '1520944822', '4203A4F8837C1B66C201F9C230F8E3D1', '1521105820', '1', '超级管理员', '', 'zgsself@163.com', '15565656196', '1521451981');
INSERT INTO `manage_admin` VALUES ('8EDB176FDF444417E3939D70607805E9', 'testAdmin', '$2y$10$Ll9ixIU/jG8F/cSZ846XAe3GNFBTG7lCSNWVeq8uI7BSa4CQf5WNy', '7A6B920B6272572665871A3E9F796F0A', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521422295', '', '0', '1', '', '', '', '', '1521431036');
INSERT INTO `manage_admin` VALUES ('F194FCC63F557FCDFCEC0379E5B0693A', 'userAdmin', '$2y$10$K240xbkujFoEiCFW/hJ2u.VhLflvfBLcTtM6SydDnQpIa0Pc04hXO', '05383A64370BC447CA3A8F9BC821E9A2', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521196150', '', '0', '1', '', '', '', '', '1521196911');

-- ----------------------------
-- Table structure for manage_mode
-- ----------------------------
DROP TABLE IF EXISTS `manage_mode`;
CREATE TABLE `manage_mode` (
  `uuid` char(32) NOT NULL DEFAULT '',
  `sign` varchar(20) NOT NULL DEFAULT '',
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
INSERT INTO `manage_mode` VALUES ('2742AA3D7877690A75751811FF539ECE', 'LOGIN', '登陆限制', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084112', '', '0', '必须登陆', '1');
INSERT INTO `manage_mode` VALUES ('2B23A4409CCB5948224529BC990EA4CF', 'AUTH', '授权限制', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084122', '', '0', '', '1');
INSERT INTO `manage_mode` VALUES ('75CF69D4425438727E96BCED7EFBE976', 'ROOT', 'ROOT限制', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084135', '', '0', '', '1');
INSERT INTO `manage_mode` VALUES ('93DD84878E3ABD6F02033CF4406AA3D8', 'NONE', '无限制', '4203A4F8837C1B66C201F9C230F8E3D1', '1521083993', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084034', '对所有请求开放', '1');

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
  `style` tinyint(3) unsigned NOT NULL DEFAULT '7' COMMENT '0.禁止显示1.侧边显示2.授权显示3.侧边、授权4.父级显示5.侧边父级6.授权、父级7.无限制',
  PRIMARY KEY (`uuid`),
  KEY `status` (`status`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`),
  KEY `mode` (`mode`),
  KEY `route` (`route`),
  KEY `pid` (`pid`),
  KEY `type` (`type`),
  KEY `style` (`style`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage_privilege
-- ----------------------------
INSERT INTO `manage_privilege` VALUES ('06E0C355B2A72DF9B1BEA4D4C9B060B4', '分类修改', 'blog-category^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428486', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428559', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '1', '6');
INSERT INTO `manage_privilege` VALUES ('0A8B771061F6DBB484138CCADF5787F8', '测试', 'test', '1', '', '', '1521185540', '', '0', '', '', '', '2742AA3D7877690A75751811FF539ECE', '8E01D57276F42F9E05D06FFE730DED37', '1', '6');
INSERT INTO `manage_privilege` VALUES ('0AFF449C9F3865C4694C4D4836427193', '博客列表', 'blog^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521421866', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '1', '7');
INSERT INTO `manage_privilege` VALUES ('0D001027516F234972AA552869336D26', '默认分帧主页', 'default', '1', '', '', '1521188652', '', '0', '', '', '', '2742AA3D7877690A75751811FF539ECE', '8E01D57276F42F9E05D06FFE730DED37', '1', '6');
INSERT INTO `manage_privilege` VALUES ('0EE9C910C2C1EA66C5847C4990D7EEC9', '登陆接口', 'login', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521094350', '', '1521188369', '', '', '', '93DD84878E3ABD6F02033CF4406AA3D8', '8E01D57276F42F9E05D06FFE730DED37', '9', '4');
INSERT INTO `manage_privilege` VALUES ('0EFABB465349ECC5A7EC7968B8934A20', '分类删除api', 'blog-category^delete', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428742', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('1A84121EA30DC29099AEE96455092254', '权限修改', 'privilege^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084988', '4203A4F8837C1B66C201F9C230F8E3D1', '1521089570', '', '', '', '93DD84878E3ABD6F02033CF4406AA3D8', '2750C798A27622C9E89DAF2FD1DB60AB', '1', '6');
INSERT INTO `manage_privilege` VALUES ('2750C798A27622C9E89DAF2FD1DB60AB', 'Privilege', '-', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084250', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084378', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '', '1', '7');
INSERT INTO `manage_privilege` VALUES ('2C8EFB49AC0C8630ADA8C2C97BEEDCBC', 'Mode', '-', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085149', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '', '1', '7');
INSERT INTO `manage_privilege` VALUES ('34E38470EEE0D063C3E078EED8ACC506', '角色添加', 'role^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085443', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', 'C9EDDDC1B7093D7E8E169580D0E9DB01', '1', '7');
INSERT INTO `manage_privilege` VALUES ('49FD90F4EC925A0912D5C73F6245A84C', '模式添加api', 'mode^create', '1', '', '', '1521178603', '', '1521178865', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '9', '6');
INSERT INTO `manage_privilege` VALUES ('4EC5E1EC048B6121310D1A1A56C60615', '博客添加', 'blog^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521421900', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '1', '7');
INSERT INTO `manage_privilege` VALUES ('58A34AECA82DE4218DAB875160671281', '博客修改', 'blog^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521421932', '4203A4F8837C1B66C201F9C230F8E3D1', '1521421960', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '1', '6');
INSERT INTO `manage_privilege` VALUES ('5B9C51097125A9CFF173FEF18E9A3F0F', '用户修改', 'admin^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085563', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', 'C5C82F04198C2D3A081127C7B7861277', '1', '6');
INSERT INTO `manage_privilege` VALUES ('63AD4CBD87E13B18FA26244671B8DC63', '权限添加', 'privilege^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084856', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084911', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2750C798A27622C9E89DAF2FD1DB60AB', '1', '7');
INSERT INTO `manage_privilege` VALUES ('6C51A29431C603E80BD6794DA7660806', '登陆页面', 'login', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521094313', '', '1521188343', '', '', '', '93DD84878E3ABD6F02033CF4406AA3D8', '8E01D57276F42F9E05D06FFE730DED37', '1', '4');
INSERT INTO `manage_privilege` VALUES ('6DDF150FC66AA9D4207C17E90580E44F', '模式删除api', 'mode^delete', '1', '', '', '1521179042', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '9', '6');
INSERT INTO `manage_privilege` VALUES ('733802F4E4768E7D6487F69D7FE7755D', '模式列表', 'mode^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085193', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '1', '7');
INSERT INTO `manage_privilege` VALUES ('742D5BC8FDEA8D9347CE124D07F78DCA', '权限列表', 'privilege^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521084548', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2750C798A27622C9E89DAF2FD1DB60AB', '1', '7');
INSERT INTO `manage_privilege` VALUES ('7799FC16596C0B58EB5B2E1B91F2BBA9', '登出接口', 'logout', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521094417', '', '0', '', '', '', '2742AA3D7877690A75751811FF539ECE', '8E01D57276F42F9E05D06FFE730DED37', '9', '4');
INSERT INTO `manage_privilege` VALUES ('848F5A9836D1056124090BDEE804B6B5', '博客修改api', 'blog^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521422143', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('85877F54B4F60CFEB79D59595A939DBD', '用户列表', 'admin^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085515', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', 'C5C82F04198C2D3A081127C7B7861277', '1', '7');
INSERT INTO `manage_privilege` VALUES ('88E1A9E730974704A13265B00FE91325', '模式添加', 'mode^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085225', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '1', '7');
INSERT INTO `manage_privilege` VALUES ('8E01D57276F42F9E05D06FFE730DED37', 'Others', '-', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521094265', '', '0', '', '', '', '93DD84878E3ABD6F02033CF4406AA3D8', '', '1', '4');
INSERT INTO `manage_privilege` VALUES ('96D4A36ADE59234374D1566000B6C241', '博客列表api', 'blog^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521422052', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('9A8428EF50AE935DC09B1791389D8AE9', 'Blog', '-', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521421705', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '', '1', '7');
INSERT INTO `manage_privilege` VALUES ('A419C08DF9636B081AD2339D659C9C4F', '分类添加api', 'blog-category^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428681', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('BD7E4AB1385BB9947116D0244EC7E632', '分类列表api', 'blog-category^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428624', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428631', '', '', '', '93DD84878E3ABD6F02033CF4406AA3D8', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('BDFE0139E9F8234B1577A77FC9FDEFE9', '模式修改api', 'mode^update', '1', '', '', '1521178844', '', '1521179056', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '9', '6');
INSERT INTO `manage_privilege` VALUES ('C17CABE9625CABB46F06B3D2A3B74BC9', '模式列表api', 'mode^index', '1', '', '', '1521178561', '', '1521178856', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '9', '6');
INSERT INTO `manage_privilege` VALUES ('C5C82F04198C2D3A081127C7B7861277', 'Admin', '-', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085493', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '', '1', '7');
INSERT INTO `manage_privilege` VALUES ('C9EDDDC1B7093D7E8E169580D0E9DB01', 'Role', '-', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085400', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '', '1', '7');
INSERT INTO `manage_privilege` VALUES ('CAA143E98E693AF7AF1C0451F72C0873', '角色修改', 'role^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085460', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', 'C9EDDDC1B7093D7E8E169580D0E9DB01', '1', '6');
INSERT INTO `manage_privilege` VALUES ('D61021C76EDC76A6641131CD75A03331', '分类添加', 'blog-category^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428444', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428552', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '1', '7');
INSERT INTO `manage_privilege` VALUES ('D64B135D0B62FF10A6292A673C8142F3', '角色列表', 'role^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085417', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', 'C9EDDDC1B7093D7E8E169580D0E9DB01', '1', '7');
INSERT INTO `manage_privilege` VALUES ('D6BB6F05C95940DE53406C8ADAECF998', '用户添加', 'admin^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085540', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', 'C5C82F04198C2D3A081127C7B7861277', '1', '7');
INSERT INTO `manage_privilege` VALUES ('E1117FD97083F15D010DE824AC474DFD', '主页', '/', '1', '', '', '1521185383', '', '0', '', '', '', '2742AA3D7877690A75751811FF539ECE', '8E01D57276F42F9E05D06FFE730DED37', '1', '0');
INSERT INTO `manage_privilege` VALUES ('E336856D524FE92E34D75C027BA3F166', '博客添加api', 'blog^create', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521422098', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('F3D77BD4C3712E5B0CC85F0CFE949997', '博客删除api', 'blog^delete', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521422183', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('F9C2F130C8B18EA0CDFBDC4678CD0DBE', '分类修改api', 'blog-category^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428793', '', '0', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '9', '6');
INSERT INTO `manage_privilege` VALUES ('FAFD372E17B89D7E18DF279E848C9040', '分类列表', 'blog-category^index', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428356', '4203A4F8837C1B66C201F9C230F8E3D1', '1521428544', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '9A8428EF50AE935DC09B1791389D8AE9', '1', '7');
INSERT INTO `manage_privilege` VALUES ('FEAF1B00548D783E49EE45A7EE45A5D9', '模式修改', 'mode^update', '1', '', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085267', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085283', '', '', '', '2B23A4409CCB5948224529BC990EA4CF', '2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '1', '6');

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
INSERT INTO `manage_relation1` VALUES ('F194FCC63F557FCDFCEC0379E5B0693A', 'C0585FA0DC36D02573BF695C81B3A479');
INSERT INTO `manage_relation1` VALUES ('8EDB176FDF444417E3939D70607805E9', 'C798ABAEE8CD4D48653CA66B7FE1D871');

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
INSERT INTO `manage_relation2` VALUES ('2750C798A27622C9E89DAF2FD1DB60AB', 'D2FFBC02916B41B69C3F15E4B853CA78');
INSERT INTO `manage_relation2` VALUES ('1A84121EA30DC29099AEE96455092254', 'D2FFBC02916B41B69C3F15E4B853CA78');
INSERT INTO `manage_relation2` VALUES ('63AD4CBD87E13B18FA26244671B8DC63', 'D2FFBC02916B41B69C3F15E4B853CA78');
INSERT INTO `manage_relation2` VALUES ('742D5BC8FDEA8D9347CE124D07F78DCA', 'D2FFBC02916B41B69C3F15E4B853CA78');
INSERT INTO `manage_relation2` VALUES ('C9EDDDC1B7093D7E8E169580D0E9DB01', '4C0C12799FF0B60DC6A0F2ED240C6C92');
INSERT INTO `manage_relation2` VALUES ('34E38470EEE0D063C3E078EED8ACC506', '4C0C12799FF0B60DC6A0F2ED240C6C92');
INSERT INTO `manage_relation2` VALUES ('CAA143E98E693AF7AF1C0451F72C0873', '4C0C12799FF0B60DC6A0F2ED240C6C92');
INSERT INTO `manage_relation2` VALUES ('D64B135D0B62FF10A6292A673C8142F3', '4C0C12799FF0B60DC6A0F2ED240C6C92');
INSERT INTO `manage_relation2` VALUES ('C5C82F04198C2D3A081127C7B7861277', 'C0585FA0DC36D02573BF695C81B3A479');
INSERT INTO `manage_relation2` VALUES ('5B9C51097125A9CFF173FEF18E9A3F0F', 'C0585FA0DC36D02573BF695C81B3A479');
INSERT INTO `manage_relation2` VALUES ('85877F54B4F60CFEB79D59595A939DBD', 'C0585FA0DC36D02573BF695C81B3A479');
INSERT INTO `manage_relation2` VALUES ('D6BB6F05C95940DE53406C8ADAECF998', 'C0585FA0DC36D02573BF695C81B3A479');
INSERT INTO `manage_relation2` VALUES ('2C8EFB49AC0C8630ADA8C2C97BEEDCBC', '56FC8F9938A7119AF63DFC675B08AEB1');
INSERT INTO `manage_relation2` VALUES ('733802F4E4768E7D6487F69D7FE7755D', '56FC8F9938A7119AF63DFC675B08AEB1');
INSERT INTO `manage_relation2` VALUES ('88E1A9E730974704A13265B00FE91325', '56FC8F9938A7119AF63DFC675B08AEB1');
INSERT INTO `manage_relation2` VALUES ('FEAF1B00548D783E49EE45A7EE45A5D9', '56FC8F9938A7119AF63DFC675B08AEB1');
INSERT INTO `manage_relation2` VALUES ('C17CABE9625CABB46F06B3D2A3B74BC9', '56FC8F9938A7119AF63DFC675B08AEB1');
INSERT INTO `manage_relation2` VALUES ('9A8428EF50AE935DC09B1791389D8AE9', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('F9C2F130C8B18EA0CDFBDC4678CD0DBE', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('0EFABB465349ECC5A7EC7968B8934A20', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('A419C08DF9636B081AD2339D659C9C4F', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('BD7E4AB1385BB9947116D0244EC7E632', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('06E0C355B2A72DF9B1BEA4D4C9B060B4', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('D61021C76EDC76A6641131CD75A03331', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('FAFD372E17B89D7E18DF279E848C9040', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('F3D77BD4C3712E5B0CC85F0CFE949997', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('848F5A9836D1056124090BDEE804B6B5', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('E336856D524FE92E34D75C027BA3F166', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('96D4A36ADE59234374D1566000B6C241', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('58A34AECA82DE4218DAB875160671281', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('4EC5E1EC048B6121310D1A1A56C60615', 'C798ABAEE8CD4D48653CA66B7FE1D871');
INSERT INTO `manage_relation2` VALUES ('0AFF449C9F3865C4694C4D4836427193', 'C798ABAEE8CD4D48653CA66B7FE1D871');

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
INSERT INTO `manage_role` VALUES ('4C0C12799FF0B60DC6A0F2ED240C6C92', '角色管理员', 'roleManage', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085832', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085837', '');
INSERT INTO `manage_role` VALUES ('56FC8F9938A7119AF63DFC675B08AEB1', '模式管理员', 'modeManage', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085749', '4203A4F8837C1B66C201F9C230F8E3D1', '1521421317', '');
INSERT INTO `manage_role` VALUES ('C0585FA0DC36D02573BF695C81B3A479', '用户管理员', 'adminManage', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085859', '4203A4F8837C1B66C201F9C230F8E3D1', '1521161857', '');
INSERT INTO `manage_role` VALUES ('C798ABAEE8CD4D48653CA66B7FE1D871', 'blog管理员', 'blogManage', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521422254', '4203A4F8837C1B66C201F9C230F8E3D1', '1521429226', '');
INSERT INTO `manage_role` VALUES ('D2FFBC02916B41B69C3F15E4B853CA78', '权限管理员', 'privilegeManage', '1', '4203A4F8837C1B66C201F9C230F8E3D1', '1521085813', '', '0', '');
