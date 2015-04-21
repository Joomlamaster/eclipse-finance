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
//print_r($xml);
   echo '<br/><br/><hr>';
   foreach ($xml as $key => $value)
						{
						  echo $key.":".$value."<br/>";
						  foreach ($value as $k=>$v)
						    {
						    	 echo $k.":".$v."<br/>";
						    	 foreach ($v as $k1=>$v1)
						        {
						          echo $k1.":".$v1."<br/>";
						    	      foreach ($v1 as $k2=>$v2)
						    	         echo $k2.":".$v2."<br/>";
						        }
						        echo "<br/>";
						    }
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