<?php
return [
    '' => [
		'controller' => 'tasks',
		'action' 	 =>'index'
    ],
    'tasks' => [
		'controller' => 'tasks',
		'action' 	 =>'index'
    ],
    'page'  => [
		'controller' => 'tasks',
		'action' 	 =>'page'
    ],
	'limit'  => [
		'controller' => 'tasks',
		'action' 	 =>'limit'
    ],
        
    'tasks/update/([0-9]+)' => [
		'controller' => 'tasks',
		'action' 	 =>	'update'
    ],
    'updaten' => [
		'controller' => 'tasks',
		'action' 	 =>	'updateNotepad'
    ],
    'updates' => [
		'controller' => 'tasks',
		'action' 	 =>	'updateStatus'
    ],
    'login' => [
		'controller' => 'site',
		'action' 	 =>'login'
    ],
   'logout' => [
		'controller' => 'site',
		'action' 	 =>'logout'
    ],
    'tasks/create' => [
		'controller' => 'tasks',
		'action'  	 =>'create'
    ],

  	'filter' => [
		'controller' => 'tasks',
		'action'	 =>'filter'
    ],
  	'setting' => [
		'controller' => 'site',
		'action' 	 =>'setting'
    ],
  	'order' => [
		'controller' => 'tasks',
		'action' 	 =>'order'
    ],
];