<?php

namespace application\core;

class View 
{
	public $path;
	public $layout = 'default';
	public $route;
	public $_view;
	public $_path;
	
	public function __construct( $route ) 
	{
		$this->route = $route;
		$this->path = $route['controller'] . '/' . $route['action'];  
	}

	public function render( $title , $vars = [] ) 
	{
        if ( !$this->_path ) {
			if ( !$this->_view ) {
				$viev_path = $this->path . '.php';
			} else {
				$viev_path = $this->route['controller'] . '/' . $this->_view . '.php';
			}
		} else {
			$viev_path = $this->_path .'.php';
		}		
		if ( file_exists('application/views/' . $viev_path) ) {
			ob_start();
			require 'application/views/' . $viev_path;

			$content = ob_get_clean();	
			require_once  'application/views/layouts/' . $this->layout . '.php';
		} else {
			echo 'Нет вьюхи ' . 'application/views/' . $this->path . '.php';
		}	
	} 

	public function renderAjax( $title , $vars = [], $path = 'tasks/index' ) 
	{
        $viev_path = $path .'.php';
        $data = [];
		if ( file_exists('application/views/' . $viev_path) ) {

			ob_start();
			require 'application/views/' . $viev_path;
			$content = ob_get_clean();	

			ob_start();							
			require  'application/views/layouts/pagination.php';
			$pagination = ob_get_clean();

			$data['count'] = $vars['count']; 
			$data['table'] = $content; 
			$data['pagination'] = $pagination; 

		  	header('Content-type: application/json');
			echo json_encode( $data ); 
		} else {
			echo 'Нет вьюхи111 ' . 'application/views/' . $this->path . '.php';
		}	
	} 

	public static function  errorCode( $code ) 
	{
		http_response_code( $code );
		require 'application/views/errors/page' . $code . '.php';
		exit;

	}
}
