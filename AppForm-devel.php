<?php
ini_set('display_errors','On');
require_once( 'library.php');
if($_POST['AppSubmit']=="Print Challan")
{
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
<script>
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
			<?php echo AppTitle;?>
		</h1>
	</div>
	<div class="Header"></div>
	<?php 
	require_once("topmenu.php");
	?>
	<div class="content">
		<?php
		require_once 'AppFormData.php';
		switch ($_SESSION['Step'])
		{
			case 0:
				?>
		<h2>eRecruitment Application</h2>
		<p>
			<b>Please Note: </b><a href="http://paschimmedinipur.org">http://paschimmedinipur.org</a>
			is secondary website and can be visited for information whenever this
			website is not available due to technical reasons.
		</p>
		<?php 
		$Data=new DB();
		$Qry="Select PostName,PostGroup,PayScale,Category,Fees,Vacancies From ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
			." Where P.PostID=R.PostID AND C.CatgID=R.CatgID";
		$Data->ShowTable($Qry);
		$Data->do_close();
		?>
		<form method="post">
			<input name="InsTerm" type="checkbox" value="1" /> <label
				for="InsTerm">I have read carefully and understood the instructions.</label>
			<input type="submit" value="Proceed" />
		</form>
		<?php 
		break;
case 1:
	?>
		<form method="post">
			<h3>Post Applied For</h3>
			<?php 
			$Data=new DB();
			echo '<select name="AppPostID">';
			$Data->show_sel("ResID","ResName","select ResID,CONCAT(PostName,' [',PostGroup,']-',Category) as ResName"
					." from ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
					." Where P.PostID=R.PostID AND C.CatgID=R.CatgID Order by ResID");
	echo '</select><br/>';
	?>
			<h3>Applicant Name:</h3>
			<input type="text" name="AppName" />
			<h3>Date of Birth:</h3>
			<input class="datepick" type="text" name="AppDOB" />
			<h3>E-Mail Address:</h3>
			<input type="text" name="AppEmail" />
			<h3>Mobile No:</h3>
			<input type="text" name="AppMobile" maxlength="10" /> <input
				type="submit" value="Submit" name="AppSubmit" />
		</form>
		<?php 
		$Data->do_close();
		break;
case 2:
	?>
		<form method="post">
			<b>Post Applied For</b>
			<?php
			$Data=new DB();
			echo $Data->do_max_query("select CONCAT(PostName,' [',PostGroup,']-',Category) as ResName"
			." from ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
			." Where P.PostID=R.PostID AND C.CatgID=R.CatgID AND ResID=".$Data->SqlSafe($_SESSION['PostData']['AppPostID']));
	echo '<br/>';
	?>
			<b>Applicant Name:</b>
			<?php echo htmlspecialchars($_SESSION['PostData']['AppName']);?>
			<br /> <b>Date of Birth:</b>
			<?php echo htmlspecialchars($_SESSION['PostData']['AppDOB']); ?>
			<br /> <b>E-Mail Address:</b>
			<?php echo htmlspecialchars($_SESSION['PostData']['AppEmail']);?>
			<br /> <b>Mobile No:</b>
			<?php echo htmlspecialchars($_SESSION['PostData']['AppMobile']);?>
			<br /> <input type="submit" value="Print Challan" name="AppSubmit" />
		</form>
		<?php 
		$Data->do_close();
		break;
		}
		?>
	</div>
	<div class="pageinfo">
		<?php pageinfo(); ?>
	</div>
	<div class="footer">
		<?php footerinfo();?>
	</div>
</body>
</html>
