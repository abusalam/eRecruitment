<h2>eRecruitment Print Challan</h2>
<?php ShowMsg(); ?>
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