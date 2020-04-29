<?php

namespace application\config;

use mysqli;

class Db 
{

	private static $_instance = null;
	private function __construct () {}
	private function __clone () {}
	private function __wakeup () {}

	public static function getInstance() 
	{
		if (self::$_instance === null) {
			$arr = require 'application/config/db_config.php';
			self::$_instance = new mysqli( $arr['host'], $arr['username'], $arr['password'], $arr['database'] );
			if (self::$_instance->connect_error) {
				printf('Ошибка : ('. $this->$this->_instance->connect_errno .') '. $this->$this->_instance->connect_error);
			 	exit;
			}
			self::$_instance->set_charset( "utf8" );
		}
		return self::$_instance;
	}

}
	
