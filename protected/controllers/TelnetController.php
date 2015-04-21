<?php

class TelnetController extends SiteController
{
	public function actionIndex()
	{
		Yii::import('ext.Telnet');
		$telnet = new Telnet('udp://127.0.0.1', 13, 10, null); //('87.84.77.183', 49000)
		//var_dump($telnet);
		
		//$this->render('index');
	}
	
	function actionTest()
	{
		error_reporting(E_ALL);
		
		set_time_limit(5);
		ob_implicit_flush();
		
		
		//$socket    = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		//$result    = socket_connect($socket, '87.84.77.183', '49000'); var_dump($result);
		
		
		$host = '87.84.77.183';
		$port = '49000';
		$timeout = 15;  //timeout in seconds
		
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)
		or die("Unable to create socket\n");
		
		socket_set_nonblock($socket)
		or die("Unable to set nonblock on socket\n");
		
		$time = time();
		while (!@socket_connect($socket, $host, $port))
		{
			$err = socket_last_error($socket);
			if ($err == 115 || $err == 114)
			{
				if ((time() - $time) >= $timeout)
				{
					socket_close($socket);
					die("Connection timed out.\n");
				}
				sleep(1);
				continue;
			}
			die(socket_strerror($err) . "\n");
		}
		
		socket_set_block($this->socket)
		or die("Unable to set block on socket\n");		
		
		
		/*
		read_welcome_message($socket);
		$result = send_login($socket, 'username');
		$result = send_passw($socket, 'password');
		
		if ($result === true)
			echo ("auth success");
		else
			echo ("auth failed");
		
		send_command($socket, 'conf t');
		send_command($socket, 'int fa0/1');
		send_command($socket, 'shut');
		send_command($socket, 'end');
		
		socket_close($socket);	
		*/
	}
	
	function read_welcome_message($socket)
	{
		while ($out = socket_read($socket, 512))
		{
			if(preg_match('/Username:/i',$out))
				return (true);
		}
	}
	
	function send_login($socket, $username)
	{
		socket_write($socket, $username . "\n", strlen($username) + 1);
	
		while ($out = socket_read($socket, 512))
		{
			if(preg_match('/Password:/i',$out))
				return (true);
		}
	}
	
	function send_passw($socket, $password)
	{
		socket_write($socket, $password . "\n", strlen($password) + 1);
	
		while ($out = socket_read($socket, 512))
		{
			if(preg_match('/#/i',$out))
				return(true);
	
			if(preg_match('/Username:/i',$out))
				return(false);
		}
	}
	
	function send_command($socket, $command)
	{
		socket_write($socket, $command . "\n", strlen($command) + 1);
	
		while ($out = socket_read($socket, 512))
		{
			if(preg_match('/#/i',$out))
				return(true);
		}
	}	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}