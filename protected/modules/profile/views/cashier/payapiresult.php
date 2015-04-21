<?php
 echo $MerNo = "N0027";     //Merchant No
//merchant order No
 $BillNo = $_POST["BillNo"];
//Amount 
 $Amount = $_POST["Amount"];
//Payment status
 $Succeed = $_POST["Succeed"];
//Payment results
 $Result = $_POST["Result"];
//SHA 256 check information obtained
 $SignInfo = $_POST["SignInfo"];

//Calibration source string
$signsrc = $BillNo ."&". $Amount ."&". $Succeed ."&". $MerNo;
//Sha test results
echo $signsign = hash('sha256', $signsrc);
?>

        <!-- Please add your site's framework. Is the head of your site's top, left of the left and so on. There you have to do to adjust the font. -->

        <?php
        if ($SignInfo == $signsign) {
            ?>
            <!-- MD5 authentication is successful -->
            <table width="728" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td  align="right" valign="top">Your order number is:</td>
                    <td  align="left" valign="top"><?php echo $BillNo; ?></td>
                </tr>
                <tr>
                    <td  align="right" valign="top">Amount:</td>
                    <td align="left" valign="top"><?php echo $Amount; ?> </td>
                </tr>
                <tr>
                    <td  align="right" valign="top">Payment result:</td>
                    <?php if ($Succeed == 88) { 
                                     
                    ?>
                        <td align="left" valign="top" style="color:green;"><?php echo "Payment has been done."; //echo urldecode($Result) ?></td><!-- Submit payment information successfully, returned green message -->
                        <!-- Can modify the order status is being paid in -->
                        <?php
                    } else {
                        ?>
                        <td  align="left" valign="top" style="color:red;"><?php echo urldecode($Result) ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Succeed ?></td><!-- Failure to submit payment information, return to the red tips -->
                    <?php } ?>
                    <?php echo "Failure to submit payment"; ?>
                </tr>

            </table>
            <?php
        } else {
            ?>
            <!-- Authentication failed -->
            <table width="728" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td  align="center" valign="top" style="color:red;">Validation failed! error:<?php echo $Succeed ?></td>
                </tr>
            </table>

        <?php } ?>
        <p align="center"><a href="#" onClick="javascript:window.close()"><font size=2 color=blove>Close</font></a></p>
   
