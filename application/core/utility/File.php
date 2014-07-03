<?php

/**
 * 文件操作函数
 * @author hujianhong05
 *
 */
class Bonjour_Core_Utility_File {
	
	/**
	 * Create sub-directories of given directory
	 * 
	 * @param string $root Path to root directory
	 * @param string $path Relative path to new created directory in format a/b/c (on Linux) 
	 * or a\b\c (on Windows)
	 */
	public static function createDirs($path) 
	{
		$config=Bonjour_Core_Config::getConfig();
		$root=$config->ftp->directory;
		$root = rtrim($root, DS);
		$subDirs = explode(DS, $path);
		if ($subDirs == null) {
			return;
		}
		$currDir = $root;
		foreach ($subDirs as $dir) {
			$currDir = $currDir.DS.$dir;
			if (!file_exists($currDir)) {
				mkdir($currDir);
			}
		}	
		return $currDir; 
	}
	
}

?>