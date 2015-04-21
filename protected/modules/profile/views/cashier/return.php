<table width="592" border="2" cellpadding="3" cellspacing="3" align="center" bgcolor="#FFFFFF">

<tr><td colspan="2" align="center"><strong>Transaction Results</strong></td></tr>
<tr>
    <td bgcolor="#CCCCCC">Thank you</td>
  </tr>
  <tr>
<td>
<?php 
 
$this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true, // display a larger alert block?
	'fade'=>true, // use transitions?
	'closeText'=>'×', // close link text - if set to false, no close link is displayed
	'alerts'=>array( // configurations per alert type
		'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
	)
));
 

if($xml)
{


   echo '<br/><br/><hr>';
   foreach ($xml as $key => $value)
						{
						/* if($key == "TotalAmount")
						 {
						  $value = $value/100;
						 }*/
						  echo $key.":".$value."<br/>";
						 
						     echo "<br/>";
						} 
						echo "Or you can select what value to print on your screen";
						echo "<br/>";
						echo 'Transaction No. '. $xml->TransactionId;
						
}						
?>    
</td>
</tr>
</table>