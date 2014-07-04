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

-- 导出  表 bonjour.bonjour_attachment 结构
DROP TABLE IF EXISTS `bonjour_attachment`;
CREATE TABLE IF NOT EXISTS `bonjour_attachment` (
  `AttachmentID` char(15) NOT NULL,
  `ModuleName` varchar(50) NOT NULL,
  `ModuleCode` varchar(50) DEFAULT NULL,
  `ModuleID` int(11) DEFAULT NULL,
  `RealPath` varchar(200) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FileSize` varchar(50) NOT NULL,
  `DownloadTimes` int(11) DEFAULT '0',
  `CreateTime` char(19) NOT NULL,
  PRIMARY KEY (`AttachmentID`),
  KEY `ModuleName` (`ModuleName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_attachment 的数据：~0 rows (大约)
DELETE FROM `bonjour_attachment`;
/*!40000 ALTER TABLE `bonjour_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonjour_attachment` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
