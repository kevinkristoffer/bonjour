<?php 
return array (
  'db' => 
  array (
    'prefix' => 'bonjour_',
    'adapter' => 'PDO_MYSQL',
    'master' => 
    array (
      'server1' => 
      array (
        'host' => '192.168.1.104',
        'username' => 'root',
        'password' => '616703255',
        'dbname' => 'bonjour',
        'persistent' => '1',
      ),
    ),
    'slave' => 
    array (
      'server1' => 
      array (
        'host' => '192.168.1.106',
        'username' => 'root',
        'password' => '616703255',
        'dbname' => 'bonjour',
        'persistent' => '1',
      ),
      'server2' => 
      array (
        'host' => '192.168.1.107',
        'username' => 'root',
        'password' => '616703255',
        'dbname' => 'bonjour',
        'persistent' => '1',
      ),
    ),
  ),
);