<?php 
class Func
{
	
	public static function balance($balance)
	{  
		echo preg_replace('/\.([\d]{2})/', '<small>$1</small>', number_format($balance, 2, '.', '')); 
	}
	
}

?>