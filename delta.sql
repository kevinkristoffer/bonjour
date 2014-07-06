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
	(10, 2, 4, '项目全景图', 'project/main', 2, 1, 1),
	(11, 2, 4, '项目高级搜索', '', 3, 1, 1),
	(12, 2, 4, '文档管理', NULL, 4, 1, 1),
	(13, 2, 4, '版本管理', NULL, 5, 1, 1),
	(14, 2, 4, '计划项目', '', 6, 1, 1),
	(15, 2, 0, '我的地盘', '', 5, 1, 1),
	(16, 2, 4, '项目树', '', 1, 1, 1),
	(17, 2, 7, '经营单位满期赔付率', NULL, 1, 1, 0),
	(18, 2, 7, '车型满期赔付率', NULL, 2, 1, 0),
	(19, 2, 7, '经营单位简单赔付率', NULL, 3, 1, 0),
	(20, 2, 7, '车型简单赔付率', NULL, 4, 1, 0),
	(21, 2, 7, '单店保费/赔付占比图', NULL, 5, 1, 0),
	(22, 2, 7, '车型保费/赔付占比图', NULL, 6, 1, 0),
	(23, 2, 7, '高级查询', NULL, 7, 1, 0),
	(24, 2, 0, '续保数据管理', NULL, 0, 1, 0);
/*!40000 ALTER TABLE `bonjour_forum` ENABLE KEYS */;


-- 导出  表 bonjour.bonjour_requirement_main 结构
DROP TABLE IF EXISTS `bonjour_requirement_main`;
CREATE TABLE IF NOT EXISTS `bonjour_requirement_main` (
  `RequirementID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectCode` char(12) NOT NULL,
  `RequirementName` varchar(150) NOT NULL,
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
  `LockedStatus` int(1) DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='需求主表';

-- 正在导出表  bonjour.bonjour_requirement_main 的数据：~0 rows (大约)
DELETE FROM `bonjour_requirement_main`;
/*!40000 ALTER TABLE `bonjour_requirement_main` DISABLE KEYS */;
INSERT INTO `bonjour_requirement_main` (`RequirementID`, `ProjectCode`, `RequirementName`, `Description`, `AcceptanceCriteria`, `DependenceID`, `CreateDate`, `LastModifiedTime`, `CreatorID`, `CreatorName`, `DistributorID`, `DistributorName`, `ReviewerID`, `ReviewerName`, `ClosedBy`, `Priority`, `LockedStatus`, `Flag`, `Keyword`) VALUES
	(1, 'P20140700005', '为主页添加SNS分享弹出功能', '很好很强大', '', NULL, 20140706, '2014-07-06 22:32:41', 1, '胡建鸿', 1, '胡建鸿', 2, '测试帐号1', NULL, 3, 0, '00000000', NULL);
/*!40000 ALTER TABLE `bonjour_requirement_main` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
