<?php
namespace application\models\tasks;

use application\core\Model;
use application\config\Db;
use application\lib\Protect;
			
class TasksModel extends Model 
{
	public function getTask( $id ) 
	{
	   	$id = Protect::s( $id );
		$query = "SELECT * FROM `tasks` WHERE id = $id LIMIT 1";
 		$result = $this->db->query( $query );
 		$array = $result->fetch_assoc(); 
		if ( $array ) {
			return $array;
		}
		return false;
    }
    
    public function getTasks( $seitting ) 
    {
		extract( Protect::s( $seitting ) );
		$array = [];
		$typeStr = $status != STATUS_ALL ? $status == STATUS_TOPICAL ? ' AND `type_tasks` !='.STATUS_PERFORMED.'  AND `type_tasks` !='.STATUS_REJECTED.' ' : ' AND `type_tasks`='.$status : '';

		$countStr = "SELECT count(id) AS count FROM `tasks` c 
											  WHERE `id`>0 $typeStr 
											  LIMIT 1";
		$totalCount = $this->db->query( $countStr );
		$row = $totalCount->fetch_assoc();

		if (ceil($row['count'] / $limit) < $page  || $page < 1 ) {
			$page = 1;
			$_SESSION['curentSetting']['page'] = $page ;
		} 

		$array['count'] = $row['count'];
		$array['page']  = $page;
		$array['limit'] = $limit;
		$array['status'] = $status;
		$page = ($page-1)*$limit;

		$type =  $this->db->query( "SELECT * FROM `type_tasks` ORDER BY `id`" );
		while( $row = mysqli_fetch_assoc( $type ) ) {
			$array['types'][] = $row;
		}
 
		$tasksStr = "SELECT * FROM `tasks` 
							 WHERE `id`>0 $typeStr 
						  ORDER BY $field $order 
							 LIMIT $page , $limit";
		$result = $this->db->query( $tasksStr );

		if ($array['count'] != 0) {
			while( $row = mysqli_fetch_assoc( $result ) ) {
				$array['tasks'][] = $row;
			}
		} else {
			$array['tasks'][] = ''; 
		}
        return $array;
    }

	public function submit( $params, $id = 0, $edit = 1 ) 
	{
		$params =	Protect::s( $params );	 
		if ( $id != 0 ) {
			$params['id'] = $id;
			$params['edit'] = $edit;
			$query="UPDATE `tasks` SET `username` = '". $params['username'] ."', `email` = '". $params['email'] ."', `task_name` = '". $params['task_name'] ."', `edit` = '". $params['edit'] ."' WHERE `id` = ". $params['id'];
			$result = $this->db->query( $query );
			return $result;
		} else {
			$query = "INSERT INTO `tasks` ( `username`,`email`,`task_name`,`type_tasks`) 
						   VALUES ( '". $params['username'] ."','". $params['email'] ."','". $params['task_name'] ."',0)";
			$result = $this->db->query( $query );
			return $result;
		}	
	}


	public function submitAjax( $params ) 
	{
		$params = Protect::s( $params );
		$query = "UPDATE `tasks` SET  ";
		if (isset($params['notepad'])) {
			$query .= "`notepad` = '".$params['notepad']."'"; 
		} else {
			$query .= "`type_tasks` = '".$params['type_tasks']."'"; 
		}
		$query .= " WHERE `id` = " . $params['id'];		   
		$result = $this->db->query( $query );
		if ( $result ) {
			return true;
		}
		return false;
	}

	public function getField() 
	{
		return  [
				'username'	 => '',
				'email'		 => '',
				'task_name'	 => '',
				'type_tasks' => 0
				];		
	}	
	
}?>