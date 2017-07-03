<?php

/************************************************************
This is the main web page for the DoDirectPayment sample.
This page allows the user to enter name, address, amount,
and credit card information. It also accept input variable
paymentType which becomes the value of the PAYMENTACTION
parameter.

When the user clicks the Submit button, DoDirectPaymentReceipt.php
is called.

Called by index.html.

Calls DoDirectPaymentReceipt.php.

************************************************************/
// clearing the session before starting new API Call
session_unset();
$paymentType = $_REQUEST['paymentType'];
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
	<table width="714" border="1" class="Table" id="table1" cellspacing="7" cellpadding="1">

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
			<td width="550" rowspan="7"  class="divider">
                            <p><h2 style='padding-left: 18px;'>Credit Card Information</h2></p>    
			<div class="content">
                        <form action="DoDirectPaymentReceipt.php" method="POST">
                            <input type=hidden name=paymentType value="<?=$paymentType?>" />
                            <input type="hidden" name="amount" value="<?php echo $_REQUEST['paymentAmount'];?>" />
                            <center>
                            <table class="api">
                            <tr>
                                <td class="thinfield"> First Name:</td>
                                <td align=left><input type="text" size="30" maxlength="32" name="firstName" value="" required /></td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Last Name:</td>
                                <td>
                                    <input type="text" size="30" maxlength="32" name="lastName" value="" required /></td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Card Type:</td>
                                <td>
                                    <select name="creditCardType">
                                    <option></option>
                                    <option value="Visa" selected="selected">Visa</option>
                                    <option value="MasterCard">MasterCard</option>
                                    <option value="Discover">Discover</option>
                                    <option value="Amex">American Express</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Card Number:</td>
                                <td>
                                    <input type="text" size="19" maxlength="19" name="creditCardNumber" value="" required /></td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Expiration Date:</td>
                                <td>
                                    <select name="expDateMonth" required>
                                    <option value="1">01</option>
                                    <option value="2">02</option>
                                    <option value="3">03</option>
                                    <option value="4">04</option>
                                    <option value="5">05</option>
                                    <option value="6">06</option>
                                    <option value="7">07</option>
                                    <option value="8">08</option>
                                    <option value="9">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    </select>
                                    <select name="expDateYear">
                                    <OPTION VALUE="2017">2017</OPTION>
                                    <OPTION VALUE="2018">2018</OPTION>
                                    <OPTION VALUE="2019">2019</OPTION>
                                    <OPTION VALUE="2020">2020</OPTION>
                                    <OPTION VALUE="2021">2021</OPTION>
                                    <OPTION VALUE="2022">2022</OPTION>
                                    <OPTION VALUE="2023">2023</OPTION>
                                    <OPTION VALUE="2024">2024</OPTION>
                                    <OPTION VALUE="2025">2025</OPTION>
                                    <OPTION VALUE="2026">2026</OPTION>
                                    <OPTION VALUE="2027">2027</OPTION>
                                    <OPTION VALUE="2028">2028</OPTION>
                                    <OPTION VALUE="2029">2029</OPTION>
                                    <OPTION VALUE="2030">2030</OPTION>
                                    <OPTION VALUE="2031">2031</OPTION>
                                    <OPTION VALUE="2032">2032</OPTION>
                                    <OPTION VALUE="2033">2033</OPTION>
                                    <OPTION VALUE="2034">2034</OPTION>
                                    <OPTION VALUE="2035">2035</OPTION>
                                    <OPTION VALUE="2036">2036</OPTION>
                                    <OPTION VALUE="2037">2037</OPTION>
                                    <OPTION VALUE="2038">2038</OPTION>
                                    <OPTION VALUE="2039">2039</OPTION>
                                    <OPTION VALUE="2040">2040</OPTION>
                                    <OPTION VALUE="2041">2041</OPTION>
                                    <OPTION VALUE="2042">2042</OPTION>
                                    <OPTION VALUE="2043">2043</OPTION>
                                    <OPTION VALUE="2044">2044</OPTION>
                                    <OPTION VALUE="2045">2045</OPTION>
                                    <OPTION VALUE="2046">2046</OPTION>
                                    <OPTION VALUE="2047">2047</OPTION>
                                    <OPTION VALUE="2048">2048</OPTION>
                                    <OPTION VALUE="2049">2049</OPTION>
                                    <OPTION VALUE="2050">2050</OPTION>
                                    <OPTION VALUE="2051">2051</OPTION>
                                    <OPTION VALUE="2052">2052</OPTION>
                                    <OPTION VALUE="2053">2053</OPTION>
                                    <OPTION VALUE="2054">2054</OPTION>
                                    <OPTION VALUE="2055">2055</OPTION>
                                    <OPTION VALUE="2056">2056</OPTION>
                                    <OPTION VALUE="2057">2057</OPTION>
                                    <OPTION VALUE="2058">2058</OPTION>
                                    <OPTION VALUE="2059">2059</OPTION>
                                    <OPTION VALUE="2060">2060</OPTION>
                                    <OPTION VALUE="2061">2061</OPTION>
                                    <OPTION VALUE="2062">2062</OPTION>
                                    <OPTION VALUE="2063">2063</OPTION>
                                    <OPTION VALUE="2064">2064</OPTION>
                                    <OPTION VALUE="2065">2065</OPTION>
                                    <OPTION VALUE="2066">2066</OPTION>
                                    <OPTION VALUE="2067">2067</OPTION>
                                    <OPTION VALUE="2068">2068</OPTION>
                                    <OPTION VALUE="2069">2069</OPTION>
                                    <OPTION VALUE="2070">2070</OPTION>
                                    <OPTION VALUE="2071">2071</OPTION>
                                    <OPTION VALUE="2072">2072</OPTION>
                                    <OPTION VALUE="2073">2073</OPTION>
                                    <OPTION VALUE="2074">2074</OPTION>
                                    <OPTION VALUE="2075">2075</OPTION>
                                    <OPTION VALUE="2076">2076</OPTION>
                                    <OPTION VALUE="2077">2077</OPTION>
                                    <OPTION VALUE="2078">2078</OPTION>
                                    <OPTION VALUE="2079">2079</OPTION>
                                    <OPTION VALUE="2080">2080</OPTION>
                                    <OPTION VALUE="2081">2081</OPTION>
                                    <OPTION VALUE="2082">2082</OPTION>
                                    <OPTION VALUE="2083">2083</OPTION>
                                    <OPTION VALUE="2085">2084</OPTION>
                                    <OPTION VALUE="2086">2086</OPTION>
                                    <OPTION VALUE="2087">2087</OPTION>
                                    <OPTION VALUE="2088">2088</OPTION>
                                    <OPTION VALUE="2089">2089</OPTION>
                                    <OPTION VALUE="2090">2090</OPTION>
                                    <OPTION VALUE="2091">2091</OPTION>
                                    <OPTION VALUE="2092">2092</OPTION>
                                    <OPTION VALUE="2093">2093</OPTION>
                                    <OPTION VALUE="2094">2094</OPTION>
                                    <OPTION VALUE="2095">2095</OPTION>
                                    <OPTION VALUE="2096">2096</OPTION>
                                    <OPTION VALUE="2097">2097</OPTION>
                                    <OPTION VALUE="2098">2098</OPTION>
                                    <OPTION VALUE="2099">2099</OPTION>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Card Verification Number:</td>
                                <td>
                                    <input type="text" size="3" maxlength="4" name="cvv2Number" value="" required /></td>
                            </tr>
                                <tr><td colspan="2">&nbsp;</td></tr>   
                            <tr>
                                <td class="header">
                                    <b> Billing Address:</b>
                                </td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Address 1:
                                </td>
                                <td>
                                    <input type="text" size="25" maxlength="100" name="address1" value="" required /></td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Address 2:
                                </td>
                                <td>
                                    <input type="text" size="25" maxlength="100" name="address2" />(optional)</td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    City:
                                </td>
                                <td>
                                    <input type="text" size="25" maxlength="40" name="city" value="" required /></td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    State:
                                </td>
                                <td>
                                    <select name="state" required>
                                    <option></option>
                                    <option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="DC">District Of Columbia</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    ZIP Code:
                                </td>
                                <td>
                                    <input type="text" size="10" maxlength="10" name="zip" value="" required />(5 or 9 digits)
                                </td>
                            </tr>
                            <tr>
                                <td class="thinfield">
                                    Country:
                                </td>
                                <td>
                                    United States
                                </td>
                            </tr>
                                <tr><td colspan="2">&nbsp;</td></tr>   
                            <tr>
                                <td class="field">
                                </td>
                                <td>
                                    <input type="image" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" /></td>
                            </tr>
                        </table>
        </center>
                        </form>   
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
                    <td><br/><img src="paypal.jpg" width="150"/> </td>
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
