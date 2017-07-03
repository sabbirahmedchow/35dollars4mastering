<?php
session_start();
$str = '';
/***********************************************************
DoDirectPaymentReceipt.php

Submits a credit card transaction to PayPal using a
DoDirectPayment request.

The code collects transaction parameters from the form
displayed by DoDirectPayment.php then constructs and sends
the DoDirectPayment request string to the PayPal server.
The paymentType variable becomes the PAYMENTACTION parameter
of the request string.

After the PayPal server returns the response, the code
displays the API request and response in the browser.
If the response from PayPal was a success, it displays the
response parameters. If the response was an error, it
displays the errors.

Called by DoDirectPayment.php.

Calls CallerService.php and APIError.php.

***********************************************************/
if(isset($_REQUEST['submitBtn']))
{
    require_once '../classes/main.class.php';
    $mainClsObj = mainClass ::getInstance();
    
    
//    if ((($_FILES["file"]["type"] == "audio/mpeg")
//    || ($_FILES["file"]["type"] == "audio/mp3")
//    || ($_FILES["file"]["type"] == "audio/wav")
//    || ($_FILES["file"]["type"] == "application/zip")
//    || ($_FILES["file"]["type"] == "application/octet-stream")
//    || ($_FILES["file"]["type"] == "application/x-rar-compressed")))
//    {  
      
    $valid_extension = array('.mp3','.wav','.aif','.aiff','.mp4','.als','.wma','.asnd','.acc','.f4v','.m4v','.mpg','.mov','.zip','.rar');
    echo $file_extension = strtolower( strrchr( $_FILES["file"]["name"], "." ) );
    echo $_FILES["file"]["size"];
    if(in_array($file_extension, $valid_extension) && $_FILES["file"]["size"] < 100000000 )
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
                $str = "<font color=red>File Uploaded Successfully. You will be notified by email once the mixing and mastering is done by our engineers. Thank You</font>";
            }
        }
    }
    else
    {
        $str = "<font color=red>Invalid file or Maxium size exceeds</font>";
    }
    //}
}
else
{
require_once 'CallerService.php';
/**
 * Get required parameters from the web form for the request
 */
$paymentType =urlencode( $_POST['paymentType']);
$firstName =urlencode( $_POST['firstName']);
$lastName =urlencode( $_POST['lastName']);
$creditCardType =urlencode( $_POST['creditCardType']);
$creditCardNumber = urlencode($_POST['creditCardNumber']);
$expDateMonth =urlencode( $_POST['expDateMonth']);

// Month must be padded with leading zero
$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

$expDateYear =urlencode( $_POST['expDateYear']);
$cvv2Number = urlencode($_POST['cvv2Number']);
$address1 = urlencode($_POST['address1']);
$address2 = urlencode($_POST['address2']);
$city = urlencode($_POST['city']);
$state =urlencode( $_POST['state']);
$zip = urlencode($_POST['zip']);
$amount = urlencode($_POST['amount']);
//$email= urlencode($_POST['email']);
//$currencyCode=urlencode($_POST['currency']);
$currencyCode="USD";
$paymentType=urlencode($_POST['paymentType']);

/* Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter */
$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
"&ZIP=$zip&COUNTRYCODE=CA&CURRENCYCODE=$currencyCode";	//&EMAIL=$email";
//exit;
/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
$resArray=hash_call("doDirectPayment",$nvpstr);

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
   */
$ack = strtoupper($resArray["ACK"]);

if($ack!="SUCCESS")  {
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
<script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
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
	
    <table width = 400>
        <?php
        if(!isset($_REQUEST['submitBtn']))
        {
        ?>
        <tr>
            <td>
                Transaction ID:</td>
            <td><?=$resArray['TRANSACTIONID'] ?></td>
        </tr>
        <tr>
            <td>
                Amount:</td>
            <td><?=$currencyCode?> <?=$resArray['AMT'] ?></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <?php } ?>
        <tr>
            <td colspan="2">   
                <p> <h2> Upload File</h2></p>
                <p text-align="justify"><b>For optimal results, no audio effects should applied. We cannot guarantee 100% satisfaction if effects are applied to audio tracks. We mix & master what we get. </b></p>
<p text-align="justify"><b>It is your responsibility to make sure the folder/folders, and tracks, are properly spelled and labeled before uploading them.</b></p>
<p text-align="justify"><b>By you uploading your song/songs, or audio tracks, you are responsible for any and all legal matters should any occur as a result of the uploaded song/songs, or audio tracks. It is assumed you are the owner of the recordings, or have permission from the owner.</b></p>
<p text-align="justify"><b>WE ARE IN NO WAY RESPONSIBLE!</b></p>
                    </b></p>
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
			<a href="../process.php">File Gathering</a></td>
			<td height="33"></td>
		</tr>
                <tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../payment.php">Send File</a></td>
			<td height="33"></td>
		</tr>
		<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../files.php">File List</a></td>
			<td height="33"></td>
		</tr>
			<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="../contact.php">Contact Us</a></td>
			<td height="33"></td>
                        </tr>
		
		<tr>
                    <td style="vertical-align: top; padding:14px;">
                        
                       <div>

                        <h4>Subscribe Us</h4>
                        <div id="newsletterSucces" style="float:left; text-align: left; width:100%"></div>
                        <form action=''>
                            <div class="input-group">

                                <input type="text" class="form-control" id='newsletter_mail' placeholder="Email" /><br/><br/>

                                <span>

                                    <button class="btn btn-default" type="button" onclick ="return nsSubscribe();">Subscribe!</button>

			</span>

                            </div>
                            <!-- /input-group -->
                        </form>

                        <hr>

                        

                    </div> 
                    </td>
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
   <script type="text/javascript">
            
        function nsSubscribe()
            {
              
               var nsEmail = $("#newsletter_mail").val(); 
               if(nsEmail === "")
               {
                   alert("Please insert your email for subscription");
                   $("#newsletter_mail").focus();
                   return false;
               }    
               var dataString = "nsEmail="+nsEmail;
               $.ajax({
                type: "POST",
                url: "insertNewsletter.php",
                data: dataString,
                success: function(result) {
                 //alert(result);
                 if(result === '')
                 {    
                  $("#newsletterSucces").html("<b>Subscription Successfull!</b>");
                 }
                 else
                 {
                   $("#newsletterSucces").html(result);  
                 }    
               }
              });
            }
        </script>     
</body>
</html>



