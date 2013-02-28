<h2> eRecruitment Application Form </h2>
<?php phpShowMsg(); ?>
<span class="Notice"><b>Please Note: </b>All fields are mandatory. No modifications will be allowed after submission of this form.</span>
<hr />
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<div class="FieldGroup">
		<h3>Post Applied For</h3>
		<select name="AppPostID">
		<?php
			$Data = new DB();
			$Data->show_sel("ResID", "ResName", "select ResID,CONCAT(PostName,' [',PostGroup,']-',Category) as ResName" . " from " . MySQL_Pre . "Posts P," . MySQL_Pre . "Categories C," . MySQL_Pre . "Reserved R" . " Where P.PostID=R.PostID AND C.CatgID=R.CatgID Order by ResID");
		?>
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
		<p>
		<label for="ChkDecl"><input id="ChkDeclr" name="ChkDeclr" type="checkbox" value="1" />All statesment made in this application are true, complete and correct to the best of knowledge and belief and in the event of any information being found false, my candidature is liable to be canceled.
		</label>
		</p><br/>
		<input type="submit" value="Submit" name="AppSubmit" />
	<div style="clear:both;"></div>
</form>
<?php
$Data->do_close();
?>