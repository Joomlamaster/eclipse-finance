<?php
$MerNo = "N0004";     //Merchant No
//merchant order No
$BillNo = $_REQUEST["BillNo"];
//Amount 
$Amount = $_REQUEST["Amount"];
//Payment status
$Succeed = $_REQUEST["Succeed"];
//Payment results
$Result = $_REQUEST["Result"];
//SHA 256 check information obtained
$SignInfo = $_REQUEST["SignInfo"];



//Calibration source string
$signsrc = $BillNo ."&". $Amount ."&". $Succeed ."&". $MerNo;
//Sha test results
$signsign = hash('sha256', $signsrc);

$dataProvider = array('mar_no'=>$MerNo,'bill_no'=>$BillNo,'amount'=>$Amount,'success'=>$Succeed,'result'=>$Result,'sign_info'=>$signsign);
                     $this->widget('zii.widgets.CListView', array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); 


?>

        