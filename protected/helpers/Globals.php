<?php 
class Globals
{
	public static $statuses = array(
		2 => array(
				'class' => 'lost',
				'text' => 'You Lose!'
		),
		3 => array(
				'class' => 'win',
				'text' => 'You Win!'
		),
		4 => array(
				'class' => 'draw',
				'text' => 'Draw'
		)			
	); 
	
	const PartnerLink = 'http://eclipse-finance.com/goLink?pid={pid}';
	
	const RMValue = 0.0015;	
	
	public static $symbols = array(
		'EUR/USD' => 'EUR/USD',
		'AUD/USD' => 'AUD/USD',
		'GBP/USD' => 'GBP/USD',
		'EUR/GBP' => 'EUR/GBP',
		'USD/JPY' => 'USD/JPY',
		'EUR/JPY' => 'EUR/JPY',
		'APPLE' => 'APPLE',
		'GOOGLE' => 'GOOGLE',
		'IBM' => 'IBM',
		'MICROSOFT' => 'MICROSOFT',
		'Crude Oil' => 'Crude Oil',
		'Gold' => 'Gold‏'
	);
	
	
	
}
?>