<?php
//ini_set('display_errors','On');
require_once('library.php');
if (GetVal($_POST, 'CmdPrint') == "Print Challan") {
	session_start();
	include_once 'ShowPDF.php';
}
else
	initpage();
?>
<head>
<title>Application Form - Paschim Medinipur</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noarchive,noodp" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="description"
	content="Online application for recruitment of different posts in Paschim Medinipur" />
<style type="text/css" media="all">
<!--
@import url("css/Style.css");
-->
</style>
<link type="text/css" href="css/ui-darkness/jquery-ui-1.8.21.custom.css"
	rel="Stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">
$(function() {
	$( ".datepick" ).datepicker({minDate: "-43Y", 
								maxDate: "-18Y",
								dateFormat: 'yy-mm-dd',
								showOtherMonths: true,
								selectOtherMonths: true,
								showButtonPanel: true,
								changeMonth: true,
							    changeYear: true,
								showAnim: "slideDown"
								});
});
</script>
</head>
<body>
	<div class="TopPanel">
		<div class="LeftPanelSide"></div>
		<div class="RightPanelSide"></div>
		<h1>
			<?php echo AppTitle; ?>
		</h1>
	</div>
	<div class="Header"></div>
	<?php
require_once("topmenu.php");
?>
	<div class="content">
		<?php
require_once 'AppFormData.php';
switch ($_SESSION['Step']) {
	case "Init":
		include 'AppInit.php';
		break;
	case "AppForm":
		include 'AppFromSubmit.php';
		break;
	case "VerifyData":
		include 'VerifyAppData.php';
		break;
	case "Print":
		include 'AppChallanPrintForm.php';
		break;
}
//$Data=new DB();
//echo "<br/><p>Count: ".$Data->do_max_query("Select count(*) from ".MySQL_Pre."AppIDs")."</p>";
//$Data->do_close();
//echo $_SESSION['Step']."<br/>".$_SESSION['Qry'].$_SESSION['PostData']['Fields'];
?>
	</div>
	<div class="pageinfo">
		<?php pageinfo(); ?>
	</div>
	<div class="footer">
		<?php footerinfo(); ?>
	</div>
</body>
</html>
