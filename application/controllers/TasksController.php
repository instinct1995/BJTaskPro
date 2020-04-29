<?php

namespace application\controllers;

use application\core\Controller;
use application\core\Router;

class TasksController extends Controller 
{
	public $model;
	public $route;

	public function __construct( $route ) 
	{
		parent::__construct( $route );
		$this->model = $this->loadModel( 'tasks', 'tasks' );
	}	
	
	function actionIndex() 
	{	
		if (isset($_SESSION['referer'])) {
		 	unset( $_SESSION['referer'] );
		} 	
        if(!isset($_SESSION['currentSetting'])) {
        	return header('Location: /');
        }
		if ( !isset($_SESSION['status'] ) && 
		   ( $_SESSION['currentSetting']['status'] == STATUS_REJECTED || 
		   	 $_SESSION['currentSetting']['status'] == STATUS_PERFORMED || 
		   	 $_SESSION['currentSetting']['status'] == STATUS_ALL ) ) {
			setCurrentSetting(['status' =>  STATUS_TOPICAL] );
		} 
		$result = $this->model->getTasks($_SESSION['currentSetting']);
	    $this->emptyTasks($result['count']);
		$this->view->data = $result;
		$this->view->render( 'Задачи', $result );
	}

	function actionPage() 
	{
		if ( isset($_POST) ) {
			$page = $_POST['page'];
			setCurrentSetting(['page' => $page]);
			$result = $this->model->getTasks( $_SESSION['currentSetting'] );
			$this->view->data = $result;
			$this->view->renderAjax( '', $result );
		}
	}

	function actionOrder() 
	{
		if ( isset($_POST['field']) ) {
			$field = $_POST['field'];
			$this->orderAll( $field );
			$result = $this->model->getTasks( $_SESSION['currentSetting'] );
			$this->view->data = $result;
			$this->view->renderAjax('',$result );
		}	
	}	

	function actionLimit() 
	{
		if ( isset($_POST['limit']) ) {
			setCurrentSetting(['limit' => $_POST['limit'],'page' => 1 ]);
			$result = $this->model->getTasks( $_SESSION['currentSetting'] );
			$this->view->data = $result;
			$this->view->renderAjax('', $result );
		}
	}	

	function actionFilter() 
	{
		if ( isset($_POST['type_tasks']) ) {
			setCurrentSetting(['status' => $_POST['type_tasks'],'page' => 1]);
			$result = $this->model->getTasks( $_SESSION['currentSetting'] );
	    	$this->emptyTasks($result['count']);
			$this->view->data = $result;
			$this->view->renderAjax('', $result );
		}
	}	

	function actionCreate() 
	{
		if ( isset($_POST['username'] ) && isset( $_POST['email'] ) && isset( $_POST['task_name'] ) ) {	
			if (isset( $_POST['type_tasks'] )) {
				$type_tasks = $_POST['type_tasks'];
			}
			$params = [	'username' 	 => $_POST['username'],
						'email' 	 => $_POST['email'],
						'task_name'	 => $_POST['task_name']
				 	  ];
			$result = $this->model->submit($params);
			if ($result) {
				setCurrentSetting([ 'status' => STATUS_TOPICAL, 
								    'page'   => 1,
								    'order'  => 'DESC', 
								    'field'  => 'id'
								 ]);
				$result = $this->model->getTasks( $_SESSION['currentSetting'] );
			}	
			return header('Location: /tasks');
		}  else {
			$result = $this->model->getField();
			$result['action'] = '/tasks/create';
			$result['comments'] = 'Пожалуйста, заполните следующие поля :';
		 	$this->view->render( 'Добавить задачу', $result );
	 	}
	}	

	function actionUpdate() 
	{
		if(!isset($_SESSION['status'])){
			return header('Location: /');			
		}
		$id = $this->route['params'];
		if ( isset($_POST['username'] ) && isset( $_POST['email'] ) &&  isset($_POST['task_name'] )) {	
			$params = [	'username' 	 => $_POST['username'],
						'email' 	 => $_POST['email'],
						'task_name'	 => $_POST['task_name']
				 	  ];	

			$this->model->submit( $params, $id);
			return header('Location: /tasks');
		} else {
			$this->view->_view = 'create';
			$result = $this->model->getTask( $id );
			$result['action'] = '/tasks/update/'.$id;
			$result['comments'] = '';
		 	$this->view->render( 'Корректировка задачи', $result );
		} 	
	}	

	function actionUpdateNotepad() 
	{
		if ( isset($_POST['notepad'] ) && isset($_POST['id'] ) ) {	
			$params = [ 'notepad' => $_POST['notepad'],
						'id'	  => $_POST['id']	
				   	  ];
			$this->model->submitAjax($params);
		}	
	}	

	function actionUpdateStatus() 
	{
		if ( isset($_POST['type_tasks'] ) && isset($_POST['id'] ) ) {	
			$params = [ 'type_tasks' => $_POST['type_tasks'],
						'id'	  	 => $_POST['id']	
					  ];
			$result = $this->model->submitAjax($params);
			if ($_SESSION['currentSetting']['status'] == STATUS_ALL ) {
				return;
			} else {		
				$result = $this->model->getTasks( $_SESSION['currentSetting'] );
				if ( !$result ) {
					return;
	    		}
				$this->view->data = $result;
				$this->view->renderAjax('', $result );
	    	}
		}	
	}	

    function orderAll( $field ) 
    {
    	$order = '';
    	if ( $field ) { 
			if ( $_SESSION['currentSetting']['field'] != $field ) {
				$order = 'ASC';
			} else {
			 	if ( $_SESSION['currentSetting']['order'] == 'DESC' ) {
					$order = 'ASC';
			 	} else {
					$order = 'DESC';
			 	}
			}
			setCurrentSetting([ 'page' => 1,'order' => $order, 'field' => $field ]);
	    } 
    }
	
	function emptyTasks($count) {
		if ( $count == 0 ) {
			$_SESSION['tasksEmpty'] = true;
		} else {
			unset( $_SESSION['tasksEmpty'] );
		}
	} 

}