<table id="tableTasksId" class="table table-striped table-bordered table-sm table-hover<?php echo !isset($_SESSION['tasksEmpty']) ? '':' tasks-empty';?>">
	<thead>
		<tr<?php echo !isset($_SESSION['tasksEmpty']) ? '':' disabled';?>>
			<th class="col1"><a class="col-sort btn-primary btn-sm btn-block" href="#" onclick="orderClick(event,'username')"<?php echo !isset($_SESSION['tasksEmpty']) ? '':' disabled';?>>Имя</a></th>
			<th class="col2"><a class="col-sort btn-primary btn-sm btn-block" href="#" onclick="orderClick(event,'email')">Email</a></th>
			<th><a class="col-sort btn-primary btn-sm btn-block" href="#" onclick="orderClick(event,'task_name')">Название задачи</a></th>
			<th class="col4"><a class="col-sort btn-primary btn-sm btn-block" href="#" onclick="orderClick(event,'type_tasks')">Статус</a></th>
	     	<th class="col3"><a class="col-sort btn-primary btn-sm btn-block" href="#" onclick="orderClick(event,'edit')">Статус ред.</a></th>
			<?php if ( isset($_SESSION['status']) ):?>
	     		<th class="col6 text-center"><button type="button" class="col-sort btn btn-primary btn-sm btn-block">Функция ред.</button></th>
    	 		<th class="notepad-hidden"></th>
			<?php endif;?>
		</tr>
	</thead>
	<?php if ($this->data['count'] != 0 ): ?>
	    <?php for ($i=0; $i < count($this->data['tasks']) ; $i++):?>
			<?php
			    $tasks = $this->data['tasks'][$i];
		    	$id = $tasks['id'];	
				$class ='';
				$disabled ='';
		        if(isset($_SESSION['status'])) {
					switch ($tasks['type_tasks']) {
						  	case '0':
								$class = ' class="bg-info"';
						  		break;
						  	case '1':
								$class = ' class="bg-success"';
						  		break;
						  	case '2':
								$class = ' class="bg-warning"';
						  		break;
						  	case '3':
								$class = '';
						  		break;
						  	case '4':
								$class = ' class="bg-danger"';
						  		break;
					}	
		    	}
		    	else {
		    		$disabled =' disabled';
		    	}
		    ?>	
		   	<tr id="tasksId<?php echo $tasks['id'];?>"<?php echo $class;?>>
		    	<td class="col1" data-label="Имя"><?php echo $tasks['username'];?></td>
		        <td data-label="Email"><?php echo $tasks['email'];?> </td>
		        <td data-label="Задачи"><?php echo $tasks['task_name'];?></td>
		        <td class="text-center" data-label="Статус"> 
		        	<select<?php echo $disabled;?> id="taskStatus<?php echo $tasks['id'];?>" class="task-status custom-select custom-select-sm" mame="type_tasks" value="<?php echo $tasks['type_tasks'];?>">
		    
		     		<?php for ($ii=0; $ii < count($this->data['types']) ; $ii++): ?> 
		            	<option value="<?php echo $this->data['types'][$ii]['id'];?>"<?php echo $tasks['type_tasks'] == $this->data['types'][$ii]['id'] ? ' selected ':'';?>><?php echo trim($this->data['types'][$ii]['name']);?><?php if ($this->data['types'][$ii]['id']==0) echo 'На рассмотрении'; else if ($this->data['types'][$ii]['id']==1) echo 'Выполнено'; else if ($this->data['types'][$ii]['id']==4) echo 'Отклонено';?>
		               	</option>
		        	<?php endfor;?>
		        	</select></td>
				<td data-label="Ред."><?php if($tasks['edit']==false) echo 'Нет'; else echo 'Да';?></td>
			        <?php if (isset($_SESSION['status'])): ?>
			            <td class="text-center" data-label="Изменить"><a id="updating" class="btn btn-primary btn-sm" href="/tasks/update/<?php echo $id;?>"><i class="fa fa-edit fa-lg"></i></a></td>
		    	    <?php endif;?>
	        </tr>
		<?php endfor;?>
	<?php else: ?>
	<tr>
		<td colspan="8" class="empty-text">Нет задач по этому статусу !!!</td>
	</tr>	
	<?php endif;?>
</table>

