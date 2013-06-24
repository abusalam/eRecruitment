<form name="feed_frm" method="post" action="MyPHPMailer.php">
	<b>Subject: </b><br /> <input size="50" maxlength="50" type="text" name="Subject" value="" /><br /> 
	<b>Your Name: </b><br /> <input size="50" maxlength="50" type="text" name="AppName" value="" /><br /> 
	<b>Your E-Mail: </b><br /> <input size="50" maxlength="50" type="text" name="AppEmail" value="" /><br />
	<b>Problem &amp; Suggestions : </b><br />
	<textarea rows="4" cols="60" name="TxtQry"></textarea><br /> 
	<textarea rows="4" cols="60" name="Body"></textarea>
	<input name="CmdSubmit" type="submit" value="Send" />
</form>
<?php

$site = "74.125.135.125";
$port = 443;

$fp = fsockopen($site,$port,$errno,$errstr,10);
if(!$fp)
{
echo "Cannot connect to server<br/>";
}

else{
echo "Connect was successful - no errors on Port ".$port." at ".$site;
fclose($fp);
}

?>
<?php
// Create a curl handle to a non-existing location
$ch = curl_init('https://www.paschimmedinipur.giv.in/index.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

if(curl_exec($ch) === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
else
{
    echo 'Operation completed without any errors';
}

// Close handle
curl_close($ch);
?>
<pre>
<?php
print_r(get_loaded_extensions());
print_r(get_defined_functions());
?>
</pre>