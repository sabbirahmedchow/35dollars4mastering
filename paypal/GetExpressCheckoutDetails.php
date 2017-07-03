<?php
session_start();
/********************************************************
GetExpressCheckoutDetails.php

This functionality is called after the buyer returns from
PayPal and has authorized the payment.

Displays the payer details returned by the
GetExpressCheckoutDetails response and calls
DoExpressCheckoutPayment.php to complete the payment
authorization.

Called by ReviewOrder.php.

Calls DoExpressCheckoutPayment.php and APIError.php.

********************************************************/
$_SESSION['token']=$_REQUEST['token'];
$_SESSION['payer_id'] = $_REQUEST['PayerID'];

$_SESSION['paymentAmount']=$_REQUEST['paymentAmount'];
$_SESSION['currCodeType']=$_REQUEST['currencyCodeType'];
$_SESSION['paymentType']=$_REQUEST['paymentType'];
$resArray=$_SESSION['reshash'];
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
                            <p><h2 style='padding-left: 18px;'>Review your Order</h2></p>    
			<div class="content">
                          <form action="DoExpressCheckoutPayment.php">  
                            <table width="80%">
                                <tr>
                <td><b>Order Total:</b></td>
                <td>
                  <?=$_REQUEST['currencyCodeType'] ?> <?=$_REQUEST['paymentAmount']?></td>
            </tr>
                                <tr><td>&nbsp;</td></tr>               
			<tr>
			    <td ><b>Shipping Address: </b></td>
			</tr>
            <tr>
                <td >
                    Street 1:</td>
                <td>
                   <?=$resArray['SHIPTOSTREET'] ?></td>

            </tr>
            
            <tr>
                <td >
                    City:</td>

                <td>
                    <?=$resArray['SHIPTOCITY'] ?></td>
            </tr>
            <tr>
                <td >
                    State:</td>
                <td>
                    <?=$resArray['SHIPTOSTATE'] ?></td>
            </tr>
            <tr>
                <td >
                    Postal code:</td>

                <td>
                    <?=$resArray['SHIPTOZIP'] ?></td>
            </tr>
            <tr>
                <td >
                    Country:</td>
                <td>
                     <?=$resArray['SHIPTOCOUNTRYNAME'] ?></td>
            </tr>
              <tr><td>&nbsp;</td></tr>                   
            <tr>
                <td class="thinfield" align="center" colspan="2">
                     <input type="submit" value="Make Payment" style="border:3px solid #cccccc; background-color: #555555; color:#ffffff; border-radius: 12px; padding:7px;" />
                </td>
            </tr>
                                
                                
        </table>
        </form>
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
