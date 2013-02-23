<?php
if(!isset($_SESSION['Step'])){
	$_SESSION['Step']="Init";
}
elseif (isset($_POST['InsTerm']) && ($_POST['InsTerm']=="1") && ($_SESSION['Step']=="Init"))
	$_SESSION['Step']="AppForm";
elseif (isset($_POST['ChkDeclr']) && ($_POST['ChkDeclr']=="1") && ($_SESSION['Step']=="AppForm")){
	$_SESSION['Step']="VerifyData";
	$_SESSION['PostData']=InpSanitize($_POST);
}
elseif (isset($_POST['CmdVerify']) && ($_POST['CmdVerify']=="Verified All Data Please Proceed") && ($_SESSION['Step']=="VerifyData")){
	$Data=new DB();
	$Qry="Insert Into ".MySQL_Pre."Applications(`ResID`, `AppName`, `AppEmail`, `AppMobile`, `GuardianName`, `DOB`, `Sex`, `Nationality`,"
			." `Religion`, `PreAddr`, `PrePinCode`, `PermAddr1`, `PermPinCode`, `BelongsFrom`, `PhyHand`, `Qualification`, `ComKnowledge`,"
			." `OrdTyping`, `Shorthand`, `GovServent`,`AppOQ`,`Status`,`SessionID`,`FiledOn`) "
		."Values({$_SESSION['PostData']['AppPostID']},'{$_SESSION['PostData']['AppName']}','{$_SESSION['PostData']['AppEmail']}',"
			."'{$_SESSION['PostData']['AppMobile']}','{$_SESSION['PostData']['GuardianName']}','{$_SESSION['PostData']['AppDOB']}',"
			."'{$_SESSION['PostData']['AppSex']}','{$_SESSION['PostData']['AppNation']}','{$_SESSION['PostData']['AppRel']}',"
			."'{$_SESSION['PostData']['AppPreA']}','{$_SESSION['PostData']['AppPrePin']}','{$_SESSION['PostData']['AppPerA']}',"
			."'{$_SESSION['PostData']['AppPerPin']}','{$_SESSION['PostData']['AppCaste']}','{$_SESSION['PostData']['AppPH']}',"
			."'{$_SESSION['PostData']['AppQlf']}','{$_SESSION['PostData']['AppCS']}','{$_SESSION['PostData']['AppOT']}',"
			."'{$_SESSION['PostData']['AppSH']}','{$_SESSION['PostData']['AppGS']}','{$_SESSION['PostData']['AppOQ']}',"
			."'Waiting for Bank Confirmation','".session_id()."',CURRENT_TIMESTAMP)";
	$Inserted=$Data->do_ins_query($Qry);
	$AppID=mysql_insert_id($Data->conn);
	$_SESSION['AppID']=$Data->do_max_query("Select AppID from ".MySQL_Pre."AppIDs where AppSlNo={$AppID}");
	$Data->do_close();
	$_SESSION['Qry']=$Qry."[{$AppID}]-{$_SESSION['AppID']}";
	if($Inserted>0){
		$_SESSION['Msg']="<b>Message:</b> Your Application ID: {$_SESSION['AppID']}";
		$_SESSION['Step']="Print";
	}
	else{
		$_SESSION['Msg']="<b>Message:</b> Unable to submit your Application.";
		$_SESSION['Step']="AppForm";
	}
	
}
if($_POST['CmdPrint']=="Search"){
	$Data=new DB();
	$_SESSION['AppID']=$Data->SqlSafe(htmlspecialchars($_POST['AppID']));
	$Query="Select AppName,AppMobile,Fees,DOB,FiledOn from ".MySQL_Pre."Applications A,".MySQL_Pre."Reserved R,".MySQL_Pre."AppIDs P "
			."Where A.ResID=R.ResID AND P.AppSlNo=A.AppID AND P.AppID='{$_SESSION['AppID']}' AND AppMobile='".$Data->SqlSafe(htmlspecialchars($_POST['AppMobile']))."'";
	$Found=$Data->do_sel_query($Query);
	if($Found>0){
		$Row=$Data->get_row();
		$_SESSION['Msg']="<b>Message:</b>Applicant: {$Row['AppName']}, Mobile:{$Row['AppMobile']}, Date of Birth: ".date("d/m/Y",strtotime($Row['DOB'])).".";
		$_SESSION['Step']="Print";
	}
	else{
		$_SESSION['Msg']="<b>Message:</b>Application not found!";
		$_SESSION['Step']="Init";
	}
}
?>