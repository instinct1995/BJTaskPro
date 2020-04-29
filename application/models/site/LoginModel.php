<?php

namespace application\models\site;

use application\core\Model;
use application\config\Db;
use application\lib\Protect;

class LoginModel extends Model 
{

	public function submit() 
	{
		$login = Protect::s( $_POST['login'] );
		$password = Protect::s( $_POST['password'] );	
		$query = "SELECT * FROM `users_tasks` WHERE login = '$login' AND password='$password' LIMIT 1";
 		$result = $this->db->query( $query );
		if( $result->fetch_assoc() ) {
			return true;
		}
		return false;
	}
}