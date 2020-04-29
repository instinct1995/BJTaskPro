<?php

namespace application\core;

use application\core\View;

class Router 
{
	
  protected $routes = [];
	protected $params = [];

 	public function __construct() 
    {
 		$arr = require 'application/config/routes.php';
 		foreach ( $arr as $key => $value ) {
 			$this->add( $key, $value );
 		}
    } 

   	public function add( $route, $params ) 
    {
   		$route = '#^'.$route.'$#';
   		$this->routes[$route] = $params;
   	}

   	public function match()
    {
   		$url = trim($_SERVER['REQUEST_URI'], '/');
   		foreach ( $this->routes as $route => $params ) {
   			if ( preg_match( $route, $url, $matches) ) {
  				$this->params = $params;
  				if( isset( $matches[1]) ) {
  					$this->params['params'] = $matches[1]; 
  				}
   	            return true;
   			}  
   		}
   	    return false;
   	}

   	public function run() 
    {
   		if ( $this->match() ) {
   			$path = 'application\controllers\\' . ucfirst( $this->params['controller'] ) . 'Controller';
   			$action = 'action'.ucfirst( $this->params[ 'action' ] );
   			if( class_exists( $path ) ) {
   				$action = 'action' . ucfirst( $this->params[ 'action' ] );
   				if( method_exists( $path, $action ) ) {
   					$controller = new $path( $this->params );
   					$controller->$action();
   				} else {
                    echo 'Нет метода ' . $action . ' в контроллере application/controllers/' . $path . '.php';
   				}
   			} else {
                echo 'Нет контроллера ' . 'application/controllers/' . $path . '.php';
   			}
   		} else {
    		View::errorCode( 404 );
    	}
   	}

}	