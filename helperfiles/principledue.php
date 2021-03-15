<?php
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include_once 'includes/header.php';
   if($_POST["pduedate"])
   {
   		
    		$db = new db();
    		$done1 = $db->pdueinaccount($_POST["pduesid"], $_POST["pduedate"]);
    		if($done1)
    		{
        	//echo "<h4>Account Withdrawn And Balance Updated Successfully!<h4>";
        }
    		else
    		{
    			

    		}
    	

		//echo "<br>Your Amount: <b>".$_POST["wdramount"]."</b>";
		//echo "<br>Your Cheque#: <b>".$_POST["wdrchequeno"]."</b>";
		//echo "<br>Your Date: <b>".$_POST["wdrdate"]."</b>";
		//echo "<br>Your SID: <b>".$_POST["wdrsid"]."</b>";
   }
?>