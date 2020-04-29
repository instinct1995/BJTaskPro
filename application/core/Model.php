<?php

namespace application\core;

use application\config\Db;

abstract class Model {

	public $db;
	
	public function __construct() {
		$this->db = Db::getInstance();	
	}
}
