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
		<span class="Notice"><b>Please Note: </b>All Applicants are requested not to submit the online application more than once. We are getting a lot of queries so it will take some time to resolve the issues. Please bear with us.</span>
		<?php 
		include("../../captcha/securimage.php");
		if($_POST['SendQry']=="Send Us Your Query")
			require_once("contact.php");
		else
		{
			?>
		<form method="post">
			<h3>Have some doubt!</h3>
			<p><b>Feel free to:</b><input name="SendQry" type="submit" value="Send Us Your Query" /></p>
		</form>
		<fieldset>
			<h3>Frequently Asked Questions:</h3>
			<?php
			$Data=new DB();
			$Data->do_sel_query("Select * from ".MySQL_Pre."Helpline where Replied=1");
			while($row = $Data->get_row())
			{
				//'<a class="fb" id="ShowFeed'.$row['ID'].'" href="">'.$row['vname'].'</a>, '
				$ReplyTxt="<p><b>Reply:</b> <i>&ldquo;".htmlspecialchars($row['ReplyTxt'])."&rdquo;</i></p>";
				echo '<hr /><b>'.htmlspecialchars($row['AppName']).'</b> Says: <div class="tdialog-modal" title="Asked by '.htmlspecialchars($row['AppName']).'">'
					.'<p><i>&ldquo;'.htmlspecialchars($row['TxtQry']).'&rdquo;</i></p>'
			.'<small>From IP: '.$row['IP'].' On: '.date("l d F Y g:i:s A ",strtotime($row['QryTime'])).' IST </small>'
			.$ReplyTxt.'</div>';
			}
			?>
		</fieldset>
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
