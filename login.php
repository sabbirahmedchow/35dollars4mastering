<?php
session_start();
//if(isset($_SESSION['userName']))
//{
    require_once 'classes/main.class.php';
    $mainClsObj = mainClass ::getInstance(); 
    
    if(isset($_SESSION['user'])!="")
    {
	header("Location: files.php");
    }

if(isset($_POST['btn-login']))
{
	$uname = mysql_real_escape_string($_POST['uname']);
	$upass = mysql_real_escape_string($_POST['pass']);
	
	$uname = trim($uname);
	$upass = trim($upass);
	
       	$getData = $mainClsObj->getData("tb_user");
      
	
	if($getData[0]['password']==md5($upass) && $getData[0]['name'] == $uname)
	{
		$_SESSION['user'] = $getData[0]['name'];
		header("Location: files.php");
	}
	else
	{
		?>
        <script>alert('Username / Password Seems Wrong !');</script>
        <?php
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
<link rel="stylesheet" type="text/css" href="css/main.css" />
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
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
                            <p><h2 style='padding-left: 18px;'>Log In</h2></p> 
			<div class="content" id="login-form" style="background-color: #eeeeee; margin:10px; padding:10px;">
                            <p align="center" style="color:#ff0000;">This section is for admin use only.</p>  
                        <form method="post">
                        <table align="center" width="80%" border="0" cellspacing="8">
                        <tr>
                        <td><input type="text" name="uname" placeholder="Your Username" required /></td>
                        </tr>
                        <tr>
                        <td><input type="password" name="pass" placeholder="Your Password" required /></td>
                        </tr>
                        <tr>
                        <td><button type="submit" name="btn-login">Sign In</button></td>
                        </tr>
                       
                        </table>
                        </form>
                        </div>
                        </td>
			
		</tr>
		
		<tr>
			<td class="nav" onmouseover="this.className='navHover'" onmouseout="this.className='nav'">
			<a href="#">File Gathering</a></td>
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