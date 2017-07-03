<?php
session_start();
$str = '';
/**********************************************************
DoExpressCheckoutPayment.php

This functionality is called to complete the payment with
PayPal and display the result to the buyer.

The code constructs and sends the DoExpressCheckoutPayment
request string to the PayPal server.

Called by GetExpressCheckoutDetails.php.

Calls CallerService.php and APIError.php.

**********************************************************/
if(isset($_REQUEST['submitBtn']))
{
    require_once '../classes/main.class.php';
    $mainClsObj = mainClass ::getInstance();
    
    
    if ((($_FILES["file"]["type"] == "audio/mpeg")
    || ($_FILES["file"]["type"] == "audio/mp3")
    || ($_FILES["file"]["type"] == "audio/wav")
    || ($_FILES["file"]["type"] == "application/zip")
    || ($_FILES["file"]["type"] == "application/octet-stream")
    || ($_FILES["file"]["type"] == "application/x-rar-compressed")))
    {  
      
    $valid_extension = array('.mp3','.wav');
    echo $file_extension = strtolower( strrchr( $_FILES["file"]["name"], "." ) );
    echo $_FILES["file"]["size"];
    if(in_array($file_extension, $valid_extension) && $_FILES["file"]["size"] < 10000000 )
      {
        if ($_FILES["file"]["error"] > 0)
        {
            //print_r($_FILES);
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
//            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//            echo "Type: " . $_FILES["file"]["type"] . "<br />";
//            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            if (file_exists("../soundfiles/" . $_FILES["file"]["name"]))
            {
                $str = $_FILES["file"]["name"] . " already exists. ";
            }
            else
            {
                $table = 'tb_customer_file'; //table name
                $custName = $_REQUEST['custName'];
                $custEmail = $_REQUEST['custEmail'];
                $custFile = $_FILES["file"]["name"];

                $custInfo = array(

                  "customerName" => $custName,
                  "customerEmail" => $custEmail,
                  "customerFile" => $custFile  

                  );

                try {
                    $insertRow = $mainClsObj->saveData($table,$custInfo); 

               } catch(Exception $e){
                $is_error = 1;
                echo $is_error;
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], "../soundfiles/" . $_FILES["file"]["name"]);
                $str = "File Uploaded Successfully. You will be notified by email once the mixing and mastering is done by our engineers. Thank You";
            }
        }
    }
    else
    {
        echo "Invalid file";
    }
    }
}
else
{    
require_once 'CallerService.php';


/* Gather the information to make the final call to
   finalize the PayPal payment.  The variable nvpstr
   holds the name value pairs
   */
$token =urlencode( $_SESSION['token']);
$paymentAmount =urlencode ($_SESSION['paymentAmount']);
$paymentType = urlencode($_SESSION['paymentType']);
$currCodeType = urlencode($_SESSION['currCodeType']);
$payerID = urlencode($_SESSION['payer_id']);
$serverName = urlencode($_SERVER['SERVER_NAME']);

$nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPADDRESS='.$serverName ;

 /* Make the call to PayPal to finalize payment
    If an error occured, show the resulting errors
    */
$resArray=hash_call("DoExpressCheckoutPayment",$nvpstr);

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
   */
$ack = strtoupper($resArray["ACK"]);


if($ack!="SUCCESS"){
	$_SESSION['reshash']=$resArray;
	$location = "APIError.php";
		 header("Location: $location");
               }
}               

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<title>Welcome to 35dollars4mastering.com :: We bring your music to life</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" >
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In 35dollars4mastering.com, we know what it's like to not being able to find a good audio engineer. . If all you have is just the .wav or .mp3 of the finished song you're still in luck. We got you. No matter where you are in the world we not only can mix & master your music, we made it really affordable and simple for you.">
    <meta name="author" content="D.Smith">
    <meta name="keywords" content="35dollars4mastering, mixing, mastering, mp3, wav, aif, aiff, als, engineering, sound, audio">
<link rel="stylesheet" type="text/css" href="../css/main.css" />
</head>

<body bgcolor="#242640">

<div align="center">
	<table width="714" border="1" class="Table" id="table1">

		<tr>
			<td colspan="3" style="font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 14px; color: #282828">
			<div class="title">
				35dollars4mastering.com
                        </div>
&nbsp;</td>
			<td width="0" height="100"></td>
		</tr>
		<tr>
                    
                   <td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../index.php">Home</a></td>
			<td height="33"></td>
			<td width="550" rowspan="6"  class="divider">
                          <p><h2 style='padding-left: 18px;'>Thanks for your payment</h2></p> 
                         <div class="content">
    
    <table width=100%>
        <?php
        if(!isset($_REQUEST['submitBtn']))
        {
        ?>
        <tr>
            <td >
                Transaction ID:</td>
            <td><?=$resArray['TRANSACTIONID'] ?></td>
        </tr>
        
        <tr>
            <td >
                Amount:</td>
            <td><?=$currCodeType?> <?=$resArray['AMT'] ?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <?php } ?>
        <tr>
            <td colspan="2">   
                <p> <h3> Upload File</h3></p>
                <p align="center"><b><?php echo $str; ?></b></p>
        <form enctype="multipart/form-data" action="" method="POST">
            <p><label>Enter your Name: <input type="text" name="custName" id="custName" required/></label></p>
            <p><label>Enter your Email: <input type="text" name="custEmail" id="custEmail" required/></label></p>
    <input type="hidden" name="MAX_FILE_SIZE"/>
    <p><label>Upload your file: <input name="file" type="file" /></label></p>
    <p><span><font style="color:red">For multiple raw files, please zip the folder before you upload.</font></span></p>
    <input type="submit" value="Upload File" name="submitBtn" />
     </form>
            </td>
        </tr>
    </table>
       </div> 
       </td>
                        
       <td width="0" height="33"></td>
		</tr>
		
		<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../process.php">The Process</a></td>
			<td height="33"></td>
		</tr>
                <tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../payment.php">Send File</a></td>
			<td height="33"></td>
		</tr>
		<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../files.php">Mailing List</a></td>
			<td height="33"></td>
		</tr>
			<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../contact.php">Contact Us</a></td>
			<td height="33"></td>
                        </tr>
		
		<tr>
			<td></td>

		</tr>
		<tr>
			<td style="font-family: 'Trebuchet MS', Verdana, Arial, sans-serif; font-size: 14px; color: #282828">
			</td>
			<td height="2"></td>
		</tr>
		
		
		<tr>
			<td colspan="4" class="creds" bgcolor="#242640">Copyright &copy 2017 | All Rights Reserved  </td>
			<td height="21" width="0"></td>
		</tr>                  
                        
    
    </table>
    </div>
   
</body>
</html>

