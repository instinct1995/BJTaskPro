<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, shrink-to-fit=no">
	<title>BJ Задача</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="/css/animate.css" rel="stylesheet">
	<link href="/css/tasks.css" rel="stylesheet"> 
 
</head>
<body>
	<nav class="navbar navbar-expand-xl navbar-dark fixed-top" id="adminNav">
	    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i>
    	</button>
        <?php $uri = $_SERVER["REQUEST_URI"];
        ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="nav-link<?php echo $uri =='/tasks' ? ' item-active' :'';?>" href="/tasks">Задачи</a>
                </li>
                <?php if(!isset($_SESSION['status'])): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $uri =='/login' ? ' item-active' :'';?>" href="/login">login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link no-active" href="/logout">logOut</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
	</nav>
	<div class="container">
	<?php if (isset($this->data['tasks'])): ?>
        <div class="col-12 tasks-title">
    	   <h1 class="col-12 text-center"><?php echo $title;?></h1>
        </div>
	    <div class="row justify-content-center">
        	<div class="tasks-limit col-12 col-md-4">Количество строк &nbsp;&nbsp; 
          		<select id="limitTasks" class="custom-select"<?php echo !isset($_SESSION['tasksEmpty']) ? '':' disabled';?>>
            		<option value="3">3</option>
            		<option value="5">5</option>
            		<option value="10">10</option>
            		<option value="20">20</option>
            		<option value="30">30</option>
            		
          		</select>
        	</div>
        	<div id="paginationTasks"  class="col-12 col-md-4 text-center"><?php require 'pagination.php';?></div>
     
        	<div id="typeTasks" class="status-tasks col-12 col-md-4"><?php require 'type_tasks_table.php';?></div>
     	</div>
    	<div class="d-block d-sm-none add-tasks">
    		<a class="btn btn-success text-uppercase btn-block-mobile" href="/create">Добавить задачу</a>
 		</div>
     	<div id="tableTasks"><?php echo $content;?></div>
    	<div>
    		<a class="btn btn-success text-uppercase btn-block-mobile" href="/tasks/create">Добавить задачу</a>
 		</div>
	<?php else: ?>
		<div><?php echo $content;?></div>
	<?php endif;?>
    </div>

    
<script src="/js/jquery.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jqBootstrapValidation.min.js"></script>
<script src="/js/tasks.js"></script>
</body>
</html>