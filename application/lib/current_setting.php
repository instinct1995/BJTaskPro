<?php
function setCurrentSetting( $array ) 
{
	foreach( $array as $key => $value ) {
		$_SESSION['currentSetting'][$key] = $value;
	}	
} 