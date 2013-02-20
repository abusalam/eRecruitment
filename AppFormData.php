<?php
if(!isset($_SESSION['Step']))
	$_SESSION['Step']=0;
elseif (isset($_POST['InsTerm']) && ($_POST['InsTerm']=="1"))
	$_SESSION['Step']=1;
elseif (isset($_POST['AppSubmit']) && ($_POST['AppSubmit']=="Submit"))
{
	$_SESSION['Step']=2;
	$_SESSION['PostData']=$_POST;
	$Data=new DB();
	$_SESSION['AppID']="ZIFW";
	$Data->do_close();
}

?>