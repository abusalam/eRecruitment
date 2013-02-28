<h2>eRecruitment Application Form Verification</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<div class="FieldGroup">
	<div class="FieldLabel">Post Applied For:</div>
	<span class="ShowField">
		<?php
				$Data = new DB();
				echo $Data->do_max_query("select CONCAT(PostName,' [',PostGroup,']-',Category) as ResName" . " from " . MySQL_Pre . "Posts P," . MySQL_Pre . "Categories C," . MySQL_Pre . "Reserved R" . " Where P.PostID=R.PostID AND C.CatgID=R.CatgID AND ResID=" . $Data->SqlSafe($_SESSION['PostData']['AppPostID']));
		?>
	</span>
	</div>
	<div class="FieldGroup">
		<div class="FieldLabel">E-Mail Address:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppEmail']; ?></span>
	</div>
	<div class="FieldGroup">
		<div class="FieldLabel">Mobile No:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppMobile']; ?></span>
	</div>
	<div class="FieldGroup">
		<div class="FieldLabel">Educational Qualification:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppQlf']; ?></span>
	</div>
	<div style="clear:both;"></div>
	<hr />
	<div class="FieldGroup">
		<div class="FieldLabel">Applicant Name:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppName']; ?></span><br/>
		<div class="FieldLabel">Father/Husband Name:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['GuardianName']; ?></span><br/>
		<div class="FieldLabel">Date of Birth:</div>
		<span class="ShowField"><?php echo date("d/m/Y", strtotime($_SESSION['PostData']['AppDOB'])); ?></span><br/>
		<div class="FieldLabel">Sex(Male/Female):</div>
		<span class="ShowField"><?php echo($_SESSION['PostData']['AppSex'] == "M") ? "Male" : "Female"; ?></span><br/>
		<div class="FieldLabel">Religion:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppRel']; ?></span><br/>
		<div class="FieldLabel">Caste:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppCaste']; ?></span><br/>
	</div>
	<div class="FieldGroup">
		<div class="FieldLabel">Nationality:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppNation']; ?></span>
		<div class="FieldLabel">Present Address:</div>
		<pre><span class="ShowField"><?php echo str_replace("\\r\\n", "\r\n", $_SESSION['PostData']['AppPreA']); ?></span></pre><br/>
		<div class="FieldLabel">Pincode:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppPrePin']; ?></span><br/>
		<div class="FieldLabel">Permanent Address:</div>
		<pre><span class="ShowField"><?php echo str_replace("\\r\\n", "\r\n", $_SESSION['PostData']['AppPerA']); ?></span></pre><br/>
		<div class="FieldLabel">Pincode:</div>
		<span class="ShowField"><?php echo $_SESSION['PostData']['AppPerPin']; ?></span><br/>
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
?>