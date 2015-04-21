<?php 
class Logger
{
	public static function info($msg)
	{
		file_put_contents(__DIR__ . '/logs/info.log', '['.date("d-m-Y G:i:sa").'] '. $msg . "\r\n", FILE_APPEND);
	}

	public static function error($msg)
	{
		file_put_contents(__DIR__ . '/logs/error.log', '['.date("d-m-Y G:i:sa").'] '. $msg . "\r\n", FILE_APPEND);
	}

	public static function sql($sql)
	{
		file_put_contents(__DIR__ . '/logs/sql.log', '['.date("d-m-Y G:i:sa").'] '. $sql . "\r\n", FILE_APPEND);
	}
	
	public static function log($file, $msg)
	{
		file_put_contents(__DIR__ . '/logs/'.$file.'.log', '['.date("d-m-Y G:i:sa").'] '. $msg . "\r\n", FILE_APPEND);
	}
}

?>