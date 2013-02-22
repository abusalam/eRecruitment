<?php 
require_once( '../library.php'); 
initpage();
?>
<head>
<meta name="robots" content="noarchive">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reply Helpline - Paschim Medinipur</title>
<style type="text/css" media="all" title="CSS By Abu Salam Parvez Alam" >
<!--
@import url("../css/Style.css");
-->
</style>
</head>
<body>
<div class="TopPanel">
 <div class="LeftPanelSide"></div>
 <div class="RightPanelSide"></div>
 <h1><?php echo AppTitle; ?></h1>
</div>
<div class="Header">
</div>
<?php 
require_once("../topmenu.php"); 
?>
<div class="content">
<h2>Helpline</h2>
<fieldset>
<h3>Reply Queries:</h3>
<?php
$Data=new DB();
if($_REQUEST['AdminUpload']=='1')
{
	?>
<form name="frmLogin" method="post" action="<?php $_SERVER['PHP_SELF']?>">
    <label for="ReplyTo">To:</label>
	<select name="ReplyTo">
      <?php 
		  $Query="SELECT HelpID,AppName FROM ".MySQL_Pre."Helpline where not Replied order by HelpID desc";
		  $Data->show_sel("HelpID","AppName",$Query,$_POST['ReplyTo']);
	  ?>
	</select>
	<b>Show in FAQ:</b><input type="radio" id="ShowFAQ" name="ShowFAQ" value="1"/><label for="ShowFAQ">Yes</label>
	<input type="radio" id="ShowFAQ" name="ShowFAQ" value="2"/><label for="ShowFAQ">No</label><br />
<label for="ReplyTxt">Reply:</label><br/>
<textarea id="ReplyTxt" name="ReplyTxt" rows="4" cols="80" maxlength="300"></textarea>
<input style="width:80px;" type="submit" value="Reply" />
</form>
<?php
}

if($_REQUEST['AdminUpload']=='1'){
	$Data->do_sel_query("Select 1;");
	if(($_POST['ReplyTo']!="") && ($_POST['ReplyTxt']!="")){
		$Query="Update ".MySQL_Pre."Helpline set Replied=".intval($_POST['ShowFAQ']).", ReplyTxt='".$Data->SqlSafe($_POST['ReplyTxt'])."' Where HelpID={$_POST['ReplyTo']}";
		$Data->do_ins_query($Query);
	}
	$Data->do_sel_query("Select * from ".MySQL_Pre."Helpline Where not Replied");
}
else
	$Data->do_sel_query("Select * from ".MySQL_Pre."Helpline where Replied");
while($row = $Data->get_row()){
	//'<a class="fb" id="ShowFeed'.$row['ID'].'" href="">'.$row['vname'].'</a>, '
	$ReplyTxt="<p>Reply : <i>&ldquo;".htmlspecialchars($row['ReplyTxt'])."&rdquo;</i></p>";
	echo '<hr /><b>'.$row['AppName'].'</b> Says: <div class="tdialog-modal" title="Queried by '.$row['AppName'].'">'
		.'<p><i>&ldquo;'.$row['TxtQry'].'&rdquo;</i></p>'
		.'<small>From IP: '.$row['IP'].' On: '.date("l d F Y g:i:s A ",strtotime($row['QryTime'])).' IST </small>'
		.$ReplyTxt.'</div>';
	if($_REQUEST['AdminUpload']=='1')
		echo "<br/>".$row['AppEmail']."] Replied On: ".date("l d F Y g:i:s A ",strtotime($row['ReplyTime']));
}
?>
</fieldset>
</div>
<?php
require_once("../bottommenu.php");
?>
<div class="pageinfo">
 <?php pageinfo(); ?>
</div>
<div class="footer">
 <?php footerinfo();?>
</div>
</body>
</html>
