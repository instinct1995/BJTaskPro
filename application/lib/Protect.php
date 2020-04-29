<?php
namespace application\lib;

class Protect 
{

	static function s($value) 
	{
		$value = is_array($value) ? array_map('self::s', $value) : htmlspecialchars(strip_tags($value), ENT_QUOTES, 'utf-8');
		return $value;
	}
}