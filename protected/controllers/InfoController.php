<?php
class InfoController extends SiteController
{
	function actionIndex()
	{
		echo phpinfo(); 
	}
	
	function actionTest()
	{	 
		var_dump($_SERVER);
		exit;
		if (!isset($HTTP_RAW_POST_DATA))
			$HTTP_RAW_POST_DATA = file_get_contents("php://input");

		$data =array();    
		$lec_encodedMessage = $data['encodedMessage'];
		$lec_decodedMessage = base64_decode($lec_encodedMessage);	
		$xml = simplexml_load_string($lec_decodedMessage); var_dump($xml); 
	}
	
	function actionTr()
	{
 		 
	}
	
	function actionWebservice()
	{
	    $service_url = 'http://104.238.118.236:8080/webservice/rest/events.json?event=Quote&symbol=EUR/USD&indent=';
	    $curl = curl_init($service_url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $curl_response = curl_exec($curl);
	    if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);  
	    } 
	    curl_close($curl);
	    $decoded = json_decode($curl_response);
	    if($decoded) {
		if($decoded->status =="OK"){
			echo $_GET['symbol'];exit;
			//print_r( $decoded->Quote);exit;
			$askPrice = $decoded->Quote->{'EUR/USD'}->askPrice; 
		    	$bidPrice = $decoded->Quote->{'EUR/USD'}->bidPrice; 
		    	var_dump(($askPrice + $bidPrice) / 2);
		}
		else{
		echo 2; exit;
		}
    	    } 
//      if($events = $decoded->events)
//      {
//       if($event = array_shift($events))
//       {
//        $mid = ($event->askPrice + $event->bidPrice) / 2;
//       }
//      } else {
//       Logger::error('No symbol events:' . $this->rate->rate_currency);
//       Users::model()->replenishBalance($this->rate->user_id, $this->rate->rate_value);
//       $this->closeRate(array(
//        'status' => 10, //error
//       ));
//       die;
//      }     	 
	}
	
	
	function actionServer()
	{
		var_dump($_SERVER); 
	}
}

?>