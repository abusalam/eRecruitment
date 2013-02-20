<script type="text/JavaScript" src='contact.js'></script>
<?php
$reg=new DB();
$img = new Securimage();
$valid = $img->check($_POST['code']);
if((!isset($_POST['v_name'])) || !$valid || (strlen($_POST['feed_txt'])>1024) || (strlen($_POST['v_name'])>50) || (strlen($_POST['v_email'])>50))
{
	?>
<form
	name="feed_frm" method="post"
	action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
	style="text-align: left;">
	<b>Your Name: </b><br /> <input size="50" maxlength="50" type="text"
		name="v_name" value="<?php echo htmlspecialchars($_POST['v_name']);?>" />
	<br /> <b>Your E-Mail: </b><br /> <input size="50" maxlength="50"
		type="text" name="v_email"
		value="<?php echo htmlspecialchars($_POST['v_email']);?>" /> <br /> <b>Problem
		&amp; Suggestions : </b><span id="info">(Max: 1024 chars)</span><br />
	<?php 
	echo '<textarea rows="4" cols="60" style="height: 200px; margin: 0px;"'
		.'name="feed_txt" onkeyup="limitChars(this, 1024, \'info\')">'
		.trim(htmlspecialchars($_POST['feed_txt'])).'</textarea>';
	?>
	<br /> Secure Image:<br />
	<!-- pass a session id to the query string of the script to prevent ie caching -->
	<img id="siimage" style="margin-top: 5px;"
		src="../../captcha/securimage_show.php?sid=<?php echo md5(time()) ?>" />
	<a style="margin-top: 42px; margin-left: 10px;" tabindex="-1"
		style="border-style: none" href="#" title="Refresh Image"
		onClick="document.getElementById('siimage').src = '../../captcha/securimage_show.php?sid=' + Math.random(); return false">
		<img src="../../captcha/images/refresh.gif" alt="Reload Image"
		border="0" onClick="this.blur()" align="bottom" />
	</a> <br /> Image Code:
	<!-- NOTE: the "name" attribute is "code" so that $img->check($_POST['code']) will check the submitted form field -->
	<input type="text" name="code" size="12" /> <input name="button"
		type="button" style="width: 80px;" onclick="do_submit()" value="Send" />
</form>
<?php
}
else
{
	echo '<h3>Thankyou for your valuable time and appreciation.</h3>';//.$message;

	$nm=mysql_real_escape_string($_POST['v_name']);
	$email=mysql_real_escape_string($_POST['v_email']);
	$fd=mysql_real_escape_string($_POST['feed_txt']);

	if(strlen($_POST['feed_txt'])<=1024 && strlen($_POST['v_email'])<=50 && strlen($_POST['v_name'])<=50)
		$Submitted=$reg->do_ins_query("insert into ".MySQL_Pre."Helpline(IP,SessionID,AppName,AppEmail,TxtQry) values('".$_SERVER['REMOTE_ADDR']."','".$_SESSION['Client_SID']."','".$nm."','".$email."','".$fd."')");
	if($Submitted>0)
		$_SESSION['SendQry']=0;
	else
		echo "<h3>Unable to send request.</h3>";
}
?>
