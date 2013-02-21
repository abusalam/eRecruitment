<?php
if(!isset($_SESSION['Step'])){
	$_SESSION['Step']="Init";
	$_SESSION['DB']=0;
}
elseif (isset($_POST['InsTerm']) && ($_POST['InsTerm']=="1"))
	$_SESSION['Step']="AppForm";
elseif (isset($_POST['ChkDeclr']) && ($_POST['ChkDeclr']=="1")){
	$_SESSION['Step']="ShowData";
	$_SESSION['PostData']=InpSanitize($_POST);
}
elseif (isset($_POST['AppSubmit']) && ($_POST['AppSubmit']=="Verified All Data Please Proceed")){
	$_SESSION['Step']="VerifyData";
}
elseif($_SESSION['Step']=="VerifyData"){
	$Data=new DB();
	$Qry="Insert Into ".MySQL_Pre."Applications(`ResID`, `AppName`, `AppEmail`, `AppMobile`, `GuardianName`, `DOB`, `Sex`, `Nationality`,"
			." `Religion`, `PreAddr`, `PrePinCode`, `PermAddr1`, `PermPinCode`, `BelongsFrom`, `PhyHand`, `Qualification`, `ComKnowledge`,"
			." `OrdTyping`, `Shorthand`, `GovServent`,`AppOQ`,`Status`) "
		."Values({$_SESSION['PostData']['AppPostID']},'{$_SESSION['PostData']['AppName']}','{$_SESSION['PostData']['AppEmail']}',"
			."'{$_SESSION['PostData']['AppMobile']}','{$_SESSION['PostData']['GuardianName']}','{$_SESSION['PostData']['AppDOB']}',"
			."'{$_SESSION['PostData']['AppSex']}','{$_SESSION['PostData']['AppNation']}','{$_SESSION['PostData']['AppRel']}',"
			."'{$_SESSION['PostData']['AppPreA']}','{$_SESSION['PostData']['AppPrePin']}','{$_SESSION['PostData']['AppPerA']}',"
			."'{$_SESSION['PostData']['AppPerPin']}','{$_SESSION['PostData']['AppCaste']}','{$_SESSION['PostData']['AppPH']}',"
			."'{$_SESSION['PostData']['AppQlf']}','{$_SESSION['PostData']['AppCS']}','{$_SESSION['PostData']['AppOT']}',"
			."'{$_SESSION['PostData']['AppSH']}','{$_SESSION['PostData']['AppGS']}','{$_SESSION['PostData']['AppOQ']}','Waiting for Bank Confirmation')";
	$Data->do_ins_query($Qry);
	$AppID=mysql_insert_id($Data->conn);
	$_SESSION['AppID']=$Data->do_max_query("Select AppID from ".MySQL_Pre."AppIDs where AppSlNo={$AppID}");
	$Data->do_close();
	$_SESSION['Qry']=$Qry."[{$AppID}]-{$_SESSION['AppID']}";
}

?>