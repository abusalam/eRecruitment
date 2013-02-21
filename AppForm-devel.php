<?php
//ini_set('display_errors','On');
require_once( 'library.php');
if(isset($_POST['CmdPrint']) && ($_POST['CmdPrint']=="Print Challan"))
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
			<?php echo AppTitle;?>
		</h1>
	</div>
	<div class="Header"></div>
	<?php 
	require_once("topmenu.php");
	?>
	<div class="content">
		<?php
		$Data=new DB();
		echo "Count: ".$Data->do_max_query("Select count(*) from ".MySQL_Pre."AppIDs");
		$Data->do_close();
		require_once 'AppFormData-devel.php';
		switch ($_SESSION['Step']){
			case "Init":
				?>
				<h2>eRecruitment Application [For Testing Only]</h2>
				<p>
					<b>Please Note: </b><a href="http://paschimmedinipur.org">http://paschimmedinipur.org</a>
					is secondary website and can be visited for information whenever this
					website is not available due to technical reasons.
				</p>
				<ol>
				<li>Some Instructions</li>
				<li>Some Instructions</li>
				<li>Some Instructions</li>
				<li>Some Instructions</li>
				<li>Some Instructions</li>
				</ol>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div><input id="InsTerm" name="InsTerm" type="checkbox" value="1" /> <label
						for="InsTerm">I have read carefully and understood the instructions.</label>
					<input type="submit" value="Proceed" />
				</div>	
				</form>
				<?php 
				break;
			case "AppForm":
				?>
				<h2>eRecruitment Application Form [For Testing Only]</h2>
				<p>
					<b>Please Note: </b>All fields are mandatory. No modifications will be allowed after submission of this form.
				</p>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div class="FieldGroup">
						<h3>Post Applied For</h3>
						<select name="AppPostID">
						<?php 
						$Data=new DB();
						$Data->show_sel("ResID","ResName","select ResID,CONCAT(PostName,' [',PostGroup,']-',Category) as ResName"
								." from ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
								." Where P.PostID=R.PostID AND C.CatgID=R.CatgID Order by ResID"); ?>
						</select>
					</div>
					<div class="FieldGroup">
					<h3>E-Mail Address:</h3>
						<input type="text" name="AppEmail" />
					</div>
					<div class="FieldGroup">
						<h3>Mobile No:</h3>
						<input type="text" name="AppMobile" maxlength="10" />
					</div>
					<div class="FieldGroup">
						<h3>Educational Qualification:</h3>
						<input type="text" name="AppQlf" maxlength="50" />
					</div>
					<div style="clear:both;"></div>
					<hr />
					<div class="FieldGroup">
						<h3>Applicant Name:</h3>
						<input type="text" name="AppName" />
						<h3>Name of the Father/Husband:</h3>
						<input type="text" name="GuardianName" />
						<h3>Date of Birth:</h3>
						<input class="datepick" type="text" name="AppDOB" />
						<h3>Sex (Male/Female):</h3>
						<label><input type="radio" name="AppSex" Value="M">Male</label> <label><input
							type="radio" name="AppSex" Value="F">Female</label>
						<h3>Religion:</h3>
							<input type="text" name="AppRel" />
						<h3>Caste:</h3>
							<label><input type="radio" name="AppCaste" Value="Gen">General</label>
							<label><input type="radio" name="AppCaste" Value="SC">SC</label>
							<label><input type="radio" name="AppCaste" Value="ST">ST</label>
							<label><input type="radio" name="AppCaste" Value="OBC">OBC</label>
						<h3>Nationality:</h3>
							<input type="text" name="AppNation" />
					</div>
					<div class="FieldGroup">
						<h3>Present Address:</h3>
							<textarea rows="5" name="AppPreA"></textarea>
						<h3>Pincode:</h3>
							<input type="text" name="AppPrePin" />
						<h3>Permanent Address:</h3>
							<textarea rows="5" name="AppPerA"></textarea>
						<h3>Pincode:</h3>
							<input type="text" name="AppPerPin" />
					</div>
					<div class="FieldGroup">
						<h3>Physically Handicapped:</h3>
							<label><input type="radio" name="AppPH" Value="1">Yes</label>
							<label><input type="radio" name="AppPH" Value="0">No</label>
						<br/><br/>
						<h3>Have you any Knowledge in Computer?</h3>
							<label><input type="radio" name="AppCS" Value="1">Yes</label>
							<label><input type="radio" name="AppCS" Value="0">No</label>
						<br/><br/>
						<h3>Do you know ordinary Type-Writing?</h3>
							<label><input type="radio" name="AppOT" Value="1">Yes</label>
							<label><input type="radio" name="AppOT" Value="0">No</label>
						<br/><br/>
						<h3>Do you know Shorthand (English/Bengali)?</h3>
							<label><input type="radio" name="AppSH" Value="1">Yes</label>
							<label><input type="radio" name="AppSH" Value="0">No</label>
						<br/><br/>
						<h3>Are you a Govt. Servant?</h3>
							<label><input type="radio" name="AppGS" Value="1">Yes</label>
							<label><input type="radio" name="AppGS" Value="0">No</label>
						<br/><br/>
						<h3>Do you have any Other Qualifications:</h3>
							<label><input type="radio" name="AppOQ" Value="1">Yes</label>
							<label><input type="radio" name="AppOQ" Value="0">No</label>
					</div>
					<div style="clear:both;"></div>
					<div class="FieldGroup">
					<h3>Declaration</h3>
						<p><input name="ChkDeclr" type="checkbox" value="1" /> <label
						for="ChkDecl">I, hereby declare that</label><br/>
							(A) All statesment made in this application are true, complete and correct to the best of knowledge and belief.
						</p><br/>
						<input type="submit" value="Submit" name="AppSubmit" />
					</div>
					<div style="clear:both;"></div>
				</form>
				<?php 
				$Data->do_close();
				break;
			case "ShowData":
			case "VerifyData":
					?>
					<h2>eRecruitment Application Form Verification [For Testing Only]</h2>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div>
					<div class="FieldLabel">Post Applied For:</div>
					<span class="ShowField"><?php
					$Data=new DB();
					echo $Data->do_max_query("select CONCAT(PostName,' [',PostGroup,']-',Category) as ResName"
					." from ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
					." Where P.PostID=R.PostID AND C.CatgID=R.CatgID AND ResID=".$Data->SqlSafe($_SESSION['PostData']['AppPostID']));
					?></span><br/>
					<div class="FieldLabel">Applicant Name:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppName'];?></span><br/>
					<div class="FieldLabel">Date of Birth:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppDOB']; ?></span><br/>
					<div class="FieldLabel">E-Mail Address:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppEmail'];?></span><br/>
					<div class="FieldLabel">Mobile No:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppMobile'];?></span><br/>
					<div class="FieldLabel">Sex(Male/Female):</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppSex'];?></span><br/>
					<div class="FieldLabel">Religion:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppRel'];?></span><br/>
					<div class="FieldLabel">Caste:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppCaste'];?></span><br/>
					<div class="FieldLabel">Nationality:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppNation'];?></span><br/>
					<div class="FieldLabel">Present Address:</div>
					<pre><span class="ShowField"><?php echo str_replace("\\r\\n","\r\n",$_SESSION['PostData']['AppPreA']);?></span></pre><br/>
					<div class="FieldLabel">Pincode:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppPrePin'];?></span><br/>
					<div class="FieldLabel">Permanent Address:</div>
					<pre><span class="ShowField"><?php echo str_replace("\\r\\n","\r\n",$_SESSION['PostData']['AppPerA']);?></span></pre><br/>
					<div class="FieldLabel">Pincode:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppPerPin'];?></span><br/>
					<div class="<?php echo ($_SESSION['PostData']['AppPH'])?"CheckYes":"CheckNo";?>">Are you Physically Challanged?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppCS'])?"CheckYes":"CheckNo";?>">Have you any Knowledge in Computer?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppOT'])?"CheckYes":"CheckNo";?>">Do you know ordinary Type-Writing?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppSH'])?"CheckYes":"CheckNo";?>">Do you know Shorthand (English/Bengali)?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppGS'])?"CheckYes":"CheckNo";?>">Are you a Govt. Servant?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppOQ'])?"CheckYes":"CheckNo";?>">Do you have any Other Qualifications?</div>
					<br /> <input type="submit" value="<?php echo ($_SESSION['Step']=="ShowData")?"Verified All Data Please Proceed":"Print Challan"; ?>" name="AppSubmit" />
					</div>
					</form>
				<?php 
				$Data->do_close();
				break;
			case "Print":
				?>
				<h2>eRecruitment Application Form [For Testing Only]</h2>
				<p>
					<b>Please Note: </b>Make sure that the Application ID is entered by the operator at Bank counter Instead of Applicant Name.
				</p>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" target="_blank">
				<div>
					<input type="submit" value="Print Challan" name="CmdPrint" />
				</div>
				</form>
				<?php 
				break;
		}
		//echo $_SESSION['Step']."<br/>".$_SESSION['Qry'].$_SESSION['PostData']['Fields'];
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
