<?php

namespace application\controllers;

use application\core\Controller;
use application\core\Router;

class SiteController extends Controller 
{
	public $model;
	public $route;

	public function __construct( $route ) 
	{
		parent::__construct( $route );
		$this->model = $this->loadModel( 'site', 'login' );
	}	

	function actionIndex() 
	{	
		if (isset($_SESSION['referer'])) {
		 	unset( $_SESSION['referer'] );
		} 	
		$this->view->render( 'Описание задания');
	}

	
	function actionLogin() 
	{
		if(!isset($_SESSION['currentSetting'])) {
        	return header('Location: /');
        }
		$error = false;
		if (!isset($_SESSION['referer'])) {
			$_SESSION['referer'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] :  '/';
		}

		if( isset($_POST['login'] ) && isset( $_POST['password']) ) {	
			$result = $this->model->submit();

			if ( $result ) {
		    	$_SESSION['status'] = 10;
		    	$url = $_SESSION['referer'];
		    	unset( $_SESSION['referer'] );
		 		return header("Location: $url");
			}
		$error = true;	
		}
		$url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] :  '/';
	 	$result = [];
	 	$this->view->render( $error,$result );
	}	

	function actionLogout() 
	{
		$url = $_SERVER['HTTP_REFERER'];
    	unset( $_SESSION['status'] );
    	setCurrentSetting([ 'status' => STATUS_TOPICAL ]);
 		header("Location: $url");
	}	

	function actionSetting() 
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			setCurrentSetting([ 'page' 	 => $_POST['page'],
								'order'  => $_POST['order'], 
								'field'  => $_POST['field'], 
								'limit'  => $_POST['limit'], 
								'status' => $_POST['status'] 
							]);
		}
	}	

}

