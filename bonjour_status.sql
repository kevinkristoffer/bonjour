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

-- 导出  表 bonjour.bonjour_status 结构
CREATE TABLE IF NOT EXISTS `bonjour_status` (
  `EntityName` varchar(20) NOT NULL,
  `StatusCNName` varchar(30) NOT NULL,
  `StatusENName` varchar(50) NOT NULL,
  `StatusValue` int(11) NOT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`StatusENName`),
  KEY `EntityName` (`EntityName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 正在导出表  bonjour.bonjour_status 的数据：~13 rows (大约)
/*!40000 ALTER TABLE `bonjour_status` DISABLE KEYS */;
INSERT INTO `bonjour_status` (`EntityName`, `StatusCNName`, `StatusENName`, `StatusValue`, `Remark`) VALUES
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
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
