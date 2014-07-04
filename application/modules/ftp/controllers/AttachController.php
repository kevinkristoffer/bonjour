<?php

class Ftp_AttachController extends Bonjour_Controller_Base{
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		parent::init();		//初始化session
	}
	/**
	 * 下载文件
	 */
	public function downloadAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$zip=null;
		$zip_flag=false;
		try{
			$fileList=$this->_request->getParam('fl');
			if(!isset($fileList)) throw new Exception();
			
			//初始化数据库
			$factory=Bonjour_Core_Model_Factory::getInstance();
			$db=Bonjour_Core_Db_Connection::getConnection('master');
			if($db == null){
				throw new Exception();
			}
			$factory->setDbAdapter($db);
			$factory->registGateway('Attach');
			
			//获取系统临时目录
			$config=Bonjour_Core_Config::getConfig();
			$tmpdir=$config->ftp->tmpdir;
			//命名文件名
			$userID=0;
			$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
			if(isset($authNamespace->currentUser)){
				$userID=$authNamespace->currentUser['userID'];
			}
			$zipName=md5($userID.rand(1,99999).time()).'.zip';//防止重名
			//初始化zipachieve
			$zip=new ZipArchive();
			if($zip->open($tmpdir.DS.$zipName,ZipArchive::OVERWRITE) !== TRUE)
				throw new Exception();
			$zip_flag=true;	//确保最后关闭压缩程序
			$zip->addEmptyDir('');
			
			//遍历压缩
			$fileArray=explode(';',$fileList);
			for($i=0; $i<count($fileArray); $i++){
				if(!preg_match('/^[0-9]{15}$/',$fileArray[$i])) continue;
				$attachment=$factory->__gateway('Attach')->queryAttachDetail($fileArray[$i]);
				if($attachment == null) continue;
				if(!file_exists($attachment->realPath)) continue;
				$zip->addFile($attachment->realPath);
				$zip->renameIndex($i, $attachment->fileName);
				//更新下载次数
				$attachment=$factory->__gateway('Attach')->increaseDownloadTimes($fileArray[$i]);
			}
			$zip->close();
			
			//打开文件
			$file = fopen($tmpdir.DS.$zipName,"r");
			$fileSize=filesize($tmpdir.DS.$zipName);
			//输入文件标签
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ".$fileSize);
			Header("Content-Disposition: attachment; filename=" . $zipName);
			//缓存大小
			$buffer=1024;
			$file_count=0;
			//向浏览器返回数据
			while(!feof($file) && $file_count<$fileSize){
				$file_con=fread($file,$buffer);
				$file_count+=$buffer;
				echo $file_con;
			}
			fclose($file);
			exit();
		}catch(Exception $e){
			if($zip!=null && $zip_flag)
				$zip->close();
			header ( 'content-type:text/html;charset=utf-8' );
			echo '下载失败';
		}
		
		/**/
	}
}

?>