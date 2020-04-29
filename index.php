<?php
session_start();
require 'application/lib/current_setting.php';
require 'application/config/settings.php';
use application\core\Router;
spl_autoload_register(function($class) {
	$path = str_replace('\\', '/', $class.'.php');
	if (file_exists($path)) {
		require_once $path;
	} else {
		echo 'Не найден класс '.$class;
	}
});
$router =  new Router;
$router->run();
