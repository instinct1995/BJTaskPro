<?php
namespace application\core;

use application\core\View;

abstract class Controller 
{

	public $view;
	public $route;

	public function __construct( $route ) 
	{
		$this->view = new View( $route );
		$this->route = $route;
	}
	
	public function loadModel(  $controller, $name ) 
	{
		$path = 'application\models\\' . $controller . '\\' . ucfirst( $name ) . 'Model';
		if ( class_exists( $path ) ) {
			return new $path;
		}
		echo "Не найдена модель ".$path;
	} 

}
