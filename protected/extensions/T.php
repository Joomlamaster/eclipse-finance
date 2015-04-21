<?php 
class T extends Thread
{
	function run()
	{ echo 1;
		$r = new Users; 
		$r->first_name = 'asdasdasd';
		$r->save(); 
	}
}

?>