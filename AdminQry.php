<?php
ini_set('display_errors','On');
require_once( 'library.php');
initpage();
?>
<head>
<title>eRecruitment Admin - Paschim Medinipur</title>
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
		<h2>eRecruitment Admin</h2>
		<?php
		if(isset($_SESSION['ShowQry']) && ($_SESSION['ShowQry']==6)){?>
		<form method="post"
			action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<div class="FieldGroup">
				<label for="ME"><input type="checkbox" name="ME" id="ME" value="6" />Show
					Query</label>
				<textarea rows="5" cols="80" name="TxtQuery">
					<?php echo isset($_SESSION['Qry'])?$_SESSION['Qry']:"";?>
				</textarea>
				<input type="submit" value="Sumit Query" name="CmdPrint" />
			</div>
			<div style="clear: both;"></div>
		</form>
		<?php
		}
		$From=(isset($_REQUEST['S']))?intval($_REQUEST['S']):0;
		$Rec=(isset($_REQUEST['E']))?intval($_REQUEST['E']):10;
		$ShowQry=$_SESSION['ShowQry']=(isset($_REQUEST['ME']) && ($_REQUEST['ME']=="6"))?TRUE:FALSE;
		$Qry="Select A.AppID as SlNo, ID.AppID as `Applicant ID`, AppName, GuardianName, Sex, FiledOn From ".MySQL_Pre."Applications A, ".MySQL_Pre."AppIDs ID Where A.AppID=ID.AppSlNo Order by A.AppID desc Limit {$From},{$Rec}";
		if($ShowQry){
			if(isset($_POST['TxtQuery']) && ($_POST['TxtQuery'])!=""){
				$_SESSION['Qry']=$Qry=$_POST['TxtQuery'];
			}
		}
		else{
			$_SESSION['Qry']=$Qry;			
		}
		$Data=new DB();
		$Data->Debug=1;
		$Data->ShowTable($Qry);
		$Data->do_close();
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
