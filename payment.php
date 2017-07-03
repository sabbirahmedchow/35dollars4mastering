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
<link rel="stylesheet" type="text/css" href="css/main.css" />
<script type="text/javascript">
    window.onload = function() {
    cnt2.onclick = function() {
    pmntType2.checked = true;
}
cnt1.onclick = function() {
    pmntType1.checked = true;
}
    }
</script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script>
    $(document).ready(function(){

    update_amounts('cnt1',35.00,'price1');
    //update_amounts('cnt2',100.00,'price2');
    
    $('#cnt1').keyup(function() {
        update_amounts('cnt1',35.00,'price1');
    });
    $('#pmntType1').change(function() {
        update_amounts('cnt1',35.00,'price1');
    });
    
    $('#cnt2').keyup(function() {
        update_amounts('cnt2',100.00,'price2');
    });
    $('#pmntType2').change(function() {
        update_amounts('cnt2',100.00,'price2');
    });
});


function update_amounts(qty, amnt, prc)
{
   
        var sum = 0.0;
    //$('#myTable > tbody  > tr').each(function() {
        var qty1 = $('#'+qty).val();
        //alert(qty1);
        
        var amount = (qty1*amnt)
        sum+=amount;
        $('#'+prc).text('$'+amount+'.00');
        $('#paymentAmount').val(amount);
    //});
    //just update the total to sum    
}
function chckAmnt()
{
    if(this.paymentAmount.value == '0')
    {
      alert("Total amount cannot be zero.");  
      return false;
    }
    else
    return true;    
}
</script>
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
			<a href="index.php">Home</a></td>
			<td height="33"></td>
			<td width="550" rowspan="6"  class="divider">
                            <p><h2 style='padding-left: 18px;'>Select Your File Type</h2></p>    
			<div class="content">
                            <table width="100%" cellspacing="6" cellpadding="5" id="myTable">
                                <tr style="background-color: #cccccc;">
                                    <td><b>Type of File</b></td><td><b>No. of Files</b></td> <td><b>Total</b></td>
                                </tr> 
                                <tr><td colspan="3">&nbsp;</td></tr>
                                <tbody>
                                <form action="paypal/DoDirectPayment.php" method="POST">
	                        <input type=hidden name=paymentType value='Sale' > 
                                <input type=hidden name=currencyCodeType value='USD' > 
                                <input type=hidden name=paymentAmount id="paymentAmount" > 
                                    <tr>
                                        <td><input type="radio" name="pmntType" id="pmntType1" value="1" checked/> Multiple raw files</td><td><input type="text" name="cnt1" id="cnt1" value="0" /></td> <td><div id="price1">$0.00</div></td>
                                    </tr> 
                                    <tr>
                                        <td><input type="radio" name="pmntType" id="pmntType2" value="2" /> Single/Finished Song</td><td><input type="text" name="cnt2" id="cnt2" value="0"/></td> <td id="price2">$0.00</td>
                                    </tr>
                                    <tr><td colspan="3" style="color:red;">N.B. Once your payment is done, you will be redirected to the file upload section.</td></tr>
                                    <tr>
                                        <td colspan="3" align="center"><input type="submit" name="submit" value="Proceed" onclick="return chckAmnt();" /></td>
                                    </tr>
                                 </form>
                                </tbody>
                            </table>
                        </div>
			</td>
			<td width="0" height="33"></td>
		</tr>
		
		<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="process.php">File Gathering</a></td>
			<td height="33"></td>
		</tr>
                <tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="payment.php">Send File</a></td>
			<td height="33"></td>
		</tr>
		<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="files.php">File List</a></td>
			<td height="33"></td>
		</tr>
			<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="contact.php">Contact Us</a></td>
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