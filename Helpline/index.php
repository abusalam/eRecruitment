<?php
//ini_set('display_errors','On');
require_once( '../library.php');
initpage();
?>
<head>
<title>Helpline - Paschim Medinipur</title>
<meta name="robots" content="noarchive,noodp">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css" media="all" title="CSS By Abu Salam Parvez Alam">
<!--
@import url("../css/Style.css");
-->
</style>
</head>
<body>
	<div class="TopPanel">
		<div class="LeftPanelSide"></div>
		<div class="RightPanelSide"></div>
		<h1><?php echo AppTitle;?></h1>
	</div>
	<div class="Header"></div>
	<?php 
	require_once("../topmenu.php");
	?>
	<div class="content">
		<h2>Helpline</h2>
		<?php 
		include("../../captcha/securimage.php");
		if(($_POST['SendQry']=="Send Us Your Query") |($_SESSION['SendQry']=="1")){
			$_SESSION['SendQry']="1";
			require_once("contact.php");		
		}	
		else
		{
			?>
			<span class="Notice"><b>Please Note: </b>All Applicants are requested not to submit the online application more than once. We are getting a lot of queries so it will take some time to resolve the issues. Please bear with us.</span>
		<form method="post">
		<div class="FieldGroup">
			<h3>Have some doubt!</h3>
			<b>Feel free to:</b><input name="SendQry" type="submit" value="Send Us Your Query" />
			</div>
		</form>
		<div style="clear:both;"></div>
		<br/>
			<h2>Frequently Asked Questions:</h2>
			<?php
			$Data=new DB();
			$Data->do_sel_query("Select * from ".MySQL_Pre."Helpline where Replied=1");
			while($row = $Data->get_row())
			{
			?>
				<hr />
				<div class="Notice">
				<b><?php echo htmlspecialchars($row['AppName']);?>:</b><br/>
				<?php echo str_replace("\r\n","<br />",$row['TxtQry']); ?><br/>
					<small><i><?php echo "From IP: {$row['IP']} On: ".date("l d F Y g:i:s A ",strtotime($row['QryTime']));?></i></small>
				</div>
				<div class="Notice">
					<b>Reply:</b><p><i>&ldquo;<?php echo str_replace("\r\n","<br />",$row['ReplyTxt']);?>&rdquo;</i></p>
				</div>
			<?php 
			}
			?>
		<div style="clear:both;"></div>
		<?php
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
