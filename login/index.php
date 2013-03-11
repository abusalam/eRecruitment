<?php 
use eRecruitment\login\UserLogin;
include 'class.login.php';
$UA= new UserLogin();
$UA->AuthCheck();
$UA->GetToken();
?>
<pre>
<?php 
	echo "Cookie: \n";
	print_r($_COOKIE);
	echo "Session: \n";
	print_r($_SESSION);
	echo "POST: \n";
	print_r($_POST);
	echo "\nSID:".SID;
?>
</pre>