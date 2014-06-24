-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.36-MariaDB - mariadb.org binary distribution
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 bonjour 的数据库结构
DROP DATABASE IF EXISTS `bonjour`;
CREATE DATABASE IF NOT EXISTS `bonjour` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bonjour`;


-- 导出  表 bonjour.bonjour_demo 结构
DROP TABLE IF EXISTS `bonjour_demo`;
CREATE TABLE IF NOT EXISTS `bonjour_demo` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_demo 的数据：~2 rows (大约)
DELETE FROM `bonjour_demo`;
/*!40000 ALTER TABLE `bonjour_demo` DISABLE KEYS */;
INSERT INTO `bonjour_demo` (`UserID`, `UserName`) VALUES
	(2, 'kristoffer'),
	(3, 'sammy');
/*!40000 ALTER TABLE `bonjour_demo` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_forum 结构
DROP TABLE IF EXISTS `bonjour_forum`;
CREATE TABLE IF NOT EXISTS `bonjour_forum` (
  `forumID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `parentID` int(11) DEFAULT '0',
  `forumName` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `forumOrder` int(3) DEFAULT '0',
  `lockedStatus` int(11) DEFAULT '1',
  `validstatus` int(11) DEFAULT '1',
  KEY `forum_id` (`forumID`),
  KEY `menu_id` (`menuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- 正在导出表  bonjour.bonjour_forum 的数据：~23 rows (大约)
DELETE FROM `bonjour_forum`;
/*!40000 ALTER TABLE `bonjour_forum` DISABLE KEYS */;
INSERT INTO `bonjour_forum` (`forumID`, `menuID`, `parentID`, `forumName`, `url`, `forumOrder`, `lockedStatus`, `validstatus`) VALUES
	(1, 1, 0, '版块管理', NULL, 0, 1, 1),
	(2, 1, 1, '主菜单管理', 'forum/menu.do', 0, 1, 1),
	(3, 1, 0, '用户管理', NULL, 0, 1, 0),
	(4, 2, 0, '项目管理', NULL, 0, 1, 1),
	(5, 2, 0, '需求管理', NULL, 0, 1, 1),
	(7, 2, 0, '任务管理', NULL, 0, 1, 1),
	(8, 2, 0, '测试管理', NULL, 0, 1, 1),
	(9, 2, 0, '理赔数据管理', NULL, 0, 1, 0),
	(10, 2, 4, '项目全景图', 'project', 1, 1, 1),
	(11, 2, 4, '项目高级搜索', '', 2, 1, 1),
	(12, 2, 4, '文档管理', NULL, 3, 1, 1),
	(13, 2, 4, '版本管理', NULL, 4, 1, 1),
	(14, 2, 4, '计划项目', '', 5, 1, 1),
	(15, 2, 4, '车型保有量查询', '', 3, 1, 0),
	(16, 2, 4, '串户保单查询', '', 0, 1, 0),
	(17, 2, 7, '经营单位满期赔付率', NULL, 1, 1, 0),
	(18, 2, 7, '车型满期赔付率', NULL, 2, 1, 0),
	(19, 2, 7, '经营单位简单赔付率', NULL, 3, 1, 0),
	(20, 2, 7, '车型简单赔付率', NULL, 4, 1, 0),
	(21, 2, 7, '单店保费/赔付占比图', NULL, 5, 1, 0),
	(22, 2, 7, '车型保费/赔付占比图', NULL, 6, 1, 0),
	(23, 2, 7, '高级查询', NULL, 7, 1, 0),
	(24, 2, 0, '续保数据管理', NULL, 0, 1, 0);
/*!40000 ALTER TABLE `bonjour_forum` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_menu 结构
DROP TABLE IF EXISTS `bonjour_menu`;
CREATE TABLE IF NOT EXISTS `bonjour_menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(50) DEFAULT NULL,
  `menuOrder` int(11) DEFAULT '0',
  `lockedStatus` tinyint(4) DEFAULT '1',
  `validstatus` tinyint(4) DEFAULT '1',
  KEY `menu_id` (`menuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- 正在导出表  bonjour.bonjour_menu 的数据：~2 rows (大约)
DELETE FROM `bonjour_menu`;
/*!40000 ALTER TABLE `bonjour_menu` DISABLE KEYS */;
INSERT INTO `bonjour_menu` (`menuID`, `menuName`, `menuOrder`, `lockedStatus`, `validstatus`) VALUES
	(1, '系统管理', 2, 1, 1),
	(2, '项目管理', 1, 1, 1);
/*!40000 ALTER TABLE `bonjour_menu` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_project_main 结构
DROP TABLE IF EXISTS `bonjour_project_main`;
CREATE TABLE IF NOT EXISTS `bonjour_project_main` (
  `ProjectCode` char(12) NOT NULL,
  `NodeType` char(1) NOT NULL,
  `ProjectName` varchar(100) NOT NULL,
  `RootNode` char(12) DEFAULT NULL,
  `ParentNode` char(12) NOT NULL,
  `NodeCodeRoute` varchar(100) DEFAULT NULL,
  `NodeNameRoute` varchar(500) DEFAULT NULL,
  `CreateDate` int(8) NOT NULL,
  `EstimateStartDate` int(8) DEFAULT NULL,
  `EstimateDuration` int(11) DEFAULT NULL,
  `RealStartDate` int(8) DEFAULT NULL,
  `CreatorID` int(11) NOT NULL,
  `CreatorName` varchar(50) DEFAULT NULL,
  `ResponsibleID` int(11) NOT NULL,
  `ResponsibleName` varchar(50) DEFAULT NULL,
  `Description` text,
  `ReleaseCode` int(11) DEFAULT NULL,
  `LockedStatus` tinyint(4) DEFAULT '0',
  `Flag` char(8) DEFAULT '00000000',
  `ModuleName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ProjectCode`),
  KEY `NodeType` (`NodeType`),
  KEY `ParentNode` (`ParentNode`),
  KEY `CreatorID` (`CreatorID`),
  KEY `ResponsibleID` (`ResponsibleID`),
  KEY `Flag` (`Flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目主表';

-- 正在导出表  bonjour.bonjour_project_main 的数据：~53 rows (大约)
DELETE FROM `bonjour_project_main`;
/*!40000 ALTER TABLE `bonjour_project_main` DISABLE KEYS */;
INSERT INTO `bonjour_project_main` (`ProjectCode`, `NodeType`, `ProjectName`, `RootNode`, `ParentNode`, `NodeCodeRoute`, `NodeNameRoute`, `CreateDate`, `EstimateStartDate`, `EstimateDuration`, `RealStartDate`, `CreatorID`, `CreatorName`, `ResponsibleID`, `ResponsibleName`, `Description`, `ReleaseCode`, `LockedStatus`, `Flag`, `ModuleName`) VALUES
	('P20140600001', 'P', '用户管理', 'R20140600006', 'R20140600006', 'P20140600001', '用户管理', 20140604, 20140609, 50, NULL, 1, '胡建鸿', 2, '测试帐号1', '管理系统的全部用户和权限管理', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600002', 'P', '界面管理', 'R20140600006', 'R20140600006', 'P20140600002', '界面管理', 20140604, NULL, 100, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600003', 'P', '系统参数设定', 'R20140600006', 'R20140600006', 'P20140600003', '系统参数设定', 20140604, NULL, 5, NULL, 1, '胡建鸿', 23, '测试帐号22', '主要的参数管理', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600004', 'P', '测试模块1', 'R20140600002', 'R20140600002', 'P20140600004', '测试模块1', 20140604, 20140618, 5, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600005', 'P', '简单动画演示', 'R20140600004', 'R20140600004', 'P20140600005', '简单动画演示', 20140604, 20140605, 10, NULL, 1, '胡建鸿', 2, '测试帐号1', '简单动画演示', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600006', 'P', '项目管理', 'R20140600009', 'R20140600009', 'P20140600006', '项目管理', 20140604, 20140605, 20, NULL, 1, '胡建鸿', 1, '胡建鸿', '核心项目树管理，同时具有添加高级搜索、报表提取、文档管理、版本管理和ftp管理', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600007', 'P', '需求管理', 'R20140600009', 'P20140600006', 'P20140600007', '需求管理', 20140604, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600008', 'P', '任务管理', 'R20140600009', 'P20140600006', 'P20140600008', '任务管理', 20140604, NULL, 5, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600009', 'P', '测试管理', 'R20140600009', 'P20140600006', 'P20140600009', '测试管理', 20140604, NULL, 5, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600010', 'P', '主菜单管理', 'R20140600009', 'R20140600009', 'P20140600010', '主菜单管理', 20140604, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600011', 'P', '权限管理', 'R20140600009', 'R20140600009', 'P20140600011', '权限管理', 20140604, 20140630, 10, NULL, 1, '胡建鸿', 2, '测试帐号1', '权限管理', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600012', 'P', '皮肤管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600012', '项目管理系统|皮肤管理', 20140604, 20140716, 10, NULL, 1, '胡建鸿', 3, '测试帐号2', '系统界面管理', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600013', 'P', '网站地图管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600013', '项目管理系统|网站地图管理', 20140604, NULL, 2, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600014', 'P', '移动APP项目', 'R20140600009', 'R20140600009', 'R20140600009|P20140600014', '项目管理系统|移动APP项目', 20140604, 20140618, 60, NULL, 1, '胡建鸿', 3, '测试帐号2', '主要是Android和iphone项目管理', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600015', 'P', 'test module', 'R20140600004', 'R20140600004', 'R20140600004|P20140600015', '测试项目5|test module', 20140604, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', 'test test test', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600016', 'P', '企业简介', 'R20140600011', 'R20140600011', 'R20140600011|P20140600016', '风花雪月婚恋网|企业简介', 20140604, NULL, 1, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600017', 'P', '产品分类', 'R20140600011', 'R20140600011', 'R20140600011|P20140600017', '风花雪月婚恋网|产品分类', 20140604, NULL, 1, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600018', 'P', '产品管理', 'R20140600011', 'R20140600011', 'R20140600011|P20140600018', '风花雪月婚恋网|产品管理', 20140604, NULL, 1, NULL, 1, '胡建鸿', 1, '胡建鸿', '包括添加、修改、删除、上传图片等功能', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600019', 'P', '关于我们', 'R20140600011', 'R20140600011', 'R20140600011|P20140600019', '风花雪月婚恋网|关于我们', 20140604, NULL, 1, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600020', 'P', '运营商管理', 'R20140600009', 'P20140600013', 'R20140600009|P20140600020', '项目管理系统|运营商管理', 20140604, 20140725, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600021', 'P', '后台管理', 'R20140600011', 'R20140600011', 'R20140600011|P20140600021', '风花雪月婚恋网|后台管理', 20140604, NULL, 2, NULL, 1, '胡建鸿', 1, '胡建鸿', '通用管理后台模板制作', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600022', 'P', '系统管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600022', '项目管理系统|系统管理', 20140605, 20140620, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600023', 'P', 'test test test3', 'R20140600004', 'R20140600004', 'R20140600004|P20140600023', '测试项目5|test test test3', 20140605, 20140610, 5, NULL, 1, '胡建鸿', 10, '测试帐号9', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600024', 'P', '支付管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600024', '项目管理系统|支付管理', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600025', 'P', '成本管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600025', '项目管理系统|成本管理', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600026', 'P', '风险管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600026', '项目管理系统|风险管理', 20140605, NULL, 5, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600027', 'P', '测试1', 'R20140600008', 'R20140600008', 'R20140600008|P20140600027', '测试项目9|测试1', 20140605, NULL, 5, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, '00000000', 'ProjectMain'),
	('P20140600028', 'P', 'test', 'R20140600003', 'R20140600003', 'R20140600003|P20140600028', '测试项目4|test', 20140605, NULL, 5, NULL, 1, '胡建鸿', 3, '测试帐号2', '', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600001', 'R', '测试项目1', 'R20140600001', '000000000000', 'R20140600001', 'fdsafdsfasdfasdfasdfasdfsdf', 20140604, 20140618, 100, NULL, 1, '胡建鸿', 3, '测试帐号2', 'fdsafcdscasc', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600002', 'R', '测试项目2', 'R20140600002', '000000000000', 'R20140600002', '测试项目28989898', 20140604, 20140604, 100, NULL, 1, '胡建鸿', 1, '胡建鸿', 'dafdsfdsfsd', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600003', 'R', '测试项目4', 'R20140600003', '000000000000', 'R20140600003', 'errwefasdfasdfadsf', 20140604, 20140630, 100, NULL, 1, '胡建鸿', 23, '测试帐号22', 'fdsfasdfasd', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600004', 'R', '测试项目5', 'R20140600004', '000000000000', 'R20140600004', 'fgsdfsgdfgsd', 20140604, 20140617, 100, NULL, 1, '胡建鸿', 1, '胡建鸿', 'fgfsdgdfg', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600005', 'R', '测试项目6', 'R20140600005', '000000000000', 'R20140600005', '项目管理系统BJ', 20140604, 20140605, 30, NULL, 1, '胡建鸿', 1, '胡建鸿', '专门用于项目系统的管理和需求、开发相关的管理', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600006', 'R', '测试项目7', 'R20140600006', '000000000000', 'R20140600006', '测试项目3', 20140604, 20140626, 100, NULL, 1, '胡建鸿', 4, '测试帐号3', '测试项目3', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600007', 'R', '测试项目8', 'R20140600007', '000000000000', 'R20140600007', '测试项目5', 20140604, 20140617, 100, NULL, 1, '胡建鸿', 23, '测试帐号22', 'aaaaaaaaa', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600008', 'R', '测试项目9', 'R20140600008', '000000000000', 'R20140600008', '测试测试测试4', 20140604, NULL, 100, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600009', 'R', '项目管理系统', 'R20140600009', '000000000000', 'R20140600009', '项目管理系统', 20140604, 20140626, 30, NULL, 1, '胡建鸿', 1, '胡建鸿', '系统项目管理', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600010', 'R', '测试测试测试', 'R20140600010', '000000000000', 'R20140600010', '测试测试测试', 20140604, 20140702, 20, NULL, 1, '胡建鸿', 24, '测试帐号23', '测试测试测试', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600011', 'R', '风花雪月婚恋网', 'R20140600011', '000000000000', 'R20140600011', '风花雪月婚恋网', 20140604, 20150617, 8, NULL, 1, '胡建鸿', 1, '胡建鸿', '婚恋网站', NULL, 0, '00000000', 'ProjectMain'),
	('R20140600012', 'R', '当当书店', 'R20140600012', '000000000000', 'R20140600012', '当当书店', 20140605, 20140705, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '一个书店而已', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600001', 'S', '测试模块11', 'R20140600002', 'P20140600004', 'R20140600002|P20140600004|S20140600001', '测试项目2|测试模块1|测试模块11', 20140605, NULL, 5, NULL, 1, '胡建鸿', 3, '测试帐号2', '测试测试', NULL, 0, '10000000', 'ProjectMain'),
	('S20140600002', 'S', '测试模块111', 'R20140600002', 'S20140600001', 'R20140600002|P20140600004|S20140600001|S20140600002', '测试项目2|测试模块1|测试模块11|测试模块111', 20140605, NULL, 5, NULL, 1, '胡建鸿', 3, '测试帐号2', '', NULL, 0, '20000000', 'ProjectMain'),
	('S20140600003', 'S', 'test1111', 'R20140600002', 'S20140600002', 'R20140600002|P20140600004|S20140600001|S20140600002|S20140600003', '测试项目2|测试模块1|测试模块11|测试模块111|test1111', 20140605, NULL, 5, NULL, 1, '胡建鸿', 3, '测试帐号2', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600004', 'S', 'test00111111', 'R20140600002', 'S20140600003', 'R20140600002|P20140600004|S20140600001|S20140600002|S20140600003|S20140600004', '测试项目2|测试模块1|测试模块11|测试模块111|test1111|test00111111', 20140605, 20140605, 5, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600005', 'S', '政策性风险管控', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600005', '项目管理系统|风险管理|政策性风险管控', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600006', 'S', '员工风险管控', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600006', '项目管理系统|风险管理|员工风险管控', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600007', 'S', '融资风险评估', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600007', '项目管理系统|风险管理|融资风险评估', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600008', 'S', '网页版支付平台', 'R20140600009', 'P20140600024', 'R20140600009|P20140600024|S20140600008', '项目管理系统|支付管理|网页版支付平台', 20140605, NULL, 5, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600009', 'S', 'android版支付平台', 'R20140600009', 'P20140600024', 'R20140600009|P20140600024|S20140600009', '项目管理系统|支付管理|android版支付平台', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600010', 'S', 'iphone版本支付平台', 'R20140600009', 'P20140600024', 'R20140600009|P20140600024|S20140600010', '项目管理系统|支付管理|iphone版本支付平台', 20140605, 20140628, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600011', 'S', '技术风险', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600011', '项目管理系统|风险管理|技术风险', 20140605, NULL, 5, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600012', 'S', '太阳能灯具', 'R20140600011', 'P20140600017', 'R20140600011|P20140600017|S20140600012', '风花雪月婚恋网|产品分类|太阳能灯具', 20140605, NULL, 5, NULL, 1, '胡建鸿', 12, '测试帐号11', '', NULL, 0, '00000000', 'ProjectMain'),
	('S20140600013', 'S', 'test2', 'R20140600003', 'P20140600028', 'R20140600003|P20140600028|S20140600013', '测试项目4|test|test2', 20140605, 20140606, 20, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, '00000000', 'ProjectMain');
/*!40000 ALTER TABLE `bonjour_project_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_project_main_history 结构
DROP TABLE IF EXISTS `bonjour_project_main_history`;
CREATE TABLE IF NOT EXISTS `bonjour_project_main_history` (
  `ProjectCode` char(12) NOT NULL,
  `NodeType` char(1) NOT NULL,
  `ProjectName` varchar(100) DEFAULT NULL,
  `RootNode` char(12) DEFAULT NULL,
  `ParentNode` char(12) NOT NULL,
  `NodeCodeRoute` varchar(100) NOT NULL,
  `NodeNameRoute` varchar(500) NOT NULL,
  `CreateDate` int(8) NOT NULL,
  `EstimateStartDate` int(8) DEFAULT NULL,
  `EstimateDuration` int(11) DEFAULT NULL,
  `RealStartDate` int(8) DEFAULT NULL,
  `CreatorID` int(11) NOT NULL,
  `CreatorName` varchar(50) DEFAULT NULL,
  `ResponsibleID` int(11) NOT NULL,
  `ResponsibleName` varchar(50) DEFAULT NULL,
  `Description` int(11) DEFAULT NULL,
  `ReleaseCode` int(11) DEFAULT NULL,
  `Flag` char(8) NOT NULL DEFAULT '00000000',
  `FtpAddress` int(11) DEFAULT NULL,
  `ModifiedTime` datetime NOT NULL,
  `ModifiedPerson` varchar(50) DEFAULT NULL,
  `ModifiedLog` text,
  KEY `NodeType` (`NodeType`),
  KEY `ParentNode` (`ParentNode`),
  KEY `CreatorID` (`CreatorID`),
  KEY `ResponsibleID` (`ResponsibleID`),
  KEY `Flag` (`Flag`),
  KEY `ProjectCode` (`ProjectCode`),
  KEY `ModifiedTime` (`ModifiedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='项目历史表';

-- 正在导出表  bonjour.bonjour_project_main_history 的数据：~0 rows (大约)
DELETE FROM `bonjour_project_main_history`;
/*!40000 ALTER TABLE `bonjour_project_main_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_project_main_history` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_main 结构
DROP TABLE IF EXISTS `bonjour_requirement_main`;
CREATE TABLE IF NOT EXISTS `bonjour_requirement_main` (
  `RequirementID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectCode` char(12) NOT NULL,
  `RequirementName` varchar(150) DEFAULT NULL,
  `Description` text,
  `AcceptanceCriteria` text,
  `DependenceID` int(11) DEFAULT NULL,
  `CreateDate` int(8) NOT NULL,
  `LastModifiedTime` datetime NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `CreatorName` varchar(50) DEFAULT NULL,
  `DistributorID` int(11) DEFAULT NULL,
  `DistributorName` varchar(50) DEFAULT NULL,
  `ReviewerID` int(11) DEFAULT NULL,
  `ReviewerName` varchar(50) DEFAULT NULL,
  `ClosedBy` varchar(50) DEFAULT NULL,
  `Priority` int(1) NOT NULL,
  `LockedStatus` int(1) NOT NULL DEFAULT '0',
  `Flag` char(8) DEFAULT '00000000',
  `Keyword` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`RequirementID`),
  KEY `ProjectCode` (`ProjectCode`),
  KEY `CreateDate` (`CreateDate`),
  KEY `CreatorID` (`CreatorID`),
  KEY `DistributorID` (`DistributorID`),
  KEY `ReviewerID` (`ReviewerID`),
  KEY `Priority` (`Priority`),
  KEY `Flag` (`Flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='需求主表';

-- 正在导出表  bonjour.bonjour_requirement_main 的数据：~0 rows (大约)
DELETE FROM `bonjour_requirement_main`;
/*!40000 ALTER TABLE `bonjour_requirement_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_requirement_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_main_history 结构
DROP TABLE IF EXISTS `bonjour_requirement_main_history`;
CREATE TABLE IF NOT EXISTS `bonjour_requirement_main_history` (
  `RequirementID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectCode` char(12) NOT NULL,
  `RequirementName` varchar(150) DEFAULT NULL,
  `Description` text,
  `AcceptanceCriteria` text,
  `DependenceID` int(11) DEFAULT NULL,
  `CreateDate` int(8) NOT NULL,
  `LastModifiedTime` datetime NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `CreatorName` varchar(50) DEFAULT NULL,
  `DistributorID` int(11) DEFAULT NULL,
  `DistributorName` varchar(50) DEFAULT NULL,
  `ReviewerID` int(11) DEFAULT NULL,
  `ReviewerName` varchar(50) DEFAULT NULL,
  `ClosedBy` varchar(50) DEFAULT NULL,
  `Priority` int(1) NOT NULL,
  `LockedStatus` int(1) DEFAULT NULL,
  `Flag` char(8) DEFAULT '00000000',
  `Keyword` varchar(150) DEFAULT NULL,
  `ModifiedTime` datetime NOT NULL,
  `ModifiedPerson` varchar(50) DEFAULT NULL,
  `ModifiedLog` text,
  KEY `ProjectCode` (`ProjectCode`),
  KEY `CreateDate` (`CreateDate`),
  KEY `CreatorID` (`CreatorID`),
  KEY `DistributorID` (`DistributorID`),
  KEY `ReviewerID` (`ReviewerID`),
  KEY `Priority` (`Priority`),
  KEY `Flag` (`Flag`),
  KEY `RequirementID` (`RequirementID`),
  KEY `ModifiedTime` (`ModifiedTime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='需求历史表';

-- 正在导出表  bonjour.bonjour_requirement_main_history 的数据：~0 rows (大约)
DELETE FROM `bonjour_requirement_main_history`;
/*!40000 ALTER TABLE `bonjour_requirement_main_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_requirement_main_history` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_review 结构
DROP TABLE IF EXISTS `bonjour_requirement_review`;
CREATE TABLE IF NOT EXISTS `bonjour_requirement_review` (
  `ApplicationID` int(11) NOT NULL AUTO_INCREMENT,
  `RequirementID` int(11) NOT NULL,
  `ApplicantID` int(11) NOT NULL,
  `ApplicantName` varchar(50) DEFAULT NULL,
  `ApplicantRemark` text,
  `ReviewerID` int(11) NOT NULL,
  `ReviewerName` varchar(50) DEFAULT NULL,
  `ReviewType` char(1) NOT NULL,
  `ReviewComment` text,
  `CreateTime` datetime NOT NULL,
  `LastModifiedTime` datetime DEFAULT NULL,
  `FeedbackTime` datetime DEFAULT NULL,
  `LockedStatus` int(1) NOT NULL DEFAULT '0',
  `Flag` char(8) DEFAULT '00000000',
  PRIMARY KEY (`ApplicationID`),
  KEY `RequirementID` (`RequirementID`),
  KEY `ApplicantID` (`ApplicantID`),
  KEY `ReviewerID` (`ReviewerID`),
  KEY `CreateTime` (`CreateTime`),
  KEY `Flag` (`Flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='需求评审表';

-- 正在导出表  bonjour.bonjour_requirement_review 的数据：~0 rows (大约)
DELETE FROM `bonjour_requirement_review`;
/*!40000 ALTER TABLE `bonjour_requirement_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_requirement_review` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_role 结构
DROP TABLE IF EXISTS `bonjour_role`;
CREATE TABLE IF NOT EXISTS `bonjour_role` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(50) NOT NULL,
  `CreateDate` int(8) NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `CreatorName` varchar(50) DEFAULT NULL,
  `ExpiryDate` int(8) DEFAULT '99999999',
  `DefaultStatus` tinyint(1) DEFAULT '0',
  `Remark` text,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_role 的数据：~9 rows (大约)
DELETE FROM `bonjour_role`;
/*!40000 ALTER TABLE `bonjour_role` DISABLE KEYS */;
INSERT INTO `bonjour_role` (`RoleID`, `RoleName`, `CreateDate`, `CreatorID`, `CreatorName`, `ExpiryDate`, `DefaultStatus`, `Remark`) VALUES
	(1, '超级管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(2, '项目管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(3, '需求管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(4, '任务管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(5, '测试管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(6, '系统管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(7, '临时管理员', 20140531, 1, '胡建鸿', 20150531, 0, NULL),
	(8, '文档管理员', 20140531, 1, '胡建鸿', 99999999, 0, NULL),
	(9, '普通用户', 20140531, 1, '胡建鸿', 99999999, 1, NULL);
/*!40000 ALTER TABLE `bonjour_role` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_session 结构
DROP TABLE IF EXISTS `bonjour_session`;
CREATE TABLE IF NOT EXISTS `bonjour_session` (
  `id` char(32) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 正在导出表  bonjour.bonjour_session 的数据：0 rows
DELETE FROM `bonjour_session`;
/*!40000 ALTER TABLE `bonjour_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_session` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_task_main 结构
DROP TABLE IF EXISTS `bonjour_task_main`;
CREATE TABLE IF NOT EXISTS `bonjour_task_main` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskName` varchar(150) DEFAULT NULL,
  `RequirementID` int(11) NOT NULL,
  `DependenceID` int(11) DEFAULT NULL,
  `CreatorID` int(11) NOT NULL,
  `CreatorName` varchar(50) DEFAULT NULL,
  `CreateTime` datetime NOT NULL,
  `HandlerID` int(11) NOT NULL,
  `HandlerName` varchar(50) DEFAULT NULL,
  `EstimateStartDate` int(8) DEFAULT NULL,
  `EstimateEndDate` int(8) DEFAULT NULL,
  `EstimateHour` int(11) DEFAULT NULL,
  `RealStartDate` int(8) DEFAULT NULL,
  `RealEndDate` int(8) DEFAULT NULL,
  `LastModifiedTime` datetime DEFAULT NULL,
  `Priority` int(1) NOT NULL,
  `LockedStatus` int(1) DEFAULT '0',
  `Flag` char(8) DEFAULT '00000000',
  `Keyword` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  KEY `RequirementID` (`RequirementID`),
  KEY `CreatorID` (`CreatorID`),
  KEY `HandlerID` (`HandlerID`),
  KEY `Priority` (`Priority`),
  KEY `Flag` (`Flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务主表';

-- 正在导出表  bonjour.bonjour_task_main 的数据：~0 rows (大约)
DELETE FROM `bonjour_task_main`;
/*!40000 ALTER TABLE `bonjour_task_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_task_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_task_schedule 结构
DROP TABLE IF EXISTS `bonjour_task_schedule`;
CREATE TABLE IF NOT EXISTS `bonjour_task_schedule` (
  `TaskID` int(11) DEFAULT NULL,
  `StartDate` int(11) DEFAULT NULL,
  `EndDate` int(11) DEFAULT NULL,
  `StartHour` int(11) DEFAULT NULL,
  `EndHour` int(11) DEFAULT NULL,
  `StartMinute` int(11) DEFAULT NULL,
  `EndMinute` int(11) DEFAULT NULL,
  `CreateTime` int(11) DEFAULT NULL,
  `Remark` int(11) DEFAULT NULL,
  `ItemType` int(11) DEFAULT NULL,
  `CalExhausted` int(11) DEFAULT NULL,
  `RealExhausted` int(11) DEFAULT NULL,
  `CodeAmount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务进度监控表';

-- 正在导出表  bonjour.bonjour_task_schedule 的数据：~0 rows (大约)
DELETE FROM `bonjour_task_schedule`;
/*!40000 ALTER TABLE `bonjour_task_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_task_schedule` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_user 结构
DROP TABLE IF EXISTS `bonjour_user`;
CREATE TABLE IF NOT EXISTS `bonjour_user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `UserPass` char(32) DEFAULT NULL,
  `RoleID` int(11) unsigned NOT NULL DEFAULT '0',
  `Email` varchar(100) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `CreateDate` int(8) NOT NULL,
  `LoginTimes` int(11) DEFAULT '0',
  `LastLogin` int(8) DEFAULT '0',
  `ValidStatus` int(11) DEFAULT '1',
  PRIMARY KEY (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_user 的数据：~29 rows (大约)
DELETE FROM `bonjour_user`;
/*!40000 ALTER TABLE `bonjour_user` DISABLE KEYS */;
INSERT INTO `bonjour_user` (`UserID`, `UserName`, `UserPass`, `RoleID`, `Email`, `Mobile`, `PhoneNumber`, `CreateDate`, `LoginTimes`, `LastLogin`, `ValidStatus`) VALUES
	(1, '胡建鸿', '489f71f382393834491ba8ac79208a56', 1, 'sammy19871116@gmail.com', NULL, NULL, 20140531, 0, 0, 1),
	(2, '测试帐号1', '489f71f382393834491ba8ac79208a56', 2, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(3, '测试帐号2', '489f71f382393834491ba8ac79208a56', 3, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(4, '测试帐号3', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(5, '测试帐号4', '489f71f382393834491ba8ac79208a56', 5, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(6, '测试帐号5', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(7, '测试帐号6', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(8, '测试帐号7', '489f71f382393834491ba8ac79208a56', 6, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(9, '测试帐号8', '489f71f382393834491ba8ac79208a56', 8, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(10, '测试帐号9', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(11, '测试帐号10', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(12, '测试帐号11', '489f71f382393834491ba8ac79208a56', 5, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(13, '测试帐号12', '489f71f382393834491ba8ac79208a56', 7, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(14, '测试帐号13', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(15, '测试帐号14', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(16, '测试帐号15', '489f71f382393834491ba8ac79208a56', 4, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(17, '测试帐号16', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 0),
	(18, '测试帐号17', '489f71f382393834491ba8ac79208a56', 6, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(19, '测试帐号18', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(20, '测试帐号19', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(21, '测试帐号20', '489f71f382393834491ba8ac79208a56', 3, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(22, '测试帐号21', '489f71f382393834491ba8ac79208a56', 3, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(23, '测试帐号22', '489f71f382393834491ba8ac79208a56', 2, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(24, '测试帐号23', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 1),
	(25, '测试帐号24', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 0),
	(26, '测试帐号25', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 0),
	(27, '测试帐号26', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 0),
	(28, '测试帐号27', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 0),
	(29, '测试帐号28', '489f71f382393834491ba8ac79208a56', 9, NULL, NULL, NULL, 20140531, 0, 0, 0);
/*!40000 ALTER TABLE `bonjour_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
