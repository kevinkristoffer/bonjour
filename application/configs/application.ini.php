<?php 
return array (
  'phpSettings' => 
  array (
    'display_startup_errors' => '0',
    'display_errors' => '0',
  ),
  'includePaths' => 
  array (
    'library' => 'D:\\www\\bonjour\\application/../library',
  ),
  'bootstrap' => 
  array (
    'path' => 'D:\\www\\bonjour\\application/Bootstrap.php',
    'class' => 'Bootstrap',
  ),
  'appnamespace' => 'Application_',
  'resources' => 
  array (
    'frontController' => 
    array (
      'defaultModule' => 'default',
      'baseUrl' => '/bonjour',
      'moduleDirectory' => 'D:\\www\\bonjour\\application/modules',
      'moduleControllerDirectoryName' => 'controllers',
      'params' => 
      array (
        'displayExceptions' => '1',
        'noViewRenderer' => '0',
        'noErrorHandler' => '0',
        'prefixDefaultModule' => '',
      ),
    ),
  ),
  'ftp' => 
  array (
    'directory' => 'D:\\myfiles',
    'tmpdir' => 'D:\\myfiles\\tmp',
  ),
);