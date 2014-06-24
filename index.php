<?php

define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . DS . 'application'));

// Define application environment
// Switch to production
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Include class path
$paths = array(realpath(APPLICATION_PATH . '/../library'));
if (function_exists('zend_deployment_library_path') && zend_deployment_library_path('Zend Framework 1')) {
        $paths[] = zend_deployment_library_path('Zend Framework 1');
}
$paths[] = get_include_path();
set_include_path(implode(PATH_SEPARATOR, $paths));

// Zend_Application
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()->run();