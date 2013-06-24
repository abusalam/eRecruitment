<?php
//ini_set('display_errors','On');
require_once( 'library.php');
if(GetVal($_POST,'CmdPrint')=="Print Challan")
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
	$( ".datepick" ).datepicker({yearRange: '1969:1995',
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
		switch ($_SESSION['Step']){
			case "Init":
				?>
				<h2>eRecruitment Application</h2>
				<span class="Notice"><b>Important: </b>Do not submit the application more than once. In case of any problem use the Helpline.</span>
				<ol>
				<li>The appointment will initially be made on a purely temporary basis but is likely to be made permanent for all categories of posts.</li>
				<li>In case of  candidates serving under Government. Applicant must have obtained <b>&ldquo;No Objection Certificate(NOC)&rdquo;</b> from Appointing Authority in writing.</li>
				<li><b>Essential Qualification:</b> In respect of Groups: For all posts in Group-B &amp; C categories, the Candidate must  have passed Madhyamik or equivalent examination from any recognized Board and a Certificate in Computer Training from a recognized Institution and a satisfactory fingering speed in Computer operation.</li>
				<li><b>In case of Process Server/Group-D category:</b> The candidate must have class VIII passed certificate from any recognized School or recognized Madrasah or any other recognized equivalent institution. </li>
				<li><b>Eligibility Age:</b> Not less than 18 years and not more than 40 years as on 1st January, 2013 for all categories of posts. Relaxation of age limit for five years in case of candidates SC/ST category and for 3 years in case of candidates of OBC Category only. The upper age limit, in case of Physically Handicapped Candidate, is 43 years. Relaxation of age limit in case of Exserviceman Category as per existing government Rules.</li>
				</ol>
<?php include 'AppSteps.php';?>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="FieldLabel">
					<label for="InsTerm">
					<input id="InsTerm" name="InsTerm" type="checkbox" value="1" /> 
					<b>I have read carefully and understood the instructions.</b>
					</label>
					<input type="submit" value="Proceed" />
				</div>	
				</form>
				<?php 
				break;
			case "AppForm":
				/*
				?>
				<h2>eRecruitment Application Form</h2>
				<?php ShowMsg(); ?>
				<span class="Notice"><b>Please Note: </b>All fields are mandatory. No modifications will be allowed after submission of this form.</span>
				<hr />
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
						<input type="text" name="AppEmail"  maxlength="50" />
					</div>
					<div class="FieldGroup">
						<h3>Mobile No:</h3>
						<input type="text" name="AppMobile" maxlength="10" />
					</div>
					<div class="FieldGroup">
						<h3>Educational Qualification:</h3>
						<input type="text" name="AppQlf" size="40" maxlength="80" />
					</div>
					<div style="clear:both;"></div>
					<hr />
					<div class="FieldGroup">
						<h3>Applicant Name:</h3>
						<input type="text" name="AppName" size="35" maxlength="50" />
						<h3>Name of the Father/Husband:</h3>
						<input type="text" name="GuardianName" size="35" maxlength="50" />
						<h3>Date of Birth:</h3>
						<input class="datepick" type="text" size="10" name="AppDOB" />
						<h3>Sex (Male/Female):</h3>
						<label><input type="radio" name="AppSex" value="M"/>Male</label> <label><input
							type="radio" name="AppSex" value="F"/>Female</label>
						<h3>Religion:</h3>
							<input type="text" name="AppRel"  size="20" maxlength="20" />
						<h3>Caste:</h3>
							<label><input type="radio" name="AppCaste" value="Gen"/>General</label>
							<label><input type="radio" name="AppCaste" value="SC"/>SC</label>
							<label><input type="radio" name="AppCaste" value="ST"/>ST</label>
							<label><input type="radio" name="AppCaste" value="OBC"/>OBC</label>
						<h3>Nationality:</h3>
							<input type="text" name="AppNation" size="10" maxlength="10" />
					</div>
					<div class="FieldGroup">
						<h3>Present Address:</h3>
							<textarea rows="5" cols="30" name="AppPreA" maxlength="100"></textarea>
						<h3>Pincode:</h3>
							<input type="text" name="AppPrePin" size="6" maxlength="6" />
						<h3>Permanent Address:</h3>
							<textarea rows="5" cols="30" name="AppPerA" maxlength="100"></textarea>
						<h3>Pincode:</h3>
							<input type="text" name="AppPerPin" size="6" maxlength="6" />
					</div>
					<div class="FieldGroup">
						<h3>Are you physically challenged?</h3>
						<div class="RadioGroup">
							<label><input type="radio" name="AppPH" value="1"/>Yes</label>
							<label><input type="radio" name="AppPH" value="0"/>No</label>
						</div>
						<h3>Have you any Knowledge in Computer?</h3>
						<div class="RadioGroup">
							<label><input type="radio" name="AppCS" value="1"/>Yes</label>
							<label><input type="radio" name="AppCS" value="0"/>No</label>
						</div>
						<h3>Do you know ordinary Type-Writing?</h3>
						<div class="RadioGroup">
							<label><input type="radio" name="AppOT" value="1"/>Yes</label>
							<label><input type="radio" name="AppOT" value="0"/>No</label>
						</div>
						<h3>Do you know Shorthand (English/Bengali)?</h3>
						<div class="RadioGroup">
							<label><input type="radio" name="AppSH" value="1"/>Yes</label>
							<label><input type="radio" name="AppSH" value="0"/>No</label>
						</div>
						<h3>Are you a Government Servant?</h3>
						<div class="RadioGroup">
							<label><input type="radio" name="AppGS" value="1"/>Yes</label>
							<label><input type="radio" name="AppGS" value="0"/>No</label>
						</div>
						<h3>Do you have any Other Qualifications:</h3>
						<div class="RadioGroup">
							<label><input type="radio" name="AppOQ" value="1"/>Yes</label>
							<label><input type="radio" name="AppOQ" value="0"/>No</label>
						</div>
					</div>
					<div style="clear:both;"></div>
					<hr/>
					<h3>Declaration</h3>
						<b>I, hereby declare that,</b>
						<p><label for="ChkDecl"><input id="ChkDeclr" name="ChkDeclr" type="checkbox" value="1" /> 
							All statesment made in this application are true, complete and correct to the best of knowledge and belief and in the event of any information being found false, my candidature is liable to be canceled.</label>
						</p><br/>
						<input type="submit" value="Submit" name="AppSubmit" />
					<div style="clear:both;"></div>
				</form>
				<?php 
				$Data->do_close();*/
				echo "<h2>Last Date of online Application is over.</h2>";
				break;
			case "VerifyData":
					?>
					<h2>eRecruitment Application Form Verification</h2>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
					<div class="FieldGroup">
					<div class="FieldLabel">Post Applied For:</div>
					<span class="ShowField"><?php
					$Data=new DB();
					echo $Data->do_max_query("select CONCAT(PostName,' [',PostGroup,']-',Category) as ResName"
					." from ".MySQL_Pre."Posts P,".MySQL_Pre."Categories C,".MySQL_Pre."Reserved R"
					." Where P.PostID=R.PostID AND C.CatgID=R.CatgID AND ResID=".$Data->SqlSafe($_SESSION['PostData']['AppPostID']));
					?></span>
					</div>
					<div class="FieldGroup">
						<div class="FieldLabel">E-Mail Address:</div>
						<span class="ShowField"><?php echo $_SESSION['PostData']['AppEmail'];?></span>
					</div>
					<div class="FieldGroup">
						<div class="FieldLabel">Mobile No:</div>
						<span class="ShowField"><?php echo $_SESSION['PostData']['AppMobile'];?></span>
					</div>
					<div class="FieldGroup">
						<div class="FieldLabel">Educational Qualification:</div>
						<span class="ShowField"><?php echo $_SESSION['PostData']['AppQlf'];?></span>
					</div>
					<div style="clear:both;"></div>
					<hr />
					<div class="FieldGroup">
					<div class="FieldLabel">Applicant Name:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppName'];?></span><br/>
					<div class="FieldLabel">Father/Husband Name:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['GuardianName'];?></span><br/>
					<div class="FieldLabel">Date of Birth:</div>
					<span class="ShowField"><?php echo date("d/m/Y",strtotime($_SESSION['PostData']['AppDOB'])); ?></span><br/>
					<div class="FieldLabel">Sex(Male/Female):</div>
					<span class="ShowField"><?php echo ($_SESSION['PostData']['AppSex']=="M")?"Male":"Female";?></span><br/>
					<div class="FieldLabel">Religion:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppRel'];?></span><br/>
					<div class="FieldLabel">Caste:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppCaste'];?></span><br/>
					</div>
					<div class="FieldGroup">
					<div class="FieldLabel">Nationality:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppNation'];?></span>
					
					<div class="FieldLabel">Present Address:</div>
					<pre><span class="ShowField"><?php echo str_replace("\\r\\n","\r\n",$_SESSION['PostData']['AppPreA']);?></span></pre><br/>
					<div class="FieldLabel">Pincode:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppPrePin'];?></span><br/>
					<div class="FieldLabel">Permanent Address:</div>
					<pre><span class="ShowField"><?php echo str_replace("\\r\\n","\r\n",$_SESSION['PostData']['AppPerA']);?></span></pre><br/>
					<div class="FieldLabel">Pincode:</div>
					<span class="ShowField"><?php echo $_SESSION['PostData']['AppPerPin'];?></span><br/>
					</div>
					<div class="FieldGroup">
					<div class="<?php echo ($_SESSION['PostData']['AppPH'])?"CheckYes":"CheckNo";?>">Are you Physically Challanged?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppCS'])?"CheckYes":"CheckNo";?>">Have you any Knowledge in Computer?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppOT'])?"CheckYes":"CheckNo";?>">Do you know ordinary Type-Writing?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppSH'])?"CheckYes":"CheckNo";?>">Do you know Shorthand (English/Bengali)?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppGS'])?"CheckYes":"CheckNo";?>">Are you a Govt. Servant?</div>
					<div class="<?php echo ($_SESSION['PostData']['AppOQ'])?"CheckYes":"CheckNo";?>">Do you have any Other Qualifications?</div>
					<br /> <input type="submit" value="Verified All Data Please Proceed" name="CmdVerify" />
					</div>
					<div style="clear:both;"></div>
					</form>
				<?php 
				$Data->do_close();
				break;
			case "Print":
				?>
				<h2>eRecruitment Print Challan</h2>
				<?php ShowMsg();?>
				<span class="Notice">
				<b>Please Note: </b>The Applicant is instructed to deposit the necessary fees using the Bank Challan and make sure that the 
				<b>&ldquo;Applicant ID&rdquo;</b> is entered by the Bank Operator at Bank Counter, Instead of Applicant Name.
				</span>
				<span class="Notice">
				<b>Online Transfer: </b>Applicant may also transfer the amount using Internet Banking, Only make sure that the 
				<b>&ldquo;Applicant ID&rdquo;</b> is mentioned in the transaction remarks.
				</span>
				
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="FieldGroup">
					<input type="submit" value="Print Challan" name="CmdPrint" />
				</div>
				<div style="clear:both;"></div>
				</form>
				<?php
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
		<?php footerinfo();?>
	</div>
</body>
</html>
