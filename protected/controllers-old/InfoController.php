<?php
class InfoController extends SiteController
{
	function actionIndex()
	{
		echo phpinfo(); 
	}
	
	function actionTest()
	{
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
	
	
	function actionServer()
	{
		var_dump($_SERVER); 
	}
}

?>