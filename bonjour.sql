-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.32 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  8.3.0.4713
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 bonjour 的数据库结构
CREATE DATABASE IF NOT EXISTS `bonjour` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bonjour`;


-- 导出  表 bonjour.bonjour_attachment 结构
CREATE TABLE IF NOT EXISTS `bonjour_attachment` (
  `attachmentID` char(15) NOT NULL,
  `moduleName` varchar(50) NOT NULL,
  `moduleCode` varchar(50) DEFAULT NULL,
  `moduleID` int(11) DEFAULT NULL,
  `realPath` varchar(200) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `fileSize` varchar(50) NOT NULL,
  `downloadTimes` int(11) DEFAULT '0',
  `createTime` char(19) NOT NULL,
  PRIMARY KEY (`attachmentID`),
  KEY `ModuleName` (`moduleName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_attachment 的数据：~17 rows (大约)
/*!40000 ALTER TABLE `bonjour_attachment` DISABLE KEYS */;
INSERT INTO `bonjour_attachment` (`attachmentID`, `moduleName`, `moduleCode`, `moduleID`, `realPath`, `fileName`, `fileSize`, `downloadTimes`, `createTime`) VALUES
	('140443892709512', 'ProjectMain', 'P20140600023', NULL, 'D:\\myfiles\\ProjectMain\\P20140600023\\8626f59fb09f2f4ed423bbab0c4fe3ea.jpg', '947513521017832.jpg', '31KB', 4, '2014-07-04 09:55:27'),
	('140443892722140', 'ProjectMain', 'P20140600023', NULL, 'D:\\myfiles\\ProjectMain\\P20140600023\\bf4481ff6eef2e3c2ca0d9a4298953d9.jpg', '3320946_073017074373_2.jpg', '113KB', 4, '2014-07-04 09:55:27'),
	('140443892751516', 'ProjectMain', 'P20140600023', NULL, 'D:\\myfiles\\ProjectMain\\P20140600023\\32104780c154d94352d2517a6800c994.jpg', '094S21b36.jpg', '12KB', 1, '2014-07-04 09:55:27'),
	('140444874093945', 'ProjectMain', 'P20140600023', NULL, 'D:\\myfiles\\ProjectMain\\P20140600023\\9bcecb9bfe2e3c4ca8ae808aefdb6915.jpg', 'iceage02.jpg', '353KB', 1, '2014-07-04 12:39:00'),
	('140444874181829', 'ProjectMain', 'P20140600023', NULL, 'D:\\myfiles\\ProjectMain\\P20140600023\\e9f3675d6be4f541d535219b4456c7ea.jpg', 'iceage05.jpg', '385KB', 1, '2014-07-04 12:39:01'),
	('140445121515847', 'ProjectMain', 'S20140600004', NULL, 'D:\\myfiles\\ProjectMain\\S20140600004\\12579d771ff3a25b58ab1705ba4465ed.jpg', '7-73-1670773.jpg', '50KB', 1, '2014-07-04 13:20:15'),
	('140445121564401', 'ProjectMain', 'S20140600004', NULL, 'D:\\myfiles\\ProjectMain\\S20140600004\\4dbd579b74e57c854069b5c354eb0eaf.jpg', '0023ae98988b0d2d2fde22.jpg', '17KB', 1, '2014-07-04 13:20:15'),
	('140445121602737', 'ProjectMain', 'S20140600004', NULL, 'D:\\myfiles\\ProjectMain\\S20140600004\\2cb770d9b06ef1db91877baaf155d0c8.jpg', '100HI5K-0.jpg', '85KB', 0, '2014-07-04 13:20:16'),
	('140445121630111', 'ProjectMain', 'S20140600004', NULL, 'D:\\myfiles\\ProjectMain\\S20140600004\\de7d6438c4af47136496010481c2c40e.jpg', '094S21b36.jpg', '12KB', 0, '2014-07-04 13:20:16'),
	('140445121634390', 'ProjectMain', 'S20140600004', NULL, 'D:\\myfiles\\ProjectMain\\S20140600004\\0bbd63a8d8224c939dc7ed83e2123409.jpg', '81d1f47ea239b1e92304c7383e7133bb.jpg', '58KB', 0, '2014-07-04 13:20:16'),
	('140445137207446', 'ProjectMain', 'S20140600003', NULL, 'D:\\myfiles\\ProjectMain\\S20140600003\\e5018a7d53bc83b7d0eef482e234038c.jpg', '2013-08-12_140656.jpg', '30KB', 0, '2014-07-04 13:22:52'),
	('140445137361932', 'ProjectMain', 'S20140600003', NULL, 'D:\\myfiles\\ProjectMain\\S20140600003\\5251a5b9fb699624fb8e88c74216f71c.jpg', '8112030_085720058366_22.jpg', '16KB', 0, '2014-07-04 13:22:53'),
	('140445143405795', 'ProjectMain', 'S20140600001', NULL, 'D:\\myfiles\\ProjectMain\\S20140600001\\40e91ba7114ba6757395849b2c11b3ad.zip', 'vector333454190517281.zip', '1MB', 1, '2014-07-04 13:23:54'),
	('140445143432730', 'ProjectMain', 'S20140600001', NULL, 'D:\\myfiles\\ProjectMain\\S20140600001\\5bf116a1d29aa6c36d567e4f235b55b1.zip', 'vector417477231521291.zip', '1MB', 1, '2014-07-04 13:23:54'),
	('140480495775967', 'ProjectMain', 'P20140700001', NULL, 'D:\\myfiles\\ProjectMain\\P20140700001\\53226099134a8f412f0618067b8b4bbf.jpg', 'iceage05.jpg', '385KB', 1, '2014-07-08 15:35:57'),
	('140480602863891', 'RequirementMain', NULL, 3, 'D:\\myfiles\\RequirementMain\\3\\50f3e3461feecaede9aefd9c1ad0d801.jpg', 'iceage02.jpg', '353KB', 2, '2014-07-08 15:53:48'),
	('140480608003460', 'RequirementMain', NULL, 3, 'D:\\myfiles\\RequirementMain\\3\\b5a3672d3e03d10e9b0462c94161bf30.jpg', 'The_Croods15.jpg', '104KB', 1, '2014-07-08 15:54:40');
/*!40000 ALTER TABLE `bonjour_attachment` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_demo 结构
CREATE TABLE IF NOT EXISTS `bonjour_demo` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_demo 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `bonjour_demo` DISABLE KEYS */;
INSERT INTO `bonjour_demo` (`UserID`, `UserName`) VALUES
	(2, 'kristoffer'),
	(3, 'sammy');
/*!40000 ALTER TABLE `bonjour_demo` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_forum 结构
CREATE TABLE IF NOT EXISTS `bonjour_forum` (
  `forumID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `parentID` int(11) DEFAULT '0',
  `forumName` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `forumOrder` int(3) DEFAULT '0',
  `lockedStatus` int(11) DEFAULT '1',
  `validStatus` int(11) DEFAULT '1',
  KEY `forum_id` (`forumID`),
  KEY `menu_id` (`menuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- 正在导出表  bonjour.bonjour_forum 的数据：~23 rows (大约)
/*!40000 ALTER TABLE `bonjour_forum` DISABLE KEYS */;
INSERT INTO `bonjour_forum` (`forumID`, `menuID`, `parentID`, `forumName`, `url`, `forumOrder`, `lockedStatus`, `validStatus`) VALUES
	(1, 1, 0, '版块管理', NULL, 0, 1, 1),
	(2, 1, 1, '主菜单管理', 'forum/menu', 0, 1, 1),
	(3, 1, 0, '用户管理', 'system/user', 0, 1, 1),
	(4, 2, 0, '项目管理', NULL, 0, 1, 1),
	(5, 2, 0, '需求管理', NULL, 0, 1, 1),
	(7, 2, 0, '任务管理', NULL, 0, 1, 1),
	(8, 2, 0, '测试管理', NULL, 0, 1, 1),
	(9, 2, 0, '理赔数据管理', NULL, 0, 1, 0),
	(10, 2, 4, '项目全景图', 'project/main', 2, 1, 1),
	(11, 2, 4, '项目高级搜索', '', 3, 1, 1),
	(12, 2, 4, '文档管理', NULL, 4, 1, 1),
	(13, 2, 4, '版本管理', NULL, 5, 1, 1),
	(14, 2, 4, '计划项目', '', 6, 1, 1),
	(15, 2, 0, '我的地盘', '', 5, 1, 1),
	(16, 2, 4, '项目树', '', 1, 1, 1),
	(17, 2, 5, '需求查询', 'project/req/query-all', 1, 1, 1),
	(18, 2, 0, '团队管理', 'project/team', 2, 1, 1),
	(19, 1, 0, '权限管理', NULL, 3, 1, 1),
	(20, 1, 19, '版块权限', NULL, 4, 1, 1),
	(21, 1, 19, '操作权限', NULL, 5, 1, 1),
	(22, 2, 7, '车型保费/赔付占比图', NULL, 6, 1, 0),
	(23, 2, 7, '高级查询', NULL, 7, 1, 0),
	(24, 2, 0, '续保数据管理', NULL, 0, 1, 0);
/*!40000 ALTER TABLE `bonjour_forum` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_menu 结构
CREATE TABLE IF NOT EXISTS `bonjour_menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(50) DEFAULT NULL,
  `menuOrder` int(11) DEFAULT '0',
  `lockedStatus` tinyint(4) DEFAULT '1',
  `validstatus` tinyint(4) DEFAULT '1',
  KEY `menu_id` (`menuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

-- 正在导出表  bonjour.bonjour_menu 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `bonjour_menu` DISABLE KEYS */;
INSERT INTO `bonjour_menu` (`menuID`, `menuName`, `menuOrder`, `lockedStatus`, `validstatus`) VALUES
	(1, '系统管理', 2, 1, 1),
	(2, '项目管理', 1, 1, 1);
/*!40000 ALTER TABLE `bonjour_menu` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_privilege_access 结构
CREATE TABLE IF NOT EXISTS `bonjour_privilege_access` (
  `forumID` int(11) DEFAULT NULL,
  `accessName` varchar(20) DEFAULT NULL,
  `displayName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_privilege_access 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bonjour_privilege_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_privilege_access` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_privilege_access_operation 结构
CREATE TABLE IF NOT EXISTS `bonjour_privilege_access_operation` (
  `accessName` varchar(20) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `operationName` varchar(20) NOT NULL,
  KEY `Operation` (`operation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_privilege_access_operation 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `bonjour_privilege_access_operation` DISABLE KEYS */;
INSERT INTO `bonjour_privilege_access_operation` (`accessName`, `operation`, `operationName`) VALUES
	('Forum', 'ACCESS', '访问');
/*!40000 ALTER TABLE `bonjour_privilege_access_operation` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_privilege_main 结构
CREATE TABLE IF NOT EXISTS `bonjour_privilege_main` (
  `masterType` varchar(4) NOT NULL,
  `masterKey` varchar(10) NOT NULL,
  `masterValue` int(11) NOT NULL,
  `accessName` varchar(20) NOT NULL,
  `accessKey` varchar(20) NOT NULL,
  `accessIDValue` int(11) NOT NULL,
  `accessCodeValue` varchar(20) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `operationName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_privilege_main 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bonjour_privilege_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_privilege_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_project_main 结构
CREATE TABLE IF NOT EXISTS `bonjour_project_main` (
  `projectCode` char(12) NOT NULL,
  `nodeType` char(1) NOT NULL,
  `projectName` varchar(100) NOT NULL,
  `rootNode` char(12) DEFAULT NULL,
  `parentNode` char(12) NOT NULL,
  `nodeCodeRoute` varchar(100) DEFAULT NULL,
  `nodeNameRoute` varchar(500) DEFAULT NULL,
  `createDate` int(8) NOT NULL,
  `estimateStartDate` int(8) DEFAULT NULL,
  `estimateDuration` int(11) DEFAULT NULL,
  `realStartDate` int(8) DEFAULT NULL,
  `teamID` int(8) NOT NULL,
  `teamName` int(8) DEFAULT NULL,
  `creatorID` int(11) NOT NULL,
  `creatorName` varchar(50) DEFAULT NULL,
  `responsibleID` int(11) NOT NULL,
  `responsibleName` varchar(50) DEFAULT NULL,
  `description` text,
  `releaseCode` int(11) DEFAULT NULL,
  `lockedStatus` tinyint(4) DEFAULT '0',
  `flag1` int(11) DEFAULT '0',
  `moduleName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`projectCode`),
  KEY `NodeType` (`nodeType`),
  KEY `ParentNode` (`parentNode`),
  KEY `CreatorID` (`creatorID`),
  KEY `ResponsibleID` (`responsibleID`),
  KEY `Flag1` (`flag1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目主表';

-- 正在导出表  bonjour.bonjour_project_main 的数据：~64 rows (大约)
/*!40000 ALTER TABLE `bonjour_project_main` DISABLE KEYS */;
INSERT INTO `bonjour_project_main` (`projectCode`, `nodeType`, `projectName`, `rootNode`, `parentNode`, `nodeCodeRoute`, `nodeNameRoute`, `createDate`, `estimateStartDate`, `estimateDuration`, `realStartDate`, `teamID`, `teamName`, `creatorID`, `creatorName`, `responsibleID`, `responsibleName`, `description`, `releaseCode`, `lockedStatus`, `flag1`, `moduleName`) VALUES
	('P20140600001', 'P', '用户管理', 'R20140600006', 'R20140600006', 'P20140600001', '用户管理', 20140604, 20140609, 50, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '管理系统的全部用户和权限管理', NULL, 0, 0, 'ProjectMain'),
	('P20140600002', 'P', '界面管理', 'R20140600006', 'R20140600006', 'P20140600002', '界面管理', 20140604, NULL, 100, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600003', 'P', '系统参数设定', 'R20140600006', 'R20140600006', 'P20140600003', '系统参数设定', 20140604, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '主要的参数管理', NULL, 0, 0, 'ProjectMain'),
	('P20140600004', 'P', '测试模块1', 'R20140600002', 'R20140600002', 'P20140600004', '测试模块1', 20140604, 20140618, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600005', 'P', '简单动画演示', 'R20140600004', 'R20140600004', 'P20140600005', '简单动画演示', 20140604, 20140605, 10, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '简单动画演示', NULL, 0, 0, 'ProjectMain'),
	('P20140600006', 'P', '项目管理', 'R20140600009', 'R20140600009', 'P20140600006', '项目管理', 20140604, 20140605, 20, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '核心项目树管理，同时具有添加高级搜索、报表提取、文档管理、版本管理和ftp管理', NULL, 0, 0, 'ProjectMain'),
	('P20140600007', 'P', '需求管理', 'R20140600009', 'P20140600006', 'P20140600007', '需求管理', 20140604, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600008', 'P', '任务管理', 'R20140600009', 'P20140600006', 'P20140600008', '任务管理', 20140604, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600009', 'P', '测试管理', 'R20140600009', 'P20140600006', 'P20140600009', '测试管理', 20140604, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600010', 'P', '主菜单管理', 'R20140600009', 'R20140600009', 'P20140600010', '主菜单管理', 20140604, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600011', 'P', '权限管理', 'R20140600009', 'R20140600009', 'P20140600011', '权限管理', 20140604, 20140630, 10, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '权限管理', NULL, 0, 0, 'ProjectMain'),
	('P20140600012', 'P', '皮肤管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600012', '项目管理系统|皮肤管理', 20140604, 20140716, 10, NULL, 0, NULL, 1, '胡建鸿', 3, '测试帐号2', '系统界面管理', NULL, 0, 0, 'ProjectMain'),
	('P20140600013', 'P', '网站地图管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600013', '项目管理系统|网站地图管理', 20140604, NULL, 2, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600014', 'P', '移动APP项目', 'R20140600009', 'R20140600009', 'R20140600009|P20140600014', '项目管理系统|移动APP项目', 20140604, 20140618, 60, NULL, 0, NULL, 1, '胡建鸿', 3, '测试帐号2', '主要是Android和iphone项目管理', NULL, 0, 0, 'ProjectMain'),
	('P20140600015', 'P', '测试模块', 'R20140600004', 'R20140600004', 'R20140600004|P20140600015', '测试项目5|test module', 20140604, 20140625, 7, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', 'test test test test test', NULL, 1, 0, 'ProjectMain'),
	('P20140600016', 'P', '企业简介', 'R20140600011', 'R20140600011', 'R20140600011|P20140600016', '风花雪月婚恋网|企业简介', 20140604, NULL, 1, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600017', 'P', '产品分类', 'R20140600011', 'R20140600011', 'R20140600011|P20140600017', '风花雪月婚恋网|产品分类', 20140604, NULL, 1, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600018', 'P', '产品管理', 'R20140600011', 'R20140600011', 'R20140600011|P20140600018', '风花雪月婚恋网|产品管理', 20140604, NULL, 1, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '包括添加、修改、删除、上传图片等功能', NULL, 1, 0, 'ProjectMain'),
	('P20140600019', 'P', '关于我们', 'R20140600011', 'R20140600011', 'R20140600011|P20140600019', '风花雪月婚恋网|关于我们', 20140604, NULL, 1, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600020', 'P', '运营商管理', 'R20140600009', 'P20140600013', 'R20140600009|P20140600020', '项目管理系统|运营商管理', 20140604, 20140725, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600021', 'P', '后台管理', 'R20140600011', 'R20140600011', 'R20140600011|P20140600021', '风花雪月婚恋网|后台管理', 20140604, NULL, 2, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '通用管理后台模板制作', NULL, 0, 0, 'ProjectMain'),
	('P20140600022', 'P', '系统管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600022', '项目管理系统|系统管理', 20140605, 20140620, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600023', 'P', '播放器页面', 'R20140600004', 'R20140600004', 'R20140600004|P20140600023', '测试项目5|test test test3', 20140605, 20140610, 5, NULL, 0, NULL, 1, '胡建鸿', 10, '测试帐号9', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600024', 'P', '支付管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600024', '项目管理系统|支付管理', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600025', 'P', '成本管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600025', '项目管理系统|成本管理', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600026', 'P', '风险管理', 'R20140600009', 'R20140600009', 'R20140600009|P20140600026', '项目管理系统|风险管理', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600027', 'P', '测试1', 'R20140600008', 'R20140600008', 'R20140600008|P20140600027', '测试项目9|测试1', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, 0, 'ProjectMain'),
	('P20140600028', 'P', 'test', 'R20140600003', 'R20140600003', 'R20140600003|P20140600028', '测试项目4|test', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 3, '测试帐号2', '', NULL, 0, 0, 'ProjectMain'),
	('P20140700001', 'P', '撤销测试', 'R20140600001', 'R20140600001', 'R20140600001|P20140700001', '测试项目1|撤销测试', 20140704, 20140723, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('P20140700002', 'P', '关闭测试', 'R20140600001', 'R20140600001', 'R20140600001|P20140700002', '测试项目1|关闭测试', 20140704, 20140725, 7, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '关闭测试也要检查子项目', NULL, 0, 0, 'ProjectMain'),
	('P20140700003', 'P', '需求模块测试1', 'R20140600001', 'R20140600001', 'R20140600001|P20140700003', '测试项目1|需求模块测试1', 20140707, 20140707, 5, 20140707, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '需求模块测试1', NULL, 0, 1, 'ProjectMain'),
	('P20140700004', 'P', '状态测试6', 'R20140600001', 'R20140600001', 'R20140600001|P20140700004', '项目状态测试|状态测试6', 20140709, 20140731, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, 0, 'ProjectMain'),
	('R20140600001', 'R', '项目状态测试', 'R20140600001', '000000000000', 'R20140600001', 'fdsafdsfasdfasdfasdfasdfsdf', 20140604, 20140618, 100, 20140707, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '项目状态测试', NULL, 0, 1, 'ProjectMain'),
	('R20140600002', 'R', '测试项目2', 'R20140600002', '000000000000', 'R20140600002', '测试项目28989898', 20140604, 20140604, 100, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', 'dafdsfdsfsd', NULL, 0, 0, 'ProjectMain'),
	('R20140600003', 'R', '测试项目4', 'R20140600003', '000000000000', 'R20140600003', 'errwefasdfasdfadsf', 20140604, 20140630, 100, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', 'fdsfasdfasd', NULL, 0, 0, 'ProjectMain'),
	('R20140600004', 'R', '测试项目5', 'R20140600004', '000000000000', 'R20140600004', 'fgsdfsgdfgsd', 20140604, 20140617, 100, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', 'fgfsdgdfg', NULL, 0, 0, 'ProjectMain'),
	('R20140600005', 'R', '测试项目6', 'R20140600005', '000000000000', 'R20140600005', '项目管理系统BJ', 20140604, 20140605, 30, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '专门用于项目系统的管理和需求、开发相关的管理', NULL, 0, 0, 'ProjectMain'),
	('R20140600006', 'R', '测试项目7', 'R20140600006', '000000000000', 'R20140600006', '测试项目3', 20140604, 20140626, 100, NULL, 0, NULL, 1, '胡建鸿', 4, '测试帐号3', '测试项目3', NULL, 0, 0, 'ProjectMain'),
	('R20140600007', 'R', '测试项目8', 'R20140600007', '000000000000', 'R20140600007', '测试项目5', 20140604, 20140617, 100, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', 'aaaaaaaaa', NULL, 0, 0, 'ProjectMain'),
	('R20140600008', 'R', '测试项目9', 'R20140600008', '000000000000', 'R20140600008', '测试测试测试4', 20140604, NULL, 100, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('R20140600009', 'R', '项目管理系统', 'R20140600009', '000000000000', 'R20140600009', '项目管理系统', 20140604, 20140626, 30, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '系统项目管理', NULL, 0, 0, 'ProjectMain'),
	('R20140600010', 'R', '测试测试测试', 'R20140600010', '000000000000', 'R20140600010', '测试测试测试', 20140604, 20140702, 20, NULL, 0, NULL, 1, '胡建鸿', 24, '测试帐号23', '测试测试测试', NULL, 0, 0, 'ProjectMain'),
	('R20140600011', 'R', '风花雪月婚恋网', 'R20140600011', '000000000000', 'R20140600011', '风花雪月婚恋网', 20140604, 20150617, 8, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '婚恋网站', NULL, 0, 0, 'ProjectMain'),
	('R20140600012', 'R', '当当书店', 'R20140600012', '000000000000', 'R20140600012', '当当书店', 20140605, 20140705, 5, 20140708, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '一个书店而已', NULL, 0, 1, 'ProjectMain'),
	('S20140600001', 'S', '测试模块11', 'R20140600002', 'P20140600004', 'R20140600002|P20140600004|S20140600001', '测试项目2|测试模块1|测试模块11', 20140605, 20140731, 9, NULL, 0, NULL, 1, '胡建鸿', 3, '测试帐号2', '测试测试', NULL, 0, 1, 'ProjectMain'),
	('S20140600002', 'S', '测试模块111', 'R20140600002', 'S20140600001', 'R20140600002|P20140600004|S20140600001|S20140600002', '测试项目2|测试模块1|测试模块11|测试模块111', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 3, '测试帐号2', '', NULL, 1, 2, 'ProjectMain'),
	('S20140600003', 'S', 'test1111', 'R20140600002', 'S20140600002', 'R20140600002|P20140600004|S20140600001|S20140600002|S20140600003', '测试项目2|测试模块1|测试模块11|测试模块111|test1111', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 3, '测试帐号2', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600004', 'S', 'test00111111', 'R20140600002', 'S20140600003', 'R20140600002|P20140600004|S20140600001|S20140600002|S20140600003|S20140600004', '测试项目2|测试模块1|测试模块11|测试模块111|test1111|test00111111', 20140605, 20140605, 5, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600005', 'S', '政策性风险管控', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600005', '项目管理系统|风险管理|政策性风险管控', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600006', 'S', '员工风险管控', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600006', '项目管理系统|风险管理|员工风险管控', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600007', 'S', '融资风险评估', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600007', '项目管理系统|风险管理|融资风险评估', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600008', 'S', '网页版支付平台', 'R20140600009', 'P20140600024', 'R20140600009|P20140600024|S20140600008', '项目管理系统|支付管理|网页版支付平台', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600009', 'S', 'android版支付平台', 'R20140600009', 'P20140600024', 'R20140600009|P20140600024|S20140600009', '项目管理系统|支付管理|android版支付平台', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600010', 'S', 'iphone版本支付平台', 'R20140600009', 'P20140600024', 'R20140600009|P20140600024|S20140600010', '项目管理系统|支付管理|iphone版本支付平台', 20140605, 20140628, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600011', 'S', '技术风险', 'R20140600009', 'P20140600026', 'R20140600009|P20140600026|S20140600011', '项目管理系统|风险管理|技术风险', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600012', 'S', '太阳能灯具', 'R20140600011', 'P20140600017', 'R20140600011|P20140600017|S20140600012', '风花雪月婚恋网|产品分类|太阳能灯具', 20140605, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 12, '测试帐号11', '', NULL, 0, 0, 'ProjectMain'),
	('S20140600013', 'S', 'test2', 'R20140600003', 'P20140600028', 'R20140600003|P20140600028|S20140600013', '测试项目4|test|test2', 20140605, 20140606, 23, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '这个是测试信息', NULL, 0, 0, 'ProjectMain'),
	('S20140600014', 'S', '管理设定', 'R20140600006', 'P20140600001', 'R20140600006|P20140600001|S20140600014', '测试项目7|用户管理|管理设定', 20140624, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 5, '测试帐号4', '', NULL, 0, 0, 'ProjectMain'),
	('S20140700001', 'S', 'test3', 'R20140600003', 'S20140600013', 'R20140600003|P20140600028|S20140600013|S20140700001', '测试项目4|test|test2|test3', 20140701, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 2, '测试帐号1', 'test3', NULL, 1, 0, 'ProjectMain'),
	('S20140700002', 'S', '撤销测试1.0', 'R20140600001', 'P20140700001', 'R20140600001|P20140700001|S20140700002', '测试项目1|撤销测试|撤销测试1.0', 20140704, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, 0, 'ProjectMain'),
	('S20140700003', 'S', '撤销测试1.1.2', 'R20140600001', 'S20140700002', 'R20140600001|P20140700001|S20140700002|S20140700003', '测试项目1|撤销测试|撤销测试1.0|撤销测试1.1.2', 20140704, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '', NULL, 0, 0, 'ProjectMain'),
	('S20140700004', 'S', '撤销测试000008', 'R20140600001', 'S20140700003', 'R20140600001|P20140700001|S20140700002|S20140700003|S20140700004', '测试项目1|撤销测试|撤销测试1.0|撤销测试1.1.2|撤销测试000008', 20140704, 20140731, 5, NULL, 0, NULL, 1, '胡建鸿', 13, '测试帐号12', '底层设计', NULL, 1, 3, 'ProjectMain'),
	('S20140700005', 'S', '撤销测试2.3', 'R20140600001', 'S20140700002', 'R20140600001|P20140700001|S20140700002|S20140700005', '测试项目1|撤销测试|撤销测试1.0|撤销测试2.3', 20140704, NULL, 5, NULL, 0, NULL, 1, '胡建鸿', 23, '测试帐号22', '', NULL, 0, 0, 'ProjectMain'),
	('S20140700006', 'S', '需求模块测试2', 'R20140600001', 'P20140700003', 'R20140600001|P20140700003|S20140700006', '测试项目1|需求模块测试1|需求模块测试2', 20140707, 20140730, 5, 20140707, 0, NULL, 1, '胡建鸿', 1, '胡建鸿', '需求模块测试2', NULL, 0, 1, 'ProjectMain');
/*!40000 ALTER TABLE `bonjour_project_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_project_main_history 结构
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
/*!40000 ALTER TABLE `bonjour_project_main_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_project_main_history` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_main 结构
CREATE TABLE IF NOT EXISTS `bonjour_requirement_main` (
  `requirementID` int(11) NOT NULL AUTO_INCREMENT,
  `projectCode` char(12) NOT NULL,
  `requirementName` varchar(150) NOT NULL,
  `description` text,
  `acceptanceCriteria` text,
  `dependenceID` int(11) DEFAULT NULL,
  `createDate` int(8) NOT NULL,
  `lastModifiedTime` datetime NOT NULL,
  `creatorID` int(11) NOT NULL,
  `creatorName` varchar(50) DEFAULT NULL,
  `distributorID` int(11) DEFAULT NULL,
  `distributorName` varchar(50) DEFAULT NULL,
  `reviewerID` int(11) DEFAULT NULL,
  `reviewerName` varchar(50) DEFAULT NULL,
  `closedBy` varchar(50) DEFAULT NULL,
  `priority` int(1) NOT NULL,
  `lockedStatus` int(1) DEFAULT '0',
  `flag` char(8) DEFAULT '00000000',
  `flag1` int(11) DEFAULT '0',
  `flag2` int(11) DEFAULT '0',
  `moduleName` varchar(50) DEFAULT 'RequirementMain',
  `keyword` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`requirementID`),
  KEY `ProjectCode` (`projectCode`),
  KEY `CreateDate` (`createDate`),
  KEY `CreatorID` (`creatorID`),
  KEY `DistributorID` (`distributorID`),
  KEY `ReviewerID` (`reviewerID`),
  KEY `Priority` (`priority`),
  KEY `Flag` (`flag`),
  KEY `Flag1` (`flag1`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='需求主表';

-- 正在导出表  bonjour.bonjour_requirement_main 的数据：~26 rows (大约)
/*!40000 ALTER TABLE `bonjour_requirement_main` DISABLE KEYS */;
INSERT INTO `bonjour_requirement_main` (`requirementID`, `projectCode`, `requirementName`, `description`, `acceptanceCriteria`, `dependenceID`, `createDate`, `lastModifiedTime`, `creatorID`, `creatorName`, `distributorID`, `distributorName`, `reviewerID`, `reviewerName`, `closedBy`, `priority`, `lockedStatus`, `flag`, `flag1`, `flag2`, `moduleName`, `keyword`) VALUES
	(1, 'S20140700006', '添加首页资讯功能', '添加首页资讯功能', '能按时弹出会话框', NULL, 20140707, '2014-07-07 09:23:01', 1, '胡建鸿', 1, '胡建鸿', 2, '测试帐号1', NULL, 2, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(2, 'S20140700006', 'SNS分享功能', '', '', NULL, 20140707, '2014-07-07 09:23:29', 1, '胡建鸿', 1, '胡建鸿', 2, '测试帐号1', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(3, 'P20140700003', '测试需求123123123', '测试需求123123123', '测试需求123123123', NULL, 20140707, '2014-07-09 16:55:45', 1, '胡建鸿', 2, '测试帐号1', 1, '胡建鸿', NULL, 1, 0, '00000000', 1, 0, 'RequirementMain', NULL),
	(4, 'P20140700003', '需求测试456456456', '需求测试456456456', '需求测试456456456', 3, 20140707, '2014-07-07 09:33:50', 1, '胡建鸿', 2, '测试帐号1', 1, '胡建鸿', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(5, 'P20140700003', '测试需求sdasfasfdsfasd', '测试需求sdasfasfdsfasd', '测试需求sdasfasfdsfasd', 4, 20140707, '2014-07-07 12:39:42', 1, '胡建鸿', 1, '胡建鸿', 2, '测试帐号1', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(6, 'P20140700003', '很好很强大的需求分析', '很好很强大的需求分析', '很好很强大的需求分析', NULL, 20140707, '2014-07-07 12:40:19', 1, '胡建鸿', 3, '测试帐号2', 1, '胡建鸿', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(7, 'P20140700003', '测试需求856486456121', '', '', NULL, 20140707, '2014-07-07 12:40:44', 1, '胡建鸿', 2, '测试帐号1', 1, '胡建鸿', NULL, 4, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(8, 'P20140700003', '添加管理员平台，同时增加分页查询功能', '管理平台分页实现', '有分页功能即可', 6, 20140707, '2014-07-08 15:07:57', 1, '胡建鸿', 23, '测试帐号22', 2, '测试帐号1', NULL, 2, 0, '10000000', 1, 0, 'RequirementMain', NULL),
	(9, 'P20140700003', '实现分页功能，能改变页面大小', '', '', NULL, 20140707, '2014-07-07 12:42:09', 1, '胡建鸿', 1, '胡建鸿', 1, '胡建鸿', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(10, 'P20140700003', '雅雅妈妈喊你回家食饭了 ', '晕死', '晕倒', NULL, 20140707, '2014-07-07 12:42:57', 1, '胡建鸿', 1, '胡建鸿', 23, '测试帐号22', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(11, 'P20140700003', '需求混乱大哥来帮你', '好 很好', '', NULL, 20140707, '2014-07-07 12:43:25', 1, '胡建鸿', 2, '测试帐号1', 23, '测试帐号22', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(12, 'P20140700003', '测试需求2564614231', '', '', 3, 20140707, '2014-07-07 12:46:17', 1, '胡建鸿', 1, '胡建鸿', 23, '测试帐号22', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(13, 'P20140700003', '测试需求8973478246372342', '', '', NULL, 20140707, '2014-07-07 12:46:34', 1, '胡建鸿', 2, '测试帐号1', 2, '测试帐号1', NULL, 5, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(14, 'P20140700003', '测试需求654416541231321', '', '', NULL, 20140707, '2014-07-07 12:46:43', 1, '胡建鸿', 0, NULL, 0, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(15, 'P20140700003', '测试需求654416541231321', '', '', NULL, 20140707, '2014-07-07 12:46:53', 1, '胡建鸿', 0, NULL, 0, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(16, 'P20140700003', '测试需求454654', '', '', NULL, 20140707, '2014-07-07 12:47:06', 1, '胡建鸿', 1, '胡建鸿', 2, '测试帐号1', NULL, 3, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(17, 'P20140700003', '测试需求001', '', '', NULL, 20140707, '2014-07-07 12:47:43', 1, '胡建鸿', 0, NULL, 0, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(18, 'P20140700003', '测试需求001', '', '', NULL, 20140707, '2014-07-07 12:48:23', 1, '胡建鸿', 0, NULL, 0, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(19, 'P20140700003', '测试需求001', '', '', NULL, 20140707, '2014-07-07 12:53:02', 1, '胡建鸿', NULL, NULL, NULL, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(20, 'P20140700003', '测试需求12324343', '', '', NULL, 20140707, '2014-07-07 12:53:37', 1, '胡建鸿', 1, '胡建鸿', NULL, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(21, 'P20140700003', '测试需求36889', '', '', NULL, 20140707, '2014-07-07 12:53:54', 1, '胡建鸿', NULL, NULL, 23, '测试帐号22', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(22, 'P20140700003', '测试需求7867857', '', '', 6, 20140707, '2014-07-07 12:54:12', 1, '胡建鸿', NULL, NULL, NULL, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(23, 'P20140700003', '测试需求565sdfdsf', '', '', NULL, 20140707, '2014-07-07 12:54:47', 1, '胡建鸿', NULL, NULL, NULL, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(24, 'P20140700003', '测试需求99999999', '', '', NULL, 20140707, '2014-07-07 12:54:59', 1, '胡建鸿', 1, '胡建鸿', 1, '胡建鸿', NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(25, 'P20140700003', '测试需求abcdefg', '', '', 5, 20140707, '2014-07-07 12:55:22', 1, '胡建鸿', 1, '胡建鸿', NULL, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL),
	(26, 'R20140600001', '简单需求演示', '', '', NULL, 20140708, '2014-07-08 14:55:54', 1, '胡建鸿', NULL, NULL, NULL, NULL, NULL, 1, 0, '00000000', 0, 0, 'RequirementMain', NULL);
/*!40000 ALTER TABLE `bonjour_requirement_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_main_history 结构
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
/*!40000 ALTER TABLE `bonjour_requirement_main_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_requirement_main_history` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_review 结构
CREATE TABLE IF NOT EXISTS `bonjour_requirement_review` (
  `applicationID` int(11) NOT NULL AUTO_INCREMENT,
  `requirementID` int(11) NOT NULL,
  `applicantID` int(11) NOT NULL,
  `applicantName` varchar(50) DEFAULT NULL,
  `applicantRemark` text,
  `reviewerID` int(11) NOT NULL,
  `reviewerName` varchar(50) DEFAULT NULL,
  `reviewType` char(1) NOT NULL,
  `reviewComment` text,
  `createTime` datetime NOT NULL,
  `lastModifiedTime` datetime DEFAULT NULL,
  `feedbackTime` datetime DEFAULT NULL,
  `lockedStatus` int(1) NOT NULL DEFAULT '0',
  `flag` char(8) DEFAULT '00000000',
  PRIMARY KEY (`applicationID`),
  KEY `RequirementID` (`requirementID`),
  KEY `ApplicantID` (`applicantID`),
  KEY `ReviewerID` (`reviewerID`),
  KEY `CreateTime` (`createTime`),
  KEY `Flag` (`flag`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='需求评审表';

-- 正在导出表  bonjour.bonjour_requirement_review 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `bonjour_requirement_review` DISABLE KEYS */;
INSERT INTO `bonjour_requirement_review` (`applicationID`, `requirementID`, `applicantID`, `applicantName`, `applicantRemark`, `reviewerID`, `reviewerName`, `reviewType`, `reviewComment`, `createTime`, `lastModifiedTime`, `feedbackTime`, `lockedStatus`, `flag`) VALUES
	(5, 8, 1, '胡建鸿', NULL, 2, '测试帐号1', '1', NULL, '2014-07-08 17:28:58', '2014-07-08 17:28:58', NULL, 0, '00000000'),
	(6, 3, 1, '胡建鸿', NULL, 1, '胡建鸿', '1', NULL, '2014-07-09 16:55:48', '2014-07-09 16:55:48', NULL, 0, '00000000');
/*!40000 ALTER TABLE `bonjour_requirement_review` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_role 结构
CREATE TABLE IF NOT EXISTS `bonjour_role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(50) NOT NULL,
  `createDate` int(8) NOT NULL,
  `creatorID` int(11) NOT NULL,
  `creatorName` varchar(50) DEFAULT NULL,
  `validStatus` tinyint(1) DEFAULT '1',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_role 的数据：~9 rows (大约)
/*!40000 ALTER TABLE `bonjour_role` DISABLE KEYS */;
INSERT INTO `bonjour_role` (`roleID`, `roleName`, `createDate`, `creatorID`, `creatorName`, `validStatus`, `remark`) VALUES
	(1, '超级管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(2, '项目管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(3, '需求管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(4, '任务管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(5, '测试管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(6, '系统管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(7, '临时管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(8, '文档管理员', 20140531, 1, '胡建鸿', 1, NULL),
	(9, '普通用户', 20140531, 1, '胡建鸿', 1, NULL);
/*!40000 ALTER TABLE `bonjour_role` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_session 结构
CREATE TABLE IF NOT EXISTS `bonjour_session` (
  `id` char(32) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- 正在导出表  bonjour.bonjour_session 的数据：1 rows
/*!40000 ALTER TABLE `bonjour_session` DISABLE KEYS */;
INSERT INTO `bonjour_session` (`id`, `modified`, `lifetime`, `data`) VALUES
	('7rfrlpasju37cqpaie01ci26h3', 1406872081, 1800, 'Bonjour_Auth|a:1:{s:11:"currentUser";O:8:"stdClass":4:{s:6:"userID";s:1:"1";s:8:"userName";s:9:"胡建鸿";s:6:"roleID";s:1:"1";s:8:"roleName";s:15:"超级管理员";}}');
/*!40000 ALTER TABLE `bonjour_session` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_status 结构
CREATE TABLE IF NOT EXISTS `bonjour_status` (
  `entityName` varchar(20) NOT NULL,
  `statusCNName` varchar(30) NOT NULL,
  `statusENName` varchar(50) NOT NULL,
  `statusValue` int(11) NOT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`statusENName`),
  KEY `EntityName` (`entityName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_status 的数据：~13 rows (大约)
/*!40000 ALTER TABLE `bonjour_status` DISABLE KEYS */;
INSERT INTO `bonjour_status` (`entityName`, `statusCNName`, `statusENName`, `statusValue`, `remark`) VALUES
	('PROJECT', '取消关闭', 'PROJECT_CANCELED', 3, NULL),
	('PROJECT', '正常关闭', 'PROJECT_CLOSED', 2, NULL),
	('PROJECT', '初始化', 'PROJECT_INITIALIZED', 0, NULL),
	('PROJECT', '已启动', 'PROJECT_STARTED', 1, NULL),
	('REQUIREMENT', '通过验收', 'REQUIREMENT_CHECKED', 7, NULL),
	('REQUIREMENT', '验收退回', 'REQUIREMENT_CHECK_RETURNED', 6, NULL),
	('REQUIREMENT', '提交验收', 'REQUIREMENT_CHECK_SUBMITTED', 5, NULL),
	('REQUIREMENT', '已关闭', 'REQUIREMENT_CLOSED', 8, NULL),
	('REQUIREMENT', '初始化', 'REQUIREMENT_INITIALIZED', 0, NULL),
	('REQUIREMENT', '已立项', 'REQUIREMENT_PROJECT_APPROVED', 4, NULL),
	('REQUIREMENT', '通过审核', 'REQUIREMENT_VERIFIED', 3, NULL),
	('REQUIREMENT', '提交审核', 'REQUIREMENT_VERIFY_SUBMITTED', 1, NULL),
	('REQUIREMENT', '审核退回', 'REQUIREMENT_VERYFY_RETURNED', 2, NULL);
/*!40000 ALTER TABLE `bonjour_status` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_task_main 结构
CREATE TABLE IF NOT EXISTS `bonjour_task_main` (
  `taskID` int(11) NOT NULL AUTO_INCREMENT,
  `taskName` varchar(150) DEFAULT NULL,
  `requirementID` int(11) NOT NULL,
  `dependenceID` int(11) DEFAULT NULL,
  `creatorID` int(11) NOT NULL,
  `creatorName` varchar(50) DEFAULT NULL,
  `createTime` datetime NOT NULL,
  `handlerID` int(11) NOT NULL,
  `handlerName` varchar(50) DEFAULT NULL,
  `estimateStartDate` int(8) DEFAULT NULL,
  `estimateEndDate` int(8) DEFAULT NULL,
  `estimateHour` int(11) DEFAULT NULL,
  `realStartDate` int(8) DEFAULT NULL,
  `realEndDate` int(8) DEFAULT NULL,
  `lastModifiedTime` datetime DEFAULT NULL,
  `priority` int(1) NOT NULL,
  `lockedStatus` int(1) DEFAULT '0',
  `flag` char(8) DEFAULT '00000000',
  `keyword` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`taskID`),
  KEY `RequirementID` (`requirementID`),
  KEY `CreatorID` (`creatorID`),
  KEY `HandlerID` (`handlerID`),
  KEY `Priority` (`priority`),
  KEY `Flag` (`flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务主表';

-- 正在导出表  bonjour.bonjour_task_main 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bonjour_task_main` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_task_main` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_task_schedule 结构
CREATE TABLE IF NOT EXISTS `bonjour_task_schedule` (
  `taskID` int(11) DEFAULT NULL,
  `startDate` int(11) DEFAULT NULL,
  `endDate` int(11) DEFAULT NULL,
  `startHour` int(11) DEFAULT NULL,
  `endHour` int(11) DEFAULT NULL,
  `startMinute` int(11) DEFAULT NULL,
  `endMinute` int(11) DEFAULT NULL,
  `createTime` int(11) DEFAULT NULL,
  `remark` int(11) DEFAULT NULL,
  `itemType` int(11) DEFAULT NULL,
  `calExhausted` int(11) DEFAULT NULL,
  `realExhausted` int(11) DEFAULT NULL,
  `codeAmount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='任务进度监控表';

-- 正在导出表  bonjour.bonjour_task_schedule 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bonjour_task_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_task_schedule` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_team 结构
CREATE TABLE IF NOT EXISTS `bonjour_team` (
  `teamID` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(50) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `responsibleID` int(11) DEFAULT NULL,
  `responsibleName` varchar(50) DEFAULT NULL,
  `creatorID` int(11) NOT NULL,
  `creatorName` varchar(50) DEFAULT NULL,
  `createTime` datetime NOT NULL,
  `validStatus` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`teamID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_team 的数据：~2 rows (大约)
/*!40000 ALTER TABLE `bonjour_team` DISABLE KEYS */;
INSERT INTO `bonjour_team` (`teamID`, `teamName`, `Description`, `responsibleID`, `responsibleName`, `creatorID`, `creatorName`, `createTime`, `validStatus`) VALUES
	(1, 'test1', 'test1', 2, '测试帐号1', 1, '胡建鸿', '2014-07-26 21:55:33', 0),
	(2, '美美团购网项目团队', '团购门户设计开发维护团队', 1, '胡建鸿', 1, '胡建鸿', '2014-07-26 21:55:46', 1);
/*!40000 ALTER TABLE `bonjour_team` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_team_member 结构
CREATE TABLE IF NOT EXISTS `bonjour_team_member` (
  `teamID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `roleDesc` varchar(50) DEFAULT NULL,
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`teamID`,`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_team_member 的数据：~17 rows (大约)
/*!40000 ALTER TABLE `bonjour_team_member` DISABLE KEYS */;
INSERT INTO `bonjour_team_member` (`teamID`, `userID`, `userName`, `roleDesc`, `createTime`) VALUES
	(1, 1, '胡建鸿', '项目总监', '2014-07-26 23:32:07'),
	(1, 3, '测试帐号2', '需求设计', '2014-07-26 23:41:21'),
	(1, 6, '测试帐号5', '开发人员', '2014-07-26 23:44:21'),
	(1, 24, '测试帐号23', '开发人员', '2014-07-26 23:33:04'),
	(1, 30, '王小丫', '开发人员', '2014-07-26 23:42:43'),
	(1, 31, '王宝强', '开发人员', '2014-07-26 23:45:58'),
	(2, 1, '胡建鸿', '项目负责人', '2014-07-27 11:13:16'),
	(2, 5, '测试帐号4', '测试专员', '2014-07-28 08:45:08'),
	(2, 6, '测试帐号5', '需求分析师', '2014-07-27 11:14:24'),
	(2, 9, '测试帐号8', '文档管理', '2014-07-27 14:55:55'),
	(2, 10, '测试帐号9', '需求分析师', '2014-07-27 11:14:14'),
	(2, 12, '测试帐号11', '开发人员1', '2014-07-27 11:15:09'),
	(2, 13, '测试帐号12', '项目评估分析员', '2014-07-27 11:14:58'),
	(2, 14, '测试帐号13', '测试员1', '2014-07-27 11:15:32'),
	(2, 23, '测试帐号22', '开发人员2', '2014-07-27 11:15:19'),
	(2, 30, '王小丫', '销售分析师', '2014-07-27 11:16:34'),
	(2, 31, '王宝强', '集成测试员1', '2014-07-27 11:15:46');
/*!40000 ALTER TABLE `bonjour_team_member` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_user 结构
CREATE TABLE IF NOT EXISTS `bonjour_user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `accountName` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPass` char(32) DEFAULT NULL,
  `roleID` int(11) unsigned NOT NULL DEFAULT '0',
  `Email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `createDate` int(8) NOT NULL,
  `creatorID` int(8) NOT NULL,
  `creatorName` varchar(50) DEFAULT NULL,
  `loginTimes` int(11) DEFAULT '0',
  `lastLogin` datetime DEFAULT NULL,
  `validStatus` int(11) DEFAULT '1',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `AccountName` (`accountName`),
  KEY `RoleID` (`roleID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_user 的数据：~31 rows (大约)
/*!40000 ALTER TABLE `bonjour_user` DISABLE KEYS */;
INSERT INTO `bonjour_user` (`userID`, `accountName`, `userName`, `userPass`, `roleID`, `Email`, `mobile`, `phoneNumber`, `createDate`, `creatorID`, `creatorName`, `loginTimes`, `lastLogin`, `validStatus`) VALUES
	(1, 'hujianhong', '胡建鸿', '1d42abef5a4a5748edf45448bc8d64c5', 1, 'sammy19871116@gmail.com', NULL, NULL, 20140531, 1, '胡建鸿', 24, '2014-08-01 13:47:58', 1),
	(2, 'test1', '测试帐号1', '1d42abef5a4a5748edf45448bc8d64c5', 3, '', '', '', 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(3, 'test2', '测试帐号2', '1d42abef5a4a5748edf45448bc8d64c5', 3, '', '15058430233', '057456867933', 20140531, 1, '胡建鸿', 1, '2014-07-17 09:57:34', 1),
	(4, 'test3', '测试帐号3', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(5, 'test4', '测试帐号4', '1d42abef5a4a5748edf45448bc8d64c5', 5, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(6, 'test5', '测试帐号5', '1d42abef5a4a5748edf45448bc8d64c5', 9, '', '', '', 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(7, 'test6', '测试帐号6', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(8, 'test7', '测试帐号7', '1d42abef5a4a5748edf45448bc8d64c5', 6, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(9, 'test8', '测试帐号8', '1d42abef5a4a5748edf45448bc8d64c5', 8, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(10, 'test9', '测试帐号9', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(11, 'test10', '测试帐号10', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(12, 'test11', '测试帐号11', '1d42abef5a4a5748edf45448bc8d64c5', 5, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(13, 'test12', '测试帐号12', '1d42abef5a4a5748edf45448bc8d64c5', 7, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(14, 'test13', '测试帐号13', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(15, 'test14', '测试帐号14', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(16, 'test15', '测试帐号15', '1d42abef5a4a5748edf45448bc8d64c5', 4, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(17, 'test16', '测试帐号16', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 0),
	(18, 'test17', '测试帐号17', '1d42abef5a4a5748edf45448bc8d64c5', 6, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(19, 'test18', '测试帐号18', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(20, 'test19', '测试帐号19', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(21, 'test20', '测试帐号20', '1d42abef5a4a5748edf45448bc8d64c5', 3, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(22, 'test21', '测试帐号21', '1d42abef5a4a5748edf45448bc8d64c5', 3, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(23, 'test22', '测试帐号22', '1d42abef5a4a5748edf45448bc8d64c5', 2, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(24, 'test23', '测试帐号23', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 1),
	(25, 'test24', '测试帐号24', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 0),
	(26, 'test25', '测试帐号25', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 0),
	(27, 'test26', '测试帐号26', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 0),
	(28, 'test27', '测试帐号27', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 0),
	(29, 'test28', '测试帐号28', '1d42abef5a4a5748edf45448bc8d64c5', 9, NULL, NULL, NULL, 20140531, 1, '胡建鸿', 0, '0000-00-00 00:00:00', 0),
	(30, 'wangxiaoya', '王小丫', 'e10adc3949ba59abbe56e057f20f883e', 7, 'wangxiaoya@sina.com.cn', '13695666088', '', 20140719, 1, '胡建鸿', 0, NULL, 1),
	(31, 'wangbaoqiang01', '王宝强', 'e10adc3949ba59abbe56e057f20f883e', 5, '', '', '', 20140719, 1, '胡建鸿', 0, NULL, 1);
/*!40000 ALTER TABLE `bonjour_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
