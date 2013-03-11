<?php
if(!isset($_SESSION))
	session_start();
$sess_id=md5(microtime());
if(($_SESSION['TokenSent']!==TRUE) || (! isset($_GET['Token'])))
{
	$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
	$scriptFolder .= $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	header("Location: {$scriptFolder}?Token={$sess_id}");
	$_SESSION['Token']=$sess_id;
	$_SESSION['TokenSent']=TRUE;
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >';
?>
<body>
<h1>Worked!</h1>
<form action="<?php echo $_SERVER['PHP_SELF']."?Token={$_SESSION['Token']}";?>" method="post">
<input type="time" name="SetTime" />
<input type="submit" />
</form>
<h2>Time:</h2>
<p><?php echo $_POST['SetTime'];?></p>
<h2>Token:</h2>
<p><?php echo $_GET['Token'];?></p>
</body>
</html>