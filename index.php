<?php 
require_once( 'library.php'); 
initpage();
?>
<head>
<title>eRecruitment - Paschim Medinipur</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noarchive,noodp" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="description" content="Recruitment of staffs under Paschim Medinipur Judgeship"/>
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
<h2>eRecruitment Post Details</h2>
<p><b>Please Note:</b> <a href="http://paschimmedinipur.org">http://paschimmedinipur.org</a> is secondary website and can be visited for information whenever this website is not available due to technical reasons.</p>
<?php
	UniqueRandAlpha();
	$Data=new DB();
	$Qry="Select PostName,PostGroup,PayScale,Category,Fees,Vacancies From ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
			." Where P.PostID=R.PostID AND C.CatgID=R.CatgID";
	$Data->ShowTable($Qry);
	$Data->do_close();
?>
</div>
<div class="pageinfo"><?php pageinfo(); ?></div>
<div class="footer"><?php footerinfo();?></div>
</body>
</html>
