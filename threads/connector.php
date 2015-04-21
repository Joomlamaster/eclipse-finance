<?php 
class foo_mysqli extends mysqli {
	public static $connection;
	public function __construct($host, $user, $pass, $db)
	{
		parent::__construct($host, $user, $pass, $db);
		if (mysqli_connect_error())
		{
			Logger::error('Connect Error (' . mysqli_connect_errno(). ') ');
			die('Connect Error (' . mysqli_connect_errno() . ') '
					. mysqli_connect_error());
		}
	}

	public function query($query)
	{
		Logger::sql($query);
		$result = parent::query($query);
		if( $this->error )   
		{
			Logger::error(sprintf ("MySQL.Error(%d): %s", $this->errno, $this->error));
			die(sprintf ("MySQL.Error(%d): %s", $this->errno, $this->error));
		}
		return is_bool($result) ? $result : new foo_mysqli_result($result);;
	}
}    

class foo_mysqli_result   
{
	private $result;

	public function __construct(\mysqli_result $result)
	{
		$this->result = $result;
	}

	public function fetch_all($resulttype = MYSQLI_NUM)
	{
		if (method_exists('mysqli_result', 'fetch_all')) # Compatibility layer with PHP < 5.3
			$res = $this->fetch_all($resulttype);
		else
		for ($res = array(); $tmp = $this->fetch_array($resulttype);) $res[] = $tmp;

		return $res;
	}
	 
	public function __call($name, $arguments) {
		return call_user_func_array(array($this->result, $name), $arguments);
	}
	
	public function __set($name, $value) {
		$this->result->$name = $value;
	}
	
	public function __get($name) {
		return $this->result->$name;
	}	
}


class DB
{
	public static $connection;

	public static function __callstatic($method, $args)
	{
		if (self::$connection) {
			return call_user_func_array(array(self::$connection, $method), $args);
		} else {
			self::$connection = new foo_mysqli(DBHOST, DBUSERNAME, DBPASSWORD, DBNAME);
			if (self::$connection)
				return call_user_func_array(array(self::$connection, $method), $args);
		}
	}

	public static function model($className)
	{
		return new $className;
	}
}

?>