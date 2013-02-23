<?php
function UniqueRandAlpha(){
	$Data=new DB();
	for($i=0;$i<5;$i++)	{
		$AppID=RandStr(4);
		$S=str_split($AppID);
		$Exists=$Data->do_max_query("Select count(*) from ".MySQL_Pre."AppIDs Where AppID='".$AppID."'");
		while ($Exists>0) {
			$AppID=RandStr(4);
		}
		$Data->do_ins_query("Insert into ".MySQL_Pre."AppIDs(AppID) Values('".$AppID."')");
	}
	$Data->do_close();
}
function RsInWords($Amount)
{
	switch($Amount){
		case 200:
			return "Two Hundred Only";
			break;
		case 100:
			return "One Hundred Only";
			break;
		case 50:
			return "Fifty Only";
			break;
		case 25:
			return "Twenty Five Only";
			break;
		default:
			return "Sum of Amount Only";
	}
}
function InpSanitize($PostData){
	$Fields="";
	$Data=new DB();
	foreach ($PostData as $FieldName => &$Value){
		$Value=$Data->SqlSafe($Value);
		//$Fields=$Fields."<br />".$FieldName;
		if(($Value=="") ||(count($PostData)<23)){
			$_SESSION['Msg']="<b>Message:</b> Some Fields left unfilled.";
			$_SESSION['Step']="AppForm";
		}
	}
	unset($Value);
	//$PostData['Fields']=$Fields;
	//echo "Total Fields:".count($PostData);
	return $PostData;
}
function ShowMsg(){
	if($_SESSION['Msg']!=""){
		echo '<span class="Message">'.$_SESSION['Msg'].'</span><br/>';
		$_SESSION['Msg']="";
	}
}
?>