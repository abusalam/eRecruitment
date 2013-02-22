<?php 
require_once( 'library.php'); 
initpage();
?>
<head>
<title>eRecruitment Application Status - Paschim Medinipur</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noarchive,noodp" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="description" content="Online application for recruitment of different posts in Paschim Medinipur"/>
<style type="text/css" media="all">
<!--
@import url("css/Style.css");
-->
</style>
</head>
<body>
<div class="TopPanel">
 <div class="LeftPanelSide"></div>
 <div class="RightPanelSide"></div>
 <h1><?php echo AppTitle;?></h1>
</div>
<div class="Header">
</div>
<?php 
	require_once("topmenu.php");
?>
<div class="content">
<h2>eRecruitment Application Status [Will be available soon]</h2>
<span class="Notice">
<b>Please Note: </b>Current Status of your application will be shown here.
</span>
<h3>Admits can also be downloaded from here once your application is accepted.</h3>
<?php 
$Data=new DB();
$Qry="Select A.AppID as SlNo,AppName,GuardianName,Sex,FiledOn,ID.AppID as `Applicant ID` From ".MySQL_Pre."Applications A,".MySQL_Pre."AppIDs ID Where A.AppID=ID.AppSlNo Order by A.AppID desc Limit 10";
$Data->ShowTable($Qry);
echo "<br/><p>Count: ".$Data->do_max_query("Select count(*) from ".MySQL_Pre."AppIDs")."</p>";
$Data->do_close();
?>
</div>
<div class="pageinfo"><?php pageinfo(); ?></div>
<div class="footer"><?php footerinfo();?></div>
</body>
</html>
