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
			<a href="#">Home</a></td>
			<td height="33"></td>
			<td width="550" rowspan="7"  class="divider">
                            <p><h2 style='padding-left: 18px;'>Welcome</h2></p>    
			<div class="content">
                            If you need high quality mix and mastering for a low price you came this the right place. We have over 10 years of experience. All of our engineers are highly skilled, and certified. We know what it's like to not being able to find a good, and affordable audio engineer. If you have the raw audio files (from the studio session without audio effects*), or just the finished song <a href="process.php">click here.</a> If your audio tracks are .wav, .mp3, .mp4, .aif, .aiff, .als, .asnd, .acc, .f4v, m4v, .mpg, .m2v, and .mov we got you. 
                        </div>
		        <br/>
			<div class="content">
				As the name implies, its just $35.00 for mix & mastering raw audio files from the recording studio, or your DAW. However, If you only have a finished song/songs (audio & vocals that has been saved together already), we charge a higher price because this process takes much longer, and very tedious.
                        </div>
                            <br/>
			<div class="content">
				No matter where you are in the world we not only can mix & master your music, we made it really affordable, and simp!e for you.
                        </div>
                            <br/>    
                        <div class="content">
				*If audio effects are applied, we cannot garuntee 100% satisfaction. However we will do the best we can, to make it sound the best it can.
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