<?php
if(!isset($_SESSION['Step'])){
	$_SESSION['Step']="Init";
	$_SESSION['DB']=0;
}
elseif (isset($_POST['InsTerm']) && ($_POST['InsTerm']=="1"))
	$_SESSION['Step']="AppForm";
elseif (isset($_POST['AppSubmit']) && ($_POST['AppSubmit']=="Submit")){
	//Needs to Be removed from here
	$_SESSION['Step']="Print";
	$_SESSION['AppID']="ABCD";
	//Upto Here
	$_SESSION['PostData']=$_POST;
}
elseif (isset($_POST['AppSubmit']) && ($_POST['AppSubmit']=="Verified All Data Please Proceed")){
	$_SESSION['Step']="ShowData";
	$_SESSION['PostData']=$_POST;
}
elseif($_SESSION['Step']=="ShowData"){
	$Data=new DB();
	//$Data->do_ins_query("Insert Into ".MySQL_Pre."Applications(ResID,AppName,AppEmail,AppMobile");
	$_SESSION['AppID']="ZIFW";
	$Data->do_close();
	$_SESSION['Step']="Print";
}

?>